<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct()
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$clientKey = config('midtrans.client_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$is3ds = config('midtrans.is_3ds');
    }

    public function createTransaction(Request $request)
    {
        $order = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . time(),
                'gross_amount' => $request->total,
            ],
            'customer_details' => [
                'first_name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($order);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            // dd($e);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function handleCallback(Request $request)
    {
        // Handle payment notification from Midtrans
        $notification = json_decode($request->getContent(), true);
        return response()->json(['status' => 'success']);
    }
}
