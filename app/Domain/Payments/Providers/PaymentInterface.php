<?php


namespace App\Domain\Payments\Providers;


interface PaymentInterface
{
    public function pay($date = null);
}
