<?php

namespace App\Http\Controllers;


use App\Domain\Payments\PaymentService;
use App\Domain\Repositories\Interfaces\BusinessRepositoryInterface;
use App\Domain\Repositories\PaymentRepository;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function __construct(protected BusinessRepositoryInterface $repository)
    {
    }

    public function index(): View
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


    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $payment = (new PaymentService)->selectProvider($request->validated());

        return redirect()
            ->route('dashboard')
            ->with('status', 'Payment with ' . $payment->payment_method . ' saved. And is valid till ' . $payment->valid_till->diffForHumans());
    }

    public function delete(Payment $payment): RedirectResponse
    {
        $this->repository->delete($payment->id);

        return redirect()->back()->with('status', "Payment Deleted!");
    }

}
