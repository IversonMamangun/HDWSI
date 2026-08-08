<?php

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

require __DIR__.'/settings.php';
