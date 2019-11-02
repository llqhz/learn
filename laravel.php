<?php

## laravel 路由

Route::get('/user', 'Index\UserController@index');


Route::get('/foo/{name?}', function ($name = 'xiaoguai'){
    return 'success in fun : ' . $name;
})->where(['name' => '[a-z]+']);*/

Route::get('/user/{action}', function (\App\Http\Controllers\Index\UserController $controller, $action) {
    if (method_exists($controller, $action)) {
        return $controller->$action();

    }
    abort(404, 'Not Found');
    return null;
});


Route::get(
    '/post',
    implode([UserController::class, '@', 'post'])
);

Route::match(
    ['get', 'post'],
    '/post',
    implode([UserController::class, '@', 'post'])
);

## laravel 工具帮助 

php artisan list

  创建控制器
php artisan make:controller PostController

  查看详细帮助
php artisan help make:migration

  自定义facade类

  laravel 命令行工具
  php artisan tinker

