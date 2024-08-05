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

// service
Route::get('admin/service', [ServiceController::class, 'index'])->name('service');
Route::get('admin/service/form', [ServiceController::class, 'create'])->name('service_form');
Route::get('admin/service/edit/{id}', [ServiceController::class, 'edit_form'])->name('service_edit');
Route::post('admin/service/submit', [ServiceController::class, 'store'])->name('service_submit');
Route::post('admin/service/delete/{id}', [ServiceController::class, 'destroy'])->name('service_delete');

// article
Route::get('admin/article', [ArticleController::class, 'index'])->name('article');
Route::get('admin/article/form', [ArticleController::class, 'create'])->name('article_form');
Route::get('admin/article/edit/{id}', [ArticleController::class, 'edit'])->name('article_edit');
Route::post('admin/article/submit', [ArticleController::class, 'store'])->name('article_submit');
Route::post('admin/article/delete/{id}', [ArticleController::class, 'destroy'])->name('article_delete');

// portfolio
Route::get('admin/portfolio', [PortfolioController::class, 'index'])->name('portfolio');
Route::get('admin/portfolio/form', [PortfolioController::class, 'create'])->name('portfolio_form');
Route::get('admin/portfolio/edit/{id}', [PortfolioController::class, 'edit'])->name('portfolio_edit');
Route::post('admin/portfolio/submit', [PortfolioController::class, 'store'])->name('portfolio_submit');
Route::post('admin/portfolio/delete/{id}', [PortfolioController::class, 'destroy'])->name('portfolio_delete');
