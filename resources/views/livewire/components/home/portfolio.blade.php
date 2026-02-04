<div class="portfolio1-section-area sp6">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="portfolio-header heading1 space-margin60">
                    <h5><img src="/img/icons/sub-logo2.svg" alt="" />Showcasing Our Impact</h5>
                    <div class="space24"></div>
                    <h2 class="text-anime-style-3">Our Portfolio showcase</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="portfolio-slider-area owl-carousel">
                    @forelse ($projects as $project)
                        @php
                            $image = $project->mediaByType('thumbnail') ?? $project->mediaFirst();
                            $imagePath = $image?->url ?? asset('img/all-images/portfolio/portfolio-img1.png');
                            $tags = $project->tags ? array_filter(array_map('trim', explode(',', $project->tags))) : [];
                            $primaryTag = $tags[0] ?? 'Project';
                        @endphp
                        <div class="portfolio-boxarea">
                            <div class="img1">
                                <img src="{{ $imagePath }}" alt="{{ $project->name ?? 'Project' }}" />
                            </div>
                            <div class="arrow-content">
                                <div class="arrow">
                                    <a href="{{ $project->link ?? '' }}"><span><i class="fa-solid fa-arrow-right"></i></span></a>
                                </div>
                                <div class="content-area">
                                    <p>{{ $primaryTag }}</p>
                                    <div class="space16"></div>
                                    <a href="{{ $project->link ?? '' }}">{{ $project->name }}</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="portfolio-boxarea">
                            <div class="img1">
                                <img src="/img/all-images/portfolio/portfolio-img1.png" alt="" />
                            </div>
                            <div class="arrow-content">
                                <div class="arrow">
                                    <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                                </div>
                                <div class="content-area">
                                    <p>Project</p>
                                    <div class="space16"></div>
                                    <a href="">No projects yet</a>
                                </div>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
