@php
    $menu = App\Menu::all();
@endphp

@extends('master')

@section('jsdependancy')
    @parent
    <style>
      .gradient {
        background-image: linear-gradient(135deg, #684ca0 35%, #1c4ca0 100%);
      }
    </style>
@endsection

@section('body')

{{-- @extends('layout.nav') --}}
@include('components.front.nav')

<section class="-my-16 min-h-screen mt-16 pb-16 text-center">

  <div class="flex h-screen items-center text-gray-800 text-white w-screen">
    <div class="container flex flex-wrap items-center md:-mt-24 mx-auto p-4">
      <div class="w-full md:w-5/12 text-center p-4">
        <img src="{{ asset('icons/404_icon.svg') }}" alt="Not Found" />
      </div>
      <div class="w-full md:w-7/12 text-center md:text-left p-4">
        <div class="text-6xl font-medium">404</div>
        <div class="text-xl md:text-3xl font-medium mb-4">
          Oops. This page has gone missing.
        </div>
        <div class="text-lg mb-8">
          You may have mistyped the address or the page may have moved.
        </div>
        <a href="{{ url('/') }}" class="border border-yellow-600 p-4">Go Home</a>
      </div>
    </div>
  </div>

</section>  

@if (!Session::has('user_id'))
  @include('components.front.login')  
@endif

@include('components.front.footer')

@endsection

@section('jsdependancy')
    @parent
@endsection