<flux:modal name="create-service" variant="flyout" class="flex flex-col w-full max-w-md rounded-lg shadow-xl p-0!">
    <!-- Header -->
    <div class="flex-shrink-0  px-6 py-4 border-b border-zinc-200 dark:border-zinc-700 rounded-t-lg">
        <flux:heading size="lg" class="flex items-center">
            <flux:icon name="briefcase" class="mr-2 bg-accent text-accent-foreground rounded-md p-1" />
            Create Service
        </flux:heading>
        <flux:text class="mt-1">Fill in the details to add a new service.</flux:text>
    </div>

    <!-- Scrollable Body -->
    <div class="flex-1 overflow-y-auto px-6 py-4 scrollbar-thin ">
        <form class="space-y-5">
            <flux:input label="Service Name" placeholder="Enter service name" wire:model.defer="name" required
                class="w-full" />

            <flux:input label="Slug" placeholder="service-slug" wire:model.defer="slug" required class="w-full" />

            <flux:textarea label="Description" placeholder="Describe the service" wire:model.defer="description"
                rows="3" class="w-full" />

            <flux:input label="Tags (comma separated)" placeholder="e.g. cleaning, plumbing" wire:model.defer="tags"
                class="w-full" />

            <flux:switch label="Status" wire:model.defer="status" on-value="active" off-value="inactive"
                on-label="Active" off-label="Inactive" class="w-full" />
        </form>
    </div>

    <!-- Sticky Footer -->
    <div
        class="flex-shrink-0 px-6 py-4 border-t border-zinc-200 dark:border-zinc-700 rounded-b-lg flex justify-end space-x-3">
        <flux:button variant="outline" x-on:click="$flux.modals().close()">Cancel</flux:button>
        <flux:button type="submit" variant="primary" wire:click="saveService">Save Service</flux:button>
    </div>
</flux:modal>
