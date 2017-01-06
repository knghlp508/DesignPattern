<?php
namespace App\Creational\AbstractFactory;

/**
 * HtmlFactory类
 *
 * HtmlFactory 是用于创建 HTML 组件的工厂
 * Class HtmlFactory
 * @package DesignPattern\AbstractFactory
 */
class HtmlFactory extends AbstractFactory
{
    /**
     * 创建文本组件
     * @param string $text
     */
    public function createText($text)
    {
        return new Html\Text($text);
    }

    /**
     * 创建图片组件
     * @param string $path
     * @param string $name
     */
    public function createPicture($path, $name = '')
    {
        return new Html\Picture($path, $name);
    }
}