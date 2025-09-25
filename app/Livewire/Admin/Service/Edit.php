<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public Service $service;

    #[Validate('required|string|max:255')]
    public $name = '';

    #[Validate('required|string|max:255')]
    public $slug = '';

    public $description = '';

    #[Validate('required|string|max:255')]
    public $status = 'active';

    #[Validate('required|string|max:255')]
    public $tags = '';

    public function mount(Service $service)
    {
        $this->service = $service;
        $this->name = $service->name;
        $this->slug = $service->slug;
        $this->description = $service->description;
        $this->status = $service->status;
        $this->tags = $service->tags;
    }

    public function save()
    {
        try {
            $this->validate();

            $this->service->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'status' => $this->status,
                'tags' => $this->tags,
            ]);

            session()->flash('success', 'Service updated successfully!');
            $this->redirect('/admin/services', navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Error updating service: ' . $e->getMessage());
            Log::error('Service update error: ' . $e->getMessage());
        }
    }

    public function updateTags($value)
    {
        $this->tags = $value;
    }

    protected $listeners = ['updateParentProperty'];

    public function updateParentProperty($property, $value)
    {
        $this->{$property} = $value;
    }

    public function render()
    {
        return view('livewire.admin.service.edit');
    }
}
