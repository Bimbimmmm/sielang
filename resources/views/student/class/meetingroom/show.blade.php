@extends('layouts.student')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/student/class/show/{{$idc}}">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Detail Pertemuan</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Pertemuan</td>
              <td class="px-4 py-3 text-ms border">{{$data->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tanggal Mulai Pertemuan</td>
              <td class="px-4 py-3 text-ms border">{{$data->start_date->formatLocalized("%d-%m-%Y")}}</td>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Tanggal Selesai Pertemuan</td>
                <td class="px-4 py-3 text-ms border">{{$data->expired_date->formatLocalized("%d-%m-%Y")}}</td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Jenis Pertemuan</td>
                <td class="px-4 py-3 text-ms border">
                  <span class="inline-block rounded-full text-white bg-indigo-500 px-2 py-1 text-xs font-bold mr-3">{{$data->meeting_media}}</span>
                </td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Link Pertemuan</td>
                @if($data->link != NULL)
                <td class="px-4 py-3 text-ms border">
                  <a class="text-blue-500 hover:text-blue-700 underline" href="{{$data->link}}" target="_blank">{{$data->link}}</a>
                </td>
                @else
                <td class="px-4 py-3 text-ms border">Tidak Ada Link Pertemuan</td>
                @endif
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Link Materi Pertemuan</td>
                @if($data->subject_material_link != NULL)
                <td class="px-4 py-3 text-ms border">
                  <a class="text-blue-500 hover:text-blue-700 underline" href="{{$data->subject_material_link}}" target="_blank">{{$data->subject_material_link}}</a>
                </td>
                @else
                <td class="px-4 py-3 text-ms border">Tidak Ada Link Materi</td>
                @endif
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">File Materi Pertemuan</td>
                @if($data->file != NULL)
                <td class="px-4 py-3 text-ms border">
                  <a class="text-blue-500 hover:text-blue-400" href="{{ asset('storage/meetingroom/' . $data->file) }}">{{$data->file}}</a>
                </td>
                @else
                <td class="px-4 py-3 text-ms border">Tidak Ada File Instruksi</td>
                @endif
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Status Kehadiran</td>
                <td class="px-4 py-3 text-ms border">
                  @if($check > 0)
                  <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Hadir</span>
                  @else
                  <span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Tidak Hadir</span>
                  @endif
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  @endsection
