<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Payment;
use App\Services\Payment\SslCommerzService;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function __construct(
        protected SslCommerzService $sslCommerz
    ) {}

    public function pay(Fee $fee)
    {
        $response = $this->sslCommerz->initiatePayment($fee);

        if (isset($response['gateway_url'])) {
            return redirect()->away($response['gateway_url']);
        }

        return back()->with('error', 'Payment initiation failed.');
    }

    public function sandboxCheckout(Request $request)
    {
        $tranId = $request->query('tran_id');
        $payment = Payment::where('tran_id', $tranId)->firstOrFail();

        return view('payment.sandbox', compact('payment'));
    }

    public function success(Request $request)
    {
        $tranId = $request->input('tran_id');
        $payment = Payment::where('tran_id', $tranId)->first();

        if ($payment) {
            $payment->update([
                'gateway_status' => 'VALIDATED',
                'paid_at' => Carbon::now(),
            ]);

            $payment->fee->update([
                'status' => 'paid',
                'paid_amount' => $payment->amount,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Payment processed successfully!');
    }

    public function fail(Request $request)
    {
        return redirect()->route('dashboard')->with('error', 'Payment failed or was declined.');
    }

    public function cancel(Request $request)
    {
        return redirect()->route('dashboard')->with('info', 'Payment process cancelled.');
    }

    public function ipn(Request $request)
    {
        // IPN Webhook logic for production SSLCommerz background validation
        return response()->json(['status' => 'received']);
    }
}
