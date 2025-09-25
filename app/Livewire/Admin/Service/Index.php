<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Index extends Component
{
    public $services;
    public $showDeleteModal = false;
    public $serviceToDelete = null;

    public function mount()
    {
        $this->services = Service::with('images')->get();
    }

    public function confirmDelete($serviceId)
    {
        $this->serviceToDelete = Service::find($serviceId);
        $this->showDeleteModal = true;
    }

    public function deleteService()
    {
        try {
            if ($this->serviceToDelete) {
                $serviceName = $this->serviceToDelete->name;
                $this->serviceToDelete->delete();

                // Refresh the services list
                $this->services = Service::with('images')->get();

                // Close modal and reset
                $this->showDeleteModal = false;
                $this->serviceToDelete = null;

                session()->flash('success', "Service '{$serviceName}' has been deleted successfully!");
            }
        } catch (\Exception $e) {
            Log::error('Service deletion error: ' . $e->getMessage());
            session()->flash('error', 'Error deleting service: ' . $e->getMessage());
        }
    }

    public function closeDeleteModal()
    {
        $this->showDeleteModal = false;
        $this->serviceToDelete = null;
    }

    public function render()
    {
        return view('livewire.admin.service.index');
    }
}
