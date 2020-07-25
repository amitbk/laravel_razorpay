<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $casts = [
        'razorpay_meta' => 'array'
    ];

  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
