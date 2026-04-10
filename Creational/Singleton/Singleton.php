<?php

namespace Singleton;
class Singleton
{
    private static ?Singleton $instance = null;

    private function __construct()
    {
        echo "Создан экземпляр Singleton\n";
    }

    public static function getInstance(): Singleton
    {
        if (self::$instance === null) {
            self::$instance = new Singleton();
        }
        return self::$instance;
    }

    public function doSomething(): void
    {
        echo "Singleton работает\n";
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}