    <!-- Features Section -->
    <div class="features section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ $landingSection->getElements('title') }}</h2>
            <p>{{ $landingSection->getElements('sub-title') }}<br></p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-5">

                <div class="col-xl-6" data-aos="zoom-out" data-aos-delay="100">
                    <img src="{{ $landingSection->getElements('src-image') }}" class="img-fluid"
                        alt="{{ $landingSection->getElements('alt-image') }}">
                </div>

                <div class="col-xl-6 d-flex">
                    <div class="row align-self-center gy-4">

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>{{ $landingSection->getElements('features-1') }}</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>{{ $landingSection->getElements('features-2') }}</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>{{ $landingSection->getElements('features-3') }}</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>{{ $landingSection->getElements('features-4') }}</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>{{ $landingSection->getElements('features-5') }}</h3>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6" data-aos="fade-up" data-aos-delay="700">
                            <div class="feature-box d-flex align-items-center">
                                <i class="bi bi-check"></i>
                                <h3>{{ $landingSection->getElements('features-6') }}</h3>
                            </div>
                        </div><!-- End Feature Item -->

                    </div>
                </div>

            </div>

        </div>

    </div><!-- /Features Section -->

    <!-- Alt Features Section -->
    <div class="alt-features section">

        <div class="container">

            <div class="row gy-5">

                <div class="col-xl-7 d-flex order-2 order-xl-1" data-aos="fade-up" data-aos-delay="200">

                    <div class="row align-self-center gy-5">

                        <div class="col-md-6 icon-box">
                            <i class="{{ $landingSection->getElements('icon-1') }}"></i>
                            <div class="content">
                                <h4>{{ $landingSection->getElements('advacedd-title-1') }}</h4>
                                <p>{{ $landingSection->getElements('advacedd-desc-1') }}</p>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="{{ $landingSection->getElements('icon-2') }}"></i>
                            <div class="content">
                                <h4>{{ $landingSection->getElements('advacedd-title-2') }}</h4>
                                <p>{{ $landingSection->getElements('advacedd-desc-2') }}</p>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="{{ $landingSection->getElements('icon-3') }}"></i>
                            <div class="content">
                                <h4>{{ $landingSection->getElements('advacedd-title-3') }}</h4>
                                <p>{{ $landingSection->getElements('advacedd-desc-3') }}</p>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="{{ $landingSection->getElements('icon-4') }}"></i>
                            <div class="content">
                                <h4>{{ $landingSection->getElements('advacedd-title-4') }}</h4>
                                <p>{{ $landingSection->getElements('advacedd-desc-4') }}</p>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="{{ $landingSection->getElements('icon-5') }}"></i>
                            <div class="content">
                                <h4>{{ $landingSection->getElements('advacedd-title-5') }}</h4>
                                <p>{{ $landingSection->getElements('advacedd-desc-5') }}</p>
                            </div>
                        </div><!-- End Feature Item -->

                        <div class="col-md-6 icon-box">
                            <i class="{{ $landingSection->getElements('icon-6') }}"></i>
                            <div class="content">
                                <h4>{{ $landingSection->getElements('advacedd-title-6') }}</h4>
                                <p>{{ $landingSection->getElements('advacedd-desc-6') }}</p>
                            </div>
                        </div><!-- End Feature Item -->

                    </div>

                </div>

                <div class="col-xl-5 d-flex align-items-center order-1 order-xl-2" data-aos="fade-up"
                    data-aos-delay="100">
                    <img src="{{ $landingSection->getElements('src-image-2') }}" class="img-fluid"
                        alt="{{ $landingSection->getElements('alt-image-2') }}">
                </div>

            </div>

        </div>

    </div><!-- /Alt Features Section -->
