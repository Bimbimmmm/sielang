@extends('layouts.parents')
@section('content')
<div class="min-h-screen bg-gray-200 py-2">
  <div class="px-5 mx-auto max-w-7x1">
    <a href="/parents">
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

    <section class="py-1 bg-blueGray-50">
      <div class="w-full lg:w-8/12 px-4 mx-auto mt-6">
        <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blueGray-100 border-0">
          <div class="rounded-t bg-white mb-0 px-6 py-6">
            <div class="text-center flex justify-between">
              <h6 class="text-blueGray-700 text-xl font-bold">
                Statistik Nilai Keluar
              </h6>
            </div>
          </div>
          <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
              Nilai Rata-Rata Pelajaran
            </h6>
            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12 px-4">
                <div class="md:flex md:justify-center md:space-x-8 md:px-14">
                  <div id="course" style="width: 600px;height:400px;"></div>
                </div>
              </div>
            </div>
            <hr class="mt-6 border-b-1 border-blueGray-300">
            <h6 class="text-blueGray-400 text-sm mt-3 mb-6 font-bold uppercase">
              Presentasi Kehadiran
            </h6>
            <div class="flex flex-wrap">
              <div class="w-full lg:w-12/12 px-4">
                <div class="md:flex md:justify-center md:space-x-8 md:px-14">
                  <div id="present" style="width: 600px;height:400px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
</div>
<script type="text/javascript">
var myChart = echarts.init(document.getElementById('course'));

var option = {
  legend: {
    data: ['Nilai Rata-Rata'],
    orient: 'vertical',
    x: 'right',
  },
  tooltip: {
    trigger: 'item'
  },
  areaStyle: {},
  radar: {

    indicator: [
      { name: 'Kehadiran', max: 100 },
      { name: 'Tugas', max: 100 },
      { name: 'Kuis', max: 100 },
      { name: 'Ujian', max: 100 },
    ]
  },
  series: [
    {
      name: 'Nilai Rata-Rata',
      type: 'radar',
      data: [
        {
          value: [{{$att_stat}}, {{$task_stat}}, {{{$quiz_stat}}}, {{$exam_stat}}]
        },
      ]
    }
  ]
};
myChart.setOption(option);
</script>
<script type="text/javascript">
var myChart = echarts.init(document.getElementById('present'));

var option = {
  series: [
    {
      type: 'gauge',
      progress: {
        show: true,
        width: 18
      },
      axisLine: {
        lineStyle: {
          width: 18
        }
      },
      axisTick: {
        show: true
      },
      splitLine: {
        length: 15,
        lineStyle: {
          width: 2,
          color: '#999'
        }
      },
      axisLabel: {
        distance: 25,
        color: '#999',
        fontSize: 10
      },
      anchor: {
        show: true,
        showAbove: true,
        size: 20,
        itemStyle: {
          borderWidth: 10
        }
      },
      title: {
        show: false
      },
      detail: {
        valueAnimation: true,
        fontSize: 50,
        offsetCenter: [0, '70%']
      },
      data: [
        {
          value: {{$att_stat}}
        }
      ]
    }
  ]
};
myChart.setOption(option);
</script>
@endsection
