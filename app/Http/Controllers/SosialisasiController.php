<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SosialisasiController extends Controller
{
    function validasi(Request $req)
    {
      $messages = [
      'required' => ':attribute harap diisi',
      'min' => ':attribute harus diisi minimal :min karakter',
      'max' => ':attribute harus diisi maksimal :max karakter',
      'before' => ':attribute harap memasukkan sebelum tanggal sekarang',
      'numeric' => ':attribute harap menginputkan nomor',
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
        'keterangan' => 'required',
        'captcha' => 'required|captcha',
      ],$messages);

      
    }
}
