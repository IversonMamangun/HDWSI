<?php

use App\Http\Controllers\Auth\RegistrationValidationController;
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

require __DIR__ . '/settings.php';
