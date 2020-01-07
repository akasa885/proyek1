@extends('admin/admin')

@section('judul_header','Halaman Pengaturan Peagawai')
@section('sub_header','Ini adalah halaman pegawai BNNK Sidoarjo')
@section('icon_title')
<i class="pe-7s-leaf icon-gradient bg-mean-fruit"></i>
@endsection
@section('konten')
<div class="row">
  <div class="col-md-12">
    <div class="main-card mb-3 card">
      <div class="card-body">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <select class="form-control" id="pilihan_pegawai" name="jenis">
                @if($choice == 'asessor')
                <?php $print = 'Asessor'; ?>
                <option value="asessor" selected>Asessor</option>
                <option value="sosialisasi">Sosialisasi</option>
                @elseif($choice == 'sosialisasi')
                <?php $print = 'Sosialisasi'; ?>
                <option value="asessor">Asessor</option>
                <option value="sosialisasi" selected>Sosialisasi</option>
                @else
                <?php $print = 'Semua Pegawai'; ?>
                <option disabled selected value> -- select an option -- </option>
                <option value="asessor">Asessor</option>
                <option value="sosialisasi">Sosialisasi</option>
                @endif
              </select>
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
        <div class="card-header">{{$print}}
          <div class="btn-actions-pane-right">
              <div role="group" class="btn-group-sm btn-group">
                @if($choice == 'all')
                  <button class="active btn btn-focus" id="pegawai_all">Tampilkan Semua</button>
                @else
                  <button class="btn btn-focus" id="pegawai_all">Tampilkan Semua</button>
                @endif
              </div>
          </div>
        </div>
        <div class="table-responsive">
      @if($choice == 'asessor')
          <table class="align-middle mb-0 table table-borderless table-striped table-hover">
            <thead>
              <tr>
                <td class="text-center">#</td>
                <td>Nama</td>
                <td class="text-center">Tanggal Lahir</td>
                <td class="text-center">Alamat</td>
                <td class="text-center">Action</td>
              </tr>
            </thead>
            <tbody>
              @foreach($asessor as $row)
              <tr>
                <td class="text-center text-muted">{{$row->kode_pegawai}}</td>
                <td>
                  <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                    <div class="widget-content-left mr-3">
                      <div class="widget-content-left">
                          <img width="40" class="rounded-circle" src="{{$row->photo_loc}}" alt="">
                      </div>
                    </div>
                    <div class="widget-content-left flex2">
                      <div class="widget-heading">{{ucwords($row->nama)}}</div>
                      <div class="widget-subheading opacity-7">{{strtoupper($row->departemen)}}</div>
                    </div>
                    </div>
                  </div>
                </td>
                <td class="text-center">{{$row->birth_date}}</td>
                <td class="text-center">{{ucwords($row->distrik).', '.ucwords($row->city)}}</td>
                <td class="text-center"><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
                  <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                    <button type="button" tabindex="0" class="dropdown-item" onclick="edit_pegawai('{{$row->kode_pegawai}}')" id="view_rehab">Edit</button>
                    <button type="button" tabindex="0" id="print_pdf_rehab" class="dropdown-item" value="{{$print}}" onclick="print_pdf('{{$row->kode_pegawai}}')">Job</button>
                    <div id="del_button_user">
                      <button type="button" tabindex="0" class="dropdown-item" name="button{{ $row->id }}" value="8">Delete</button>
                    </div>
                  </div></td>
              </tr>
              @endforeach
            </tbody>
          </table>
      @elseif($choice == 'sosialisasi')
      <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
          <tr>
            <td class="text-center">#</td>
            <td>Nama</td>
            <td class="text-center">Tanggal Lahir</td>
            <td class="text-center">Alamat</td>
            <td class="text-center">Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($sosialisasi as $row)
          <tr>
            <td class="text-center text-muted">{{$row->kode_pegawai}}</td>
            <td>
              <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                <div class="widget-content-left mr-3">
                  <div class="widget-content-left">
                      <img width="40" class="rounded-circle" src="{{$row->photo_loc}}" alt="">
                  </div>
                </div>
                <div class="widget-content-left flex2">
                  <div class="widget-heading">{{ucwords($row->nama)}}</div>
                  <div class="widget-subheading opacity-7">{{strtoupper($row->departemen)}}</div>
                </div>
                </div>
              </div>
            </td>
            <td class="text-center">{{$row->birth_date}}</td>
            <td class="text-center">{{ucwords($row->distrik).', '.ucwords($row->city)}}</td>
            <td class="text-center"><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
              <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                <button type="button" tabindex="0" class="dropdown-item" onclick="edit_pegawai('{{$row->kode_pegawai}}')" id="view_rehab">Edit</button>
                <button type="button" tabindex="0" id="print_pdf_rehab" class="dropdown-item" value="{{$print}}" onclick="print_pdf('{{$row->kode_pegawai}}')">Job</button>
                <div id="del_button_user">
                  <button type="button" tabindex="0" class="dropdown-item" name="button{{ $row->id }}" value="8">Delete</button>
                </div>
              </div></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <table class="align-middle mb-0 table table-borderless table-striped table-hover">
        <thead>
          <tr>
            <td class="text-center">#</td>
            <td>Nama</td>
            <td class="text-center">Tanggal Lahir</td>
            <td class="text-center">Alamat</td>
            <td class="text-center">Action</td>
          </tr>
        </thead>
        <tbody>
          @foreach($pegawai as $row)
          <tr>
            <td class="text-center text-muted">{{$row->kode_pegawai}}</td>
            <td>
              <div class="widget-content p-0">
                <div class="widget-content-wrapper">
                <div class="widget-content-left mr-3">
                  <div class="widget-content-left">
                      <img width="40" class="rounded-circle" src="{{$row->photo_loc}}" alt="">
                  </div>
                </div>
                <div class="widget-content-left flex2">
                  <div class="widget-heading">{{ucwords($row->nama)}}</div>
                  <div class="widget-subheading opacity-7">{{strtoupper($row->departemen)}}</div>
                </div>
                </div>
              </div>
            </td>
            <td class="text-center">{{$row->birth_date}}</td>
            <td class="text-center">{{ucwords($row->distrik).', '.ucwords($row->city)}}</td>
            <td class="text-center"><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
              <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                <button type="button" tabindex="0" class="dropdown-item" onclick="edit_pegawai('{{$row->kode_pegawai}}')" id="view_rehab">Edit</button>
                <button type="button" tabindex="0" id="print_pdf_rehab" class="dropdown-item" value="{{$print}}" onclick="print_pdf('{{$row->kode_pegawai}}')">Job</button>
                <div id="del_button_user">
                  <button type="button" tabindex="0" class="dropdown-item" name="button{{ $row->id }}" value="8">Delete</button>
                </div>
              </div></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif
        </div>
        <div class="d-block text-center card-footer">
          <button id="user-input-add" class="btn-wide btn btn-info" type="button" name="button">Tambah</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('modal')
<div id="InputModal" tabindex="1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><span id="change_title">Add New Type</span></h4>
        <button type="button" data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body" id="dynamic-content">
        <form id="form_create" method="post" enctype="multipart/form-data">
          <div class="alert alert-danger" style="display:none"></div>
          {{ csrf_field() }}
          <div class="form-row">
            <div class="col-md-4">
              <img src="/assets/images/avatars/bnn_user.png" width="100" class="img-fluid" border="2" alt="">
            </div>
            <div class="col-md-6">
              <label for="textUpload" class="">Upload foto anda (Maks. 7mb)</label>
              <input type="file" name="file" class="form-control">
            </div>
          </div>
          <p>No user
          <input type="text" class="form-control" name="no_user" value="" readonly="true"></p>
          <p>Masukkan Nama Lengkap
          <input type="text" name="nama_lengkap" id="nama_lengkap" required placeholder="Nama anda" class="form-control"></p>
          <p>Masukkan Departemen Anda
          <select class="form-control" name="departemen">
            <option value="p2m">P2M</option>
            <option value="rehab">Rehab</option>
            <option value="umum">Umum</option>
            <option value="berantas">Berantas</option>
          </select> </p>
          <p>Masukkan Bagian Anda
          <select class="form-control" name="bagian">
            <option value="asessor">Asessor</option>
            <option value="sosialisasi">Sosialisasi</option>
            <option value="penyidik">Penyidik</option>
            <option value="none">-</option>
          </select> </p>
          <div class="form-row">
            <div class="col-md-6">
              <div class="position-relative form-group">
                <label for="tanggal_lahir" class="">Masukkan Tanggal Lahir</label>
                <input type="number" class="form-control" min="1" max="31" onkeyup="day_check(this)" name="tanggal" placeholder="tanggal" id="birth_day">
              </div>
            </div>
            <div class="col-md-6">
              <div class="position-relative form-group">
                <label for="tanggal_lahir" class="">:</label>
                <input type="number" min="1" max="12" class="form-control" onkeyup="month_check(this)" name="bulan" placeholder="bulan" id="birth_month">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-6">
              <div class="position-relative form-group">
                <label for="kelurahan" class="">Kelurahan </label>
                <input type="text" class="form-control" name="kelurahan" placeholder="kelurahan" id="kelurahan">
              </div>
            </div>
            <div class="col-md-6">
              <div class="position-relative form-group">
                <label for="kota" class="">Kota/Kabupaten</label>
                <input type="text" class="form-control" name="city" placeholder="kota/kabupaten" id="city">
              </div>
            </div>
          </div>
          <span id="message"></span><br />
          <br />
          <input type="hidden" name="action" id="action">
          <input type="hidden" name="old_name" id="old_name">
          <input type="submit" name="pegawai_button" id="pegawai_create_button" class="btn btn-info" value="Create">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
