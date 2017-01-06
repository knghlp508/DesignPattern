<?php
namespace App\Structural\Bridge;

/**
 * 车辆抽象类
 *
 * 系统设计时，发现类的继承有 N 层时，可以考虑使用桥梁模式。
 * 使用桥梁模式时主要考虑如何拆分抽象和实现，并不是一涉及继承就要考虑使用该模式。
 * 桥梁模式的意图还是对变化的封装，尽量把可能变化的因素封装到最细、最小的逻辑单元中，避免风险扩散。
 * Class Vehicle
 * @package App\Structural\Bridge
 */
abstract class Vehicle
{
    /**
     * @var Workshop
     */
    protected $workShop1;

    /**
     * @var Workshop
     */
    protected $workShop2;

    /**
     * Vehicle constructor.
     * @param Workshop $workshop1
     * @param Workshop $workshop2
     */
    protected function __construct(Workshop $workshop1, Workshop $workshop2)
    {
        $this->workShop1 = $workshop1;
        $this->workShop2 = $workshop2;
    }

    /**
     * @return mixed
     */
    abstract public function manufacture();
}