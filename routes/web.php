<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ItemsController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return redirect('/homePage');
});
Route::get('/homePage', [MainController::class,'showHomePage'])->name('homePage');
Route::get('/shop', [MainController::class,'showShopPage']);
Route::get('/register', [MainController::class,'showRegisterPage']);
Route::get('/detail/{id}', [MainController::class,'showDetailPage']);
Route::get('/cart', [CartController::class,'showCartPage'])->middleware('auth')->name('cart');
Route::get('/acart', [CartController::class,'showaCartPage'])->middleware('auth')->name('acart');
Route::get('/atransaction', [TransactionController::class,'showaTPage'])->middleware('auth')->name('atransactions');
Route::get('/aitems', [ItemsController::class,'showaIPage'])->middleware('auth')->name('aitems');
Route::get('/search', [MainController::class, 'search'])->name('search');
Route::get('/history', [MainController::class,'showHistoryPage'])->middleware('auth')->name('history');
Route::get('/sort-items', [MainController::class, 'sortItems'])->name('sortItems');
Route::get('/sort-transactions', [TransactionController::class, 'sortTransactions'])->name('sortTransactions');
Route::get('/toggle-add-item', [ItemsController::class, 'toggleAddItemForm'])->name('toggleAddItemForm');
Route::get('/edit-item/{id}', [ItemsController::class, 'toggleEditItemForm'])->name('toggleEditItemForm');
Route::get('/ausers', [UserController::class,'showaUPage'])->middleware('auth')->name('ausers');
Route::get('/edit-user/{id}', [UserController::class, 'toggleEditUserForm'])->name('toggleEditUserForm');
Route::get('/profile', [MainController::class,'showProfilePage'])->middleware('auth')->name('profile');

Route::post('/addToCart', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/updateCartQuantity', [CartController::class, 'updateCartQuantity'])->name('updateCartQuantity');
Route::post('/order', [TransactionController::class, 'store'])->name('order');
Route::post('/processOrder', [TransactionController::class, 'processOrder'])->name('processOrder');
Route::post('/cancelOrder', [TransactionController::class, 'cancelOrder'])->name('cancelOrder');
Route::post('/add-item', [ItemsController::class, 'store'])->name('storeItem');
Route::post('/cancel-edit-item-form', [ItemsController::class, 'cancelEditItemForm'])->name('cancelEditItemForm');
Route::post('/cancel-edit-user-form', [UserController::class, 'cancelEditUserForm'])->name('cancelEditUserForm');


Route::delete('/items/{id}', [ItemsController::class, 'destroy'])->name('deleteItem');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('deleteUser');

Route::put('/update-item/{id}', [ItemsController::class, 'updateItem'])->middleware('auth')->name('updateItem');
Route::put('/update-user/{id}', [UserController::class, 'updateUser'])->middleware('auth')->name('updateUser');
Route::put('/update-profile/{id}', [UserController::class, 'updateProfile'])->middleware('auth')->name('updateProfile');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
