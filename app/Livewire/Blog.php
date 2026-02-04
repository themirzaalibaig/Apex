<?php

namespace App\Livewire;

use App\Models\HeroSection;
use Livewire\Component;

class Blog extends Component
{
    public $heroSection;

    public function mount()
    {
        $this->heroSection = HeroSection::with('mediaUsages.upload')->first();
    }

    public function render()
    {
        return view('livewire.blog');
    }
}
