<?php

use App\Http\Controllers\Applicant\ApplicantDashboardController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:applicant'])
    ->prefix('applicant')
    ->name('applicant.')
    ->group(function () {
        Route::get('/dashboard', [ApplicantDashboardController::class, 'show'])
            ->name('dashboard');
    });
