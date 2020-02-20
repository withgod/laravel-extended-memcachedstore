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
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000134	get	laravel_cache:memc-bench-5e4e8ff5bf7ba
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000169	put	laravel_cache:memc-bench-5e4e8ff5bfb36
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000164	get	laravel_cache:memc-bench-5e4e8ff5bd26c
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000128	get	laravel_cache:memc-bench-5e4e8ff5bd8a5
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000115	get	laravel_cache:memc-bench-5e4e8ff5c060b
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000119	get	laravel_cache:memc-bench-5e4e8ff5be28f
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000124	get	laravel_cache:memc-bench-5e4e8ff5be28f
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000219	put	laravel_cache:memc-bench-5e4e8ff5c1017
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000187	put	laravel_cache:memc-bench-5e4e8ff5c13fc
[2020-02-20 13:56:05] local.DEBUG: http://localhost:8080/memcached	0.000198	put	laravel_cache:memc-bench-5e4e8ff5c17a4
```
