<?php


namespace App\Domain\Payments;


use App\Domain\Payments\Providers\Paypal;
use App\Domain\Payments\Providers\Stripe;
use App\Domain\Repositories\PaymentRepository;

class PaymentService
{
    public function selectProvider($request)
    {
        $paymentMethods = [
            'stripe' => new Stripe(),
            'paypal' => new Paypal()
        ];



        if (!array_key_exists($request['payment_method'], $paymentMethods)) {
            throw new \RuntimeException('payment method do not exists');
        }
        $method = $paymentMethods[$request['payment_method']];
        $provider = new PaymentProvider($method, new PaymentRepository());

        return $provider->pay();
    }
}
