<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UsersController;
use Monolog\Handler\RotatingFileHandler;

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
    Route::get('getProducts', [MainController::class, 'getProducts'])->name('getProducts');

    // add products
    Route::get('addProduct', [MainController::class, 'getAddProducts'])->name('addProducts');
    Route::post('addProduct', [MainController::class, 'AddProducts']);

    // edit products
    Route::get('editProduct/{id?}', [MainController::class, 'getEditProducts'])->name('editProducts');
    Route::post('editProduct', [MainController::class, 'editProduct'])->name('post-edit');

    //delete products
    Route::get('getDeleteProduct/{id?}', [MainController::class, 'getDeleteProducts'])->name('deleteProducts');
    Route::post('deleteProduct', [MainController::class, 'deleteProduct'])->name('post-delete');

    //import file and export file products
    Route::get('import', [MainController::class, 'getimportFilePrduct'])->name('importfileProducts');
    Route::post('import', [MainController::class, 'importFilePrduct']);

    // download template imoort products
    Route::get('download-templates', [MainController::class, 'downLoadTemplate'])->name('Template');

    // export product list
    Route::get('export', [MainController::class, 'exportFilePrduct'])->name('exportfileProducts');


    //============================
    // Khách hàng
    Route::get('getCustomers', [MainController::class, 'getCustomers'])->name('getCustomers');
    Route::get('addCustomers', [MainController::class, 'getAddCustomers'])->name('addCustomers');
    Route::post('addCustomers', [MainController::class, 'addCustomers'])->name('post-addCustomers');


    // edit customer
    Route::get('editCustomer/{id?}', [MainController::class, 'getEditCustomers'])->name('editCustomers');
    Route::post('editCustomer', [MainController::class, 'editCustomer'])->name('post-editCustomers');

    //delete customer
    Route::get('getDeleteCustomer/{id?}', [MainController::class, 'getDeleteProducts'])->name('deleteCustomers');
    Route::post('deleteCustomer', [MainController::class, 'deleteProduct'])->name('post-delete');


    // Order
    Route::get('getOrders', [MainController::class, 'getOrders'])->name('getOrders');

    Route::get('addOrders', [MainController::class, 'getAddOrders'])->name('getAddOrders');
    Route::post('addOrders', [MainController::class, 'addOrders'])->name('post-Orders');

    Route::get('ordersDetail/{id?}', [MainController::class, 'ordersDetail'])->name('getOrderDetail');

    //Report
    Route::get('Bao-Cao', [MainController::class, 'getRevenue'])->name('revenue');
})->name('admin');
