<!-- =====HEADER START======= -->
<header class="homepage4-menu">
  <div id="vl-header-sticky" class="vl-header-area vl-transparent-header">
    <div class="container headerfix">
      <div class="row align-items-center row-bg1">
        <div class="col-lg-2 col-md-6 col-6">
          <div class="vl-logo">
            <a href="{{ route('any' , 'index') }}"><img src="/img/logo/logo1.png" alt="" /></a>
          </div>
        </div>
        <div class="col-lg-6 d-none d-lg-block">
          <div class="vl-main-menu text-center">
            <nav class="vl-mobile-menu-active">
              <ul>
                <li class="has-dropdown">
                  <a href="#">Home <span><i class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                  <div class="vl-mega-menu">
                    <div class="vl-home-menu">
                      <div class="row gx-4 row-cols-1 row-cols-md-1 row-cols-lg-4">
                        <div class="col">
                          <div class="vl-home-thumb">
                            <div class="img1">
                              <img src="/img/all-images/demo/demo-img1.png" alt="" />
                            </div>
                            <a href="{{ route('any' , 'index') }}">RENEV - Homepage 01</a>
                            <div class="btn-area1">
                              <a href="{{ route('any' , 'index') }}" class="vl-btn3">View Demo</a>
                            </div>
                            <div class="space20 d-lg-none d-block"></div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="vl-home-thumb">
                            <div class="img1">
                              <img src="/img/all-images/demo/demo-img2.png" alt="" />
                            </div>
                            <a href="{{ route('second', ['demo', 'index2']) }}">RENEV - Homepage 02</a>
                            <div class="btn-area1">
                              <a href="{{ route('second', ['demo', 'index2']) }}" class="vl-btn3">View Demo</a>
                            </div>
                            <div class="space20 d-lg-none d-block"></div>
                          </div>
                        </div>
                        <div class="col">
                          <div class="vl-home-thumb">
                            <div class="img1">
                              <img src="/img/all-images/demo/demo-img3.png" alt="" />
                            </div>
                            <a href="{{ route('second', ['demo', 'index3']) }}">RENEV - Homepage 03</a>
                            <div class="btn-area1">
                              <a href="{{ route('second', ['demo', 'index3']) }}" class="vl-btn3">View Demo</a>
                            </div>
                            <div class="space20 d-lg-none d-block"></div>
                          </div>
                        </div>

                        <div class="col">
                          <div class="vl-home-thumb">
                            <div class="img1">
                              <img src="/img/all-images/demo/demo-img4.png" alt="" />
                            </div>
                            <a href="{{ route('second', ['demo', 'index4']) }}">RENEV - Homepage 04</a>
                            <div class="btn-area1">
                              <a href="{{ route('second', ['demo', 'index4']) }}" class="vl-btn3">View Demo</a>
                            </div>
                            <div class="space20 d-lg-none d-block"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </li>

                <li class="has-dropdown">
                  <a href="#">Pages <span><i class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                  <ul class="sub-menu">
                    <li>
                      <a href="{{ route('second', ['pages', 'about']) }}">About Us</a>
                    </li>
                    <li>
                      <a href="{{ route('second', ['pages', 'team']) }}">Our Team</a>
                    </li>
                    <li>
                      <a href="{{ route('second', ['pages', 'testimonial']) }}">Testimonials</a>
                    </li>
                    <li>
                      <a href="{{ route('second', ['pages', 'contact']) }}">Contact Us</a>
                    </li>
                    <li>
                      <a href="{{ route('second', ['pages', 'faq']) }}">FAQ,s</a>
                    </li>
                    <li>
                      <a href="{{ route('second', ['pages', '404']) }}">404</a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#">Services <span><i class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                  <ul class="sub-menu">
                    <li>
                      <a href="{{ route('second', ['services', 'service']) }}">Our Service</a>
                    </li>
                    <li>
                      <a href="{{ route('second', ['services', 'single']) }}">Service Single</a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#">Project <span><i class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                  <ul class="sub-menu">
                    <li>
                      <a href="{{ route('second', ['projects', 'project']) }}">Project</a>
                    </li>
                    <li>
                      <a href="{{ route('second', ['projects', 'single']) }}">Project Single</a>
                    </li>
                  </ul>
                </li>
                <li>
                  <a href="#">Blogs <span><i class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                  <ul class="sub-menu">
                    <li>
                      <a href="{{ route('second', ['blogs', 'blog']) }}">Blog One</a>
                    </li>
                    <li>
                      <a href="{{ route('second', ['blogs', 'blog2']) }}">Blog Two</a>
                    </li>
                    <li>
                      <a href="{{ route('second', ['blogs', 'single']) }}">Blog Single</a>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 col-6">
          <div class="vl-hero-btn d-none d-lg-block text-end">
            <div class="search-icon header__search header-search-btn">
              <a href="#"><img src="/img/icons/search1.svg" alt="" /></a>
            </div>
            <span class="vl-btn-wrap text-end"><a href="{{ route('second', ['pages', 'contact']) }}" class="vl-btn3" style="overflow: hidden;">Let’s Build Together</a></span>
            <button class="hamburger_menu"><img src="/img/icons/bars-icons1.svg" alt="" /></button>
          </div>
          <div class="vl-header-action-item d-block d-lg-none">
            <button type="button" class="vl-offcanvas-toggle"><i class="fa-solid fa-bars-staggered"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- =====HEADER END ======= -->

<!-- ===== MOBILE HEADER STARTS ======= -->
<div class="homepage4-menu">
  <div class="vl-offcanvas">
    <div class="vl-offcanvas-wrapper">
      <div class="vl-offcanvas-header d-flex justify-content-between align-items-center mb-90">
        <div class="vl-offcanvas-logo">
          <a href="{{ route('any' , 'index') }}"><img src="/img/logo/logo1.png" alt="" /></a>
        </div>
        <div class="vl-offcanvas-close">
          <button class="vl-offcanvas-close-toggle"><i class="fa-solid fa-xmark"></i></button>
        </div>
      </div>

      <div class="vl-offcanvas-menu d-lg-none mb-40">
        <nav></nav>
      </div>

      <div class="space20"></div>
      <div class="vl-offcanvas-info">
        <h3 class="vl-offcanvas-sm-title">Contact Us</h3>
        <div class="space20"></div>
        <span><a href="#"><i class="fa-regular fa-envelope"></i> +57 9954 6476</a></span>
        <span><a href="#"><i class="fa-solid fa-phone"></i> hello@exdos.com</a></span>
        <span><a href="#"><i class="fa-solid fa-location-dot"></i> Bhemeara,Kushtia</a></span>
      </div>
      <div class="space20"></div>
      <div class="vl-offcanvas-social">
        <h3 class="vl-offcanvas-sm-title">Follow Us</h3>
        <div class="space20"></div>
        <a href="#"><i class="fab fa-facebook-f"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-linkedin-in"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
  </div>
  <div class="vl-offcanvas-overlay"></div>
</div>
<!-- ===== MOBILE HEADER STARTS ======= -->
