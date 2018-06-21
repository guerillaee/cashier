<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $guarded = [];

    public function category()
    {
      return $this->belongsTo(App\Category);
    }

    public function creditor_transactions()
    {
      return $this->balongsTo(App\Category, 'category_id', 'id');
    }

    public function debitor_transactions()
    {
      return $this->balongsTo(App\Category, 'category_id', 'id');
    }
}
