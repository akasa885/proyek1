@extends('admin/admin')

@section('judul_header','Selamat Datang di Halaman Dashboard Admin BNNK Sidoarjo')
@section('sub_header','Ini adalah halaman admin BNNK Sidoarjo')
@section('icon_title')
<i class="pe-7s-world icon-gradient bg-mean-fruit"></i>
@endsection
<?php
$dom_html = "<button class=\"btn btn-primary\" type=\"button\" disabled>
  <span class=\"spinner-border spinner-border-sm\" role=\"status\" aria-hidden=\"true\"></span>
  Loading...
</button>";
 ?>
@section('konten')
<div class="row">
  <div class="col-md-12">
    <div class="main-card mb-3 card">
      <center>
        <h1>Selamat Datang</h1>
      </center>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="main-card mb-3 card">
      <div class="card-body">
        <h2 class="card-title">Pengaturan Link</h2>
        <div class="row">
          @foreach($link as $row)
          <div class="col-md-5">
            <div class="form-group">
              <label for="ig">Instagram</label>
              <input id="ig_link" class="form-control" type="text" name="instagram_link" value="{{ $row->instagram }}">
            </div>
            <div class="form-group">
              <label for="ytb">Youtube</label>
              <input id="ytb_link" class="form-control" type="text" name="youtube_link" value="{{ $row->youtube }}">
            </div>
            <span id="message"></span><br />
            <br />
          </div>
          <div class="col-md-5">
            <div class="form-group">
              <label for="fb">Facebook</label>
              <input id="fb_link" class="form-control" type="text" name="facebook_link" value="{{ $row->facebook }}">
            </div>
            <div class="form-group">
              <label for="linked_web">Linked Web</label>
              <input id="web_link" class="form-control" type="text" name="linked_web_link" value="{{ $row->linked_link }}">
            </div>
          </div>
          @endforeach
        </div>
        <div class="row">
          <div class="col-md-12">
            <div id="btn-respon">
              <button type="button" name="button" id="link_save" class="btn btn-primary" style="width: 100px;"><span role="status" aria-hidden="true">Simpan</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
