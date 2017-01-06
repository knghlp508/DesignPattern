<?php
namespace App\Creational\FactoryMethod;

/**
 * Ferrari（法拉利）
 * Class Ferrari
 * @package App\Creational\FactoryMethod
 */
class Ferrari implements VehicleInterface
{
    /**
     * @var string
     */
    protected $color;

    /**
     * @param string $rgb
     */
    public function setColor($rgb)
    {
        $this->color = $rgb;
    }
}