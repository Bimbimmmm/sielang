@extends('layouts.student')
@section('content')
<div class="min-h-screen bg-gray-200 py-3">
  <h1 class="mb-12 text-center text-3xl text-gray-700 font-bold">{{$check->name}}</h1>
  <div class="max-h-screen grid grid-rows-3 grid-flow-col gap-4">
    <div class="row-span-3">
      <div class="border-b-2 block md:flex">
        <div class="w-full md:w-3/5 p-8 bg-white lg:ml-4 shadow-md">
          <p class="text-center text-xl text-red-400" id="demo"></p>
          <label for="name" class="font-semibold text-center text-gray-700 block pb-6">Nomor Soal</label>
          <div class="grid grid-cols-4 gap-4 mb-6">
            @foreach($questions as $question)
            <a href="/student/class/quiz/work/{{$id}}/{{$idc}}/{{$idcol}}/{{$question->id}}">
              @if($question->answer == null)
              <div class="border-2 bg-red-600 text-center text-white">{{$loop->iteration}}</div>
              @else
              <div class="border-2 bg-green-600 text-center text-white">{{$loop->iteration}}</div>
              @endif
            </a>
            @endforeach
          </div>
          <div class="text-center">
            <button onclick="window.location='{{ url ('/student/class/quiz/work', array( $id, $idc )) }}'" class="shadow bg-yellow-600 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Selesai
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-span-2">
      <div class="row-span-3">
        <div class="border-b-2 block md:flex">
          <div class="w-full md:w-3/5 p-8 bg-white lg:ml-2 mr-3 shadow-md">
            <div id="countdown">
            <label for="name" class="font-semibold text-center text-gray-700 block">Pertanyaan</label>
            <p class="mb-2">
              {!! $ques->meetingQuizQuestion->question !!}
            </p>
          </br>
            @foreach($choices as $choice)
            <input type="radio" id="answer" name="answer" value="{{$choice->choice}}">
            <label for="answer">{{$choice->choice}}</label><br><br>
            @endforeach
            <button onclick="window.location='{{ url ('/student/class/quiz/work', array( $id, $idc )) }}'" class="shadow bg-green-600 hover:bg-green-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Simpan dan Lanjutkan
            </button>
            <button onclick="window.location='{{ url ('/student/class/quiz/work', array( $id, $idc )) }}'" class="shadow bg-red-600 hover:bg-red-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Lewati
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
// Set the date we're counting down to
var countDownDate = new Date("{{$work_time}}").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = hours + " Jam "
  + minutes + " Menit " + seconds + " Detik ";

  // If the count down is over, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "WAKTU HABIS";
  }
}, 1000);
</script>
@endsection
