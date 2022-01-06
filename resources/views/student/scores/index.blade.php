@extends('layouts.student')
@section('content')
<div class="min-h-screen bg-gray-200 py-2">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/student">
      <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
      </button>
    </a>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <h1 class="mb-2 mt-2 text-center text-2xl text-black font-bold">Nilai Tugas</h1>
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Nama Semester</th>
              <th class="px-4 py-3">Nama Mata Pelajaran</th>
              <th class="px-4 py-3">Nama Tugas</th>
              <th class="px-4 py-3">Nama Guru Pengampu</th>
              <th class="px-4 py-3">Nilai Tugas</th>
              <th class="px-4 py-3">Waktu Penilaian</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($tasks as $task)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
              <td class="px-4 py-3 text-ms border">{{$task->meetingTask->teachingHour->semester_period}} - {{$task->meetingTask->teachingHour->year}}</td>
              <td class="px-4 py-3 text-ms border">{{$task->meetingTask->teachingHour->subject->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$task->meetingTask->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$task->meetingTask->teachingHour->user->teacherPersonalData->name}}</td>
              <td class="px-4 py-3 text-sm border">{{$task->score}}</td>
              <td class="px-4 py-3 text-sm border">{{$task->updated_at}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <h1 class="mb-2 mt-2 text-center text-2xl text-black font-bold">Nilai Kuis</h1>
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Nama Semester</th>
              <th class="px-4 py-3">Nama Mata Pelajaran</th>
              <th class="px-4 py-3">Nama Kuis</th>
              <th class="px-4 py-3">Nama Guru Pengampu</th>
              <th class="px-4 py-3">Nilai Kuis</th>
              <th class="px-4 py-3">Waktu Penilaian</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($quizs as $quiz)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
              <td class="px-4 py-3 text-ms border">{{$quiz->meetingQuiz->teachingHour->semester_period}} - {{$quiz->meetingQuiz->teachingHour->year}}</td>
              <td class="px-4 py-3 text-ms border">{{$quiz->meetingQuiz->teachingHour->subject->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$quiz->meetingQuiz->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$quiz->meetingQuiz->teachingHour->user->teacherPersonalData->name}}</td>
              <td class="px-4 py-3 text-sm border">{{$quiz->total_score}}</td>
              <td class="px-4 py-3 text-sm border">{{$quiz->updated_at}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <h1 class="mb-2 mt-2 text-center text-2xl text-black font-bold">Nilai Ujian</h1>
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Nama Semester</th>
              <th class="px-4 py-3">Nama Mata Pelajaran</th>
              <th class="px-4 py-3">Nama Ujian</th>
              <th class="px-4 py-3">Nama Guru Pengampu</th>
              <th class="px-4 py-3">Nilai Ujian</th>
              <th class="px-4 py-3">Waktu Penilaian</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($exams as $exam)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
              <td class="px-4 py-3 text-ms border">{{$exam->meetingExam->teachingHour->semester_period}} - {{$exam->meetingExam->teachingHour->year}}</td>
              <td class="px-4 py-3 text-ms border">{{$exam->meetingExam->teachingHour->subject->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$exam->meetingExam->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$exam->meetingExam->teachingHour->user->teacherPersonalData->name}}</td>
              <td class="px-4 py-3 text-sm border">{{$exam->total_score}}</td>
              <td class="px-4 py-3 text-sm border">{{$exam->updated_at}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
