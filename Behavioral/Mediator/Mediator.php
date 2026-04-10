<?php

namespace Mediator;


// ===== Mediator =====
class DialogMediator
{
    public bool $hasText = false;

    public function notify(string $sender, string $event): void
    {
        if ($sender === 'input' && $event === 'typing') {
            $this->hasText = true;
            echo "Mediator: input has text → button enabled\n";
        }

        if ($sender === 'input' && $event === 'clear') {
            $this->hasText = false;
            echo "Mediator: input empty → button disabled\n";
        }

        if ($sender === 'button' && $event === 'click') {
            if ($this->hasText) {
                echo "Mediator: submit form\n";
            } else {
                echo "Mediator: blocked (no text)\n";
            }
        }
    }
}

// ===== Colleagues =====
class Input
{
    private DialogMediator $mediator;

    public function __construct(DialogMediator $mediator) {
        $this->mediator = $mediator;
    }

    public function type(): void
    {
        $this->mediator->notify('input', 'typing');
    }

    public function clear(): void
    {
        $this->mediator->notify('input', 'clear');
    }
}

class Button
{
    private DialogMediator $mediator;

    public function __construct(DialogMediator $mediator) {
        $this->mediator = $mediator;
    }

    public function click(): void
    {
        $this->mediator->notify('button', 'click');
    }
}

// ===== usage =====

$mediator = new DialogMediator();

$input = new Input($mediator);
$button = new Button($mediator);

$input->type();
$button->click();

$input->clear();
$button->click();