<?php
namespace Withgod\EMemcachedStore\Providers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Withgod\EMemcachedStore\Stores\EMemcachedStore;

class EMemcachedServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function boot()
    {
        Cache::extend('ememcached', function ($app, $config) {
            $prefix = $this->getPrefix($config);

            $memcached = $this->app['memcached.connector']->connect(
                $config['servers'],
                $config['persistent_id'] ?? null,
                $config['options'] ?? [],
                array_filter($config['sasl'] ?? [])
            );
            return Cache::repository(new EMemcachedStore($memcached, $prefix));
        });
    }

}
