<?php

namespace App\Http\Controllers\Admin;

use App\BO\Services\PaymentService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller {

    protected $paymentService;
    public function __construct(PaymentService $paymentService) {
        $this->paymentService = $paymentService;
    }

    public function getPaymentList(){
        $data['paymentData'] = $this->paymentService->allPayments();
        // dd($data);
        return view('admin.payment.index', $data);
    }

    public function settlePayment($paymentId){
        $status = $this->paymentService->settlePayment($paymentId);
        if(isset($status)){
            return redirect()->route('paymentMgt')->with('success', 'Payment settled..');
        } else {
            return redirect()->route('paymentMgt')->with('warning', 'Payment settle failed..');
        }
    }
}