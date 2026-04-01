<?php

namespace Adapter;


// ==========================
// 🔹 ADAPTER
// ==========================

class OldPaymentSystem {
    public function makePayment($amount) {
        return "Paid {$amount} via OLD system";
    }
}

interface PaymentInterface {
    public function pay($amount);
}

class PaymentAdapter implements PaymentInterface {

    private OldPaymentSystem $oldSystem;

    public function __construct(OldPaymentSystem $oldSystem) {
        $this->oldSystem = $oldSystem;
    }

    public function pay($amount) {
        return $this->oldSystem->makePayment($amount);
    }
}

// ==========================
// 🔹 USAGE
// ==========================

// ---- Adapter ----
$oldPayment = new OldPaymentSystem();
$payment = new PaymentAdapter($oldPayment);

echo $payment->pay(100) . PHP_EOL;