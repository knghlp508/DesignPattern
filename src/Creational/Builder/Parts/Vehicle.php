<?php
namespace App\Creational\Builder\Parts;

/**
 * VehicleInterface是车辆接口
 * Class Vehicle
 * @package App\Creational\Builder\Parts
 */
abstract class Vehicle
{
    /**
     * @var
     */
    protected $data;

    /**
     * @param $key
     * @param $value
     */
    public function setPart($key, $value)
    {
        $this->data[$key] = $value;
    }
}