<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

// 検索
Route::get('/list', [App\Http\Controllers\ProductsController::class, 'search'])->name('search');
// 詳細閲覧
Route::post('/detail{id}', [App\Http\Controllers\ProductsController::class, 'detail'])->name('detail');

// 商品編集
Route::get('/edit', [App\Http\Controllers\EditController::class, 'editForm'])->name('edit');
Route::post('/edit',[App\Http\Controllers\EditController::class, 'update'])->name('update');

// 削除
Route::post('/list{id}', [App\Http\Controllers\ProductsController::class, 'delete'])->name('delete');

// 商品追加
Route::get('/regist',[App\Http\Controllers\RegistController::class, 'showRegistForm'])->name('regist');
Route::post('/regist',[App\Http\Controllers\RegistController::class, 'registSubmit'])->name('submit');