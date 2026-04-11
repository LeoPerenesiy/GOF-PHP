<?php

namespace Memento;


// ===== MEMENTO =====
class Memento {
    private $state;

    public function __construct($state) {
        $this->state = $state;
    }

    public function getState() {
        return $this->state;
    }
}

// ===== ORIGINATOR =====
class Editor {
    private $text = '';

    public function type($text) {
        $this->text .= $text;
    }

    public function getText() {
        return $this->text;
    }

    // сохранить состояние
    public function save() {
        return new Memento($this->text);
    }

    // восстановить состояние
    public function restore(Memento $memento) {
        $this->text = $memento->getState();
    }
}

// ===== CARETAKER =====
class History {
    private $stack = [];

    public function push(Memento $memento) {
        $this->stack[] = $memento;
    }

    public function pop() {
        return array_pop($this->stack);
    }
}

// ===== использование =====

$editor = new Editor();
$history = new History();

$editor->type("Hello ");
$history->push($editor->save());

$editor->type("World");
$history->push($editor->save());

echo $editor->getText(); // Hello World

// undo
$editor->restore($history->pop());

echo "\n" . $editor->getText(); // Hello World (тот же)

// еще undo
$editor->restore($history->pop());

echo "\n" . $editor->getText(); // Hello