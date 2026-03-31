<?php

namespace Iterator;

use Iterator;

class UserCollection implements Iterator
{
    private array $users = [];
    private int $position = 0;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function current(): mixed
    {
        return $this->users[$this->position];
    }

    public function key(): mixed
    {
        return $this->position;
    }

    public function next(): void
    {
        $this->position++;
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function valid(): bool
    {
        return isset($this->users[$this->position]);
    }
}