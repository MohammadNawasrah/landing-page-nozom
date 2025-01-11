
@php
$languages = \Nozom\LandingPagePackage\Core\Utility::languages();
$setting = \Nozom\LandingPagePackage\Core\Utility::getAdminPaymentSettings();
Nozom\LandingPagePackage\Core\Utility::setCaptchaConfig();
@endphp
<header id="header" class="header d-flex align-items-center fixed-top"
    style="background-color:{{ $element->getElement('header-color') }};">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="#" class="logo d-flex align-items-center me-auto">
            <img src="{{ $element->getElement('header-logo') }}" style="width: 60px;height: 50px;" alt="logo" />
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                @if (isset($landingSections) && $landingSections)
                    @foreach ($landingSections as $landingSection)
                        @if ($landingSection->is_publish && !$landingSection->not_found)
                            <li class="nav-item">
                                <a class="nav-link" href="#{{ $landingSection->slug }}">
                                    @if (app()->getLocale() == 'ar')
                                        {{ $landingSection->ar_name }}
                                    @else
                                        {{ $landingSection->name }}
                                    @endif
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
                @if ($element->getElement('header-lang'))
                    <div href="#" class="lang-dropdown-only-desk">
                        <li class="dropdown"><a href="#"><span>{{ ucFirst($languages[$lang]) }}</span> <i
                                    class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li class="dropdown">
                                    @foreach ($languages as $code => $language)
                                        @if (in_array($code, ['ar', 'en']))
                                            <a href="{{ route('landing', $code) }}" tabindex="0"
                                                class="dropdown-item {{ $code == $lang ? 'active' : '' }}">
                                                <i class="bi bi-chevron-right toggle-dropdown"></i>
                                                <span>{{ ucFirst($language) }}</span>
                                            </a>
                                        @endif
                                    @endforeach
                                </li>
                            </ul>
                        </li>
                    </div>
                @endif
            </ul>
        </nav>

        <a class="btn-getstarted flex-md-shrink-0" href="{{ route('login') }}">{{ __('Login') }}</a>

    </div>
</header>
