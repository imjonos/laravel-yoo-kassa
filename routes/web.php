<?php

use Illuminate\Support\Facades\Route;
use Nos\Yookassa\Http\Middleware\IpAccess;

Route::group(['middleware' => ['web', IpAccess::class]], function () {
    Route::namespace('Nos\Yookassa\Http\Controllers')->group(function () {
        Route::post('/yookassa/notifications', 'NotificationController@index')->name('yookassa.notifications');
    });
});
