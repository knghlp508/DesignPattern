<?php
namespace App\Creational\AbstractFactory\Json;

use App\Creational\AbstractFactory\Text as BaseText;

/**
 * Text类
 *
 * 该类是以 JSON 格式输出的具体文本组件类
 * Class Text
 * @package DesignPattern\AbstractFactory\Json
 */
class Text extends BaseText
{
    /**
     * JSON格式输出的渲染
     * @return string
     */
    public function render()
    {
        return json_encode(['content' => $this->text]);
    }
}