@extends('fmaster')

@section('judul','Pengaduan Masyarakat')
@section('head_halaman','Form Pengaduan')

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
<form action="/proses/pengaduan" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input id="identiti" type="hidden" name="identiti" value="pengaduan">
    <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input class="form-control" type="text" name="nama" value="{{ old('nama') }}">
    </div>
    <div class="form-group">
      <label for="tgl_lahir">Tanggal Lahir</label>
      <div class="input-group date datepicker" data-provide="datepicker">
        <input type="text" placeholder="dd-mm-yyyy" name="tgl_lahir" class="form-control" value="{{ old('tgl_lahir') }}">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
      </div>
    </div>
    <div class="form-group">
        <label for="alamat_patient">Alamat</label>
        <textarea placeholder="Alamat yang diadukan" class="form-control" name="address_patient" rows="3">{{old('address_patient')}}</textarea>
    </div>
    <div class="form-group">
      <label for="nomor_hp">Nomor Hp</label>
      <input class="form-control" type="text" name="Nomor_hp" value="{{old('Nomor_hp')}}">
    </div>
    <div class="form-group">
      <label for="email">Alamat Email</label>
      <input class="form-control" type="email" name="alamat_email" value="{{ old('alamat_email') }}">
    </div>
    <div class="form-group">
        <label for="lampiran">Lampiran Identitas</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
          </div>
          <div class="custom-file">
            <input name="file1" type="file" class="custom-file-input" id="inputGroupFile01"
              aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile01">Pilih file (.jpg .png .jpeg)</label>
          </div>
        </div>
    </div>
    <div class="form-group">
        <label for="pekerjaan">Pekerjaan</label>
        <select class="form-control" name="pekerjaan">
          @foreach($job as $row)
          <option value="{{ $row->nama_pekerjaan }}">{{ $row->nama_pekerjaan }}</option>
          @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="instansi">Instansi/Perusahaan</label>
        <input class="form-control" type="text" name="instansi" value="{{ old('instansi') }}">
    </div>
    <div class="form-group">
        <label for="alamat_kompani">Alamat</label>
        <textarea placeholder="Alamat instansi" class="form-control" name="address_company" rows="3">{{old('address_company')}}</textarea>
    </div>
    <div class="form-group">
      <label for="Nomor_telp_instansi">Nomor Telp</label>
      <input class="form-control" type="text" name="Nomor_telp_instansi" value="{{old('Nomor_telp_instansi')}}">
    </div>
    <hr />
    <div class="form-group">
      <label for="case_date">Tanggal Kejadian</label>
      <div class="input-group date datepicker" data-provide="datepicker">
        <input type="text" placeholder="dd-mm-yyyy" name="case_date" class="form-control" value="{{ old('case_date') }}">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-3">
        <div class="position-relative form-group">
          <label for="jam" class="">Waktu Kejadian</label>
          <input type="number" class="form-control" min="1" max="24" onkeyup="hour_check(this)" name="case_hour" placeholder="jam" id="hour" value="{{old('case_hour')}}">
        </div>
      </div>
      <div class="col-md-3">
        <div class="position-relative form-group">
          <label for="tanggal_lahir" class="">:</label>
          <select class="form-control" name="case_minute">
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
        <label for="lampiran-pendukung">Lampiran pendukung</label>
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
          </div>
          <div class="custom-file">
            <input type="file2" class="custom-file-input" id="inputGroupFile02"
              aria-describedby="inputGroupFileAddon01">
            <label class="custom-file-label" for="inputGroupFile02">Pilih file pendukung pelaporan. (.jpg .png .jpeg)</label>
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
<p>Ini adalah bagian pengisian pemberitahuan khusus yang auhsdiasd ias uaihsdi aiu uiashdiah</p>
@endsection
