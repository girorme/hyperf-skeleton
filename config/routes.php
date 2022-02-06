<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;
use App\Controller\{UserController, AuthController};

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::get('/favicon.ico', function () {
    return '';
});

Router::addGroup('/api', function () {
    Router::addGroup('/user', function () {
        Router::get('', [UserController::class, 'index']);
        Router::post('/register', [UserController::class, 'store']);
    });

    Router::post('/auth', [AuthController::class, 'jwtAuth']);
});
