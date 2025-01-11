<!DOCTYPE html>

@php
    $logo = \Nozom\LandingPagePackage\Core\Utility::get_file('logo/');
    $setting = Nozom\LandingPagePackage\Core\Utility::getAdminPaymentSettings();

    if ($setting['color']) {
        $color = $setting['color'];
    } else {
        $color = 'theme-3';
    }
    
    $dark_mode = $setting['cust_darklayout'];
    $cust_theme_bg = $setting['cust_theme_bg'];
    // $SITE_RTL = env('SITE_RTL');
    $SITE_RTL = $setting['site_rtl'];
    $meta_setting = Nozom\LandingPagePackage\Core\Utility::getAdminPaymentSettings();
    $meta_images = \Nozom\LandingPagePackage\Core\Utility::get_file('uploads/logo/');
    $update = isset($setting['update']) ? $setting['update'] : 'off';
    $settings = Nozom\LandingPagePackage\Core\Utility::getAdminPaymentSettings();

    if ($color == '' || $color == null) {
        $color = $settings['color'];
    }

    if ($dark_mode == '' || $dark_mode == null) {
        $dark_mode = $settings['cust_darklayout'];
    }

    if ($cust_theme_bg == '' || $dark_mode == null) {
        $cust_theme_bg = $settings['cust_theme_bg'];
    }

    if ($SITE_RTL == '' || $SITE_RTL == null) {
        $SITE_RTL = env('SITE_RTL');
    }
    if (\App::getLocale() == 'ar' || \App::getLocale() == 'he') {
        $SITE_RTL = 'on';
    }
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $setting['site_rtl'] == 'on' ? 'rtl' : '' }}">
<head>

    <title>{{ env('APP_NAME') }}</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="WorkDo" />
    <meta name="title" content="{{ $meta_setting['meta_keywords'] }}">
    <meta name="description" content="{{ $meta_setting['meta_description'] }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content= "{{ env('APP_URL') }}">
    <meta property="og:title" content="{{ $meta_setting['meta_keywords'] }}">
    <meta property="og:description" content="{{ $meta_setting['meta_description'] }}">
    <meta property="og:image" content="{{ asset($meta_images . $meta_setting['meta_image']) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:title" content="{{ $meta_setting['meta_keywords'] }}">
    <meta property="twitter:description" content="{{ $meta_setting['meta_description'] }}">
    <meta property="twitter:image" content="{{ asset($meta_images . $meta_setting['meta_image']) }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset($logo . 'favicon.png') }}">
    <!-- vendor css -->
    @if (str_replace('_', '-', app()->getLocale()) == "ar")
        <link href="{{ asset('vendor/landing-page-package/assets/vendor/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/landing-page-package/assets/css/main-rtl.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/landing-page-package/assets/vendor/bootstrap-icons/bootstrap-icons.rtl.css') }}" rel="stylesheet">

    @else
        <link href="{{ asset('vendor/landing-page-package/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/landing-page-package/assets/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/landing-page-package/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    @endif

    <link href="{{ asset('vendor/landing-page-package/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/landing-page-package/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/landing-page-package/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<style>
    pre , p , span{
        margin: 0 !important;
        padding: 0;
        overflow: hidden;
    }

</style>
    <!-- Main CSS File -->

</head>

<body class="{{ $color }}">

    <!-- [ Nav ] start -->
    @include('landing-page-package::landing-page/navbar')
    <!-- [ Nav ] start -->
    @yield('content')
    <footer id="footer" class="footer">


        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename"><img src="{{ $element->getElement('header-logo') }}"
                                style="width: 60px;height: 50px;" alt="logo" /></span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>{{ $element->getElement('card-1-line-1') }}</p>
                        <p>{{ $element->getElement('card-1-line-2') }}</p>
                        <p class="mt-3"><strong>Phone:</strong>
                            <span>{{ $element->getElement('card-2-line-1') }}</span></p>
                        <p><strong>Email:</strong> <span>{{ $element->getElement('card-3-line-1') }}</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        @if (isset($elements) && $elements)
                            @foreach ($elements as $element)
                                @if ($element->is_publish && !$element->not_found)
                                    <li class="nav-item">
                                        <a class="bi bi-chevron-right" href="#{{ $element->slug }}">
                                            @if (app()->getLocale() == 'ar')
                                                {{ $element->ar_name }}
                                            @else
                                                {{ $element->name }}
                                            @endif
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">

                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links d-flex">
                        <a href="{{ $element->getElement('twitter-link') }}"><i
                                class="bi bi-twitter-x"></i></a>
                        <a href="{{ $element->getElement('facebook-link') }}"><i
                                class="bi bi-facebook"></i></a>
                        <a href="{{ $element->getElement('instagram-link') }}"><i
                                class="bi bi-instagram"></i></a>
                        <a href="{{ $element->getElement('linkedin-link') }}"><i
                                class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong
                    class="px-1 sitename">{{ $element->getElement('copyright-name') }}</strong> <span>All
                    Rights Reserved</span></p>
            <div class="credits">
            </div>
        </div>

    </footer>
    @if ($meta_setting['enable_cookie'] == 'on')
        @include('layouts.cookie_consent')
    @endif
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('vendor/landing-page-package/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/landing-page-package/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('vendor/landing-page-package/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('vendor/landing-page-package/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/landing-page-package/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/landing-page-package/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/landing-page-package/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/landing-page-package/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('vendor/landing-page-package/assets/js/main.js') }}"></script>

</body>

</html>