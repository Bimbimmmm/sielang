@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-blue-200 py-14">
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
                <i class="material-icons-outlined text-base">visibility</i>
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
