<?php


namespace App\Domain\Payments;


use App\Domain\Payments\Providers\Paypal;
use App\Domain\Payments\Providers\Stripe;
use App\Domain\Repositories\PaymentRepository;

class PaymentService
{
    public function makePayment($intent)
    {
        $paymentMethods = [
            'stripe' => new Stripe(),
            'paypal' => new Paypal()
        ];

        if (!array_key_exists($intent['payment_method'], $paymentMethods)) {
            throw new \RuntimeException('payment method do not exists');
        }

        $method = $paymentMethods[$intent['payment_method']];
        $provider = new PaymentProvider($method, new PaymentRepository());

        return $provider->pay();
    }
}
