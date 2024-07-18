<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

use Filament\Http\Middleware\Authenticate;
use App\Http\Controllers\UserController;



Route::group(['middleware' => ['web']], function () {
    // Route pour afficher le formulaire de connexion
    Route::get('admin/login', [\Filament\Http\Controllers\AuthController::class, 'showLoginForm'])->name('filament.auth.login');

    // Route pour traiter la requête de connexion
    Route::post('admin/login', [\Filament\Http\Controllers\AuthController::class, 'login'])->name('filament.auth.login.post');

      // Liste des utilisateurs
    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    // Afficher le formulaire de création d'utilisateur
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

    // Enregistrer un nouvel utilisateur
    Route::post('/users', [UserController::class, 'store'])->name('users.store');

    // Afficher un utilisateur spécifique
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

    // Afficher le formulaire de modification d'un utilisateur
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    // Mettre à jour un utilisateur existant
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    // Supprimer un utilisateur
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

});




Route::get('/', function () {
    return view('welcome');
});


Route::get('admin/tasks/modal/{record}',[TaskController::class, 'editStatus'])->name('task.modal');

Route::put('admin/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
