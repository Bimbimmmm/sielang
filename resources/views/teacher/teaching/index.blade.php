@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-blue-200 py-2">
  <a href="/teacher">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Jam Mengajar Saya</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
    <div class="w-full overflow-x-auto">
      <table class="w-full">
        <thead>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Nama Mata Pelajaran</th>
            <th class="px-4 py-3">Nama Kelas</th>
            <th class="px-4 py-3">Tahun dan Periode Semester</th>
            <th class="px-4 py-3">Jumlah Jam</th>
            <th class="px-4 py-3">Status</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($datas as $data)
          <tr class="text-gray-700 text-center">
            <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
            <td class="px-4 py-3 text-ms border">{{$data->subject->name}}</td>
            <td class="px-4 py-3 text-sm border">{{$data->classmodel->name}}</td>
            <td class="px-4 py-3 text-sm border">{{$data->year}} - {{$data->semester_period}}</td>
            <td class="px-4 py-3 text-sm border">{{$data->hour}} Jam / Minggu</td>
            <td class="px-4 py-3 text-sm border">
              @if($data->is_active == TRUE)
              <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Aktif</span>
              @else
              <span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Tidak Aktif</span>
              @endif
            </td>
            <td class="px-4 py-3 text-sm border">
              <a href="{{ url ('/teacher/teaching/show', array("$data->id")) }}" class="text-green-600 hover:text-green-400 mr-2">
                <i class="material-icons-outlined">visibility</i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>
@endsection
