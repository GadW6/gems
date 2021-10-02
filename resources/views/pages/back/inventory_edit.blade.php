@extends('pages.back.master')

@section('cssdependancy')
    @parent
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
      .ql-editor {
        position: absolute;
        height: 100%;
        width: 100%;
      }
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
    <a class="border border-gray-600 font-light hover:border-blue-700 hover:text-blue-800 w-1/2 md:w-1/5 py-1 text-center text-gray-700" href="{{ url('cms/inventory') }}">
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

<form class="max-w-4xl md:px-0 mx-auto my-8 px-3" action="{{ url('cms/inventory/' . $category->id) }}" method="POST" enctype="multipart/form-data" novalidate onsubmit="copyPaste(event)">
  @method('PUT')
  @csrf
  <div class="mb-4">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
      Category Title
      <span class="font-light text-red-600 text-xs">* Required</span>
    </label>
    <input class="shadow w-full py-2 px-3 text-gray-700 leading-tight" id="title" name="title" type="text" value="{{ old('title', $category->c_title) }}">
    @error('title')
      <p class="text-red-500 text-xs italic mt-2 ml-1">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="uri">
      URI
      <span class="font-light text-red-600 text-xs">* Required</span>
    </label>
    <input class="shadow w-full py-2 px-3 text-gray-700 leading-tight" id="uri" name="uri" type="text" value="{{ old('uri', $category->c_url) }}">
    @error('uri')
      <p class="text-red-500 text-xs italic mt-2 ml-1">{{ $message }}</p>  
    @enderror
  </div>
  <div class="h-full mb-4 text-gray-800 w-full">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
      Description
    </label>
    <div class="bg-white shadow text-gray-700 leading-tight" id="editor" style="min-height: 30vh;">{!! old('description', $category->c_description) !!}</div>
    <textarea class="hidden" name="description"></textarea>
    @error('description')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
  </div>
  <div class="mb-6">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
      Image
      <small class="font-light text-gray-500">(Dark background is recommended)</small>
    </label>
    <input class="shadow bg-white w-full py-2 px-3 text-gray-700 leading-tight" id="image" name="image" type="file" accept=".gif,.jpg,.jpeg,.png">
    @error('image')
      <p class="text-red-500 text-xs italic mt-2 ml-1">{{ $message }}</p>  
    @enderror
  </div>
  <div>
    <input class="w-full font-light py-1 px-10 border border-gray-800 hover:border-blue-700 text-gray-700 hover:text-blue-800 bg-gray-100 cursor-pointer" value="Save" type="submit">
  </div>
</form>


@endsection

@section('jsdependancy')
    @parent
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
      const toolbarOptions = [
        [{ 'font': [] }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'direction': 'rtl' }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'align': [] }],
        ['link', 'image'],
        ['clean']
      ]
      const quill = new Quill('#editor', {
        theme: 'snow',
        formats: {
          color: '#666'
        },
        modules: {
          toolbar: toolbarOptions
        }
      });
      const copyPaste = e => {
        const targetDiv = document.querySelector('div#editor').firstElementChild
        const textArea = document.querySelector('textarea')
        if (targetDiv.innerHTML === '<p><br></p>') {
          textArea.value = ''
        } else {
          textArea.value = targetDiv.innerHTML
        }
      }
    </script>
@endsection