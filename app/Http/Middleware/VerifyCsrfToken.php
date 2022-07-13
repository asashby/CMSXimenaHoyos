<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'dashboard/verify-curr-pwd',
        'dashboard/upd-section-status',
        'dashboard/slider/upd-slider-order',
        'dashboard/units/order',
        'dashboard/upd-order-status'
    ];
}
