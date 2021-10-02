<footer class="relative bottom-0 mx-auto py-2 sm:p-3 text-gray-400 w-screen" style="background-color: #282828;">
  <div class="container flex flex-col md:flex-row mx-auto px-3 py-2">
    <div class="flex-1">
      <ul class="flex flex-col font-thin md:flex-row">
        <li class="border-b sm:border-0 border-gray-800 flex-auto hover:text-gray-300 mx-4 py-2 sm:p-auto sm:m-auto sm:mx-auto"><a href="{{ url('/shop') }}">Shop</a></li>
        @foreach ($menu as $menuItem)
          <li class="border-b sm:border-0 border-gray-800 flex-auto hover:text-gray-300 mx-4 py-2 sm:p-auto sm:m-auto sm:mx-auto"><a href="{{ url('/' . $menuItem->url) }}">{{ $menuItem->link }}</a></li>
        @endforeach
      </ul>
    </div>
    <div class="flex-1 my-auto px-6 py-8 sm:px-0 sm:px-24 sm:py-0">
      <div class="flex">
        <p class="font-hairline px- text-xs">Design by <a class="cursor-pointer text-red-400" href="#">ITGLOBE</a> with &#x2665; - Copyrights &copy; {{ date("Y") }}</p>
      </div>
    </div>
    <div class="flex-1">
      <ul class="flex float-left md:float-right sm:mt-2">
        <li class="flex-1 mx-4 hover:text-gray-300"><a href="http://www.facebook.com" target="_blank" title="Facebook" rel="nofollow"><img class="bg-gray-500 h-6 hover:bg-blue-700 rounded" width="25px" src="{{ asset('/icons/facebook.svg') }}" alt="" srcset=""></a></li>
        <li class="flex-1 mx-4 hover:text-gray-300"><a href="https://www.github.com" target="_blank" title="Instagram" rel="nofollow"><img class="bg-gray-500 h-6 hover:bg-orange-700 rounded" width="25px" src="{{ asset('/icons/github.svg') }}" alt="" srcset=""></a></li>
        <li class="flex-1 mx-4 hover:text-gray-300"><a href="http://www.linkedin.com" target="_blank" title="Twitter" rel="nofollow"><img class="bg-gray-500 h-6 hover:bg-blue-500 rounded" width="25px" src="{{ asset('/icons/linkedin.svg') }}" alt="" srcset=""></a></li>
      </ul>
    </div>
  </div>
</footer>