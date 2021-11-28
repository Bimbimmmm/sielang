@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/teacher/teaching/show/{{$idt}}">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Detail Tugas</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Tugas</td>
              <td class="px-4 py-3 text-ms border">{{$data->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Petunjuk Tugas</td>
              <td class="px-4 py-3 text-ms border">{!! $data->task_instructions !!}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tanggal Mulai Tugas</td>
              <td class="px-4 py-3 text-ms border">{{$data->start_date->formatLocalized("%d-%m-%Y")}}</td></tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tanggal Selesai Tugas</td>
              <td class="px-4 py-3 text-ms border">{{$data->expired_date->formatLocalized("%d-%m-%Y")}}</td></tr>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">File Instruksi Tugas</td>
              @if($data->file != NULL)
              <td class="px-4 py-3 text-ms border">
                <a href="{{ asset('storage/task/' . $data->file) }}">{{$data->file}}</a>
              </td>
              @else
              <td class="px-4 py-3 text-ms border">Tidak Ada File Instruksi</td>
              @endif
            </tr>
          </tbody>
        </table>
      </div>
      <div class="w-full overflow-x-auto py-5">
        <table class="w-full">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nama Siswa
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                NISN
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Tanggal Mengumpulkan Tugas
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                File Tugas
              </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($collections as $collection)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$loop->iteration}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$collection->user->studentPersonalData->name}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$collection->user->studentPersonalData->national_student_number}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$collection->created_at->formatLocalized("%d-%m-%Y")}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                <a href="/teacher/performance/activity/delete/{{$activity->id}}" class="text-red-600 hover:text-red-400 ml-2">
                  <i class="material-icons-round">delete_outline</i>
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
