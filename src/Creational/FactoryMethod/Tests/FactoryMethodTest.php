<?php
namespace App\Creational\FactoryMethod\Tests;

require '../../../../vendor/autoload.php';

use App\Creational\FactoryMethod\FactoryMethod;
use App\Creational\FactoryMethod\GermanFactory;
use App\Creational\FactoryMethod\ItalianFactory;

class FactoryMethodTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    protected $type=[
        FactoryMethod::CHEAP,
        FactoryMethod::FAST
    ];

    /**
     * @return array
     */
    public function getShop()
    {
        return [
            [new ItalianFactory()],
            [new GermanFactory()]
        ];
    }

    /**
     * @param FactoryMethod $shop
     * @dataProvider getShop
     */
    public function testCreation(FactoryMethod $shop)
    {
        //该方法扮演客户端角色，我们不关心什么工厂，我们只知道可以可以用它来造车
        foreach ($this->type as $oneType) {
            $vehicle=$shop->create($oneType);
            $this->assertInstanceOf('App\Creational\FactoryMethod\VehicleInterface',$vehicle);
        }
    }

    /**
     * @param FactoryMethod $shop
     * @dataProvider getShop
     * @expectedException  \InvalidArgumentException
     * @expectedExceptionMessage Spaceship is not a vaild vehicle.
     */
    public function testUnknowType(FactoryMethod $shop)
    {
        //用来测试工厂无法制造的车辆，比如下面的飞船→_→
        /*测试后会发现报错两次
            其实是因为客户想制造飞船，而该工厂有意大利和德国两个制造工厂。
            客户分别前往两个工厂，都被拒绝，因为这两个工厂都无法生产飞船。
            所以会报错两次*/
        $shop->create('spaceship');
    }
}