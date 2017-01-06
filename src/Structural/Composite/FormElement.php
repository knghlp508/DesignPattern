<?php
namespace App\Structural\Composite;

/**
 * Class FormElement
 * @package App\Structural\Composite
 */
class FormElement extends Form
{
    /**
     * @var array|Form[]
     */
    protected $elements;

    /**
     * 遍历所有元素并调用它们的render()方法, 然后返回返回完整的表单显示
     *
     * 但是从外部来看, 并没有看见组合过程, 就像是单个表单实例一样
     * @param int $indent
     * @return string
     */
    public function render($indent = 0)
    {
        $formCode = '';
        foreach ($this->elements as $element) {
            $formCode .= $element->render($indent + 1) . PHP_EOL;
        }
        return $formCode;
    }

    /**
     * @param Form $element
     */
    public function addElement(Form $element)
    {
        $this->elements[] = $element;
    }
}