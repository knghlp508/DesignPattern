<?php
namespace App\Creational\SimpleFactory;

/**
 * 车子接口
 * Interface VehicleInterface
 * @package App\Creational\SimpleFactory
 */
interface VehicleInterface
{
    /**
     * @param mixed $destination
     * @return mixed
     */
    public function driveTo($destination);
}