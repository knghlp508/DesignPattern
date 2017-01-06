<?php
namespace App\Creational\AbstractFactory\Html;

use App\Creational\AbstractFactory\Text as BaseText;

/**
 * Text类
 *
 * 该类是以 HTML 渲染的具体文本组件类
 * Class Text
 * @package DesignPattern\AbstractFactory\Html
 */
class Text extends BaseText
{
    /**
     * HTML输出的文本
     * @return string
     */
    public function render()
    {
        return '<div>' . htmlspecialchars($this->text) . '</div>';
    }
}