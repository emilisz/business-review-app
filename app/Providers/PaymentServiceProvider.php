<?php

namespace App\Providers;

use App\Domain\Payments\PaymentProviderRegistry;
use App\Domain\Payments\Providers\Paypal;
use App\Domain\Payments\Providers\Stripe;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{

    public function register(): void
    {
        $this->app->singleton(PaymentProviderRegistry::class);
    }

    public function boot(): void
    {
        $this->app->make(PaymentProviderRegistry::class)
            ->register("paypal", new Paypal(config('constants.payments_providers.paypal.api_key')))
            ->register("stripe", new Stripe(config('constants.payments_providers.stripe.api_key')));
    }
}
