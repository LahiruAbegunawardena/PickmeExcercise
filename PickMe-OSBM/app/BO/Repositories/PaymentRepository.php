<?php

namespace App\BO\Repositories;

use Auth;
use Carbon\Carbon;
use App\BO\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PaymentRepository {
 
    protected $paymentModel;
    public function __construct(Payment $paymentModel) {
        $this->paymentModel = $paymentModel;
    }

    public function allPayments(){
        return $this->paymentModel->all();
    }

    public function settlePayment($paymentId){
        $payment = $this->paymentModel->find($paymentId);
        if(isset($payment)){
            $payment->update([
                "is_paid" => 1,
                "collected_by" => Auth::user()->id,
                "paid_date" => Carbon::now()
            ]);
            return $payment;
        } else {
            return null;
        }
    }
}