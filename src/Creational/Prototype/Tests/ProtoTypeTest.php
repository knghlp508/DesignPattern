<?php
namespace App\Creational\Prototype\Tests;

use App\Creational\Prototype\BarBookPrototype;
use App\Creational\Prototype\BookPrototype;
use App\Creational\Prototype\FooBookPrototype;

require '../../../../vendor/autoload.php';

class ProtoTypeTest extends \PHPUnit_Framework_TestCase
{
    public function getPrototype()
    {
        return [
            [new BarBookPrototype()],
            [new FooBookPrototype()]
        ];
    }

    /**
     * @param BookPrototype $prototype
     * @dataProvider getPrototype
     */
    public function testCreation(BookPrototype $prototype)
    {
        $book=clone $prototype;
        $book->setTitle($book->getCategory().' Book');
        $this->assertInstanceOf('App\Creational\Prototype\BookPrototype',$book);
    }
}