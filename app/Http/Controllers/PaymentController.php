<?php

namespace App\Http\Controllers;


use App\Domain\Payments\PaymentProvider;
use App\Domain\Payments\PaymentProviderRegistry;
use App\Domain\Repositories\Interfaces\BusinessRepositoryInterface;
use App\Domain\Repositories\PaymentRepository;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PaymentController extends Controller
{
    public function __construct(protected BusinessRepositoryInterface $repository, private PaymentProviderRegistry $registry)
    {
    }

    public function index(): View
    {
        $latestPayment = (new PaymentRepository)->getAllByUser(auth()->id())->latest()->first();
        $paymentProviders = (new PaymentProviderRegistry)->getGateways();

        return view('payments.payment')
            ->with([
                'premiumDays' => config('constants.premium_days'),
                'premiumPrice' => config('constants.premium_price'),
                'providers' => $paymentProviders,
                'latestPayment' => $latestPayment
            ]);
    }


    public function store(StorePaymentRequest $request): RedirectResponse
    {
        $paymentClass = $this->registry->get($request->get('payment_method'));
        $payment = (new PaymentProvider($paymentClass, new PaymentRepository()))->pay();

        return redirect()
            ->route('dashboard')
            ->with('status', 'Payment with ' . $payment->payment_method . ' saved. And is valid till ' . $payment->valid_till);
    }

    public function delete(Payment $payment): RedirectResponse
    {
        $this->repository->delete($payment->id);

        return redirect()->back()->with('status', "Payment Deleted!");
    }

}
