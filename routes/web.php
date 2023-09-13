<?php

use App\Http\Controllers\ExpensesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReportController;



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
    return view('auth/login');
});

Route::get('/register', [RegisterController::class, 'show']);;
    
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'show']);
    
Route::post('/login', [LoginController::class, 'login']);

Route::get('/home', [homeController::class, 'index']);

Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/expenses/create', [ExpensesController::class, 'index']);

Route::get('/budget', [ExpensesController::class, 'showBudget']); //Ruta para el form insertar Budget

Route::get('/analytics', [ExpensesController::class, 'showAnalytics']); //Ruta para analytics modulo

Route::post('/budget', [ExpensesController::class, 'storeBudget']); // Form insert-budget

Route::get('/budget/{id}', [ExpensesController::class,'editBudget']); //edit Budget

Route::put('/budget/{id}', [ExpensesController::class,'updateBudget']); // update Budget

Route::post('/expenses/create', [ExpensesController::class, 'store']);

Route::get('/expenses/view', [ExpensesController::class, 'show']);

Route::get('/expenses/{id}', [ExpensesController::class,'edit']);

Route::put('/expenses/{id}', [ExpensesController::class,'update']);

Route::put('/expenses/{id}/status', [ExpensesController::class,'updateStatus']); // Ruta para actualizar el estado Activo/Inactivo

Route::get('/reports', [ReportController::class, 'show']);







