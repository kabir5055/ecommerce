<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EcommerceController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',[EcommerceController::class,'index'])->name('home');
Route::get('/single-product/{id}',[EcommerceController::class,'singleProduct'])->name('single.product');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::get('/dashboard',[AdminController::class,'index'])->name('dashboard');

    Route::get('/add-product',[ProductController::class,'addProduct'])->name('add.product');
    Route::post('/new-product',[ProductController::class,'saveProduct'])->name('new.product');
    Route::get('/manage-product',[ProductController::class,'manageProduct'])->name('manage.product');
    Route::get('/status/{id}',[ProductController::class,'status'])->name('status');
    Route::post('/delete-product',[ProductController::class,'deleteProduct'])->name('delete.product');
    Route::post('/edit-product',[ProductController::class,'editProduct'])->name('edit.product');
    Route::post('/update-product',[ProductController::class,'updateProduct'])->name('update.product');

    Route::get('/manage-user',[UserController::class,'manageUser'])->name('manage.user');
    Route::get('/edit-user/{id}',[UserController::class,'editUser'])->name('edit.user');
    Route::post('/update-user',[UserController::class,'updateUser'])->name('update.user');
    Route::post('/delete-user',[UserController::class,'deleteUser'])->name('delete.user');
});
