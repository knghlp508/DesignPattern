<?php
namespace App\Structural\Composite\Tests;

use App\Structural\Composite\FormElement;
use App\Structural\Composite\InputElement;
use App\Structural\Composite\TextElement;

require '../../../../vendor/autoload.php';

class CompositeTest extends \PHPUnit_Framework_TestCase
{
    public function testRender()
    {
        $form = new FormElement();
        $form->addElement(new TextElement());
        $form->addElement(new InputElement());
        $embed = new FormElement();
        $embed->addElement(new TextElement());
        $embed->addElement(new InputElement());
        $form->addElement($embed);  // 这里我们添加一个嵌套树到表单

        $this->assertRegExp('#^\s{4}#m', $form->render());
    }

    /**
     * 组合模式最关键之处在于如果你想要构建组件树每个组件必须实现组件接口
     */
    public function testFormImplementsFormEelement()
    {
        $className = 'App\Structural\Composite\FormElement';
        $abstractName = 'App\Structural\Composite\Form';
        $this->assertTrue(is_subclass_of($className, $abstractName));
    }
}