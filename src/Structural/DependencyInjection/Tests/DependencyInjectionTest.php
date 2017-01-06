<?php
namespace App\Structural\DependencyInjection\Tests;

use App\Structural\DependencyInjection\ArrayConfig;
use App\Structural\DependencyInjection\Connection;

require '../../../../vendor/autoload.php';

class DependencyInjectionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var
     */
    protected $config;

    /**
     * @var
     */
    protected $source;


    public function setUp()
    {
        $this->source=include 'config.php';
        $this->config=new ArrayConfig($this->source);
    }

    /**
     * @dataProvider setUp
     */
    public function testDependencyInjection()
    {
        $connection=new Connection($this->config);
        $connection->connect();
        $this->assertEquals($this->source['host'],$connection->getHost());
    }
}
