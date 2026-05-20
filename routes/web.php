<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// GET logout — fallback agar logout bisa tanpa JS/form POST
Route::get('/keluar', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->middleware('auth')->name('logout.get');

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile (Breeze default)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{course}', [CourseController::class, 'show'])->name('courses.show');

    // Lessons
    Route::get('/courses/{course}/lessons/{lesson}', [LessonController::class, 'show'])->name('courses.lesson');
    Route::post('/courses/{course}/lessons/{lesson}/complete', [LessonController::class, 'complete'])->name('lessons.complete');

    // Quizzes
    Route::get('/courses/{course}/quizzes/{quiz}', [QuizController::class, 'show'])->name('courses.quiz');
    Route::post('/courses/{course}/quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');

    // Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');

    // Placeholder routes
    Route::get('/badges', fn() => view('dashboard'))->name('badges.index');
});

// Admin Routes — Protected by auth + admin middleware
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');

    // Courses
    Route::get('/courses', [\App\Http\Controllers\Admin\CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [\App\Http\Controllers\Admin\CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [\App\Http\Controllers\Admin\CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{course}/edit', [\App\Http\Controllers\Admin\CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{course}', [\App\Http\Controllers\Admin\CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{course}', [\App\Http\Controllers\Admin\CourseController::class, 'destroy'])->name('courses.destroy');

    // Quizzes
    Route::get('/quizzes', [\App\Http\Controllers\Admin\QuizController::class, 'index'])->name('quizzes.index');
    Route::get('/quizzes/create', [\App\Http\Controllers\Admin\QuizController::class, 'create'])->name('quizzes.create');
    Route::post('/quizzes', [\App\Http\Controllers\Admin\QuizController::class, 'store'])->name('quizzes.store');
    Route::get('/quizzes/{quiz}/edit', [\App\Http\Controllers\Admin\QuizController::class, 'edit'])->name('quizzes.edit');
    Route::put('/quizzes/{quiz}', [\App\Http\Controllers\Admin\QuizController::class, 'update'])->name('quizzes.update');
    Route::delete('/quizzes/{quiz}', [\App\Http\Controllers\Admin\QuizController::class, 'destroy'])->name('quizzes.destroy');

    // Materials (Lessons)
    Route::get('/materials', [\App\Http\Controllers\Admin\LessonController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [\App\Http\Controllers\Admin\LessonController::class, 'create'])->name('materials.create');
    Route::post('/materials', [\App\Http\Controllers\Admin\LessonController::class, 'store'])->name('materials.store');
    Route::get('/materials/{lesson}/edit', [\App\Http\Controllers\Admin\LessonController::class, 'edit'])->name('materials.edit');
    Route::put('/materials/{lesson}', [\App\Http\Controllers\Admin\LessonController::class, 'update'])->name('materials.update');
    Route::delete('/materials/{lesson}', [\App\Http\Controllers\Admin\LessonController::class, 'destroy'])->name('materials.destroy');
});

require __DIR__.'/auth.php';
