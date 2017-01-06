<?php
namespace App\Creational\Builder;

/**
 * 建造者接口
 * Interface BuilderInterface
 * @package App\Creational\Builder
 */
interface BuilderInterface
{
    /**
     * 创建车辆
     * @return mixed
     */
    public function createVehicle();

    /**
     * 添加轮子
     * @return mixed
     */
    public function addWheel();

    /**
     * 添加引擎
     * @return mixed
     */
    public function addEngine();

    /**
     * 添加车门
     * @return mixed
     */
    public function addDoors();

    /**
     * 获取车辆
     * @return mixed
     */
    public function getVehicle();
}