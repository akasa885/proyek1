<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sublink extends Model
{
  protected $table = "sublinks";

  protected $fillable = ['instagram','facebook','youtube','linked_link'];
}
