<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    

    public function checkout()
    {
    //   $user = auth()->user();
      $user = "";
      return view('order.checkout', compact('user'));
    }
}
