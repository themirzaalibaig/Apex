@section('body-attributes', 'class=body-bg1')

<div>
    <div class="inner-section-area"
        style="background-image: url(/img/all-images/bg/hero-bg1.png); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="hero-header-area">
                        <h1>Services</h1>
                        <div class="space32"></div>
                        <h4><a href="{{ route('home') }}">Home</a> <i class="fa-solid fa-angle-right"></i> <a
                                href="#">Our Services</a></h4>
                    </div>
                </div>
                <div class="col-lg-5"></div>
                <div class="col-lg-3">
                    <div class="imges-header">
                        <div class="img1">
                            <img src="/img/all-images/hero/hero-img1.png" alt="" class="keyframe6" />
                        </div>
                        <div class="arrow">
                            <a href="{{ route('contact') }}">
                                <img src="/img/elements/elements2.png" alt="" class="keyframe5" />
                                <img src="/img/icons/arrow1.svg" alt="" class="arrow1" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space30"></div>
        </div>
    </div>
    @include('components.layouts.partials.slider')
    <div class="sp7"></div>
    @include('components.layouts.partials.others-area')
    <livewire:components.home.service />
</div>
