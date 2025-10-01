<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TeamController;
use App\Livewire\About;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Service;
use App\Livewire\Admin\Service\Create;
use App\Livewire\Admin\Service\Edit;
use App\Livewire\Admin\Service\Index;
use App\Livewire\Admin\Service\View;
use App\Livewire\Home;
use App\Livewire\Services;
use App\Livewire\Portfolio;
use App\Livewire\Testimonials;
use App\Livewire\Blog;
use App\Livewire\Contact;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;
use Phiki\Phast\Root;

Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/services', Services::class)->name('services');
Route::get('/portfolio', Portfolio::class)->name('portfolio');
Route::get('/testimonials', Testimonials::class)->name('testimonials');
Route::get('/blog', Blog::class)->name('blog');
Route::get('/contact', Contact::class)->name('contact');

Route::middleware('guest')->get('/login', Login::class)->name('login');


Route::middleware(["auth"])->prefix('admin')->group(function () {
    Route::view('/', "admin.dashboard")->name('dashboard');
    Route::resource('services', ServiceController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('teams', TeamController::class);
    // Route::prefix('services')->group(function () {
    //     Route::get('/', Index::class)->name('admin.services');
    //     Route::get('/create', Create::class)->name('admin.services.create');
    //     Route::get('/{service}', View::class)->name('admin.services.view');
    //     Route::get('/{service}/edit', Edit::class)->name('admin.services.edit');
    // });
});
