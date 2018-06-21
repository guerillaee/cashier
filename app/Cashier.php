<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{

  public function accounts()
  {
    return $this->hasMany('App\Account');
  }
}
