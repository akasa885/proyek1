@extends('admin/admin')

@section('judul_header','Halaman Pengaturan User')
@section('sub_header','Ini adalah halaman user BNNK Sidoarjo')
@section('icon_title')
<i class="pe-7s-users icon-gradient bg-mean-fruit"></i>
@endsection
@section('konten')
<div class="col-md-12">
  <div class="main-card mb-3 card">
    <div class="card-body">
      <h2 class="card-title">Daftar User</h2>
      <div class="table-responsive">
        <table class="mb-0 table table-striped">
          <thead>
            <tr>
              <td>#</td>
              <td>Username</td>
              <td>Created_at</td>
              <td>Integritas</td>
              <td>Status</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <?php $num = 1; ?>
            @foreach($data as $row)
            <tr>
              <td>{{ $num }}</td>
              <td>{{ $row->username }}</td>
              <td>{{ $row->created_at }}</td>
              <td>{{ $row->integritas }}</td>
              <td>{{ $row->status }}</td>
              <td> <button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-alternate">Action</button>
                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
                  @if($row->status == 'Tidak Aktif')
                  <button type="button" tabindex="0" class="dropdown-item">Aktif</button>
                  @elseif($row->status == 'Aktif')
                  <button type="button" tabindex="0" class="dropdown-item">Non Aktif</button>
                  @endif
                  <button type="button" tabindex="0" class="dropdown-item">Delete</button>
                </div></td>
            </tr>
            <?php $num=$num + 1; ?>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="d-block text-center card-footer">
        <button id="user-input-add" class="btn-wide btn btn-info" type="button" name="button">Tambah</button>
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
        <h4 class="modal-title"><span id="change_title">Create User</span></h4>
        <button type="button" data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body">
        <form id="form_create" method="post">
          <div class="alert alert-danger" style="display:none"></div>
          {{ csrf_field() }}
          <p>Enter Username
          <input type="text" name="user_name" id="user_name" required placeholder="username" class="form-control"></p>
          <p>Enter Password
          <input type="password" name="pasword" id="password" required placeholder="password" class="form-control"> </p>
          <p>Confirm Password
          <input type="password" name="confirm_password" required placeholder="confirmasi password" id="confirm_password" class="form-control"></p>
          <p>Integritas
          <select class="form-control" name="integritas">
            <option value="admin">Admin</option>
            <option value="skhpn">SKHPN Admin</option>
            <option value="p2m">P2M</option>
            <option value="rehab">Rehabilitasi</option>
            <option value="pengaduan">Pengaduan</option>
          </select> </p>
          <span id="message"></span><br />
          <br />
          <input type="hidden" name="action" id="action">
          <input type="hidden" name="old_name" id="old_name">
          <input type="button" name="user_button" id="user_create_button" disabled class="btn btn-info" value="Create">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
