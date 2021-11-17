<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIELANG</title>
    <link rel="shortcut icon" href="{{ asset('images/kaltara.png') }}" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/alpine.min.js') }}"></script>
  </head>
  <style>
/*remove custom style*/
  .circles{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
}
  .circles li{
    position: absolute;
    display: block;
    list-style: none;
    width: 20px;
    height: 20px;
    background: rgba(255, 255, 255, 0.2);
    animation: animate 25s linear infinite;
    bottom: -150px;
}
.circles li:nth-child(1){
    left: 25%;
    width: 80px;
    height: 80px;
    animation-delay: 0s;
}


.circles li:nth-child(2){
    left: 10%;
    width: 20px;
    height: 20px;
    animation-delay: 2s;
    animation-duration: 12s;
}

.circles li:nth-child(3){
    left: 70%;
    width: 20px;
    height: 20px;
    animation-delay: 4s;
}

.circles li:nth-child(4){
    left: 40%;
    width: 60px;
    height: 60px;
    animation-delay: 0s;
    animation-duration: 18s;
}

.circles li:nth-child(5){
    left: 65%;
    width: 20px;
    height: 20px;
    animation-delay: 0s;
}

.circles li:nth-child(6){
    left: 75%;
    width: 110px;
    height: 110px;
    animation-delay: 3s;
}

.circles li:nth-child(7){
    left: 35%;
    width: 150px;
    height: 150px;
    animation-delay: 7s;
}

.circles li:nth-child(8){
    left: 50%;
    width: 25px;
    height: 25px;
    animation-delay: 15s;
    animation-duration: 45s;
}

.circles li:nth-child(9){
    left: 20%;
    width: 15px;
    height: 15px;
    animation-delay: 2s;
    animation-duration: 35s;
}

.circles li:nth-child(10){
    left: 85%;
    width: 150px;
    height: 150px;
    animation-delay: 0s;
    animation-duration: 11s;
}
  @keyframes animate {

    0%{
        transform: translateY(0) rotate(0deg);
        opacity: 1;
        border-radius: 0;
    }

    100%{
        transform: translateY(-1000px) rotate(720deg);
        opacity: 0;
        border-radius: 50%;
    }

}
</style>
  <body>
    <div class="font-roboto text-gray-900 antialiased">
      <div class="relative min-h-screen flex ">
    <div class="flex flex-col sm:flex-row items-center md:items-start sm:justify-center md:justify-start flex-auto min-w-0 bg-white">
      <div class="sm:w-1/2 xl:w-3/5 h-full hidden md:flex flex-auto items-center justify-center p-10 overflow-hidden bg-blue-300 text-white bg-no-repeat bg-cover relative"
        style="background-image: url({{ asset('images/login.jpg') }}");>
        <div class="absolute bg-gradient-to-b from-blue-300 to-blue-500 opacity-50 inset-0 z-0"></div>
        <div class="w-full  max-w-md z-10">
          <div class="sm:text-4xl xl:text-5xl font-bold leading-tight mb-6">SIELANG</div>
          <div class="sm:text-md xl:text-xl text-gray-200 font-normal capitalize">
              sistem informasi e-Learning adalah sistem informasi yang digunakan oleh
              peserta didik dan tenaga pendidik dalam melakukan proses belajar mengajar
          </div>
        </div>
        <!---remove custom style-->
       <ul class="circles">
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
      <li></li>
   </ul>
      </div>
      <div class="md:flex md:items-center md:justify-center w-full sm:w-auto md:h-full w-2/5 xl:w-2/5 p-8  md:p-10 lg:p-14 sm:rounded-lg md:rounded-none bg-white">
        <div class="max-w-md w-full space-y-8">
          @if(session('errors'))
          @foreach ($errors->all() as $error)
          <div class="bg-red-200 px-6 py-4 mx-2 my-4 rounded-md text-lg flex items-center">
            <svg viewBox="0 0 24 24" class="text-red-600 w-5 h-5 sm:w-5 sm:h-5 mr-3">
              <path fill="currentColor"  d="M11.983,0a12.206,12.206,0,0,0-8.51,3.653A11.8,11.8,0,0,0,0,12.207,11.779,11.779,0,0,0,11.8,24h.214A12.111,12.111,0,0,0,24,11.791h0A11.766,11.766,0,0,0,11.983,0ZM10.5,16.542a1.476,1.476,0,0,1,1.449-1.53h.027a1.527,1.527,0,0,1,1.523,1.47,1.475,1.475,0,0,1-1.449,1.53h-.027A1.529,1.529,0,0,1,10.5,16.542ZM11,12.5v-6a1,1,0,0,1,2,0v6a1,1,0,1,1-2,0Z"></path>
            </svg>
            <span class="text-red-800">{{ $error }}</span>
          </div>
          @endforeach
          @endif
          <div class="text-center">
            <h2 class="mt-6 text-3xl font-bold text-gray-900">
              Selamat Datang
            </h2>
            <p class="mt-2 text-sm text-gray-500">Silahkan Login Menggunakan e-Mail dan Password</p>
          </div>
          <div class="flex flex-row justify-center items-center space-x-3">
          <a class=" items-center justify-center inline-flex font-bold">
            <img src="{{ asset('images/kaltara.png') }}" class="w-1/3 h-1/3"></a>
          </div>
          <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
            @csrf
            <div class="relative">
              <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
              <input
                name="email" class=" w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500"
                placeholder="email@belajar.id">
            </div>
            <div class="mt-8 content-center">
              <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                Password
              </label>
              <input
                name="password" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500"
                type="password" placeholder="Masukkan Password">
            </div>
            <div>
              <button type="submit"
                class="w-full flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600  hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                Masuk
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    </div>
  </body>
</html>
