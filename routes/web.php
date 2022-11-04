<?php

use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\KanbanController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PersonalController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
})->name('/');

Auth::routes();
Auth::routes(['register' => false]);


Route::get('/home', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('home');

Route::resource('user',UserController::class);
Route::get('user-list',[UserController::class,'list'])->name('user.list');

Route::resource('role',RoleController::class);

Route::resource('department',DepartmentController::class);
Route::get('department-list',[DepartmentController::class,'list'])->name('department.list');

Route::resource('position',PositionController::class);
Route::get('position-list',[PositionController::class,'list'])->name('position.list');

Route::resource('personal',PersonalController::class);
Route::get('personal-list',[PersonalController::class,'list'])->name('personal.list');



    // Route::get('/',[TaskController::class,'index'])->name('task.index');
    Route::resource('task',TaskController::class);
    Route::get('list',[TaskController::class,'list'])->name('task.list');
    Route::get('details',[TaskController::class,'details'])->name('task.details');

    Route::get('kanban',[KanbanController::class,'index'])->name('kanban.index');
    Route::post('kanban-update',[KanbanController::class,'update'])->name('kanban.update');


