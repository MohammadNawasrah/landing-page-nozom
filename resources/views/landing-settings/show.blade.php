@extends('layouts.admin')
@section('page-title')
    {{ __('Landing Settings') }}
@endsection

@section('links')
    @if (\Auth::guard('client')->check())
        <li class="breadcrumb-item"><a href="{{ route('client.home') }}">{{ __('Home') }}</a></li>
    @else
        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
    @endif
    <li class="breadcrumb-item" ><a href="{{ route('landing-settings.index') }}">{{ __('Landing Sections') }}</a></li>
    <li class="breadcrumb-item"> {{ app()->getLocale() == "ar" ? $section->ar_name : $section->name  }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @include("landing-page-package::landing-settings/tabels/section-elements")
        </div>
    </div>
@endsection
