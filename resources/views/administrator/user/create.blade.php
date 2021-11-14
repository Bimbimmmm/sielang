@extends('layouts.admin')
@section('content')
<div class="container px-4 sm:px-8">
  <div class="py-8">
    <div>
      <h2 class="text-2xl text-center leading-tight">TAMBAH USER</h2>
    </div>
    <div class="p-10 md:w-3/4 lg:w-1/2 mx-auto">
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
      <form action="/administrator/users/store" method="POST" class="w-full max-w-lg">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Nama Lengkap
            </label>
            <input name="name" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"    type="text" required>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Nomor Induk Pegawai (NIP)
            </label>
            <input name="registration_number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"   type="text" required>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Nomor Induk Kependudukan (NIK)
            </label>
            <input name="id_number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"    type="text" required>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              NUPTK
            </label>
            <input name="educator_number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"   type="text" required>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Tempat Lahir
            </label>
            <input name="birth_place" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"    type="text" required>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Tanggal Lahir
            </label>
            <input id="birth_date" name="birth_date" class="datepicker input appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"    type="text" required>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Jenis Kelamin
            </label>
            <select name="gender" id="gender" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Jenis Kelamin</option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Status Perkawinan
            </label>
            <select name="marital_status_id" id="marital_status_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Status Pernikahan</option>
              @foreach($maritals as $marital)
              <option value={{$marital->id}}>{{$marital->name}}</option>
              @endforeach
            </select>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Agama
            </label>
            <select name="religion_id" id="religion_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Agama</option>
              @foreach($religions as $religion)
              <option value={{$religion->id}}>{{$religion->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Pangkat dan Golongan
            </label>
            <select name="rank_id" id="rank_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Pangkat dan Golongan</option>
              @foreach($ranks as $rank)
              <option value={{$rank->id}}>{{$rank->rank}} / {{$rank->group}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Jabatan
            </label>
            <select name="position_id" id="position_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Jabatan</option>
              @foreach($positions as $position)
              <option value={{$position->id}}>{{$position->name}} / {{$position->echelon}}</option>
              @endforeach
            </select>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Status Kepegawaian
            </label>
            <select name="status_id" id="status_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Status Kepegawaian</option>
              @foreach($statuss as $status)
              <option value={{$status->id}}>{{$status->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Unit Kerja
            </label>
            <select name="school_id" id="school_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Sekolah</option>
              @foreach($schools as $school)
              <option value={{$school->id}}>{{$school->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Pendidikan
            </label>
            <select name="education_id" id="position_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Pendidikan</option>
              @foreach($educations as $education)
              <option value={{$education->id}}>{{$education->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              T.M.T CPNS
            </label>
            <input id="cs_candidate_year" name="cs_candidate_year" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"    type="text" required>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              T.M.T PNS
            </label>
            <input id="cs_year" name="cs_year" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"   type="text" required>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              NPWP
            </label>
            <input name="tax_number" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"    type="text" required>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Jenis Guru / Pegawai
            </label>
            <input name="teacher_type" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"   type="text" required>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Email
            </label>
            <input name="email" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="text" required>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Password
            </label>
            <input name="password" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="password" required>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"    >
              Confirm Password
            </label>
            <input name="password_confirmation" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"  type="password" required>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
              Role
            </label>
            <select name="role_id" id="role_id" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Role</option>
              @foreach($roles as $role)
              <option value={{$role->id}}>{{$role->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Alamat
            </label>
            <input name="address" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" required>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block dark:text-white uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"   >
              Kode POS
            </label>
            <input name="zip_code" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"   type="text" required>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="dark:text-white block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Provinsi
            </label>
            <select name="province" id="province" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
              <option value="">Pilih Provinsi</option>
              @foreach($provinces as $province)
              <option value="{{$province->code}}">{{$province->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="dark:text-white block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Kabupaten / Kota
            </label>
            <select name="city" id="city" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </select>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="dark:text-white block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Kecamatan
            </label>
            <select name="district" id="district" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </select>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="dark:text-white block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
              Kelurahan / Desa
            </label>
            <select name="village" id="village" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </select>
          </div>
        </div>
        <div class="md:flex md:items-center">
          <div class="md:w-1/3">
            <button class="shadow bg-green-600 hover:bg-green-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
              Submit
            </button>
          </div>
          <div class="md:w-2/3"></div>
        </div>
      </form>
    </div>
  </div>
</div>
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
<script>
$( function() {
  $( "#birth_date" ).datepicker({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
  });

} );
</script>
<script>
$( function() {
  $( "#cs_candidate_year" ).datepicker({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
  });

} );
</script>
<script>
$( function() {
  $( "#cs_year" ).datepicker({
    dateFormat: "dd-mm-yy",
    changeMonth: true,
    changeYear: true,
  });
});
</script>
@endsection
