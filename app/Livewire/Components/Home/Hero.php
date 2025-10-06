<?php

namespace App\Livewire\Components\Home;

use App\Models\HeroSection;
use Livewire\Component;

class Hero extends Component
{
    public $heroSection;

    public function mount()
    {
        $this->heroSection = HeroSection::with('images')->first();
    }

    public function render()
    {
        return view('livewire.components.home.hero');
    }
}
