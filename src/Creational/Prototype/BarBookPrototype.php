<?php
namespace App\Creational\Prototype;

/**
 * Class BarBookPrototype
 * @package App\Creational\Prototype
 */
class BarBookPrototype extends BookPrototype
{
    /**
     * @var string
     */
    protected $category = 'Bar';

    /**
     * empty clone
     */
    public function __clone()
    {

    }
}