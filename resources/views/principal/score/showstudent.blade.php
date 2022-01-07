@extends('layouts.principal')
@section('content')
<div class="min-h-screen bg-gray-200 py-2">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/principal/studentscore/show/{{$idss}}">
      <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
      </button>
    </a>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <h1 class="mb-12 text-center text-4xl text-black font-bold">Detail Hasil Belajar Siswa</h1>
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">Nama Siswa</th>
              <th class="px-4 py-3">NIS / NISN</th>
              <th class="px-4 py-3">Persentase Kehadiran</th>
              <th class="px-4 py-3">Rerata Nilai Tugas</th>
              <th class="px-4 py-3">Rerata Nilai Kuis</th>
              <th class="px-4 py-3">Rerata Nilai Ujian</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border">{{$student->user->studentPersonalData->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$student->user->studentPersonalData->student_number}} / {{$student->user->studentPersonalData->national_student_number}}</td>
              <td class="px-4 py-3 text-ms border">{{$attendance_score}} % </td>
              <td class="px-4 py-3 text-ms border">{{$total_task_score}}</td>
              <td class="px-4 py-3 text-ms border">{{$total_quiz_score}}</td>
              <td class="px-4 py-3 text-sm border">{{$total_exam_score}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
