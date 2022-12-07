<?php


namespace App\Domain\Payments;


use App\Domain\Payments\Services\PaymentInterface;
use App\Domain\Repositories\RepositoryInterface;

class PaymentProvider
{
    public function __construct(private PaymentInterface $payment, protected RepositoryInterface $repository)
    {
    }

    public function pay()
    {
        $latestPayment = $this->repository->getAllByUser(auth()->id())->last();

        if ($latestPayment){
            return $this->payment->pay($latestPayment->valid_till);
        }
       return $this->payment->pay();
    }
}
