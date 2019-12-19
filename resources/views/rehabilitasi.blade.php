@extends('fmaster')

@section('judul','Permohonan Rehabilitasi')
@section('head_halaman','Form Rehabilitasi')
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
<form id="tipe_R" class="form-inline" method="get">
  <!-- @if($form == "default") -->
  <!-- @endif -->
  <div class="form-group">
    <label for="pilih_tipe" style="margin-right:5px;">Pengajuan apa:</label>
    <select class="form-control" name="tipe">
      <option value="instansi">Instansi</option>
      <option value="publik">Publik</option>
    </select>
  </div>
  <button id="type_send" type="submit" class="btn btn-success" style="margin-left:10px;">Pilih</button>
</form>
<br>
@if($form == "instansi")
  <form action="/rehab/tat" method="post">
    {{csrf_field()}}
    <input id="identiti" type="hidden" name="identiti" value="rehab">
    <input id="i_rehab" type="hidden" name="identiti" value="tat">
    <input type="hidden" name="tipe" value="{{$form}}">
    <div class="form-group">
      <label for="pengaju">Instansi Pengaju</label>
      <input class="form-control" placeholder="POLRES SIDOARJO/POLSEK/BNN" type="text" name="instansi_pengaju" value="{{ old('instansi_pengaju') }}">
    </div>
    <div class="form-group">
        <label for="nama">Nama Tersangka</label>
        <input class="form-control" type="text" name="nama" value="{{ old('nama') }}">
    </div>
    <div class="form-group">
        <label for="NIK">NIK</label>
        <input type="text" class="form-control" name="nik" value="{{ old('nik') }}">
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" name="address" rows="3">{{ old('address') }}</textarea>
    </div>
    <div class="form-group">
      <label for="tgl_tangkap">Tanggal Penangkapan</label>
      <div class="input-group date datepicker" data-provide="datepicker">
        <input type="text" placeholder="dd-mm-yyyy" name="tgl_tangkap" class="form-control" value="{{ old('tgl_tangkap') }}">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="tgl_sprin_tangkap">Tanggal Sprin Penangkapan</label>
      <div class="input-group date datepicker" data-provide="datepicker">
        <input type="text" placeholder="dd-mm-yyyy" name="tgl_sprin_tangkap" class="form-control" value="{{ old('tgl_sprin_tangkap') }}">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="tgl_sprin_tahan">Tanggal Sprin Penahanan</label>
      <div class="input-group date datepicker" data-provide="datepicker">
        <input type="text" placeholder="dd-mm-yyyy" name="tgl_sprin_tahan" class="form-control" value="{{ old('tgl_sprin_tahan') }}">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label for="barang-bukti">Barang Bukti</label>
    </div>
    <div class="form-group">
      <div class="col-md-6 col-xl-4">
        <?php $tipe=0;?>
        @foreach($tipe_narkoba as $type)
          <div class="form-check-inline">
            <label class="form-check-label">
              <input id="tipe_{{$tipe}}" type="checkbox" class="form-check-input" name="tipe[]" value="{{$type->jenis_narkoba}}">{{$type->jenis_narkoba}}
            </label>
          </div>
          <div class="input-group">
              <input id="input_gram_{{$tipe}}" type="number" class="form-control check" aria-label="Amount (to the nearest dollar)" name="berat[]"disabled placeholder="0">
            <div class="input-group-append">
              <span class="input-group-text">gr</span>
            </div>
          </div>
          <?php $tipe++;?>
          @endforeach
      </div>
    </div>
    <div class="form-group">
      <label for="nama_penyidik">Nama Penyidik</label>
      <input type="text" class="form-control" name="penyidik" value="{{ old('penyidik') }}">
    </div>
    <div class="form-group">
      <label for="no_penyidik">No.HP Penyidik</label>
      <input type="text" class="form-control" name="hp_penyidik" value="{{ old('hp_penyidik') }}">
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
@elseif($form == "publik")
  <form action="/rehab/publik" method="post">
    {{csrf_field()}}
    <input id="identiti" type="hidden" name="identiti" value="rehab">
    <input id="i_rehab" type="hidden" name="identiti" value="umum">
    <input type="hidden" name="tipe" value="{{$form}}">
    <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input class="form-control" type="text" name="nama" value="{{ old('nama') }}">
    </div>
    <div class="form-group">
        <label for="gender">Jenis Kelamin</label>
        <select class="form-control" name="gender">
          <option value="laki-laki" selected>Laki-Laki</option>
          <option value="perempuan">Perempuan</option>
        </select>
    </div>
    <div class="form-group">
      <label for="tgl_datang">Tanggal Kedatangan</label>
      <div class="input-group date datepicker" data-provide="datepicker">
        <input type="text" placeholder="dd-mm-yyyy" name="tgl_datang" class="form-control" value="{{ old('tgl_datang') }}">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
      </div>
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
      <label for="umur">Umur</label>
      <input type="number" class="form-control" name="umur" value="{{ old('umur') }}">
    </div>
    <div class="form-group">
      <label for="NIK">NIK/NO KTP</label>
      <input type="text" class="form-control" name="NIK" value="{{ old('NIK') }}">
    </div>
    <div class="form-group">
      <label for="agama">Agama</label>
      <select class="form-control" name="agama">
        @foreach($agama as $agamas)
        <option value="{{ $agamas->agama }}">{{ $agamas->agama }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="suku">Suku</label>
      <select class="form-control" name="suku">
        @foreach($suku as $sukus)
          <option value="{{ $sukus->nama_suku }}">{{ $sukus->nama_suku }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="jenis">Jenis yang Digunakan</label>
    </div>
    <div class="form-group">
    @foreach($tipe_narkoba as $type)
      <div class="form-check-inline">
        <label class="form-check-label">
          <input type="checkbox" class="form-check-input" name="tipe[]" value="{{$type->jenis_narkoba}}">{{$type->jenis_narkoba}}
        </label>
      </div>
      @endforeach
    </div>
    <div class="form-group">
      <label for="status">Status</label>
      <select class="form-control" name="status">
        <option value="menikah">Menikah</option>
        <option value="belum_menikah">Belum Menikah</option>
        <option value="duda/janda">Duda/Janda</option>
      </select>
    </div>
    <div class="form-group">
      <label for="nama_ibu">Nama Ibu</label>
      <input type="text" class="form-control" name="nama_ibu" value="{{ old('nama_ibu') }}">
    </div>
    <div class="form-group">
      <label for="nama_ayah">Nama Ayah</label>
      <input type="text" class="form-control" name="nama_ayah" value="{{ old('nama_ayah') }}">
    </div>
    <div class="form-group">
        <label for="alamat">Alamat</label>
        <textarea class="form-control" name="address" rows="3">{{ old('address') }}</textarea>
    </div>
    <div class="form-group">
      <label for="no_hp">No HP</label>
      <input class="form-control" type="text" name="no_hp" value="{{ old('no_hp') }}">
    </div>
    <div class="form-group">
      <label for="no_keluarga">No.HP Keluarga</label>
      <input class="form-control" type="text" name="no_keluarga" value="{{ old('no_keluarga') }}">
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
@endif
@endsection
@section('judul_tambahan','Bantuan')
@section('attention')
<center>
  <img src="/assets/images/logo-bnn-terbaru.png" alt="logo" height="150px" width="150px">
</center>
<p>Ini adalah bagian pengisian pemberitahuan khusus</p>
@endsection
