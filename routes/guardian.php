<?php

use App\Http\Controllers\Guardian\GuardianConsentController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:guardian'])
    ->prefix('guardian')
    ->name('guardian.')
    ->group(function () {
        Route::get('/consent/{applicant}', [GuardianConsentController::class, 'show'])
            ->name('consent.show')
            ->middleware('signed');

        Route::post('/consent/{applicant}', [GuardianConsentController::class, 'store'])
            ->name('consent.store');

        Route::get('/consent/dashboard', [GuardianConsentController::class, 'dashboard'])
            ->name('dashboard');
    });
