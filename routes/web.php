<?php

use Illuminate\Support\Facades\Route;
use App\Mail\ProductAdd;
use App\Notifications\EditProduct;
use App\Http\Controllers\MainController;
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

Route::get('/', [MainController::class, "welcome"])->name("welcome");;

Route::middleware(["auth","isAdmin"])->prefix("admin")->group(function(){
    Route::resource("products",ProductController::class);
    Route::get("export-products",[MainController::class, "exportProducts"])->name("export-products");
});

Route::get('list-products',[ProductController::class, "index"])->name("list-products");

Route::get('add-product',[MainController::class, "addProduct"])->name("add-product");

Route::get('add-category',[MainController::class, "addCategory"])->name("add-category");

Route::get('update-product/{id}',[MainController::class, "updateProduct"])->name("update-product");

Route::get('update-product2',[MainController::class, "updateProduct2"])->name("update-product2");

Route::get('delete-product/{id}',[MainController::class, "deleteProduct"])->name("delete-product");

Route::get('get-product/{product}',[MainController::class, "getProduct"])->name("get-product");

Route::get('add-command',[MainController::class, "addCommand"])->name("add-command");

Route::get('test-collection',[MainController::class, "testCollection"])->name("test-collection");

Route::get('test-mail',function(){
    return new ProductAdd;
})->name("test-mail");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
