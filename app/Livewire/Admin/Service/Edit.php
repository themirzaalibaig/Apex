<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $service;
    #[Validate('required|string|max:255')]
    public $name = '';
    #[Validate('required|string|max:255')]
    public $slug = '';
    public $description = '';
    #[Validate('required|string|max:255')]
    public $status = 'active';
    #[Validate('required|string|max:255')]
    public $tags = '';

    public function mount($service)
    {
        $this->service = Service::with('images')->find($service);
        if (!$this->service) {
            return $this->redirect('/admin/services', navigate: true);
        }
    }
    public function update(){
        $this->validate();

        if (!$this->service) {
            session()->flash('error', 'Service not found.');
            return $this->redirect('/admin/services', navigate: true);
        }

        $this->service->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => $this->description,
            'status' => $this->status,
            'tags' => $this->tags,
        ]);

        session()->flash('success', 'Service updated successfully!');
        return $this->redirect('/admin/services', navigate: true);
    }
    public function render()
    {
        return view('livewire.admin.service.edit');
    }
}
