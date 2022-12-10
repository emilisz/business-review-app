<?php

namespace App\Models;

use App\Domain\Payments\PaymentProvider;
use App\Domain\Payments\Providers\Paypal;
use App\Domain\Payments\Providers\Stripe;
use App\Domain\Repositories\PaymentRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['amount','valid_till','payment_method','user_id'];

    protected $casts = [
        'valid_till' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

//    public static function pay($data)
//    {
//        $paymentMethods = [
//            'stripe' => new Stripe(),
//            'paypal' => new Paypal()
//        ];
//
//        if (!array_key_exists($data['payment_method'], $paymentMethods)) {
//            throw new \RuntimeException('payment method do not exists');
//        }
//
//        $method = $paymentMethods[$data['payment_method']];
//        $provider = new PaymentProvider($method, new PaymentRepository());
//
//        return $provider->pay();
//    }

}
