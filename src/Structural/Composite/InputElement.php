<?php
namespace App\Structural\Composite;

/**
 * Class InputElement
 * @package App\Structural\Composite
 */
class InputElement extends Form
{
    /**
     * 渲染input元素
     * @param int $indent
     * @return mixed|string
     */
    public function render($indent = 0)
    {
        return str_repeat(' ', $indent) . '<input type="text" />';
    }
}