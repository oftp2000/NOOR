<?php
namespace App\Http;

use App\Http\Middleware\RoleMiddleware;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        // autres middlewares
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
    'utilisateur' => \App\Http\Middleware\UserMiddleware::class,
    'is_admin' => \App\Http\Middleware\IsAdmin::class,
    'is_user'  => \App\Http\Middleware\IsUser::class,
    ];
}