<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\ProductListController;
use App\Http\Controllers\User\UserController;

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
//userRoute
Route::get('/', [UserController::class,'index'])->name('user.home');

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //ckechout

    Route::prefix('checkout')->group(function(){
        Route::post('/order',[CheckoutController::class,'store'])->name('checkout.store');
        Route::get('success',[CheckoutController::class,'success'])->name('checkout.success');
        Route::get('cancel',[CheckoutController::class,'cancel'])->name('checkout.cancel');

    });
});
//endUserRoute

//product list and filter
Route::prefix('products')->group(function(){
    Route::get('/',[ProductListController::class,'index'])->name('products.index');
});

//add to cart
Route::prefix('cart')->group(function(){
    Route::get('view', [CartController::class, 'view'])->name('cart.view');
    Route::post('store/{product}', [CartController::class, 'store'])->name('cart.store');
    Route::patch('update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('delete/{product}', [CartController::class, 'delete'])->name('cart.delete');
});


//adminRoute

Route::group(['prefix'=>'admin','middleware'=>'redirectAdmin'],function(){
    Route::get('/login',[AdminAuthController::class, 'showLoginForm' ])->name('admin.login');
    Route::post('/login',[AdminAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout',[AdminAuthController::class, 'logout'])->name('admin.logout');
});



Route::middleware(['auth','admin'])->prefix('admin')->group(function(){
    Route::get('/dasboard',[AdminController::class,'index'])->name('admin.dashboard');

    //product route

    Route::get('/products',[ProductController::class,'index'])->name('admin.products.index');
    Route::post('/products/store',[ProductController::class,'store'])->name('admin.products.store');
    Route::put('/products/update/{id}',[ProductController::class,'update'])->name('admin.products.update');
    Route::delete('/products/delete/{id}',[ProductController::class,'destroy'])->name('admin.products.delete');
    Route::delete('/products/image/{id}',[ProductController::class,'deleteImage'])->name('admin.product.deleteImage');

    //Category route

    Route::get('/categories',[CategoryController::class,'index'])->name('admin.categories.index');
    Route::post('/categories/store',[CategoryController::class,'store'])->name('admin.categories.store');
    Route::put('/categories/update/{id}',[CategoryController::class,'update'])->name('admin.categories.update');
    Route::delete('/categories/delete/{id}',[CategoryController::class,'destroy'])->name('admin.categories.delete');

    //Brand route

    Route::get('/brands',[BrandController::class,'index'])->name('admin.brands.index');
    Route::post('/brands/store',[BrandController::class,'store'])->name('admin.brands.store');
    Route::put('/brands/update/{id}',[BrandController::class,'update'])->name('admin.brands.update');
    Route::delete('/brands/delete/{id}',[BrandController::class,'destroy'])->name('admin.brands.delete');

});

//endAdminRoute
require __DIR__.'/auth.php';
