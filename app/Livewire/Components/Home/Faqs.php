<?php

namespace App\Livewire\Components\Home;

use App\Models\Faq;
use Livewire\Component;

class Faqs extends Component
{
    public $faqs;
    public function mount()
    {
        $this->faqs = Faq::where('status', 'active')->get();
    }
    public function render()
    {
        return view('livewire.components.home.faqs');
    }
}
