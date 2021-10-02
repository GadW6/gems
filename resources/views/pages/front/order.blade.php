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
    <div class="flex flex-1 flex-col md:ml-4 md:pb-20 overflow-hidden text-center xl:pb-10">
      <section class="mb-16 md:max-h-full md:mb-0 md:mt-0 md:overflow-y-scroll mt-10">
        <h2 class="border-b font-light inline-flex mb-6 pb-3 text-2xl">Complete Order List:</h2>
      <table class="table w-full">
        <thead>
          <tr class="border-b">
            <th class="text-gray-700 py-3 mb-6 font-light">Order</span></th>
            <th class="text-gray-700 py-3 mb-6 font-light hidden md:table-cell w-1/3">Date</span></th>
            <th class="text-gray-700 py-3 mb-6 font-light">Status</span></th>
            <th class="text-gray-700 py-3 mb-6 font-light hidden md:table-cell">Total</span></th>
          </tr>
        </thead>
        <tbody class="font-light">
          <tr><td class="py-2"></td></tr>
          @if (count($orders) > 0)
            @foreach ($orders as $order)
              <tr class="">
                <td class="py-2">
                  <a href="{{ url('/user/profile/order/' . $order->id) }}" class="text-yellow-600 hover:underline">#{{ $order->id }}</a>
                </td>
                <td class="py-2 hidden md:table-cell">
                  <time class="py-3">{{ (new DateTime($order->created_at))->format('M d, Y') }}</time>
                </td>
                @if ($order_status[$loop->index] === 1)
                    <td class="py-2">Delivered</td>
                  @elseif ($order_status[$loop->index] === 2)
                    <td class="py-2">Shipped</td>
                  @else
                    <td class="py-2">Processed</td>
                  @endif
                <td class="py-2 hidden md:table-cell">
                    <span class=""><span class="">&#8362;</span>{{ $order->total }}</span>
                </td>
              </tr>
            @endforeach
          @else
              <tr><td class="absolute mt-2 text-gray-500 w-11/12 sm:w-2/3">Nothing to report</td></tr>
          @endif
        </tbody>
      </table>
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