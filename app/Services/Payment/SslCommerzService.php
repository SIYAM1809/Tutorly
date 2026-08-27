<?php

namespace App\Services\Payment;

use App\Models\Fee;
use App\Models\Payment;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SslCommerzService
{
    public function initiatePayment(Fee $fee): array
    {
        $tranId = 'CS-' . Str::upper(Str::random(10));
        $storeId = config('services.sslcommerz.store_id');
        $storePass = config('services.sslcommerz.store_password');
        $apiUrl = config('services.sslcommerz.api_url');

        $postData = [
            'store_id' => $storeId,
            'store_passwd' => $storePass,
            'total_amount' => $fee->amount,
            'currency' => 'BDT',
            'tran_id' => $tranId,
            'success_url' => route('payment.success'),
            'fail_url' => route('payment.fail'),
            'cancel_url' => route('payment.cancel'),
            'ipn_url' => route('payment.ipn'),
            'cus_name' => $fee->student->name,
            'cus_email' => $fee->student->email,
            'cus_phone' => $fee->student->phone ?? '01700000000',
            'cus_add1' => 'Dhaka',
            'cus_city' => 'Dhaka',
            'cus_country' => 'Bangladesh',
            'shipping_method' => 'NO',
            'product_name' => $fee->title,
            'product_category' => 'Coaching Fee',
            'product_profile' => 'non-physical-goods',
        ];

        // In sandbox / offline environment, return mock checkout URL or API call
        if ($storeId === 'sandbox_test_id') {
            Payment::create([
                'fee_id' => $fee->id,
                'student_id' => $fee->student_id,
                'tran_id' => $tranId,
                'amount' => $fee->amount,
                'payment_method' => 'SSLCommerz Sandbox',
                'gateway_status' => 'PENDING',
                'paid_at' => Carbon::now(),
            ]);

            return [
                'status' => 'SUCCESS',
                'gateway_url' => route('payment.sandbox.checkout', ['tran_id' => $tranId]),
                'tran_id' => $tranId,
            ];
        }

        $response = Http::asForm()->post("{$apiUrl}/gwprocess/v4/api.php", $postData);
        return $response->json();
    }
}
