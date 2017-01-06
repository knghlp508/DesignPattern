<?php
namespace App\Creational\AbstractFactory;

/**
 * JsonFactory类
 *
 * JsonFactory 是用于创建 JSON 组件的工厂
 * Class JsonFactory
 * @package DesignPattern\Creational\AbstractFactory
 */
class JsonFactory extends AbstractFactory
{
    /**
     * 创建文本组件
     * @param string $text
     * @return Json\Text
     */
    public function createText($text)
    {
        return new Json\Text($text);
    }

    /**
     * 创建图片组件
     * @param string $path
     * @param string $name
     * @return Json\Picture
     */
    public function createPicture($path, $name = '')
    {
        return new Json\Picture($path, $name);
    }
}