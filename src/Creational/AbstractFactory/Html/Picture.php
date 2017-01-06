<?php
namespace App\Creational\AbstractFactory\Html;

use App\Creational\AbstractFactory\Picture as BasePicture;

/**
 * Picture类
 *
 * 该类是以 HTML 格式渲染的具体图片类
 * Class Picture
 * @package DesignPattern\AbstractFactory\Html
 */
class Picture extends BasePicture
{
    /**
     * HTML格式输出的图片
     * @return string
     */
    public function render()
    {
        return sprintf('<img src="%s" title="%s" />', $this->path, $this->name);
    }
}