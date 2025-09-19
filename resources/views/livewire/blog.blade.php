@section('body-attributes', 'class=body-bg1')
<div>
    <div class="inner-section-area"
        style="background-image: url(/img/all-images/bg/hero-bg1.png); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-header-area">
                        <h1>Our Blog</h1>
                        <div class="space32"></div>
                        <h4><a href="{{ route('home') }}">Home</a> <i class="fa-solid fa-angle-right"></i> <a
                                href="#">Our Blog</a></h4>
                    </div>
                </div>
                <div class="col-lg-3"></div>
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
    <div class="vl-blog-1-area sp7"
        style="background-image: url(/img/all-images/bg/bg5.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <img src="/img/elements/elements15.png" alt="" class="elements15" />
        <div class="container">
            <div class="row">
                <div class="col-lg-7 m-auto">
                    <div class="vl-blog-1-section-box heading1 text-center space-margin60">
                        <h2>our latest blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="vl-blog-1-item">
                        <div class="vl-blog-1-thumb image-anime">
                            <img src="/img/all-images/blog/blog-img1.png" alt="" />
                        </div>
                        <div class="vl-blog-1-content">
                            <div class="vl-blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><img src="/img/icons/date1.svg" alt="" /> 8 December
                                            2024</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/img/icons/user1.svg" alt="" /> By Alex
                                            Roy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="space14"></div>
                            <h4 class="vl-blog-1-title"><a href="">Why
                                    Branding & Identity Design Business Matter More Than Ever</a></h4>
                            <div class="space20"></div>
                            <div class="vl-blog-1-icon">
                                <a href="">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="vl-blog-1-item">
                        <div class="vl-blog-1-thumb image-anime">
                            <img src="/img/all-images/blog/blog-img2.png" alt="" />
                        </div>
                        <div class="vl-blog-1-content">
                            <div class="vl-blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><img src="/img/icons/date1.svg" alt="" /> 8 December
                                            2024</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/img/icons/user1.svg" alt="" />By Alex
                                            Roy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="space14"></div>
                            <h4 class="vl-blog-1-title"><a href="">The
                                    Complete Guide to Building A High-Converting Best Website</a></h4>
                            <div class="space20"></div>
                            <div class="vl-blog-1-icon">
                                <a href="">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="vl-blog-1-item">
                        <div class="vl-blog-1-thumb image-anime">
                            <img src="/img/all-images/blog/blog-img3.png" alt="" />
                        </div>
                        <div class="vl-blog-1-content">
                            <div class="vl-blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><img src="/img/icons/date1.svg" alt="" /> 8 December
                                            2024</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/img/icons/user1.svg" alt="" /> By Alex
                                            Roy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="space14"></div>
                            <h4 class="vl-blog-1-title"><a href="">Effective
                                    SEO Digital Marketing Strategies to Grow Your Brand</a></h4>
                            <div class="space20"></div>
                            <div class="vl-blog-1-icon">
                                <a href="">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="vl-blog-1-item">
                        <div class="vl-blog-1-thumb image-anime">
                            <img src="/img/all-images/blog/blog-img6.png" alt="" />
                        </div>
                        <div class="vl-blog-1-content">
                            <div class="vl-blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><img src="/img/icons/date1.svg" alt="" /> 8
                                            December 2024</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/img/icons/user1.svg" alt="" /> By Alex
                                            Roy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="space14"></div>
                            <h4 class="vl-blog-1-title"><a href="">Web
                                    Design Unleashed: Renev Powering Your Digital Journey</a></h4>
                            <div class="space20"></div>
                            <div class="vl-blog-1-icon">
                                <a href="">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="vl-blog-1-item">
                        <div class="vl-blog-1-thumb image-anime">
                            <img src="/img/all-images/blog/blog-img7.png" alt="" />
                        </div>
                        <div class="vl-blog-1-content">
                            <div class="vl-blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><img src="/img/icons/date1.svg" alt="" /> 8
                                            December 2024</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/img/icons/user1.svg" alt="" />By Alex
                                            Roy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="space14"></div>
                            <h4 class="vl-blog-1-title"><a href="">From
                                    Concept to Clicks: Master Your Online Web Design Space</a></h4>
                            <div class="space20"></div>
                            <div class="vl-blog-1-icon">
                                <a href="">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="vl-blog-1-item">
                        <div class="vl-blog-1-thumb image-anime">
                            <img src="/img/all-images/blog/blog-img8.png" alt="" />
                        </div>
                        <div class="vl-blog-1-content">
                            <div class="vl-blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><img src="/img/icons/date1.svg" alt="" /> 8
                                            December 2024</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/img/icons/user1.svg" alt="" /> By Alex
                                            Roy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="space14"></div>
                            <h4 class="vl-blog-1-title"><a href="">Fueling
                                    Growth with Cutting-Edge Web Design Strategies</a></h4>
                            <div class="space20"></div>
                            <div class="vl-blog-1-icon">
                                <a href="">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="vl-blog-1-item">
                        <div class="vl-blog-1-thumb image-anime">
                            <img src="/img/all-images/blog/blog-img9.png" alt="" />
                        </div>
                        <div class="vl-blog-1-content">
                            <div class="vl-blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><img src="/img/icons/date1.svg" alt="" /> 8
                                            December 2024</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/img/icons/user1.svg" alt="" /> By Alex
                                            Roy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="space14"></div>
                            <h4 class="vl-blog-1-title"><a href="">Experience the Revolution of
                                    Modern Web Design Agency</a></h4>
                            <div class="space20"></div>
                            <div class="vl-blog-1-icon">
                                <a href="">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="vl-blog-1-item">
                        <div class="vl-blog-1-thumb image-anime">
                            <img src="/img/all-images/blog/blog-img10.png" alt="" />
                        </div>
                        <div class="vl-blog-1-content">
                            <div class="vl-blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><img src="/img/icons/date1.svg" alt="" /> 8
                                            December 2024</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/img/icons/user1.svg" alt="" />By Alex
                                            Roy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="space14"></div>
                            <h4 class="vl-blog-1-title"><a href="">Dream
                                    Big, Design Bigger, Design Achieve the Evolution Impossible</a></h4>
                            <div class="space20"></div>
                            <div class="vl-blog-1-icon">
                                <a href="">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="vl-blog-1-item">
                        <div class="vl-blog-1-thumb image-anime">
                            <img src="/img/all-images/blog/blog-img11.png" alt="" />
                        </div>
                        <div class="vl-blog-1-content">
                            <div class="vl-blog-meta">
                                <ul>
                                    <li>
                                        <a href="#"><img src="/img/icons/date1.svg" alt="" /> 8
                                            December 2024</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="/img/icons/user1.svg" alt="" /> By Alex
                                            Roy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="space14"></div>
                            <h4 class="vl-blog-1-title"><a href="">Your
                                    Guide to Building Brands That Shine An Online Support</a></h4>
                            <div class="space20"></div>
                            <div class="vl-blog-1-icon">
                                <a href="">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="space20"></div>
                    <div class="pagination-area">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Previous"><i
                                            class="fa-solid fa-angle-left"></i></a>
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
                                    <a class="page-link m-0" href="#" aria-label="Next"><i
                                            class="fa-solid fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
