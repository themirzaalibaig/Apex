<flux:sidebar sticky collapsible class="bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.header>
        <flux:sidebar.brand href="#" logo="https://fluxui.dev/img/demo/logo.png"
            logo:dark="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." />
        <flux:sidebar.collapse
            class="in-data-flux-sidebar-on-desktop:not-in-data-flux-sidebar-collapsed-desktop:-mr-2" />
    </flux:sidebar.header>
    <flux:sidebar.nav>
        <flux:sidebar.item icon="home" href="{{ route('dashboard') }}" wire:navigate wire:current.exact="active">
            Home
        </flux:sidebar.item>
        <flux:sidebar.item icon="sparkles" href="{{ route('hero-sections.index') }}" wire:navigate wire:current.exact="active">
            Hero Sections
        </flux:sidebar.item>
        <flux:sidebar.item icon="cog" href="{{ route('services.index') }}" wire:navigate wire:current.exact="active">
            Services
        </flux:sidebar.item>
        <flux:sidebar.item icon="briefcase" href="{{ route('projects.index') }}" wire:navigate wire:current.exact="active">
            Projects
        </flux:sidebar.item>
        <flux:sidebar.item icon="user-group" href="{{ route('teams.index') }}" wire:navigate wire:current.exact="active">
            Team
        </flux:sidebar.item>
        <flux:sidebar.item icon="question-mark-circle" href="{{ route('faqs.index') }}" wire:navigate wire:current.exact="active">
            FAQs
        </flux:sidebar.item>
        <flux:sidebar.item icon="chat-bubble-left-right" href="{{ route('reviews.index') }}" wire:navigate wire:current.exact="active">
            Reviews
        </flux:sidebar.item>
        <flux:sidebar.item icon="bars-3" href="{{ route('menus.index') }}" wire:navigate wire:current.exact="active">
            Menus
        </flux:sidebar.item>
        <flux:sidebar.item icon="inbox" badge="12" href="#">Inbox</flux:sidebar.item>
        <flux:sidebar.group expandable icon="star" heading="Favorites" class="grid">
            <flux:sidebar.item href="#" wire:navigate wire:current="active">Marketing site</flux:sidebar.item>
            <flux:sidebar.item href="#" wire:navigate wire:current="active">Android app</flux:sidebar.item>
            <flux:sidebar.item href="#" wire:navigate wire:current="active">Brand guidelines</flux:sidebar.item>
        </flux:sidebar.group>
    </flux:sidebar.nav>
    <flux:sidebar.spacer />
    <flux:sidebar.nav>
        <flux:sidebar.item icon="cog-6-tooth" href="#">Settings</flux:sidebar.item>
        <flux:sidebar.item icon="information-circle" href="#">Help</flux:sidebar.item>
    </flux:sidebar.nav>
    <flux:dropdown position="top" align="start" class="max-lg:hidden">
        <flux:sidebar.profile avatar="https://fluxui.dev/img/demo/user.png" name="Olivia Martin" />
        <flux:menu>
            <flux:menu.radio.group>
                <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                <flux:menu.radio>Truly Delta</flux:menu.radio>
            </flux:menu.radio.group>
            <flux:menu.separator />
            <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
        </flux:menu>
    </flux:dropdown>
</flux:sidebar>
