<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\skhpn;

class SkhpnController extends Controller
{
  public function Svalidate(Request $req)
  {
    $messages = [
    'required' => ':attribute harap diisi',
    'min' => ':attribute harus diisi minimal :min karakter ya cuy!!!',
    'max' => ':attribute harus diisi maksimal :max karakter ya cuy!!!',
    'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
    ];
    $this->validate($req, [
      'nama' => 'required|min:5',
      'tgl_lahir' => 'required|before:today',
      'gender' => 'required',
      'address' => 'required',
      'pekerjaan' => 'required',
      'alamat_email' => 'required|email',
      'keperluan' => 'required',
      'captcha' => 'required|captcha'
    ],$messages);

    $no_regist = skhpn::max(DB::raw('substr(kode_registrasi, 4, 6)'));
    $x = (int)$no_regist;
    if($x == 0){
      $gg = "oke";
      $no_regist = "REG0001";
    }else{
      if($x < 10){
        $no_update = $x + 1;
        $no_regist = "REG000".$no_update;
      }elseif ($x < 100) {
        $no_update = $x + 1;
        $no_regist = "REG00".$no_update;
      }elseif ($x < 1000) {
        $no_update = $x + 1;
        $no_regist = "REG0".$no_update;
      }elseif ($x < 10000) {
        $no_update = $x + 1;
        $no_regist = "REG".$no_update;
      }
    }
    skhpn::insert([
      'kode_registrasi' => $no_regist,
      'nama_lengkap' => $req->nama,
      'tanggal_lahir' => $req->tgl_lahir,
      'gender' => $req->gender,
      'alamat' => $req->address,
      'pekerjaan' => $req->pekerjaan,
      'email_address' => $req->alamat_email,
      'keperluan' => $req->keperluan,
      'status' => '1',
      'created_at' => date('Y-m-d H:i:s')
    ]);
    return redirect('/serv/4/berhasil/'.$no_regist);
  }

  function sukses($no_reg)
  {
    return view('skhpn-complete',['no_reg'=> $no_reg]);
  }
}
