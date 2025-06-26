<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckAuth;
use App\Http\Middleware\CheckGuest;
use App\Http\Middleware\CheckMerchant;
use App\Http\Middleware\CheckNotMerchant;
use App\Http\Middleware\CheckOwner;
use App\Http\Middleware\CheckListingOwner;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => CheckAdmin::class,
            'auth' => CheckAuth::class,
            'guest' => CheckGuest::class,
            'not-merchant' => CheckNotMerchant::class,
            'merchant' => CheckMerchant::class,
            'owner' => CheckOwner::class,
            'listing-owner' => CheckListingOwner::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
