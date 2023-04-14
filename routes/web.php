<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ProductController;
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

// Home (Trang Chủ)
Route::get('home', [HomeController::class, 'index'])->name('home');

// Users (create, edit) and check login
Route::prefix('users')->group(function (){
    Route::get('login', [UsersController::class, 'login'])->name('indexLogin');
    Route::post('login', [UsersController::class, 'handleLogin']);
    Route::post('logout', [UsersController::class, 'handleLogout'])->name('postLogout');

    // xử lý form register
    Route::get('register', [UsersController::class, 'register'])->name('UsersRegister');
    Route::post('register', [UsersController::class, 'insertUser']);

    // xử lý form forgotPassword
    Route::get('forgotPassword', [UsersController::class, 'getUpdateUser'])->name('ForgotPassword');
    Route::post('forgotPassword', [UsersController::class, 'updateUser']);
});


// Chức năng phần mềm (main)
Route::middleware('auth.admin')->prefix('admin')->group(function () {
    // Trang chủ
    Route::get('dashboard', [MainController::class, 'index'])->name('indexAdmin');

    //========================
    // Product
    Route::get('getProducts', [ProductController::class, 'getProducts'])->name('getProducts');

    // add products
    Route::get('addProduct', [ProductController::class, 'getAddProducts'])->name('addProducts');
    Route::post('addProduct', [ProductController::class, 'AddProducts'])->name('post-addProducts');

    // edit products
    Route::get('editProduct/{id?}', [ProductController::class, 'getEditProducts'])->name('editProducts');
    Route::post('editProduct', [ProductController::class, 'editProduct'])->name('post-edit');

    //delete products
    Route::get('getDeleteProduct/{id?}', [ProductController::class, 'getDeleteProducts'])->name('deleteProducts');
    Route::post('deleteProduct', [ProductController::class, 'deleteProduct'])->name('post-delete');

    //import file and export file products
    Route::get('import', [ProductController::class, 'getimportFilePrduct'])->name('importfileProducts');
    Route::post('import', [ProductController::class, 'importFilePrduct']);

    // download template imoort products
    Route::get('download-templates', [ProductController::class, 'downLoadTemplate'])->name('Template');

    // export product list
    Route::get('export', [ProductController::class, 'exportFilePrduct'])->name('exportfileProducts');


    //============================
    // Khách hàng
    Route::get('getCustomers', [CustomerController::class, 'getCustomers'])->name('getCustomers');
    Route::get('addCustomers', [CustomerController::class, 'getAddCustomers'])->name('addCustomers');
    Route::post('addCustomers', [CustomerController::class, 'addCustomers'])->name('post-addCustomers');


    // edit customer
    Route::get('editCustomer/{id?}', [CustomerController::class, 'getEditCustomers'])->name('editCustomers');
    Route::post('editCustomer', [CustomerController::class, 'editCustomer'])->name('post-editCustomers');

    //delete customer
    Route::get('getDeleteCustomer/{id?}', [CustomerController::class, 'getDeleteProducts'])->name('deleteCustomers');
    Route::post('deleteCustomer', [CustomerController::class, 'deleteProduct'])->name('post-delete');


    // Order
    Route::get('getOrders', [OrderController::class, 'getOrders'])->name('getOrders');

    Route::get('addOrders', [OrderController::class, 'getAddOrders'])->name('getAddOrders');
    Route::post('addOrders', [OrderController::class, 'addOrders'])->name('post-Orders');

    Route::get('ordersDetail/{id?}', [OrderController::class, 'ordersDetail'])->name('getOrderDetail');

    //Report
    Route::get('Bao-Cao', [ReportController::class, 'getRevenue'])->name('revenue');
})->name('admin');
