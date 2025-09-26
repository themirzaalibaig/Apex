<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;
use Illuminate\View\View;

class ImageUploader extends Component
{
    public string $name;
    public string $label;
    public string $description;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $name = 'image',
        string $label = 'Upload Image',
        string $description = 'Click to select and upload an image'
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->description = $description;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.image-uploader');
    }
}
