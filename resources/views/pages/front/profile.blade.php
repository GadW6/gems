@extends('master')

@section('jsdependancy')
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
    <div class="flex flex-1 flex-col md:ml-4 md:pb-20 md:overflow-hidden text-center xl:pb-10">
      <section class="md:overflow-y-scroll">
        <div class="bg-indigo-200 font-light mt-10 md:mt-0 px-2 py-6 relative rounded">
          <h2 class="border-b border-gray-500 inline-flex mb-6 text-xl">Order Summary</h2>
          <div class="flex flex-row justify-around">
            <div>
              <h3>Order Count:</h3>
              <p class="text-gray-700">#{{ count($orders) }}</p>
            </div>
            <div>
              <h3>Items Purchased:</h3>
              <p class="text-gray-700">#{{ $order_total_items }}</p>
            </div>
            <div>
              <h3>Total Expenses:</h3>
              <p class="text-gray-700">&#8362;{{ $order_total_sum }}</p>
            </div>
          </div>
        </div>
        <div class="orders-list mt-2 font-light border border-indigo-100 px-3 md:px-6 py-6 rounded">
          <h2 class="border-b border-gray-500 inline-flex mb-6 text-xl">Latest Order Status</h2>
          @if (count($orders) > 3)
            @for ($i = 0; $i < 3; $i++)
            <div class="order-item pb-3">
              <p class="bg-gray-100 border-indigo-600 border-l-4 p-3">Your order <a class="text-indigo-500 hover:underline" href="{{ url('/user/profile/order/' . $orders[$i]['id']) }}">#{{ $orders[$i]['id'] }}</a> holds the status of: 
                @if ($order_status[$i] === 1)
                  <span class="text-green-500 block">Delivered</span>
                @elseif ($order_status[$i] === 2)
                  <span class="text-orange-500 block">Shipped</span>
                @else
                  <span class="text-pink-500 block">Processed</span>
                @endif
                </p>
              </div>
            @endfor
          @elseif (count($orders) > 0 && count($orders) <= 3)
            @for ($i = 0; $i < count($orders); $i++)
            <div class="order-item pb-3">
              <p class="bg-gray-100 border-indigo-600 border-l-4 p-3">Your order <a class="text-indigo-500 hover:underline" href="{{ url('/user/profile/order/' . $orders[$i]['id']) }}">#{{ $orders[$i]['id'] }}</a> holds the status of: 
                @if ($order_status[$i] === 1)
                  <span class="text-green-500 block">Delivered</span>
                @elseif ($order_status[$i] === 2)
                  <span class="text-orange-500 block">Shipped</span>
                @else
                  <span class="text-pink-500 block">Processed</span>
                @endif
                </p>
              </div>
            @endfor
          @else
          <div class="order-item pb-3 text-gray-500">Nothing to report</div>
          @endif
        </div>
        <div class="mt-2 font-light border border-indigo-100 p-6 rounded">
          <h2 class="border-b border-gray-500 inline-flex mb-6 text-xl">Profile Summary</h2>
          <div class="md:mx-auto md:w-2/3 pb-3 text-left flex flex-row">
            <div class="flex-1">
              <h6 class="text-gray-700 text-lg">First Name:</h6>
              <p class="text-md">{{ ucfirst($user->name) }}</p>
            </div>
            <div class="flex-1">
              <h6 class="text-gray-700 text-lg">Last Name:</h6>
              @if ($user->last_name)
                <p class="text-md">{{ $user->last_name }}</p>
              @else
                <p class="mt-1 text-gray-500 text-xs">(Not yet defined...)</p>
              @endif
            </div>
          </div>
          <div class="md:mx-auto md:w-2/3 pb-3 text-left">
            <h6 class="text-gray-700 text-lg">Email:</h6>
            <p class="text-md">{{ $user->email }}</p>
          </div>
          <div class="md:mx-auto md:w-2/3 pb-3 text-left">
            <h6 class="text-gray-700 text-lg">Password:</h6>
            <input class="bg-transparent text-md" type="text" value="*******************" disabled>
          </div>
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