@extends('master')

@section('cssdependancy')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/shop.css') }}">
@endsection

@section('body')

@include('components.front.nav')


<section class="mt-20 relative min-h-screen">
  <div class="container flex flex-wrap items-center mx-auto pb-24 pt-4 sm:pb-12">

    @include('components.front.search_bar')

    @foreach ($products as $product)
      <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
        <a href=" {{ url('/shop/' . $product->c_url . '/' . $product->p_url) }} " class="mb-12 pb-3 prod-card z-10 cursor-pointer" style="height: 300px; width: 100%;">
          <img class="hover:shadow-lg object-fill w-full" style="height: 300px;" src=" {{ asset('/storage/' . $product->c_url . '/' . $product->p_image) }} ">
          <div class="flex items-center justify-between pt-3">
            <p class="w-full font-thin text-xl">{{ ucfirst($product->p_title) }}</p>
            <button class="z-50" onclick="addToCart(event, {{ $product->id }}, '{{ $product->c_url }}')">
              <svg class="h-8 w-8 fill-current text-gray-500 hover:text-black" xmlns="http://www.w3.org/20gray-600g"
                  viewBox="0 0 24 24">
                  <path
                      d="M9.941,4.515h1.671v1.671c0,0.231,0.187,0.417,0.417,0.417s0.418-0.187,0.418-0.417V4.515h1.672c0.229,0,0.417-0.187,0.417-0.418c0-0.23-0.188-0.417-0.417-0.417h-1.672V2.009c0-0.23-0.188-0.418-0.418-0.418s-0.417,0.188-0.417,0.418V3.68H9.941c-0.231,0-0.418,0.187-0.418,0.417C9.522,4.329,9.71,4.515,9.941,4.515 M17.445,15.479h0.003l1.672-7.52l-0.009-0.002c0.009-0.032,0.021-0.064,0.021-0.099c0-0.231-0.188-0.417-0.418-0.417H5.319L4.727,5.231L4.721,5.232C4.669,5.061,4.516,4.933,4.327,4.933H1.167c-0.23,0-0.418,0.188-0.418,0.417c0,0.231,0.188,0.418,0.418,0.418h2.839l2.609,9.729h0c0.036,0.118,0.122,0.214,0.233,0.263c-0.156,0.254-0.25,0.551-0.25,0.871c0,0.923,0.748,1.671,1.67,1.671c0.923,0,1.672-0.748,1.672-1.671c0-0.307-0.088-0.589-0.231-0.836h4.641c-0.144,0.247-0.231,0.529-0.231,0.836c0,0.923,0.747,1.671,1.671,1.671c0.922,0,1.671-0.748,1.671-1.671c0-0.32-0.095-0.617-0.252-0.871C17.327,15.709,17.414,15.604,17.445,15.479 M15.745,8.275h2.448l-0.371,1.672h-2.262L15.745,8.275z M5.543,8.275h2.77L8.5,9.947H5.992L5.543,8.275z M6.664,12.453l-0.448-1.671h2.375l0.187,1.671H6.664z M6.888,13.289h1.982l0.186,1.671h-1.72L6.888,13.289zM8.269,17.466c-0.461,0-0.835-0.374-0.835-0.835s0.374-0.836,0.835-0.836c0.462,0,0.836,0.375,0.836,0.836S8.731,17.466,8.269,17.466 M11.612,14.96H9.896l-0.186-1.671h1.901V14.96z M11.612,12.453H9.619l-0.186-1.671h2.18V12.453zM11.612,9.947H9.34L9.154,8.275h2.458V9.947z M14.162,14.96h-1.715v-1.671h1.9L14.162,14.96z M14.441,12.453h-1.994v-1.671h2.18L14.441,12.453z M14.72,9.947h-2.272V8.275h2.458L14.72,9.947z M15.79,17.466c-0.462,0-0.836-0.374-0.836-0.835s0.374-0.836,0.836-0.836c0.461,0,0.835,0.375,0.835,0.836S16.251,17.466,15.79,17.466 M16.708,14.96h-1.705l0.186-1.671h1.891L16.708,14.96z M15.281,12.453l0.187-1.671h2.169l-0.372,1.671H15.281z" />
              </svg>
          </button>
          </div>
          <p class="card-price font-thin text-black" style="display: block;">&#8362;{{ $product->p_price }} </p>
        </a>
      </div>
    @endforeach

    @if (empty($sort) && empty($order) && empty($search))
      {{ $products->links() }}
    @elseif (!empty($sort) || !empty($order) || !empty($search))
      {{ $products->appends(['sort' => $sort, 'order' => $order, 'search' => $search])->links() }}
    @endif



  </div>
</section>

@if (!Session::has('user_id'))
  @include('components.front.login')  
@endif

@include('components.front.footer')

@endsection

@section('jsdependancy')
    @parent
    <script>
      const addToCart = (e, pid, category) => {
      e.preventDefault();
      const query = `?category=${category}&p_id=${pid}`
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
@endsection