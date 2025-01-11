
@extends('landing-page-package::layout/landing')
@section('content')
    @if (isset($landingSections) && $landingSections)
        @foreach ($landingSections as $key => $landingSection)
            @if ($landingSection->is_publish && !$landingSection->not_found)
                <section id="{{ $landingSection->slug }}"
                    style="{{ $key == 0 ? 'padding:0px;padding-top: 70.0px;' : 'padding:0;' }}background-color:{{ $landingSection->getElements('section-color') }}"
                    class="theme-alt-bg {{ $landingSection->slug }}-block {{ $landingSection->getElements('section-color') }}">
                    @include('landing-page-package::landing-page/' . $landingSection->slug)
                </section>
            @endif
        @endforeach
    @endif
@endsection

{{-- 
home 
about us 
fetures 
clint
contact us
rating
footer
--}}
