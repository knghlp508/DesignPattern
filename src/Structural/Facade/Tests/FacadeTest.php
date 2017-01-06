<?php
namespace App\Structural\Facade\Tests;

use App\Structural\Facade\Facade as Computer;
use App\Structural\Facade\OsInterface;

require '../../../../vendor/autoload.php';

class FacadeTest extends \PHPUnit_Framework_TestCase
{
    public function getComputer()
    {
        $bios = $this->getMockBuilder('App\Structural\Facade\BiosInterface')
            ->setMethods(['launch', 'execute', 'waitForKeyPress'])
            ->disableAutoload()
            ->getMock();
        $os = $this->getMockBuilder('App\Structural\Facade\OsInterface')
            ->setMethods(['getName'])
            ->disableAutoload()
            ->getMock();
        $bios->expects($this->once())
            ->method('launch')
            ->with($os);
        $os->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('Linux'));

        $facade = new Computer($bios,$os);
        return array([$facade, $os]);
    }

    /**
     * @param Computer $facade
     * @param OsInterface $os
     * @dataProvider getComputer
     */
    public function testComputerOn(Computer $facade, OsInterface $os)
    {
        // 虽然接口很简单
        $facade->turnOn();
        // 但我却能访问更底层的组件
        $this->assertEquals('Linux', $os->getName());
    }
}