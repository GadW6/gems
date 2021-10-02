@section('cssdependancy')
  @parent
@endsection

<div id="cartSlideParent" class="back hidden fixed h-screen top-0 w-screen z-40" style="background-color: #808080b0;">
  <div id="cartSlide" class="bg-gray-900 hidden fixed flex-col h-screen right-0 top-0 z-10">
    <div class="border-b border-gray-700 flex-shrink mx-4 font-light text-gray-400 text-md">
      <button class="flex font-light py-6 text-gray-400 text-md w-full" onclick="closeCart(event)"> 
        <span class="flex-1 hidden md:block text-gray-600 text-left">Cart</span> 
        <span class="flex-1 text-right">Close</span> 
      </button>
    </div>
    <div id="bodyProducts" class="flex-grow px-4">
      @if (count(\Cart::getContent()->toArray()))
        @foreach (array_values(Cart::getContent()->toArray()) as $cartItem)
          <div class="item-row flex flex-row my-2" style="height: 8vh;">
            <div class="w-1/4">
                <a href="{{ url('/shop/' . $cartItem['attributes']['category'] . '/' . $cartItem['attributes']['url']) }}">
                  <img class="h-full w-full object-fill" src="{{ asset('/storage/' . $cartItem['attributes']['category'] . '/' . $cartItem['attributes']['image']) }}">
                </a>
            </div>
            <div class="flex-col flex-grow px-3 py-1 font-thin">
                <div class="text-gray-400">
                  <a href="{{ url('/shop/' . $cartItem['attributes']['category'] . '/' . $cartItem['attributes']['url']) }}">
                      {{ ucfirst($cartItem['name']) }}
                  </a>
                </div>
                <div class="flex flex-row">
                  <div class="text-gray-500 text-xs">Qty: {{ $cartItem['quantity'] }}</div>
                </div>
            </div>
            <div class="flex-col w-1/5">
              <div class="text-right text-gray-500 font-thin py-2">
                &#8362;{{ $cartItem['price'] * $cartItem['quantity'] }}
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div class="text-gray-800">Your cart is currently empty.</div>
      @endif
    </div>
    <div class="absolute bottom-0 flex-1 w-full">
      <form class="flex-col h-full" action=""> 
        <p class="border-b border-gray-700 border-t flex-1 mx-4 py-4 font-light">
          <span class="text-gray-400">Subtotal:</span>
          <span class="nm-cart-panel-summary-subtotal">
            <span class="float-right text-gray-400">&#8362;{{ (int) \Cart::getSubtotal() }}</span>
          </span>
        </p>
        
        <p class="flex-1 mx-4 py-4">
          <a href="{{ url('/shop') }}" class="block border border-gray-600 py-3 text-center text-gray-400">Continue Shopping</a>
          <a href="{{ url('/shop/cart') }}" class="bg-black block hover:opacity-75 mt-3 py-3 text-center text-gray-400">Checkout</a>
        </p>
                
        <p class="flex-1 hidden">
          <a href="#" id="nm-cart-panel-continue" class="button border">Continue shopping</a>
        </p>
      </form>
    </div>
  </div>
</div>
@section('jsdependancy')
  @parent
  <script>
    const cartSlide = document.querySelector('div#cartSlide')
    const cartSlideParent = document.querySelector('div#cartSlideParent')

    const closeCart = e => {
      cartSlide.classList.remove('u--slideRight')
      cartSlide.classList.add('hidden')
      cartSlideParent.classList.add('hidden')
    }

    cartSlideParent.addEventListener('click', e => (e.target.id === 'cartSlideParent') ? closeCart() : false)
  </script>
@endsection