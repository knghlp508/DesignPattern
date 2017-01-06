<?php
namespace App\Structural\Bridge;

/**
 * Workshop类
 * 实现类 Produce 和 Assemble 负责具体生产及组装，
 * 从而实现抽象（Vehicle）与实现（Workshop）的分离，让两者可以独立变化而不相互影响
 * Interface Workshop
 * @package App\Structural\Bridge
 */
interface Workshop
{
    /**
     * @return mixed
     */
    public function work();
}