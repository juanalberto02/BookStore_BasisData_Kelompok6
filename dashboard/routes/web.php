<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\OrderDetailsController;
use App\Http\Controllers\ReturnController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('login');
// });

Route::get('/', [LoginController::class,'login'])->name('login');
Route::post('/authentication', [LoginController::class,'authentication'])->name('authentication');
Route::get('/logout', [LoginController::class,'logout'])->name('logout');


Route::group(['middleware' => ['auth','hakakses:master']], function(){
    Route::get('/analytics', [AnalyticsController::class, "index"])->name("analytics");
    Route::get('/analytics/filter', [AnalyticsController::class, "index"])->name('analytics.filter');
    Route::get('/stores', [StoreController::class, "index"])->name("stores");
    Route::get('/categories', [CategoriesController::class, "index"])->name("categories");
    Route::get('/addcategories', [CategoriesController::class, "addcategories"])->name("addcategories");
    Route::post('/insertcategories', [CategoriesController::class, "insertcategories"])->name("insertcategories");
    Route::get('/editcategories/{id}', [CategoriesController::class, "editcategories"])->name("editcategories");
    Route::post('/updatecategories/{id}', [CategoriesController::class, "updatecategories"])->name("updatecategories");
    Route::get('/deletecategories/{id}', [CategoriesController::class, "deletecategories"])->name("deletecategories");
    Route::get('/books', [BooksController::class, "index"])->name("books");
    Route::get('/addbooks', [BooksController::class, "addbooks"])->name("addbooks");
    Route::post('/insertbooks', [BooksController::class, "insertbooks"])->name("insertbooks");
    Route::get('/editbooks/{id}', [BooksController::class, "editbooks"])->name("editbooks");
    Route::post('/updatebooks/{id}', [BooksController::class, "updatebooks"])->name("updatebooks");
    Route::get('/deletebooks/{id}', [BooksController::class, "deletebooks"])->name("deletebooks");
    Route::get('/return', [ReturnController::class, 'showReturnPage'])->name('return');
    Route::prefix('returns')->group(function () {
        Route::post('/accept/{id}', [ReturnController::class, 'accept'])->name('returns.accept');
        Route::post('/reject/{id}', [ReturnController::class, 'reject'])->name('returns.reject');
    });
    // Add this if you want to use the routes with a form method spoofing (e.g., in your blade file)
    Route::bind('id', function ($id) {
        return (int) $id;
    });
});

Route::group(['middleware' => ['auth','hakakses:userA']], function(){
    Route::get('/analytics_store_A', [AnalyticsController::class, "analyticsA"])->name("analyticsA");
    Route::get('/books_store_A', [BooksController::class, "booksA"])->name("booksA");
    Route::get('/customersA', [CustomersController::class, 'indexA'])->name('customersA.indexA');
    Route::get('/addcustomersA', [CustomersController::class, 'createA'])->name('customersA.create');
    Route::get('/deletecustomersA/{id}', [CustomersController::class, 'deletecustomersA'])->name('customersA.delete');
    Route::post('/insertcustomersA', [CustomersController::class, 'storeA'])->name('customersA.storeA'); // Use 'store' method here
    Route::get('/editcustomersA/{id}', [CustomersController::class, 'editcustomersA'])->name('customersA.edit');
    Route::post('/updatecustomersA/{id}', [CustomersController::class, 'updatecustomersA'])->name('customersA.update');
    Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
    Route::get('/ordersA', [OrderController::class, 'indexA'])->name('ordersA.indexA');
    Route::post('/add-orderA', [OrderController::class, 'addOrderA'])->name('orderA.addA'); // Use 'delete' method here
    Route::get('/orderlistA', [OrderListController::class, 'indexA'])->name('orderlistA');
    Route::get('/ordersA/{id}', 'OrderController@showA')->name('orders.showA');
    Route::get('/orderdetailsA/{id}', [OrderDetailsController::class, 'showA'])->name('orderdetailsA.showA');
    Route::get('/returnA', [ReturnController::class, 'showReturnAPage'])->name('returnA.showReturnAPage');
    Route::get('/addreturnA', [ReturnController::class, 'createA'])->name('returnA.create');
    Route::post('/insertreturnA', [ReturnController::class, 'storeA'])->name('returnA.storeA');



});

Route::group(['middleware' => ['auth','hakakses:userB']], function(){
    Route::get('/analytics_store_B', [AnalyticsController::class, "analyticsB"])->name("analyticsB");
    Route::get('/books_store_B', [BooksController::class, "booksB"])->name("booksB");
    Route::get('/customersB', [CustomersController::class, 'indexB'])->name('customersB.indexB');
    Route::get('/addcustomersB', [CustomersController::class, 'createB'])->name('customersB.create');
    Route::get('/deletecustomersB/{id}', [CustomersController::class, 'deletecustomersB'])->name('customersB.delete');
    Route::post('/insertcustomersB', [CustomersController::class, 'storeB'])->name('customersB.storeB'); // Use 'store' method here
    Route::get('/editcustomersB/{id}', [CustomersController::class, 'editcustomersB'])->name('customersB.edit');
    Route::post('/updatecustomersB/{id}', [CustomersController::class, 'updatecustomersB'])->name('customersB.update');
    Route::delete('/customers/{id}', [CustomersController::class, 'destroy'])->name('customers.destroy');
    Route::get('/ordersB', [OrderController::class, 'indexB'])->name('ordersB.indexB');
    Route::post('/add-orderB', [OrderController::class, 'addOrderB'])->name('orderB.addB'); // Use 'delete' method here
    Route::get('/orderlistB', [OrderListController::class, 'indexB'])->name('orderlistB');
    Route::get('/ordersB/{id}', 'OrderController@showB')->name('orders.showB');
    Route::get('/orderdetailsB/{id}', [OrderDetailsController::class, 'showB'])->name('orderdetailsB.showB');
    Route::get('/returnB', [ReturnController::class, 'showReturnBPage'])->name('returnB.showReturnBPage');
    Route::get('/addreturnB', [ReturnController::class, 'createB'])->name('returnB.create');
    Route::post('/insertreturnB', [ReturnController::class, 'storeB'])->name('returnB.storeB');
});




Route::get('/add_user', [LoginController::class,'add_user'])->name('add_user');
Route::post('/add_user_input', [LoginController::class,'add_user_input'])->name('add_user_input');


















