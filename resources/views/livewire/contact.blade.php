@section('body-attributes', 'class=body-bg1')
<div>
    <div class="inner-section-area"
        style="background-image: url(/img/all-images/bg/hero-bg1.png); background-position: center top; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="hero-header-area">
                        <h1>Contact Us</h1>
                        <div class="space32"></div>
                        <h4><a href="{{ route('home') }}">Home</a> <i class="fa-solid fa-angle-right"></i> <a
                                href="#">Contact Us</a></h4>
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
    <div class="contact-inner-area sp6">
        <img src="/img/elements/elements15.png" alt="" class="elements15" />
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="heading1 text-center">
                        <h5><span><img src="/img/icons/sub-logo2.svg" alt="" /></span>Have Questions? Reach Out!
                        </h5>
                        <div class="space20"></div>
                        <h2>Connect with Renev Today</h2>
                    </div>

                    <div class="space40"></div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="widget-contactbox">
                                <div class="icons">
                                    <img src="/img/icons/mail2.svg" alt="" />
                                </div>
                                <div class="content">
                                    <h4>Our Email</h4>
                                    <a href="mailto:eitechsolut@gmail.com">renevweb@gmail.com</a>
                                </div>
                            </div>
                            <div class="space30 d-lg-none d-block"></div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="widget-contactbox">
                                <div class="icons">
                                    <img src="/img/icons/phn2.svg" alt="" />
                                </div>
                                <div class="content">
                                    <h4>Phone</h4>
                                    <a href="tel:+11234567890">+1 123 456 7890</a>
                                </div>
                            </div>
                            <div class="space30 d-lg-none d-block"></div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="widget-contactbox">
                                <div class="icons">
                                    <img src="/img/icons/clock2.svg" alt="" />
                                </div>
                                <div class="content">
                                    <h4>Schedule</h4>
                                    <a href="mailto:eitechsolut@gmail.com">Sunday-Fri: 9 AM – 6 PM</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="space60"></div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-images">
                                <img src="/img/elements/elements21.png" alt="" class="elements21" />
                                <div class="img1">
                                    <img src="/img/all-images/contact/contact-img1.png" alt="" />
                                </div>
                                <div class="img2">
                                    <img src="/img/all-images/contact/contact-img2.png" alt="" />
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="contact-author-boxarea">
                                <h3>Get In Touch Now</h3>
                                <div class="space8"></div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-area">
                                            <input type="text" placeholder="First Name*" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="input-area">
                                            <input type="text" placeholder="Last Name*" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="input-area">
                                            <input type="number" placeholder="Phone Number*" />
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="input-area">
                                            <input type="email" placeholder="Email Address*" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="input-area">
                                            <input type="text" placeholder="Service Type*" />
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="input-area">
                                            <textarea placeholder="Your Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="space32"></div>
                                        <div class="input-area text-end">
                                            <button type="submit" class="vl-btn1" style="overflow: hidden;">Send
                                                Your Request</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="space60"></div>
                    <div class="maps-area">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4506257.120552435!2d88.67021924228865!3d21.954385721237916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1704088968016!5m2!1sen!2sbd"
                            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
