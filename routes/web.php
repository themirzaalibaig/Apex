<?php

use App\Livewire\About;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Service;
use App\Livewire\Home;
use App\Livewire\Services;
use App\Livewire\Portfolio;
use App\Livewire\Testimonials;
use App\Livewire\Blog;
use App\Livewire\Contact;
use App\Livewire\Login;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/services', Services::class)->name('services');
Route::get('/portfolio', Portfolio::class)->name('portfolio');
Route::get('/testimonials', Testimonials::class)->name('testimonials');
Route::get('/blog', Blog::class)->name('blog');
Route::get('/contact', Contact::class)->name('contact');

Route::middleware('guest')->get('/login', Login::class)->name('login');


Route::middleware(["auth"])->prefix('admin')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/services', Service::class)->name('admin.services');
});
