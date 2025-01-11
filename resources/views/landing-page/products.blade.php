<style>
    .pricing-tem .btn-buy {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        display: inline-block;
    }
</style>
<div class="pricing section">

    <div class="container section-title" data-aos="fade-up">
        <h2>{{ $landingSection->getElements('title') }}</h2>
        <p>{{ $landingSection->getElements('sub-title') }}<br></p>
    </div>

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="pricing-tem">
                    <div class="icon">
                        <img src="{!! $landingSection->getElements('card-image-1') !!}" class="img-fluid" alt="{!! $landingSection->getElements('image-alt-card-1') !!}">
                    </div>
                    <h3>{{ $landingSection->getElements('card-title-1') }}</h3>
                    <p>{{ $landingSection->getElements('card-dec-1') }}<br></p>
                    <a href="{{ $landingSection->getElements('card-link-1') }}" class="btn-buy mt-3">Buy Now</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="pricing-tem">
                    <div class="icon">
                        <img src="{!! $landingSection->getElements('card-image-2') !!}" class="img-fluid" alt="{!! $landingSection->getElements('image-alt-card-1') !!}">
                    </div>
                    <h3>{{ $landingSection->getElements('card-title-2') }}</h3>
                    <p>{{ $landingSection->getElements('card-dec-2') }}<br></p>
                    <a href="{{ $landingSection->getElements('card-link-2') }}" class="btn-buy mt-3">Buy Now</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="pricing-tem">
                    <div class="icon">
                        <img src="{!! $landingSection->getElements('card-image-3') !!}" class="img-fluid" alt="{!! $landingSection->getElements('image-alt-card-1') !!}">
                    </div>
                    <h3>{{ $landingSection->getElements('card-title-3') }}</h3>
                    <p>{{ $landingSection->getElements('card-dec-3') }}<br></p>
                    <a href="{{ $landingSection->getElements('card-link-3') }}" class="btn-buy mt-3">Buy Now</a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="pricing-tem">
                    <div class="icon">
                        <img src="{!! $landingSection->getElements('card-image-4') !!}" class="img-fluid" alt="{!! $landingSection->getElements('image-alt-card-1') !!}">
                    </div>
                    <h3>{{ $landingSection->getElements('card-title-4') }}</h3>
                    <p>{{ $landingSection->getElements('card-dec-4') }}<br></p>
                    <a href="{{ $landingSection->getElements('card-link-4') }}" class="btn-buy mt-3">Buy Now</a>
                </div>
            </div>
        </div>

    </div>

</div>
