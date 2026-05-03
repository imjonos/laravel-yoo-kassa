<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Nos\Yookassa\Http\Controllers\NotificationController;
use Nos\Yookassa\Http\Middleware\IpAccess;

Route::group(['middleware' => [IpAccess::class]], function () {
    Route::post('/yookassa/notifications', [NotificationController::class, 'index'])->name('yookassa.notifications');
});
