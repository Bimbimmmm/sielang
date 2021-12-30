@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/teacher/class/exam/show/{{$idq}}/{{$idt}}">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Detail Pengumpulan Ujian</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Siswa</td>
              <td class="px-4 py-3 text-ms border">{{$data->user->studentPersonalData->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tanggal Pengumpulan Ujian</td>
              <td class="px-4 py-3 text-ms border">{{$data->created_at->formatLocalized("%d-%m-%Y %H:%M")}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nilai Pilihan Ganda</td>
              <td class="px-4 py-3 text-ms border">{{$data->multiple_choice_score}}</td>
            </tr>
            @if($data->is_scored == TRUE)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Skor Ujian</td>
              <td class="px-4 py-3 text-ms border">{{$data->score}}</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
  </div>
  <div class="w-full overflow-x-auto py-5">
    <h1 class="mb-6 text-center text-2xl text-gray-600 font-bold">Jawaban Essai</h1>
    <table class="w-full">
      <thead>
        <tr>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
            No
          </th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
            Jawaban
          </th>
        </tr>
      </thead>
      <tbody class="bg-white">
        @foreach($essais as $essai)
        <tr>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
            <p class="text-gray-900 whitespace-no-wrap">
              {{$loop->iteration}}
            </p>
          </td>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
            <p class="text-gray-900 whitespace-no-wrap">
              {{$essai->user->answer}}
            </p>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @if($data->is_scored == FALSE)
  <div class="md:flex md:justify-center md:space-x-8 md:px-14 bg-white mt-10">
    <form action="{{ route('teacherexamcolscore', array($data->id, $idq, $idt))}}" method="POST" class="w-full max-w-lg mt-10">
      <h1 class="mb-12 text-center text-2xl text-black font-bold">Form Penilaian</h1>
      <div class="container mb-4" id="alertbox">
        <div class="container bg-yellow-500 flex items-center text-white text-sm font-bold px-4 py-3 relative"
        role="alert">
        <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
          <path
          d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
        </svg>
        <p>Jika Tidak Ada Soal Essai, Pilih Persentase 100:0 dan Masukkan Nilai 0 Pada Nilai Essai</p>
      </div>
    </div>
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
            Persentase Penilaian (Pilihan Ganda : Essai)
          </label>
          <select name="percentage" id="percentage" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value=100>100 : 0</option>
            <option value=90>90 : 10</option>
            <option value=80>80 : 20</option>
            <option value=70>70 : 30</option>
            <option value=60>60 : 40</option>
            <option value=50>50 : 50</option>
            <option value=40>40 : 60</option>
            <option value=30>30 : 70</option>
            <option value=20>20 : 80</option>
            <option value=10>10 : 90</option>
          </select>
        </div>
      </div>
      <div class="flex flex-col -mx-3 mb-6">
        <div class="w-full px-3">
          <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
            Nilai Essai Ujian
          </label>
          <input name="essay_score" id="essay_score" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" min="0" max="100" step=".001" placeholder="Berikan Nilai Dengan Skala 0 -100"required>
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
