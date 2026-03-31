<?php

namespace Builder;

class House
{
    public int $rooms;
    public int $floors;
}

interface Builder
{
    public function setRooms(int $rooms): self;
    public function setFloors(int $floors): self;
    public function getResult(): House;
}

class HouseBuilder implements Builder
{
    private House $house;

    public function __construct()
    {
        $this->house = new House();
    }

    public function setRooms(int $rooms): self
    {
        $this->house->rooms = $rooms;
        return $this;
    }

    public function setFloors(int $floors): self
    {
        $this->house->floors = $floors;
        return $this;
    }

    public function getResult(): House
    {
        return $this->house;
    }
}

$builder = new HouseBuilder();

$house = $builder
    ->setRooms(3)
    ->setFloors(2)
    ->getResult();

var_dump($house);