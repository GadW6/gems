@section('cssdependancy')
  @parent
  <style>
    .u--fadeInDown {
      -webkit-animation: fadeInDown 250ms ease-in;
      -moz-animation: fadeInDown 250ms ease-in;
      -o-animation: fadeInDown 250ms ease-in;
      animation: fadeInDown 250ms ease-in;
    }
    .u--fadeOutUp {
      -webkit-animation: fadeOutUp 500ms ease-out;
      -moz-animation: fadeOutUp 500ms ease-out;
      -o-animation: fadeOutUp 500ms ease-out;
      animation: fadeOutUp 500ms ease-out;
    }
  </style>
@endsection

{{-- <button onclick="menu(event)"><h3>Submenu</h3></button> --}}
<div class="my-px md:hidden">
  <button onclick="menu(event)"
     class="bg-gray-700 flex flex-row h-12 items-center px-4 rounded-lg text-gray-600 w-full">
    <span class="flex items-center justify-center text-lg text-gray-400">
      <svg class="fill-current h-6 w-6 text-gray-600" viewBox="0 0 20 20">
        <path d="M10,1.445c-4.726,0-8.555,3.829-8.555,8.555c0,4.725,3.829,8.555,8.555,8.555c4.725,0,8.555-3.83,8.555-8.555C18.555,5.274,14.725,1.445,10,1.445 M10,17.654c-4.221,0-7.654-3.434-7.654-7.654c0-4.221,3.433-7.654,7.654-7.654c4.222,0,7.654,3.433,7.654,7.654C17.654,14.221,14.222,17.654,10,17.654 M14.39,10c0,0.248-0.203,0.45-0.45,0.45H6.06c-0.248,0-0.45-0.203-0.45-0.45s0.203-0.45,0.45-0.45h7.879C14.187,9.55,14.39,9.752,14.39,10 M14.39,12.702c0,0.247-0.203,0.449-0.45,0.449H6.06c-0.248,0-0.45-0.202-0.45-0.449c0-0.248,0.203-0.451,0.45-0.451h7.879C14.187,12.251,14.39,12.454,14.39,12.702 M14.39,7.298c0,0.248-0.203,0.45-0.45,0.45H6.06c-0.248,0-0.45-0.203-0.45-0.45s0.203-0.45,0.45-0.45h7.879C14.187,6.848,14.39,7.051,14.39,7.298"></path>
      </svg>
    </span>
    <span class="font-light ml-3 text-gray-400">Menu</span>
    <span class="flex items-center justify-center text-sm text-gray-500 font-semibold h-6 px-2 rounded-full ml-auto">
      <svg class="fill-current h-5 w-5 text-gray-600" viewBox="0 0 20 20">
        <path d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
      </svg>
    </span>
  </button>
</div>
<nav class="hidden mt-2 md:block">
  <ul class="font-light">
    <li class="my-px">
      <a href="{{ url('/user/profile') }}"
         class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 {{ ($url == url('/user/profile')) ? 'bg-gray-200' : 'hover:bg-gray-100' }}">
        <span class="flex items-center justify-center text-lg text-gray-400">
          <svg class="fill-current h-6 w-6" viewBox="0 0 20 20">
            <path d="M18.121,9.88l-7.832-7.836c-0.155-0.158-0.428-0.155-0.584,0L1.842,9.913c-0.262,0.263-0.073,0.705,0.292,0.705h2.069v7.042c0,0.227,0.187,0.414,0.414,0.414h3.725c0.228,0,0.414-0.188,0.414-0.414v-3.313h2.483v3.313c0,0.227,0.187,0.414,0.413,0.414h3.726c0.229,0,0.414-0.188,0.414-0.414v-7.042h2.068h0.004C18.331,10.617,18.389,10.146,18.121,9.88 M14.963,17.245h-2.896v-3.313c0-0.229-0.186-0.415-0.414-0.415H8.342c-0.228,0-0.414,0.187-0.414,0.415v3.313H5.032v-6.628h9.931V17.245z M3.133,9.79l6.864-6.868l6.867,6.868H3.133z"></path>
          </svg>
        </span>
        <span class="ml-3">Dashboard</span>
      </a>
    </li>
    <li class="my-px">
      <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">Orders</span>
    </li>
    <li class="my-px">
      <a href="{{ url('/user/profile/order') }}"
         class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 {{ ($url == url('/user/profile/order')) ? 'bg-gray-200' : 'hover:bg-gray-100' }}">
        <span class="flex items-center justify-center text-lg text-gray-400">
          <svg class="fill-current h-6 w-6" viewBox="0 0 20 20">
            <path d="M10.25,2.375c-4.212,0-7.625,3.413-7.625,7.625s3.413,7.625,7.625,7.625s7.625-3.413,7.625-7.625S14.462,2.375,10.25,2.375M10.651,16.811v-0.403c0-0.221-0.181-0.401-0.401-0.401s-0.401,0.181-0.401,0.401v0.403c-3.443-0.201-6.208-2.966-6.409-6.409h0.404c0.22,0,0.401-0.181,0.401-0.401S4.063,9.599,3.843,9.599H3.439C3.64,6.155,6.405,3.391,9.849,3.19v0.403c0,0.22,0.181,0.401,0.401,0.401s0.401-0.181,0.401-0.401V3.19c3.443,0.201,6.208,2.965,6.409,6.409h-0.404c-0.22,0-0.4,0.181-0.4,0.401s0.181,0.401,0.4,0.401h0.404C16.859,13.845,14.095,16.609,10.651,16.811 M12.662,12.412c-0.156,0.156-0.409,0.159-0.568,0l-2.127-2.129C9.986,10.302,9.849,10.192,9.849,10V5.184c0-0.221,0.181-0.401,0.401-0.401s0.401,0.181,0.401,0.401v4.651l2.011,2.008C12.818,12.001,12.818,12.256,12.662,12.412"></path>
          </svg>
        </span>
        <span class="ml-3">Order History</span>
      </a>
    </li>
    <li class="my-px">
      <span class="flex font-medium text-sm text-gray-400 px-4 my-4 uppercase">Personnal</span>
    </li>
    <li class="my-px">
      <button class="flex flex-row w-full items-center h-12 px-4 rounded-lg text-gray-600 cursor-not-allowed {{ ($url == url('/user/profile/settings')) ? 'bg-gray-200' : 'hover:bg-gray-100' }}" type="button" disabled>
        <span class="flex items-center justify-center text-lg text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" class="fill-current h-6 w-6" viewBox="0 0 20 20">
            <path d="M9.719,17.073l-6.562-6.51c-0.27-0.268-0.504-0.567-0.696-0.888C1.385,7.89,1.67,5.613,3.155,4.14c0.864-0.856,2.012-1.329,3.233-1.329c1.924,0,3.115,1.12,3.612,1.752c0.499-0.634,1.689-1.752,3.612-1.752c1.221,0,2.369,0.472,3.233,1.329c1.484,1.473,1.771,3.75,0.693,5.537c-0.19,0.32-0.425,0.618-0.695,0.887l-6.562,6.51C10.125,17.229,9.875,17.229,9.719,17.073 M6.388,3.61C5.379,3.61,4.431,4,3.717,4.707C2.495,5.92,2.259,7.794,3.145,9.265c0.158,0.265,0.351,0.51,0.574,0.731L10,16.228l6.281-6.232c0.224-0.221,0.416-0.466,0.573-0.729c0.887-1.472,0.651-3.346-0.571-4.56C15.57,4,14.621,3.61,13.612,3.61c-1.43,0-2.639,0.786-3.268,1.863c-0.154,0.264-0.536,0.264-0.69,0C9.029,4.397,7.82,3.61,6.388,3.61"></path>
          </svg>
        </span>
        <span class="ml-3 font-light">My Wishlist</span>
        <span class="flex disbaled items-center justify-center text-sm text-gray-100 font-normal bg-indigo-400 h-6 px-2 rounded-full ml-auto">Soon!</span>
      </button>
    </li>
    <li class="my-px">
      <a href="{{ url('/user/profile/account') }}"
         class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 {{ ($url == url('/user/profile/account')) ? 'bg-gray-200' : 'hover:bg-gray-100' }}">
        <span class="flex items-center justify-center text-lg text-gray-400">
          <svg class="fill-current w-6 h-6" viewBox="0 0 20 20">
            <path d="M12.075,10.812c1.358-0.853,2.242-2.507,2.242-4.037c0-2.181-1.795-4.618-4.198-4.618S5.921,4.594,5.921,6.775c0,1.53,0.884,3.185,2.242,4.037c-3.222,0.865-5.6,3.807-5.6,7.298c0,0.23,0.189,0.42,0.42,0.42h14.273c0.23,0,0.42-0.189,0.42-0.42C17.676,14.619,15.297,11.677,12.075,10.812 M6.761,6.775c0-2.162,1.773-3.778,3.358-3.778s3.359,1.616,3.359,3.778c0,2.162-1.774,3.778-3.359,3.778S6.761,8.937,6.761,6.775 M3.415,17.69c0.218-3.51,3.142-6.297,6.704-6.297c3.562,0,6.486,2.787,6.705,6.297H3.415z"></path>
          </svg>
        </span>
        <span class="ml-3">Profile Account</span>
      </a>
    </li>
    <li class="my-px">
      <button onclick="logout()"
         class="flex flex-row items-center h-12 px-4 rounded-lg text-gray-600 hover:bg-gray-100 w-full">
        <span class="flex items-center justify-center text-lg text-red-400">
          <svg class="fill-current w-6 h-6" viewBox="0 0 20 20" transform="rotate(90)">
            <path d="M8.416,3.943l1.12-1.12v9.031c0,0.257,0.208,0.464,0.464,0.464c0.256,0,0.464-0.207,0.464-0.464V2.823l1.12,1.12c0.182,0.182,0.476,0.182,0.656,0c0.182-0.181,0.182-0.475,0-0.656l-1.744-1.745c-0.018-0.081-0.048-0.16-0.112-0.224C10.279,1.214,10.137,1.177,10,1.194c-0.137-0.017-0.279,0.02-0.384,0.125C9.551,1.384,9.518,1.465,9.499,1.548L7.76,3.288c-0.182,0.181-0.182,0.475,0,0.656C7.941,4.125,8.234,4.125,8.416,3.943z M15.569,6.286h-2.32v0.928h2.32c0.512,0,0.928,0.416,0.928,0.928v8.817c0,0.513-0.416,0.929-0.928,0.929H4.432c-0.513,0-0.928-0.416-0.928-0.929V8.142c0-0.513,0.416-0.928,0.928-0.928h2.32V6.286h-2.32c-1.025,0-1.856,0.831-1.856,1.856v8.817c0,1.025,0.832,1.856,1.856,1.856h11.138c1.024,0,1.855-0.831,1.855-1.856V8.142C17.425,7.117,16.594,6.286,15.569,6.286z"></path>
          </svg>
        </span>
        <span class="ml-3">Logout</span>
      </button>
    </li>
  </ul>
</nav>

@section('jsdependancy')
  @parent
  <script>
    const menu = (e) => {
      const btn = e.target.closest('button')
      if (btn.parentElement.nextElementSibling.classList.contains('hidden')) {
        if (btn.parentElement.nextElementSibling.classList.contains('u--fadeOutUp')) {
          btn.parentElement.nextElementSibling.classList.remove('u--fadeOutUp')
        }
        btn.parentElement.nextElementSibling.classList.remove('hidden')
        btn.parentElement.nextElementSibling.classList.add('u--fadeInDown')
        btn.children[2].firstElementChild.style.transform = 'rotate(90deg)'
      } else {
        setTimeout(() => {
          btn.parentElement.nextElementSibling.classList.add('hidden')
        }, 250)
        btn.parentElement.nextElementSibling.classList.remove('u--fadeInDown')
        btn.parentElement.nextElementSibling.classList.add('u--fadeOutUp')
        btn.children[2].firstElementChild.style.transform = 'rotate(0deg)'
      }
    }
  </script>
@endsection