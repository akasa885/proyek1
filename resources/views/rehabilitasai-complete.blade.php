<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pendaftaran Rehab Berhasil!!</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h1>Pendaataan Berhasil</h1>
      <h3>Terdaftar dengan nomor registrasi :</h3>
      <p style="color: red; font-size: 30px">{{ $no_reg }}</p>
      <p>Terima Kasih telah mengisi pendataan kami dalam layanan Rehabilitasi BNN Kabupaten Sidoarjo.</p>
      <h2>Kami tunggu anda..</h2>
      <button id="back" class="btn btn-primary" type="button" name="button">Halaman Utama</button>
    </div>
    <script type="text/javascript">
      $(document).on('click', '#back', function() {
        window.location.assign('/');
      });
    </script>
  </body>
</html>
