 <!-- About Section -->
 <div class="about section" style = "background-color:{{ $landingSection->getElements('section-color') }};">

     <div class="container" data-aos="fade-up">
         <div class="row gx-0">

             <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                 <div class="content">
                     <h3>{{ $landingSection->getElements('title') }}</h3>
                     <h2>{{ $landingSection->getElements('sub-title') }}</h2>
                     <p>
                         {{ $landingSection->getElements('description') }}
                     </p>
                     <div class="text-center text-lg-start mt-2">
                         <a href="#"
                             class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                             <span>{{ $landingSection->getElements('btn-text') }}</span>
                             <i class="bi bi-arrow-right"></i>
                         </a>
                     </div>
                 </div>
             </div>

             <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
                 <img src="{{ $landingSection->getElements('image-url') }}" class="img-fluid animated" alt="{{ $landingSection->getElements('image-alt') }}">
             </div>

         </div>
     </div>

 </div><!-- /About Section -->

 <!-- Values Section -->
 <div class="values section">

     <!-- Section Title -->
     <div class="container section-title" data-aos="fade-up">
         <h2>{{ $landingSection->getElements('values-title') }}</h2>
         <p>{{ $landingSection->getElements('values-sub-title') }}<br></p>
     </div><!-- End Section Title -->

     <div class="container">

         <div class="row gy-4">

             <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                 <div class="card">
                     <img src="{!! $landingSection->getElements('image-url-card-1') !!}" class="img-fluid" alt="{!! $landingSection->getElements('image-alt-card-1') !!}">
                     <h3>{{ $landingSection->getElements('card-title-1') }}</h3>
                     <p>{{ $landingSection->getElements('card-description-1') }}</p>
                 </div>
             </div><!-- End Card Item -->

             <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                 <div class="card">
                     <img src="{!! $landingSection->getElements('image-url-card-2') !!}" class="img-fluid" alt="{!! $landingSection->getElements('image-alt-card-2') !!}">
                     <h3>{{ $landingSection->getElements('card-title-2') }}</h3>
                     <p>{{ $landingSection->getElements('card-description-2') }}</p>
                 </div>
             </div><!-- End Card Item -->

             <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                 <div class="card">
                     <img src="{!! $landingSection->getElements('image-url-card-3') !!}" class="img-fluid" alt="{!! $landingSection->getElements('image-alt-card-3') !!}">
                     <h3>{{ $landingSection->getElements('card-title-3') }}</h3>
                     <p>{{ $landingSection->getElements('card-description-3') }}</p>
                 </div>
             </div><!-- End Card Item -->

         </div>

     </div>

 </div><!-- /Values Section -->

 <!-- Stats Section -->
 <div class="stats section">

     <div class="container" data-aos="fade-up" data-aos-delay="100">

         <div class="row gy-4">

             <div class="col-lg-3 col-md-6">
                 <div class="stats-item d-flex align-items-center w-100 h-100">
                     <i class="{{ $landingSection->getElements('icon-card-class-1') }}"
                         style="color: {{ $landingSection->getElements('icon-card-color-1') }};"></i>
                     <div>
                         <span data-purecounter-start="0"
                             data-purecounter-end="{{ $landingSection->getElements('number-card-1') }}"
                             data-purecounter-duration="1" class="purecounter"></span>
                         <p>{{ $landingSection->getElements('card-number-title-1') }}</p>
                     </div>
                 </div>
             </div><!-- End Stats Item -->

             <div class="col-lg-3 col-md-6">
                 <div class="stats-item d-flex align-items-center w-100 h-100">
                     <i class="{{ $landingSection->getElements('icon-card-class-2') }}"
                         style="color: {{ $landingSection->getElements('icon-card-color-2') }};"></i>
                     <div>
                         <span data-purecounter-start="0"
                             data-purecounter-end="{{ $landingSection->getElements('number-card-2') }}"
                             data-purecounter-duration="1" class="purecounter"></span>
                         <p>{{ $landingSection->getElements('card-number-title-2') }}</p>
                     </div>
                 </div>
             </div><!-- End Stats Item -->

             <div class="col-lg-3 col-md-6">
                 <div class="stats-item d-flex align-items-center w-100 h-100">
                     <i class="{{ $landingSection->getElements('icon-card-class-3') }}"
                         style="color: {{ $landingSection->getElements('icon-card-color-3') }};"></i>
                     <div>
                         <span data-purecounter-start="0"
                             data-purecounter-end="{{ $landingSection->getElements('number-card-3') }}"
                             data-purecounter-duration="1" class="purecounter"></span>
                         <p>{{ $landingSection->getElements('card-number-title-3') }}</p>
                     </div>
                 </div>
             </div><!-- End Stats Item -->

             <div class="col-lg-3 col-md-6">
                 <div class="stats-item d-flex align-items-center w-100 h-100">
                     <i class="{{ $landingSection->getElements('icon-card-class-4') }}"
                         style="color: {{ $landingSection->getElements('icon-card-color-4') }};"></i>
                     <div>
                         <span data-purecounter-start="0"
                             data-purecounter-end="{{ $landingSection->getElements('number-card-4') }}"
                             data-purecounter-duration="1" class="purecounter"></span>
                         <p>{{ $landingSection->getElements('card-number-title-4') }}</p>
                     </div>
                 </div>
             </div>
             <!-- End Stats Item -->

         </div>

     </div>

 </div><!-- /Stats Section -->
