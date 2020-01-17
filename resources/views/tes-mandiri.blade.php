@extends('fmaster')

@section('judul','Permohonan Tes Urine Mandiri')
@section('head_halaman','Form Permohonan')

@section('konten')

{{-- menampilkan error validasi --}}
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<br/>
 <!-- form validasi -->
<form action="/proses/tes_mandiri" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input id="identiti" type="hidden" name="identiti" value="sosialisasi">
    <div class="form-group">
        <label for="gender">Jenis Tes Urine Mandiri</label>
        <select class="form-control" name="tes_type">
          <option disabled selected value> -- Pilih Kategori -- </option>
          <option value="masyarakat">Masyarakat</option>
          <option value="pemerintah">Pemerintah</option>
          <option value="swasta">Swasta</option>
          <option value="pendidikan">Pendidikan</option>
        </select>
    </div>
    <div class="form-group">
        <label for="nama">Nama Penyelenggara</label>
        <input class="form-control" type="text" name="nama_pengada" value="{{ old('nama_pengada') }}">
    </div>
    <div class="form-group">
      <label for="due_Date">Tanggal</label>
      <div class="input-group date datepicker" data-provide="datepicker">
        <input type="text" placeholder="dd-mm-yyyy" name="due_date" class="form-control" value="{{ old('due_date') }}">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-3">
        <div class="position-relative form-group">
          <label for="jam" class="">Jam / Pukul</label>
          <input type="number" class="form-control" min="1" max="24" onkeyup="hour_check(this)" name="jam" placeholder="jam" id="hour" value="{{old('jam')}}">
        </div>
      </div>
      <div class="col-md-3">
        <div class="position-relative form-group">
          <label for="tanggal_lahir" class="">:</label>
          <select class="form-control" name="menit">
            <option value="00" selected>00</option>
            <option value="15">15</option>
            <option value="30">30</option>
            <option value="45">45</option>
          </select>
        </div>
      </div>
      <div class="col-md-1">
      </div>
      <div class="col-md-3">
        <div class="position-relative form-group">
          <label for="alert" class="">*</label>
          <p style="color:red;">Masukkan waktu tepat acara dimulai.!</p>
        </div>
      </div>
    </div>
    <div class="form-group">
        <label for="alamat">Tempat</label>
        <textarea placeholder="Tempat / Lokasi" class="form-control" name="address_place" rows="3">{{old('address_place')}}</textarea>
    </div>
    <div class="form-group">
        <label for="nama">Nama Penanggung Jawab</label>
        <input class="form-control" type="text" name="nama_duty" value="{{ old('nama_duty') }}">
    </div>
    <div class="form-group">
      <label for="nomor_hp">Nomor Hp Penanggung Jawab</label>
      <input class="form-control" type="text" name="Nomor_hp_pj" value="{{old('Nomor_hp_pj')}}">
    </div>
    <div class="form-group">
      <label for="jumlah">Jumlah Peserta</label>
      <input class="form-control" onkeyup="amoun_check(this)" type="number" min="5" name="jmlh_peserta" value="{{ old('jmlh_peserta') }}">
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <textarea placeholder="keterangan" class="form-control" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
    </div>
    <div class="form-group">
        <label for="lampiran">Lampiran Surat Undangan</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
          </div>
          <div class="custom-file">
            <input type="file" name="lampiran" class="custom-file-input" id="inputGroupFile01"
              aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Pilih file (.jpg .png .jpeg)</label>
          </div>
        </div>
    </div>
    <div class="form-group">
      <div class="captcha">
        <span>{!! captcha_img('math') !!}</span>
        <button type="button" class="btn btn-success"><i class="fas fa-sync-alt" id="refresh"></i></button>
      </div>
    </div>
    <div class="form-group">
      <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha">
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Proses">
    </div>
</form>

@endsection
@section('judul_tambahan','Bantuan')
@section('attention')
<center>
  <img src="/assets/images/logo-bnn-terbaru.png" alt="logo" height="150px" width="150px">
</center>
@foreach($hint as $row)
<div style="white-space: pre-wrap">
{{$row->paragraph_hint}}
</div>
@endforeach
@endsection
