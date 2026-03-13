<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\ReleaseController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [WebsiteController::class, 'index'])
    ->name('home');

Route::get('/page/{pageSlug}', [WebsiteController::class, 'page'])
    ->name('home.page');

Route::get('/publications/{publicationId}', [WebsiteController::class, 'publications'])
    ->name('home.publications');

Route::get('/publications/release/{releaseId}', [WebsiteController::class, 'release'])
    ->name('home.release');

Route::get('/publications/release/article/{articleId}', [WebsiteController::class, 'article'])
    ->name('home.article');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin')->group(function () {
        Route::prefix('control-panel')->name('control-panel.')->group(function () {
            Route::prefix('publications')->name('publications.')->group(function () {
                Route::get('/', [PublicationController::class, 'index'])->name('index');
                Route::get('/create', [PublicationController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [PublicationController::class, 'create'])->name('edit');
                Route::post('/save', [PublicationController::class, 'saveOrUpdate'])->name('save');
                Route::put('/update/{id}', [PublicationController::class, 'saveOrUpdate'])->name('update');
                Route::get('/show/{id}', [PublicationController::class, 'show'])->name('show');
                Route::delete('/delete/{id}', [PublicationController::class, 'delete'])->name('delete');
            });

            Route::prefix('releases')->name('releases.')->group(function () {
                Route::get('/', [ReleaseController::class, 'index'])->name('index');
                Route::get('/create', [ReleaseController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [ReleaseController::class, 'create'])->name('edit');
                Route::post('/save', [ReleaseController::class, 'saveOrUpdate'])->name('save');
                Route::put('/update/{id}', [ReleaseController::class, 'saveOrUpdate'])->name('update');
                Route::get('/show/{id}', [ReleaseController::class, 'show'])->name('show');
                Route::delete('/delete/{id}', [ReleaseController::class, 'delete'])->name('delete');
            });

            Route::prefix('articles')->name('articles.')->group(function () {
                Route::get('/', [ArticleController::class, 'index'])->name('index');
                Route::get('/create', [ArticleController::class, 'create'])->name('create');
                Route::get('/edit/{id}', [ArticleController::class, 'create'])->name('edit');
                Route::post('/save', [ArticleController::class, 'saveOrUpdate'])->name('save');
                Route::put('/update/{id}', [ArticleController::class, 'saveOrUpdate'])->name('update');
                Route::get('/show/{id}', [ArticleController::class, 'show'])->name('show');
                Route::delete('/delete/{id}', [ArticleController::class, 'delete'])->name('delete');
            });
        });
    });
});
require __DIR__.'/auth.php';
