<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
    public $aliases = [
        'csrf'     => \CodeIgniter\Filters\CSRF::class,
        'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
        'honeypot' => \CodeIgniter\Filters\Honeypot::class,
        'locale'   => \App\Filters\LocaleFilter::class,  // Tambahkan alias untuk LocaleFilter
    ];

    public $globals = [
        'before' => [
            'csrf',
            'locale' => ['except' => ['api/*']],  // Locale filter dijalankan sebelum request kecuali pada API
        ],
        'after'  => [
            'toolbar',
            // Filter lain yang dijalankan setelah request
        ],
    ];

    public $methods = [];

    public $filters = [];
}
