@props(['projects'])

@php
    $projects = $projects ?? collect();
@endphp

<div class="row">
    @forelse ($projects as $project)
        @php
            $image = $project->mediaByType('thumbnail') ?? $project->mediaFirst();
            $imagePath = $image?->url ?? asset('img/all-images/portfolio/portfolio-img1.png');
            $tags = $project->tags ? array_filter(array_map('trim', explode(',', $project->tags))) : [];
            $primaryTag = $tags[0] ?? 'Project';
        @endphp
        <div class="col-lg-6 col-md-6">
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
        </div>
    @empty
        <div class="col-lg-12">
            <h4>No projects found</h4>
        </div>
    @endforelse
</div>
