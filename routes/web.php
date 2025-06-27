<?php

use App\Http\Controllers\AppealController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'index'])->name('home');

# About
Route::get('/about', [PageController::class, 'about'])
    ->name('about');
Route::get('/about/docs', [PageController::class, 'documents'])
    ->name('about.docs');
Route::get('/about/msk', [PageController::class, 'msk'])
    ->name('about.msk');
Route::get('/about/ecohouse', [PageController::class, 'ecohouse'])
    ->name('about.ecohouse');
Route::get('/about/disclosure', [PageController::class, 'disclosure'])
    ->name('about.disclosure');

Route::get('/news', [NewsController::class, 'index'])
    ->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])
    ->name('news.show');

Route::get('/contacts', [ContactController::class, 'index'])
    ->name('contacts');

Route::get('/feedback', [ContactController::class, 'form'])
    ->name('feedback.form');
Route::post('/feedback',  [ContactController::class, 'submit'])
    ->name('feedback.submit');

Route::get('/appeal',  [AppealController::class, 'create'])
    ->name('appeal.create');
Route::post('/appeal', [AppealController::class, 'store'])
    ->name('appeal.store');

# Clients
Route::get('/clients/activity', [PageController::class, 'activity'])
    ->name('clients.activity');
Route::get('/clients/contract',   [PageController::class, 'contract'])
    ->name('clients.contract');
Route::get('/clients/schedule',   [PageController::class, 'schedule'])
    ->name('clients.schedule');

Route::get('/media/photos', [PageController::class, 'photos'])
    ->name('media.photos');
Route::get('/media/videos', [PageController::class, 'videos'])
    ->name('media.videos');

Route::get('/privacy', [PageController::class, 'privacy'])->name('about.privacy');

