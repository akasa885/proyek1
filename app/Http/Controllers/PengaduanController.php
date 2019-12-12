<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengaduanController extends Controller
{
    //
    public function insert(Request $req)
    {
      DB::table('pengaduan')->insert([

      ]);
    }

    return redirect('/bnn/serv');
}
