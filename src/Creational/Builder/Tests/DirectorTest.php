<?php
namespace App\Creational\Builder\Tests;

use App\Creational\Builder\BikeBuilder;
use App\Creational\Builder\BuilderInterface;
use App\Creational\Builder\CarBuilder;
use App\Creational\Builder\Director;

require '../../../../vendor/autoload.php';

/**
 * DirectorTest 用于测试建造者模式
 * Class DirectorTest
 * @package App\Creational\Builder\Tests
 */
class DirectorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Director
     */
    protected $director;

    protected function setUp()
    {
        $this->director=new Director();
    }

    public function getBuilder()
    {
        return [
            [new BikeBuilder()],
            [new CarBuilder()]
        ];
    }

    /**
     * 这里我们测试建造过程，客户端并不知道具体的建造者。
     * @param BuilderInterface $builder
     * @dataProvider getBuilder
     */
    public function testBuild(BuilderInterface $builder)
    {
        $newVehicle=$this->director->build($builder);
        $this->assertInstanceOf('App\Creational\Builder\Parts\Vehicle',$newVehicle);
    }
}