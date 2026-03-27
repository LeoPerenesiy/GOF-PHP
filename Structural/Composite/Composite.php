<?php

// ❌ BAD
function calculate($item) {
    if ($item->type === 'burger') {
        return 5;
    }

    if ($item->type === 'combo') {
        return 5 + 2 + 1;
    }
}



// ✅ GOOD
interface Item {
    public function price(): int;
}

class Burger implements Item {
    public function price(): int {
        return 5;
    }
}

class Fries implements Item {
    public function price(): int {
        return 2;
    }
}

class Combo implements Item {
    private array $items = [];

    public function add(Item $item): void {
        $this->items[] = $item;
    }

    public function price(): int
    {
        $sum = 0;

        foreach ($this->items as $item) {
            $sum += $item->price();
        }

        return $sum;
    }
}

$burger = new Burger();

$combo = new Combo();
$combo->add(new Burger());
$combo->add(new Fries());
//$combo->add(new Drink());

echo $combo->price();