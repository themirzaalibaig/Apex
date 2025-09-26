<?php

namespace App\Livewire\Components\Home;

use App\Models\Service as ModelsService;
use Livewire\Component;

class Service extends Component
{
    public $services;
    public function mount()
    {
        $this->services = ModelsService::with('images')->get();
    }
    public function render()
    {
        return view('livewire.components.home.service');
    }
}
