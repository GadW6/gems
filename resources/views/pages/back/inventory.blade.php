@extends('pages.back.master')

@section('cssdependancy')
    @parent
    <style>
        table tbody:nth-child(odd) {
            box-shadow: 
                0 10px 15px -3px rgba(0, 0, 0, 0.1), 
                0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        table tbody td > aside {
            visibility: hidden;
        }
        
        table tbody:hover td > aside {
            visibility: visible;
        }

        table tbody:hover td > aside > span > p {
            visibility: hidden;
            transition: visibility 500ms ease-in;
        }
        
        table tbody:hover td > aside > span:hover > p {
            visibility: visible;
        }
    </style>
@endsection

@section('body')

<div class="container flex flex-wrap max-w-4xl mx-auto py-5 px-3 md:px-0">

    <table class="mt-6 table-auto w-full">
        <thead>
          <tr class="bg-gray-700 text-gray-100">
            <th class="px-4 py-2">Product Title</th>
            <th class="px-4 py-2">Price</th>
            <th class="px-4 py-2">Actions</th>
          </tr>
        </thead>
        {{-- Header --}}
        <tbody>
            <tr>
              <td class="border border-t-0 border-gray-600 hover:border-blue-700 text-center text-xl" colspan="3">
                <a class="block font-light hover:text-blue-800 w-full py-2 text-center text-gray-700 uppercase" href="{{ url()->current() . '/create' }}">
                    <svg class="svg-icon h-5 w-5 fill-current mb-px mr-2" viewBox="0 0 20 20">
                        <path d="M14.613,10c0,0.23-0.188,0.419-0.419,0.419H10.42v3.774c0,0.23-0.189,0.42-0.42,0.42s-0.419-0.189-0.419-0.42v-3.774H5.806c-0.23,0-0.419-0.189-0.419-0.419s0.189-0.419,0.419-0.419h3.775V5.806c0-0.23,0.189-0.419,0.419-0.419s0.42,0.189,0.42,0.419v3.775h3.774C14.425,9.581,14.613,9.77,14.613,10 M17.969,10c0,4.401-3.567,7.969-7.969,7.969c-4.402,0-7.969-3.567-7.969-7.969c0-4.402,3.567-7.969,7.969-7.969C14.401,2.031,17.969,5.598,17.969,10 M17.13,10c0-3.932-3.198-7.13-7.13-7.13S2.87,6.068,2.87,10c0,3.933,3.198,7.13,7.13,7.13S17.13,13.933,17.13,10"></path>
                    </svg>
                    ADD Category
                </a>
              </td>
            </tr>
            {{-- Cell Spacing --}}
            <tr>
                <td class="py-6"></td>
            </tr>
        </tbody>

        @foreach ($categories->sortBy('c_title') as $category)    
            {{-- Category --}}
            <tbody>
                {{-- Cell Title --}}
                <tr>
                    <td class="border-0 px-4 py-2 text-center text-blue-800 text-xl" colspan="3">
                        <span class="ml-24">{{ ucfirst($category->c_title) }}</span>
                        <aside class="flex flex-row float-right sm:invisible visible">
                            <span>
                                <p class="-ml-2 -mt-5 absolute bg-black font-light invisible opacity-75 px-2 rounded-lg text-gray-100 text-sm tooltip">Edit</p>
                                <a href="{{ url('cms/inventory/' . $category->id . '/edit') }}">
                                    <svg class="svg-icon fill-current h-6 w-6 text-blue-500" viewBox="0 0 20 20">
                                        <path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
                                    </svg>
                                </a>
                            </span>
                            <span class="ml-3">
                                <p class="-ml-2 -mt-5 absolute bg-black font-light invisible opacity-75 px-2 rounded-lg text-gray-100 text-sm tooltip">Remove</p>
                                <button onclick="removeCategory(event, {{ $category->id }}, '{{ $category->c_title }}')">
                                    <svg class="svg-icon fill-current h-6 w-6 text-red-500 ml-3" viewBox="0 0 20 20">
                                        <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                                    </svg>
                                </button>
                            </span>
                        </aside>
                    </td>
                </tr>
                {{-- Cell Add Product --}}
                <tr>
                    <td class="border border-gray-600 font-light hover:border-blue-700 hover:text-blue-800 w-full py-2 text-center text-gray-700 uppercase" colspan="3">
                        <a class="block cursor-pointer font-light h-full text-sm w-full" href="{{ url('cms/inventory/' . $category->id . '/product/create') }}">+ Add Product</a>
                    </td>
                </tr>
                {{-- Table --}}
                @foreach ($products->where('category_id', $category->id)->sortBy('p_title') as $product)    
                <tr class="font-light hover:bg-gray-200">
                    <td class="border px-4 py-2">
                        <a href="{{ url('shop/' . $category->c_url . '/' . $product->p_url) }}" class="hover:underline hover:text-blue-800">{{ ucfirst($product->p_title) }}</a>
                    </td>
                    <td class="border px-4 py-2 whitespace-no-wrap">&#8362; {{ $product->p_price }}</td>
                    <td class="border px-4 py-2 whitespace-no-wrap text-center">
                        <a class="mr-2 hover:text-blue-500" href="{{ url('cms/inventory/' . $category->id . '/product/' . $product->id . '/edit') }}">
                            <svg class="svg-icon fill-current h-6 w-6" viewBox="0 0 20 20">
                                <path d="M18.303,4.742l-1.454-1.455c-0.171-0.171-0.475-0.171-0.646,0l-3.061,3.064H2.019c-0.251,0-0.457,0.205-0.457,0.456v9.578c0,0.251,0.206,0.456,0.457,0.456h13.683c0.252,0,0.457-0.205,0.457-0.456V7.533l2.144-2.146C18.481,5.208,18.483,4.917,18.303,4.742 M15.258,15.929H2.476V7.263h9.754L9.695,9.792c-0.057,0.057-0.101,0.13-0.119,0.212L9.18,11.36h-3.98c-0.251,0-0.457,0.205-0.457,0.456c0,0.253,0.205,0.456,0.457,0.456h4.336c0.023,0,0.899,0.02,1.498-0.127c0.312-0.077,0.55-0.137,0.55-0.137c0.08-0.018,0.155-0.059,0.212-0.118l3.463-3.443V15.929z M11.241,11.156l-1.078,0.267l0.267-1.076l6.097-6.091l0.808,0.808L11.241,11.156z"></path>
                            </svg>
                        </a>
                        <button class="hover:text-red-500" onclick="removeProduct(event, {{ $category->id }}, {{ $product->id }}, '{{ ucfirst($product->p_title) }}')">
                            <svg class="svg-icon fill-current h-6 w-6 ml-3" viewBox="0 0 20 20">
                                <path d="M17.114,3.923h-4.589V2.427c0-0.252-0.207-0.459-0.46-0.459H7.935c-0.252,0-0.459,0.207-0.459,0.459v1.496h-4.59c-0.252,0-0.459,0.205-0.459,0.459c0,0.252,0.207,0.459,0.459,0.459h1.51v12.732c0,0.252,0.207,0.459,0.459,0.459h10.29c0.254,0,0.459-0.207,0.459-0.459V4.841h1.511c0.252,0,0.459-0.207,0.459-0.459C17.573,4.127,17.366,3.923,17.114,3.923M8.394,2.886h3.214v0.918H8.394V2.886z M14.686,17.114H5.314V4.841h9.372V17.114z M12.525,7.306v7.344c0,0.252-0.207,0.459-0.46,0.459s-0.458-0.207-0.458-0.459V7.306c0-0.254,0.205-0.459,0.458-0.459S12.525,7.051,12.525,7.306M8.394,7.306v7.344c0,0.252-0.207,0.459-0.459,0.459s-0.459-0.207-0.459-0.459V7.306c0-0.254,0.207-0.459,0.459-0.459S8.394,7.051,8.394,7.306"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
                {{-- End Table --}}
            </tbody>

            {{-- Spacing Block --}}
            <tbody>
                {{-- Cell Spacing --}}
                <tr>
                    <td class="py-6"></td>
                </tr>   
            </tbody>
        @endforeach

      </table>
</div>


@endsection

@section('jsdependancy')
    @parent
    <script>
        const removeCategory = (e, id, uri) => {
            e.preventDefault()
            const result = confirm(`WARNING !!! You are about to remove the entire ${uri} category (but first make sure it's content is empty). Are you sure ?`)
            if (result) {
                axios.delete('/cms/inventory/' + id)
                    .then(res => {
                        (res.data === 'success') ? window.location.reload() : window.location.href = '{{ url("404") }}'
                    })
                    .catch(err => {
                        (err.response.status === 500) ? alert('Can\'t remove this category because it\'s content isn\'t empty. \nMake sure to remove every single element from this category first...') : false
                    })
            }
        }
        
        const removeProduct = (e, cid, pid, puri) => {
            e.preventDefault()
            const result = confirm(`WARNING !!! You are about to remove the ${puri} product. Are you sure ?`)
            if (result) {
                axios.delete('/cms/inventory/' + cid + '/product/' + pid)
                    .then(res => {
                        (res.data === 'success') ? window.location.reload() : window.location.href = '{{ url("404") }}'
                        // console.log(res.data);
                    })
            }
        }
    </script>
@endsection