NOTE

#初始化
`laravel new app`

#dingo

composer.json
`
"require": {
  "dingo/api": "2.0.0-alpha2",
}
`

`composer update`

`php artisan vendor:publish --provider="Dingo\Api\Provider\LaravelServiceProvider"`

修改config/api.php
`'prefix' => env('API_PREFIX', 'api'),`

#JWT

composer.json
`
"tymon/jwt-auth": "1.0.0-rc.2"
`

`composer update`

`php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`

`php artisan jwt:secret`

修改config/api.php
`
'auth' => [
    'jwt' => 'Dingo\Api\Auth\Provider\JWT',
],
`

修改config/app.php
`
'providers' => [
    ...
    Tymon\JWTAuth\Providers\LaravelServiceProvider::class,
]
`

config/auth.php
修改
`
'defaults' => [
    'guard' => 'web',
    'passwords' => 'users',
],
`
为
`
'defaults' => [
    'guard' => 'api',
    'passwords' => 'users',
],
`

修改
`
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'token',
        'provider' => 'users',
    ],
],
`
为
`    
'guards' => [
    'web' => [
        'driver' => 'session',
        'provider' => 'users',
    ],

    'api' => [
        'driver' => 'jwt',
        'provider' => 'users',
    ],
],
`    
# laravel-permission

`composer require spatie/laravel-permission`

修改`config/app.php`
`
'providers' => [
    // ...
    Spatie\Permission\PermissionServiceProvider::class,
];
`

`php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="migrations"`

`php artisan migrate`

`php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider" --tag="config"`



     
     
 
     
     
     
     
     
