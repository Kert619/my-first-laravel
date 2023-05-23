<?php

use Illuminate\Support\Facades\Route;


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


// PUBLIC
Route::get('/', "ProductsController@welcome");

// PRODUCTS
Route::get('/products', "ProductsController@search")->name('products.search');
Route::get('/products/{id}', "ProductsController@get")->name('products.get');
Route::post('/products', "ProductsController@save")->name('products.save');
Route::put('/products/{id}', "ProductsController@update")->name('products.update');
Route::delete('/products/{id}', "ProductsController@delete")->name('products.delete');

//CATEGORIES
Route::get('/categories',"CategoriesController@search")->name('categories.search');
Route::get('/categories/{id}', "CategoriesController@get")->name('categories.get');
Route::post('/categories','CategoriesController@save')->name("categories.save");
Route::put('/categories/{id}',"CategoriesController@update")->name('categories.update');
Route::delete('/categories/{id}', "CategoriesController@delete")->name('categories.delete');