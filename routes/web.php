<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\About;
use App\Livewire\Articles\ListArticles;
use App\Livewire\Articles\ViewArticle;
use App\Livewire\Media;
use App\Livewire\ContactUs;
use App\Livewire\Profile\ChangePassword;
use App\Livewire\Profile\Profile;

Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/media', Media::class)->name('media');
Route::get('/contact', ContactUs::class)->name('contact');
Route::group(['prefix' => 'articles', 'as' => 'articles.'], function () {
    Route::get('/', ListArticles::class)->name('list');
    Route::get('/{article}', ViewArticle::class)->name('view');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
    Route::get('/edit', Profile::class)->name('edit');
    Route::get('/change-password', ChangePassword::class)->name('change-password');
    // Route::get('/{article}', ViewArticle::class)->name('view');
});

Route::post('callback', [PaymentController::class, 'callback'])->name('callback');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__ . '/auth.php';
