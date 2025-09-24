<div class="min-h-screen grid place-items-center">
    <div class="w-full max-w-md p-8 border border-zinc-600 space-y-6 rounded-lg shadow-md mx-auto">
        <div>
            <flux:heading size="xl" class="text-center">Log in to your account</flux:heading>
            <flux:text class="mt-2 text-center">Welcome back!</flux:text>
        </div>

        @if (session()->has('error'))
            <x-alert variant="error" dismissible="true">
                {{ session('error') }}
            </x-alert>
        @endif

        <form wire:submit="login" class="space-y-6">
            <div class="space-y-4">
                <flux:input label="Email" type="email" placeholder="Your email address" wire:model="email"
                    autocomplete="email" required />

                <flux:field>
                    <flux:input label="Password" type="password" placeholder="Your password" wire:model="password"
                        autocomplete="current-password" required />
                </flux:field>

            </div>

            <div class="space-y-2">
                <flux:button type="submit" variant="primary" class="w-full">
                    Log in
                </flux:button>
            </div>
        </form>
    </div>
</div>
