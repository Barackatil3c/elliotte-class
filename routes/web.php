<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AnnouncementController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes for assignments, grades, and announcements
    Route::resource('assignments', AssignmentController::class);
    Route::resource('grades', GradeController::class);
    Route::resource('announcements', AnnouncementController::class);
});

require __DIR__.'/auth.php';
