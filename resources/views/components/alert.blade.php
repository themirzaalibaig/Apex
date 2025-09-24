@props(['variant' => 'info', 'dismissible' => false, 'icon' => null])

@php
    $alert = new \App\View\Components\Alert($variant, $dismissible, $icon);
    $variantClasses = $alert->getVariantClasses();
    $iconClasses = $alert->getIconClasses();
    $defaultIcon = $alert->getDefaultIcon();
@endphp

<div
    {{ $attributes->merge(['class' => "p-4 rounded-lg border {$variantClasses}"]) }}
    role="alert"
    x-data="{ show: true }"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform scale-95"
    x-transition:enter-end="opacity-100 transform scale-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100 transform scale-100"
    x-transition:leave-end="opacity-0 transform scale-95"
>
    <div class="flex">
        @if($icon || $defaultIcon)
            <div class="flex-shrink-0">
                <i class="h-5 w-5 {{ $iconClasses }} {{ $icon ?? $defaultIcon }}"></i>
            </div>
        @endif

        <div class="{{ $icon || $defaultIcon ? 'ml-3' : '' }} flex-1">
            <div class="text-sm font-medium">
                {{ $slot }}
            </div>
        </div>

        @if($dismissible)
            <div class="ml-auto pl-3">
                <div class="-mx-1.5 -my-1.5">
                    <button
                        type="button"
                        class="inline-flex rounded-md p-1.5 {{ $iconClasses }} hover:opacity-75 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-50 focus:ring-gray-600"
                        @click="show = false"
                    >
                        <span class="sr-only">Dismiss</span>
                        <i class="fas fa-times h-4 w-4"></i>
                    </button>
                </div>
            </div>
        @endif
    </div>
</div>
