@extends('layouts.teacher')
@section('content')
<div class="min-h-screen bg-gray-200 py-2">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/teacher/lessonplan">
      <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
        <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
          <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
        </svg>
      </button>
    </a>
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Data RPP Saya</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Mata Pelajaran</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->teachingHour->subject->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Kelas</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->teachingHour->classmodel->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Status Mata Pelajaran</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">
                @if($data->teachingHour->subject->is_compulsory == TRUE)
                <span class="inline-block rounded-full text-white bg-green-500 px-2 py-1 text-xs font-bold mr-3">Wajib</span>
                @else
                <span class="inline-block rounded-full text-white bg-gray-500 px-2 py-1 text-xs font-bold mr-3">Peminatan</span>
                @endif
              </td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tahun Semester</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->teachingHour->year}} - {{$data->teachingHour->semester_period}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tipe Pembelajaran</td>
              <td class="px-4 py-3 text-ms border font-semibold">:</td>
              <td class="px-4 py-3 text-ms border">{{$data->type}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="w-full overflow-x-auto mt-10">
      @if($data->is_active == FALSE)
      <div class="w-56">
        <div class="my-2 flex sm:flex-row flex-col">
          <div class="block relative">
            <a class="text-white" href="/teacher/lessonplan/objective/create/{{$data->id}}">
              <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                  <p class=" text-xs font-bold ml-2 ">
                    TAMBAH TUJUAN
                  </p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      @endif
      <table class="w-full">
        <thead>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3" colspan="8">Tujuan Pembelajaran</th>
          </tr>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Tujuan</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($objectives as $objective)
          <tr class="text-gray-700 text-center">
            <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
            <td class="px-4 py-3 text-ms border">{{$objective->objective}}</td>
            <td class="px-4 py-3 text-ms border">
              @if($objective->is_active == FALSE)
              <a href="{{ url ('/teacher/lessonplan/objective/destroy', array("$objective->id")) }}" class="text-red-600 hover:text-red-400 ml-2">
                <i class="material-icons-round">delete_outline</i>
              </a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="w-full overflow-x-auto mt-10">
      @if($data->is_active == FALSE)
      <div class="w-56">
        <div class="my-2 flex sm:flex-row flex-col">
          <div class="block relative">
            <a class="text-white" href="/teacher/lessonplan/media/create/{{$data->id}}">
              <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                  <p class=" text-xs font-bold ml-2 ">
                    TAMBAH MEDIA
                  </p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      @endif
      <table class="w-full">
        <thead>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3" colspan="8">Media Pembelajaran</th>
          </tr>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Media</th>
            <th class="px-4 py-3">Tipe</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($medias as $media)
          <tr class="text-gray-700 text-center">
            <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
            <td class="px-4 py-3 text-ms border">{{$media->media}}</td>
            <td class="px-4 py-3 text-ms border">{{$media->type}}</td>
            <td class="px-4 py-3 text-ms border">
              @if($media->is_active == FALSE)
              <a href="{{ url ('/teacher/lessonplan/media/destroy', array("$media->id")) }}" class="text-red-600 hover:text-red-400 ml-2">
                <i class="material-icons-round">delete_outline</i>
              </a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="w-full overflow-x-auto mt-10">
      @if($data->is_active == FALSE)
      <div class="w-56">
        <div class="my-2 flex sm:flex-row flex-col">
          <div class="block relative">
            <a class="text-white" href="/teacher/lessonplan/activity/create/{{$data->id}}">
              <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                  <p class=" text-xs font-bold ml-2 ">
                    TAMBAH KEGIATAN
                  </p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      @endif
      <table class="w-full">
        <thead>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3" colspan="8">Kegiatan Pembelajaran</th>
          </tr>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Kegiatan</th>
            <th class="px-4 py-3">Tipe</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($activities as $activity)
          <tr class="text-gray-700 text-center">
            <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
            <td class="px-4 py-3 text-ms border">{{$activity->activity}}</td>
            <td class="px-4 py-3 text-ms border">{{$activity->type}}</td>
            <td class="px-4 py-3 text-ms border">
              @if($activity->is_active == FALSE)
              <a href="{{ url ('/teacher/lessonplan/activity/destroy', array("$activity->id")) }}" class="text-red-600 hover:text-red-400 ml-2">
                <i class="material-icons-round">delete_outline</i>
              </a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="w-full overflow-x-auto mt-10">
      @if($data->is_active == FALSE)
      <div class="w-56">
        <div class="my-2 flex sm:flex-row flex-col">
          <div class="block relative">
            <a class="text-white" href="/teacher/lessonplan/assesment/create/{{$data->id}}">
              <div class="flex items-center p-4 bg-green-500 rounded-lg shadow-xs cursor-pointer hover:bg-green-400 hover:text-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                <div>
                  <p class=" text-xs font-bold ml-2 ">
                    TAMBAH PENILAIAN
                  </p>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
      @endif
      <table class="w-full">
        <thead>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3" colspan="8">Penilaian</th>
          </tr>
          <tr class="text-md text-center font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
            <th class="px-4 py-3">No</th>
            <th class="px-4 py-3">Penilaian</th>
            <th class="px-4 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white">
          @foreach($assesments as $assesment)
          <tr class="text-gray-700 text-center">
            <td class="px-4 py-3 text-ms border font-semibold">{{$loop->iteration}}</td>
            <td class="px-4 py-3 text-ms border">{{$assesment->assesment}}</td>
            <td class="px-4 py-3 text-ms border">
              @if($assesment->is_active == FALSE)
              <a href="{{ url ('/teacher/lessonplan/assesment/destroy', array("$assesment->id")) }}" class="text-red-600 hover:text-red-400 ml-2">
                <i class="material-icons-round">delete_outline</i>
              </a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  @if($data->is_active == FALSE)
  <div class="flex items-center justify-center mt-10">
    <div class="w-full max-w-md mr-4">
      <form action="{{ route('teacherteachinginactive', array("$data->id"))}}" method="POST" class="bg-white shadow-lg rounded px-12 pt-6 pb-8 mb-4 border-2 border-red-500">
        @csrf
        <div class="text-gray-800 text-2xl flex justify-center border-b-2 py-2 mb-4">
          KUNCI RPP
        </div>
        <div class="container" id="alertbox">
          <div class="container bg-yellow-500 flex items-center text-white text-sm font-bold px-4 py-3 relative"
          role="alert">
          <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
            <path
            d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
          </svg>
          <p>Jika RPP Telah Dikunci, Perubahan Sudah Tidak Dapat Dilakukan</p>
        </div>
      </div>
      <div class="flex items-center justify-center mt-6">
        <button class="shadow bg-red-600 hover:bg-red-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
          Kunci
        </button>
      </div>
    </form>
  </div>
  </div>
  @endif
</div>
</div>
@endsection
