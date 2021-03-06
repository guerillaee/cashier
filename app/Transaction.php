<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    public function creditor_transactions()
    {
      return $this->belongsTo('App\Account', 'type', 'creditor_account_id');
    }

    public function debitor_transactions()
    {
      return $this->belongsTo('App\Account', 'type', 'debitor_account_id');
    }
}
