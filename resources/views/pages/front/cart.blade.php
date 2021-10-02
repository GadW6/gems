@extends('master')

@section('cssdependancy')
    @parent
@endsection

@section('body')

@include('components.front.nav')

<section class="container flex flex-col lg:flex-row mb-10 md:mb-10 md:mt-24 min-h-screen mt-20 mx-auto p-4">
   @if (count($cart))
      <div class="flex-1 lg:mr-4">
         <h1 class="font-light text-2xl text-gray-800">Shopping Cart</h1>
         <div class="border-b border-gray-200 flex flex-col mt-8 pb-4">
            @foreach ($cart as $cartItem)
               <div class="item-row flex flex-row my-2" style="height: 12vh;">
                  <div class="w-1/5">
                     <a href="{{ url('/shop/' . $cartItem['attributes']['category'] . '/' . $cartItem['attributes']['url']) }}">
                        <img class="h-full w-full object-fill" src="{{ asset('/storage/' . $cartItem['attributes']['category'] . '/' . $cartItem['attributes']['image']) }}">
                     </a>
                  </div>
                  <div class="flex-col flex-grow p-5">
                     <div class="text-gray-800">
                        <a href="{{ url('/shop/' . $cartItem['attributes']['category'] . '/' . $cartItem['attributes']['url']) }}">
                           {{ ucfirst($cartItem['name']) }}
                        </a>
                     </div>
                     <div class="flex flex-row">
                        <div>
                           <button data-op="minus" onclick="updateItem(event, {{ $cartItem['id'] }})">
                              <svg class="h-3 w-3 mb-px mx-2 fill-current text-gray-600 hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" width="609.781" height="678.135" viewBox="0 0 609.781 678.135">
                              <path id="multimedia" d="M606.783,396.869,36.343,77.462A19.675,19.675,0,0,0,5.5,93.65V732.465a19.67,19.67,0,0,0,30.843,16.189l570.44-319.407a19.669,19.669,0,0,0,0-32.377Z" transform="translate(615.281 752.135) rotate(180)"/>
                              </svg>
                           </button>
                        </div>
                        <div class="text-gray-800">{{ $cartItem['quantity'] }}</div>
                        <div>
                           <button data-op="plus" onclick="updateItem(event, {{ $cartItem['id'] }})">
                              <svg class="h-3 w-3 mb-px mx-2 fill-current text-gray-600 hover:text-gray-800" xmlns="http://www.w3.org/2000/svg" width="609.781" height="678.135" viewBox="0 0 609.781 678.135">
                              <path id="multimedia" d="M606.783,396.869,36.343,77.462A19.675,19.675,0,0,0,5.5,93.65V732.465a19.67,19.67,0,0,0,30.843,16.189l570.44-319.407a19.669,19.669,0,0,0,0-32.377Z" transform="translate(-5.5 -74)"/>
                              </svg>
                           </button>
                        </div>
                     </div>
                  </div>
                  <div class="flex-col w-1/5">
                     <div class="text-right mb-2">
                        <a class="text-gray-800 hover:text-red-700" href="{{ url('/shop/remove?pid=' . $cartItem['id']) }}">X</a>
                     </div>
                     <div class="text-right text-gray-800">
                        &#8362;{{ $cartItem['price'] * $cartItem['quantity'] }}
                     </div>
                  </div>
               </div>
            @endforeach
         </div>
      </div>
      <div class="lg:ml-4 lg:w-2/5">
         <h1 class="font-light lg:mb-10 lg:mt-0 mb-8 mt-16 text-2xl text-gray-800">Cart totals</h1>
         <div class="bg-gray-100 border flex flex-col font-light text-gray-800">
            <div class="flex flex-row p-4">
               <div class="w-1/2">Subtotal</div>
               <div class="w-1/2 text-right">&#8362;{{ Cart::getSubTotal() }}</div>
            </div>
            <div class="border-b border-t p-4 flex flex-col">
               <div class="mb-3">Shipping</div>
               <form id="methods">
                  <div class="flex flex-row mb-1">
                     <div class="w-1/2">
                        <input type="radio" id="standard" name="shipping" value="standard" {{ (Cart::getConditions()->first()->getName() == 'standard') ? 'checked' : '' }}>
                        <label for="standard">Standard</label>
                     </div>
                     <div class="w-1/2 text-right">&#8362;10</div>
                  </div>
                  <div class="flex flex-row">
                     <div class="w-1/2">
                        <input type="radio" id="express" name="shipping" value="express" {{ (Cart::getConditions()->first()->getName() == 'express') ? 'checked' : '' }}>
                        <label for="express">Express</label>
                     </div>
                     <div class="w-1/2 text-right">&#8362;19</div>
                  </div>
               </form>
               <div class="mt-3">
                  Shipping to <span class="font-medium">Israel</span>
               </div>
            </div>
            <div class="p-4 flex flex-row">
               <div class="w-1/2">Total</div>
               <div class="w-1/2 text-right">&#8362;<span id="total">{{ Cart::getTotal() }}</span></div>
            </div>
         </div>
         <div class="mt-6">
            @if (Session::has('user_id'))
            <form action="{{ url('/shop/checkout') }}" method="POST">
               @csrf
               <button class="bg-gray-900 block hover:bg-gray-800 p-4 text-center text-white w-full" type="submit">Order</button>
            </form>
            @else
               <button class="bg-gray-900 block hover:bg-gray-800 p-4 text-center text-white w-full" onclick="loginClick()">Order</button>
            @endif
         </div>
         <div class="mt-6">
            <a class="border border-gray-900 block p-3 text-center text-gray-800" href="{{ url('/shop') }}">Continue Shopping</a>
         </div>
      </div>
   @else
      <div class="flex flex-col lg:w-full p-4 text-center">
         <div class="text-3xl text-gray-800">X</div>
         <div class="text-gray-800">Your cart is currently empty.</div>
         <div class="mt-6"><a class="bg-gray-900 p-3 text-white hover:bg-gray-800" href="{{ url('/shop') }}">Return to shop</a></div>
      </div>
   @endif

</section>

@if (!Session::has('user_id'))
  @include('components.front.login')  
@endif

@include('components.front.footer')

@endsection

@section('jsdependancy')
    @parent
    <script>
      //  UI Elements
      const total = document.querySelector('#total')
      const form = document.querySelector('#methods')
         

      // Event Listeners
      if (form) {
         form.addEventListener('change', (e) => {
            const query = '?action='
            if (e.target.id === 'express') {
               axios.get("{{ url('shop/cart/condition') }}" + query + 1)
                  .then(function (response) {
                     const res = response.data
                     if ( res === 'success' ) {
                        window.location.reload() 
                  }
                  })
                  .catch(function (error) {
                     // handle error
                     if (error) {
                        throw error
                     }
                  })
            } else {
               axios.get("{{ url('shop/cart/condition') }}" + query + 0)
                  .then(function (response) {
                     const res = response.data
                     if ( res === 'success' ) {
                        window.location.reload() 
                  }
                  })
                  .catch(function (error) {
                     // handle error
                     if (error) {
                        throw error
                     }
                  })
            }
         })
      }

      // Action Event
       const updateItem = (e, pid) => {
         e.preventDefault();
         const query = `?pid=${pid}&op=${e.target.closest('button').getAttribute('data-op')}`
         axios.get("{{ url('shop/update-cart') }}" + query)
            .then(function (response) {
               const res = response.data
               if ( res === 'success' ) {
                  window.location.reload() 
            }
            })
            .catch(function (error) {
               // handle error
               if (error) {
                  throw error
               }
            })
       }

       const loginClick = () => {
         document.querySelector('#loginNavBtn').click()
       }

    </script>
@endsection