<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use App\Models\CheckoutAddressModel;
use App\Models\CashfreeModel;
use App\Models\OrderModel;

class PaymentController extends Controller
{
    public function payment_submit(Request $request){
        $address_id = $request->address_id;
        $address_details = CheckoutAddressModel::where('id', $address_id)->get()->first();
        $order_id = 'NXTEP'.date('ymdHis').rand(1000,9999);
        $user_id = Auth::id();
        $customer_id = 'customer_'.$user_id.'_'.rand(111111111,999999999);
        $user_email = auth()->user()->email;
        $user_name = $address_details->first_name.' '.$address_details->last_name;
        $phone_no = $address_details->phone_no;
        $amount = $request->final_amount;

        $url = "https://sandbox.cashfree.com/pg/orders"; // sandbox
        //$url = "https://api.cashfree.com/pg/orders"; // production

        $headers = array(
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: ".env('CASHFREE_API_KEY'),
            "x-client-secret: ".env('CASHFREE_API_SECRET')
        );
        
        $data = json_encode([
            'order_id' =>  $order_id,
            'order_amount' => $amount,
            "order_currency" => "INR",
            "customer_details" => [
                "customer_id" => $customer_id,
                "customer_name" => $user_name,
                "customer_email" => $user_email,
                "customer_phone" => $phone_no,
            ],
            "order_meta" => [
                "return_url" => env('APP_URL').'cashfree/payments/success/?order_id={order_id}'
            ]
        ]);
        //dd($data);
        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        //dd(json_decode($resp));
        return redirect()->to(json_decode($resp)->payment_link);
    }

    public function cashfree_success(Request $request)
    {
        //dd($request->all()); // PAYMENT STATUS RESPONSE
        $order_id = $request->order_id;
        $order_details = OrderModel::where('order_number', $order_id)->get()->first(); 
        $orderId = $order_details->id;

        $url = "https://sandbox.cashfree.com/pg/orders/".$order_id."/settlements"; // sandbox
        //$url = "https://api.cashfree.com/pg/orders/".$order_id."/settlements"; // production

        $headers = array(
            "Content-Type: application/json",
            "x-api-version: 2022-01-01",
            "x-client-id: ".env('CASHFREE_API_KEY'),
            "x-client-secret: ".env('CASHFREE_API_SECRET')
        );

        $curl = curl_init($url);

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_ENCODING, "");
        curl_setopt($curl, CURLOPT_MAXREDIRS, 10);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        $settlement_data = json_decode($response);
        $cf_payment_id = $settlement_data->cf_payment_id;
        $cf_settlement_id = $settlement_data->cf_settlement_id;
        $order_amount = $settlement_data->order_amount;
        $payment_time = $settlement_data->payment_time;
        $payment_time = date('Y-m-d H:i:s', strtotime($payment_time));
        $service_charge = $settlement_data->service_charge;
        $service_tax = $settlement_data->service_tax;
        $settlement_amount = $settlement_data->settlement_amount;

        OrderModel::where('id', $orderId)->update([
            'payment_status' => 1,
            'transaction_id' => $cf_payment_id
        ]);

        $paymentObject = new CashfreeModel();
        $paymentObject->order_id = $orderId;
        $paymentObject->cf_payment_id = $cf_payment_id;
        $paymentObject->cf_settlement_id = $cf_settlement_id;
        $paymentObject->order_amount = $order_amount;
        $paymentObject->payment_time = $payment_time;
        $paymentObject->service_charge = $service_charge;
        $paymentObject->service_tax = $service_tax;
        $paymentObject->settlement_amount = $settlement_amount;
        $paymentObject->save();

    }
}
