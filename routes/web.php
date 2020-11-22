<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CircuitController;
use App\Http\Controllers\SupplierController;

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
// Circuit
Route::post('/import', [CircuitController::class, 'import'])->name('import');
Route::get('api/circuit/all', [CircuitController::class, 'showAll'])->name('all');
// Supplier
Route::get('api/supplier/all', [SupplierController::class, 'index'])->name('index');

