<?php
declare(strict_types=1);

namespace App\Domain\Payments;


use App\Domain\Payments\Providers\PaymentInterface;

class PaymentProviderRegistry
{
    protected array $gateways = [];

    public function register($name, PaymentInterface $instance): static
    {
        $this->gateways[$name] = $instance;
        return $this;
    }

    public function find($name)
    {
        if (array_key_exists($name, $this->gateways)) {
            return $this->gateways[$name];
        }

        throw new \RuntimeException("Invalid gateway");
    }
}
