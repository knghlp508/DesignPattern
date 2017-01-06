<?php
namespace App\Creational\FactoryMethod;

/**
 * Bicycle（自行车）
 * Class Bicycle
 * @package App\Creational\FactoryMethod
 */
class Bicycle implements VehicleInterface
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
        $this->color=$rgb;
    }
}