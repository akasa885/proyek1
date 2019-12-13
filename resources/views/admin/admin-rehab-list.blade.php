@extends('admin/admin')

@section('judul_header','Halaman Daftar Rehabilitasi')
@section('sub_header','Ini adalah halaman Rehabilitasi BNNK Sidoarjo')
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
              <select class="form-control" id="pilihan_tampil" name="jenis">
                @if($choice == 'tat')
                <option value="tat" selected>TAT</option>
                <option value="publik">Publik</option>
                @elseif($choice == 'publik')
                <option value="tat">TAT</option>
                <option value="publik" selected>Publik</option>
                @endif
              </select>
            </div>
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
                  <input type="text" placeholder="Mulai Tanggal" id="start_tgl" name="tgl_cari_start" class="form-control" value="{{ $date }}">
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
                  <button type="button" class="btn btn-info" id="cari_for_form" name="button" target="3">Cari</button>
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
      @if($choice == 'tat')
      <div class="card-body">
        <h2 class="card-title">Daftar TAT</h2>
        <div class="table-responsive">
          <table class="mb-0 table table-striped">
            <thead>
              <tr>
                <td>#</td>
                <td>Kode_register</td>
                <td>Instansi Pengaju</td>
                <td>Nama Penyidik</td>
                <td>Nama Tersangka</td>
                <td>Tanggal Pembuatan</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody id="view_result">
            <?php $num = 1; ?>
              @foreach($tat as $row)
            <tr>
              <td>{{ $num }}</td>
              <td>{{ $row->kode_registrasi }}</td>
              <td>{{ $row->instansi_pengaju }}</td>
              <td>{{$row->nama_penyidik}}</td>
              <td>{{$row->nama_tersangka}}</td>
              <td>{{$row->created_at}}</td>
              <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                  <button type="button" tabindex="0" class="dropdown-item" onclick="lihat_rehab('{{$row->kode_registrasi}}')" id="view_rehab">Edit</button>
                  <button type="button" id="print_pdf_rehab" tabindex="0" class="dropdown-item" value="{{$row->kode_registrasi}}" onclick="print_pdf('{{$row->kode_registrasi}}')">Print</button>
                  <button type="button" tabindex="0" class="dropdown-item">Delete</button>
                </div>
              </td>
            </tr>
          <?php $num=$num + 1; ?>
          @endforeach
            </tbody>
          </table>
        </div>
        <div class="d-block text-center card-footer">
          <nav class aria-label="Page navigation">
            {{ $tat->appends(['pilihan'=>'tat'])->links() }}
          </nav>
        </div>
        <div id="frame_tampil_pdf">

        </div>
      </div>
      @elseif($choice == 'publik')
      <div class="card-body">
        <h2 class="card-title">Daftar Publik</h2>
        <div class="table-responsive">
          <table class="mb-0 table table-striped">
            <thead>
              <tr>
                <td>#</td>
                <td>Kode_register</td>
                <td>NIK / No KTP</td>
                <td>Nama Ibu</td>
                <td>Nama Lengkap</td>
                <td>Tanggal Pembuatan</td>
                <td>Action</td>
              </tr>
            </thead>
            <tbody id="view_result">
              <?php $num = 1; ?>
            <tr>
              @foreach($publik as $row)
              <td>{{$num}}</td>
              <td>{{$row->kode_registrasi}}</td>
              <td>{{$row->nik_ktp}}</td>
              <td>{{$row->nama_ibu}}</td>
              <td>{{$row->nama_lengkap}}</td>
              <td>{{$row->created_at}}</td>
              <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                  <button type="button" tabindex="0" class="dropdown-item" onclick="lihat_rehab('{{$row->kode_registrasi}}')" id="view_rehab">Edit</button>
                  <button type="button" tabindex="0" id="print_pdf_rehab" class="dropdown-item" value="{{$row->kode_registrasi}}" onclick="print_pdf('{{$row->kode_registrasi}}')">Print</button>
                  <button type="button" tabindex="0" class="dropdown-item">Delete</button>
                </div>
              </td>
            </tr>
              <?php $num = $num +1; ?>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="d-block text-center card-footer">
          <nav class aria-label="Page navigation">
            {{ $publik->appends(['pilihan'=>'publik'])->links() }}
          </nav>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
@endsection
@section('modal')
<div id="InputModal" tabindex="1" class="modal fade bd-example-modal-lg" role="dialog"  aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span id="change_title">Data Klien</span></h4>
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
