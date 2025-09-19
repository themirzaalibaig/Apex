@section('body-attributes', 'class=body-bg1')


<div>
    <livewire:components.home.hero />
    @include('components.layouts.partials.slider')
    <livewire:components.home.about />
    @include('components.layouts.partials.others-area')
    <livewire:components.home.service />
    <livewire:components.home.portfolio />
    <livewire:components.home.testimonial />
    <livewire:components.home.team />
    <livewire:components.home.blog />


</div>
