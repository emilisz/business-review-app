<?php
declare(strict_types=1);


namespace App\Domain\Payments\Providers;


interface PaymentInterface
{
    public function pay($date = null);
}
