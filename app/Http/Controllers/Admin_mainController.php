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

/**
 *
 */
class Admin_mainController extends Controller
{
    protected $username = '';
    protected $inter = '';
    function __constructor()
    {
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
      // print_r($data);
      // echo $last;
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
          $status = 'masuk loop';
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
      $no_id = 'Nomor :Sket/_____/'.$this->date_penerjemah($time).'/KA/PL.01/2019/BNNK-SDA';
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
          'medicalResult' => $req->hasiL_m,
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
          'medicalResult' => $req->hasiL_m,
          'status' => '2',
          'created_at' => date('Y-m-d H:i:s')
        ]);
      }
      $get = skhpn::where('kode_registrasi','=',$req->reg_num)->first();
      $get->status = '2';
      $get->save();
      return redirect('/dpanel/skhpn/klinik/'.$req->reg_num);
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
      $tgl_fix .= ' '.$tgl[2];
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
        if($x < 10){
          $no_update = $x + 1;
          $no_regist = "NK00".$no_update;
        }elseif ($x < 100) {
          $no_update = $x + 1;
          $no_regist = "NK0".$no_update;
        }elseif ($x < 1000) {
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
