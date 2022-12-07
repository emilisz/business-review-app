<?php

namespace App\Http\Controllers;


use App\Domain\Repositories\PaymentRepository;
use App\Domain\Repositories\RepositoryInterface;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;

class PaymentController extends Controller
{
    public function __construct(protected RepositoryInterface $repository)
    {
    }

    public function index()
    {
        $latestPayment = (new PaymentRepository)->getAllByUser(auth()->id())->last();
        return view('payments.payment')
            ->with([
                'premiumDays' => config('constants.premium_days'),
                'premiumPrice' => config('constants.premium_price'),
                'providers' => config('constants.payment_providers'),
                'latestPayment' => $latestPayment
            ]);
    }


    public function store(StorePaymentRequest $request): \Illuminate\Http\RedirectResponse
    {
       $payment = Payment::pay($request->validated());

        return redirect()
            ->route('dashboard')
            ->with('status','Payment with '.$payment->payment_method.' saved. And is valid till '. $payment->valid_till->diffForHumans());
    }

}
