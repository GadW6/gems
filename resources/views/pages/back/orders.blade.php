@extends('pages.back.master')

@section('cssdependancy')
    @parent
@endsection

@section('body')

<div class="container flex flex-wrap max-w-4xl mx-auto py-5 px-3 md:px-0">

    <table class="table-auto w-full">
        <thead>
          <tr class="bg-gray-300">
            <th class="text-sm sm:text-lg px-4 py-2">User</th>
            <th class="text-sm sm:text-lg px-4 py-2 hidden sm:table-cell">Order</th>
            <th class="text-sm sm:text-lg px-4 py-2 hidden sm:table-cell">Shipping</th>
            <th class="text-sm sm:text-lg px-4 py-2">Total</th>
            <th class="text-sm sm:text-lg px-4 py-2">Date</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($orders->sortByDesc('created_at') as $order)
            <tr>
              <td class="border text-xs sm:text-sm px-4 py-2">{{ $users->where('id', $order->user_id)->first()->email }}</td>
              <td class="border text-xs sm:text-sm hidden sm:table-cell">
                <table class="table-fixed w-full">
                    <thead>
                      <tr class="bg-gray-200">
                        <th class="px-4 text-xs font-light text-gray-500">Item(s)</th>
                        <th class="text-xs font-light text-gray-500 w-1/12 text-center">Qty</th>
                        <th class="px-4 text-xs font-light text-gray-500 w-3/12 text-center">Price</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach (unserialize($order->data) as $subOrder)
                        <tr>
                          <td class="border-t px-4 py-2">{{ $subOrder['name'] }}</td>
                          <td class="border-t border-l border-r text-center py-2 w-1/12">{{ $subOrder['quantity'] }}</td>
                          <td class="border-t px-4 py-2 w-3/12 text-center">{{ $subOrder['price'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>
              </td>
              <td class="border text-xs sm:text-sm px-4 py-2 hidden sm:table-cell">{{ $order->shipping }}</td>
              <td class="border text-xs sm:text-sm px-4 py-2">&#8362;{{ $order->total }}</td>
              <td class="border text-xs sm:text-sm px-4 py-2 whitespace-normal sm:whitespace-no-wrap">{{ $order->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>

</div>


@endsection

@section('jsdependancy')
    @parent
@endsection