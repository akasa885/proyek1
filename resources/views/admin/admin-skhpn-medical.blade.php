@extends('admin/admin')

@section('judul_header','Halaman Daftar SKHPN')
@section('sub_header','Ini adalah halaman SKHPN BNNK Sidoarjo')
@section('icon_title')
<i class="pe-7s-wristwatch icon-gradient bg-mean-fruit"></i>
@endsection
@section('konten')
<div class="row">
  <div class="col-md-12">
    <div class="main-card mb-3 card">
      <div class="card-body">
        <div class="card-header-tab card-header">
          <div class="card-header-title" id="title_tabel">
              <i class="header-icon lnr-rocket icon-gradient bg-tempting-azure"> </i>
              Medical Check @if(Session::get('success'))<span style="color:green;">{{Session::get('success')}}</span>@endif
          </div>
          <div class="btn-actions-pane-right">
              <div class="nav">
                  <a href="/dpanel/serv/skhpn/report" class="border-0 btn-pill btn-wide btn-transition active btn btn-outline-alternate">Kembali</a>
              </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-8">
            @foreach($data as $row)
              <form action="/skhpn/medical/store" method="post">
                {{csrf_field()}}
                <div class="position-relative row form-group">
                  <label for="reg_no" class="col-sm-2 col-form-label">Register No.</label>
                  <div class="col-sm-10">
                    <input name="reg_num" readonly="true" type="text" class="form-control" value="{{$row->kode_registrasi}}">
                  </div>
                </div>
                <div class="position-relative row form-group">
                  <label for="nama_lengkap" class="col-sm-2 col-form-label">Full Name</label>
                  <div class="col-sm-10">
                    <input name="full_name" readonly="true" type="text" class="form-control" value="{{$row->nama_lengkap}}">
                  </div>
                </div>
            @endforeach
          </div>
        </div>
        <hr color="blue"/>
        @if($klinik != '')
        @foreach($klinik as $row)

        <div class="row">
          <div class="col-md-8">
            <div class="position-relative row form-group">
              <label for="sadar" class="col-sm-3 col-form-label">Kesadaran</label>
              <div class="col-sm-5">
                <div>
                  @if($row->kesadaran == '1')
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" checked type="radio" name="kesadaran" id="sadar1" value="1">
                    <label class="form-check-label" for="sadar1">Baik</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kesadaran" id="sadar2" value="2">
                    <label class="form-check-label" for="sadar2">Terganggu</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kesadaran" id="sadar1" value="1">
                    <label class="form-check-label" for="sadar1">Baik</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" checked type="radio" name="kesadaran" id="sadar2" value="2">
                    <label class="form-check-label" for="sadar2">Terganggu</label>
                  </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="adaan_umum" class="col-sm-3 col-form-label">Keadaan Umum</label>
              <div class="col-sm-5">
                <div>

                  @if($row->keadaan_umum == '1')
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" checked type="radio" name="adaan_umum" id="umum1" value="1">
                    <label class="form-check-label" for="umum1">Baik</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adaan_umum" id="umum2" value="2">
                    <label class="form-check-label" for="umum2">Cukup</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adaan_umum" id="umum3" value="3">
                    <label class="form-check-label" for="umum3">Kurang</label>
                  </div>
                  @elseif($row->keadaan_umum == '2')
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adaan_umum" id="umum1" value="1">
                    <label class="form-check-label" for="umum1">Baik</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" checked type="radio" name="adaan_umum" id="umum2" value="2">
                    <label class="form-check-label" for="umum2">Cukup</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adaan_umum" id="umum3" value="3">
                    <label class="form-check-label" for="umum3">Kurang</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adaan_umum" id="umum1" value="1">
                    <label class="form-check-label" for="umum1">Baik</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adaan_umum" id="umum2" value="2">
                    <label class="form-check-label" for="umum2">Cukup</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" checked type="radio" name="adaan_umum" id="umum3" value="3">
                    <label class="form-check-label" for="umum3">Kurang</label>
                  </div>
                  @endif

                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="tekanan_Darah" class="col-sm-3 col-form-label">Tekanan Darah</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input required type="text" name="tekanan_darah" class="form-control" value="{{$row->tekananDarah}}">
                  <div class="input-group-append"><span class="input-group-text">mmHg</span></div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="nadi" class="col-sm-3 col-form-label">Nadi</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input required type="text" value="{{$row->nadi}}" name="nadi" class="form-control">
                  <div class="input-group-append"><span class="input-group-text">x/menit</span></div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="pernapasan" class="col-sm-3 col-form-label">Pernapasan</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input required type="text" name="pernapasan" class="form-control" value="{{$row->breath}}">
                  <div class="input-group-append"><span class="input-group-text">x/menit</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr color="blue" />
        <div class="row">
          <div class="col-md-8">

                  @if($row->medicineUse == '1')
            <div class="position-relative row form-group">
              <label for="using_drug" class="col-sm-3 col-form-label">Penggunaan Obat-obatan</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="used_drug" id="used1" value="1">
                    <label class="form-check-label" for="used1">Ada</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="used_drug" id="used2" value="2">
                    <label class="form-check-label" for="used2">Tidak Ada</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="jenis_obat" class="col-sm-3 col-form-label">Jenis Obat</label>
              <div class="col-sm-5">
                <input name="jenis_obat" type="text" placeholder="JIka Ada obat yang digunakan" class="form-control" value="{{$row->medicineType}}">
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="drug_from" class="col-sm-3 col-form-label">Asal Obat</label>
              <div class="col-sm-5">
                <div>
                  @if($row->medicineFrom == '1')
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="drug_form" id="from1" value="1">
                    <label class="form-check-label" for="from1">Resep Dokter</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="drug_form" id="from2" value="2">
                    <label class="form-check-label" for="from2">Jual Bebas</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="drug_form" id="from1" value="1">
                    <label class="form-check-label" for="from1">Resep Dokter</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="drug_form" id="from2" value="2">
                    <label class="form-check-label" for="from2">Jual Bebas</label>
                  </div>
                  @endif
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="last_drink" class="col-sm-3 col-form-label">Terakhir Minum</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input type="text" name="last_drink" class="form-control" value="{{$row->lastDrink}}">
                  <div class="input-group-append"><span class="input-group-text">Hari Lalu</span></div>
                </div>
              </div>
            </div>
                  @else
            <div class="position-relative row form-group">
              <label for="using_drug" class="col-sm-3 col-form-label">Penggunaan Obat-obatan</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="used_drug" id="used1" value="1">
                    <label class="form-check-label" for="used1">Ada</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="used_drug" id="used2" value="2">
                    <label class="form-check-label" for="used2">Tidak Ada</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="jenis_obat" class="col-sm-3 col-form-label">Jenis Obat</label>
              <div class="col-sm-5">
                <input name="jenis_obat" type="text" placeholder="JIka Ada obat yang digunakan" class="form-control">
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="drug_from" class="col-sm-3 col-form-label">Asal Obat</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="drug_form" id="from1" value="1">
                    <label class="form-check-label" for="from1">Resep Dokter</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="drug_form" id="from2" value="2">
                    <label class="form-check-label" for="from2">Jual Bebas</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="last_drink" class="col-sm-3 col-form-label">Terakhir Minum</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input type="text" name="last_drink" class="form-control">
                  <div class="input-group-append"><span class="input-group-text">Hari Lalu</span></div>
                </div>
              </div>
            </div>
                  @endif
          </div>
        </div>

<hr color="blue" />
        <div class="row">
          <div class="col-md-8">
            <div class="position-relative row form-group">
              <label for="amphetamine" class="col-sm-3 col-form-label">Amphetamine(AMP)</label>
              <div class="col-sm-5">
                <div>

                  @if($row->rAmphetamine == '1')
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="amphe" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="amphe" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="amphe" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="amphe" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @endif

                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="methaphetamine" class="col-sm-3 col-form-label">Methaphetamine</label>
              <div class="col-sm-5">
                <div>

                  @if($row->rMethaphetamine == '1')
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="metha" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="metha" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="metha" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="metha" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @endif

                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="marijuana" class="col-sm-3 col-form-label">Marijuana(THC)</label>
              <div class="col-sm-5">
                <div>

                  @if($row->rTHC == '1')
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="thc" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="thc" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="thc" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="thc" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @endif

                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="morphin" class="col-sm-3 col-form-label">Morphin</label>
              <div class="col-sm-5">
                <div>

                  @if($row->rMorphin == '1')
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="morph" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="morph" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="morph" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="morph" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @endif

                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="benzodiazepine" class="col-sm-3 col-form-label">Benzodiazepine</label>
              <div class="col-sm-5">
                <div>

                  @if($row->rBenzodiazepine == '1')
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="benzo" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="benzo" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="benzo" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="benzo" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @endif

                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="cocaine" class="col-sm-3 col-form-label">Cocaine</label>
              <div class="col-sm-5">
                <div>

                  @if($row->rCocaine == '1')
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="coca" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="coca" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="coca" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="coca" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                  @endif

                </div>
              </div>
            </div>
          </div>
        </div>

<hr color="blue" />
        <div class="row">
          <div class="col-md-8">
            <div class="position-relative row form-group">
              <label for="tgl_periksa" class="col-sm-3 col-form-label">Tanggal Medis</label>
              <div class="col-sm-5">
                <div class="input-group date datepicker" data-provide="datepicker">
                  <input type="text" placeholder="Mulai Tanggal" value="{{ $row->medicalDate }}" id="start_tgl" name="tgl_medis" class="form-control" value="{{ old('tgl_cari_start') }}">
                  <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="pukul" class="col-sm-3 col-form-label">Jam</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input required type="text" value="{{$row->medicalTime}}" name="pukul_medis" class="form-control">
                  <div class="input-group-append"><span class="input-group-text">WIB</span></div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="tempat" class="col-sm-3 col-form-label">Tempat</label>
              <div class="col-sm-5">
                <input required name="nama_klinik" value="{{$row->medicalLocation}}" type="text" class="form-control">
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="hasil" class="col-sm-3 col-form-label">Hasil MEdis</label>
              <div class="col-sm-5">
                <div>

                  @if($row->medicalResult == '1')
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="hasiL_m" id="hsl1" value="1">
                    <label class="form-check-label" for="hsl1">Terindikasi</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hasil_m" id="hsl2" value="2">
                    <label class="form-check-label" for="hsl2">Tidak Terindikasi</label>
                  </div>
                  @else
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hasiL_m" id="hsl1" value="1">
                    <label class="form-check-label" for="hsl1">Terindikasi</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input checked class="form-check-input" type="radio" name="hasil_m" id="hsl2" value="2">
                    <label class="form-check-label" for="hsl2">Tidak Terindikasi</label>
                  </div>
                  @endif

                </div>
              </div>
            </div>
          </div>
        </div>

        @endforeach

        @else
        <div class="row">
          <div class="col-md-8">
            <div class="position-relative row form-group">
              <label for="sadar" class="col-sm-3 col-form-label">Kesadaran</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kesadaran" id="sadar1" value="1">
                    <label class="form-check-label" for="sadar1">Baik</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="kesadaran" id="sadar2" value="2">
                    <label class="form-check-label" for="sadar2">Terganggu</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="adaan_umum" class="col-sm-3 col-form-label">Keadaan Umum</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adaan_umum" id="umum1" value="1">
                    <label class="form-check-label" for="umum1">Baik</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adaan_umum" id="umum2" value="2">
                    <label class="form-check-label" for="umum2">Cukup</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="adaan_umum" id="umum3" value="3">
                    <label class="form-check-label" for="umum3">Kurang</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="tekanan_Darah" class="col-sm-3 col-form-label">Tekanan Darah</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input required type="text" name="tekanan_darah" class="form-control">
                  <div class="input-group-append"><span class="input-group-text">mmHg</span></div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="nadi" class="col-sm-3 col-form-label">Nadi</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input required type="text" name="nadi" class="form-control">
                  <div class="input-group-append"><span class="input-group-text">x/menit</span></div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="pernapasan" class="col-sm-3 col-form-label">Pernapasan</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input required type="text" name="pernapasan" class="form-control">
                  <div class="input-group-append"><span class="input-group-text">x/menit</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <hr color="blue" />
        <div class="row">
          <div class="col-md-8">
            <div class="position-relative row form-group">
              <label for="using_drug" class="col-sm-3 col-form-label">Penggunaan Obat-obatan</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="used_drug" id="used1" value="1">
                    <label class="form-check-label" for="used1">Ada</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="used_drug" id="used2" value="2">
                    <label class="form-check-label" for="used2">Tidak Ada</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="jenis_obat" class="col-sm-3 col-form-label">Jenis Obat</label>
              <div class="col-sm-5">
                <input name="jenis_obat" type="text" placeholder="JIka Ada obat yang digunakan" class="form-control">
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="drug_from" class="col-sm-3 col-form-label">Asal Obat</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="drug_form" id="from1" value="1">
                    <label class="form-check-label" for="from1">Resep Dokter</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="drug_form" id="from2" value="2">
                    <label class="form-check-label" for="from2">Jual Bebas</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="last_drink" class="col-sm-3 col-form-label">Terakhir Minum</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input type="text" name="last_drink" class="form-control">
                  <div class="input-group-append"><span class="input-group-text">Hari Lalu</span></div>
                </div>
              </div>
            </div>
          </div>
        </div>

<hr color="blue" />
        <div class="row">
          <div class="col-md-8">
            <div class="position-relative row form-group">
              <label for="amphetamine" class="col-sm-3 col-form-label">Amphetamine(AMP)</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="amphe" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="amphe" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="methaphetamine" class="col-sm-3 col-form-label">Methaphetamine</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="metha" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="metha" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="marijuana" class="col-sm-3 col-form-label">Marijuana(THC)</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="thc" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="thc" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="morphin" class="col-sm-3 col-form-label">Morphin</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="morph" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="morph" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="benzodiazepine" class="col-sm-3 col-form-label">Benzodiazepine</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="benzo" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="benzo" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="cocaine" class="col-sm-3 col-form-label">Cocaine</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="coca" id="used1" value="1">
                    <label class="form-check-label" for="used1">Positif</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="coca" id="used2" value="2">
                    <label class="form-check-label" for="used2">Negatif</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

<hr color="blue" />
        <div class="row">
          <div class="col-md-8">
            <div class="position-relative row form-group">
              <label for="tgl_periksa" class="col-sm-3 col-form-label">Tanggal Medis</label>
              <div class="col-sm-5">
                <div class="input-group date datepicker" data-provide="datepicker">
                  <input type="text" placeholder="Mulai Tanggal" value="{{ $date }}" id="start_tgl" name="tgl_medis" class="form-control" value="{{ old('tgl_cari_start') }}">
                  <div class="input-group-addon">
                      <span class="glyphicon glyphicon-th"></span>
                  </div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="pukul" class="col-sm-3 col-form-label">Jam</label>
              <div class="col-sm-5">
                <div class="input-group">
                  <input required type="text" name="pukul_medis" class="form-control">
                  <div class="input-group-append"><span class="input-group-text">WIB</span></div>
                </div>
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="tempat" class="col-sm-3 col-form-label">Tempat</label>
              <div class="col-sm-5">
                <input required name="nama_klinik" type="text" class="form-control">
              </div>
            </div>
            <div class="position-relative row form-group">
              <label for="hasil" class="col-sm-3 col-form-label">Hasil MEdis</label>
              <div class="col-sm-5">
                <div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hasil_m" id="hsl1" value="1">
                    <label class="form-check-label" for="hsl1">Terindikasi</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="hasil_m" id="hsl2" value="2">
                    <label class="form-check-label" for="hsl2">Tidak Terindikasi</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        @endif

        <div class="d-block text-center card-footer">
          <button type="submit" name="button" class="btn btn-info">Simpan</button>
          <button type="button" class="btn btn-success" name="button">Print</button>
          <button type="reset" name="button" class="btn btn-light">Reset</button>
        </div>
        </form>
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
