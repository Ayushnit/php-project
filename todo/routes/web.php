<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

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
    return view('welcome');
});

Route::get('/task',[TasksController::class, 'GetAllTasks']);
Route::post('/task',[TasksController::class, 'CreateTask']);
Route::delete('/task/{id}', [TasksController::class, 'DeleteTask']);
Route::patch('/task/{id}', [TasksController::class, 'UpdateStatus']);
