<?php
namespace App\Creational\Prototype;

/**
 * Class FooBookPrototype
 * @package App\Creational\Prototype
 */
class FooBookPrototype extends BookPrototype
{
    /**
     * @var string
     */
    protected $category = 'Foo';

    /**
     * empty clone
     */
    public function __clone()
    {

    }
}