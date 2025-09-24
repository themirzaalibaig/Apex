<div>
    <div class="flex justify-between items-center">
        <div>
            <flux:heading size="xl" level="1">Welcome back, {{ auth()->user()->name ?? 'User' }}</flux:heading>
            <flux:text class="mt-2 mb-6 text-base">Here's what's new today</flux:text>
        </div>
        <div>
            <flux:button wire:click="logout" variant="outline" color="red">
                Logout
            </flux:button>
        </div>
    </div>
    <flux:separator variant="subtle" />
</div>
