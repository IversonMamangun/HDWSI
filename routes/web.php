<?php

use App\Http\Controllers\Auth\RegistrationValidationController;
use App\Http\Controllers\Guardian\GuardianConsentController;
use App\Http\Controllers\IdDocumentController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::inertia('/academic', 'Sections/AcademicSchool')->name('academic');
Route::inertia('/programs', 'Sections/Programs')->name('programs');
Route::inertia('/research', 'Sections/Research')->name('research');
Route::inertia('/news', 'Sections/News')->name('news');
Route::inertia('/events', 'Sections/Events')->name('events');
Route::inertia('/publications', 'Sections/Publications')->name('publications');
Route::inertia('/admission', 'Sections/Admission')->name('admission');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::post('register/validate', RegistrationValidationController::class)
    ->middleware(['guest', HandlePrecognitiveRequests::class])
    ->name('register.validate');

Route::get('/guardian/consent/{applicant}', [GuardianConsentController::class, 'show'])
    ->name('guardian.consent.show')
    ->middleware('signed');

Route::post('/guardian/consent/{applicant}', [GuardianConsentController::class, 'store'])
    ->name('guardian.consent.store')
    ->middleware('auth');

Route::get('/applicants/{applicant}/id-document', [IdDocumentController::class, 'show'])
    ->name('applicants.id-document.show')
    ->middleware('auth');

require __DIR__ . '/settings.php';
