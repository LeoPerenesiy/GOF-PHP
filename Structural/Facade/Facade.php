<?php

namespace Facade;


// === Подсистема ===
class CPU {
    public function freeze() {
        echo "CPU: freeze\n";
    }

    public function execute() {
        echo "CPU: execute\n";
    }
}

class Memory {
    public function load() {
        echo "Memory: load data\n";
    }
}

class HardDrive {
    public function read() {
        echo "HardDrive: read data\n";
    }
}

// === Facade ===
class ComputerFacade {
    private CPU $cpu;
    private Memory $memory;
    private HardDrive $hardDrive;

    public function __construct() {
        $this->cpu = new CPU();
        $this->memory = new Memory();
        $this->hardDrive = new HardDrive();
    }

    public function start() {
        echo "Starting computer...\n";
        $this->cpu->freeze();
        $this->memory->load();
        $this->hardDrive->read();
        $this->cpu->execute();
        echo "Computer started!\n";
    }
}

// === Client ===
$computer = new ComputerFacade();
$computer->start();