<?php

namespace Visitor;

interface Visitor
{
    public function visitUser(User $user): void;
    public function visitOrder(Order $order): void;
}

interface Visitable
{
    public function accept(Visitor $visitor): void;
}

class User implements Visitable
{
    public function __construct(public string $name) {}

    public function accept(Visitor $visitor): void
    {
        $visitor->visitUser($this);
    }
}

class Order implements Visitable
{
    public function __construct(public float $amount) {}

    public function accept(Visitor $visitor): void
    {
        $visitor->visitOrder($this);
    }
}

class LogVisitor implements Visitor
{
    public function visitUser(User $user): void
    {
        echo "User: {$user->name}\n";
    }

    public function visitOrder(Order $order): void
    {
        echo "Order: {$order->amount}\n";
    }
}

class SumVisitor implements Visitor
{
    public float $total = 0;

    public function visitUser(User $user): void
    {
        // ничего
    }

    public function visitOrder(Order $order): void
    {
        $this->total += $order->amount;
    }
}

$items = [
    new User('Leo'),
    new Order(100),
    new Order(50),
];

$visitor = new SumVisitor();

foreach ($items as $item) {
    $item->accept($visitor);
}

echo $visitor->total; // 150