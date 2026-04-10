<?php

namespace Proxy;

interface Image {
    public function display(): void;
}

class RealImage implements Image {
    private string $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
        $this->loadFromDisk();
    }

    private function loadFromDisk(): void {
        echo "Loading {$this->filename}\n";
    }

    public function display(): void {
        echo "Displaying {$this->filename}\n";
    }
}

class ImageProxy implements Image {
    private ?RealImage $realImage = null;
    private string $filename;

    public function __construct(string $filename) {
        $this->filename = $filename;
    }

    public function display(): void {
        // Lazy loading
        if ($this->realImage === null) {
            $this->realImage = new RealImage($this->filename);
        }

        $this->realImage->display();
    }
}

$image = new ImageProxy("photo.jpg");

// Тут ещё НЕ загружено
$image->display();