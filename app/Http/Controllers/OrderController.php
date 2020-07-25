<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{

    public function checkout()
    {
      $user = auth()->user();
      return view('order.checkout', compact('user'));
    }

    public function checkout_process(Request $request)
    {
        $user = auth()->user();
        $order = new Order;
        $order->user_id = $user->id;
        $order->amount = $request->amount;
        $order->status = "new";
        $order->save();

        $payment = PaymentController::create_order(['receipt_id'=> $order->id, 'amount' => $order->amount]);
        $order->razorpay_meta = ['razorpay_order_id' => $payment->id];
        $order->save();

        return view('order.payment_capture')
            ->with('payment_id', $payment->id)
            ->with('amount',$payment->amount)
            ->with('order_id',$order->id)
            ->with('key',PaymentController::getKey());


        return view('order.checkout', compact('user'));
    }

    public function callback(Request $request)
    {
      PaymentController::verify_signature($request);
      $order = Order::where('razorpay_meta->razorpay_order_id', $request->razorpay_order_id)
                ->first();

      $order->status = 1;
      $order->save();

      return ['payment_success' => true, 'order' => $order];
    }
}
