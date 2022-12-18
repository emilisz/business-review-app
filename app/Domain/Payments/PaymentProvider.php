<?php


namespace App\Domain\Payments;


use App\Domain\Payments\Providers\PaymentInterface;
use App\Domain\Payments\Providers\Paypal;
use App\Domain\Payments\Providers\Stripe;
use App\Domain\Repositories\Interfaces\BaseInterface;
use App\Domain\Repositories\Interfaces\BusinessRepositoryInterface;

class PaymentProvider
{
    public function __construct(private PaymentInterface $payment, protected BaseInterface $repository)
    {
    }

    public function pay()
    {
        $latestPayment = $this->repository->getAllByUser(auth()->id())->last();

        if ($latestPayment) {
            return $this->payment->pay($latestPayment->valid_till);
        }
        return $this->payment->pay();
    }


}
