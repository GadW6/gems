@extends('master')

@section('cssdependancy')
    @parent
@endsection

@section('body')

@include('components.front.nav')


<section class="container mt-20 mx-auto mb-0">

  <!-- Main component -->
  <div class="antialiased flex flex-col md:h-screen font-sans md:flex-row md:px-0 px-4 py-10">

  
    <!-- Left Sidebar -->
    <div class="flex-none md:block md:mr-4 md:w-1/4 text-center">
      <section>
        @if ($user->image == 'no-image.png')
          <img class="bg-gray-300 h-24 p-2 rounded-full w-24" src="{{ asset('/storage/avatars/' . $user->image ) }}">  
          @else
          <img class="bg-gray-300 h-32 object-center object-cover p-2 rounded-full w-32" src="{{ asset('/storage/avatars/' . $user->image ) }}">  
        @endif
        <p class="border-b border-t font-light mt-5 py-3">Hello <span class="text-gray-700">{{ ucfirst($user->name) }}</span></p>
      </section>
      <section class="md:mt-6 mt-12 overflow-hidden">
        @include('components.front.user_sidebar')
      </section>
    </div>

    
    <!-- Right content -->
    <div class="flex flex-1 flex-col md:ml-4 md:pb-20 overflow-hidden text-center xl:pb-10">
      <section class="md:max-h-full md:mt-0 mt-10 md:overflow-y-scroll">
        <h2 class="border-b font-light inline-flex mb-6 pb-3 text-2xl">Profile Account:</h2>
      <form class="w-full mt-6" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              <span class="text-red-400">*</span> First Name
            </label>
            <input class="appearance-none block w-full border-b border-gray-200 @error('first-name') border-red-500 @enderror text-gray-700 py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-500" id="grid-first-name" name="first-name" type="text" placeholder="Jane" value="{{ old('first-name', ucfirst($user->name)) }}">
            @error('first-name')
              <p class="text-red-500 text-xs italic text-left">{{ $message }}</p>
            @enderror
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
              Last Name
            </label>
            <input class="appearance-none block w-full text-gray-700 border-b border-gray-200 @error('last-name') border-red-500 @enderror py-3 px-4 leading-tight mb-3 focus:outline-none focus:border-gray-500" id="grid-last-name" name="last-name" type="text" value="{{ ($user->last_name) ? old('last-name', ucfirst($user->last_name)) : old('last-name')}}">
            @error('last-name')
              <p class="text-red-500 text-xs italic text-left">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              <span class="text-red-400">*</span> E-Mail
            </label>
            <input class="appearance-none block w-full text-gray-700 border-b border-gray-200 @error('email') border-red-500 @enderror py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-500" id="grid-email" name="email" type="text" value="{{ ($user->email) ? old('email', $user->email) : old('email')}}">
            @error('email')
              <p class="text-red-500 text-xs italic text-left">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              <span class="text-red-400">*</span> Password
            </label>
            <input class="appearance-none block w-full text-gray-700 border-b border-gray-200 @error('password') border-red-500 @enderror py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-500" id="grid-password" name="password" type="password" onClick="this.select();" value="{{ ($user->password) ? old('password', $user->password) : old('password')}}">
            @error('password')
              <p class="text-red-500 text-xs italic text-left">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Address
            </label>
            <input class="appearance-none block w-full text-gray-700 border-b border-gray-200 @error('address') border-red-500 @enderror py-3 px-4 mb-3 leading-tight focus:outline-none focus:border-gray-500" id="grid-address" name="address" type="text" placeholder="Ibn Gvirol 8" value="{{ ($user->address) ? old('address', $user->address) : old('password')}}">
            @error('address')
              <p class="text-red-500 text-xs italic text-left">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-city">
              City
            </label>
            <input class="appearance-none block w-full text-gray-700 border-b border-gray-200 @error('city') border-red-500 @enderror py-3 px-4 leading-tight mb-3 focus:outline-none focus:border-gray-500" id="grid-city" name="city" type="text" placeholder="Tel-Aviv" value="{{ ($user->city) ? old('city', $user->city) : old('city')}}">
            @error('city')
              <p class="text-red-500 text-xs italic text-left">{{ $message }}</p>
            @enderror
          </div>
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-zip">
              Country
            </label>
            <input class="appearance-none block w-full text-gray-700 border-b border-gray-200 @error('country') border-red-500 @enderror py-3 px-4 leading-tight mb-3 focus:outline-none focus:border-gray-500" id="grid-country" name="country" type="text" placeholder="Israel" value="{{ ($user->country) ? old('country', $user->country) : old('country')}}">
            @error('country')
              <p class="text-red-500 text-xs italic text-left">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold" for="grid-password">
              Avatar
            </label>
            <span class="font-thin text-xs">(Formats: PNG, JPEG, JPG, SVG. SIZE: 500K max.)</span>
            <input class="appearance-none block w-full text-gray-700 border-b border-gray-200 @error('file') border-red-500 @enderror py-3 px-4 mb-3 leading-tight mb-3 focus:outline-none focus:border-gray-500" name="file" type="file" accept=".jpg, .jpeg, .png, .svg" value="test">
            @error('file')
              <p class="text-red-500 text-xs italic text-left">{{ $message }}</p>
            @enderror
          </div>
        </div>
        <div class="-mx-3 flex flex-wrap justify-center mb-2">
          <button class="bg-gray-700 hover:bg-gray-800 just my-5 px-6 py-2 text-gray-100 font-light" type="submit">Save Changes</button>
        </div>
      </form>
      </section>
    </div>
  </div>
</section>


@if (!Session::has('user_id'))
  @include('components.front.login')  
@endif

@include('components.front.footer')

@endsection

@section('jsdependancy')
    @parent
@endsection