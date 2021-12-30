@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/teacher/class/task/show/{{$idts}}/{{$idt}}">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Detail Pengumpulan Tugas</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Siswa</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->studentPersonalData->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tanggal Pengumpulan Tugas</td>
              <td class="px-4 py-3 text-ms border">{{$data->created_at->formatLocalized("%d-%m-%Y %H:%M")}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File Tugas</td>
              <td class="px-4 py-3 text-ms border">
                <a class="text-blue-400 hover:text-blue-500" href="{{ asset('storage/task/collection/' . $data->file) }}">{{$data->file}}</a>
              </td>
            </tr>
            @if($data->is_scored == TRUE)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Skor Tugas</td>
              <td class="px-4 py-3 text-ms border">{{$data->score}}</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
  </div>
  @if($data->is_scored == FALSE)
  <div class="md:flex md:justify-center md:space-x-8 md:px-14 bg-white mt-10">
    <form action="{{ route('teachertaskcolscore', array($data->id, $idts, $idt))}}" method="POST" class="w-full max-w-lg mt-10">
      <h1 class="mb-12 text-center text-2xl text-black font-bold">Form Penilaian</h1>
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
      <div class="flex flex-col -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Nilai Tugas
          </label>
          <input name="score" id="score" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="0" max="100" step=".001" placeholder="Berikan Nilai Dengan Skala 0 -100"required>
        </div>
      </div>
      <div class="md:flex md:items-center mb-10">
        <div class="md:w-1/3">
          <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
            Submit
          </button>
        </div>
        <div class="md:w-2/3"></div>
      </div>
    </form>
  </div>
  @endif
</div>
</div>
@endsection
