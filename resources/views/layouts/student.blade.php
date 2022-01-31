<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>SIELANG</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />
  <!-- Styles -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/materialicons.css') }}">
  <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/jquery-ui.css') }}">
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
  @include('sweetalert::alert')
  <nav class="sticky top-0 z-50 bg-white">
    <div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
    <div class="p-4 flex flex-row items-center justify-between">
      <a href="/student" class="text-lg font-semibold tracking-widest text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none focus:shadow-outline">SIELANG</a>
      <button class="md:hidden rounded-lg focus:outline-none focus:shadow-outline" @click="open = !open">
        <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
          <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
          <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg>
      </button>
    </div>
    <nav :class="{'flex': open, 'hidden': !open}" class="flex-col mt-4 flex-grow pb-4 md:pb-0 hidden md:flex md:justify-end md:flex-row">
      <div @click.away="open = false" class="relative" x-data="{ open: false }">
        <button @click="open = !open" class="flex flex-row items-center w-full px-4 py-2 mt-2 text-sm font-semibold text-left bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:focus:bg-gray-600 dark-mode:hover:bg-gray-600 md:w-auto md:inline md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
          <span>{{auth()->user()->email}}</span>
          <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48">
          <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-800">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
            <a class="block px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline">
              <button href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                Logout
              </button>
            </a>
          </div>
          </form>
        </div>
      </div>
    </nav>
  </div>
  </nav>
  <div class="container min-h-full min-w-full">
    @yield('content')
  </div>
  <footer class="w-full bg-gray-500 text-white">
    <div class="xl:px-40 pb-12 lg:px-20 md:px-10 sm:px-5 px-10">
      <div class="w-full pt-12 flex flex-col sm:flex-row space-y-2 justify-start">
        <div class="w-full sm:w-2/5 pr-6 flex flex-col space-y-4">
          <a class="title-font font-medium items-center md:justify-start justify-center">
            <image width="100" height="50" src="{{ asset('images/kaltara.png') }}"/>
            <p>Cabang Dinas Pendidikan dan Kebudayaan Wilayah Nunukan</p>
          </a>
          <p class="mt-0">Jl.Iskandar Muda, Kel.Nunukan Barat, Kec.Nunukan, Kab.Nunukan, Provinsi Kalimantan Utara, 77482</p>
        </div>
      </div>
      <div class="opacity-60 pt-2">
        <p>© 2021 Cabdin NNK</p>
      </div>
    </div>
  </footer>
</div>
</body>
</html>
