<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Rencana Pelaksanaan Pembelajaran {{$get_user->teacherPersonalData->name}}</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/materialicons.css') }}">
  <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
  <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/tailwind.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/alpine.min.js') }}"></script>
  <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script src="{{ asset('js/jquery-3.6.0.js') }}"></script>
  <script src="{{ asset('js/jquery-ui.js') }}"></script>
</head>
<body class="font-roboto">
  <div class="container min-h-full min-w-full">
    <h1 class="mt-3 text-center text-2xl text-black font-bold">RENCANA PELAKSANAAN PEMBELAJARAN</h1>
    <h1 class="mb-5 text-center text-2xl text-black font-bold uppercase">{{$data->type}}</h1>
    <h1 class="mb-5 text-center text-md text-black font-bold">(Sesuai Edaran Kemendikbud No.14 Tahun 2019)</h1>

    <div class="border-2 bg-yellow-200">
      <p class="font-bold uppercase">A. Tujuan Pembelajaran</p>
    </div>
    <div class="border-2 mt-4">
      @foreach($objectives as $objective)
      <p>- {{$objective->objective}}</p>
      @endforeach
    </div>

    <div class="border-2 mt-6 bg-yellow-200">
      <p class="font-bold uppercase">B. Kegiatan Pembelajaran</p>
    </div>
    <table class="w-full mt-6">
      <thead>
        <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
          <td>Media</td>
          <td>Alat/Bahan</td>
          <td>Sumber Belajar</td>
        </tr>
      </thead>
      <tbody class="bg-white border-2 border-black">
        <tr class="text-gray-700 text-center">
          <td>
            @foreach($medias as $media)
            @if($media->type == "Media")
            <p>- {{$media->media}}</p>
            @endif
            @endforeach
          </td>
          <td>
            @foreach($medias as $media)
            @if($media->type == "Alat dan Bahan")
            <p>- {{$media->media}}</p>
            @endif
            @endforeach
          </td>
          <td>
            @foreach($medias as $media)
            @if($media->type == "Sumber Belajar")
            <p>- {{$media->media}}</p>
            @endif
            @endforeach
          </td>
        </tr>
      </tbody>
    </table>
    <table class="w-full mt-3">
      <tbody class="bg-white">
        <tr class="text-gray-700 text-center">
          <td class="px-4 py-3 text-ms border font-semibold uppercase">Pendahuluan</td>
          <td class="px-4 py-3 text-ms border">
            @foreach($activities as $activity)
            @if($activity->type == "Pendahuluan")
            <p>- {{$activity->activity}}</p>
            @endif
            @endforeach
          </td>
        </tr>
        <tr class="text-gray-700 text-center">
          <td class="px-4 py-3 text-ms border font-semibold uppercase">Kegiatan Inti</td>
          <td class="px-4 py-3 text-ms border">
            @foreach($activities as $activity)
            @if($activity->type == "Kegiatan Inti")
            <p>- {{$activity->activity}}</p>
            @endif
            @endforeach
          </td>
        </tr>
        <tr class="text-gray-700 text-center">
          <td class="px-4 py-3 text-ms border font-semibold uppercase">Penutup</td>
          <td class="px-4 py-3 text-ms border">
            @foreach($activities as $activity)
            @if($activity->type == "Penutup")
            <p>- {{$activity->activity}}</p>
            @endif
            @endforeach
          </td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="border-2 mt-6 bg-yellow-200">
    <p class="font-bold uppercase">C. Penilaian (Asesmen)</p>
  </div>
  <div class="border-2 mt-4">
    @foreach($assesments as $assesment)
    <p>- {{$assesment->assesment}}</p>
    @endforeach
  </div>
  <div class="border-2">
    <table class="w-full mt-3">
      <tbody class="bg-white">
        <tr class="text-gray-700 text-center">
          <td class="px-4 py-3 text-ms border">
            <p>Mengetahui,</p>
            <p class="mb-12">Kepala Sekolah</p>
            <p class="underline font-bold">{{$get_principal->teacherPersonalData->name}}</p>
            <p class="font-bold">{{$get_principal->teacherPersonalData->registration_number}}</p>
          </td>
          <td class="px-4 py-3 text-ms border">
            <p>Nunukan, {{$data->updated_at->isoFormat('DD MMMM Y')}}</p>
            <p class="mb-12">Guru Mata Pelajaran</p>
            <p class="underline font-bold">{{$get_user->teacherPersonalData->name}}</p>
            <p class="font-bold">{{$get_user->teacherPersonalData->registration_number}}</p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
