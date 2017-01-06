<?php
namespace App\Creational\FactoryMethod;

/**
 * ItalianFactory是意大利的造车厂
 * Class ItalianFactory
 * @package App\Creational\FactoryMethod
 */
class ItalianFactory extends FactoryMethod
{
    /**
     * {@inheritdoc}
     * @param string $type
     * @return Bicycle|Ferrari
     */
    protected function createVehicle($type)
    {
        switch ($type) {
            case parent::CHEAP:
                return new Bicycle();
                break;
            case parent::FAST:
                return new Ferrari();
                break;
            default:
                throw new \InvalidArgumentException("{$type} is not a vaild vehicle.");
        }
    }
}