@extends('master')

@section('jsdependancy')
    @parent
@endsection

@section('body')

{{-- @extends('layout.nav') --}}
@include('components.front.nav')

<section class="-my-16 container min-h-screen mt-20 mx-auto px-24 py-10 text-center">

  @foreach ($contents as $content)
  <div class="wrapper my-12 shadow-sm pb-8">
    <h2 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl mb-8">
      {{ $content->c_title }}
    </h2>

    {!! $content->c_article !!}
  </div>
  @endforeach

</section>  

@if (!Session::has('user_id'))
  @include('components.front.login')  
@endif

@include('components.front.footer')

@endsection

@section('jsdependancy')
    @parent
@endsection