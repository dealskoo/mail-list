<?php

use Dealskoo\MailList\Http\Controllers\MailListController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->prefix('/{' . config('country.prefix') . '}')->group(function () {
    Route::post('/mail-list', [MailListController::class, 'handle'])->name('mail-list');
});
