<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $guarded = [];

    public function cashier()
    {
      return $this->belongsTo('App\Cashier');
    }
}
