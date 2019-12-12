<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>@yield('judul')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/assets/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="/assets/js/form.js"></script>
    <script type="text/javascript" src="/assets/js/dynamic.js"></script>
  </head>
  <body>
      <div class="cobaparal"><!--Bagian Pembungkus semua-->
        <div id="change_h" class="paral-form paral-layer z-base">
          <div id="navbar" class="topnav parallax__layer-top z-base bg-biru3"><!--Bagian Pembungkus nav-->
            <div class="menu">
              <a href="/"><li class="active">BNN Kabupaten Sidoarjo</li></a>
            </div>
          </div>
          <br>
          <br>
          <br>
          <div class="cover-form z-fore">
            <div class="container"><!--Bagian Pembungkus form-->
              <h2 class="text-center font_ubuntu">@yield('head_halaman')</h2>
              <div class="row justify-content-left">
                  <div class="col-lg-8">
                      <div class="card mt-5">
                          <div class="card-body">
                            <p style="color:red; font-size: 18px">Harap membaca bantuan pendaftaran*</p>
              @yield('konten')
                          </div>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="card-mt-3">
                        <div class="card-body">
                          <br>
                          <h4 class="text-center">@yield('judul_tambahan')</h4>
              @yield('attention')
                        </div>
                      </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="kaki z-bback">
            <div class="isi">
              © 2019 BNN Kabupaten Sidoarjo. Created by Mahasiswa UPN JATIM SURABAYA
            </div>
        </div>
      </div>
  </body>
</html>
