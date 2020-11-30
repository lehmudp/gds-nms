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

// VIEW SECTION
Route::get('/', ['as'=>'index', function () {
    return view('index');
}]);
Route::get('/customer', ['as'=>'customer', function () {
    return view('manage.customer');
}]);
Route::get('/supplier', ['as'=>'supplier', function () {
    return view('manage.supplier');
}]);


// API SECTION
// Circuit
Route::post('/import', [CircuitController::class, 'import']);
Route::get('api/circuit/all', [CircuitController::class, 'showAll']);
Route::get('api/circuit/company/{name}', [CircuitController::class, 'getCircuitByCompany']);
//Customer
Route::get('api/customer/all', [CircuitController::class, 'showAllCustomers']);
// Supplier
Route::get('api/supplier/all', [SupplierController::class, 'index']);
Route::get('api/supplier/group', [SupplierController::class, 'showAll']);

