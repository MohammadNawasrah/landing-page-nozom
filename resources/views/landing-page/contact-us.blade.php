    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>{{ $landingSection->getElements('title') }}</h2>
            <p>{{ $landingSection->getElements('sub-title') }}</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">

                <div class="col-lg-6">

                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="200">
                                <i class="{{ $landingSection->getElements('card-1-icon') }}"></i>
                                <h3>{{ $landingSection->getElements('card-title-1') }}</h3>
                                <p>{{ $landingSection->getElements('card-1-line-1') }}</p>
                                <p>{{ $landingSection->getElements('card-1-line-2') }}</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="300">
                                <i class="{{ $landingSection->getElements('card-2-icon') }}"></i>
                                <h3>{{ $landingSection->getElements('card-title-2') }}</h3>
                                <p>{{ $landingSection->getElements('card-2-line-1') }}</p>
                                <p>{{ $landingSection->getElements('card-2-line-2') }}</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="400">
                                <i class="{{ $landingSection->getElements('card-3-icon') }}"></i>
                                <h3>{{ $landingSection->getElements('card-title-3') }}</h3>
                                <p>{{ $landingSection->getElements('card-3-line-1') }}</p>
                                <p>{{ $landingSection->getElements('card-3-line-2') }}</p>
                            </div>
                        </div><!-- End Info Item -->

                        <div class="col-md-6">
                            <div class="info-item" data-aos="fade" data-aos-delay="500">
                                <i class="{{ $landingSection->getElements('card-4-icon') }}"></i>
                                <h3>{{ $landingSection->getElements('card-title-4') }}</h3>
                                <p>{{ $landingSection->getElements('card-4-line-1') }}</p>
                                <p>{{ $landingSection->getElements('card-4-line-2') }}</p>
                            </div>
                        </div><!-- End Info Item -->

                    </div>

                </div>

                <div class="col-lg-6">
                    <form id="messageForm" method="POST" action="{{ route('landing.store') }}#buyNow"
                        class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                        @csrf
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" class="form-control" id="sender_name" name="sender_name"
                                    placeholder="Your Name" required="">
                            </div>

                            <div class="col-md-6 ">
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="Your Email" required="">
                            </div>

                            <div class="col-12">
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    placeholder="Your Phome Number" required="">
                            </div>

                            <div class="col-12">
                                <textarea class="form-control" name="message" id="message" rows="6" placeholder="Your Message" required=""></textarea>
                            </div>

                            <div class="col-12 text-center">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <button type="submit">Send Message</button>
                            </div>

                        </div>
                    </form>
                </div><!-- End Contact Form -->

            </div>

        </div>

    </section><!-- /Contact Section -->
