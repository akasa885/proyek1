<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\pengaduan;

class PengaduanController extends Controller
{
    //
    public function sukses()
    {
      return view('pengaduan-sukses');
    }

    public function insert(Request $req)
    {
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter',
      'max' => ':attribute harus diisi maksimal :max karakter',
      'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
      'numeric' => ':attribute harap menginputkan nomor',
      'image' => ':attribute harus sebuah gambar',
      ];
      $req->validate([
        'file1' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        'file2' => 'image|mimes:jpg,png,jpeg,gif|max:2048',
        'nama' => 'required',
        'tgl_lahir' => 'required|before:today',
        'address_patient' => 'required',
        'Nomor_hp' => 'required|numeric',
        'alamat_email' => 'required',
        'instansi' => 'required',
        'address_company' => 'required',
        'Nomor_telp_instansi' => 'required|numeric',
        'case_date' => 'required',
        'case_hour' => 'required',
        'captcha' => 'required|captcha',
      ],$messages);

      $no_regist = pengaduan::max(DB::raw('substr(kode_registrasi, 3, 5)'));
      $x = (int)$no_regist;
      if($x == 0){
        $no_regist = "PN001";
      }else{
        if($x < 9){
          $no_update = $x + 1;
          $no_regist = "PN00".$no_update;
        }elseif ($x < 99) {
          $no_update = $x + 1;
          $no_regist = "PN0".$no_update;
        }elseif ($x < 999) {
          $no_update = $x + 1;
          $no_regist = "PN".$no_update;
        }elseif ($x < 9999) {
          $no_update = $x + 1;
          $no_regist = "PN".$no_update;
        }
      }

      $image = $req->file('file1');
      // $name = "paslasdsda";
      $fileName = $no_regist.'.'.$image->extension();
      $path_dir = '/uploads/lampiran/pengaduan'.'/'.$no_regist;
      $path_file = $path_dir.$fileName;
      $path = '/lampiran/pengaduan/'.$no_regist;
      $full_path_1 = $path_dir.'/'.$fileName;
      if (!file_exists($path_dir)) {
        mkdir($path_dir,777,true);
      }
      if(file_exists($path_file))
      {
        unlink($path_file);
      }
      $image->move(public_path('uploads').$path, $fileName);
      if ($req->file2 != null) {
        $image = $req->file('file2');
        // $name = "paslasdsda";
        $fileName = $no_regist.'.'.$image->extension();
        $path_dir = '/uploads/lampiran/pengaduan/'.$no_regist.'/tambahan';
        $path_file = $path_dir.$fileName;
        $path = '/lampiran/pengaduan/'.$no_regist.'/tambahan';
        $full_path_2 = $path_dir.'/'.$fileName;
        if (!file_exists($path_dir)) {
          mkdir($path_dir,777,true);
        }
        if(file_exists($path_file))
        {
          unlink($path_file);
        }
        $image->move(public_path('uploads').$path, $fileName);

        pengaduan::insert([
          'kode_registrasi' => $no_regist,
          'fullName' => $req->nama,
          'birth_date' => $req->tgl_lahir,
          'email' => $req->alamat_email,
          'no_hp' => $req->Nomor_hp,
          'alamat' => $req->address_patient,
          'identitas_location' => $full_path_1,
          'pekerjaan' => $req->pekerjaan,
          'nama_instansi'=> $req->instansi,
          'instansi_location' => $req->address_company,
          'instansi_no' => $req->Nomor_telp_instansi,
          'kejadian_date' => $req->case_date,
          'kejadian_time' => $req->case_hour.':'.$req->case_minute,
          'pendukung_location' => $full_path_2,
          'created_at' => date('Y-m-d H:i:s')
        ]);
      }

      pengaduan::insert([
        'kode_registrasi' => $no_regist,
        'fullName' => $req->nama,
        'birth_date' => $req->tgl_lahir,
        'email' => $req->alamat_email,
        'no_hp' => $req->Nomor_hp,
        'alamat' => $req->address_patient,
        'identitas_location' => $full_path_1,
        'pekerjaan' => $req->pekerjaan,
        'nama_instansi'=> $req->instansi,
        'instansi_location' => $req->address_company,
        'instansi_no' => $req->Nomor_telp_instansi,
        'kejadian_date' => $req->case_date,
        'kejadian_time' => $req->case_hour.':'.$req->case_minute,
        'created_at' => date('Y-m-d H:i:s')
      ]);

      return redirect('/serv/1/berhasil')
      ->with('no_reg',$no_regist);
    }
}
