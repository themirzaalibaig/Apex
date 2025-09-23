<?php

use App\Livewire\About;
use App\Livewire\Home;
use App\Livewire\Services;
use App\Livewire\Portfolio;
use App\Livewire\Testimonials;
use App\Livewire\Blog;
use App\Livewire\Contact;
use Illuminate\Support\Facades\Route;


Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/services', Services::class)->name('services');
Route::get('/portfolio', Portfolio::class)->name('portfolio');
Route::get('/testimonials', Testimonials::class)->name('testimonials');
Route::get('/blog', Blog::class)->name('blog');
Route::get('/contact', Contact::class)->name('contact');
