<?php
namespace App\Structural\Bridge;

/**
 * 生产类，Workshop类的实现
 * Class Produce
 * @package App\Structural\Bridge
 */
class Produce implements Workshop
{
    public function work()
    {
        print 'Produced' . PHP_EOL;
    }
}