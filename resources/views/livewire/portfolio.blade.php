@section('body-attributes', 'class=body-bg1')

<div>
    <div class="inner-section-area" style="background-image: url(/img/all-images/bg/hero-bg1.png); background-position: center top; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5">
          <div class="hero-header-area">
            <h1>Our Project</h1>
            <div class="space32"></div>
            <h4><a href="{{ route('home') }}">Home</a> <i class="fa-solid fa-angle-right"></i> <a href="#">Project Showcase</a></h4>
          </div>
        </div>
        <div class="col-lg-4"></div>
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
   <div class="project-inner-section-area sp6" style="background-image: url(/img/all-images/bg/bg5.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="col-lg-10 m-auto">
          <div class="tabs-area text-center space-margin60">
            <ul class="nav nav-pills" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">All</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">UI/UX Design</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Web Development</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-contact1-tab" data-bs-toggle="pill" data-bs-target="#pills-contact1" type="button" role="tab" aria-controls="pills-contact1" aria-selected="false">Logo Branding</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link m-0" id="pills-contact2-tab" data-bs-toggle="pill" data-bs-target="#pills-contact2" type="button" role="tab" aria-controls="pills-contact2" aria-selected="false">eCommerce Service</button>
              </li>
            </ul>
          </div>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
              <div class="all-project-area">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img4.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img5.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="space50"></div>
                    <div class="pagination-area">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous"><i class="fa-solid fa-angle-left"></i></a>
                          </li>
                          <li class="page-item">
                            <a class="page-link active" href="#">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">...</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">12</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link m-0" href="#" aria-label="Next"><i class="fa-solid fa-angle-right"></i></a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
              <div class="all-project-area">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img4.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img5.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="space50"></div>
                    <div class="pagination-area">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous"><i class="fa-solid fa-angle-left"></i></a>
                          </li>
                          <li class="page-item">
                            <a class="page-link active" href="#">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">...</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">12</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link m-0" href="#" aria-label="Next"><i class="fa-solid fa-angle-right"></i></a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">
              <div class="all-project-area">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img4.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img5.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="space50"></div>
                    <div class="pagination-area">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous"><i class="fa-solid fa-angle-left"></i></a>
                          </li>
                          <li class="page-item">
                            <a class="page-link active" href="#">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">...</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">12</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link m-0" href="#" aria-label="Next"><i class="fa-solid fa-angle-right"></i></a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-contact1" role="tabpanel" aria-labelledby="pills-contact1-tab" tabindex="0">
              <div class="all-project-area">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img4.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img5.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="space50"></div>
                    <div class="pagination-area">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous"><i class="fa-solid fa-angle-left"></i></a>
                          </li>
                          <li class="page-item">
                            <a class="page-link active" href="#">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">...</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">12</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link m-0" href="#" aria-label="Next"><i class="fa-solid fa-angle-right"></i></a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="pills-contact2" role="tabpanel" aria-labelledby="pills-contact2-tab" tabindex="0">
              <div class="all-project-area">
                <div class="row">
                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/portfolio/portfolio-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img1.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img2.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img3.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img4.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6 col-md-6">
                    <div class="portfolio-boxarea">
                      <div class="img1">
                        <img src="/img/all-images/project/project-img5.png" alt="" />
                      </div>
                      <div class="arrow-content">
                        <div class="arrow">
                          <a href=""><span><i class="fa-solid fa-arrow-right"></i></span></a>
                        </div>
                        <div class="content-area">
                          <p>User Interface design</p>
                          <div class="space16"></div>
                          <a href="">Web Design For Business</a>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-12">
                    <div class="space50"></div>
                    <div class="pagination-area">
                      <nav aria-label="Page navigation example">
                        <ul class="pagination">
                          <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous"><i class="fa-solid fa-angle-left"></i></a>
                          </li>
                          <li class="page-item">
                            <a class="page-link active" href="#">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">...</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">12</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link m-0" href="#" aria-label="Next"><i class="fa-solid fa-angle-right"></i></a>
                          </li>
                        </ul>
                      </nav>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
