<?php

namespace Prototype;

interface Prototype {
    public function clone();
}

class UserProfile implements Prototype {
    public string $name;
    public array $settings;

    public function __construct(string $name, array $settings) {
        $this->name = $name;
        $this->settings = $settings;
    }

    public function clone(): UserProfile
    {
        return clone $this;
    }
}

$defaultProfile = new UserProfile('Default', ['theme' => 'dark']);

$user1 = $defaultProfile->clone();
$user1->name = 'Leo';

$user2 = $defaultProfile->clone();
$user2->name = 'Anna';