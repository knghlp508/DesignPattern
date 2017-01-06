<?php
namespace App\Structural\Decorator\Tests;

use App\Structural\Decorator\RenderInJson;
use App\Structural\Decorator\RenderInXml;
use App\Structural\Decorator\Webservice;

require '../../../../vendor/autoload.php';

class DecoratorTest extends \PHPUnit_Framework_TestCase
{
    protected $service;

    protected function setUp()
    {
        $this->service = new Webservice(array('foo' => 'bar'));
    }

    public function testJsonDecorator()
    {
        // Wrap service with a JSON decorator for renderers
        $service = new RenderInJson($this->service);
        // Our Renderer will now output JSON instead of an array
        $this->assertEquals('{"foo":"bar"}', $service->renderData());
    }

    public function testXmlDecorator()
    {
        // Wrap service with a XML decorator for renderers
        $service = new RenderInXml($this->service);
        // Our Renderer will now output XML instead of an array
        $xml = '<?xml version="1.0"?><foo>bar</foo>';
        $this->assertXmlStringEqualsXmlString($xml, $service->renderData());
    }

    /**
     * The first key-point of this pattern :
     */
    public function testDecoratorMustImplementsRenderer()
    {
        $className = 'App\Structural\Decorator\Decorator';
        $interfaceName = 'App\Structural\Decorator\RendererInterface';
        $this->assertTrue(is_subclass_of($className, $interfaceName));
    }

    /**
     * Second key-point of this pattern : the decorator is type-hinted
     *
     * @expectedException \PHPUnit_Framework_Error
     */
    public function testDecoratorTypeHinted()
    {
        if (version_compare(PHP_VERSION, '7', '>=')) {
            throw new \PHPUnit_Framework_Error('Skip test for PHP 7', 0, __FILE__, __LINE__);
        }

        $this->getMockForAbstractClass('App\Structural\Decorator\Decorator', array(new \stdClass()));
    }

    /**
     * Second key-point of this pattern : the decorator is type-hinted
     *
     * @requires PHP 7
     * @expectedException TypeError
     */
    public function testDecoratorTypeHintedForPhp7()
    {
        $this->getMockForAbstractClass('App\Structural\Decorator\Decorator', array(new \stdClass()));
    }

    /**
     * The decorator implements and wraps the same interface
     */
    public function testDecoratorOnlyAcceptRenderer()
    {
        $mock = $this->createMock('App\Structural\Decorator\RendererInterface');
        $dec = $this->getMockForAbstractClass('App\Structural\Decorator\Decorator', array($mock));
        $this->assertNotNull($dec);
    }
}