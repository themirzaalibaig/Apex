<?php

namespace App\Livewire\Components\Home;

use App\Models\Review;
use Livewire\Component;

class Testimonial extends Component
{
    public $testimonials;
    public function mount()
    {
        $this->testimonials = Review::with('images')->where('status', 'active')->limit(6)->get();
    }
    public function render()
    {
        return view('livewire.components.home.testimonial');
    }
}
