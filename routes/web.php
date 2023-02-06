<?php

use App\Http\Controllers\ProfileController;
use App\Models\Admin\Project;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotta per utenti NON loggati dove mostrare la lista dei post in modo carino e coccoloso.
Route::get("/posts", [PublicPostController::class, "index"])->name("posts.index");
Route::get("/about", [PublicController::class, "about"])->name("about.index");
Route::get("/contact", [PublicController::class, "contact"])->name("contact.index");


Route::get('/dashboard', function () {
    $projects = Project::all();
    return view('dashboard', compact('projects'));
})->middleware(['auth', 'verified'])->prefix("admin")->name('dashboard');



/* parte che riguarda le modifiche del profilo */



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
