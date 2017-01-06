<?php
namespace App\Creational\FactoryMethod;

/**
 * GermanFactory是德国的造车厂
 * Class GermanFactory
 * @package App\Creational\FactoryMethod
 */
class GermanFactory extends FactoryMethod
{
    /**
     * {@inheritdoc}
     * @param string $type
     * @return Bicycle|Porsche
     */
    protected function createVehicle($type)
    {
        switch ($type) {
            case parent::CHEAP:
                return new Bicycle();
                break;
            case parent::FAST:
                $obj = new Porsche();
                //因为我们已经知道是什么对象所以可以调用具体方法
                $obj->addTuningAMG();
                return $obj;
                break;
            default:
                throw new \InvalidArgumentException("{$type} is not a vaild vehicle.");
        }
    }
}