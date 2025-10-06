<section class="testimonials-2 sp6"
    style="background-image: url(/img/all-images/bg/bg2.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto text-center">
                <div class="heading1 space-margin60">
                    <h5><img src="/img/icons/sub-logo2.svg" alt="" /> Real Feedback</h5>
                    <div class="space20"></div>
                    <h2 class="text-anime-style-3">Client Success Stories</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7 col-md-12 left _relative m-auto">
                <div class="swiper swiper-testimonial-2">
                    <div class="swiper-wrapper">
                        @foreach($testimonials as $testimonial)
                        @php
                            $companyImage=$testimonial->images->firstWhere('alt', 'company-logo');
                        @endphp
                        <div class="swiper-slide">
                            <div class="testimonial-boxarea">

                                <ul>
                                    @for($i = 0; $i < (int) $testimonial->rating; $i++)
                                    <li>
                                        <i class="fa-solid fa-star"></i>
                                    </li>
                                    @endfor
                                </ul>
                                <div class="space16"></div>
                                <p>{{ $testimonial->review }}</p>
                                <div class="space32"></div>
                                <div class="names-area">
                                    <div class="man-textarea">
                                        <div class="man">
                                            <img src="{{ $testimonial->images->first() ? asset('storage/' . $testimonial->images->first()->image) : asset('img/all-images/testimonial/testimonial-img5.png') }}"
                                                alt="" />
                                        </div>
                                        <div class="text">
                                            <a href="#">{{ $testimonial->name }}</a>
                                            <div class="space12"></div>
                                            <p>{{ $testimonial->designation }}</p>
                                        </div>
                                    </div>
                                    <img src="{{ $companyImage ? asset('storage/' . $companyImage->image) : asset('img/elements/elements20.png') }}" alt="" class="elements20" />
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="pagination-buttons">
                    <div class="swiper-button-next">
                        <button><i class="fa-solid fa-angle-left"></i></button>
                    </div>
                    <div class="swiper-button-prev">
                        <button><i class="fa-solid fa-angle-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="map-testimonial">
                <div class="swiper swiper-thumb2">
                    <div class="swiper-wrapper list-img">
                        @foreach($testimonials as $testimonial)
                        @php
                            $image=$testimonial->images->first();
                            $imageUrl=$image ? asset('storage/' . $image->image) : asset('img/all-images/testimonial/testimonial-img5.png');
                        @endphp
                        <div class="swiper-slide">
                            <div>
                                <img src="{{ $imageUrl }}" alt="" />
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
