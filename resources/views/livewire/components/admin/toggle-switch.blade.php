<div class="">
    <div class="flex items-center gap-4 bg-white dark:bg-white/10 border border-zinc-200 dark:border-zinc-700 rounded-lg shadow p-4 h-[80px]">
        <div class="flex-shrink-0">
            <flux:switch
                wire:model.live="isActive"
                label="Status"
                description="Toggle to enable or disable this service."
                align="left"

                aria-label="Toggle status"
            />
            {{-- Hidden input for form submission --}}
            <input
                type="hidden"
                name="{{ $name }}"
                value="{{ $status }}"
                wire:model="status"
            />
        </div>
        {{-- <div class="flex flex-col justify-center ml-3">
            <span class="text-lg font-semibold {{ $status === 'active' ? 'text-green-600 dark:text-green-400' : 'text-zinc-500 dark:text-zinc-400' }}">
                {{ ucfirst($status) }}
            </span>
            <span class="text-xs text-zinc-400 dark:text-zinc-500 mt-1">
                {{ $status === 'active'
                    ? 'This service is currently enabled and visible to users.'
                    : 'This service is currently disabled and hidden from users.' }}
            </span>
        </div> --}}
    </div>

    {{-- Error display if validation fails --}}
    @error($name)
        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
    @enderror
</div>
