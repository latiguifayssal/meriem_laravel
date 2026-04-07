<?php

use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsAuthor;
use App\Http\Middleware\IsReviewer;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isAdmin' => IsAdmin::class,
            'isAuthor' => IsAuthor::class,
            'isReviewer' => IsReviewer::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->create();

/*
 * PHP 8.5 deprecates PDO::MYSQL_ATTR_SSL_CA when Laravel merges in
 * vendor/laravel/framework/config/database.php. Framework merge is disabled
 * so that file is not loaded; ensure config/*.php stays complete (e.g. view,
 * hashing, cors, broadcasting, concurrency) — mirror vendor defaults if needed.
 */
$app->dontMergeFrameworkConfiguration();

return $app;
