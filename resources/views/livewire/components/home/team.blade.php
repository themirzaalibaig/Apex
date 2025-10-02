<div class="team1-section-area sp7">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 m-auto">
                <div class="team-header heading1 text-center space-margin60">
                    <h5><img src="/img/icons/sub-logo2.svg" alt="" />meet our team</h5>
                    <div class="space24"></div>
                    <h2 class="text-anime-style-3">our experienced team</h2>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($teams as $team)
            @php
                $bgImage = $team->images->firstWhere('alt', 'background');
            @endphp

            <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="900">
                <div class="team-author-boxarea">
                    <img src="{{ $bgImage ? asset('storage/' . $bgImage->image) : asset('img/elements/elements7.png') }}" alt="" class="elements7 keyframe5" />
                    <div class="img1">
                        <img src="{{ $team->images->first()->image ? asset('storage/' . $team->images->first()->image) : asset('img/all-images/team/team-img1.png') }}" alt="" />
                    </div>
                    <div class="content-area">
                        <div class="content">
                            <a href="">{{ $team->name }}</a>
                            <div class="space14"></div>
                            <p>{{ $team->designation }}</p>
                        </div>
                        <div class="share">
                            <a href="{{ $team->slug }}"><i class="fa-solid fa-share-nodes text-white"></i></a>
                        </div>
                    </div>
                    <div class="list">
                        <ul>
                            @if($team->facebook)
                            <li>
                                <a href="{{ $team->facebook }}" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                            </li>
                            @endif
                            @if($team->twitter)
                            <li>
                                <a href="{{ $team->twitter }}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                            </li>
                            @endif
                            @if($team->instagram)
                            <li>
                                <a href="{{ $team->instagram }}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                            </li>
                            @endif
                            @if($team->linkedin)
                            <li>
                                <a href="{{ $team->linkedin }}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                            </li>
                            @endif
                            @if($team->github)
                            <li>
                                <a href="{{ $team->github }}" target="_blank"><i class="fa-brands fa-github"></i></a>
                            </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
