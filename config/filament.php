<?php

use Filament\Panel;

return [

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Path
    |--------------------------------------------------------------------------
    | URL prefix for admin panel.
    */
    'path' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Domain
    |--------------------------------------------------------------------------
    | Leave null to use the same domain as your main site.
    */
    'domain' => null,

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    | Web middleware is required for sessions, CSRF, and authentication.
    */
    'middleware' => ['web'],

    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    | Guard and login page.
    */
    'auth' => [
        'guard' => 'web',
        'pages' => [
            // Filament 4 uses this LoginController instead of Livewire class
            'login' => \Filament\Http\Controllers\Auth\LoginController::class,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Default filesystem disk
    |--------------------------------------------------------------------------
    */
    'default_filesystem_disk' => env('FILESYSTEM_DISK', 'public'),

    /*
    |--------------------------------------------------------------------------
    | Assets Path
    |--------------------------------------------------------------------------
    | Directory where Filament publishes assets. Null = default.
    */
    'assets_path' => null,

    /*
    |--------------------------------------------------------------------------
    | Cache Path
    |--------------------------------------------------------------------------
    */
    'cache_path' => base_path('bootstrap/cache/filament'),

    /*
    |--------------------------------------------------------------------------
    | Livewire Loading Delay
    |--------------------------------------------------------------------------
    | 'default' = 200ms, 'none' = immediate
    */
    'livewire_loading_delay' => 'default',

    /*
    |--------------------------------------------------------------------------
    | File Generation
    |--------------------------------------------------------------------------
    */
    'file_generation' => [
        'flags' => [],
    ],

    /*
    |--------------------------------------------------------------------------
    | System Route Prefix
    |--------------------------------------------------------------------------
    */
    'system_route_prefix' => 'filament',

    /*
    |--------------------------------------------------------------------------
    | Broadcasting (Optional)
    |--------------------------------------------------------------------------
    | Uncomment if you want to enable real-time notifications via Pusher or Laravel Echo
    */
    'broadcasting' => [
        // 'echo' => [
        //     'broadcaster' => 'pusher',
        //     'key' => env('VITE_PUSHER_APP_KEY'),
        //     'cluster' => env('VITE_PUSHER_APP_CLUSTER'),
        //     'wsHost' => env('VITE_PUSHER_HOST'),
        //     'wsPort' => env('VITE_PUSHER_PORT'),
        //     'wssPort' => env('VITE_PUSHER_PORT'),
        //     'authEndpoint' => '/broadcasting/auth',
        //     'disableStats' => true,
        //     'encrypted' => true,
        //     'forceTLS' => true,
        // ],
    ],

];
