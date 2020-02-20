<?php
namespace Withgod\EMemcachedStore\Stores;

use Illuminate\Cache\MemcachedStore as MemcachedStore;
use Memcached;

class EMemcachedStore extends MemcachedStore {
    protected $key            = NULL;
    protected $error_code     = 0;
    protected $error_message  = NULL;
    protected $operation      = NULL;
    protected $elapsed_time   = 0;
    protected $ignore_error_code = [
        Memcached::RES_BUFFERED,
        Memcached::RES_END,
        Memcached::RES_STORED,
        Memcached::RES_NOTSTORED,
        Memcached::RES_NOTFOUND,
        Memcached::RES_BAD_KEY_PROVIDED,
    ];

    public function many($array) {
        return $this->callFunc('many', $array);
    }
    public function put($key, $value, $seconds) {
        return $this->callFunc('put', $key, $value, $seconds);
    }
    public function get($key) {
        return $this->callFunc('get', $key);
    }
    public function putMany(array $values, $seconds) {
        return $this->callFunc('putMany', $values, $seconds);
    }
    public function add($key, $value, $seconds) {
        return $this->callFunc('add', $key, $value, $seconds);
    }
    public function increment($key, $value = 1) {
        return $this->callFunc('increment', $key, $value);
    }
    public function decrement($key, $value = 1) {
        return $this->callFunc('decrement', $key, $value);
    }


    protected function callFunc($method, ...$params) {
        $start_time  = microtime(TRUE);
        $this->error_code    = 0;
        $this->error_message = NULL;

        $ret = parent::$method(...$params);

        if ($this->memcached->getResultCode() !== 0) {
            $this->error_code    = $this->memcached->getResultCode();
            $this->error_message = $this->memcached->getResultMessage();
        }

        $this->operation    = $method;

        $this->key          = is_array($params[0]) ?
            array_map(function ($v) { return $this->prefix.$v;}, $params[0]) : $this->prefix.$params[0];
        $this->elapsed_time = microtime(TRUE) - $start_time;
        $this->log();

        return $ret;
    }

    protected function log() {
        $attr =[
            php_sapi_name() == 'cli' ? cli : url()->current(),
            number_format($this->elapsed_time, 6),
            $this->operation,
            is_array($this->key) ? implode(',', $this->key) : $this->key
        ];
        if (
            ($this->error_code || $this->error_message ) &&
            (!in_array($this->error_code, $this->ignore_error_code))
        ) {
            $attr[] = $this->error_code;
            $attr[] = $this->error_message;
            logger()->error(join("\t", $attr));
        } else {
            logger()->debug(join("\t", $attr));
        }
    }
}
