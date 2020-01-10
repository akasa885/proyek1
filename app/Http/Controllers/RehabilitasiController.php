<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\tipe_narkoba;
use App\rehab_tat;
use App\rehab_publik;
use App\agama;
use App\suku;

class RehabilitasiController extends Controller
{
    public function type()
    {
      $tipe_catch = "default";
      if ($_REQUEST['tipe'] == "instansi") {
        $this->tipe_catch = "instansi";
      }elseif ($_REQUEST['tipe'] == "publik") {
        $this->tipe_catch = "publik";
      }
      return $this->tipe_catch;
    }

    function get_nama_narkoba(){
      $tipe_narkoba = tipe_narkoba::all();
      return $tipe_narkoba;
    }

    function get_nama_agama()
    {
      $agama = agama::all();
      return $agama;
    }

    function get_nama_suku()
    {
      $list_suku = suku::all();
      return $list_suku;
    }
    public function rehab_form($choice)
    {
      return view('rehabilitasi',['form' => $choice , 'tipe_narkoba' => $this->get_nama_narkoba(), 'agama' => $this->get_nama_agama(), 'suku' => $this->get_nama_suku()]);
    }

    public function proses_tat(Request $req)
    {
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter',
      'max' => ':attribute harus diisi maksimal :max karakter',
      'before' => ':attribute harap memasukkan sebelum :date',
      'after' => ':attribute harap memasukkan sesudah :date',
      'numeric' => ':attribute harap menginputkan nomor',
      ];
      $req->validate([
        'instansi_pengaju' => 'required',
        'nama' => 'required|min:5',
        'nik' => 'required|numeric',
        'address' => 'required',
        'tgl_tangkap' => 'required|before:tgl_sprin_tahan',
        'tgl_sprin_tangkap' => 'required|before:tgl_tangkap',
        'tgl_sprin_tahan' => 'required|after:tgl_tangkap',
        'penyidik' => 'required',
        'hp_penyidik' => 'required|numeric|max:12',
        'captcha' => 'required|captcha',
      ],$messages);

      $no_regist = rehab_tat::max(DB::raw('substr(kode_registrasi, 4, 6)'));
      $x = (int)$no_regist;
      if($x == 0){
        $no_regist = "TAT0001";
      }else{
        if($x < 9){
          $no_update = $x + 1;
          $no_regist = "TAT000".$no_update;
        }elseif ($x < 99) {
          $no_update = $x + 1;
          $no_regist = "TAT00".$no_update;
        }elseif ($x < 999) {
          $no_update = $x + 1;
          $no_regist = "TAT0".$no_update;
        }elseif ($x < 9999) {
          $no_update = $x + 1;
          $no_regist = "TAT".$no_update;
        }
      }
      $tipe_array="";
      $berat_array="";
      foreach ($req->tipe as $key) {
        $temp = $key;
        $tipe_array = $tipe_array.$temp.',';
      }
      foreach ($req->berat as $key) {
        $temp = $key;
        $berat_array = $berat_array.$temp.',';
      }
      rehab_tat::insert([
        'kode_registrasi' => $no_regist,
        'instansi_pengaju' => $req->instansi_pengaju,
        'nama_tersangka' => $req->nama,
        'nik_ktp' => $req->nik,
        'alamat' => $req->address,
        'tgl_penangkapan' => $req->tgl_tangkap,
        'tgl_sprin_tangkap' => $req->tgl_sprin_tangkap,
        'tgl_sprin_tahan' => $req->tgl_sprin_tahan,
        'barang_bukti' => $tipe_array,
        'berat' => $berat_array,
        'nama_penyidik' => $req->penyidik,
        'no_hp_penyidik' => $req->hp_penyidik,
        'created_at' => date('Y-m-d H:i:s')
      ]);
      return redirect('/serv/choice/')
      ->with('type','asessor')
      ->with('kode',$no_regist);
    }

    public function proses_publik(Request $req)
    {
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter ya cuy!!!',
      'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
      'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
      'numeric' => ':attribute harap menginputkan nomor',
      ];
      $req->validate([
        'nama' => 'required',
        'NIK' => 'required|numeric',
        'address' => 'required',
        'tgl_datang' => 'required|after:today',
        'tgl_lahir' => 'required|before:today',
        'gender' => 'required',
        'umur' => 'required|numeric',
        'nama_ibu' => 'required',
        'nama_ayah' => 'required',
        'no_hp' => 'required|numeric|max:12',
        'no_keluarga' => 'required|numeric|max:12',
        'captcha' => 'required|captcha'
      ],$messages);

      $no_regist = rehab_publik::max(DB::raw('substr(kode_registrasi, 4, 6)'));
      $x = (int)$no_regist;
      if($x == 0){
        $no_regist = "PBL0001";
      }else{
        if($x < 9){
          $no_update = $x + 1;
          $no_regist = "PBL000".$no_update;
        }elseif ($x < 99) {
          $no_update = $x + 1;
          $no_regist = "PBL00".$no_update;
        }elseif ($x < 999) {
          $no_update = $x + 1;
          $no_regist = "PBL0".$no_update;
        }elseif ($x < 9999) {
          $no_update = $x + 1;
          $no_regist = "PBL".$no_update;
        }
      }
      $tipe_array="";
      foreach ($req->tipe as $key) {
        $temp = $key;
        $tipe_array = $tipe_array.$temp.',';
      }
      rehab_publik::insert([
        'kode_registrasi' => $no_regist,
        'tgl_kedatangan' => $req->tgl_datang,
        'birth_date' => $req->tgl_lahir,
        'nama_lengkap' => $req->nama,
        'gender' => $req->gender,
        'umur' => $req->umur,
        'nik_ktp' => $req->NIK,
        'agama' => $req->agama,
        'suku' => $req->suku,
        'narkoba' => $tipe_array,
        'status' => $req->status,
        'nama_ibu' => $req->nama_ibu,
        'nama_ayah' => $req->nama_ayah,
        'alamat' => $req->address,
        'no_hp' => $req->no_hp,
        'no_hp_keluarga' => $req->no_keluarga,
        'created_at' => date('Y-m-d H:i:s')
      ]);
      return redirect('/serv/choice/')
      ->with('type','asessor')
      ->with('kode',$no_regist);
    }
    public function terkonfirmasi($reg)
    {
      return view('rehabilitasai-complete',['no_reg' => $reg]);
    }
}
