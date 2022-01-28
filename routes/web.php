<?php

use App\Http\Controllers\{ArtController, ArtistController, CategoryController, CommentController, DashboardController, HomeController};
use Illuminate\Support\Facades\{Auth, Route};

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [HomeController::class, 'category'])->name('categories');

Route::prefix('artwork')->group(function () {
    Route::get('/', [HomeController::class, 'artwork'])->name('artworks');
    Route::get('/{category:slug}/category', [HomeController::class, 'sortByCategory'])->name('sort-category');
    Route::get('/{art}/detail', [HomeController::class, 'detail'])->name('detail-art');
    Route::get('/{art}/download', [HomeController::class, 'download'])->name('download');
});
Route::get('/users/{user}', [HomeController::class, 'user'])->name('users');
Route::put('/user/{user}/update', [HomeController::class, 'editUser'])->name('edit-user');
Route::prefix('artwork')->middleware('auth')->group(function () {
    Route::get('/upload', [HomeController::class, 'upload'])->name('upload-artwork')->withoutMiddleware('auth');
    Route::post('/upload', [HomeController::class, 'createArt'])->withoutMiddleware('auth');
    Route::get('/{art}/edit', [HomeController::class, 'editView'])->name('edit-artwork');
    Route::put('/{art}/edit', [HomeController::class, 'editArt']);
    Route::delete('/{art}/delete', [HomeController::class, 'deleteArt'])->name('delete-artwork');
});

Route::prefix('comment')->group(function () {
    Route::post('/create', [CommentController::class, 'store'])->name('post-comment');
    Route::put('/{comment}/edit', [CommentController::class, 'update'])->name('edit-comment')->middleware('auth');
    Route::delete('/{comment}/delete', [CommentController::class, 'destroy'])->name('delete-comment')->middleware('auth');
});

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('category');
        Route::post('/create', [CategoryController::class, 'store'])->name('create-category');
        Route::put('/{category}/edit', [CategoryController::class, 'update'])->name('edit-category');
        Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])->name('delete-category');
    });

    Route::prefix('art')->group(function () {
        Route::get('/', [ArtController::class, 'index'])->name('art');
        Route::get('/create', [ArtController::class, 'create'])->name('create-art');
        Route::post('/create', [ArtController::class, 'store']);
        Route::get('/{art}/edit', [ArtController::class, 'edit'])->name('edit-art');
        Route::put('/{art}/edit', [ArtController::class, 'update']);
        Route::delete('/{art}/delete', [ArtController::class, 'destroy'])->name('delete-art');
    });

    Route::prefix('artist')->group(function () {
        Route::get('/', [ArtistController::class, 'index'])->name('artist');
        Route::delete('/{artist}/delete', [ArtistController::class, 'destroy'])->name('delete-artist');
    });
});
