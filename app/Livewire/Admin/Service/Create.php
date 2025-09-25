<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Create extends Component
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


    public function save(){
        try {
            $this->validate();

            $service = Service::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'description' => $this->description,
                'status' => $this->status,
                'tags' => $this->tags,
            ]);
            session()->flash('success', 'Service created successfully!');
            $this->redirect('/admin/services', navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Error creating service: ' . $e->getMessage());
            Log::error('Service creation error: ' . $e->getMessage());
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
        return view('livewire.admin.service.create');
    }
}
