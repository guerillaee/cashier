<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaction;

class Account extends Model
{
    protected $guarded = [];

    public function cashier()
    {
      return $this->belongsTo('App\Cashier');
    }

    public function categories()
    {
      return $this->hasMany('App\Category');
    }

    public static function transactions($id)
    {
      return Transaction::where('creditor_account_id', $id)->orWhere('debitor_account_id', $id)->orderBy('created_at', 'desc')->get();
    }

    public static function amount($id)
    {
      $account = Account::findOrFail($id);
      return $account->amount;
    }
}
