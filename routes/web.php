<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;

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

// Ruta principal
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rutes d'autenticació
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('login.process');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('register.process');

// Rutes de contacte
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Rutes de menú
Route::get('/menu', [MenuController::class, 'menu'])->name('menu');
Route::get('/menu-admin', [MenuController::class, 'menuAdmin'])->name('menu.admin')->middleware('admin');

// Rutes d'administració
Route::get('/admin', [DashboardController::class, 'index'])->name('dashboard')->middleware('admin');

//Rutes de gestió d'usuaris
Route::get('/admin/users', [DashboardController::class,'users'])->name('admin.users')->middleware('admin');
Route::get('/admin/users/{id}', [DashboardController::class,'user'])->name('admin.user')->middleware('admin');
Route::post('/admin/users/{id}/update', [DashboardController::class,'updateUser'])->name('admin.users.update')->middleware('admin');

//Rutes de gestió de productes (consolidades al MenuController)
Route::get('/admin/products', [MenuController::class, 'menuAdmin'])->name('admin.products')->middleware('admin');

//Creació, actualització i eliminació de productes
Route::post('/admin/products/createItem', [MenuController::class, 'createProduct'])->name('admin.products.create')->middleware('admin');
Route::post('/admin/products/updateItem', [MenuController::class, 'updateProduct'])->name('admin.products.update')->middleware('admin');
Route::post('/admin/products/deleteItem', [MenuController::class, 'deleteProduct'])->name('admin.products.delete')->middleware('admin');

//Creació, actualització i eliminació de categories de productes
Route::post('/admin/products/createCategory', [MenuController::class, 'createCategory'])->name('admin.products.createCategory')->middleware('admin');
Route::post('/admin/products/updateCategory', [MenuController::class, 'updateCategory'])->name('admin.products.updateCategory')->middleware('admin');
Route::post('/admin/products/deleteCategory', [MenuController::class, 'deleteCategory'])->name('admin.products.deleteCategory')->middleware('admin');

//Creació, actualització i eliminació d'etiquetes de productes
Route::post('/admin/products/createLabel', [MenuController::class, 'createLabel'])->name('admin.products.createLabel')->middleware('admin');
Route::post('/admin/products/updateLabel', [MenuController::class, 'updateLabel'])->name('admin.products.updateLabel')->middleware('admin');
Route::post('/admin/products/deleteLabel', [MenuController::class, 'deleteLabel'])->name('admin.products.deleteLabel')->middleware('admin');

// API endpoints per obtenir dades filtrades
Route::get('/api/products/category/{categoryId}', [MenuController::class, 'getProductsByCategory'])->name('api.products.by-category')->middleware('admin');
Route::get('/api/products/label/{labelId}', [MenuController::class, 'getProductsByLabel'])->name('api.products.by-label')->middleware('admin');
Route::get('/api/products/{productId}', [MenuController::class, 'getProductDetails'])->name('api.products.details')->middleware('admin');

// Ruta per canviar el locale de Laravel via AJAX
Route::get('/set-locale/{lang}', function ($lang) {
    $supported = ['en','ca','es','fr','ds'];
    if (in_array($lang, $supported)) {
        session(['locale' => $lang]);
        \App::setLocale($lang);
    }
    return response()->json(['locale' => app()->getLocale()]);
});
