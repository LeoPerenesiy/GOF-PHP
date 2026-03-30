<?php

namespace Bridge;

// Without BRIDGE
class IphoneRed {

}

class IphoneBlue {

}

class IphoneYellow {

}

class AndroidYellow {

}

class AndroidRed {

}

// ------------------

interface Color {
    public function paint(): string;
}

class Red implements Color {
    public function paint(): string {
        return "Red";
    }
}

class Yellow implements Color {
    public function paint(): string {
        return "Yellow";
    }
}

abstract class Phone {
    protected Color $color;

    public function __construct(Color $color) {
        $this->color = $color;
    }

    abstract public function getInfo(): string;
}

class IPhone extends Phone {
    public function getInfo(): string {
        return "iPhone in " . $this->color->paint();
    }
}

class Android extends Phone {
    public function getInfo(): string {
        return "Android in " . $this->color->paint();
    }
}

$phone1 = new IPhone(new Yellow());
echo $phone1->getInfo();

$phone2 = new Android(new Red());
echo $phone2->getInfo();