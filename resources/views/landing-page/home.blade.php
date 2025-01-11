<div class="hero section">

    <div class="container">
        <div class="row gy-4">
            <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                <h1 data-aos="fade-up">{{ $landingSection->getElements('title') }}</h1>
                <h4 data-aos="fade-up">{{ $landingSection->getElements('sub-title') }}</h4>
                <p data-aos="fade-up" data-aos-delay="100">{{ $landingSection->getElements('description') }}</p>
                <div class="d-flex flex-column flex-md-row" data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('login') }}" class="btn-get-started">{!! $landingSection->getElements('btn-icon') !!}
                        {{ $landingSection->getElements('btn-text') }} <i class="bi bi-arrow-right"></i></a>
                    {{-- <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox btn-watch-video d-flex align-items-center justify-content-center ms-0 ms-md-4 mt-4 mt-md-0"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> --}}
                </div>
            </div>
            <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                <img src="{!! $landingSection->getElements('image-url') !!}" class="img-fluid animated" alt="{!! $landingSection->getElements('image-alt') !!}">
            </div>
        </div>
    </div> 

</div>
