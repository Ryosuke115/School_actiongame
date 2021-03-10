<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::get('/task/upcreate', [TaskController::class, 'index']);
Route::get('/log', [TaskController::class, 'log_page']);
Route::get('/game', [TaskController::class, 'jsjs']);
Route::get('/sample', [TaskController::class, 'sample']);
Route::post('/upcreate', [TaskController::class, 'create']);
Route::post('/dateup', [TaskController::class, 'save_daily']);


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
