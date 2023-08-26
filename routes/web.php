<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SheetController;

use App\Http\Controllers\Admin\MoviesController;
use App\Http\Controllers\Admin\SchedulesController;


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

Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);

#Movie
Route::get('/movies', [MovieController::class, 'index'])->name('index');
Route::get('/movies/{id}', [MovieController::class, 'show'])->name('show');

#Movies(Admin)
Route::get('/admin/movies', [MoviesController::class, 'index'])->name('admin.index');
Route::get('/admin/movies/create', [MoviesController::class, 'create'])->name('admin.create');
Route::get('/admin/movies/{id}', [MoviesController::class, 'show'])->name('admin.show');
Route::post('/admin/movies/store', [MoviesController::class, 'store'])->name('admin.store');
Route::get('/admin/movies/{id}/edit', [MoviesController::class, 'edit'])->name('admin.edit');
Route::patch('/admin/movies/{id}/update', [MoviesController::class, 'update'])->name('admin.update');
Route::delete('/admin/movies/{id}/destroy', [MoviesController::class, 'destroy'])->name('admin.destroy');

#Sheet
Route::get('/sheets', [SheetController::class, 'index'])->name('sheet.index');

#Schedules(Admin)
Route::get('/admin/schedules', [SchedulesController::class, 'index'])->name('admin.schedule.index');
Route::get('/admin/schedules/{id}', [SchedulesController::class, 'show'])->name('admin.schedule.show');
Route::get('/admin/movies/{id}/schedules/create', [SchedulesController::class, 'create'])->name('admin.schedule.create');
Route::post('/admin/movies/{movieId}/schedules/store', [SchedulesController::class, 'store'])->name('admin.schedule.store');
Route::get('/admin/schedules/{scheduleId}/edit', [SchedulesController::class, 'edit'])->name('admin.schedule.edit');
Route::patch('/admin/schedules/{id}/update', [SchedulesController::class, 'update'])->name('admin.schedule.update');
Route::delete('/admin/schedules/{id}/destroy', [SchedulesController::class, 'destroy'])->name('admin.schedule.destroy');
