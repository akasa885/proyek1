@extends('admin/admin')

@section('judul_header','Halaman Pengaturan Suku')
@section('sub_header','Ini adalah halaman Suku BNNK Sidoarjo')
@section('icon_title')
<i class="pe-7s-wristwatch icon-gradient bg-mean-fruit"></i>
@endsection
@section('konten')
<div class="col-md-12">
  <div class="main-card mb-3 card">
    <div class="card-body">
      <h2 class="card-title">Daftar Suku</h2>
      <div class="table-responsive">
        <table class="mb-0 table table-striped">
          <thead>
            <tr>
              <td>#</td>
              <td>Suku</td>
              <td>Created_at</td>
              <td>Dibuat Oleh</td>
              <td>Action</td>
            </tr>
          </thead>
          <tbody>
            <?php $num = 1; ?>
            @foreach($data as $row)
            <tr>
              <td>{{ $num }}</td>
              <td>{{ $row->nama_suku }}</td>
              <td>{{ $row->created_at }}</td>
              <td>{{ $row->add_by }}</td>
              <td id="del_button_user"><button type="button" class="mb-2 mr-2 btn-transition btn btn-outline-danger" name="button{{ $row->id }}" value="4">Hapus</button></td>
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
        <h4 class="modal-title"><span id="change_title">Add New Tribe</span></h4>
        <button type="button" data-dismiss="modal" class="close">&times;</button>
      </div>
      <div class="modal-body">
        <form id="form_create" method="post">
          <div class="alert alert-danger" style="display:none"></div>
          {{ csrf_field() }}
          <p>Enter Tribe Name
          <input type="text" name="suku_name" id="suku_name" required placeholder="Nama Suku" class="form-control"></p>
          <span id="message"></span><br />
          <br />
          <input type="hidden" name="action" id="action">
          <input type="hidden" name="old_name" id="old_name">
          <input type="button" name="suku_button" id="suku_create_button" class="btn btn-info" value="Create">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection
