@extends('layouts.student')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <a href="/student/class/show/{{$idc}}">
    <button class="block text-green-500 rounded-sm font-bold py-4 px-6 mr-2 flex items-center hover:bg-green-500 hover:text-white">
      <svg class="h-5 w-5 mr-2 fill-current" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="-49 141 512 512" style="enable-background:new -49 141 512 512;" xml:space="preserve">
        <path id="XMLID_10_" d="M438,372H36.355l72.822-72.822c9.763-9.763,9.763-25.592,0-35.355c-9.763-9.764-25.593-9.762-35.355,0 l-115.5,115.5C-46.366,384.01-49,390.369-49,397s2.634,12.989,7.322,17.678l115.5,115.5c9.763,9.762,25.593,9.763,35.355,0 c9.763-9.763,9.763-25.592,0-35.355L36.355,422H438c13.808,0,25-11.193,25-25S451.808,372,438,372z"></path>
      </svg>
    </button>
  </a>
  <div class="px-5 mx-auto max-w-7x1">
    <h1 class="mb-12 text-center text-4xl text-black font-bold">Detail Kuis</h1>
    <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
      <div class="w-full overflow-x-auto">
        <table class="w-full">
          <tbody class="bg-white">
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Nama Kuis</td>
              <td class="px-4 py-3 text-ms border">{{$data->name}}</td>
            </tr>
            <tr class="text-gray-700 text-center">
              <td class="px-4 py-3 text-ms border font-semibold">Tanggal Mulai Kuis</td>
              <td class="px-4 py-3 text-ms border">{{$data->start_date->formatLocalized("%d-%m-%Y")}}</td></tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Tanggal Selesai Kuis</td>
                <td class="px-4 py-3 text-ms border">{{$data->expired_date->formatLocalized("%d-%m-%Y")}}</td></tr>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">File Instruksi Kuis</td>
                @if($data->file != NULL)
                <td class="px-4 py-3 text-ms border">
                  <a class="text-blue-500 hover:text-blue-400" href="{{ asset('storage/quiz/' . $data->file) }}">{{$data->file}}</a>
                </td>
                @else
                <td class="px-4 py-3 text-ms border">Tidak Ada File Instruksi</td>
                @endif
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @if($collection == NULL)
    <div class="px-5 mx-auto max-w-7x1">
      <h1 class="mb-12 text-center text-2xl text-black font-bold">Pengerjaan Kuis</h1>
      <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
          <table class="w-full">
            <tbody class="bg-white">
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">
                  <div class="flex bg-yellow-100 rounded-lg p-4 mb-4 text-sm text-yellow-700" role="alert">
                    <svg class="w-5 h-5 inline mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <div>
                      <span class="font-medium">Peringatan!</span> Pengerjaan Kuis Hanya Dapat Dilakukan 1 (Satu) Kali! Sangat Disarankan Mengerjakan Kuis Menggunakan Perangkat Komputer / Laptop
                    </div>
                  </div>
                </td>
              </tr>
              <tr class="text-gray-700 text-center">
                <form action="{{ route('studentclasstaskstartwork', array($id, $idc))}}" method="POST">
                  @csrf
                <td class="px-4 py-3 text-ms border font-semibold" colspan="2">
                  <button type="submit" class="shadow bg-yellow-600 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded">
                    Kerjakan Kuis
                  </button>
                </td>
              </form>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @else
    <div class="px-5 mx-auto max-w-7x1">
      <h1 class="mb-12 text-center text-2xl text-black font-bold">Detail Kuis Yang Dikerjakan</h1>
      <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
        <div class="w-full overflow-x-auto">
          <table class="w-full">
            <tbody class="bg-white">
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Tanggal Pengerjaan Kuis</td>
                <td class="px-4 py-3 text-ms border">{{$collection->created_at}}</td>
              </tr>
              <tr class="text-gray-700 text-center">
                <td class="px-4 py-3 text-ms border font-semibold">Skor</td>
                @if($collection->is_scored == TRUE)
                <td class="px-4 py-3 text-ms border">{{$collection->score}}</td>
                @else
                <td class="px-4 py-3 text-ms border">Kuis Belum Dinilai</td>
                @endif
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
  </div>
  <script>
  let file = document.getElementById('file');
  let file_name = document.getElementById('file_name');

  file.addEventListener('change', function(){
    if(this.files.length)
    file_name.innerText = this.files[0].name;
    else
    file_name.innerText = '';
  });
</script>
@endsection
