    <!-- Faq Section -->
    <section id="faq" class="faq section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ $landingSection->getElements('faq') }}</h2>
            <p>{{ $landingSection->getElements('sub-title') }}</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row">

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

                    <div class="faq-container">

                        <div class="faq-item faq-active">
                            <h3>{{ $landingSection->getElements('title-faq-1') }}</h3>
                            <div class="faq-content">
                                <p>{{ $landingSection->getElements('desc-faq-1') }}</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>{{ $landingSection->getElements('title-faq-2') }}</h3>
                            <div class="faq-content">
                                <p>{{ $landingSection->getElements('desc-faq-2') }}</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>{{ $landingSection->getElements('title-faq-3') }}</h3>
                            <div class="faq-content">
                                <p>{{ $landingSection->getElements('desc-faq-3') }}</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div><!-- End Faq Column-->

                <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

                    <div class="faq-container">

                        <div class="faq-item">
                            <h3>{{ $landingSection->getElements('title-faq-4') }}</h3>
                            <div class="faq-content">
                                <p>{{ $landingSection->getElements('desc-faq-4') }}</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>{{ $landingSection->getElements('title-faq-5') }}</h3>
                            <div class="faq-content">
                                <p>{{ $landingSection->getElements('desc-faq-5') }}</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item">
                            <h3>{{ $landingSection->getElements('title-faq-6') }}</h3>
                            <div class="faq-content">
                                <p>{{ $landingSection->getElements('desc-faq-6') }}</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div><!-- End Faq Column-->

            </div>

        </div>

    </section><!-- /Faq Section -->
