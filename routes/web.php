<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');

// admin
Route::get('/admin', [LoginController::class, 'admin_index'])->name('admin');
Route::get('admin/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('admin/article', [ArticleController::class, 'index'])->name('article');

// service
Route::get('admin/service', [ServiceController::class, 'index'])->name('service');
Route::get('admin/service/form', [ServiceController::class, 'create'])->name('service_form');
Route::get('admin/service/edit/{id}', [ServiceController::class, 'edit_form'])->name('service_edit');
Route::post('admin/service/submit', [ServiceController::class, 'store'])->name('service_submit');
Route::post('admin/service/delete/{id}', [ServiceController::class, 'destroy'])->name('service_delete');