<?php

namespace State;

interface State {
    public function pay(Order $order);
    public function ship(Order $order);
}

class Order {
    private State $state;

    public function __construct() {
        $this->state = new NewState();
    }

    public function setState(State $state) {
        $this->state = $state;
    }

    public function pay() {
        $this->state->pay($this);
    }

    public function ship() {
        $this->state->ship($this);
    }
}

class NewState implements State {

    public function pay(Order $order) {
        echo "💰 Оплата прошла\n";
        $order->setState(new PaidState());
    }

    public function ship(Order $order) {
        echo "❌ Нельзя отправить: не оплачен\n";
    }
}

class PaidState implements State {

    public function pay(Order $order) {
        echo "❌ Уже оплачен\n";
    }

    public function ship(Order $order) {
        echo "📦 Отправлен\n";
        $order->setState(new ShippedState());
    }
}

class ShippedState implements State {

    public function pay(Order $order) {
        echo "❌ Уже отправлен\n";
    }

    public function ship(Order $order) {
        echo "❌ Уже отправлен\n";
    }
}

// --- Использование ---

$order = new Order();

$order->ship(); // нельзя
$order->pay();  // оплачиваем
$order->ship(); // отправляем
$order->pay();  // уже нельзя