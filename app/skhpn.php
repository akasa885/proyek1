<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class skhpn extends Model
{
    protected $table = "skhpn";
    protected $fillable = ['kode_registrasi','nama_lengkap','tanggal_lahir','gender', 'alamat','pekerjaan','email_address','keperluan','status'];
}
