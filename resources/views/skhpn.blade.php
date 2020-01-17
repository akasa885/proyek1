@extends('fmaster')

@section('judul','Permintaan SKHPN')
@section('head_halaman','Form Tes Urine')

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
                            <form action="/proses/skhpn" method="post">
                                {{ csrf_field() }}
                                <input id="identiti" type="hidden" name="identiti" value="skhpn">
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
                                  <label for="jenis_kelamin">Jenis Kelamin</label>
                                  <select class="form-control" name="gender">
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea class="form-control" name="address" rows="3">{{ old('address') }}</textarea>
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
                                  <label for="email">Alamat Email</label>
                                  <input class="form-control" type="email" name="alamat_email" value="{{ old('alamat_email') }}">
                                </div>
                                <div class="form-group">
                                    <label for="keperluan">Keperluan</label>
                                    <input class="form-control" type="text" name="keperluan" value="{{ old('keperluan') }}">
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
@foreach($hint as $row)
<div style="white-space: pre-wrap">
{{$row->paragraph_hint}}
</div>
@endforeach
@endsection
