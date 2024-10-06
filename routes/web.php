<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard/{date?}', function ($date = null) {
    $today = new DateTime($date ?? 'now');
    $yesterday = (new DateTime($today->format('Y-m-d')))->sub(new DateInterval('P1D'));
    $tomorrow = (new DateTime($today->format('Y-m-d')))->add(new DateInterval('P1D'));

    return Inertia::render('Dashboard', [
        'today' => $today->format('Y-m-d'),
        'todayFormatted' => $today->format('l, F jS'),
        'yesterday' => $yesterday->format('Y-m-d'),
        'yesterdayFormatted' => $yesterday->format('l, F jS'),
        'tomorrow' => $tomorrow->format('Y-m-d'),
        'tomorrowFormatted' => $tomorrow->format('l, F jS'),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
