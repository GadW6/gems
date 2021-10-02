@section('cssdependancy')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/glide.core.min.css') }}">
@endsection

<div class="carousel container mt-16 mx-auto relative" style="max-width:1600px;height: 75vh;">
    <div class="carousel-inner relative overflow-hidden w-full">

        <div class="glide">
            <div class="glide__track" data-glide-el="track">
                <ul class="glide__slides">
                    @foreach ($categories as $category)
                    <li class="bg-black glide__slide glide__slide--active text-center w-screen">
                        {{-- {{ $category->c_id }} --}}
                        <img class="object-contain" src="{{ asset('/storage/categories/' . $category->c_image) }}" style="height: 75vh">
                        <div class="-mt-8 absolute items-center px-10 sm:absolute sm:ml-8 sm:mt-0 top-0">
                            <p class="mt-16 text-2xl text-gray-300">{{ $category->c_title }}</p>
                            <a class="border-b border-yellow-700 hover:border-yellow-600 hover:text-yellow-600 inline-block text-xl text-yellow-700" href="{{ url('/shop/' . $category->c_url) }}">view product</a>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <div class="absolute block glide__arrows top-0 w-screen" data-glide-el="controls" style="margin-top: 35vh; max-width:1600px;">
                    <button class="glide__arrow glide__arrow--left h-10 mx-3 sm:h-16 sm:w-16 w-10" data-glide-dir="<">
                        <svg class="fill-current hover:text-gray-500 text-gray-600" viewBox="0 0 20 20">
							<path fill="" d="M8.388,10.049l4.76-4.873c0.303-0.31,0.297-0.804-0.012-1.105c-0.309-0.304-0.803-0.293-1.105,0.012L6.726,9.516c-0.303,0.31-0.296,0.805,0.012,1.105l5.433,5.307c0.152,0.148,0.35,0.223,0.547,0.223c0.203,0,0.406-0.08,0.559-0.236c0.303-0.309,0.295-0.803-0.012-1.104L8.388,10.049z"></path>
						</svg>
                    </button>
                    <button class="float-right glide__arrow glide__arrow--right h-10 mx-3 sm:h-16 sm:w-16 w-10" data-glide-dir=">">
                        <svg class="fill-current hover:text-gray-500 text-gray-600" viewBox="0 0 20 20">
							<path fill="" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
						</svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('jsdependancy')
    @parent
    <script src="{{ asset('/js/glide.min.js') }}"></script>
    <script>
        new Glide('.glide').mount()

    </script>
@endsection
