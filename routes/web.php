<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/tasks/modal/{record}',[TaskController::class, 'editStatus'])->name('task.modal');

Route::put('admin/tasks/{task}/update-status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
