<?php


namespace App\Domain\Payments;


use App\Domain\Payments\Providers\PaymentInterface;
use App\Domain\Repositories\Interfaces\BaseInterface;

class PaymentProvider
{
    public function __construct(private PaymentInterface $payment, protected BaseInterface $repository)
    {
    }

    public function pay()
    {
        $latestPayment = $this->repository->findAllNotExpired(auth()->id())->last();


        if (!$latestPayment) {
            return $this->payment->pay();
        }
        return $this->payment->pay($latestPayment->valid_till);

    }


}
