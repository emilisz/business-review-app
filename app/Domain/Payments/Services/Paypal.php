<?php


namespace App\Domain\Payments\Services;


use App\Models\Payment;

class Paypal implements PaymentInterface
{
    public function pay($date = null)
    {
        return Payment::create([
            'amount' => config('constants.premium_price'),
            'valid_till' => $date ? $date->addDays(config('constants.premium_days')) : now()->addDays(config('constants.premium_days')),
            'payment_method' => 'Paypal',
            'user_id' => auth()->id()
        ]);
    }
}
