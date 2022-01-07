@extends('layouts.admin')
@section('content')
<div class="container mx-auto px-4 sm:px-8">
  <div class="py-8">
    <div>
      <h2 class="text-2xl text-center leading-tight">Detail Rencana Pelaksanaan Pembelajaran {{$data->teachingHour->subject->name}}</h2>
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
      <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
        <h2 class="text-xl text-center leading-tight">Tujuan</h2>
        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                No
              </th>
              <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                Tujuan
              </th>
            </tr>
          </thead>
          <tbody>
            @foreach($objectives as $objective)
            <tr>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$loop->iteration}}
                </p>
              </td>
              <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                <p class="text-gray-900 whitespace-no-wrap">
                  {{$objective->objective}}
                </p>
              </td>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
    <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
      <h2 class="text-xl text-center leading-tight">Media</h2>
      <table class="min-w-full leading-normal">
        <thead>
          <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
              No
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Media
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Tipe
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach($medias as $media)
          <tr>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
              <p class="text-gray-900 whitespace-no-wrap">
                {{$loop->iteration}}
              </p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
              <p class="text-gray-900 whitespace-no-wrap">
                {{$media->media}}
              </p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
              <p class="text-gray-900 whitespace-no-wrap">
                {{$media->type}}
              </p>
            </td>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
  <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
    <h2 class="text-xl text-center leading-tight">Kegiatan</h2>
    <table class="min-w-full leading-normal">
      <thead>
        <tr>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
            No
          </th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
            Kegiatan
          </th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
            Tipe
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($activities as $activity)
        <tr>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
            <p class="text-gray-900 whitespace-no-wrap">
              {{$loop->iteration}}
            </p>
          </td>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
            <p class="text-gray-900 whitespace-no-wrap">
              {{$activity->activity}}
            </p>
          </td>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
            <p class="text-gray-900 whitespace-no-wrap">
              {{$activity->type}}
            </p>
          </td>
        </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
  <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
    <h2 class="text-xl text-center leading-tight">Penilaian</h2>
    <table class="min-w-full leading-normal">
      <thead>
        <tr>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
            No
          </th>
          <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
            Penilaian
          </th>
        </tr>
      </thead>
      <tbody>
        @foreach($assesments as $assesment)
        <tr>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
            <p class="text-gray-900 whitespace-no-wrap">
              {{$loop->iteration}}
            </p>
          </td>
          <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
            <p class="text-gray-900 whitespace-no-wrap">
              {{$assesment->assesment}}
            </p>
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
