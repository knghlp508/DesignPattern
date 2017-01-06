<?php
namespace App\Structural\Composite;

/**
 * Class TextElement
 * @package App\Structural\Composite
 */
class TextElement extends Form
{
    /**
     * 渲染文本元素
     * @param int $indent
     * @return string
     */
    public function render($indent = 0)
    {
        return str_repeat(' ', $indent) . 'this is a text element.';
    }
}