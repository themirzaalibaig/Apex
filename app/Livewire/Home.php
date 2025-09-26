<?php

namespace App\Livewire;

use App\Models\Service;
use Livewire\Component;

class Home extends Component
{
    public $services;

    public function mount()
    {
        $this->services=Service::with("images")->get();
    }
    public function render()
    {
        return view('livewire.home');
    }
}
