<?php

namespace App\Livewire;

use App\Models\HeroSection;
use App\Models\Review;
use Livewire\Component;

class Testimonials extends Component
{
    public $heroSection;
    public $testimonials;

    public function mount()
    {
        $this->heroSection = HeroSection::with('mediaUsages.upload')->first();
        $this->testimonials = Review::with('mediaUsages.upload')->where('status', 'active')->get();
    }

    public function render()
    {
        return view('livewire.testimonials');
    }
}
