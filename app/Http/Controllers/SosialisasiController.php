<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\sosialisasi;

class SosialisasiController extends Controller
{
    function sukses($no_reg)
    {
      return view('sosialisasi-complete',['no_reg' => $no_reg]);
    }

    function validasi(Request $req)
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
        'sosialisasi_type' => 'required',
        'nama_pengada' => 'required',
        'due_date' => 'required|after:today',
        'jam' => 'required',
        'lampiran' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
        'address_place' => 'required',
        'nama_duty' => 'required',
        'Nomor_hp_pj' => 'required|numeric',
        'jmlh_peserta' => 'required',
        'captcha' => 'required|captcha',
      ],$messages);

      $no_regist = sosialisasi::max(DB::raw('substr(kode_sos, 3, 5)'));
      $x = (int)$no_regist;
      if($x == 0){
        $no_regist = "SO001";
      }else{
        if($x < 9){
          $no_update = $x + 1;
          $no_regist = "SO00".$no_update;
        }elseif ($x < 99) {
          $no_update = $x + 1;
          $no_regist = "SO0".$no_update;
        }elseif ($x < 999) {
          $no_update = $x + 1;
          $no_regist = "SO".$no_update;
        }
      }

      $image = $req->file('lampiran');
      // $name = "paslasdsda";
      $fileName = $no_regist.'.'.$image->extension();
      $path_dir = '/uploads/lampiran/sosialisasi'.'/'.$no_regist;
      $path_file = $path_dir.$fileName;
      $path = '/lampiran/sosialisasi/'.$no_regist;
      $full_path = $path_dir.'/'.$fileName;
      if (!file_exists($path_dir)) {
        mkdir($path_dir,777,true);
      }
      if(file_exists($path_file))
      {
        unlink($path_file);
      }
      $image->move(public_path('uploads').$path, $fileName);

      sosialisasi::insert([
        'kode_sos' => $no_regist,
        'nama_pengada' => $req->nama_pengada,
        'tgl_pengada' => $req->due_date,
        'sosialisasi_type' => $req->sosialisasi_type,
        'waktu' => $req->jam.':'.$req->menit,
        'lokasi_tempat' => $req->address_place,
        'jmlh_peserta' => $req->jmlh_peserta,
        'nama_pj' => $req->nama_duty,
        'Nomor_hp_pj'=> $req->Nomor_hp_pj,
        'keterangan' => $req->keterangan,
        'lampiran_loc' => $full_path,
        'created_at' => date('Y-m-d H:i:s')
      ]);

      return redirect('/serv/choice/')
      ->with('type','sosialisasi')
      ->with('kode',$no_regist);
    }

}
