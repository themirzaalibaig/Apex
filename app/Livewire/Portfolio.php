<?php

namespace App\Livewire;

use App\Models\HeroSection;
use App\Models\Project;
use Livewire\Component;

class Portfolio extends Component
{
    public $heroSection;
    public $projects;

    public function mount()
    {
        $this->heroSection = HeroSection::with('mediaUsages.upload')->first();
        $this->projects = Project::with('mediaUsages.upload')->where('status', 'active')->get();
    }

    public function render()
    {
        return view('livewire.portfolio');
    }
}
