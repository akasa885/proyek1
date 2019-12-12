<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/dash.js"></script>
    <title>BNNK SIDOARJO</title>
  </head>
  <body>
    <div class="cobaparal">
      @foreach($link as $row)
      <div class="paral-grup">
        <div class="header-foto paral-layer z-base">
        </div>
        <div class="container-header paral-layer tembus-best z-base">
          <span class="gg"><h1>Selamat Datang di <br/>Website Pelayanan Gratis<br/>BNN Kabupaten Sidoarjo</h1></span>
          <div class="direct-l">
            <a href="{{$row->linked_link}}">Website Berita BNN Kabupaten Sidoarjo</a>
          </div>
        </div>
        <div id="navbar" class="topnav parallax__layer-top z-base">
          <div class="menu">
            <a href="/"><li class="active">Home</li></a>
            <a href="/bnn/profil"><li>Profil</li></a>
            <div class="icon">
              <a href="{{$row->youtube}}"><li><i class="fab fa-youtube"></i></li></a>
              <a href="{{$row->facebook}}"><li><i class="fab fa-facebook-square"></i></li></a>
              <a href="{{$row->instagram}}"><li><i class="fab fa-instagram"></i></li></a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <div class="paral-grup-menu">
        <div class="w-menu1 paral-layer z-base">
        </div>
        <div class="w-menu2 paral-layer z-base">
          <div class="container-fluid">
            <div class="jumbotron jumbotron-fluid">
              <div class="container">
                <h1 class="display-4">Menu Layanan</h1>
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-lg-11">
                <div class="container-fluid">
                  <div  id="service-1" class="card pmd-card text-center mb-3 size-kartu" style="background-color: #ff4861">
        	           <div class="card-body">
                       <div class="pmd-card-icon">
                         <i class="fas fa-bullhorn"></i>
                      </div>
                      <h2 class="card-title">Pengaduan Masyarakat</h2>
                    </div>
                  </div>
                  <div id="service-2" class="card pmd-card text-center mb-3 size-kartu" style="background-color: #f8f32b">
        	           <div class="card-body">
                       <div class="pmd-card-icon">
                         <i class="fas fa-scroll"></i>
                      </div>
                      <h2 class="card-title">Permohonan Sosialisasi</h2>
                    </div>
                  </div>
                  <div id="service-3" class="card pmd-card text-center mb-3 size-kartu" style="background-color: #0adb90">
        	           <div class="card-body">
                       <div class="pmd-card-icon">
                         <i class="fas fa-scroll"></i>
                      </div>
                      <h2 class="card-title">Permohonan Rehabilitasi</h2>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-lg-11">
                <div class="container-fluid">
                  <div id="service-4" class="card pmd-card text-center mb-3 size-kartu" style="background-color: #06c6e1">
        	           <div class="card-body">
                       <div class="pmd-card-icon">
                         <i class="far fa-address-card"></i>
                      </div>
                      <h2 class="card-title">Pendaftaran Tes Urine</h2>
                    </div>
                  </div>
                  <div id="service-5" class="card pmd-card text-center mb-3 size-kartu" style="background-color: #0adb90">
        	           <div class="card-body">
                       <div class="pmd-card-icon">
                         <i class="far fa-address-card"></i>
                      </div>
                      <h2 class="card-title">Pendaftaran Tes Urine Mandiri</h2>
                    </div>
                  </div>
                    <div id="info-1" class="card pmd-card text-center mb-3 size-kartu">
          	           <div class="card-body">
                         <div class="pmd-card-icon">
                           <i class="far fa-chart-bar"></i>
                        </div>
                        <h2 class="card-title">Survey Kepuasan Pasien</h2>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class=" kaki z-back">
        <!-- Footer -->
        <footer class="page-footer font-small unique-color-dark">

          <div style="background-color: #6351ce;">


          <!-- Footer Links -->
          <div style="background-color: #514b4b">
            <div class="container text-center text-md-left mt-1">
              <!-- Grid row -->
            <div class="row mt-3">

              <!-- Grid column -->
              <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">

                <!-- Content -->
                <h6 class="text-uppercase font-weight-bold">BNNK Kabupaten Sidoarjo</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>Deskripsi Singkat Tentang Bnn sidoarjo.</p>

              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold">Products</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                  <a href="#!">MDBootstrap</a>
                </p>
                <p>
                  <a href="#!">MDWordPress</a>
                </p>
                <p>
                  <a href="#!">BrandFlow</a>
                </p>
                <p>
                  <a href="#!">Bootstrap Angular</a>
                </p>

              </div>
              <!-- Grid column -->

              <!-- Grid column -->
              <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

                <!-- Links -->
                <h6 class="text-uppercase font-weight-bold">Contact</h6>
                <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                <p>
                  <i class="fas fa-home mr-3"></i> <a href="https://www.google.com/maps/place/BNN+Kabupaten+Sidoarjo/@-7.4507097,112.7050646,15z/data=!4m5!3m4!1s0x0:0xc72c431d23eedb7!8m2!3d-7.4507097!4d112.7050646" style="color: #fff;">Jl. Perum Taman Pinang, Blok AA8, No. 1A</a> </p>
                <p>
                  <i class="fas fa-envelope mr-3"></i> bnnksidoarjo@yahoo.co.id</p>
                <p>
                  <i class="fas fa-phone mr-3"></i> (+62)31 8057972</p>
                <p>
                  <i class="fas fa-print mr-3"></i> + 01 234 567 89</p>

              </div>
              <!-- Grid column -->

            </div>
            <!-- Grid row -->
            </div>
          </div>
          <!-- Footer Links -->

          <div style="background-color: #252668;">
            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">© 2018 Copyright:
              <a href="https://mdbootstrap.com/education/bootstrap/"> MDBootstrap.com</a>
            </div>
            <!-- Copyright -->
          </div>

        </footer>
        <!-- Footer -->
      </div>

    </div>
</body>
</html>
