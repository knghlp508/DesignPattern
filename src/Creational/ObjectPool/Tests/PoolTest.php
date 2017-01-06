<?php
namespace App\Creational\ObjectPool\Tests;

require '../../../../vendor/autoload.php';

use App\Creational\ObjectPool\Pool;

class PoolTest extends \PHPUnit_Framework_TestCase
{
    public function testPool()
    {
        $pool = new Pool('App\Creational\ObjectPool\Tests\TestWorker');
        $worker = $pool->get();

        $this->assertEquals(1, $worker->id);

        $worker->id = 5;
        $pool->dispose($worker);
        $this->assertEquals(5, $pool->get()->id);
        $this->assertEquals(1, $pool->get()->id);
    }
}