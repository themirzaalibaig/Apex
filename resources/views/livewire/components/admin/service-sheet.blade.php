{{--
<flux:modal name="create-service">
    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <flux:heading size="lg">Create Service</flux:heading>
            <flux:text class="mt-2">Fill in the details to add a new service.</flux:text>
        </div>

        <flux:input
            label="Service Name"
            placeholder="Enter service name"
            wire:model.defer="name"
            required
        />

        <flux:input
            label="Slug"
            placeholder="service-slug"
            wire:model.defer="slug"
            required
        />

        <flux:textarea
            label="Description"
            placeholder="Describe the service"
            wire:model.defer="description"
            rows="3"
        />

        <flux:input
            label="Tags (comma separated)"
            placeholder="e.g. cleaning, plumbing"
            wire:model.defer="tags"
        />

        <flux:select
            label="Status"
            wire:model.defer="status"
            :options="[['value' => 'active', 'label' => 'Active'], ['value' => 'inactive', 'label' => 'Inactive']]"
            required
        />

        <flux:file-upload
            label="Images"
            wire:model.defer="images"
            multiple
        />

        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">
                Save Service
            </flux:button>
        </div>
    </form>
</flux:modal> --}}


<div>
   <flux:modal name="create-service" variant="flyout">
    <form class="space-y-6">
        <div>
            <flux:heading size="lg">Create Service</flux:heading>
            <flux:text class="mt-2">Fill in the details to add a new service.</flux:text>
        </div>

        <flux:input
            label="Service Name"
            placeholder="Enter service name"
            wire:model.defer="name"
            required
        />

        <flux:input
            label="Slug"
            placeholder="service-slug"
            wire:model.defer="slug"
            required
        />

        <flux:textarea
            label="Description"
            placeholder="Describe the service"
            wire:model.defer="description"
            rows="3"
        />

        <flux:input
            label="Tags (comma separated)"
            placeholder="e.g. cleaning, plumbing"
            wire:model.defer="tags"
        />

        {{-- <flux:select
            label="Status"
            wire:model.defer="status"
            :options="[['value' => 'active', 'label' => 'Active'], ['value' => 'inactive', 'label' => 'Inactive']]"
            required
        /> --}}

        {{-- <flux:file-upload
            label="Images"
            wire:model.defer="images"
            multiple
        /> --}}

        <div class="flex">
            <flux:spacer />
            <flux:button type="submit" variant="primary">
                Save Service
            </flux:button>
        </div>
    </form>
   </flux:modal>
</div>
