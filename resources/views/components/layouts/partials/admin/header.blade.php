<flux:header class="flex items-center justify-between px-6 py-3 shadow-md border-b border-zinc-200 dark:border-zinc-700">
    <div class="flex items-center gap-4">
        <flux:sidebar.toggle icon="bars-2" inset="left" />
        <span class="text-lg font-semibold text-zinc-800 dark:text-zinc-100">
            Welcome back, {{ auth()->user()->name ?? 'User' }}
        </span>
    </div>
    <div class="flex items-center gap-4">
        <flux:dropdown position="bottom" align="end" class="relative">
            <flux:profile name="{{ auth()->user()->name ?? 'User' }}" initials:single class="cursor-pointer" />
            <flux:menu class="min-w-[160px] bg-white dark:bg-zinc-800 shadow-lg rounded-md py-2">
                <livewire:components.admin.logout />
            </flux:menu>
        </flux:dropdown>
    </div>
</flux:header>
