# laravel extended memcached store

## about

loose implementation of improved logging memcachedstore

## install

### composer cli

```
composer require withgod/laravel-extended-memcachedstore
```

### composer.json

```
"repositories": [
    {
        "type": "vcs",
        "url": "git@github.com:withgod/laravel-extended-memcachedstore.git"
    }
]
"require": {
    "withgod/laravel-extended-memcachedstore": "@dev"
}
```

## config

### .env

```
CACHE_DRIVER=ememcached
```

### config/cache.php

same as memcached.

```
        'ememcached' => [
            'driver' => 'ememcached',
            'persistent_id' => env('MEMCACHED_PERSISTENT_ID', 'memcached'),
            'options' => [
                Memcached::OPT_DISTRIBUTION => Memcached::DISTRIBUTION_CONSISTENT,
                Memcached::OPT_LIBKETAMA_COMPATIBLE => true,
                //Memcached::OPT_SERIALIZER => Memcached::SERIALIZER_IGBINARY,
                //Memcached::OPT_BINARY_PROTOCOL => true,
            ],
            'servers' => [
                [
                    'host' => env('MEMCACHED_HOST', 'memcached'),
                    'port' => env('MEMCACHED_PORT', 11211),
                    'weight' => 100,
                ],
            ],
        ],
```

### log

```
root@70c0910de41e:/var/tmp/app# tail -f ./storage/logs/laravel.log
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000387        put     laravel_cache:memc-bench-0000000000000
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000394        put     laravel_cache:memc-bench-5e4ee17950208
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000217        put     laravel_cache:memc-bench-5e4ee17950722
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000258        put     laravel_cache:memc-bench-5e4ee17954f6b
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000165        get     laravel_cache:memc-bench-5e4ee17950208
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000254        put     laravel_cache:memc-bench-5e4ee1795578a
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000252        add     laravel_cache:memc-bench-add-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000656        add     laravel_cache:memc-bench-add-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.002009        putMany laravel_cache:memc-bench-putmany-5e4ee17955ba5-0,laravel_cache:memc-bench-putmany-5e4ee17955ba5-1,laravel_cache:memc-bench-putmany-5e4ee17955ba5-2,laravel_cache:memc-bench-putmany-5e4ee17955ba5-3,laravel_cache:memc-bench-putmany-5e4ee17955ba5-4,laravel_cache:memc-bench-putmany-5e4ee17955ba5-5,laravel_cache:memc-bench-putmany-5e4ee17955ba5-6,laravel_cache:memc-bench-putmany-5e4ee17955ba5-7,laravel_cache:memc-bench-putmany-5e4ee17955ba5-8,laravel_cache:memc-bench-putmany-5e4ee17955ba5-9
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000300        many    laravel_cache:memc-bench-putmany-5e4ee17955ba5-0,laravel_cache:memc-bench-putmany-5e4ee17955ba5-1,laravel_cache:memc-bench-putmany-5e4ee17955ba5-2,laravel_cache:memc-bench-putmany-5e4ee17955ba5-3,laravel_cache:memc-bench-putmany-5e4ee17955ba5-4,laravel_cache:memc-bench-putmany-5e4ee17955ba5-5,laravel_cache:memc-bench-putmany-5e4ee17955ba5-6,laravel_cache:memc-bench-putmany-5e4ee17955ba5-7,laravel_cache:memc-bench-putmany-5e4ee17955ba5-8,laravel_cache:memc-bench-putmany-5e4ee17955ba5-9
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000334        put     laravel_cache:memc-bench-increment-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000185        increment       laravel_cache:memc-bench-increment-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000260        increment       laravel_cache:memc-bench-increment-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000242        increment       laravel_cache:memc-bench-increment-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000222        get     laravel_cache:memc-bench-increment-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000284        put     laravel_cache:memc-bench-decrement-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000262        decrement       laravel_cache:memc-bench-decrement-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000191        decrement       laravel_cache:memc-bench-decrement-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000172        decrement       laravel_cache:memc-bench-decrement-5e4ee17955ba5
[2020-02-20 19:43:53] local.DEBUG: http://localhost:8080/memcached      0.000262        get     laravel_cache:memc-bench-decrement-5e4ee17955ba5```
