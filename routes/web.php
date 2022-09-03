<?php

use App\Http\Controllers\HomeController;
use App\Models\Guardian;
use Illuminate\Support\Facades\Route;
use Spatie\QueryBuilder\QueryBuilder;

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
Route::get('/', function () {
    return view('welcome');
});


Route::get('/user',[HomeController::class,'index']);
Route::get('/search',[HomeController::class,'search']);

Route::get('/show',[HomeController::class,'show_content']);
Route::get('/filter-data',[HomeController::class,'show_filter_data']);

//Autocomplete
Route::get('/name-auto-suggestion', [HomeController::class, 'name_auto_suggestion'])->name('name-auto-suggestion');
Route::get('/email-auto-suggestion', [HomeController::class, 'email_auto_suggestion'])->name('email-auto-suggestion');
