@extends('master')

@section('cssdependancy')
    <link rel="stylesheet" href="{{ asset('/css/detail.css') }}">
    @parent
@endsection

@section('body')

{{-- @extends('layout.nav') --}}
@include('components.front.nav')

<section class="bg-gray-100 py-20 min-h-screen">

  <div class="container py-8 px-6 mx-auto">

    <div class="hidden sm:block top-banner">
      <nav id="breadcrumb" class="font-light mb-5 text-gray-500 text-sm" itemprop="breadcrumb">
        <a href=" {{ url('/shop') }} " class="text-gray-600">
          Shop
        </a>
        <span class="delimiter">/</span>
        <a href="{{ url('/shop/' . $category->c_url) }}" class="text-gray-600">
          {{ $category->c_title }}
        </a>
        <span class="delimiter">/</span>
          {{ ucfirst($product->p_title) }}
      </nav>
    </div>
    <div class="body-content flex flex-col lg:flex-row">
      <div class="flex-grow lg:w-1/3">
        <a href="{{ url('/storage/' . $category->c_url . '/' . $product->p_image) }}">
          <img class="block border-b border-gray-400 lg:border-0 mx-auto object-cover pb-10" style="max-height: 75vh;" src="{{ asset('/storage/' . $category->c_url . '/' . $product->p_image) }}">
        </a>
      </div>
      <div class="flex-1 lg:flex-col lg:ml-12 lg:mt-0 mt-10 sm:flex">
        <div class="lg:flex-initial one sm:flex-1">
          <h1 class="font-light lg:text-4xl text-2xl text-gray-800">{{ ucfirst($product->p_title) }}</h1>
          <p class="font-light lg:text-2xl text-xl text-yellow-700">&#8362;{{ $product->p_price }}</p>
        </div>
        <div class="lg:flex-initial sm:flex-1 two">
          <div class="lg:my-6">
            <p class="mt-4 font-light sm:mt-0">{!! $product->p_article ? $product->p_article : '<small>(Description will soon be added ...)</small>' !!}</p>
          </div>
          <div class="">
  
            {{-- --------------------------------- --}}
            {{-- Rating System Needs to Be implemented ! --}}
            {{-- --------------------------------- --}}
            {{-- <div class="my-6 rating">
              <img class="h-4 mr-1 w-4" src="{{ asset('/icons/star_yellow.svg') }}">
              <img class="h-4 mr-1 w-4" src="{{ asset('/icons/star_yellow.svg') }}">
              <img class="h-4 mr-1 w-4" src="{{ asset('/icons/star_yellow.svg') }}">
              <img class="h-4 mr-1 w-4" src="{{ asset('/icons/star_yellow.svg') }}">
              <img class="h-4 mr-1 w-4" src="{{ asset('/icons/star_yellow.svg') }}">
            </div> --}}


            <form class="add-cart border border-gray-600 mt-6 h-24" action="" method="post">
              @csrf
              <div class="quantity text-center h-12 py-2">
                  <button id="minus" class="inline-block">
                    <svg class="fill-current h-5 hover:text-gray-700 mb-1 text-gray-800 w-5" xmlns="http://www.w3.org/2000/svg" width="609.781" height="678.135" viewBox="0 0 609.781 678.135">
                      <path id="multimedia" d="M606.783,396.869,36.343,77.462A19.675,19.675,0,0,0,5.5,93.65V732.465a19.67,19.67,0,0,0,30.843,16.189l570.44-319.407a19.669,19.669,0,0,0,0-32.377Z" transform="translate(615.281 752.135) rotate(180)"/>
                    </svg>
                  </button>

                  <input type="number" id="quantity" class="bg-transparent inline-block text-center text-gray-800 text-xl w-6" step="1" min="1" name="quantity" value="1" size="4" placeholder="" pattern="[0-9]*">

                  <button id="plus" class="inline-block">
                    <svg class="fill-current h-5 hover:text-gray-700 mb-1 text-gray-800 w-5" xmlns="http://www.w3.org/2000/svg" width="609.781" height="678.135" viewBox="0 0 609.781 678.135">
                      <path id="multimedia" d="M606.783,396.869,36.343,77.462A19.675,19.675,0,0,0,5.5,93.65V732.465a19.67,19.67,0,0,0,30.843,16.189l570.44-319.407a19.669,19.669,0,0,0,0-32.377Z" transform="translate(-5.5 -74)"/>
                    </svg>
                  </button>
              </div>
  
              <button type="button" onclick="addToCart(event, '{{ $product->id }}', '{{ $category->c_url }}')" name="add-to-cart" class="-mt-px bg-gray-900 focus:bg-gray-800 font-light h-12 hover:bg-gray-800 text-white w-full">Add to cart</button>
            </form>

            {{-- --------------------------------- --}}
            {{-- External Links + Love Rating Needs to Be implemented ! --}}
            {{-- --------------------------------- --}}
            {{-- <div class="nm-product-share-wrap has-share-buttons">
              <div class="nm-product-wishlist-button-wrap"> 
                <a href="#" id="nm-wishlist-item-253-button" class="nm-wishlist-button nm-wishlist-item-253-button" data-product-id="253" title="Add to Wishlist"><i class="nm-font nm-font-heart-o"></i>
                </a>
              </div>
              <div class="nm-product-share"> 
                <a href="//www.facebook.com/sharer.php?u=http://savoy.nordicmade.com/product/classic-chair/" target="_blank" title="Share on Facebook"><i class="nm-font nm-font-facebook"></i>
                </a>
                <a href="//twitter.com/share?url=http://savoy.nordicmade.com/product/classic-chair/" target="_blank" title="Share on Twitter"><i class="nm-font nm-font-twitter"></i>
                </a>
                <a href="//pinterest.com/pin/create/button/?url=http://savoy.nordicmade.com/product/classic-chair/&amp;media=http://savoy.nordicmade.com/wp-content/uploads/2015/08/product-classic-chair.jpg&amp;description=Classic+Chair" target="_blank" title="Pin on Pinterest"><i class="nm-font nm-font-pinterest"></i>
                </a>
              </div>
            </div> --}}


          </div>
        </div>
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
  <script>
    // UI Elements
    const minusBtn = document.querySelector('button#minus')
    const plusBtn = document.querySelector('button#plus')
    const qt = document.querySelector('input#quantity')

    // Event Listeners
    minusBtn.addEventListener('click', (e) => {
      e.preventDefault();
      if (qt.value > 1) {
        --qt.value
      }
    })

    plusBtn.addEventListener('click', (e) => {
      e.preventDefault();
      ++qt.value
    })

    const addToCart = (e, pid, category) => {
        e.preventDefault();
        e
        const query = `?category=${category}&p_id=${pid}&qty=${e.target.parentElement.children[1].children[1].value}`
        axios.get("{{ url('shop/add-to-cart') }}" + query)
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
            .finally(function () {
                // Always running..
                // Need to add sliding cart effect
            });
        }
  </script>
  @parent
@endsection