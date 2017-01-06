<?php
namespace App\Creational\AbstractFactory;

/**
 * 抽象工厂类
 *
 * 该设计模式实现了设计模式的依赖倒置原则，因为最终由具体子类创建具体组件
 *
 * 在本例中，抽象工厂为创建 Web 组件（产品）提供了接口，这里有两个组件：文本和图片，有两种渲染方式：HTML
 * 和 JSON，对应四个具体实现类。
 *
 * 尽管有四个具体类，但是客户端只需要知道这个接口可以用于构建正确的 HTTP 响应即可，无需关心其具体实现。
 * Class AbstractFactory
 * @package DesignPattern\AbstractFactory
 */
abstract class AbstractFactory
{
    /**
     * 创建文本组件
     * @param string $text 文本内容
     * @return mixed
     */
    abstract public function createText($text);

    /**
     * 创建图片组件
     * @param string $path 图片路径
     * @param string $name 图片名称，默认为空
     * @return mixed
     */
    abstract public function createPicture($path, $name = '');
}