<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [App\Http\Controllers\website\LoginController::class, 'login'])->name('login');
Route::post('/login-process', [App\Http\Controllers\website\LoginController::class, 'loginprocess'])->name('loginprocess');

// Accept Invite Routes (no auth needed - client isn't logged in yet)
Route::get('/accept-invite/{token}', [App\Http\Controllers\website\ClientController::class, 'accept'])->name('website.clients.accept');
Route::post('/accept-invite/{token}', [App\Http\Controllers\website\ClientController::class, 'acceptStore'])->name('website.clients.accept.store');

// URL Redirect Route (no auth needed - public access)
Route::get('/s/{short_code}', [App\Http\Controllers\website\UrlController::class, 'redirectUrl'])->name('website.urls.redirect');

Route::group(['middleware' => 'AdminSession'], function () {
    Route::get('/dashboard', [App\Http\Controllers\website\DashboardController::class, 'index'])->name('website.dashboard.index');
    Route::get('/logout', [App\Http\Controllers\website\LoginController::class, 'logout'])->name('website.logout');

    // Settings Routes
    Route::get('/settings', [App\Http\Controllers\website\SettingsController::class, 'edit'])->name('website.settings.edit');
    Route::post('/settings', [App\Http\Controllers\website\SettingsController::class, 'update'])->name('website.settings.update');

    // Client Routes
    Route::group(['prefix' => 'clients'], function () {
        Route::any('/client-list', [App\Http\Controllers\website\ClientController::class, 'index'])->name('website.clients.index');
        Route::get('/invite-client', [App\Http\Controllers\website\ClientController::class, 'invite'])->name('website.clients.invite');
        Route::post('/invite-client', [App\Http\Controllers\website\ClientController::class, 'inviteStore'])->name('website.clients.invite.store');
    });

    // URL Routes
    Route::group(['prefix' => 'urls'], function () {
        Route::any('/url-list', [App\Http\Controllers\website\UrlController::class, 'index'])->name('website.urls.index');
        Route::any('/url-filter-reset', [App\Http\Controllers\website\UrlController::class, 'urllistfilterreset'])->name('website.urls.urllistfilterreset');
        Route::get('/generate-url', [App\Http\Controllers\website\UrlController::class, 'generate'])->name('website.urls.generate');
        Route::post('/generate-url', [App\Http\Controllers\website\UrlController::class, 'generateStore'])->name('website.urls.generate.store');
    });
});
