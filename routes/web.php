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

Route::get('/circuit/edit/{id}', ['as'=>'customer-form', function () {
    return view('manage.customer-form');
}]);

Route::get('/circuit/new', ['as'=>'customer-form', function () {
    return view('manage.customer-form');
}]);

Route::get('/supplier/edit/{id}', ['as'=>'supplier-form', function () {
    return view('manage.supplier-form');
}]);

Route::get('/supplier/new', ['as'=>'supplier-form', function () {
    return view('manage.supplier-form');
}]);

// API SECTION
// Circuit
Route::post('/import', [CircuitController::class, 'import']);
Route::get('api/circuit/group', [CircuitController::class, 'getCustomerGrouped']);
Route::get('api/circuit/{id}', [CircuitController::class, 'getCircuitById']);
Route::post('api/circuit/update', [CircuitController::class, 'updateOrCreateCircuit']);
Route::get('api/circuit/company/{name}', [CircuitController::class, 'getCircuitByCompany']);

//Customer
Route::get('api/customer/all', [CircuitController::class, 'getCustomers']);
// Supplier
Route::get('api/supplier/all', [SupplierController::class, 'index']);
Route::get('api/supplier/group', [SupplierController::class, 'getSupplierByGroup']);
Route::get('api/supplier/{id}', [SupplierController::class, 'getSupplierById']);
Route::post('api/supplier/update', [SupplierController::class, 'updateOrCreateSupplier']);
Route::delete('api/supplier/delete/{id}', [SupplierController::class, 'delete']);