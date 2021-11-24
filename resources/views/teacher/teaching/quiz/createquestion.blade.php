@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-white pb-10">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/teacher/class/quiz/show/{{$id}}/{{$idt}}">
      <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
      </button>
    </a>
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Form Buat Soal Kuis</h1>
    <div class="md:flex md:justify-center md:space-x-8 md:px-14">
      <form action="{{ route('teacherquizstorequestion', array("$id","$idt"))}}" method="POST" class="w-full max-w-lg" enctype="multipart/form-data">
        @csrf
        @if(session('errors'))
        @foreach ($errors->all() as $error)
        <div class="bg-red-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center">
          <svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
            <path fill="currentColor"  d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path>
          </svg>
          <span class="text-red-800">{{ $error }}</span>
        </div>
        @endforeach
        @endif
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Pertanyaan
            </label>
            <textarea name="question" id="question" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="textarea" required></textarea>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
              File Soal (Jika Ada)
            </label>
            <label class="w-64 flex flex-col w-full items-center px-4 py-6 bg-yellow-400 text-white rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-yellow-500 hover:text-white">
              <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
              </svg>
              <span class="mt-2 text-base leading-normal">Select a file</span>
              <input type='file' id="file" name="file" hidden>
            </label>
            <span id="file_name"></span>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Jenis Soal
            </label>
            <select name="is_multiple_choice" id="is_multiple_choice" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="FALSE">Pilih Jenis Soal</option>
              <option value="TRUE">Pilihan Ganda</option>
              <option value="FALSE">Essai</option>
            </select>
          </div>
        </div>
        <div id="multiple_choice" style="display:none;">
          <div id="answer_option">
            <div class="flex flex-wrap -mx-3 mb-1">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  Jawaban Pilihan 1
                </label>
                <input name="answer_option_1" id="answer_option_1" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="textarea" required>
              </div>
            </div>
            <div class="flex items-start items-center mb-6">
              <input id="checkbox" name="checkbox_answer_option_1" aria-describedby="checkbox" type="checkbox" class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded">
              <label for="checkbox" class="text-sm ml-3 font-medium text-gray-900">Kunci Jawaban</label>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                  File Jawaban
                </label>
                <label class="w-64 flex flex-col w-full items-center px-4 py-6 bg-yellow-400 text-white rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-yellow-500 hover:text-white">
                  <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                  </svg>
                  <span class="mt-2 text-base leading-normal">Select a file</span>
                  <input type='file' id="file_answer_option_1" name="file_answer_option_1" hidden>
                </label>
                <span id="file_name_answer_option_1"></span>
              </div>
            </div>
          </div>
          <div id="answer_option">
            <div class="flex flex-wrap -mx-3 mb-1">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  Jawaban Pilihan 2
                </label>
                <input name="answer_option_2" id="answer_option_2" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="textarea" required>
              </div>
            </div>
            <div class="flex items-start items-center mb-6">
              <input id="checkbox" name="checkbox_answer_option_2" aria-describedby="checkbox" type="checkbox" class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded">
              <label for="checkbox" class="text-sm ml-3 font-medium text-gray-900">Kunci Jawaban</label>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                  File Jawaban
                </label>
                <label class="w-64 flex flex-col w-full items-center px-4 py-6 bg-yellow-400 text-white rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-yellow-500 hover:text-white">
                  <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                  </svg>
                  <span class="mt-2 text-base leading-normal">Select a file</span>
                  <input type='file' id="file_answer_option_2" name="file_answer_option_2" hidden>
                </label>
                <span id="file_name_answer_option_2"></span>
              </div>
            </div>
          </div>
          <div id="answer_option">
            <div class="flex flex-wrap -mx-3 mb-1">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  Jawaban Pilihan 3
                </label>
                <input name="answer_option_3" id="answer_option_3" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="textarea" required>
              </div>
            </div>
            <div class="flex items-start items-center mb-6">
              <input id="checkbox" name="checkbox_answer_option_3" aria-describedby="checkbox" type="checkbox" class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded">
              <label for="checkbox" class="text-sm ml-3 font-medium text-gray-900">Kunci Jawaban</label>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                  File Jawaban
                </label>
                <label class="w-64 flex flex-col w-full items-center px-4 py-6 bg-yellow-400 text-white rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-yellow-500 hover:text-white">
                  <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                  </svg>
                  <span class="mt-2 text-base leading-normal">Select a file</span>
                  <input type='file' id="file_answer_option_3" name="file_answer_option_3" hidden>
                </label>
                <span id="file_name_answer_option_3"></span>
              </div>
            </div>
          </div>
          <div id="answer_option">
            <div class="flex flex-wrap -mx-3 mb-1">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  Jawaban Pilihan 4
                </label>
                <input name="answer_option_4" id="answer_option_4" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="textarea" required>
              </div>
            </div>
            <div class="flex items-start items-center mb-6">
              <input id="checkbox" name="checkbox_answer_option_4" aria-describedby="checkbox" type="checkbox" class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded">
              <label for="checkbox" class="text-sm ml-3 font-medium text-gray-900">Kunci Jawaban</label>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                  File Jawaban
                </label>
                <label class="w-64 flex flex-col w-full items-center px-4 py-6 bg-yellow-400 text-white rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-yellow-500 hover:text-white">
                  <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                  </svg>
                  <span class="mt-2 text-base leading-normal">Select a file</span>
                  <input type='file' id="file_answer_option_4" name="file_answer_option_4" hidden>
                </label>
                <span id="file_name_answer_option_4"></span>
              </div>
            </div>
          </div>
          <div id="answer_option">
            <div class="flex flex-wrap -mx-3 mb-1">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                  Jawaban Pilihan 5
                </label>
                <input name="answer_option_5" id="answer_option_5" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="textarea" required>
              </div>
            </div>
            <div class="flex items-start items-center mb-6">
              <input id="checkbox" name="checkbox_answer_option_5" aria-describedby="checkbox" type="checkbox" class="bg-gray-50 border-gray-300 focus:ring-3 focus:ring-blue-300 h-4 w-4 rounded">
              <label for="checkbox" class="text-sm ml-3 font-medium text-gray-900">Kunci Jawaban</label>
            </div>
            <div class="flex flex-wrap -mx-3 mb-6">
              <div class="w-full px-3">
                <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" >
                  File Jawaban
                </label>
                <label class="w-64 flex flex-col w-full items-center px-4 py-6 bg-yellow-400 text-white rounded-lg shadow-lg tracking-wide uppercase border border-blue cursor-pointer hover:bg-yellow-500 hover:text-white">
                  <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                  </svg>
                  <span class="mt-2 text-base leading-normal">Select a file</span>
                  <input type='file' id="file_answer_option_5" name="file_answer_option_5" hidden>
                </label>
                <span id="file_name_answer_option_5"></span>
              </div>
            </div>
          </div>
        </div>
        <div class="md:flex md:items-center">
          <div class="md:w-1/3">
            <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Submit
            </button>
            <button onclick="window.location='{{ url ('/teacher/teaching/show', array("$id")) }}'" class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="button">
              Cancel
            </button>
          </div>
          <div class="md:w-2/3"></div>
        </div>
      </form>
    </div>
  </div>
</div>
<script>
var konten = document.getElementById("question");
CKEDITOR.replace(konten,{
  language:'en-gb'
});
CKEDITOR.config.allowedContent = true;
</script>

<script>
$('#is_multiple_choice').on('change', function () {
  if (this.value === 'TRUE'){
    $("#multiple_choice").show();
  } else {
    $("#multiple_choice").hide();
  }
});
</script>

<script>
let file = document.getElementById('file');
let file_name = document.getElementById('file_name');

file.addEventListener('change', function(){
  if(this.files.length)
  file_name.innerText = this.files[0].name;
  else
  file_name.innerText = '';
});
</script>

<script>
let file_answer_option_1 = document.getElementById('file_answer_option_1');
let file_name_answer_option_1 = document.getElementById('file_name_answer_option_1');

file_answer_option_1.addEventListener('change', function(){
  if(this.files.length)
  file_name_answer_option_1.innerText = this.files[0].name;
  else
  file_name_answer_option_1.innerText = '';
});
</script>

<script>
let file_answer_option_2 = document.getElementById('file_answer_option_2');
let file_name_answer_option_2 = document.getElementById('file_name_answer_option_2');

file_answer_option_2.addEventListener('change', function(){
  if(this.files.length)
  file_name_answer_option_2.innerText = this.files[0].name;
  else
  file_name_answer_option_2.innerText = '';
});
</script>

<script>
let file_answer_option_3 = document.getElementById('file_answer_option_3');
let file_name_answer_option_3 = document.getElementById('file_name_answer_option_3');

file_answer_option_3.addEventListener('change', function(){
  if(this.files.length)
  file_name_answer_option_3.innerText = this.files[0].name;
  else
  file_name_answer_option_3.innerText = '';
});
</script>

<script>
let file_answer_option_4 = document.getElementById('file_answer_option_4');
let file_name_answer_option_4 = document.getElementById('file_name_answer_option_4');

file_answer_option_4.addEventListener('change', function(){
  if(this.files.length)
  file_name_answer_option_4.innerText = this.files[0].name;
  else
  file_name_answer_option_4.innerText = '';
});
</script>

<script>
let file_answer_option_5 = document.getElementById('file_answer_option_5');
let file_name_answer_option_5 = document.getElementById('file_name_answer_option_5');

file_answer_option_5.addEventListener('change', function(){
  if(this.files.length)
  file_name_answer_option_5.innerText = this.files[0].name;
  else
  file_name_answer_option_5.innerText = '';
});
</script>

@endsection
