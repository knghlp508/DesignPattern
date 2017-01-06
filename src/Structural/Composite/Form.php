<?php
namespace App\Structural\Composite;

/**
 * Class Form
 * @package App\Structural\Composite
 */
abstract class Form
{
    /**
     * 渲染元素节点
     * @param int $indent
     * @return mixed
     */
    abstract public function render($indent = 0);
}