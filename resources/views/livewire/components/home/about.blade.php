  <div class="about1-section-area sp6">
      <img src="/img/elements/elements9.png" alt="" class="elements9" />
      <div class="container">
          <div class="row align-items-center">
              <div class="col-lg-6">
                  <div class="images">
                      <div class="img1 reveal">
                          <img src="{{ $about->images->first()->image ? asset('storage/' . $about->images->first()->image) : asset('img/all-images/about/about-img1.png') }}" alt="" />
                      </div>
                      <img src="/img/elements/elements8.png" alt="" class="elements8" />
                  </div>
              </div>

              <div class="col-lg-6">
                  <div class="about-header heading1">
                      <h5 data-aos="fade-left" data-aos-duration="800"><img src="/img/icons/sub-logo2.svg"
                              alt="" />{{ $about->subtitle }}</h5>
                      <div class="space20"></div>
                      <h2 class="text-anime-style-3">{{ $about->title }}</h2>
                      <div class="space16"></div>
                      <p data-aos="fade-left" data-aos-duration="900">{{ $about->description }}</p>
                      <div class="space32"></div>
                      <div class="bg-progress" data-aos="fade-left" data-aos-duration="1000">
                        @foreach($about->skills as $skill)
                          <div class="progress-bar">
                              <label>{{ $skill['name'] }} <span>{{ $skill['percentage'] }}%</span></label>
                              <div class="progress">
                                  <div class="progress-inner" style="width: {{ $skill['percentage'] }}%;"></div>
                              </div>
                          </div>
                          @endforeach
                      </div>
                      <div class="space32"></div>
                      <div class="btn-area1" data-aos="fade-left" data-aos-duration="1100">
                          <a href="{{ $about->cta_url }}" class="vl-btn1" style="overflow: hidden;">{{ $about->cta }}</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
