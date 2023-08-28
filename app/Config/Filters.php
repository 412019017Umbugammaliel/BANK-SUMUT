<?php

namespace Config;

use App\Filters\AuthGuard;
use App\Filters\AuthGuardCs;
use App\Filters\AuthGuardClient;
use App\Filters\AuthGuardAdmin;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        //=========================================
        'authGuard' => AuthGuard::class,
        'authGuardClient' => AuthGuardClient::class,
        'authGuardCs' => AuthGuardCs::class,
        'authGuardAdmin' => AuthGuardAdmin::class
        //=========================================   
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [
        'authGuard' =>['before'=>['main','server','viewserver','cart','order','inv','merch','accScur','setting','help','liveChat','notif','log','themes']
        ], 
        'authGuardClient' =>['before'=>['login','notif','log']
        ], 
        'authGuardCs' =>['before' =>['login','order','merch','help','notif','log'],
        ],
        'authGuardAdmin' =>['before' =>['login','merch','help'],
        ]
    ];
}
