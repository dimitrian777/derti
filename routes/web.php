<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Front\HomeController;
// use App\Http\Controllers\Admin\MainController;
// use App\Http\Controllers\Admin\CategoryController;
// use App\Http\Controllers\Admin\TagController;
// use App\Http\Controllers\Admin\PostController;
// use App\Http\Controllers\UserController;
// use App\Http\Middleware\AdminMiddleware;
// use App\Http\Middleware\RedirectIfAuthenticated;

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

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/article', [HomeController::class,'show'])->name('single');

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
	Route::get('/',[MainController::class,'index'])->name('admin.index');
	Route::resource('/categories', CategoryController::class);
	Route::resource('/tags', TagController::class);
	Route::resource('/posts', PostController::class);
});

Route::group(['middleware' => 'guest'], function () {
	Route::get('/register',[UserController::class,'create'])->name('register.create');
   Route::post('/register',[UserController::class,'store'])->name('register.store');
   Route::get('/login',[UserController::class,'loginForm'])->name('login.create');
   Route::post('/login',[UserController::class,'login'])->name('login');
});


Route::get('/logout',[UserController::class,'logout'])->name('logout')->middleware('auth');

// 1.вариант
// Роутинг полностью и корректно работает но не закрыта админка,
// то есть и гость и авторизованый юзер и авторизованый админ могут зайти в админку

// Route::prefix('admin')->group(
// function () {
// 	Route::get('/',[MainController::class,'index'])->name('admin.index');
// 	Route::resource('/categories', CategoryController::class);
// 	Route::resource('/tags', TagController::class);
// 	Route::resource('/posts', PostController::class);
// });

// 2.вариант
// Вообще не хрена не работает получаю ошибку - require(admin): Failed to open stream: No such file or directory

// Route::prefix('admin')->group(['middleware'=>'admin'],
// function () {
// 	Route::get('/',[MainController::class,'index'])->name('admin.index');
// 	Route::resource('/categories', CategoryController::class);
// 	Route::resource('/tags', TagController::class);
// 	Route::resource('/posts', PostController::class);
// });

// 3.вариант


