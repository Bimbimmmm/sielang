@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-200 py-2">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/teacher/teaching">
      <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
      </button>
    </a>
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Data Mata Pelajaran Saya</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Mata Pelajaran</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->subject->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Kelas</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->classmodel->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Status Mata Pelajaran</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">
                @if($data->subject->is_compulsory == TRUE)
                <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Wajib</span>
                @else
                <span class="inline-block rounded-full text-white bg-gray-500 px-2 py-1 text-xs font-bold mr-3">Peminatan</span>
                @endif
              </td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tahun Semester</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->year}} - {{$data->semester_period}}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="w-full overflow-x-auto mt-10">
        <div class="w-56">
          <div class="my-2 flex sm:flex-row flex-col">
            <div class="block relative">
              <a class="text-white" href="/teacher/class/meetingroom/create/{{$data->id}}">
                <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  <div>
                    <p class=" text-xs font-bold ml-2 ">
                      JADWALKAN PERTEMUAN
                    </p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3" colspan="8">Jadwal Pertemuan Kelas</th>
            </tr>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">No</th>
              <th class="px-4 py-3">Nama Pertemuan</th>
              <th class="px-4 py-3">Tanggal Pertemuan</th>
              <th class="px-4 py-3">Tanggal Akhir Pertemuan</th>
              <th class="px-4 py-3">Media Pertemuan</th>
              <th class="px-4 py-3">Link Pertemuan</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($meetings as $meeting)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
              <td class="px-4 py-3 text-ms border">{{$meeting->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$meeting->start_date}}</td>
              <td class="px-4 py-3 text-ms border">{{$meeting->expired_date}}</td>
              <td class="px-4 py-3 text-ms border">{{$meeting->meeting_media}}</td>
              <td class="px-4 py-3 text-ms border">
                <a class="text-blue-500 hover:text-blue-700 underline" href="{{$meeting->link}}" target="_blank">{{$meeting->link}}</a>
              </td>
              <td class="px-4 py-3 text-ms border">
                @if($meeting->is_active == TRUE)
                <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Aktif</span>
                @else
                <span class="inline-block rounded-full text-white bg-gray-500 px-2 py-1 text-xs font-bold mr-3">Tidak Aktif</span>
                @endif
              </td>
              <td class="px-4 py-3 text-ms border">
                <a href="/teacher/class/meetingroom/show/{{$meeting->id}}/{{$id}}" class="text-green-600 hover:text-green-400 mr-2">
                  <i class="material-icons-outlined">visibility</i>
                </a>
                <a href="{{ url ('/teacher/class/meetingroom/delete', array("$meeting->id")) }}" class="text-red-600 hover:text-red-400    ml-2">
                  <i class="material-icons-round">delete_outline</i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="w-full overflow-x-auto mt-10">
        <div class="w-56">
          <div class="my-2 flex sm:flex-row flex-col">
            <div class="block relative">
              <a class="text-white" href="/teacher/class/task/create/{{$data->id}}">
                <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  <div>
                    <p class=" text-xs font-bold ml-2 ">
                      BUAT TUGAS
                    </p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3" colspan="4">Tugas</th>
            </tr>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">Nama Tugas</th>
              <th class="px-4 py-3">Tanggal Akhir Tugas</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($tasks as $task)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">{{$task->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$task->expired_date->formatLocalized("%d/%m/%Y")}}</td>
              <td class="px-4 py-3 text-ms border">
                @if($task->is_active == TRUE)
                <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Aktif</span>
                @else
                <span class="inline-block rounded-full text-white bg-gray-500 px-2 py-1 text-xs font-bold mr-3">Tidak Aktif</span>
                @endif
              </td>
              <td class="px-4 py-3 text-ms border">
                <a href="/teacher/class/task/show/{{$task->id}}/{{$id}}" class="text-green-600 hover:text-green-400 mr-2">
                  <i class="material-icons-outlined">visibility</i>
                </a>
                <a href="{{ url ('/teacher/class/task/delete', array("$task->id")) }}" class="text-red-600 hover:text-red-400    ml-2">
                  <i class="material-icons-round">delete_outline</i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="w-full overflow-x-auto mt-10">
        <div class="w-56">
          <div class="my-2 flex sm:flex-row flex-col">
            <div class="block relative">
              <a class="text-white" href="/teacher/class/quiz/create/{{$data->id}}">
                <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  <div>
                    <p class=" text-xs font-bold ml-2 ">
                      BUAT QUIZ
                    </p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3" colspan="5">Kuis</th>
            </tr>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">Nama Kuis</th>
              <th class="px-4 py-3">Tanggal Mulai Kuis</th>
              <th class="px-4 py-3">Tanggal Akhir Kuis</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($quizs as $quiz)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">{{$quiz->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$quiz->start_date->formatLocalized("%d/%m/%Y")}}</td>
              <td class="px-4 py-3 text-ms border">{{$quiz->expired_date->formatLocalized("%d/%m/%Y")}}</td>
              <td class="px-4 py-3 text-ms border">
                @if($quiz->is_locked == FALSE)
                <span class="inline-block rounded-full text-white bg-gray-500 px-2 py-1 text-xs font-bold mr-3">Bekun Dikunci</span>
                @elseif($quiz->is_locked == TRUE && $quiz->is_active == TRUE)
                <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Aktif</span>
                @elseif($quiz->is_locked == TRUE && $quiz->is_active == FALSE)
                <span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Tidak Aktif</span>
                @endif
              </td>
              <td class="px-4 py-3 text-ms border">
                <a href="/teacher/class/quiz/show/{{$quiz->id}}/{{$id}}" class="text-green-600 hover:text-green-400 mr-2">
                  <i class="material-icons-outlined">visibility</i>
                </a>
                <a href="{{ url ('/teacher/class/quiz/delete', array("$quiz->id")) }}" class="text-red-600 hover:text-red-400    ml-2">
                  <i class="material-icons-round">delete_outline</i>
                </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="w-full overflow-x-auto mt-10">
        <div class="w-56">
          <div class="my-2 flex sm:flex-row flex-col">
            <div class="block relative">
                <a class="text-white" href="/teacher/class/exam/create/{{$data->id}}">
                <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  <div>
                    <p class=" text-xs font-bold ml-2 ">
                      BUAT UJIAN
                    </p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
        <table class="w-full">
          <thead>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3" colspan="7">UJIAN</th>
            </tr>
            <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
              <th class="px-4 py-3">Nama Ujian</th>
              <th class="px-4 py-3">Tanggal Ujian</th>
              <th class="px-4 py-3">Tanggal Akhir Ujian</th>
              <th class="px-4 py-3">Status</th>
              <th class="px-4 py-3">Aksi</th>
            </tr>
          </thead>
          <tbody class="bg-white">
            @foreach($exams as $exam)
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">{{$exam->name}}</td>
              <td class="px-4 py-3 text-ms border">{{$exam->start_date->formatLocalized("%d/%m/%Y")}}</td>
              <td class="px-4 py-3 text-ms border">{{$exam->expired_date->formatLocalized("%d/%m/%Y")}}</td>
              <td class="px-4 py-3 text-ms border">
                @if($exam->is_locked == FALSE)
                <span class="inline-block rounded-full text-white bg-gray-500 px-2 py-1 text-xs font-bold mr-3">Bekun Dikunci</span>
                @elseif($exam->is_locked == TRUE && $exam->is_active == TRUE)
                <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Aktif</span>
                @elseif($exam->is_locked == TRUE && $exam->is_active == FALSE)
                <span class="inline-block rounded-full text-white bg-red-500 px-2 py-1 text-xs font-bold mr-3">Tidak Aktif</span>
                @endif
              </td>
              <td class="px-4 py-3 text-ms border">
                <a href="/teacher/class/exam/show/{{$exam->id}}/{{$id}}" class="text-green-600 hover:text-green-400 mr-2">
                  <i class="material-icons-outlined">visibility</i>
                </a>
                <a href="{{ url ('/teacher/class/exam/delete', array("$exam->id")) }}" class="text-red-600 hover:text-red-400    ml-2">
                  <i class="material-icons-round">delete_outline</i>
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
</div>
@endsection
