<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public string $variant;
    public bool $dismissible;
    public ?string $icon;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $variant = 'info',
        bool $dismissible = false,
        ?string $icon = null
    ) {
        $this->variant = $variant;
        $this->dismissible = $dismissible;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }

    /**
     * Get the variant classes with automatic dark mode
     */
    public function getVariantClasses(): string
    {
        $variants = [
            'success' => 'bg-green-50 border-green-200 text-green-800 dark:bg-green-900/20 dark:border-green-800 dark:text-green-200',
            'error' => 'bg-red-50 border-red-200 text-red-800 dark:bg-red-900/20 dark:border-red-800 dark:text-red-200',
            'warning' => 'bg-yellow-50 border-yellow-200 text-yellow-800 dark:bg-yellow-900/20 dark:border-yellow-800 dark:text-yellow-200',
            'info' => 'bg-blue-50 border-blue-200 text-blue-800 dark:bg-blue-900/20 dark:border-blue-800 dark:text-blue-200'
        ];

        return $variants[$this->variant] ?? $variants['info'];
    }

    /**
     * Get the icon classes with automatic dark mode
     */
    public function getIconClasses(): string
    {
        $icons = [
            'success' => 'text-green-400 dark:text-green-500',
            'error' => 'text-red-400 dark:text-red-500',
            'warning' => 'text-yellow-400 dark:text-yellow-500',
            'info' => 'text-blue-400 dark:text-blue-500'
        ];

        return $icons[$this->variant] ?? $icons['info'];
    }

    /**
     * Get the default Font Awesome icon for variant
     */
    public function getDefaultIcon(): string
    {
        $defaultIcons = [
            'success' => 'fas fa-check-circle',
            'error' => 'fas fa-exclamation-circle',
            'warning' => 'fas fa-exclamation-triangle',
            'info' => 'fas fa-info-circle'
        ];

        return $defaultIcons[$this->variant] ?? $defaultIcons['info'];
    }
}
