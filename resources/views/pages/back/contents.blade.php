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
        div.w-full.p-2:hover > button {
            visibility: visible;
        }
        div.w-full.p-2:hover > button:hover {
            visibility: visible;
            background-color: white;
        }
    </style>
@endsection

@section('body')

<div class="container flex flex-wrap max-w-4xl mx-auto py-5 px-3 md:px-0">
    @foreach ($menu as $menuItem)
    <div class="w-full sm:w-1/2 lg:w-1/3 p-2">
        <a href="{{ url('cms/contents/' . $menuItem->id) }}" class="z-10 border-gray-200 hover:bg-white border-solid border hover:border-gray-300 block m-2 py-5 text-center h-56 overflow-hidden">
            <div class="flex flex-col shown-menus">
                <h4 class="font-light text-gray-700 text-xl uppercase border-b pb-2">{{ $menuItem->link }}</h4>
                <div class="p-2">
                    <h6 class="font-light mt-1 pt-2">Status: <span class="{{ ($content->where('menu_id', $menuItem->id)->count() > 0) ? 'text-green-500' : 'text-red-500' }}">{{ ($content->where('menu_id', $menuItem->id)->count() > 0) ? 'Active' : 'Offline' }}</span></h6>
                    <h6 class="font-light">Section Count: <span class="font-bold text-gray-700">{{ $content->where('menu_id', $menuItem->id)->count() }}</span></h6>
                    <ul class="mt-3">
                        @foreach ($content->where('menu_id', $menuItem->id) as $section)
                        <li class="border-gray-400 border-l-4 font-light mb-1 ml-3 mr-1 pl-2 text-xs whitespace-no-wrap">{{ $section->c_title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="flex flex-col hidden-menus">
                <svg class="fill-current h-24 svg-icon text-gray-700 w-full" viewBox="0 0 20 20">
                    <path d="M10,6.978c-1.666,0-3.022,1.356-3.022,3.022S8.334,13.022,10,13.022s3.022-1.356,3.022-3.022S11.666,6.978,10,6.978M10,12.267c-1.25,0-2.267-1.017-2.267-2.267c0-1.25,1.016-2.267,2.267-2.267c1.251,0,2.267,1.016,2.267,2.267C12.267,11.25,11.251,12.267,10,12.267 M18.391,9.733l-1.624-1.639C14.966,6.279,12.563,5.278,10,5.278S5.034,6.279,3.234,8.094L1.609,9.733c-0.146,0.147-0.146,0.386,0,0.533l1.625,1.639c1.8,1.815,4.203,2.816,6.766,2.816s4.966-1.001,6.767-2.816l1.624-1.639C18.536,10.119,18.536,9.881,18.391,9.733 M16.229,11.373c-1.656,1.672-3.868,2.594-6.229,2.594s-4.573-0.922-6.23-2.594L2.41,10l1.36-1.374C5.427,6.955,7.639,6.033,10,6.033s4.573,0.922,6.229,2.593L17.59,10L16.229,11.373z"></path>
                </svg>
                <h3 class="font-light text-gray-700 text-xl">{{ $menuItem->link }}</h3>
            </div>
        </a>
        <button class="-mt-12 float-right md:invisible mr-3 p-1 rounded-full z-20" onclick="subEdit(event, true, 'button')">
            <svg class="fill-current h-6 ml-px svg-icon text-gray-700" viewBox="0 0 20 20" transform="rotate(90)">
                <path d="M10,2.172c-4.324,0-7.828,3.504-7.828,7.828S5.676,17.828,10,17.828c4.324,0,7.828-3.504,7.828-7.828S14.324,2.172,10,2.172M10,17.004c-3.863,0-7.004-3.141-7.004-7.003S6.137,2.997,10,2.997c3.862,0,7.004,3.141,7.004,7.004S13.862,17.004,10,17.004M10,8.559c-0.795,0-1.442,0.646-1.442,1.442S9.205,11.443,10,11.443s1.441-0.647,1.441-1.443S10.795,8.559,10,8.559 M10,10.619c-0.34,0-0.618-0.278-0.618-0.618S9.66,9.382,10,9.382S10.618,9.661,10.618,10S10.34,10.619,10,10.619 M14.12,8.559c-0.795,0-1.442,0.646-1.442,1.442s0.647,1.443,1.442,1.443s1.442-0.647,1.442-1.443S14.915,8.559,14.12,8.559 M14.12,10.619c-0.34,0-0.618-0.278-0.618-0.618s0.278-0.618,0.618-0.618S14.738,9.661,14.738,10S14.46,10.619,14.12,10.619 M5.88,8.559c-0.795,0-1.442,0.646-1.442,1.442s0.646,1.443,1.442,1.443S7.322,10.796,7.322,10S6.675,8.559,5.88,8.559 M5.88,10.619c-0.34,0-0.618-0.278-0.618-0.618S5.54,9.382,5.88,9.382S6.498,9.661,6.498,10S6.22,10.619,5.88,10.619"></path>
            </svg>
        </button>
        <ul class="hidden -mt-3 absolute bg-blue-900 ml-48 md:ml-40 p-2 text-gray-100" onmouseleave="subEdit(event, false, '')">
            <li class="cursor-pointer hover:bg-blue-800"><a class="block py-1 px-3" href="{{ url($menuItem->url) }}">To Page</a></li>
            <li class="cursor-pointer hover:bg-blue-800"><a class="block py-1 px-3" href="{{ url('cms/contents/' . $menuItem->id . '/edit') }}">Edit</a></li>
            <li class="cursor-pointer hover:bg-blue-800"><button class="block py-1 px-3" onclick="remove(event, {{ $menuItem->id }}, '{{ $menuItem->link }}')">Remove</button></li>
        </ul>
    </div>
    @endforeach
    <div class="w-full sm:w-1/2 lg:w-1/3 p-2">
        <a href="{{ url('cms/contents/create') }}" class="border-gray-200 hover:bg-white border-solid border hover:border-gray-300 block m-2 py-10 text-center h-56">
            <div class="flex flex-col">
                <svg class="fill-current h-24 svg-icon text-gray-700 w-full" viewBox="0 0 20 20">
                    <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                </svg>
                <h3 class="font-light text-gray-700 text-xl">ADD PAGE</h3>
            </div>
        </a>
    </div>
</div>


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

        const remove = (e, id, uri) => {
            e.preventDefault()
            const result = confirm(`WARNING !!! You are about to remove the entire ${uri} page and all it's content. Are you sure ?`)
            if (result) {
                axios.delete('/cms/contents/' + id)
                    .then(res => {
                        (res.data === 'success') ? window.location.reload() : window.location.href = '{{ url("404") }}'
                    })
            }
        }
    </script>
@endsection