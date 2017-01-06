<?php
namespace App\Creational\AbstractFactory\Json;

use App\Creational\AbstractFactory\Picture as BasePicture;

/**
 * Picture类
 *
 * 该类是以 JSON 格式输出的具体图片组件类
 * Class Picture
 * @package DesignPattern\AbstractFactory\Json
 */
class Picture extends BasePicture
{
    /**
     * JSON格式输出
     * @return string
     */
    public function render()
    {
        return json_encode(['title' => $this->name, 'path' => $this->path]);
    }
}