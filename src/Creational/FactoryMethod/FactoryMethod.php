<?php
namespace App\Creational\FactoryMethod;

/**
 * 工厂方法抽象类
 *
 * 工厂方法模式和抽象工厂模式有点类似，但也有不同。
 * 工厂方法针对每一种产品提供一个工厂类，通过不同的工厂实例来创建不同的产品实例，在同一等级结构中，支持增加任意产品。
 * 抽象工厂是应对产品族概念的，比如说，每个汽车公司可能要同时生产轿车，货车，客车，
 * 那么每一个工厂都要有创建轿车，货车和客车的方法。应对产品族概念而生，增加新的产品线很容易，但是无法增加新的产品。
 * Class FactoryMethod
 * @package App\Creational\FactoryMethod
 */
abstract class FactoryMethod
{
    /**
     * 便宜的
     */
    const CHEAP = 1;

    /**
     * 跑得快的
     */
    const FAST = 2;

    /**
     * 子类必须实现该方法
     * @param string $type 通用的类型
     * @return VehicleInterface 新的车辆
     */
    abstract protected function createVehicle($type);

    /**
     * 创建新的车辆
     * @param integer $type
     * @return VehicleInterface
     */
    public function create($type)
    {
        $obj = $this->createVehicle($type);
        $obj->setColor('#f00');
        return $obj;
    }
}