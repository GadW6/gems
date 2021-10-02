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
  </style>
@endsection

@section('body')

<div class="container flex max-w-4xl mx-auto px-3 md:px-0 py-5">
  <a class="border border-gray-600 font-light hover:border-blue-700 hover:text-blue-800 w-full md:w-1/4 py-1 text-center text-gray-700 uppercase" href="{{ url()->current() . './../../' }}">
      <svg class="svg-icon h-5 w-5 fill-current mb-px mr-2" viewBox="0 0 20 20">
        <path d="M18.271,9.212H3.615l4.184-4.184c0.306-0.306,0.306-0.801,0-1.107c-0.306-0.306-0.801-0.306-1.107,0
        L1.21,9.403C1.194,9.417,1.174,9.421,1.158,9.437c-0.181,0.181-0.242,0.425-0.209,0.66c0.005,0.038,0.012,0.071,0.022,0.109
        c0.028,0.098,0.075,0.188,0.142,0.271c0.021,0.026,0.021,0.061,0.045,0.085c0.015,0.016,0.034,0.02,0.05,0.033l5.484,5.483
        c0.306,0.307,0.801,0.307,1.107,0c0.306-0.305,0.306-0.801,0-1.105l-4.184-4.185h14.656c0.436,0,0.788-0.353,0.788-0.788
        S18.707,9.212,18.271,9.212z"></path>
      </svg>
      Back
  </a>
</div>


<form class="container flex flex-wrap max-w-4xl mx-auto py-5 px-3 md:px-0" action="{{ url()->current() . './../' }}" method="POST" novalidate autocomplete="off" onsubmit="copyPaste(event)">
  @csrf
  <div class="w-full mb-3">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
      Title
    </label>
    <input class="shadow w-full py-2 px-3 text-gray-700 leading-tight" name="title" id="title" type="text" value="{{ old('title') }}">
    @error('title')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
  </div>
  <div class="h-full mb-4 text-gray-800 w-full">
    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
      Article
    </label>
    <div class="bg-white shadow text-gray-700 leading-tight" id="editor" style="min-height: 30vh;">{!! old('article') !!}</div>
    <textarea class="hidden" name="article"></textarea>
    @error('article')
      <p class="text-red-500 text-xs italic">{{ $message }}</p>
    @enderror
  </div>
  <input class="border border-gray-600 bg-gray-100 font-light hover:border-blue-700 hover:text-blue-800 w-full py-1 text-center text-gray-700 uppercase cursor-pointer" value="Submit" type="submit">
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