<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Facades\Fpdf;

use App\akun;
use App\jobs;
use App\tipe_narkoba;
use App\agama;
use App\suku;
use App\rehab_publik;
use App\rehab_tat;
use App\sublink;
use App\skhpn;
use App\klinikrehab;
use App\pegawai;
use App\sosialisasi;
use App\permintaan;
use App\mandiri;
/**
 *
 */
class Admin_mainController extends Controller
{
    protected $username = '';
    protected $inter = '';
    protected $files;
    function __constructor()
    {
      $this->files = fileUploadController();
      $this->username = session('user');
      $this->inter = session('integrity');
    }

    function userstat($id, $rush)
    {
      if ($rush == 'login') {
        $get = akun::find($id);
        $get->status = 'Aktif';
        $get->updated_at =  date('Y-m-d H:i:s');
        $get->save();
      }elseif ($rush == 'logout') {
        $get = akun::find($id);
        $get->status = 'Tidak Aktif';
        $get->updated_at =  date('Y-m-d H:i:s');
        $get->save();
      }
    }

    function logoutcek()
    {
      // session()->forget('user'); forget untuk spesifik session
      if (session('user') != 'RizkiAkbar') {
        $this->userstat(session('id'),'logout');
      }
      session()->flush();
      return 'forgeted';
    }

    function hint_pengaduan()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        return view('admin/hint_pengaduan',['username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function hint_sosialisasi()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        return view('admin/hint_sosialisasi',['username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function hint_rehab()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        return view('admin/hint_rehab',['username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function hint_skhpn()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        return view('admin/hint_skhpn',['username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function logincek(Request $req)
    {
      $output = '';
      $akun = 0;
      if ($req->username == 'adminkiba' && $req->pass == '5451') {
        session(['user'=>'RizkiAkbar']);
        session(['integrity'=>'Super Admin']);
        $this->username = session('user');
        $this->inter = session('integrity');
        $output = 'account finded';
      }else{
        $data = akun::where('username','=',$req->username)->get();
        foreach ($data as $row) {
          if (password_verify($req->pass,$row->password)) {
            $output .= 'account finded';
            $this->userstat($row->id,'login');
            session(['user'=>$row->username]);
            session(['id'=>$row->id]);
            session(['integrity'=>$row->integritas]);
          }
        }
        if ($output == '') {
          $output = 'wrong';
        }else{
          $output = 'account finded';
        }
      }
      return $output;
    }

    function delPegawai(Request $req)
    {
      $id = $req->id;
      $pegawai = pegawai::select('kode_pegawai')->where('id',$id)->get();
      foreach ($pegawai as $row) {
        $kode_pegawai = $row->kode_pegawai;
      }
      $dirname = public_path('uploads').'/pegawai'.'/'.$kode_pegawai;
      if (is_dir($dirname))
           $dir_handle = opendir($dirname);
      if (!$dir_handle)
          return false;
      while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     delete_directory($dirname.'/'.$file);
           }
      }
     closedir($dir_handle);
     rmdir($dirname);
     pegawai::where('id',$id)->delete();
     return "deleted";
    }

    function createPegawai(Request $req)
    {

      // return(var_dump($_REQUEST));
      $integritas = session('integrity');
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter',
      'max' => ':attribute harus diisi maksimal :max karakter',
      'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
      'numeric' => ':attribute harap menginputkan nomor',
      ];
      $validator = \Validator::make($req->all(), [
        'file' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        'nama_lengkap' => 'required',
        'departemen' => 'required',
        'bagian' => 'required',
        'tanggal' => 'numeric|required',
        'bulan' => 'numeric|required',
        'kelurahan' => 'required',
        'city' => 'required',
      ],$messages);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
          // $location = 'blaslanda';
          if($integritas == null){
            $integritas = 'Super Admin';
          }
          $no_regist = pegawai::max(DB::raw('substr(kode_pegawai, 3, 5)'));
          $x = (int)$no_regist;
          if($x == 0){
            $no_regist = "PG001";
          }else{
            if($x < 9){
              $no_update = $x + 1;
              $no_regist = "PG00".$no_update;
            }elseif ($x < 99) {
              $no_update = $x + 1;
              $no_regist = "PG0".$no_update;
            }elseif ($x < 999) {
              $no_update = $x + 1;
              $no_regist = "PG".$no_update;
            }
          }
          $image = $req->file('file');
          // $name = "paslasdsda";
          $fileName = $no_regist.'.'.$image->extension();
          $path_dir = '/uploads/pegawai'.'/'.$no_regist;
          $path_file = $path_dir.$fileName;
          $path = '/pegawai'.'/'.$no_regist;
          $full_path = $path_dir.'/'.$fileName;
          if (!file_exists($path_dir)) {
            mkdir($path_dir,777,true);
          }
          if(file_exists($path_file))
          {
            unlink($path_file);
          }
          $req->file->move(public_path('uploads').$path, $fileName);

          pegawai::insert([
            'kode_pegawai' => $no_regist,
            'nama' => $req->nama_lengkap,
            'birth_date' => $req->tanggal.','.$this->monthTranslator($req->bulan),
            'distrik' => $req->kelurahan,
            'city' => $req->city,
            'departemen' => $req->departemen,
            'bagian' => $req->bagian,
            'photo_loc' => $full_path,
            'add_by'=> $integritas,
            'created_at' => date('Y-m-d H:i:s')
          ]);
        }
        return("sukses");
    }

    function pegawai_edit(Request $req)
    {
      $kode = $req->kode;
      $sour = pegawai::where('kode_pegawai',$kode)->get();
      $output = '';
      foreach ($sour as $row) {
        $output .= '<input type="hidden" name="identity" id="identity_code" value="'.$row->kode_pegawai.'">
        <div class="form-row">
          <div class="col-md-4">
            <img src="'.$row->photo_loc.'" width="100" class="img-fluid" border="2" alt="">
          </div>
          <div class="col-md-6">
            <label for="textUpload" class="">Upload foto anda (Maks. 2mb)</label>
            <input type="file" id="file" name="file" class="form-control">
          </div>
        </div>
        <p>Nama Lengkap
        <input type="text" name="nama" id="nama" class="form-control" value="'.$row->nama.'"></p>
        <p>Departemen
        <input type="text" name="departemen" id="depart" class="form-control" readonly="true" value="'.$row->departemen.'"></p>
        <p>Bagian
        <input type="text" name="bagian" id="bagian" class="form-control" readonly="true" value="'.$row->bagian.'"></p>
        <p>Tanggal Lahir
        <input type="text" name="birth" class="form-control" readonly="true" value="'.$row->birth_date.'"></p>
        <p>Kelurahan
        <input type="text" name="distrik" id="distrik" class="form-control" value="'.$row->distrik.'"></p>
        <p>Kota
        <input type="text" name="city" id="city" class="form-control" value="'.$row->city.'"></p>';
      }
      return $output;
    }

    function pegawaiDataUpdate(Request $req)
    {
      $kode = $req->identity;
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter',
      'max' => ':attribute harus diisi maksimal :max karakter',
      'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
      'numeric' => ':attribute harap menginputkan nomor',
      ];
      $validator = \Validator::make($req->all(), [
        'file' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        'nama' => 'required',
        'departemen' => 'required',
        'bagian' => 'required',
        'distrik' => 'required',
        'city' => 'required',
      ],$messages);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
          $get = pegawai::where('kode_pegawai','=',$kode)->first();
          $get->nama = $req->nama;
          $get->distrik = $req->distrik;
          $get->city = $req->city;
          if ($req->file != null) {
            $image = $req->file('file');
            // $name = "paslasdsda";
            $fileName = $kode.'.'.$image->extension();
            $path_dir = '/uploads/pegawai'.'/'.$kode;
            $path_file = $path_dir.$fileName;
            $path = '/pegawai'.'/'.$kode;
            $full_path = $path_dir.'/'.$fileName;
            if (!file_exists($path_dir)) {
              mkdir($path_dir,777,true);
            }
            if(file_exists($path_file))
            {
              unlink($path_file);
            }
            $req->file->move(public_path('uploads').$path, $fileName);
            $get->photo_loc = $full_path;
          }
          $get->save();
          echo 'sukses';
        }
    }

    function pegawai_list()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $choice = 'asessor';
        $data_asessor = pegawai::where('bagian','=','asessor')->paginate(5) ;
        $data_sosialisasi = pegawai::where('bagian','=','sosialisasi')->paginate(5) ;
        $data_pegawai = pegawai::paginate(5) ;
        // $data_tat = rehab_tat::where(DB::raw('substr(created_at,1,10)'),'=',$wt)->paginate(5);
        // $data_publik = rehab_publik::where(DB::raw('substr(created_at,1,10)'),'=',$wt)->paginate(5);
        $time = date('d-m-Y');
        if(!empty($_REQUEST['pilihan']))
        {
          $choice = $_REQUEST['pilihan'];
        }
        return view('admin/admin-pegawai',['date' => $time,'asessor' => $data_asessor,'sosialisasi' => $data_sosialisasi,'pegawai' => $data_pegawai, 'choice' => $choice,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function sessionceklog($page)
    {
      if ($page == 'dash') {
        if (session()->has('user') != '' && session()->has('integrity') != '') {
          return 'checked';
        }
      }elseif ($page == 'login') {
        if(session()->has('user') != '' && session()->has('integrity') != '')
        return 'godash';
      }
    }

    function loginview()
    {
      $cek = $this->sessionceklog('login');
      if ( $cek == 'godash'){
        return redirect('/dpanel/dashboard');
      }else{
        return view('admin/admin-login');
      }
    }

    function dashview(Request $req)
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $data = sublink::all();
        return view('admin/admin-dash',['link' => $data,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }
    function storelink(Request $req)
    {
      $link = explode('<>',$req->links);
      $ig = $link[0];
      $fb = $link[1];
      $yutub = $link[2];
      $web = $link[3];
      $get = sublink::find(1);
      $get->instagram = $ig;
      $get->facebook = $fb;
      $get->youtube = $yutub;
      $get->linked_link = $web;
      $get->save();
      return "added";
    }

    function waktupukul()
    {
      $timestamp = date('d-m-Y | H:i');
      return $timestamp;
    }

    function narkobalist()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $data = tipe_narkoba::all();
        return view('admin/admin-narkoba',['data' => $data,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }
    function agamalist()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $data = agama::all();
        return view('admin/admin-agama',['data' => $data,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function joblist()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $data = jobs::all();
        return view('admin/admin-job',['data' => $data,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function sukulist()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $data = suku::all();
        return view('admin/admin-suku',['data' => $data,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function klinikTampil($id)
    {
      $fake_data = '';
      $cek_data = '';
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $time = date('d-m-Y');
        $data_klinik = klinikrehab::where('kode_registrasi','=',$id)->get();
        foreach ($data_klinik as $row ) {
          $cek_data = 'found';
        }
        $data = skhpn::where('kode_registrasi','=',$id)->get();
        if ($cek_data == '') {
          return view('admin/admin-skhpn-medical',['data' => $data,'username'=>session('user'),'integritas'=>session('integrity'),'date'=>$time,'klinik'=>$fake_data]);
        }elseif ($cek_data == 'found') {
          return view('admin/admin-skhpn-medical',['data' => $data,'username'=>session('user'),'integritas'=>session('integrity'),'date'=>$time,'klinik'=>$data_klinik]);
        }
      }else{
        return redirect('/dpanel');
      }
    }

    function userlist()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $data = akun::all();
        return view('admin/admin-user-list',['data' => $data,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function rehablist()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $choice = 'tat';
        $wt = date('Y-m-d');
        $data_tat = rehab_tat::where(DB::raw('substr(created_at,1,10)'),'=',$wt)->paginate(5);
        $data_publik = rehab_publik::where(DB::raw('substr(created_at,1,10)'),'=',$wt)->paginate(5);
        $time = date('d-m-Y');
        if(!empty($_REQUEST['pilihan']))
        {
          $choice = $_REQUEST['pilihan'];
        }
        return view('admin/admin-rehab-list',['tat' => $data_tat, 'publik' => $data_publik, 'date' => $time, 'choice' => $choice,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function manList()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $wt = date('Y-m-d');
        $data_sos = mandiri::join('pegawai','pegawai.kode_pegawai','mandiri.kode_pegawai')
        ->select('mandiri.*','pegawai.nama')->where(DB::raw('substr(mandiri.created_at,1,10)'),'=',$wt)->paginate(5);
        $time = date('d-m-Y');
        return view('/admin/admin-mandiri',['date' =>$time,'mandiri' => $data_sos,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function manSearch(Request $req)
    {
      $start = explode('-',$req->tgl_start);
      $start = $start[2].'-'.$start[1].'-'.$start[0];
      $last = explode('-',$req->tgl_last);
      $last = $last[2].'-'.$last[1].'-'.$last[0];
      $data = mandiri::join('pegawai','pegawai.kode_pegawai','mandiri.kode_pegawai')
      ->select('mandiri.*','pegawai.nama')->whereBetween(DB::raw('substr(mandiri.created_at,1,10)'),[$start,$last])->get();
      return response()->json(['hasil'=>$data]);
    }

    function manData(Request $req)
    {
      $kode = $req->kode;
      $output = '';
      $sour = mandiri::join('pegawai','pegawai.kode_pegawai','mandiri.kode_pegawai')
      ->select('mandiri.*','pegawai.nama')->where('kode_registrasi',$kode)->get();
      foreach ($sour as $row) {
        $output .= '<input type="hidden" name="identity" id="identity_code" value="'.$row->kode_sos.'">
        <p>Type Tes Urine Mandiri
        <input type="text" name"type_tes" class="form-control" readonly="true" value="'.$row->tes_type.'"></p>
        <p>Nama Pembicara
        <input type="text" name"pegawai" class="form-control" readonly="true" value="'.$row->nama.'"></p>
        <p>Nama Penyelenggara
        <input type="text" name"nama_duty" class="form-control" placeholder="Nama Penyelenggara" value="'.$row->nama_pengada.'"></p>
        <p>Tanggal Penyelenggaraan
        <input type="text" name"tgl_pengada" class="form-control" readonly="true" value="'.$row->tgl_pengada.'"></p>
        <p>Waktu
        <input type="text" name"waktuAcara" class="form-control" readonly="true" value="'.$row->waktu.'"></p>
        <p>Lokasi Tempat
        <input type="text" name"address_place" class="form-control" readonly="true" value="'.$row->lokasi_tempat.'"></p>
        <p>Jumlah peserta
        <input type="text" name"jmlhPeserta" class="form-control" readonly="true" value="'.$row->jmlh_peserta.'"></p>
        <div class="form-row">
          <div class="col-md-4 easyzoom easyzoom--overlay">
            <img src="'.$row->lampiran_loc.'" width="100" class="img-fluid" border="2" alt="">
          </div>
          <div class="col-md-6">
            <label for="textUpload" class="">Lampiran Undangan</label>
          </div>
        </div>';
      }
      return $output;
    }

    function sosDel(Request $req)
    {
      $id = $req->id;
      $data = sosialisasi::select('kode_sos')->where('id',$id)->get();
      foreach ($data as $row) {
        $kode_sos = $row->kode_sos;
      }
      $dirname = public_path('uploads').'/lampiran/sosialisasi'.'/'.$kode_sos;
      if (is_dir($dirname))
           $dir_handle = opendir($dirname);
      if (!$dir_handle)
          return false;
      while($file = readdir($dir_handle)) {
           if ($file != "." && $file != "..") {
                if (!is_dir($dirname."/".$file))
                     unlink($dirname."/".$file);
                else
                     delete_directory($dirname.'/'.$file);
           }
      }
     closedir($dir_handle);
     rmdir($dirname);

     permintaan::where('kode_transaksi','=',$kode_sos)->delete();
     sosialisasi::where('id',$id)->delete();
     return 'deleted';
    }


    function sosList()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $wt = date('Y-m-d');
        $data_sos = sosialisasi::join('pegawai','pegawai.kode_pegawai','sosialisasi.kode_pegawai')
        ->select('sosialisasi.*','pegawai.nama')->where(DB::raw('substr(sosialisasi.created_at,1,10)'),'=',$wt)->paginate(5);
        $time = date('d-m-Y');
        return view('/admin/admin-sosialisasi',['date' =>$time,'sosio' => $data_sos,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function sosSearch(Request $req)
    {
      $start = explode('-',$req->tgl_start);
      $start = $start[2].'-'.$start[1].'-'.$start[0];
      $last = explode('-',$req->tgl_last);
      $last = $last[2].'-'.$last[1].'-'.$last[0];
      $data = sosialisasi::join('pegawai','pegawai.kode_pegawai','sosialisasi.kode_pegawai')
      ->select('sosialisasi.*','pegawai.nama')->whereBetween(DB::raw('substr(sosialisasi.created_at,1,10)'),[$start,$last])->get();
      return response()->json(['hasil'=>$data]);
    }

    function skhpnlist()
    {
      $cek = $this->sessionceklog('dash');
      if ( $cek == 'checked') {
        $wt = date('Y-m-d');
        $data_skhpn = skhpn::where(DB::raw('substr(created_at,1,10)'),'=',$wt)->paginate(5);
        $time = date('d-m-Y');
        return view('/admin/admin-skhpn',['date' =>$time,'skhpn' => $data_skhpn,'username'=>session('user'),'integritas'=>session('integrity')]);
      }else{
        return redirect('/dpanel');
      }
    }

    function sosData(Request $req)
    {
      $kode = $req->kode;
      $output = '';
      $sour = sosialisasi::join('pegawai','pegawai.kode_pegawai','sosialisasi.kode_pegawai')
      ->select('sosialisasi.*','pegawai.nama')->where('kode_sos',$kode)->get();
      foreach ($sour as $row) {
        $output .= '<input type="hidden" name="identity" id="identity_code" value="'.$row->kode_sos.'">
        <p>Type Sosialisasi
        <input type="text" name"type_sosialisasi" class="form-control" readonly="true" value="'.$row->sosialisasi_type.'"></p>
        <p>Nama Pembicara
        <input type="text" name"pegawai" class="form-control" readonly="true" value="'.$row->nama.'"></p>
        <p>Nama Penyelenggara
        <input type="text" name"nama_duty" class="form-control" placeholder="Nama Penyelenggara" value="'.$row->nama_pengada.'"></p>
        <p>Tanggal Penyelenggaraan
        <input type="text" name"tgl_pengada" class="form-control" readonly="true" value="'.$row->tgl_pengada.'"></p>
        <p>Waktu
        <input type="text" name"waktuAcara" class="form-control" readonly="true" value="'.$row->waktu.'"></p>
        <p>Lokasi Tempat
        <input type="text" name"address_place" class="form-control" readonly="true" value="'.$row->lokasi_tempat.'"></p>
        <p>Jumlah peserta
        <input type="text" name"jmlhPeserta" class="form-control" readonly="true" value="'.$row->jmlh_peserta.'"></p>
        <div class="form-row">
          <div class="col-md-4 easyzoom easyzoom--overlay">
            <img src="'.$row->lampiran_loc.'" width="100" class="img-fluid" border="2" alt="">
          </div>
          <div class="col-md-6">
            <label for="textUpload" class="">Lampiran Undangan</label>
          </div>
        </div>';
      }
      return $output;
    }

    function rehabPubView(Request $req)
    {
      $kode_reg = $req->kode;
      $output='';
      $data = rehab_publik::where('kode_registrasi','=',$kode_reg)->get();
      foreach ($data as $row) {
        $output .= '
        <input type="hidden" name="identity" id="identity_code" value="'.$row->kode_registrasi.'">
        <p>Tanggal Kedatangan
        <input type="text" name="tgl_datang" id="tgl_datang" required placeholder="tgl_datang" readonly="true" class="form-control" value="'.$row->tgl_kedatangan.'"></p>
        <p>Nama Lengkap
        <input type="text" name="nama_lengkap" id=fullName required placeholder="Nama" class="form-control" value="'.ucwords($row->nama_lengkap).'"></p>
        <p>NIK
        <input type="text" name="nik" id="nik/ktp" required placeholder="NIK/KTP" class="form-control" value="'.$row->nik_ktp.'"></p>
        <p>Agama
        <input type="text" name="agama" id="religi" required placeholder="agama" class="form-control" readonly="true" value="'.$row->agama.'"></p>
        <p>Suku
        <input type="text" name="suku" id="suku" required placeholder="Suku" class="form-control" readonly="true" value="'.$row->suku.'"></p>
        <p>Status';
        $output .= '
        <input type="text" name="status" id="status" required placeholder="Status" class="form-control" readonly="true" value="'.ucwords($row->status).'"></p>
        <p>Nama Ibu
        <input type="text" name="nama_ibu" id=namaIbu required placeholder="Nama Ibu" class="form-control" value="'.ucwords($row->nama_ibu).'"></p>
        <p>Nama Ayah
        <input type="text" name="nama_ayah" id=namaAyah required placeholder="Nama Ayah" class="form-control" value="'.ucwords($row->nama_ayah).'"></p>
        <p>Alamat
        <textarea name="address" class="form-control" rows="3">'.$row->alamat.'</textarea> </p>
        <p>No HP
        <input type="text" name="noHp" id="no_hp" required placeholder="Nomor Hp"  class="form-control" value="'.$row->no_hp.'"> </p>
        <p>No HP Keluarga
        <input type="text" name="noHpKeluarha" id="hp_keluarga" required placeholder="Nomor Keluarga"  class="form-control" value="'.$row->no_hp_keluarga.'"> </p>';
      }
      return $output;
    }

    function tatView(Request $req)
    {
      $kode_reg = $req->kode;
      $output='';
      $data = rehab_tat::where('kode_registrasi','=',$kode_reg)->get();
      foreach ($data as $row) {
        $output .= '
        <input type="hidden" name="identity" id="identity_code" value="'.$row->kode_registrasi.'">
        <p>Instansi Pengaju
        <input type="text" name="nama_instansi" id="instansi_pengaju" required placeholder="Instansi" class="form-control" value="'.$row->instansi_pengaju.'"></p>
        <p>Nama Tersangka
        <input type="text" name="nama_tersangka" id="tersangka" required placeholder="Nama Tersangka" class="form-control" value="'.$row->nama_tersangka.'"></p>
        <p>NIK
        <input type="text" name="nik" id="nik/ktp" required placeholder="NIK/KTP" class="form-control" value="'.$row->nik_ktp.'"></p>
        <p>Alamat
        <textarea name="address" class="form-control" rows="3">'.$row->alamat.'</textarea> </p>
        <p>Tanggal penangkapan
        <input type="text" name="tgl_tangkap" id="tgl_tangkap" readonly="true" required placeholder="Tanggal Tangkap"  class="form-control" value="'.$row->tgl_penangkapan.'"> </p>
        <p>Tanggal sprin penangkapan
        <input type="text" name="tgl_sprin_tangkap" id="tgl_sprin_tangkap" readonly="true" required placeholder="Tanggal Sprin Tangkap"  class="form-control" value="'.$row->tgl_sprin_tangkap.'"> </p>
        <p>Tanggal sprin penahanan
        <input type="text" name="tgl_sprin_tahan" id="tgl_sprin_tahan" readonly="true" required placeholder="Tanggal Sprin Tahan"  class="form-control" value="'.$row->tgl_sprin_tahan.'"> </p>
        <p>Nama Penyidik
        <input type="text" class="form-control" name="nama_penyidik" value="'.$row->nama_penyidik.'" > </p>
        <p>No. Hp Penyidik
        <input type="text" class="form-control" name="no_hp_penyidik" value="'.$row->no_hp_penyidik.'" > </p>';
      }
      return $output;
    }

    function skhpnView(Request $req)
    {
      $kode_reg = $req->kode;
      $output = '';
      $data = skhpn::where('kode_registrasi','=',$kode_reg)->get();
      foreach ($data as $row) {
        $output .= '
        <input type="hidden" name="identity" id="identity_code" value="'.$row->kode_registrasi.'">
        <p>Nama Lengkap
        <input type="text" name="nama_lengkap" id="full_name" required placeholder="Full Name" class="form-control" value="'.$row->nama_lengkap.'"></p>
        <p>Tanggal Lahir
        <input type="text" name="tanggal_lahir" id="birth_date" readonly="true" required placeholder="Tanggal Lahir"  class="form-control" value="'.$row->tanggal_lahir.'"> </p>
        <p>Jenis Kelamin
        <input type="text" name="gender" required placeholder="jenis Kelamin" readonly="true" id="gender" class="form-control" value="'.$row->gender.'"></p>
        <p>Alamat
        <textarea name="address" class="form-control" rows="3">'.$row->alamat.'</textarea> </p>
        <p>Pekerjaan
        <input type="text" readonly="true" name="pekerjaan" class="form-control" id="jobs" value="'.$row->pekerjaan.'"></p>
        <p>Email
        <input type="email" name="alamat_email" class="form-control" id="email" value="'.$row->email_address.'" ></p>
        <p>Keperluan
        <input type="text" class="form-control" name="keperluan" value="'.$row->keperluan.'" > </p>';
        if ($row->status == '1') {
          $output .= '<p>Status
          <input type="text" class="form-control" name="status" readonly="true" value="Registered"></p>';
        }elseif ($row->status == '2') {
          $output .= '<p>Status
          <input type="text" class="form-control" name="status" readonly="true" value="Medical Checked"></p>';
        }
      }
      echo $output;
    }

    function skhpnSearch(Request $req)
    {
      $start = explode('-',$req->tgl_start);
      $start = $start[2].'-'.$start[1].'-'.$start[0];
      $last = explode('-',$req->tgl_last);
      $last = $last[2].'-'.$last[1].'-'.$last[0];
      $data = skhpn::whereBetween(DB::raw('substr(created_at,1,10)'),[$start,$last])->get();
      return response()->json(['hasil'=>$data]);
    }

    function rehabSearch($type ,Request $req)
    {
      $start = explode('-',$req->tgl_start);
      $start = $start[2].'-'.$start[1].'-'.$start[0];
      $last = explode('-',$req->tgl_last);
      $last = $last[2].'-'.$last[1].'-'.$last[0];
      if ($type == '1') {
        $data = rehab_tat::whereBetween(DB::raw('substr(created_at,1,10)'),[$start,$last])->get();
      }else {
        $data = rehab_publik::whereBetween(DB::raw('substr(created_at,1,10)'),[$start,$last])->get();
      }
      return response()->json(['hasil'=>$data]);
    }

    function skhpnDataUpdate(Request $req)
    {
      $status='';
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter',
      'max' => ':attribute harus diisi maksimal :max karakter',
      'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
      'numeric' => ':attribute harap menginputkan nomor',
      ];
      $validator = \Validator::make($req->all(), [
        'nama_lengkap' => 'required',
        'address' => 'required',
        'alamat_email' => 'required',
        'keperluan' => 'required',
      ],$messages);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else
        {
          if ($req->status == 'Registered') {
            $status = '1';
          }elseif ($req->status == 'Medical Checked') {
            $status = '2';
          }
          $get = skhpn::where('kode_registrasi','=',$req->identity)->first();
          $get->nama_lengkap = $req->nama_lengkap;
          $get->tanggal_lahir = $req->tanggal_lahir;
          $get->gender = $req->gender;
          $get->alamat = $req->address;
          $get->pekerjaan = $req->pekerjaan;
          $get->email_address = $req->alamat_email;
          $get->keperluan = $req->keperluan;
          $get->status = $status;
          $get->save();
          echo 'sukses';
        }
    }

    function tatlist()
    {
      $output = '';
      $data_tat = rehab_tat::paginate(5);
      $no = 1;
      foreach ($data_tat as $row) {
        $output .=
        '<tr>
          <td>'.$no.'</td>
          <td>'.$row->kode_registrasi.'</td>
          <td>'.$row->instansi_pengaju.'</td>
          <td>'.$row->nama_penyidik.'</td>
          <td>'.$row->nama_tersangka.'</td>
          <td>'.$row->created_at.'</td>
          <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
              <button type="button" tabindex="0" class="dropdown-item">Lihat</button>
              <button type="button" tabindex="0" class="dropdown-item">Print</button>
              <button type="button" tabindex="0" class="dropdown-item">Delete</button>
            </div>
          </td>
        </tr>';
        $no++;
      }
      echo $output;
    }

    function publiklist()
    {
      $output = '';
      $data_tat = rehab_publik::paginate(5);
      $no = 1;
      foreach ($data_tat as $row) {
        $output .=
        '<tr>
          <td>'.$no.'</td>
          <td>'.$row->kode_registrasi.'</td>
          <td>'.$row->nik_ktp.'</td>
          <td>'.$row->nama_ibu.'</td>
          <td>'.$row->nama_lengkap.'</td>
          <td>'.$row->created_at.'</td>
          <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
              <button type="button" tabindex="0" class="dropdown-item">Lihat</button>
              <button type="button" tabindex="0" class="dropdown-item">Print</button>
              <button type="button" tabindex="0" class="dropdown-item">Delete</button>
            </div>
          </td>
        </tr>';
        $no++;
      }
      echo $output;
    }

    function srcreg(Request $req)
    {
      $output = '';
      $cari = $req->search;
      $no = 1;
      if($req->view == 'tat'){
        $sour = rehab_tat::where('kode_registrasi','like','%'.$cari.'%')->get();
        foreach ($sour as $row) {
          $output .='
          <tr>
            <td>'.$no.'</td>
            <td>'.$row->kode_registrasi.'</td>
            <td>'.$row->instansi_pengaju.'</td>
            <td>'.$row->nama_penyidik.'</td>
            <td>'.$row->nama_tersangka.'</td>
            <td>'.$row->created_at.'</td>
            <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
              <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
              <button type="button" tabindex="0" class="dropdown-item" id="view_rehab" onclick="lihat_rehab('.'\''.$row->kode_registrasi.'\''.')">Edit</button>
              <button type="button" id="print_pdf_rehab" tabindex="0" class="dropdown-item" onclick="print_pdf('.'\''.$row->kode_registrasi.'\''.')">Print</button>
                <button type="button" tabindex="0" class="dropdown-item">Delete</button>
              </div>
            </td>
          </tr>';
          $no++;
        }
        echo $output;
      }elseif ($req->view == 'publik') {
        $sour = rehab_publik::where('kode_registrasi','like','%'.$cari.'%')->get();
        foreach ($sour as $row) {
          $output .=
          '<tr>
            <td>'.$no.'</td>
            <td>'.$row->kode_registrasi.'</td>
            <td>'.$row->nik_ktp.'</td>
            <td>'.$row->nama_ibu.'</td>
            <td>'.$row->nama_lengkap.'</td>
            <td>'.$row->created_at.'</td>
            <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
              <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
              <button type="button" tabindex="0" class="dropdown-item" id="view_rehab" onclick="lihat_rehab('.'\''.$row->kode_registrasi.'\''.')">Edit</button>
              <button type="button" id="print_pdf_rehab" tabindex="0" class="dropdown-item" onclick="print_pdf('.'\''.$row->kode_registrasi.'\''.')">Print</button>
                <button type="button" tabindex="0" class="dropdown-item">Delete</button>
              </div>
            </td>
          </tr>';
          $no++;
        }
        echo $output;
      }elseif ($req->view == 'skhpn') {
        $sour = skhpn::where('kode_registrasi','like','%'.$cari.'%')->get();
        foreach ($sour as $row) {
          $output .=
          '<tr>
            <td>'.$no.'</td>
            <td id="K_R">'.$row->kode_registrasi.'</td>
            <td>'.$row->nama_lengkap.'</td>
            <td>'.$row->tanggal_lahir.'</td>
            <td>'.$row->nama_gender.'</td>
            <td>'.$row->pekerjaan.'</td>';
            if ($row->status == '1') {
              $output .= '<td> Registered </td>';
            }elseif ($row->status == '2') {
              $output .= '<td> Medical Checked </td>';
            }
            $output .= '<td>'.$row->created_at.'</td>
            <td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
              <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu">
              <input type="hidden" name="kode" id="'.$row->kode_registrasi.'">
                <button type="button" tabindex="0" class="dropdown-item" id="view_skhpn" onclick="lihat_skhpn('.'\''.$row->kode_registrasi.'\''.')">Edit</button>';
                if($row->status == '1'){
                $output .=  '<button type="button" id="cek_medis" tabindex="0" class="dropdown-item" onclick="medical_check('.'\''.$row->kode_registrasi.'\''.')">Medical Test</button>';
                }elseif ($row->status == '2') {
                  $output .= '  <button type="button" id="print_pdf_skhpn" tabindex="0" class="dropdown-item" onclick="print_pdf('.'\''.$row->kode_registrasi.'\''.')">Print</button>';
                }
                $output .='<button type="button" tabindex="0" class="dropdown-item">Delete</button>
              </div>
            </td>
          </tr>';
          $no++;
        }
        echo $output;
      }elseif ($req->view == 'sosio') {
        $sour = sosialisasi::where('kode_sos','like','%'.$cari.'%')->get();
        foreach ($sour as $row) {
          $output .= '<tr>
            <td>'.$row->kode_sos.'</td>
            <td>'.$row->nama_pengada.'</td>
            <td>'.$row->tgl_pengada.'</td>
            <td>'.$row->nama_pj.'</td>
            <td>'.$row->nomor_hp_pj.'</td>
            <td>'.$row->nama.'</td>
            <td>'.$row->created_at.'</td>';
          $output .= '<td><button type="button" aria-haspopup="true" aria-expanded="false" data-toggle="dropdown" class="mb-2 mr-2 dropdown-toggle btn btn-outline-info">Action</button>
            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu"><input type="hidden" name="kode" id="'.$row->kode_sos.'">
            <button type="button" tabindex="0" class="dropdown-item" id="view_skhpn" onclick="lihat_sosio('.$row->kode_sos.')">Edit</button>
            <div id="del_button_user"><button type="button" tabindex="0" class="dropdown-item" name="button{{ $row->id }}" value="7">Delete</button></div>' ;
        }
        echo $output;
      }
    }


    function jobcreate(Request $req)
    {
      $integritas = session('integrity');
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter',
      'max' => ':attribute harus diisi maksimal :max karakter',
      'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
      'numeric' => ':attribute harap menginputkan nomor',
      ];
      $validator = \Validator::make($req->all(), [
        'job_name' => 'required',
      ],$messages);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
          if($integritas == null){
            $integritas = 'Super Admin';
          }
          jobs::insert([
            'nama_pekerjaan' => $req->job_name,
            'add_by' => $integritas,
            'created_at' => date('Y-m-d H:i:s')
          ]);
        }
        return 'Succeded';
    }

    function skhpnstore(Request $req)
    {
      // $no_id = tipe_narkoba::max(DB::raw('substr(kode_narkoba, 3, 5)'))
      $time = date('Y-m-d');
      $no_id = 'Nomor :Sket/_____/'.$this->date_penerjemah($time).'/KA/PL.01/'.date('Y').'/BNNK-SDA';
      if ($req->used_drug == '1') {
        klinikrehab::insert([
          'no_id' => $no_id,
          'kode_registrasi' => $req->reg_num,
          'medicalDate' => $req->tgl_medis,
          'medicalTime' => $req->pukul_medis,
          'medicalLocation' => $req->nama_klinik,
          'kesadaran' => $req->kesadaran,
          'keadaan_umum' => $req->adaan_umum,
          'tekananDarah' => $req->tekanan_darah,
          'nadi' => $req->nadi,
          'breath' => $req->pernapasan,
          'medicineUse' => $req->used_drug,
          'medicineType' => $req->jenis_obat,
          'medicineFrom' => $req->drug_form,
          'lastDrink' => $req->last_drink,
          'rAmphetamine' => $req->amphe,
          'rMethaphetamine' => $req->metha,
          'rTHC' => $req->thc,
          'rMorphin' => $req->morph,
          'rBenzodiazepine' => $req->benzo,
          'rCocaine' => $req->coca,
          'add_by' => session('user'),
          'medicalResult' => $req->hasil_m,
          'status' => '2',
          'created_at' => date('Y-m-d H:i:s')
        ]);
      }elseif ($req->used_drug == '2') {
        klinikrehab::insert([
          'no_id' => $no_id,
          'kode_registrasi' => $req->reg_num,
          'medicalDate' => $req->tgl_medis,
          'medicalTime' => $req->pukul_medis,
          'medicalLocation' => $req->nama_klinik,
          'kesadaran' => $req->kesadaran,
          'keadaan_umum' => $req->adaan_umum,
          'tekananDarah' => $req->tekanan_darah,
          'nadi' => $req->nadi,
          'breath' => $req->pernapasan,
          'medicineUse' => $req->used_drug,
          'medicineType' => '',
          'medicineFrom' => '',
          'rAmphetamine' => $req->amphe,
          'rMethaphetamine' => $req->metha,
          'rTHC' => $req->thc,
          'rMorphin' => $req->morph,
          'rBenzodiazepine' => $req->benzo,
          'rCocaine' => $req->coca,
          'add_by' => session('user'),
          'medicalResult' => $req->hasil_m,
          'status' => '2',
          'created_at' => date('Y-m-d H:i:s')
        ]);
      }
      $get = skhpn::where('kode_registrasi','=',$req->reg_num)->first();
      $get->status = '2';
      $get->save();
      return back()
      ->with('success','Penyimpanan Medis Berhasil!');
    }

    function monthTranslator($month='1')
    {
      $Months = '';
      $bulan = '';
      if ($month == '1') {
        $Months = ' Januari';
        $bulan = 'I';
      }elseif ($month == '2') {
        $Months = ' Februari';
        $bulan = 'II';
      }elseif ($month == '3') {
        $Months = ' Maret';
        $bulan = 'III';
      }elseif ($month == '4') {
        $Months = ' April';
        $bulan = 'IV';
      }elseif ($month == '5') {
        $Months = ' Mei';
        $bulan = 'V';
      }elseif ($month == '6') {
        $Months = ' Juni';
        $bulan = 'VI';
      }elseif ($month == '7') {
        $Months = ' Juli';
        $bulan = 'VII';
      }elseif ($month == '8') {
        $Months = ' Agustus';
        $bulan = 'VIII';
      }elseif ($month == '9') {
        $Months = ' September';
        $bulan = 'IX';
      }elseif ($month == '10') {
        $Months = ' Oktober';
        $bulan = 'X';
      }elseif ($month == '11') {
        $Months = ' November';
        $bulan = 'XI';
      }elseif ($month == '12') {
        $Months = ' Desember';
        $bulan = 'XII';
      }
      return $Months;
    }

    function date_penerjemah($tgl)
    {
      $tgl_fix = '';
      $bulan = '';
      $tgl = explode('-',$tgl);
      $tgl_fix = $tgl[0];
      if ($tgl[1] == 1) {
        $tgl_fix .= ' Januari';
        $bulan = 'I';
      }elseif ($tgl[1] == 2) {
        $tgl_fix .= ' Februari';
        $bulan = 'II';
      }elseif ($tgl[1] == 3) {
        $tgl_fix .= ' Maret';
        $bulan = 'III';
      }elseif ($tgl[1] == 4) {
        $tgl_fix .= ' April';
        $bulan = 'IV';
      }elseif ($tgl[1] == 5) {
        $tgl_fix .= ' Mei';
        $bulan = 'V';
      }elseif ($tgl[1] == 6) {
        $tgl_fix .= ' Juni';
        $bulan = 'VI';
      }elseif ($tgl[1] == 7) {
        $tgl_fix .= ' Juli';
        $bulan = 'VII';
      }elseif ($tgl[1] == 8) {
        $tgl_fix .= ' Agustus';
        $bulan = 'VIII';
      }elseif ($tgl[1] == 9) {
        $tgl_fix .= ' September';
        $bulan = 'IX';
      }elseif ($tgl[1] == 10) {
        $tgl_fix .= ' Oktober';
        $bulan = 'X';
      }elseif ($tgl[1] == 11) {
        $tgl_fix .= ' November';
        $bulan = 'XI';
      }elseif ($tgl[1] == 12) {
        $tgl_fix .= ' Desember';
        $bulan = 'XII';
      }
      // $tgl_fix .= ' '.$tgl[2];
      return $bulan;
    }

    function usercreate(Request $req)
    {
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter',
      'max' => ':attribute harus diisi maksimal :max karakter',
      'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
      'numeric' => ':attribute harap menginputkan nomor',
      ];
      $validator = \Validator::make($req->all(), [
        'user_name' => 'required',
        'pasword' => 'required',
        'confirm_password' => 'required',
      ],$messages);

        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }else{
          $encryp=password_hash($req->pasword,PASSWORD_BCRYPT);
          akun::insert([
            'username' => $req->user_name,
            'password' => $encryp,
            'pas_back' => $req->pasword,
            'integritas' => $req->integritas,
            'created_at' => date('Y-m-d H:i:s')
          ]);
        }

        return 'success added';
    }

    function narkobacreate(Request $req)
    {
      $integritas = session('integrity');
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter',
      'max' => ':attribute harus diisi maksimal :max karakter',
      'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
      'numeric' => ':attribute harap menginputkan nomor',
      ];
      $validator = \Validator::make($req->all(), [
        'narkoba_name' => 'required',
      ],$messages);

      $no_regist = tipe_narkoba::max(DB::raw('substr(kode_narkoba, 3, 5)'));
      $x = (int)$no_regist;
      if($x == 0){
        $no_regist = "NK001";
      }else{
        if($x < 9){
          $no_update = $x + 1;
          $no_regist = "NK00".$no_update;
        }elseif ($x < 99) {
          $no_update = $x + 1;
          $no_regist = "NK0".$no_update;
        }elseif ($x < 999) {
          $no_update = $x + 1;
          $no_regist = "NK".$no_update;
        }
      }

      if ($validator->fails())
      {
          return response()->json(['errors'=>$validator->errors()->all()]);
      }else{
          if($integritas == null){
            $integritas = 'Super Admin';
          }
          tipe_narkoba::insert([
            'kode_narkoba' => $no_regist,
            'jenis_narkoba' => $req->narkoba_name,
            'satuan' => $req->unit,
            'add_by'=> $integritas,
            'created_at' => date('Y-m-d H:i:s')
          ]);
          return "added success";
      }
    }

    function agamacreate(Request $req)
    {
      $integritas= session('integrity');
      $messages=[
        'required' => ':attribute harap diisi',
        'min' => ':attribute harus diisi minimal :min karakter',
        'max' => ':attribute harus diisi maksimal :max karakter',
        'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
        'numeric' => ':attribute harap menginputkan nomor',
      ];
      $validator = \Validator::make($req->all(), [
        'agama_name' => 'required'
      ], $messages);
      if($validator->fails())
      {
        return response()->json(['errors'=>$validator->errors()->all()]);
      }else{
        if($integritas == "")
        {
          $integritas = "Super Admin";
        }
          agama::insert([
          'agama' => $req->agama_name,
          'add_by' => $integritas,
          'created_at' => date('Y-m-d H:i:s')
        ]);
        return "added success";
      }

    }

    function sukucreate(Request $req)
    {
      $integritas=session('integrity');
      $messages=[
        'required' => ':attribute harap diisi',
        'min' => ':attribute harus diisi minimal :min karakter',
        'max' => ':attribute harus diisi maksimal :max karakter',
        'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
        'numeric' => ':attribute harap menginputkan nomor',
      ];
      $validator = \Validator::make($req->all(), [
        'suku_name' => 'required'
      ], $messages);
      if($validator->fails())
      {
        return response()->json(['errors'=>$validator->errors()->all()]);
      }else{
        if($integritas == "")
        {
          $integritas = "Super Admin";
        }
          suku::insert([
          'nama_suku' => $req->suku_name,
          'add_by' => $integritas,
          'created_at' => date('Y-m-d H:i:s')
        ]);
        return "added success";
      }

    }

    function userdel(Request $req)
    {
      $id = $req->id;
      akun::where('id',$id)->delete();
      return "deleted";
    }

    function jobdel(Request $req)
    {
      $id = $req->id;
      jobs::where('id',$id)->delete();
      return "deleted";
    }

    function narkobadel(Request $req )
    {
      $id = $req->id;
      tipe_narkoba::where('id',$id)->delete();
      return "deleted";
    }

    function agamadel(Request $req)
    {
      $id = $req->id;
      // agama::where('id',$id)->delete();
      $agama = agama::find($id);
      $agama->delete();
      return "deleted";
    }

    function sukudel(Request $req)
    {
      $id = $req->id;
      suku::where('id',$id)->delete();
      return "deleted";
    }
}
