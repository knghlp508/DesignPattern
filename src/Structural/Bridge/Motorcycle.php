<?php
namespace App\Structural\Bridge;

/**
 * 经过改良的抽象实现：Motorcycle
 * Class Motorcycle
 * @package App\Structural\Bridge
 */
class Motorcycle extends Vehicle
{
    /**
     * Motorcycle constructor.
     * @param Workshop $workshop1
     * @param Workshop $workshop2
     */
    public function __construct(Workshop $workshop1, Workshop $workshop2)
    {
        parent::__construct($workshop1, $workshop2);
    }

    public function manufacture()
    {
        print 'Motocycle' . PHP_EOL;
        $this->workShop1->work();
        $this->workShop2->work();
    }
}