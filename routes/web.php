<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Filament\Filament;

// Liste des utilisateurs
Route::get('/filament/users', function () {
    return Filament::resources('App\Filament\Resources\UserResource');
});

// Afficher le formulaire de création d'utilisateur
Route::get('/filament/users/create', function () {
    return Filament::createResource('App\Filament\Resources\UserResource');
});

// Enregistrer un nouvel utilisateur
Route::post('/filament/users', function () {
    return Filament::saveResource('App\Filament\Resources\UserResource');
});

// Afficher un utilisateur spécifique
Route::get('/filament/users/{id}', function ($id) {
    return Filament::viewResource('App\Filament\Resources\UserResource', $id);
});

// Afficher le formulaire de modification d'un utilisateur
Route::get('/filament/users/{id}/edit', function ($id) {
    return Filament::editResource('App\Filament\Resources\UserResource', $id);
});

// Mettre à jour un utilisateur existant
Route::put('/filament/users/{id}', function ($id) {
    return Filament::updateResource('App\Filament\Resources\UserResource', $id);
});

// Supprimer un utilisateur
Route::delete('/filament/users/{id}', function ($id) {
    return Filament::deleteResource('App\Filament\Resources\UserResource', $id);
});




Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/tasks/modal/{record}',[TaskController::class, 'editStatus'])->name('task.modal');

Route::put('admin/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
