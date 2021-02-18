<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function()
{
    Route::resource('/user', UserController::class)->only('index');

    Route::middleware(['admin'])->group(function()
    {
        Route::get('/admin', [AdminController::class, 'edit'])->name('admin.edit');


        Route::resource('/user', UserController::class)->except('index', 'show');
        Route::put('/user/{user}/update-password', [UserController::class, 'updatePassword'])->name('user.update-password');
        Route::delete('/user/{user}/delete-photo', [UserController::class, 'deletePhoto'])->name('user.delete-photo');
        Route::put('/type/', [TypeController::class, 'update'])->name('type.update');
        Route::put('/status/', [StatusController::class, 'update'])->name('status.update');
    });

    Route::get('/job/export', [JobController::class, 'export'])->name('job.export');
    Route::resource('/job', JobController::class);
});
