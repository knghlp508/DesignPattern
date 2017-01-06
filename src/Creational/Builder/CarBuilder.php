<?php
namespace App\Creational\Builder;


use App\Creational\Builder\Parts\Car;
use App\Creational\Builder\Parts\Door;
use App\Creational\Builder\Parts\Engine;
use App\Creational\Builder\Parts\Wheel;

class CarBuilder implements BuilderInterface
{
    /**
     * @var Parts\Car
     */
    protected $car;

    /**
     * {@inheritdoc}
     */
    public function addDoors()
    {
        $this->car->setPart('leftDoor',new Door());
        $this->car->setPart('rightDoor',new Door());
    }

    /**
     * {@inheritdoc}
     */
    public function addEngine()
    {
        $this->car->setPart('engine',new Engine());
    }

    /**
     * {@inheritdoc}
     */
    public function addWheel()
    {
        $this->car->setPart('wheelLF',new Wheel());
        $this->car->setPart('wheelRF',new Wheel());
        $this->car->setPart('wheelLR',new Wheel());
        $this->car->setPart('wheelRR',new Wheel());
    }

    /**
     * {@inheritdoc}
     */
    public function createVehicle()
    {
        $this->car=new Car();
    }

    /**
     * @return Car
     */
    public function getVehicle()
    {
        return $this->car;
    }
}