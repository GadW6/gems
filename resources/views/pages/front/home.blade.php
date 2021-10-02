@extends('master')

@section('cssdependancy')
    @parent
@endsection

@section('body')

@include('components.front.nav')

<section class="-my-16 container min-h-screen mt-20 mx-auto p-24 text-center">

	<div class="flex flex-col-reverse sm:flex-row mt-8 sm:mt-0">
		<div class="flex-1 mt-6 sm:mr-6 self-center sm:-mt-32">
			<h1 class="text-2xl sm:text-5xl text-gray-800 font-bold whitespace-no-wrap mb-2">Shopping for GEMS</h1>
			<p class="">The best shop online for Gems, Gold, etc...</p>
			<a href="{{ url('/shop') }}" class="border border-yellow-600 inline-block mt-6 p-4 text-yellow-700 hover:bg-yellow-600 hover:text-gray-900">Shop Now</a>
		</div>
		<div class="sm:w-2/3">
			<img src="{{ asset('storage/icons/store.svg') }}">
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