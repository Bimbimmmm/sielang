@extends('layouts.operator')
@section('content')
<div class="container mx-auto px-4 sm:px-8">
  <div class="py-8">
    <div>
      <h2 class="text-2xl text-center leading-tight">AKUN GURU YANG BELUM DIVERIFIKASI</h2>
    </div>
    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
      <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
        <table class="min-w-full leading-normal">
          <thead>
            <tr>
              <th
              class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Nama
            </th>
            <th
            class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
            NIP
          </th>
          <th
          class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
          Email
        </th>
        <th
        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
        Role
      </th>
      <th
      class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
      Aksi
    </th>
  </tr>
</thead>
<tbody>
  @foreach($datas as $data)
  <tr>
    @if($data->teacher_personal_data_id != null)
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
      <div class="flex items-center">
        <div class="ml-3">
          <p class="text-gray-900 whitespace-no-wrap">
            {{$data->teacherPersonalData->name}}
          </p>
        </div>
      </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
      <div class="flex items-center">
        <div class="ml-3">
          <p class="text-gray-900 whitespace-no-wrap">
            {{$data->teacherPersonalData->registration_number}}
          </p>
        </div>
      </div>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
      <div class="flex items-center">
        <div class="ml-3">
          <p class="text-gray-900 whitespace-no-wrap">
            {{$data->teacherPersonalData->school->name}}
          </p>
        </div>
      </div>
    </td>
    @else
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center" colspan="2">
      <p class="text-gray-900 whitespace-no-wrap">
        <span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Belum Mengisi Data Diri</span>
      </p>
    </td>
    @endif
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
      <p class="text-gray-900 whitespace-no-wrap">
        {{$data->email}}
      </p>
    </td>
    <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
      <a href="{{ url ('/operator/users/teacherverif', array("$data->id")) }}" class="text-green-600 hover:text-green-400 mr-2">
        <i class="material-icons-outlined">check</i>
      </a>
      <a href="#" class="text-red-600 hover:text-red-400    ml-2">
        <i class="material-icons-round">delete_outline</i>
      </a>
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
</div>
@endsection
