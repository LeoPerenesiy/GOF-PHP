<?php

namespace Observer;

interface Observer {
    public function update($data);
}

// Subject (издатель)
class Order {
    private array $observers = [];

    public function attach(Observer $observer) {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer) {
        foreach ($this->observers as $key => $obs) {
            if ($obs === $observer) {
                unset($this->observers[$key]);
            }
        }
    }

    private function notify($data) {
        foreach ($this->observers as $observer) {
            $observer->update($data);
        }
    }

    public function createOrder($orderId) {
        echo "Order {$orderId} created\n";

        // уведомляем всех подписчиков
        $this->notify($orderId);
    }
}

// Конкретный Observer №1
class EmailNotifier implements Observer {
    public function update($orderId) {
        echo "📧 Email sent for order {$orderId}\n";
    }
}

// Конкретный Observer №2
class Logger implements Observer {
    public function update($orderId) {
        echo "📝 Log: order {$orderId} created\n";
    }
}

// --- Использование ---

$order = new Order();

// подписываемся
$order->attach(new EmailNotifier());
$order->attach(new Logger());

// создаём заказ
$order->createOrder(101);