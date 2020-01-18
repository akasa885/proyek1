@extends('admin/admin')

@section('judul_header','Halaman Daftar Pengaduan Masyarakat')
@section('sub_header','Ini adalah halaman Pengaduan BNNK Sidoarjo')
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
                  <button type="button" class="btn btn-info" id="cari_for_form" name="button" target="1">Cari</button>
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
        <h2 class="card-title" id="title_tabel">Daftar Pengaduan</h2>
        <div class="table-responsive text-nowrap">
          <table class="mb-0 table table-striped">
            <thead>
              <tr>
                <td>#</td>
                <td>Nama Lengkap</td>
                <td>Tanggal Lahir</td>
                <td>Nomor HP</td>
                <td>Instansi</td>
                <td>Nomor Instansi</td>
                <td>Tanggal Pembuatan</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody id="view_result">
            <?php $num = 1;?>
            @if(!session('src_data'))
              @foreach($adu as $row)
            <tr>
              <td>{{ $row->kode_registrasi }}</td>
              <td>{{ $row->fullName }}</td>
              <td>{{ $row->birth_date }}</td>
              <td>{{ $row->no_hp }}</td>
              <td>{{ $row->nama_instansi }}</td>
              <td>{{ $row->instansi_no }}</td>
              <td>{{$row->created_at}}</td>
              <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                  <input type="hidden" name="kode" id="{{$row->kode_registrasi}}">
                  <button type="button" tabindex="0" class="dropdown-item" id="view_aduan" onclick="lihat_adu('{{$row->kode_registrasi}}')">Edit</button>
                  <div id="del_button_user">
                    <button type="button" tabindex="0" class="dropdown-item" name="button{{ $row->id }}" value="5">Delete</button>
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
            {{ $adu->links() }}
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
        <h4 class="modal-title"><span id="change_title">Data Aduan</span></h4>
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
          <input type="button" name="user_button" id="aduan_update_button" class="btn btn-info" value="Simpan Perubahan">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
