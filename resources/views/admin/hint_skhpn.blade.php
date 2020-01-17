@extends('admin/admin')

@section('judul_header','Halaman Pengaturan Petunjuk Tes Urine')
@section('sub_header','Ini adalah halaman petunjuk BNNK Sidoarjo')
@section('icon_title')
<i class="pe-7s-leaf icon-gradient bg-mean-fruit"></i>
@endsection
@section('konten')
<div class="col-md-12">
  <div class="main-card mb-3 card">
    <div class="card-body">
      <div class="card-header-tab card-header-tab-animation card-header">
          <div class="card-header-title">
              <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
              Petunjuk Form Pendaftaran
          </div>
          <ul class="nav">
              <li class="nav-item"><a href="javascript:void(0);" class="nav-link" id="count"></a></li>
          </ul>
      </div>
      <div class="form-group">
        <textarea id="petunjuk" name="name" rows="10" cols="50" class="form-control" onkeyup="countChar(this)"></textarea>
      </div>
      <div class="d-block text-center card-footer">
        <button id="hint-input-add" target="4" class="btn-wide btn btn-info" type="button" name="button">Simpan</button>
      </div>
    </div>
  </div>
</div>
@endsection
