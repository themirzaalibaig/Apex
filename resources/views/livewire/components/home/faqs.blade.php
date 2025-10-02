 <div class="faq-inner-section-area sp6">
     <img src="/img/elements/elements15.png" alt="" class="elements15" />
     <div class="container">
         <div class="row">
             <div class="col-lg-7 m-auto">
                 <div class="heading1 text-center space-margin60">
                     <h2>Frequently Asked Question</h2>
                 </div>
             </div>
         </div>
         <div class="row">
             <div class="col-lg-10 m-auto">
                 <div class="faq-widget-area text-center">
                     {{-- <ul class="nav nav-pills" id="pills-tab" role="tablist">
                         <li class="nav-item" role="presentation">
                             <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                 data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                 aria-selected="true">All</button>
                         </li>
                         <li class="nav-item" role="presentation">
                             <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                 data-bs-target="#pills-profile" type="button" role="tab"
                                 aria-controls="pills-profile" aria-selected="false">UI/UX Design</button>
                         </li>
                         <li class="nav-item" role="presentation">
                             <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                 data-bs-target="#pills-contact" type="button" role="tab"
                                 aria-controls="pills-contact" aria-selected="false">Development</button>
                         </li>

                         <li class="nav-item" role="presentation">
                             <button class="nav-link" id="pills-contact1-tab" data-bs-toggle="pill"
                                 data-bs-target="#pills-contact1" type="button" role="tab"
                                 aria-controls="pills-contact1" aria-selected="false">Content And Branding</button>
                         </li>

                         <li class="nav-item" role="presentation">
                             <button class="nav-link m-0" id="pills-contact2-tab" data-bs-toggle="pill"
                                 data-bs-target="#pills-contact2" type="button" role="tab"
                                 aria-controls="pills-contact2" aria-selected="false">5. SEO and Performance</button>
                         </li>
                     </ul> --}}
                     <div class="space48"></div>
                     <div class="tab-content" id="pills-tabContent">
                         <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                             aria-labelledby="pills-home-tab" tabindex="0">
                             <div class="faq-section-area">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <div class="accordian-area">
                                             <div class="accordion" id="accordionExample">
                                                @foreach($faqs as $faq)
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button class="accordion-button"
                                                             type="button" data-bs-toggle="collapse"
                                                             data-bs-target="#collapseOne" aria-expanded="true"
                                                             aria-controls="collapseOne">{{ $faq->question }}
                                                             </button></h2>
                                                     <div id="collapseOne" class="accordion-collapse collapse show"
                                                         data-bs-parent="#accordionExample">
                                                         <div class="accordion-body">
                                                             <p>{{ $faq->answer }}</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                @endforeach
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>


                         {{-- <div class="tab-pane fade" id="pills-profile" role="tabpanel"
                             aria-labelledby="pills-profile-tab" tabindex="0">
                             <div class="faq-section-area">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <div class="accordian-area">
                                             <div class="accordion" id="accordionExample3">
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button class="accordion-button"
                                                             type="button" data-bs-toggle="collapse"
                                                             data-bs-target="#collapseEleven" aria-expanded="true"
                                                             aria-controls="collapseEleven">What services does Renev
                                                             offer?</button></h2>
                                                     <div id="collapseEleven" class="accordion-collapse collapse show"
                                                         data-bs-parent="#accordionExample3">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwelve" aria-expanded="false"
                                                             aria-controls="collapseTwelve">Can you update my existing
                                                             website?</button></h2>
                                                     <div id="collapseTwelve" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample3">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseThirteen" aria-expanded="false"
                                                             aria-controls="collapseThirteen">Will I have input in the
                                                             design process?</button></h2>
                                                     <div id="collapseThirteen" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample3">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseFourteen" aria-expanded="false"
                                                             aria-controls="collapseFourteen">How much does a new
                                                             website cost?</button></h2>
                                                     <div id="collapseFourteen" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample3">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseFifteen" aria-expanded="false"
                                                             aria-controls="collapseFifteen">Will my website be
                                                             mobile-friendly?</button></h2>
                                                     <div id="collapseFifteen" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample3">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                             aria-labelledby="pills-contact-tab" tabindex="0">
                             <div class="faq-section-area">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <div class="accordian-area">
                                             <div class="accordion" id="accordionExample5">
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button class="accordion-button"
                                                             type="button" data-bs-toggle="collapse"
                                                             data-bs-target="#collapseSixteen" aria-expanded="true"
                                                             aria-controls="collapseSixteen">What services does Renev
                                                             offer?</button></h2>
                                                     <div id="collapseSixteen"
                                                         class="accordion-collapse collapse show"
                                                         data-bs-parent="#accordionExample5">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseSeventeen" aria-expanded="false"
                                                             aria-controls="collapseSeventeen">Can you update my
                                                             existing website?</button></h2>
                                                     <div id="collapseSeventeen" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample5">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseEightteen" aria-expanded="false"
                                                             aria-controls="collapseEightteen">Will I have input in the
                                                             design process?</button></h2>
                                                     <div id="collapseEightteen" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample5">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseNineteen" aria-expanded="false"
                                                             aria-controls="collapseNineteen">How much does a new
                                                             website cost?</button></h2>
                                                     <div id="collapseNineteen" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample5">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwenty" aria-expanded="false"
                                                             aria-controls="collapseTwenty">Will my website be
                                                             mobile-friendly?</button></h2>
                                                     <div id="collapseTwenty" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample5">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="tab-pane fade" id="pills-contact1" role="tabpanel"
                             aria-labelledby="pills-contact1-tab" tabindex="0">
                             <div class="faq-section-area">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <div class="accordian-area">
                                             <div class="accordion" id="accordionExample7">
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button class="accordion-button"
                                                             type="button" data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwentyone" aria-expanded="true"
                                                             aria-controls="collapseTwentyone">What services does Renev
                                                             offer?</button></h2>
                                                     <div id="collapseTwentyone"
                                                         class="accordion-collapse collapse show"
                                                         data-bs-parent="#accordionExample7">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwentytwo" aria-expanded="false"
                                                             aria-controls="collapseTwentytwo">Can you update my
                                                             existing website?</button></h2>
                                                     <div id="collapseTwentytwo" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample7">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwentythree"
                                                             aria-expanded="false"
                                                             aria-controls="collapseTwentythree">Will I have input in
                                                             the design process?</button></h2>
                                                     <div id="collapseTwentythree" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample7">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwentyfour"
                                                             aria-expanded="false"
                                                             aria-controls="collapseTwentyfour">How much does a new
                                                             website cost?</button></h2>
                                                     <div id="collapseTwentyfour" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample7">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwentyfive"
                                                             aria-expanded="false"
                                                             aria-controls="collapseTwentyfive">Will my website be
                                                             mobile-friendly?</button></h2>
                                                     <div id="collapseTwentyfive" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample7">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="tab-pane fade" id="pills-contact2" role="tabpanel"
                             aria-labelledby="pills-contact2-tab" tabindex="0">
                             <div class="faq-section-area">
                                 <div class="row">
                                     <div class="col-lg-12">
                                         <div class="accordian-area">
                                             <div class="accordion" id="accordionExample9">
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button class="accordion-button"
                                                             type="button" data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwentysix" aria-expanded="true"
                                                             aria-controls="collapseTwentysix">What services does Renev
                                                             offer?</button></h2>
                                                     <div id="collapseTwentysix"
                                                         class="accordion-collapse collapse show"
                                                         data-bs-parent="#accordionExample9">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwentyseven"
                                                             aria-expanded="false"
                                                             aria-controls="collapseTwentyseven">Can you update my
                                                             existing website?</button></h2>
                                                     <div id="collapseTwentyseven" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample9">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwentyeight"
                                                             aria-expanded="false"
                                                             aria-controls="collapseTwentyeight">Will I have input in
                                                             the design process?</button></h2>
                                                     <div id="collapseTwentyeight" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample9">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseTwentynine"
                                                             aria-expanded="false"
                                                             aria-controls="collapseTwentynine">How much does a new
                                                             website cost?</button></h2>
                                                     <div id="collapseTwentynine" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample9">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="space20"></div>
                                                 <div class="accordion-item">
                                                     <h2 class="accordion-header"><button
                                                             class="accordion-button collapsed" type="button"
                                                             data-bs-toggle="collapse"
                                                             data-bs-target="#collapseThirty" aria-expanded="false"
                                                             aria-controls="collapseThirty">Will my website be
                                                             mobile-friendly?</button></h2>
                                                     <div id="collapseThirty" class="accordion-collapse collapse"
                                                         data-bs-parent="#accordionExample9">
                                                         <div class="accordion-body">
                                                             <p>We’ve worked with clients across various industries,
                                                                 including retail, healthcare, technology, to education,
                                                                 hospitality, more. Our team every design to meet the
                                                                 unique needs your business.</p>
                                                         </div>
                                                     </div>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div> --}}
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
