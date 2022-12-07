<?php


namespace App\Domain\Payments\Services;


interface PaymentInterface
{
    public function pay($date = null);
}
