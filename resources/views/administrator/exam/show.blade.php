@extends('layouts.admin')
@section('content')
<div class="container mx-auto px-4 sm:px-8">
  <div class="py-8">
    <div>
      <h2 class="text-2xl text-center leading-tight">Detail Ujian Mata Pelajaran {{$detail->teachingHour->subject->name}}</h2>
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
      <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nama Siswa
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Status
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Nilai Akhir
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Tanggal Pengumpulan
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($datas as $data)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$loop->iteration}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$data->user->studentPersonalData->name}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center text-center">
                @if($data->is_scored == TRUE)
                <p class="text-gray-900 whitespace-no-wrap">
                  <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Sudah Dinilai</span>
                </p>
                @else
                <p class="text-gray-900 whitespace-no-wrap">
                  <span class="inline-block rounded-full text-white bg-yellow-500 px-2 py-1 text-xs font-bold mr-3">Belum Dinilai</span>
                </p>
                @endif
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                  <p class="text-gray-900 whitespace-no-wrap">
                    {{$data->total_score}}
                  </p>
                </td>
                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                  <p class="text-gray-900 whitespace-no-wrap">
                    {{$data->created_at}}
                  </p>
                </td>
              </td>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
@endsection
