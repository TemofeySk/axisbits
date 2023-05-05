<?php
interface Vehicle {
    public function setSpeed(int $speed): void;

    public function __toString(): string;
}

/*
 * Bus class implementation
 */

class Bus implements Vehicle {
    private int $speed;
    private string $className;

    public function __construct() {
        $this->className = get_called_class();
    }

    public function setSpeed(int $speed): void {
        $this->speed = $speed;
    }

    public function __toString(): string {
        return $this->className . ': ' . $this->speed;
    }
}

$busObj = new Bus();
$busObj->setSpeed(60);
echo $busObj . "\n";

/*
 * Car class implementation
 */

class Car implements Vehicle {
    private int $speed;
    private string $className;

    public function __construct() {
        $this->className = get_called_class();
    }

    public function setSpeed(int $speed): void {
        $this->speed = $speed;
    }

    public function __toString(): string {
        return $this->className . ': ' . $this->speed;
    }
}

$carObj = new Car();
$carObj->setSpeed(70);
echo $carObj . "\n";

/*
 * Bike class implementation
 */

class Bike implements Vehicle {
    private int $speed;
    private string $className;

    public function __construct() {
        $this->className = get_called_class();
    }

    public function setSpeed(int $speed): void {
        $this->speed = $speed;
    }

    public function __toString(): string {
        return $this->className . ': ' . $this->speed;
    }
}

$bikeObj = new Bike();
$bikeObj->setSpeed(120);
echo $bikeObj . "\n";