<?php
declare(strict_types=1);


namespace App\Domain\Payments\Providers;

use App\Models\Payment;

class Stripe implements PaymentInterface
{
    public function __construct (private string $apiKey = '')
    {
    }

    public function pay($date = null)
    {
        return Payment::create([
            'amount' => config('constants.premium_price'),
            'valid_till' => $date ? $date->addDays(config('constants.premium_days')) : now()->addDays(config('constants.premium_days')),
            'payment_method' => 'stripe',
            'user_id' => auth()->id()
        ]);
    }
}
