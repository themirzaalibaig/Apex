@props([
    'status' => 'active',
    'name' => 'status',
    'label' => 'Status',
    'description' => 'Toggle to enable or disable this service.'
])

@php
    $isActive = $status === 'active';
@endphp

<div
    x-data="{
        isActive: {{ $isActive ? 'true' : 'false' }},
        toggle() {
            this.isActive = !this.isActive;
            $wire.set('{{ $name }}', this.isActive ? 'active' : 'inactive');
        }
    }"
    class=""
>
    <div class="flex items-center gap-4 bg-white dark:bg-white/10 border border-zinc-200 dark:border-zinc-700 rounded-lg shadow p-4 h-[80px]">
        <div class="flex-shrink-0">
            <div class="flex items-center gap-3">
                <button
                    type="button"
                    @click="toggle()"
                    :class="isActive ? 'bg-accent' : 'bg-zinc-900'"
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2"
                    role="switch"
                    :aria-checked="isActive"
                >
                    <span
                        :class="isActive ? 'translate-x-6 bg-zinc-900' : 'translate-x-1'"
                        class="inline-block h-4 w-4 transform rounded-full bg-accent transition-transform"
                    ></span>
                </button>

                <div class="flex-1">
                    <div class="text-sm font-medium text-zinc-900 dark:text-white">
                        {{ $label }}
                    </div>
                    <div class="text-xs text-zinc-500 dark:text-zinc-400">
                        {{ $description }}
                    </div>
                </div>

                <div class="text-sm font-medium" :class="isActive ? 'text-accent' : 'text-zinc-500'">
                    <span x-text="isActive ? 'Active' : 'Inactive'"></span>
                </div>
            </div>
        </div>
    </div>

    {{-- Hidden input for form submission --}}
    <input
        type="hidden"
        name="{{ $name }}"
        :value="isActive ? 'active' : 'inactive'"
        wire:model="{{ $name }}"
    />

    {{-- Error display if validation fails --}}
    @error($name)
        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
    @enderror
</div>
