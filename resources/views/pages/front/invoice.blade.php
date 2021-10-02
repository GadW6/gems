@extends('master')

@section('cssdependancy')
    @parent
@endsection

@section('body')

@include('components.front.nav')


<section class="container mt-20 mx-auto mb-0">

  <!-- Main component -->
  <div class="antialiased flex flex-col md:h-screen font-sans md:flex-row md:px-0 px-4 py-10">

  
    <!-- Left Sidebar -->
    <div class="flex-none md:block md:mr-4 md:w-1/4 text-center">
      <section>
        @if ($user->image == 'no-image.png')
          <img class="bg-gray-300 h-24 p-2 rounded-full w-24" src="{{ asset('/storage/avatars/' . $user->image ) }}">  
          @else
          <img class="bg-gray-300 h-32 object-center object-cover p-2 rounded-full w-32" src="{{ asset('/storage/avatars/' . $user->image ) }}">  
        @endif
        <p class="border-b border-t font-light mt-5 py-3">Hello <span class="text-gray-700">{{ ucfirst($user->name) }}</span></p>
      </section>
      <section class="md:mt-6 mt-12 overflow-hidden">
        @include('components.front.user_sidebar')
      </section>
    </div>

    
    <!-- Right content -->
    <div class="flex flex-1 flex-col md:ml-4 md:pb-20 overflow-hidden text-center xl:pb-10">
      <section class="md:max-h-full md:mt-0 mt-10 md:overflow-y-scroll">
        <h2 class="border-b font-light inline-flex mb-6 pb-3 text-2xl">Invoice:</h2>
      
        <div class="bg-gray-200 flex flex-col lg:flex-row lg:justify-center md:mt-10 p-5">
          <section class="border-b border-gray-400 flex flex-col lg:border-0 lg:flex-col lg:p-0 md:flex-row pb-3 text-left lg:mx-5">
            <h6 class="font-light">Order number:</h6>
            <p class="font-light lg:ml-0 md:ml-2 text-gray-800">#{{ $order->id }}</p>
          </section>
          <section class="border-b border-gray-400 flex flex-col lg:border-0 lg:flex-col lg:p-0 md:flex-row py-3 text-left lg:mx-5">
            <h6 class="font-light">Date:</h6>
            <p class="font-light lg:ml-0 md:ml-2 text-gray-800">{{ (new DateTime($order->created_at))->format('M d, Y') }}</p>
          </section>
          <section class="border-b border-gray-400 flex flex-col lg:border-0 lg:flex-col lg:p-0 md:flex-row py-3 text-left lg:mx-5">
            <h6 class="font-light">Total:</h6>
            <p class="font-light lg:ml-0 md:ml-2 text-gray-800">&#8362;{{ $order->total }}</p>
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
            @foreach ($items as $item)
              <section class="font-light pb-5 text-gray">
                <p class="float-left"><span class="mr-2 text-yellow-600">{{ ucfirst($item['name']) }}</span>×&nbsp;{{ $item['quantity'] }}</p>
                <p class="float-right">&#8362;{{ $item['price'] * $item['quantity'] }}</p>
              </section>
            @endforeach
          </div>
        </div>
      
        <div class="border-b flex flex-col font-light py-3">
          <section class="py-2">
            <p class="float-left">Subtotal:</p>
            <p class="float-right">&#8362;{{ ($order->total) - ((int) ($order->shipping == 'standard') ? 10 : 19) }}</p>
          </section>
          <section class="py-2">
            <p class="float-left">Shipping:</p>
            <p class="float-right">&#8362;{{ (int)($order->shipping == 'standard') ? 10 : 19 }}</p>
          </section>
          <section class="-mt-1 text-xs">
            <p class="float-right">Via {{ ucfirst($order->shipping) }}</p>
          </section>
          <section class="py-2">
            <p class="float-left">Payment method:</p>
            <p class="float-right">Credit Card</p>
          </section>
        </div>
      
        <div class="border-b flex flex-row font-light py-5">
          <h5 class="text-gray-700 text-left text-xl w-full">Total:</h5>
          <h5 class="text-gray-700 text-right text-xl w-full">&#8362;{{ $order->total }}</h5>
        </div>

      </section>
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