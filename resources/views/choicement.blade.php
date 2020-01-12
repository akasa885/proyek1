  <!DOCTYPE html>
  <html lang="en" dir="ltr">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
      <link href="https://fonts.googleapis.com/css?family=Ubuntu:500,700&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
      <link rel="stylesheet" href="/assets/css/profil_custom.css">
      <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
      <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/assets/js/dash.js"></script>
      <title>Pilih {{ucwords(Session::get('type'))}}</title>
    </head>
    <body>
      <?php $count = 0;
      $type = Session::get('type'); ?>
      <div class="cobaparal">
        <div class="paral-form paral-layer z-base form-s-add">
          <div id="navbar" class="topnav parallax__layer-top bg-biru3"><!--Bagian Pembungkus nav-->
            <div class="menu">
              <a href="/"><li class="active">BNN Kabupaten Sidoarjo</li></a>
            </div>
          </div>
          <div class="cover-form z-fore">
            <div class="container">
              <br>
              @if(session('alert'))
              <h3 class="mt-5" style="color:red">Terjadi Kesalahan</h3>
              @endif
              @if(session('kode'))
              <h3 class="mt-5">ID : {{Session::get('kode')}}</h3>
              @else
              <br/><br/><br/>
              <div class="row justify-content-center mt-4">
                <h4>Harap Lakukan Pendaftaran Dahulu! <br>Laman Ini Tidak Dapat Diakses</h4>
              </div>
              @endif
              @if($type == 'sosialisasi')
              @foreach($sosialisasi as $row)
                @if($count == 0)
                <div class="row justify-content-center mt-4">
                @elseif($count == 4)
                <?php $count = 0; ?>
                <div class="row justify-content-center mt-3">
                @endif
                <div class="col-md-3 mt-4">
              		    <div class="card profile-card-5">
              		        <div class="card-img-block">
              		            <img class="card-img-top" src="{{$row->photo_loc}}" alt="Card image cap">
              		        </div>
                              <div class="card-body pt-0">
                              <h5 class="card-title">{{$row->nama}}</h5>
                              <p class="card-text">{{$row->birth_date}}<br>{{$row->distrik}}, {{$row->city}} </p>
                              <div class="text-center">
                                <a href="{{URL::route('pilih_pegawai',[Session::get('kode'),$row->kode_pegawai])}}" class="btn btn-primary">Pilih</a>
                              </div>
                            </div>
                          </div>
              		</div>
                  <?php $count++ ; ?>
                @if($count == 3)
                <?php $count = 4; ?>
                </div>
                @endif
              @endforeach
              @if($count < 3)
              <?php $count = 1; ?>
              </div>
              @endif

              @elseif($type == 'asessor')

              @foreach($asessor as $row)
              @if($count == 0)
              <div class="row justify-content-center mt-4">
              @elseif($count == 4)
              <?php $count = 0; ?>
              <div class="row justify-content-center mt-3">
              @endif
              <div class="col-md-3 mt-4">
                    <div class="card profile-card-5">
                        <div class="card-img-block">
                            <img class="card-img-top" src="{{$row->photo_loc}}" alt="Card image cap">
                        </div>
                            <div class="card-body pt-0">
                            <h5 class="card-title">{{$row->nama}}</h5>
                            <p class="card-text">{{$row->birth_date}}<br>{{$row->distrik}}, {{$row->city}} </p>
                            <div class="text-center">
                              <a href="{{URL::route('pilih_pegawai',[Session::get('kode'),$row->kode_pegawai])}}" class="btn btn-primary">Pilih</a>
                            </div>
                          </div>
                        </div>
                </div>
                <?php $count++ ; ?>
              @if($count == 3)
              <?php $count = 4; ?>
              </div>
              @endif
              @endforeach
              @if($count < 3)
              <?php $count = 1; ?>
              </div>
              @endif

              @elseif($type == 'rehab')

              @foreach($rehab as $row)
              @if($count == 0)
              <div class="row justify-content-center mt-4">
              @elseif($count == 4)
              <?php $count = 0; ?>
              <div class="row justify-content-center mt-3">
              @endif
              <div class="col-md-3 mt-4">
                    <div class="card profile-card-5">
                        <div class="card-img-block">
                            <img class="card-img-top" src="{{$row->photo_loc}}" alt="Card image cap">
                        </div>
                            <div class="card-body pt-0">
                            <h5 class="card-title">{{$row->nama}}</h5>
                            <p class="card-text">{{$row->birth_date}}<br>{{$row->distrik}}, {{$row->city}} </p>
                            <div class="text-center">
                              <a href="{{URL::route('pilih_pegawai',[Session::get('kode'),$row->kode_pegawai])}}" class="btn btn-primary">Pilih</a>
                            </div>
                          </div>
                        </div>
                </div>
                <?php $count++ ; ?>
              @if($count == 3)
              <?php $count = 4; ?>
              </div>
              @endif
              @endforeach
              @if($count < 3)
              <?php $count = 1; ?>
              </div>
              @endif

              @endif
            </div>
          </div>
        </div>
      </div>
    </body>
  </html>
