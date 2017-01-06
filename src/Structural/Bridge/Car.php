<?php
namespace App\Structural\Bridge;

/**
 * 经过改良的抽象实现：Car
 * Class Car
 * @package App\Structural\Bridge
 */
class Car extends Vehicle
{
    public function __construct(Workshop $workshop1, Workshop $workshop2)
    {
        parent::__construct($workshop1, $workshop2);
    }

    public function manufacture()
    {
        print 'Car' . PHP_EOL;
        $this->workShop1->work();
        $this->workShop2->work();
    }
}