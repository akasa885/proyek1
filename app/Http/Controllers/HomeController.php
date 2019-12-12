<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\sublink;

class HomeController extends Controller
{
  public function index()
  {
    $data = sublink::all();
    // $data = array(
    //   'instagram' => 'ajsod',
    //   'facebook' => ',',
    //   'youtube' => ',',
    //   'linked_link' => ',',
    // );
    return view('dashboard', ['link' => $data]);
  }

  public function profil()
  {
    return view('coming_soon');
  }
}
