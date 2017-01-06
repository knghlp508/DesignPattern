<?php
namespace App\Creational\SimpleFactory;

/**
 * 采用简单工厂的优点是可以使用户根据参数获得对应的类实例，避免了直接实例化类，降低了耦合性；
 * 缺点是可实例化的类型在编译期间已经被确定，如果增加新类型，则需要修改工厂，不符合OCP（开闭原则）的原则。
 * 简单工厂需要知道所有要生成的类型，当子类过多或者子类层次过多时不适合使用。
 * Class ConcreteFactory
 * @package App\Creational\SimpleFactory
 */
class ConcreteFactory
{
    /**
     * @var array
     */
    protected $typeList;

    /**
     * 可以在这里注入自己的车子类型
     * ConcreteFactory constructor.
     */
    public function __construct()
    {
        $this->typeList = [
            'bicycle' => __NAMESPACE__ . '\Bicycle',
            'other' => __NAMESPACE__ . '\Scooter'
        ];
    }

    /**
     * 创建车子
     * @param string $type 已知的车子类型
     * @return VehicleInterface
     * @throws \InvalidArgumentException
     */
    public function createVehicle($type)
    {
        if (!array_key_exists($type, $this->typeList)) {
            throw new \InvalidArgumentException("{$type} is not a vaild vehicle.");
        }
        $className = $this->typeList[$type];
        return new $className();
    }
}