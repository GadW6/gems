<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" sizes="16" href="{{ asset('/storage/icons/gems-logo.png') }}">

  <title>{{ $page_title ?? 'GEMS' }}</title>
  <meta name="description" content="GEMS Eshop store jewelry diamond precious stones">

  <link rel="stylesheet" href="{{ asset('/css/alertify.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/alertify_theme.min.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/fade.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/slide.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/nav.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/main.css') }}">

  <!--Replace with your tailwind.css once created-->
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">

  {{-- ChartJS --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg==" crossorigin="anonymous"></script>


  @yield('cssdependancy')
</head>

<body class="bg-gray-900 text-gray-600 work-sans leading-normal text-base tracking-normal relative">


  <div class="flex flex-col md:flex-row">

    <div class="bg-gray-900 bottom-0 fixed flex h-16 md:h-screen md:relative md:w-48 w-full z-10">
      
      <div class="flex items-end justify-center mb-3 md:block md:content-start md:fixed md:flex-none md:mt-12 md:w-48 w-full">
          <div class="hidden md:block h-12 mb-12 mx-auto w-12">
            <img src="{{ asset('/storage/icons/gems-logo.png') }}">
          </div>
          <nav class="w-full">
            <ul class="list-reset flex flex-row md:flex-col py-0 md:py-3 px-1 md:px-2 text-center md:text-left">
                <li class="mr-3 flex-1">
                    <a href="{{ url('cms') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 {{ url()->current() == url('cms') ? 'border-pink-500' : 'border-gray-800 hover:border-pink-500' }}">
                        <i class="fas fa-tasks pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block {{ url()->current() == url('cms') ? 'text-gray-400' : 'text-gray-600 md:text-gray-400' }}">Dashboard</span>
                    </a>
                </li>
                <li class="mr-3 flex-1">
                    <a href="{{ url('cms/contents') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 {{ url()->current() == url('cms/contents') ? 'border-purple-500' : 'border-gray-800 hover:border-purple-500' }}">
                        <i class="fa fa-envelope pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block {{ url()->current() == url('cms/contents') ? 'text-gray-400' : 'text-gray-600 md:text-gray-400' }}">Contents</span>
                    </a>
                </li>
                <li class="mr-3 flex-1">
                    <a href="{{ url('cms/inventory') }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 {{ url()->current() == url('cms/inventory') ? 'border-blue-500' : 'border-gray-800 hover:border-blue-500' }}">
                        <i class="fas fa-chart-area pr-0 md:pr-3 text-blue-600"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block {{ url()->current() == url('cms/inventory') ? 'text-gray-400' : 'text-gray-600 md:text-gray-400' }}">Inventory</span>
                    </a>
                </li>
                <li class="mr-3 flex-1">
                    <a href="{{ url('cms/orders') }}" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 {{ url()->current() == url('cms/orders') ? 'border-red-500' : 'border-gray-800 hover:border-red-500' }}">
                        <i class="fa fa-wallet pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base block md:inline-block {{ url()->current() == url('cms/orders') ? 'text-gray-400' : 'text-gray-600 md:text-gray-400' }}">Orders</span>
                    </a>
                </li>
            </ul>
          </nav>
        </div>
  
  
    </div>
  
    <div class="main-content flex-1 bg-gray-100 pb-24 md:pb-5">
  
      <!--Nav-->
      <nav class="bg-gray-100 border-b h-auto mb-1 p-3 w-full z-20">
          <ul class="flex justify-end list-reset text-right">
            <li class="md:flex-1 md:mr-3">
              <h2 class="font-bold md:-mr-20 md:mt-0 md:text-2xl mt-1 text-gray-700 text-xl whitespace-no-wrap">{{ $title }}</h2>
            </li>
            <li class="flex-1 md:mr-3">
              <a class="font-light hover:text-gray-800 hover:underline inline-block sm:text-sm md:text-md pr-4 py-2 rounded-lg text-gray-700 text-xs whitespace-no-wrap" href="{{ url('/') }}">
                <svg class="svg-icon h-6 w-6" viewBox="0 0 20 20">
                  <path d="M3.24,7.51c-0.146,0.142-0.146,0.381,0,0.523l5.199,5.193c0.234,0.238,0.633,0.064,0.633-0.262v-2.634c0.105-0.007,0.212-0.011,0.321-0.011c2.373,0,4.302,1.91,4.302,4.258c0,0.957-0.33,1.809-1.008,2.602c-0.259,0.307,0.084,0.762,0.451,0.572c2.336-1.195,3.73-3.408,3.73-5.924c0-3.741-3.103-6.783-6.916-6.783c-0.307,0-0.615,0.028-0.881,0.063V2.575c0-0.327-0.398-0.5-0.633-0.261L3.24,7.51 M4.027,7.771l4.301-4.3v2.073c0,0.232,0.21,0.409,0.441,0.366c0.298-0.056,0.746-0.123,1.184-0.123c3.402,0,6.172,2.709,6.172,6.041c0,1.695-0.718,3.24-1.979,4.352c0.193-0.51,0.293-1.045,0.293-1.602c0-2.76-2.266-5-5.046-5c-0.256,0-0.528,0.018-0.747,0.05C8.465,9.653,8.328,9.81,8.328,9.995v2.074L4.027,7.771z"></path>
                </svg>
                Back To Shop
              </a>
            </li>
            <li class="md:mr-3">
            <div class="relative inline-block">
              <button onclick="toggleDD()" class="drop-button text-black focus:outline-none"> 
                <img class="bg-gray-400 h-10 p-1 rounded-full w-10" src="{{ asset('storage/avatars/' . $user->image) }}">
              </button>
                <div id="myDropdown" class="w-40 text-left dropdownlist absolute bg-gray-900 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                  <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw"></i> Profile</a>
                  <a href="#" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-cog fa-fw"></i> Settings</a>
                  <div class="border border-gray-800"></div>
                  <button class="block hover:bg-gray-800 hover:no-underline no-underline p-2 text-left text-sm text-white w-full" onclick="logout()">Log Out</button>
                </div>
            </div>
          </li>
        </ul>
      </nav>
        
        @yield('body')

    </div>
  </div>

  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    /*Toggle dropdown list*/
    function toggleDD() {
      document.querySelector('#myDropdown').classList.toggle('invisible');
    }

    // Close DropDown menu
    window.onclick = function(event) {
        (!event.target.closest('#myDropdown') && !document.querySelector('#myDropdown').classList.contains('invisible') && !event.target.closest('button.drop-button')) ? toggleDD() : null
    }

    // Logout GET Request
    const logout = () => {
      axios.get("{{ url('/user/logout') }}")
        .then(function (response) {
          const res = response.data
          if ( res === 'Logout successful' ) {
            return window.location.href = "{{ url('/') }}"
          }
        })
        .catch(function (error) {
          throw error
      })
    }
  </script>
  <script src="{{ asset('/js/alertify.min.js') }}"></script>
  @if ( Session::has('sm') )
    <script>
      alertify.success("{{ Session::get('sm') }}", 3);
    </script>
  @endif
  <script src="{{ asset('/js/main.js') }}"></script>
  @yield('jsdependancy')
</body>

</html>