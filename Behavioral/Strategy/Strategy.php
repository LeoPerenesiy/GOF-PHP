<?php

namespace Strategy;

// ❌ BAD
class PaymentService
{
    public function pay(string $method, int $amount): void
    {
        if ($method === 'card') {
            echo "Card payment: $amount\n";
        } elseif ($method === 'paypal') {
            echo "PayPal: $amount\n";
        } elseif ($method === 'crypto') {
            echo "Crypto криптой: $amount\n";
        }
    }
}

interface PaymentServiceInterface
{
    public function pay(int $amount): void;
}

class CardStrategy implements PaymentServiceInterface
{
    public function pay(int $amount): void
    {
        echo "Card payment: $amount\n";
    }
}

class PayPalStrategy implements PaymentServiceInterface
{
    public function pay(int $amount): void
    {
        echo "PayPal payment: $amount\n";
    }
}

class Service
{
    private PaymentServiceInterface $strategy;

    public function setStrategy(PaymentServiceInterface $strategy): void
    {
        $this->strategy = $strategy;
    }

    public function pay(int $amount): void
    {
        $this->strategy->pay($amount);
    }
}

$service = new Service();
$service->setStrategy(new CardStrategy());
$service->pay(100);