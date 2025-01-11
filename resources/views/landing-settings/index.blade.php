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
    <li class="breadcrumb-item"> {{ __('Landing Settings') }}</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            @include("landing-page-package::landing-settings/tabels/sections")
        </div>
        <div class="col-12">
            @include("landing-page-package::landing-settings/tabels/elements")
        </div>
    </div>
@endsection
