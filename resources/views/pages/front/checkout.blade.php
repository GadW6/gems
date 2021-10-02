@extends('master')

@section('jsdependancy')
    @parent
@endsection

@section('body')

@include('components.front.nav')

<section class="-my-16 container mb-10 min-h-screen mt-20 mx-auto px-4 py-10 text-center">

  <div class="flex flex-col font-light text-center text-green-600">
    <p>
      <svg class="fill-current h-6 mb-1 text-green-600 w-6" viewBox="0 0 20 20">
        <path d="M7.629,14.566c0.125,0.125,0.291,0.188,0.456,0.188c0.164,0,0.329-0.062,0.456-0.188l8.219-8.221c0.252-0.252,0.252-0.659,0-0.911c-0.252-0.252-0.659-0.252-0.911,0l-7.764,7.763L4.152,9.267c-0.252-0.251-0.66-0.251-0.911,0c-0.252,0.252-0.252,0.66,0,0.911L7.629,14.566z"></path>
      </svg>
      Thank You {{ ucfirst(Session::get('user_name')) }}.
    </p>
    <p>
      Your order has been processed.
    </p>
  </div>
  
  <div class="bg-gray-200 flex flex-col lg:flex-row lg:justify-center mt-10 p-5">
    <section class="border-b border-gray-400 flex flex-col lg:border-0 lg:flex-col lg:p-0 md:flex-row pb-3 text-left lg:mx-5">
      <h6 class="font-light">Order number:</h6>
      <p class="font-light lg:ml-0 md:ml-2 text-gray-800">#{{ Session::get('last_order')->id }}</p>
    </section>
    <section class="border-b border-gray-400 flex flex-col lg:border-0 lg:flex-col lg:p-0 md:flex-row py-3 text-left lg:mx-5">
      <h6 class="font-light">Date:</h6>
      <p class="font-light lg:ml-0 md:ml-2 text-gray-800">{{ (new DateTime(Session::get('last_order')->created_at))->format('M d, Y') }}</p>
    </section>
    <section class="border-b border-gray-400 flex flex-col lg:border-0 lg:flex-col lg:p-0 md:flex-row py-3 text-left lg:mx-5">
      <h6 class="font-light">Total:</h6>
      <p class="font-light lg:ml-0 md:ml-2 text-gray-800">&#8362;{{ Session::get('last_order')->total }}</p>
    </section>
    <section class="flex flex-col lg:flex-col lg:p-0 md:flex-row py-3 text-left lg:mx-5">
      <h6 class="font-light">Payment method:</h6>
      <p class="font-light lg:ml-0 md:ml-2 text-gray-800">Credit Card</p>
    </section>
  </div>

  <div class="flex flex-col mt-10 text-left">
    <h2 class="border-b font-thin pb-4 text-2xl text-gray-700">
      Order Details
    </h2>
    <div class="border-b flex flex-col pt-5">
      @foreach ($orders as $order)
        <section class="font-light pb-5 text-gray">
          <p class="float-left"><span class="mr-2 text-yellow-600">{{ ucfirst($order['name']) }}</span>×&nbsp;{{ $order['quantity'] }}</p>
          <p class="float-right">&#8362;{{ $order['price'] * $order['quantity'] }}</p>
        </section>
      @endforeach
    </div>
  </div>

  <div class="border-b flex flex-col font-light py-3">
    <section class="py-2">
      <p class="float-left">Subtotal:</p>
      <p class="float-right">&#8362;{{ (Session::get('last_order')->total) - ((int)Session::all()['condition']->first()->parsedRawValue) }}</p>
    </section>
    <section class="py-2">
      <p class="float-left">Shipping:</p>
      <p class="float-right">&#8362;{{ (int)Session::all()['condition']->first()->parsedRawValue }}</p>
    </section>
    <section class="-mt-1 text-xs">
      <p class="float-right">Via {{ ucfirst(array_values((array) Session::all()['condition']->first())[0]['name']) }}</p>
    </section>
    <section class="py-2">
      <p class="float-left">Payment method:</p>
      <p class="float-right">Credit Card</p>
    </section>
  </div>

  <div class="border-b flex flex-row font-light py-5">
    <h5 class="text-gray-700 text-left text-xl w-full">Total:</h5>
    <h5 class="text-gray-700 text-right text-xl w-full">&#8362;{{ Session::get('last_order')->total }}</h5>
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