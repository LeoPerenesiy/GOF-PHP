<?php

namespace Flyweight;

// === Flyweight (общий объект) ===
class CharacterFlyweight {
    private string $char;

    public function __construct(string $char) {
        $this->char = $char;
    }

    // внешнее состояние: позиция
    public function render(int $position) {
        echo "Char '{$this->char}' at position {$position}\n";
    }
}

// === Factory (пул объектов) ===
class CharacterFactory {
    private array $pool = [];

    public function get(string $char): CharacterFlyweight {
        if (!isset($this->pool[$char])) {
            $this->pool[$char] = new CharacterFlyweight($char);
        }

        return $this->pool[$char];
    }

    public function count(): int {
        return count($this->pool);
    }
}

// === Client ===
$factory = new CharacterFactory();

$text = "hello world";

for ($i = 0; $i < strlen($text); $i++) {
    $char = $text[$i];

    if ($char === ' ') continue;

    $flyweight = $factory->get($char);
    $flyweight->render($i);
}

echo "Objects created: " . $factory->count() . "\n";