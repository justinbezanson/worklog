<?php

use App\Models\Task;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Controllers\TaskController;
use Illuminate\Container\Attributes\Auth;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard/{date?}', function (Request $request, $date = null) {
    $today = new DateTime($date ?? 'now');
    $yesterday = (new DateTime($today->format('Y-m-d')))->sub(new DateInterval('P1D'));
    $tomorrow = (new DateTime($today->format('Y-m-d')))->add(new DateInterval('P1D'));
    $message = null;
    
    if($request->session()->has('message')) {
        $message = $request->session()->get('message');
    }

    return Inertia::render('Dashboard', [
        'today' => $today->format('Y-m-d'),
        'todayFormatted' => $today->format('l, F jS'),
        'yesterday' => $yesterday->format('Y-m-d'),
        'yesterdayFormatted' => $yesterday->format('l, F jS'),
        'tomorrow' => $tomorrow->format('Y-m-d'),
        'tomorrowFormatted' => $tomorrow->format('l, F jS'),
        'message' => $message,
        'tasks' => Task::where('task_date', '=', $today->format('Y-m-d').'T04:00:00.000Z')->get(),
    ]);

})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/task/create', [TaskController::class, 'store'])->middleware(['auth', 'verified'])->name('task.create');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
