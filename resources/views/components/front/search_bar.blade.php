@section('cssdependancy')
    @parent
@endsection

<nav id="store" class="w-full top-0 px-6 py-1">
  <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">

      <aside id="category" class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl ">{{ $search_title ?? 'Store' }}</aside>

      <div class="flex items-center" id="store-nav-content">

        <div id="sort" data-state="close" class="mb-1 flex flex-row px-2 rounded-full">
            <section class="hidden grid-cols-4 inline-grid px-2 py-1">
                <a class="border-r hover:bg-gray-100 inline-grid grid-cols-2 px-1" href="{{ ($search) ? url()->current() . '?content_search=' . $search . '&sort=p_price&order=asc' : url()->current() . '?sort=p_price&order=asc' }}">
                    <p class="font-light text-gray-800 text-right">&#8362;</p>    
                    <img class="h-3 mt-2" src="{{ asset('/icons/down-arrow.svg') }}">
                </a>
                <a class="border-r hover:bg-gray-100 inline-grid grid-cols-2 px-1" href="{{ ($search) ? url()->current() . '?content_search=' . $search . '&sort=p_price&order=desc' : url()->current() . '?sort=p_price&order=desc' }}">
                    <img class="h-3 mt-2 ml-1" src="{{ asset('/icons/up-arrow.svg') }}">
                    <p class="text-gray-800 font-light">&#8362;</p>    
                </a>
                <a class="border-r hover:bg-gray-100 inline-grid grid-cols-2 px-1" href="{{ ($search) ? url()->current() . '?content_search=' . $search . '&sort=p_title&order=asc' : url()->current() . '?sort=p_title&order=asc' }}">
                    <aside class="flex flex-row mt-1">
                        <p class="font-light text-gray-800 text-xs">A</p>    
                        <p class="font-light text-gray-800 text-xs">Z</p>    
                    </aside>
                    <img class="h-3 mt-1 text-left mt-2" src="{{ asset('/icons/down-arrow.svg') }}">
                </a>
                <a class="hover:bg-gray-100 inline-grid grid-cols-2 px-1" href="{{ ($search) ? url()->current() . '?content_search=' . $search . '&sort=p_title&order=desc' : url()->current() . '?sort=p_title&order=desc' }}">
                    <img class="h-3 ml-1 mt-1 mt-2 text-right" src="{{ asset('/icons/up-arrow.svg') }}">
                    <aside class="flex flex-row mt-1">
                        <p class="font-light text-gray-800 text-xs">A</p>    
                        <p class="font-light text-gray-800 text-xs">Z</p>    
                    </aside>
                </a>
            </section>
            <button class="inline-grid no-underline hover:text-black" onclick="sort(event)">
                <svg class="fill-current hover:text-black ml-2 mt-1" xmlns="http://www.w3.org/2000/svg" width="24"
                height="24" viewBox="0 0 24 24">
                    <path d="M7 11H17V13H7zM4 7H20V9H4zM10 15H14V17H10z" />
                </svg>
            </button>
        </div>

        <div class="rounded-full inline-block" data-state="close" id="search">
            {{-- <form action="{{ ($cat) ? url('/shop/' . $cat) : url('/shop') }}" method="GET"> --}}
            <form action="{{ url()->current() }}" method="GET">
                <input type="text" class="ml-2 hidden" oninput="searchContent(event)" name="content_search">
                <button id="clear" onclick="clearField(event)" type="button" class="-ml-5 -mr-2 bg-gray-200 font-light hover:bg-gray-300 hover:text-red-600 p-px px-2 py-px rounded-full text-red-500 text-xs hidden">X</button>
                <button id="search-btn" type="button" class="inline-block no-underline hover:text-black pl-3" onclick="search(event)">
                    <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                    </svg>
                </button>
            </form>
        </div>
      </div>
  </div>
</nav>

@section('jsdependancy')
    @parent
    <script>
        // UI Elements
        const category = document.querySelector('aside#category')
        const sortDiv = document.querySelector('div#sort')
        const searchDiv = document.querySelector('div#search')
        const clearBtn = document.querySelector('button#clear')
        const searchBtn = document.querySelector('button#search-btn')

        // Actions
        const sort = (e) => {
            e.preventDefault()
            if (sortDiv.getAttribute('data-state') === 'close') {
                sortDiv.setAttribute('data-state', 'open')
                if(window.innerWidth < 400){
                    category.classList.add('hidden')
                }
                if (searchDiv.getAttribute('data-state') === 'open') {
                    searchDiv.classList.remove('border', 'px-2', 'py-1')
                    searchDiv.firstElementChild.firstElementChild.classList.add('hidden')
                    searchDiv.setAttribute('data-state', 'close')
                }
                sortDiv.classList.remove('mb-1')
                sortDiv.classList.add('border')
                sortDiv.firstElementChild.classList.remove('hidden')
            } else {
                sortDiv.setAttribute('data-state', 'close')
                if(window.innerWidth < 400){
                    category.classList.remove('hidden')
                }
                sortDiv.classList.add('mb-1')
                sortDiv.classList.remove('border')
                sortDiv.firstElementChild.classList.add('hidden')
            }
        }

        const search = (e) => {
            const target = e.target.closest('button')
            if (searchDiv.getAttribute('data-state') === 'close') {
                e.preventDefault()
                searchDiv.setAttribute('data-state', 'open')
                if(window.innerWidth < 400){
                    category.classList.add('hidden')
                }
                if (sortDiv.getAttribute('data-state') === 'open') {
                    sortDiv.classList.add('mb-1')
                    sortDiv.classList.remove('border')
                    sortDiv.firstElementChild.classList.add('hidden')
                    sortDiv.setAttribute('data-state', 'close')
                }
                searchDiv.classList.add('border', 'px-2', 'py-1')
                searchDiv.firstElementChild.firstElementChild.classList.remove('hidden')
            } else if (searchDiv.getAttribute('data-state') === 'open' && target.type !== 'submit') {
                e.preventDefault()
                searchDiv.setAttribute('data-state', 'close')
                if(window.innerWidth < 400){
                    category.classList.remove('hidden')
                }
                searchDiv.classList.remove('border', 'px-2', 'py-1')
                searchDiv.firstElementChild.firstElementChild.classList.add('hidden')
            }
        }

        const searchContent = (e) => {
            if (e.target.value) {
                clearBtn.classList.remove('hidden')
                searchBtn.type = 'submit'
            } else {
                clearBtn.classList.add('hidden')
                searchBtn.type = 'button'
            }
        }

        const clearField = (e) => {
            e.preventDefault()
            searchDiv.firstElementChild.firstElementChild.value = ''
            e.target.classList.add('hidden')
            searchBtn.type = 'button'
        }
    </script>
@endsection