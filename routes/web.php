<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CircuitController;

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

Route::get('/', ['as'=>'index', function () {
    return view('index');
}]);

Route::get('/customer', ['as'=>'customer', function () {
    return view('manage.customer');
}]);

Route::post('/import', [CircuitController::class, 'import'])->name('import');
Route::get('api/circuit/all', [CircuitController::class, 'showAll'])->name('all');
