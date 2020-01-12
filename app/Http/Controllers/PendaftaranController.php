<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\jobs;
use App\pegawai;
use App\sosialisasi;
use App\rehab_tat;
use App\rehab_publik;
use App\permintaan;
use App\mandiri;


class PendaftaranController extends Controller
{
    public function index($id)
    {
      if ($id==1) {
        return $this->pengaduan();
      }elseif ($id==2) {
        return $this->sosialisasi();
      }elseif ($id==3) {
        return $this->rehabilitasi();
      }elseif ($id==4) {
        return $this->skhpn();
      }elseif ($id==5) {
        return $this->mandiri();
      }
    }
    //

    public function choice()
    {
      $data_asessor = pegawai::where('bagian','=','asessor')->get() ;
      $data_sosialisasi = pegawai::where('bagian','=','sosialisasi')->get() ;
      $data_rehab = pegawai::where('departemen','=','rehab')->get();
      if ($data_asessor == null || $data_sosialisasi == null) {
        return back();
      }
      return view('choicement',['asessor' => $data_asessor, 'sosialisasi' => $data_sosialisasi,'rehab'=>$data_rehab]);
    }

    public function pilih($transaksi_id,$pegawai_id)
    {
      $cryption = substr($transaksi_id,0,2);
      if ($cryption == 'PB' || $cryption == 'TA') {
        if ($cryption == 'PB') {
          permintaan::insert([
            'kode_pegawai' => $pegawai_id,
            'kode_publik' => $transaksi_id,
            'created_at' => date('Y-m-d H:i:s')
          ]);
        }else {
          permintaan::insert([
            'kode_pegawai' => $pegawai_id,
            'kode_tat' => $transaksi_id,
            'created_at' => date('Y-m-d H:i:s')
          ]);
        }

        return redirect('/pendaftaran-berhasil/rehab/'.$transaksi_id);
      }elseif ($cryption == 'SO') {
        $get = sosialisasi::where('kode_sos',$transaksi_id)->first();
        $get->kode_pegawai = $pegawai_id;
        $get->save();

        permintaan::insert([
          'kode_pegawai' => $pegawai_id,
          'kode_sosialisasi' => $transaksi_id,
          'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect('/serv/2/berhasil/'.$transaksi_id);
      }elseif ($cryption == 'TU') {
        $get = mandiri::where('kode_registrasi',$transaksi_id)->first();
        $get->kode_pegawai = $pegawai_id;
        $get->save();

        permintaan::insert([
          'kode_pegawai' => $pegawai_id,
          'kode_mandiri' => $transaksi_id,
          'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect('/serv/5/berhasil/'.$transaksi_id);
      }else {
        return back()
        ->with('alert','Tolong lakukan transaksi dahulu!');
      }
    }

    public function mandiri()
    {
      return view('tes-mandiri');
    }

    public function sosialisasi()
    {
      return view('sosialisasi');
    }

    public function pengaduan()
    {
      return view('pengaduan');
    }

    public function rehabilitasi()
    {
      return view('rehabilitasi',['form' => "default"]);
    }

    public function skhpn()
    {
      $data= jobs::all();
      return view('skhpn',['job'=>$data]);
    }
}
