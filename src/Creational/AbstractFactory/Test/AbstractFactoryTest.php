<?php
namespace App\Creational\AbstractFactory\Tests;

use App\Creational\AbstractFactory\AbstractFactory;
use App\Creational\AbstractFactory\HtmlFactory;
use App\Creational\AbstractFactory\JsonFactory;

require '../../../../vendor/autoload.php';

/**
 * AbstractFactoryTest 用于测试具体的工厂
 * Class AbstractFactoryTest
 * @package DesignPattern\Creational\createtional\AbstractFactory\Tests
 */
class AbstractFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getFactories()
    {
        return [
            [new JsonFactory()],
            [new HtmlFactory()]
        ];
    }

    /**
     * 这里是工厂的客户端，我们无需关心传递过来的是什么工厂类，
     * 只需以我们想要的方式渲染任意想要的组件即可。
     * @param AbstractFactory $factory
     * @dataProvider getFactories
     */
    public function testComponentCreation(AbstractFactory $factory)
    {
        $article = [
            $factory->createText('Laravel学院'),
            $factory->createPicture('/image.jpg', 'laravel-academy'),
            $factory->createText('LaravelAcademy.org')
        ];
        $this->assertContainsOnly('App\Creational\AbstractFactory\MediaInterface', $article);
    }
}