<?php

use App\Http\Controllers\Auth\RegistrationValidationController;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'Welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::inertia('/academic', 'AcademicSchool')->name('academic');
Route::inertia('/programs', 'Programs')->name('programs');
Route::inertia('/research', 'Research')->name('research');
Route::inertia('/news', 'News')->name('news');
Route::inertia('/events', 'Events')->name('events');
Route::inertia('/publications', 'Publications')->name('publications');
Route::inertia('/admission', 'Admission')->name('admission');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'Dashboard')->name('dashboard');
});

Route::post('register/validate', RegistrationValidationController::class)
    ->middleware(['guest', HandlePrecognitiveRequests::class])
    ->name('register.validate');

require __DIR__ . '/settings.php';
