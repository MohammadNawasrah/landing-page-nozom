<div class="clients section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <h2>{{ $landingSection->getElements('our-clients') }}
        </h2>
        <p>{{ $landingSection->getElements('sub-title') }}<br></p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 40
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 60
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 80
              },
              "992": {
                "slidesPerView": 6,
                "spaceBetween": 120
              }
            }
          }
        </script>
            <div class="swiper-wrapper align-items-center">
              @if (isset($clients))
                @foreach ($clients as $client)
                    @if ($client->is_published)
                        <div class="swiper-slide">
                            <img class="img-fluid" style="width: 140px;height: 140px;"
                                src="{{ url('storage') . '/' . $client->image }}"
                                alt="{{ $client->image_alt . '/' . $client->client_name }} ">
                        </div>
                    @endif
                @endforeach
              @endif

            </div>
            <div class="swiper-pagination"></div>
        </div>

    </div>
</div>
