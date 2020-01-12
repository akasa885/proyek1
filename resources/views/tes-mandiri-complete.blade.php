<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Pendaftaran Tes Urine Mandiri Berhasil!!</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <script type="text/javascript" src="/assets/js/jquery.min.js"></script>
  </head>
  <body>
    <div class="container">
      <h1>Pendaftaran Berhasil</h1>
      <h3>Nomor Registrasi anda adalah :</h3>
      <p style="color: red; font-size: 30px">{{ $no_reg }}</p>
      <p>Harap untuk menunggu konfirmasi dari pihak kami. Terima Kasih</p>
      <button id="back" class="btn btn-primary" type="button" name="button">Halaman Utama</button>
    </div>
    <script type="text/javascript">
      $(document).on('click', '#back', function() {
        window.location.assign('/');
      });
    </script>
  </body>
</html>
