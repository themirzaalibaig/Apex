@php
    $services = \App\Models\Service::with(['images' => function($query) {
        $query->where('alt', 'others-area');
    }])->where('status', 'active')->get();
@endphp
<div class="serve-section-area sp10">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 m-auto">
                <div class="heading1 space-margin60 text-center">
                    <h5 style="color: #fff;"><img src="/img/icons/sub-logo1.svg" alt="" />Industries we serve</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="slider2-section-area">
        <div class="marquee-wrap">
            <div class="marquee-text">
                @if($services && count($services) > 0)
                    @for($i = 0; $i < 3; $i++)
                        @foreach($services as $service)
                            <div class="brand-single-box">
                                <h3>
                                    <a href="{{ $service->slug }}">
                                        @php
                                            $image = $service->images->first();
                                            $imagePath = $image && $image->image ? asset('storage/' . ltrim($image->image, '/')) : asset('img/all-images/others/serve-img1.png');
                                        @endphp
                                        <img src="{{ $imagePath }}" alt="" />
                                        <span><i class="fa-solid fa-arrow-right"></i></span> {{ $service->name }}
                                    </a>
                                </h3>
                            </div>
                        @endforeach
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>
