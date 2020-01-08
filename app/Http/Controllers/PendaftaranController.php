<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\jobs;
use App\pegawai;


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
      }
    }
    //

    public function choice()
    {
      $data_asessor = pegawai::where('bagian','=','asessor')->get() ;
      $data_sosialisasi = pegawai::where('bagian','=','sosialisasi')->get() ;

      return view('coba_pilih',['asessor' => $data_asessor, 'sosialisasi' => $data_sosialisasi]);
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
