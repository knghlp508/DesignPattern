<?php
namespace App\Structural\Bridge\Tests;

use App\Structural\Bridge\Assemble;
use App\Structural\Bridge\Car;
use App\Structural\Bridge\Motorcycle;
use App\Structural\Bridge\Produce;

require '../../../../vendor/autoload.php';

/**
 * Class BridgeTest
 * @package App\Structural\Bridge\Tests
 */
class BridgeTest extends \PHPUnit_Framework_TestCase
{
    public function testCar()
    {
        $vehicle = new Car(new Produce(), new Assemble());
        $this->expectOutputString('A car has been produced and assembled.' . PHP_EOL . 'Manufacturing...');
        $vehicle->manufacture();
    }

    public function testMotocycle()
    {
        $vehicle = new Motorcycle(new Produce(), new Assemble());
        $this->expectOutputString('A motocycle has been produced and assembled.' . PHP_EOL . 'Manufacturing...');
        $vehicle->manufacture();
    }
}