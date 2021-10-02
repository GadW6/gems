@extends('pages.back.master')

@section('cssdependancy')
    @parent
    <style>
      section > div.section:hover > button {
          visibility: visible;
      }
      section > div.section:hover > button:hover {
          visibility: visible;
          background-color: white;
      }
  </style>
@endsection

@section('body')

<section class="container min-h-screen mx-auto md:p-10 text-center hover:border mb-24">
  
  @foreach ($content as $item)
  <div class="cursor-default hover:shadow-md p-4 section relative">
    <h2 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl mb-8">
      {{ $item['c_title'] }}
    </h2>

    {!! $item['c_article'] !!}
    <button class="-mt-8 float-right md:invisible md:mr-3 p-1 rounded-full z-20" onclick="subEdit(event, true, 'button')">
      <svg class="fill-current h-6 ml-px svg-icon text-gray-700" viewBox="0 0 20 20" transform="rotate(90)">
          <path d="M10,2.172c-4.324,0-7.828,3.504-7.828,7.828S5.676,17.828,10,17.828c4.324,0,7.828-3.504,7.828-7.828S14.324,2.172,10,2.172M10,17.004c-3.863,0-7.004-3.141-7.004-7.003S6.137,2.997,10,2.997c3.862,0,7.004,3.141,7.004,7.004S13.862,17.004,10,17.004M10,8.559c-0.795,0-1.442,0.646-1.442,1.442S9.205,11.443,10,11.443s1.441-0.647,1.441-1.443S10.795,8.559,10,8.559 M10,10.619c-0.34,0-0.618-0.278-0.618-0.618S9.66,9.382,10,9.382S10.618,9.661,10.618,10S10.34,10.619,10,10.619 M14.12,8.559c-0.795,0-1.442,0.646-1.442,1.442s0.647,1.443,1.442,1.443s1.442-0.647,1.442-1.443S14.915,8.559,14.12,8.559 M14.12,10.619c-0.34,0-0.618-0.278-0.618-0.618s0.278-0.618,0.618-0.618S14.738,9.661,14.738,10S14.46,10.619,14.12,10.619 M5.88,8.559c-0.795,0-1.442,0.646-1.442,1.442s0.646,1.443,1.442,1.443S7.322,10.796,7.322,10S6.675,8.559,5.88,8.559 M5.88,10.619c-0.34,0-0.618-0.278-0.618-0.618S5.54,9.382,5.88,9.382S6.498,9.661,6.498,10S6.22,10.619,5.88,10.619"></path>
      </svg>
  </button>
  <ul class="absolute z-50 hidden hidden-menus bg-blue-900 md:mr-8 mr-6 md:mt-1 mt-px p-2 right-0 rounded text-gray-100" onmouseleave="subEdit(event, false, '')">
      <li class="cursor-pointer hover:bg-blue-800 px-3 py-1">
        <a class="h-full w-full" href="{{ url()->current() . '/sections/' . $item['id'] . '/edit' }}">Edit</a>
      </li>
      <li class="cursor-pointer hover:bg-blue-800 px-3 py-1">
        <button class="h-full w-full" onclick="remove(event, {{ $item['id'] }})">Remove</button>
      </li>
  </ul>
  </div>
    @endforeach

    <div class="flex flex-col-reverse gap-2 md:flex-row px-3 py-5">
      <a class="border border-gray-600 font-light hover:border-blue-700 hover:text-blue-800 w-full md:w-1/4 py-1 text-center text-gray-700 uppercase" href="{{ url('cms/contents') }}">
          <svg class="svg-icon h-5 w-5 fill-current mb-px mr-2" viewBox="0 0 20 20">
            <path d="M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0
            L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109
            c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483
            c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788
            S18.707,9.212,18.271,9.212z"></path>
          </svg>
          Back
      </a>
      <a class="border border-gray-600 font-light hover:border-blue-700 hover:text-blue-800 w-full py-1 text-center text-gray-700 uppercase" href="{{ url()->current() . '/sections/create' }}">
          <svg class="svg-icon h-5 w-5 fill-current mb-px mr-2" viewBox="0 0 20 20">
              <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
          </svg>
          ADD Section
      </a>
  </div>
  </section>


@endsection

@section('jsdependancy')
    @parent
    <script>
      const subEdit = (e, divState, target) => {
          e.preventDefault()
          const ulElement = (divState === true) ? e.target.closest(target).nextElementSibling : e.target
          
          if (ulElement.classList.contains('hidden')) {
              ulElement.classList.remove('hidden')
          } else {
              ulElement.classList.add('hidden')
          }
      }
      const remove = (e, id) => {
        const decision = window.confirm('You are about to delete this section. Are you sure ?')
        if (decision) {
          const uri = "{{ url()->current() . '/sections/' }}" + id
          console.log(uri)
          axios.delete(uri)
            .then(function (response) {
              // handle success
              (response.data === 'success') ? window.location.reload() : false;
            })
            .catch(function (error) {
              // handle error
              console.log(error);
            });
        }
      }
  </script>
@endsection