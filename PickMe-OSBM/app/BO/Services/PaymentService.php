<?php

namespace App\BO\Services;

use App\BO\Models\Payment;
use App\CommonBase\Service;
use App\BO\Repositories\PaymentRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\BO\Transformations\PaymentTransformable;

class PaymentService extends Service {

    use PaymentTransformable;
    protected $paymentRepo;
    public function __construct(PaymentRepository $paymentRepository) {
        $this->paymentRepo = $paymentRepository;
    }

    public function allPayments(){
        $payments = $this->paymentRepo->allPayments();
        $paymentData = [];
        foreach ($payments as $payment) {
            $paymentData[] = $this->transformPaymentDet($payment);
        }
        return $paymentData;
    }

    public function settlePayment($paymentId){
        return $this->paymentRepo->settlePayment($paymentId);
    }
}