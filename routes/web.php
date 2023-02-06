<?php

use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 */

Route::get("/posts", [ProjectControllerer::class, "index"])->name("posts.index");
Route::get("/about", [ProjectController::class, "about"])->name("about.index");
Route::get("/contact", [ProjectController::class, "contact"])->name("contact.index");


Route::resource('projects', ProjectController::class);




Route::get('/dashboard', function () {
    $projects = Project::all();
    return view('dashboard', compact('projects'));
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
