<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Hasil Pembelajaran {{$data->teachingHour->subject->name}} Pada {{$data->teachingHour->classmodel->name}} {{$data->teachingHour->semester_period}} - {{$data->teachingHour->year}} : {{$data->teachingHour->user->teacherPersonalData->name}}</title>
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
    <h1 class="mt-3 text-center text-2xl text-black font-bold uppercase">HASIL PEMBELAJARAN MATA PELAJARAN {{$data->teachingHour->subject->name}}</h1>
    <h1 class="mb-5 text-center text-2xl text-black font-bold uppercase">{{$data->teachingHour->classmodel->name}} {{$data->teachingHour->semester_period}} - {{$data->teachingHour->year}}</h1>
    <h1 class="mb-5 text-center text-md text-black font-bold">Guru Pengampu : {{$data->teachingHour->user->teacherPersonalData->name}} - {{$data->teachingHour->classmodel->school->name}}</h1>

    <table class="w-full mt-6">
      <thead>
        <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
          <td>No</td>
          <td>Nama Siswa</td>
          <td>NIS / NISN</td>
          <td>Persentase Kehadiran</td>
          <td>Rerata Nilai Tugas</td>
          <td>Rerata Nilai Kuis</td>
          <td>Rerata Nilai Ujian</td>
        </tr>
      </thead>
      <tbody class="bg-white border-2 border-black">
        @foreach($details as $detail)
        <tr class="text-gray-700 text-center">
          <td>{{$loop->iteration}}</td>
          <td>{{$detail->user->studentPersonalData->name}}</td>
          <td>{{$detail->user->studentPersonalData->student_number}} / {{$detail->user->studentPersonalData->national_student_number}}</td>
          <td>{{$detail->attendance}} %</td>
          <td>{{$detail->task}}</td>
          <td>{{$detail->quiz}}</td>
          <td>{{$detail->exam}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>

</div>
</body>
</html>
