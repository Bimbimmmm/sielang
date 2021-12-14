@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/teacher/class/meetingroom/show/{{$idm}}/{{$idc}}">
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
          </tbody>
        </table>
      </div>

      <div class="w-full overflow-x-auto py-5">
        <h1 class="mb-6 text-center text-2xl text-gray-600 font-bold">Daftar Hadir Pertemuan</h1>
        <table class="w-full">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nama
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Status
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($attendances as $attendance)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$loop->iteration}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$attendance->user->studentPersonalData->name}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  @if($attendance->is_attend == FALSE)
                  <span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Tidak Hadir</span>
                  @elseif($attendance->is_attend == TRUE)
                  <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Hadir</span>
                  @endif
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  @if($attendance->is_attend == TRUE)
                  <form action="{{ route('teachermrabsentstore', $attendance->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-400 mr-2">
                      <i class="material-icons">cancel</i>
                    </button>
                  </form>
                  @else($attendance->is_attend == FALSE)
                  <form action="{{ route('teachermrattendstore', $attendance->id)}}" method="POST">
                    @csrf
                    <button type="submit" class="text-green-600 hover:text-green-400 mr-2">
                      <i class="material-icons">check</i>
                    </button>
                  </form>
                  @endif
                </p>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="flex items-center justify-center mt-10">
          <div class="w-full max-w-md mr-4">
            <form action="{{ route('teachermrattlockstore', array("$data->id", "$idm", "$idc"))}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-red-500">
              @csrf
              <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
                Selesaikan Absen
              </div>
              <div class="mb-6 text-center">
                <label class="block text-gray-700 text-sm font-normal mb-2" for="password">
                  Jika Absen Sudah Diselesaikan, Perubahan Sudah Tidak Dapat Dilakukan
                </label>
              </div>
              <div class="flex items-center justify-center">
                <button class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                  Selesai
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
