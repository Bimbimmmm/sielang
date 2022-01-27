<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIELANG</title>
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png') }}" />

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">

  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{ asset('js/alpine.min.js') }}"></script>
  <script src="{{ asset('js/jquery.min.js') }}"></script>
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
              Pendaftaran Akun
            </h2>
            <p class="mt-2 text-sm text-gray-500">Silahkan Mengisi Data Yang Diminta</p>
          </div>
            <form method="POST" action="{{ route('register') }}" class="mt-2 space-y-6">
              @csrf
              <div class="mt-2 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Pilih Jenis Akun
                </label>
                <select name="role_id" id="role_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                  <option value=""><== Pilih Jenis Akun ==>></option>
                  <option value="842f1676-f175-4427-a0a3-e11a06a6705a">Akun Orang Tua</option>
                  <option value="8bd25869-b8b9-4fc4-bcaf-f9e82f0217fe">Akun Siswa</option>
                  <option value="d00343f6-54b5-4406-8a15-59d3ab354137">Akun Tenaga Pendidik</option>
                </select>
              </div>
              <div class="relative">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">Email</label>
                <input name="email" class=" w-full text-base px-4 py-2 border-b border-gray-300 focus:outline-none rounded-2xl focus:border-indigo-500" placeholder="Masukkan Email">
              </div>
              <div class="mt-2 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Password
                </label>
                <input name="password" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="password" placeholder="Masukkan Password">
              </div>
              <div class="mt-2 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Konfirmasi Password
                </label>
                <input name="password_confirmation" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="password" placeholder="Ulangi Password">
              </div>
              <div id="parents" style="display:none;">
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nama Lengkap Wali
                  </label>
                  <input name="name" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan Nama Lengkap">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nomor Induk Kependudukan
                  </label>
                  <input name="id_number" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="number" placeholder="Masukkan NIK">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    NISN Siswa
                  </label>
                  <input name="student_number" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan NISN Peserta Didik">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Tempat dan Tanggal Lahir
                  </label>
                  <input name="birth" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan Tempat dan Tanggal Lahir">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nomor Kontak
                  </label>
                  <input name="phone_number" class="w-full content-center text-base px-4px py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="number" placeholder="Masukkan Nomor HP / Whatsapp">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Alamat
                  </label>
                  <input name="address" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan Alamat">
                </div>
              </div>

              <div id="student" style="display:none;">
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nama Lengkap
                  </label>
                  <input name="name" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan Nama Lengkap">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nomor Induk Kependudukan
                  </label>
                  <input name="id_number" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="number" placeholder="Masukkan NIK (Dapat Dilihat di KK)">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nomor Induk Siswa Sekolah
                  </label>
                  <input name="student_number" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan NIS">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nomor Induk Siswa Nasional
                  </label>
                  <input name="national_student_number" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan NISN">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Tempat Lahir
                  </label>
                  <input name="birth_place" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan Tempat Lahir">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Tanggal Lahir
                  </label>
                  <input name="birth_date" id="birth_date" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Format DD-MM-YYYY (ex:10-10-2010)">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Jenis Kelamin
                  </label>
                  <select name="gender" id="gender" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Agama
                  </label>
                  <select name="religion_id" id="religion_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Agama</option>
                    @foreach($religions as $religion)
                    <option value="{{$religion->id}}">{{$religion->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nama Sekolah
                  </label>
                  <select name="school_id" id="school_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Sekolah</option>
                    @foreach($schools as $school)
                    <option value="{{$school->id}}">{{$school->name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div id="teacher" style="display:none;">
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nama Lengkap
                  </label>
                  <input name="name" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan Nama Lengkap">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nomor Induk Kependudukan
                  </label>
                  <input name="id_number" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="number" placeholder="Masukkan NIK">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Nomor Induk Pegawai
                  </label>
                  <input name="registration_number" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan NIP">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    NUPTK
                  </label>
                  <input name="educator_number" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan NUPTK">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Tempat Lahir
                  </label>
                  <input name="birth_place" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan Tempat Lahir">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Tanggal Lahir
                  </label>
                  <input name="birth_date" id="birth_date" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Format DD-MM-YYYY (ex:10-10-2010)">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Jenis Kelamin
                  </label>
                  <select name="gender" id="gender" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Status Perkawinan
                  </label>
                  <select name="marital_status_id" id="marital_status_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Status Perkawinan</option>
                    @foreach($maritals as $marital)
                    <option value="{{$marital->id}}">{{$marital->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Agama
                  </label>
                  <select name="religion_id" id="religion_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Agama</option>
                    @foreach($religions as $religion)
                    <option value="{{$religion->id}}">{{$religion->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Pangkat dan Golongan
                  </label>
                  <select name="rank_id" id="rank_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Pangkat dan Golongan</option>
                    @foreach($ranks as $rank)
                    <option value={{$rank->id}}>{{$rank->rank}} / {{$rank->group}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Unit Kerja
                  </label>
                  <select name="school_id" id="school_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Sekolah</option>
                    @foreach($schools as $school)
                    <option value="{{$school->id}}">{{$school->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Jabatan
                  </label>
                  <select name="position_id" id="position_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Jabatan</option>
                    @foreach($positions as $position)
                    <option value="{{$position->id}}">{{$position->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Status Kepegawaian
                  </label>
                  <select name="status_id" id="status_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Status</option>
                    @foreach($statuss as $status)
                    <option value="{{$status->id}}">{{$status->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Pendidikan Terakhir
                  </label>
                  <select name="education_id" id="education_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Pilih Pendidikan Terakhir</option>
                    @foreach($educations as $education)
                    <option value="{{$education->id}}">{{$education->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    T.M.T PNS
                  </label>
                  <input name="cs_year" id="cs_year" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Format DD-MM-YYYY (ex:10-10-2010)">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    T.M.T CPNS
                  </label>
                  <input name="cs_candidate_year" id="cs_candidate_year" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Format DD-MM-YYYY (ex:10-10-2010)">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    NPWP
                  </label>
                  <input name="tax_number" id="tax_number" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan NPWP">
                </div>
                <div class="mt-2 content-center">
                  <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                    Jenis Guru
                  </label>
                  <input name="teacher_type" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan Jenis Guru">
                </div>
              </div>

              <div class="mt-2 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Alamat
                </label>
                <input name="address" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="text" placeholder="Masukkan Alamat">
              </div>
              <div class="mt-2 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Provinsi
                </label>
                <select name="province" id="province" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                  <option value="">Pilih Provinsi</option>
                  @foreach($provinces as $province)
                  <option value="{{$province->code}}">{{$province->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="mt-2 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Kota / Kabupaten
                </label>
                <select name="city" id="city" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </select>
              </div>
              <div class="mt-2 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Kecamatan
                </label>
                <select name="district" id="district" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </select>
              </div>
              <div class="mt-2 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Kelurahan / Desa
                </label>
                <select name="village" id="village" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </select>
              </div>
              <div class="mt-2 content-center">
                <label class="ml-3 text-sm font-bold text-gray-700 tracking-wide">
                  Kode POS
                </label>
                <input name="zip_code" class="w-full content-center text-base px-4 py-2 border-b rounded-2xl border-gray-300 focus:outline-none focus:border-indigo-500" type="number" placeholder="Masukkan Kode POS">
              </div>
              <div>
                <button type="submit" class="w-full flex justify-center bg-gradient-to-r from-indigo-500 to-blue-600  hover:bg-gradient-to-l hover:from-blue-500 hover:to-indigo-600 text-gray-100 p-4  rounded-full tracking-wide font-semibold  shadow-lg cursor-pointer transition ease-in duration-500">
                Daftarkan Akun
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<script>
    $('#role_id').on('change', function () {
        if (this.value === '842f1676-f175-4427-a0a3-e11a06a6705a'){
            $("#parents").show();
            $("#student").hide();
            $("#teacher").hide();
        } else if (this.value === '8bd25869-b8b9-4fc4-bcaf-f9e82f0217fe'){
            $("#parents").hide();
            $("#student").show();
            $("#teacher").hide();
        } else if (this.value === 'd00343f6-54b5-4406-8a15-59d3ab354137'){
            $("#parents").hide();
            $("#student").hide();
            $("#teacher").show();
        } else {
            $("#parents").hide();
            $("#student").hide();
            $("#teacher").hide();
        }
    });
</script>
<script>
$(document).ready(function() {
  $('#province').on('change', function() {
    var province_id = $(this).val();
    if(province_id) {
      $.ajax({
        url: '/getCity/'+province_id,
        type: "GET",
        data : {"_token":"{{ csrf_token() }}"},
        dataType: "json",
        success:function(data)
        {
          if(data){
            $('#city').empty();
            $('#city').append('<option hidden>Pilih Kota</option>');
            $.each(data, function(key, city){
              $('select[name="city"]').append('<option value="'+ city.code +'">' + city.name+ '</option>');
            });
          }else{
            $('#city').empty();
          }
        }
      });
    }else{
      $('#city').empty();
    }
  });
});
</script>
<script>
$(document).ready(function() {
  $('#city').on('change', function() {
    var city_id = $(this).val();
    if(city_id) {
      $.ajax({
        url: '/getDistrict/'+city_id,
        type: "GET",
        data : {"_token":"{{ csrf_token() }}"},
        dataType: "json",
        success:function(data)
        {
          if(data){
            $('#district').empty();
            $('#district').append('<option hidden>Pilih Kecamatan</option>');
            $.each(data, function(key, district){
              $('select[name="district"]').append('<option value="'+ district.code +'">' + district.name+ '</option>');
            });
          }else{
            $('#district').empty();
          }
        }
      });
    }else{
      $('#district').empty();
    }
  });
});
</script>
<script>
$(document).ready(function() {
  $('#district').on('change', function() {
    var district_id = $(this).val();
    if(district_id) {
      $.ajax({
        url: '/getVillage/'+district_id,
        type: "GET",
        data : {"_token":"{{ csrf_token() }}"},
        dataType: "json",
        success:function(data)
        {
          if(data){
            $('#village').empty();
            $('#village').append('<option hidden>Pilih Kelurahan / Desa</option>');
            $.each(data, function(key, village){
              $('select[name="village"]').append('<option value="'+ village.code +'">' + village.name+ '</option>');
            });
          }else{
            $('#village').empty();
          }
        }
      });
    }else{
      $('#village').empty();
    }
  });
});
</script>
</html>
