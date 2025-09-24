<?php

namespace App\Livewire\Admin;

use App\Models\Service as ModelsService;
use Livewire\Component;
use Livewire\Attributes\On;

class Service extends Component
{
    public $services;

    public function mount()
    {
        $this->loadServices();
    }

    public function loadServices()
    {
        $this->services = ModelsService::with('serviceTags', 'images')->get();
    }

    public function deleteService($serviceId)
    {
        $service = ModelsService::findOrFail($serviceId);
        $service->delete();

        $this->loadServices();

        // Show success message
        session()->flash('success', 'Service deleted successfully!');
    }

    #[On('service-created')]
    #[On('service-updated')]
    public function refreshServices()
    {
        $this->loadServices();
    }

    public function render()
    {
        return view('livewire.admin.service');
    }
}
