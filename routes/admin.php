<?php

use App\Http\Controllers\Admin\Applicants\ApplicantController;
use App\Http\Controllers\Admin\Applicants\ApproveApplicantController;
use App\Http\Controllers\Admin\Applicants\RejectApplicantController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'role:admin|admissions-officer'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/applicants', [ApplicantController::class, 'index'])->name('applicants.index');
        Route::get('/applicants/{applicant}', [ApplicantController::class, 'show'])->name('applicants.show');
        Route::post('/applicants/{applicant}/approve', ApproveApplicantController::class)->name('applicants.approve');
        Route::post('/applicants/{applicant}/reject', RejectApplicantController::class)->name('applicants.reject');
    });
