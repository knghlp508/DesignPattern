<?php
namespace App\Structural\Bridge;

/**
 * 组装类，Workshop类的实现
 * Class Assemble
 * @package App\Structural\Bridge
 */
class Assemble implements Workshop
{
    public function work()
    {
        print 'Assembled' . PHP_EOL;
    }
}