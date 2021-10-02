@extends('pages.back.master')

@section('cssdependancy')
    @parent
    <style>
        div.w-full.p-2 a:hover > div.shown-menus {
            display: none;
        }
        div.w-full.p-2 a > div.hidden-menus {
            display: none;
        }
        div.w-full.p-2 a:hover > div.hidden-menus {
            display: initial;
        }
        div.w-full.p-2 a:hover svg {
            color: #00246b;
        }
        div.w-full.p-2:hover button {
            visibility: visible;
        }
        div.w-full.p-2:hover button:hover {
            visibility: visible;
            background-color: white;
        }
    </style>
@endsection

@section('body')

<div class="container flex flex-row max-w-4xl md:px-0 mx-auto px-3 py-5">
    <a class="border border-gray-600 font-light hover:border-blue-700 hover:text-blue-800 w-1/2 md:w-1/5 py-1 text-center text-gray-700" href="{{ url('cms/contents') }}">
        <svg class="svg-icon h-5 w-5 fill-current mb-px mr-2" viewBox="0 0 20 20">
          <path d="M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0
          L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109
          c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483
          c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788
          S18.707,9.212,18.271,9.212z"></path>
        </svg>
        BACK
    </a>
</div>

<form class="max-w-4xl md:px-0 mx-auto my-8 px-3" action="{{ url('cms/contents/' . $menu->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
      Nav Title
      <span class="font-light text-red-600 text-xs">* Required</span>
    </label>
    <input class="shadow w-full py-2 px-3 text-gray-700 leading-tight" id="title" name="title" type="text" value="{{ old('title', $menu->link) }}">
    @error('title')
      <p class="text-red-500 text-xs italic mt-2 ml-1">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="uri">
      URI
      <span class="font-light text-red-600 text-xs">* Required</span>
    </label>
    <input class="shadow w-full py-2 px-3 text-gray-700 leading-tight" id="uri" name="uri" type="text" value="{{ old('uri', $menu->url) }}">
    @error('uri')
      <p class="text-red-500 text-xs italic mt-2 ml-1">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="section-title">
      Default Section Title
      <span class="font-light text-red-600 text-xs">* Required</span>
    </label>
    <input class="shadow w-full py-2 px-3 text-gray-700 leading-tight" id="section-title" name="section-title" type="section-title" value="{{ old('section-title', $menu->title) }}">
    @error('section-title')
      <p class="text-red-500 text-xs italic mt-2 ml-1">{{ $message }}</p>
    @enderror
  </div>
  <div>
    <input class="font-light py-1 border border-gray-800 hover:border-blue-700 text-gray-700 hover:text-blue-800 bg-gray-100 cursor-pointer w-full" value="Save" type="submit">
  </div>
</form>


@endsection

@section('jsdependancy')
    @parent
@endsection