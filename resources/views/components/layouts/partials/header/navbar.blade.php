<!-- =====HEADER START======= -->
<header class="homepage1-menu">
    <div id="vl-header-sticky" class="vl-header-area vl-transparent-header">
        <div class="container headerfix">
            <div class="row align-items-center row-bg1">
                <div class="col-lg-2 col-md-6 col-6">
                    <div class="vl-logo">
                        <a href="{{ route('home') }}" wire:navigate><img src="/img/logo/logo1.png" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="vl-main-menu text-center">
                        <nav class="vl-mobile-menu-active">
                            <ul>
                                <li>
                                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}" wire:navigate>Home</a>
                                    {{-- <div class="vl-mega-menu">
                                        <div class="vl-home-menu">
                                            <div class="row gx-4 row-cols-1 row-cols-md-1 row-cols-lg-4">
                                                <div class="col">
                                                    <div class="vl-home-thumb">
                                                        <div class="img1">
                                                            <img src="/img/all-images/demo/demo-img1.png"
                                                                alt="" />
                                                        </div>
                                                        <a href="">RENEV - Homepage 01</a>
                                                        <div class="btn-area1">
                                                            <a href="" class="vl-btn1">View Demo</a>
                                                        </div>
                                                        <div class="space20 d-lg-none d-block"></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="vl-home-thumb">
                                                        <div class="img1">
                                                            <img src="/img/all-images/demo/demo-img2.png"
                                                                alt="" />
                                                        </div>
                                                        <a href="">RENEV -
                                                            Homepage 02</a>
                                                        <div class="btn-area1">
                                                            <a href="" class="vl-btn1">View Demo</a>
                                                        </div>
                                                        <div class="space20 d-lg-none d-block"></div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="vl-home-thumb">
                                                        <div class="img1">
                                                            <img src="/img/all-images/demo/demo-img3.png"
                                                                alt="" />
                                                        </div>
                                                        <a href="">RENEV -
                                                            Homepage 03</a>
                                                        <div class="btn-area1">
                                                            <a href="" class="vl-btn1">View Demo</a>
                                                        </div>
                                                        <div class="space20 d-lg-none d-block"></div>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <div class="vl-home-thumb">
                                                        <div class="img1">
                                                            <img src="/img/all-images/demo/demo-img4.png"
                                                                alt="" />
                                                        </div>
                                                        <a href="">RENEV -
                                                            Homepage 04</a>
                                                        <div class="btn-area1">
                                                            <a href="" class="vl-btn1">View Demo</a>
                                                        </div>
                                                        <div class="space20 d-lg-none d-block"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                </li>
                                <li><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}" wire:navigate>About</a></li>
                                <li><a class="nav-link {{ request()->routeIs('services') ? 'active' : '' }}" href="{{ route('services') }}" wire:navigate>Services</a></li>
                                <li><a class="nav-link {{ request()->routeIs('portfolio') ? 'active' : '' }}" href="{{ route('portfolio') }}" wire:navigate>Projects</a></li>
                                <li><a class="nav-link {{ request()->routeIs('testimonials') ? 'active' : '' }}" href="{{ route('testimonials') }}" wire:navigate>Client Say's</a></li>
                                <li><a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}" href="{{ route('blog') }}" wire:navigate>Blogs</a></li>


                                {{-- <li class="has-dropdown">
                                    <a href="#">Pages <span><i
                                                class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="">About Us</a>
                                        </li>
                                        <li>
                                            <a href="">Our Team</a>
                                        </li>
                                        <li>
                                            <a href="">Testimonials</a>
                                        </li>
                                        <li>
                                            <a href="">Contact Us</a>
                                        </li>
                                        <li>
                                            <a href="">FAQ,s</a>
                                        </li>
                                        <li>
                                            <a href="">404</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Services <span><i
                                                class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="">Our Service</a>
                                        </li>
                                        <li>
                                            <a href="">Service Single</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Project <span><i
                                                class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="">Project</a>
                                        </li>
                                        <li>
                                            <a href="">Project Single</a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Blogs <span><i
                                                class="fa-solid fa-angle-down d-lg-inline d-none"></i></span></a>
                                    <ul class="sub-menu">
                                        <li>
                                            <a href="">Blog One</a>
                                        </li>
                                        <li>
                                            <a href="">Blog Two</a>
                                        </li>
                                        <li>
                                            <a href="">Blog Single</a>
                                        </li>
                                    </ul>
                                </li> --}}
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-6">
                    <div class="vl-hero-btn d-none d-lg-block text-end">
                        <span class="vl-btn-wrap text-end"><a href="{{ route('contact') }}" wire:navigate class="vl-btn1"
                                style="overflow: hidden;">Let’s Build Together</a></span>
                        <button class="hamburger_menu"><img src="/img/icons/bars-icons1.svg" alt="" /></button>
                    </div>
                    <div class="vl-header-action-item d-block d-lg-none">
                        <button type="button" class="vl-offcanvas-toggle"><i
                                class="fa-solid fa-bars-staggered"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- =====HEADER END ======= -->
