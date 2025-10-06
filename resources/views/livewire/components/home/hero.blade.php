@php
    $mainImage = $heroSection->images->firstWhere('alt', 'main');
    $title1Image = $heroSection->images->firstWhere('alt', 'title1');
    $title2Image = $heroSection->images->firstWhere('alt', 'title2');
    $backgroundImage = $heroSection->images->firstWhere('alt', 'background');
    $heroImage = $heroSection->images->firstWhere('alt', 'hero');
@endphp

<div class="hero1-section-area"
    style="background-image: url({{ $backgroundImage ? asset('storage/' . $backgroundImage->image) : asset('img/all-images/bg/hero-bg1.png') }}); background-position: center top; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="hero-header-area">
                    <h5><img src="/img/icons/sub-logo1.svg" alt="" />{{ $heroSection->subtitle }}</h5>
                    <div class="space32"></div>
                    <h1 class="text-anime-style-3">{{ $heroSection->title1 }}
                        @if ($title1Image)
                            <img src="{{ asset('storage/' . $title1Image->image) }}" alt="" class="elements1 keyframe5" />
                        @endif
                        </h1>
                    <div class="space40 d-md-block d-none"></div>
                    <div class="space16 d-block d-md-none"></div>
                    <h1 class="text-anime-style-3">
                        @if ($title2Image)
                            <img src="{{ asset('storage/' . $title2Image->image) }}" alt="" class="others-img1" />
                        @endif
                        {{ $heroSection->title2 }}
                    </h1>
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <div class="imges-header">
                    <div class="img1">
                        <img src="{{ $mainImage ? asset('storage/' . $mainImage->image) : asset('img/all-images/hero/hero-img1.png') }}" alt="" class="keyframe6" />
                    </div>
                    <div class="arrow">
                        <a href="{{ $heroSection->cta_url }}">
                            <img src="/img/elements/elements2.png" alt="" class="keyframe5" />
                            <img src="/img/icons/arrow1.svg" alt="" class="arrow1" />
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="space60"></div>
        <div class="row">
            <div class="col-lg-12">
                <div class="hero-bottom-images">
                    <img src="/img/elements/elements3.png" alt="" class="elements3" />
                    <div class="img1 image-anime reveal">
                        <img src="{{ $heroImage ? asset('storage/' . $heroImage->image) : asset('img/all-images/hero/hero-img2.png') }}" alt="" />
                    </div>
                    <div class="started-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="190" height="190" viewBox="0 0 190 190"
                            fill="none" class="keyframe5">
                            <path
                                d="M89.6307 2.22405C92.2799 1.12669 93.6046 0.578013 95 0.578013C96.3954 0.578013 97.7201 1.12669 100.369 2.22405L156.806 25.6008C159.455 26.6982 160.78 27.2468 161.766 28.2336C162.753 29.2203 163.302 30.5449 164.399 33.1942L187.776 89.6307C188.873 92.2799 189.422 93.6046 189.422 95C189.422 96.3954 188.873 97.7201 187.776 100.369L164.399 156.806C163.302 159.455 162.753 160.78 161.766 161.766C160.78 162.753 159.455 163.302 156.806 164.399L100.369 187.776C97.7201 188.873 96.3954 189.422 95 189.422C93.6046 189.422 92.2799 188.873 89.6307 187.776L33.1942 164.399C30.5449 163.302 29.2203 162.753 28.2336 161.766C27.2468 160.78 26.6982 159.455 25.6008 156.806L2.22405 100.369C1.12669 97.7201 0.578013 96.3954 0.578013 95C0.578013 93.6046 1.12669 92.2799 2.22405 89.6307L25.6008 33.1942C26.6982 30.5449 27.2468 29.2203 28.2336 28.2336C29.2203 27.2468 30.5449 26.6982 33.1942 25.6008L89.6307 2.22405Z"
                                fill="#C0F037" />
                        </svg>
                        <a href="{{ $heroSection->cta_url }}"><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        <div class="space10"></div>
                        <a href="{{ $heroSection->cta_url }}">{{ $heroSection->cta }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
