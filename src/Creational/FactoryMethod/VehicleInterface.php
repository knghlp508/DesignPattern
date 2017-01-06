<?php
namespace App\Creational\FactoryMethod;

/**
 * VehicleInterface是车辆接口
 * Interface VehicleInterface
 * @package App\Creational\FactoryMethod
 */
interface VehicleInterface
{
    /**
     * 设置车的颜色
     * @param string $rgb
     * @return mixed
     */
    public function setColor($rgb);
}