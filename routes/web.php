<?php

use App\Livewire\Gallery\ListGalleries;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\ProjectViewsMiddleware;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\About;
use App\Livewire\Articles\ListArticles;
use App\Livewire\Articles\ViewArticle;
use App\Livewire\Media;
use App\Livewire\ContactUs;
use App\Livewire\Profile\ChangePassword;
use App\Livewire\Profile\Profile;
use App\Livewire\Projects\ListProjects;
use App\Livewire\Projects\ViewProject;
use App\Livewire\Gallery\ViewGallery;
use App\Livewire\Profile\Donations;
use App\Http\Middleware\AffiliateMiddleware;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Payment\Success;
use App\Livewire\Payment\Failed;
use App\Livewire\PrivacyPolicy;
use App\Livewire\Auth\ResetPassword;

Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/privacy-policy', PrivacyPolicy::class)->name('privacy-policy');
Route::group([
    'prefix' => 'galleries',
    'as' => 'galleries.',
], function () {
    Route::get('/', ListGalleries::class)->name('list');
    Route::get('/{gallery}', ViewGallery::class)->name('view');
});
Route::get('/contact', ContactUs::class)->name('contact');

Route::group([
    'prefix' => 'projects',
    'as' => 'projects.',
], function () {
    Route::get('{category}', ListProjects::class)->name('list');
    Route::get('/view/{project}', ViewProject::class)->name('view')->middleware([
        ProjectViewsMiddleware::class,
        AffiliateMiddleware::class
    ]);
});

Route::group(['prefix' => 'articles', 'as' => 'articles.'], function () {
    Route::get('/', ListArticles::class)->name('list');
    Route::get('/{article}', ViewArticle::class)->name('view');
});

Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => 'auth'], function () {
    Route::get('/edit', Profile::class)->name('edit');
    Route::get('/donations', Donations::class)->name('donations');
    Route::get('/change-password', ChangePassword::class)->name('change-password');
});

Route::post('callback', [PaymentController::class, 'callback'])->name('callback');
Route::group(['prefix' => 'payment', 'as' => 'payment.'], function () {
    Route::get('success', Success::class)->name('success');
    Route::get('failed', Failed::class)->name('failed');
});

Route::get('forgot-password', ForgotPassword::class)->name('forgot-password');
Route::get('reset/{token}', ResetPassword::class)->name('reset-password');


require __DIR__ . '/auth.php';
