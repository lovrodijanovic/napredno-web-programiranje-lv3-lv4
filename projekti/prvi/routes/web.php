<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/api/users', [UserController::class, 'getUsers']);

Route::get('/projects/create', [ProjectController::class, 'create'])->name('project.create_project');
Route::post('/project', [ProjectController::class, 'store'])->name('project.store');

Route::get('/project/{project}', [ProjectController::class, 'show']);
Route::get('/projects', [ProjectController::class, 'getProjects']);
