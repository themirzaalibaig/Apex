@section('body-attributes', 'class=body-bg1')
@php
    $heroBg = $about?->mediaByType('hero-background');
    $heroMain = $about?->mediaByType('hero-main');
@endphp
<div>
    <!-- ===== HERO AREA STARTS ======= -->
    <div class="inner-section-area"
        style="background-image: url({{ $heroBg?->url ?? asset('img/all-images/bg/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4">
                    <div class="hero-header-area">
                        <h1>About Us</h1>
                        <div class="space32"></div>
                        <h4><a href="{{ route('home') }}">Home</a> <i class="fa-solid fa-angle-right"></i> <a
                                href="#">About Us</a></h4>
                    </div>
                </div>
                <div class="col-lg-5"></div>
                <div class="col-lg-3">
                    <div class="imges-header">
                        <div class="img1">
                            <img src="{{ $heroMain?->url ?? asset('img/all-images/hero/hero-img1.png') }}" alt="" class="keyframe6" />
                        </div>
                        <div class="arrow">
                            <a href="">
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

    <!-- ===== HERO AREA ENDS ======= -->
    <div class="about1-section-area sp6">
        <img src="/img/elements/elements9.png" alt="" class="elements9" />
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="images">
                        <div class="img1 reveal">
                            @php
                                $aboutMain = $about?->mediaByType('main') ?? $about?->mediaFirst();
                            @endphp
                            <img src="{{ $aboutMain?->url ?? asset('img/all-images/about/about-img1.png') }}" alt="" />
                        </div>
                        <img src="/img/elements/elements8.png" alt="" class="elements8" />
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-header heading1">
                        <h5 data-aos="fade-left" data-aos-duration="800"><img src="/img/icons/sub-logo2.svg"
                                alt="" />{{ $about?->subtitle ?? 'Driven to the Creativity' }}</h5>
                        <div class="space20"></div>
                        <h2 class="text-anime-style-3">{{ $about?->title ?? 'Crafting Website with Purpose and Passions' }}</h2>
                        <div class="space16"></div>
                        <p data-aos="fade-left" data-aos-duration="900">{{ $about?->description ?? 'Our team of designers, developers, and strategists are passionate about bringing your brand\'s vision to life through innovative user.' }}</p>
                        <div class="space32"></div>
                        <div class="bg-progress" data-aos="fade-left" data-aos-duration="1000">
                            @if(!empty($about?->skills))
                                @foreach($about->skills as $skill)
                                    <div class="progress-bar">
                                        <label>{{ $skill['name'] }} <span>{{ $skill['percentage'] }}%</span></label>
                                        <div class="progress">
                                            <div class="progress-inner" style="width: {{ $skill['percentage'] }}%;"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="progress-bar">
                                    <label>User Interface Designer <span>98%</span></label>
                                    <div class="progress">
                                        <div class="progress-inner" style="width: 98%;"></div>
                                    </div>
                                </div>

                                <div class="progress-bar m-0">
                                    <label>WordPress Developer <span>99%</span></label>
                                    <div class="progress">
                                        <div class="progress-inner" style="width: 99%;"></div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="space32"></div>
                        <div class="btn-area1" data-aos="fade-left" data-aos-duration="1100">
                            <a href="{{ $about?->cta_url ?? route('contact') }}" class="vl-btn1" style="overflow: hidden;">{{ $about?->cta ?? 'Schedule a Consultation' }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="counter-section-area sp6">
        <div class="container">
            <div class="row">
                @if(!empty($about?->statistics))
                    @foreach($about->statistics as $stat)
                        <div class="col-lg-3 col-md-6">
                            <div class="counter-box">
                                <h2><span class="counter">{{ $stat['value'] ?? '' }}</span>{{ $stat['suffix'] ?? '' }}</h2>
                                <div class="space18"></div>
                                <p>{{ $stat['label'] ?? '' }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-box">
                            <h2><span class="counter">99</span>%</h2>
                            <div class="space18"></div>
                            <p>Satisfaction Rate</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-box">
                            <h2><span class="counter">80</span>%</h2>
                            <div class="space18"></div>
                            <p>Engagement by</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-box">
                            <h2><span class="counter">200</span>+</h2>
                            <div class="space18"></div>
                            <p>Website launched</p>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="counter-box">
                            <h2><span class="counter">76</span>+</h2>
                            <div class="space18"></div>
                            <p>Industry Awards</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    @include('components.layouts.partials.others-area')

    <div class="about-others-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="img1">
                        <div class="play-btn">
                            <a href="{{ $about?->video ?? 'https://www.youtube.com/watch?v=Y8XpQpW5OVY' }}" class="popup-youtube"><span><i
                                        class="fa-solid fa-play"></i></span> Play Video</a>
                        </div>
                        @php
                            $videoImage = $about?->mediaByType('video');
                        @endphp
                        <img src="{{ $videoImage?->url ?? asset('img/all-images/about/about-img6.png') }}" alt="" />
                    </div>
                </div>

                <div class="col-lg-12 sp1">
                    <div class="about-brand-sliderarea">
                        <h3 class="text-center">Proudly Sponsored By Our Trusted Partners</h3>
                        <div class="space40"></div>
                        <div class="about-brand-slider owl-carousel">
                            @php
                                $brandImages = $about?->mediaUsages?->where('type', 'brand')?->map->upload?->filter() ?? collect();
                            @endphp
                            @if($brandImages->isNotEmpty())
                                @foreach($brandImages as $brandImage)
                                    <div class="brand-img1">
                                        <img src="{{ $brandImage->url }}" alt="" />
                                    </div>
                                @endforeach
                            @else
                                <div class="brand-img1">
                                    <img src="/img/elements/brand-img1.png" alt="" />
                                </div>
                                <div class="brand-img1">
                                    <img src="/img/elements/brand-img2.png" alt="" />
                                </div>
                                <div class="brand-img1">
                                    <img src="/img/elements/brand-img3.png" alt="" />
                                </div>
                                <div class="brand-img1">
                                    <img src="/img/elements/brand-img4.png" alt="" />
                                </div>
                                <div class="brand-img1">
                                    <img src="/img/elements/brand-img1.png" alt="" />
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <livewire:components.home.team />
</div>
