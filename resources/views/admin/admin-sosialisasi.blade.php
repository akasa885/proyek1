@extends('admin/admin')

@section('judul_header','Halaman Daftar Sosialisasi')
@section('sub_header','Ini adalah halaman Sosialisasi BNNK Sidoarjo')
@section('icon_title')
<i class="pe-7s-wristwatch icon-gradient bg-mean-fruit"></i>
@endsection
@section('konten')
<div class="row">
  <div class="col-md-12">
    <div class="main-card mb-3 card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Search</span>
                  </div>
                    <input type="text" name="reg_num" id="reg_num" placeholder="masukkan no register" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="input-group date datepicker" data-provide="datepicker">
                  <input type="text" placeholder="Mulai Tanggal" value="{{ $date }}" id="start_tgl" name="tgl_cari_start" class="form-control" value="{{ old('tgl_cari_start') }}">
                  <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>
                <div class="form-inline">
                  <div class="form-group">
                    <div class="input-group date datepicker" data-provide="datepicker">
                      <input type="text" placeholder="Sampai Tanggal" value="{{ $date }}" id="last_tgl" name="tgl_cari_last" class="form-control" value="{{ old('tgl_cari_last') }}">
                      <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                      </div>
                    </div>
                  </div>
                  <button type="button" class="btn btn-info" id="cari_for_form" name="button" target="2">Cari</button>
                </div>
              </div>
          </div>
          <div class="col-md-4">

          </div>
          <div class="col-md-3" style="float:right">
            <div class="form-group">
              <input type="text" class="form-control" id="timestamp" disabled>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="main-card mb-3 card">
      <div class="card-body">
        <h2 class="card-title" id="title_tabel">Daftar Permintaan</h2>
        <div class="table-responsive text-nowrap">
          <table class="mb-0 table table-striped">
            <thead>
              <tr>
                <td>#</td>
                <td>Nama Penyelenggara</td>
                <td>Tanggal Pelaksanaan</td>
                <td>Nama PJ</td>
                <td>Nomor HP PJ</td>
                <td>Pengisi</td>
                <td>Tanggal Pembuatan</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody id="view_result">
            <?php $num = 1;?>
            @if(!session('src_data'))
              @foreach($sosio as $row)
            <tr>
              <td>{{ $row->kode_sos }}</td>
              <td>{{ $row->nama_pengada }}</td>
              <td>{{ $row->tgl_pengada }}</td>
              <td>{{ $row->nama_pj }}</td>
              <td>{{ $row->nomor_hp_pj }}</td>
              <td>{{ $row->nama }}</td>
              <td>{{$row->created_at}}</td>
              <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                  <input type="hidden" name="kode" id="{{$row->kode_sos}}">
                  <button type="button" tabindex="0" class="dropdown-item" id="view_skhpn" onclick="lihat_sosio('{{$row->kode_sos}}')">Edit</button>
                  <div id="del_button_user">
                    <button type="button" tabindex="0" class="dropdown-item" name="button{{ $row->id }}" value="7">Delete</button>
                  </div>
                </div>
              </td>
            </tr>
          <?php $num=$num + 1; ?>
          @endforeach
          @else
          {{Session::get('src_data')}}
          @endif
            </tbody>
          </table>
        </div>
        <div class="d-block text-center card-footer">
          <nav class aria-label="Page navigation">
            {{ $sosio->links() }}
          </nav>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('modal')
<div id="InputModal" tabindex="1" class="modal fade bd-example-modal-lg" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span id="change_title">Data Pasien</span></h4>
        <button type="button" data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body">
        <form id="form_edit" method="post">
          <div class="alert alert-danger" style="display:none"></div>
          {{ csrf_field() }}
          <div id="view_data_response">

          </div>
          <span id="message"></span><br />
          <br />
          <input type="hidden" name="action" id="action">
          <input type="hidden" name="old_name" id="old_name">
          <input type="button" name="user_button" id="skhpn_update_button" class="btn btn-info" value="Simpan Perubahan">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
