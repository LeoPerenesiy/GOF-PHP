<?php

namespace TemplateMethod;

// (Template)
abstract class OrderProcessor
{
    // 🔥 Шаблонный метод (алгоритм фиксирован)
    public function process()
    {
        $this->validate();
        $this->calculateTotal();
        $this->pay();
        $this->afterPay(); // hook (необязательный шаг)
    }

    // Обязательные шаги (надо реализовать)
    abstract protected function validate();
    abstract protected function calculateTotal();
    abstract protected function pay();

    // Hook (можно не переопределять)
    protected function afterPay()
    {
        // по умолчанию ничего не делаем
    }
}


// ==========================
// Конкретная реализация #1
// ==========================
class StripeOrderProcessor extends OrderProcessor
{
    protected function validate()
    {
        echo "Validate Stripe order\n";
    }

    protected function calculateTotal()
    {
        echo "Calculate total with Stripe fees\n";
    }

    protected function pay()
    {
        echo "Pay via Stripe\n";
    }

    protected function afterPay()
    {
        echo "Send Stripe receipt email\n";
    }
}


// ==========================
// Конкретная реализация #2
// ==========================
class CryptoOrderProcessor extends OrderProcessor
{
    protected function validate()
    {
        echo "Validate crypto wallet\n";
    }

    protected function calculateTotal()
    {
        echo "Calculate total in BTC\n";
    }

    protected function pay()
    {
        echo "Send crypto transaction\n";
    }

    // afterPay не переопределяем → hook не используется
}


// ==========================
// Использование
// ==========================
$stripe = new StripeOrderProcessor();
$stripe->process();

echo "------\n";

$crypto = new CryptoOrderProcessor();
$crypto->process();