<?php
namespace App\Creational\Builder;

use App\Creational\Builder\Parts\Bike;
use App\Creational\Builder\Parts\Engine;
use App\Creational\Builder\Parts\Wheel;

/**
 * BikeBuilder用于建造自行车
 * Class BikeBuilder
 * @package App\Creational\Builder
 */
class BikeBuilder implements BuilderInterface
{
    /**
     * @var Parts\Bike
     */
    protected $bike;

    /**
     * {@inheritdoc}
     */
    public function addDoors()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function addEngine()
    {
        $this->bike->setPart('engine',new Engine());
    }

    /**
     * {@inheritdoc}
     */
    public function addWheel()
    {
        $this->bike->setPart('forwardWheel',new Wheel());
        $this->bike->setPart('rearWheel',new Wheel());
    }

    /**
     * {@inheritdoc}
     */
    public function createVehicle()
    {
        $this->bike=new Bike();
    }

    /**
     * @return Bike
     */
    public function getVehicle()
    {
        return $this->bike;
    }
}