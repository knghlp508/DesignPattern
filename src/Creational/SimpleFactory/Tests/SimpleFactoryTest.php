<?php
namespace App\Creational\SimpleFactory\Tests;

use App\Creational\SimpleFactory\ConcreteFactory;

require '../../../../vendor/autoload.php';

class SimpleFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ConcreteFactory
     */
    protected $factory;

    protected function setUp()
    {
        $this->factory=new ConcreteFactory();
    }

    public function getType()
    {
        return [
            ['bicycle'],
            ['other']
        ];
    }

    /**
     * @param mixed $type
     * @dataProvider getType
     */
    public function testCreation($type)
    {
        $obj=$this->factory->createVehicle($type);
        $this->assertInstanceOf('App\Creational\SimpleFactory\VehicleInterface',$obj);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testBadType()
    {
        $this->factory->createVehicle('car');
    }
}