@extends('master')

@section('cssdependancy')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/shop.css') }}">
@endsection

@section('body')

@include('components.front.nav')

{{-- HERO SECTION --}}
@include('components.front.hero_carousel')

{{-- FULL GALLERY --}}
@include('components.front.full_gallery')

@if (!Session::has('user_id'))
  @include('components.front.login')  
@endif


@include('components.front.footer')

@endsection

@section('jsdependancy')
    @parent
@endsection