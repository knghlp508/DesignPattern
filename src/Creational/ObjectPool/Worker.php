<?php
namespace App\Creational\ObjectPool;

/**
 * Class Worker
 * @package App\Creational\ObjectPool
 */
class Worker
{
    /**
     * Worker constructor.
     */
    public function __construct()
    {
        // let's say that constuctor does really expensive work...
        // for example creates "thread"
    }

    /**
     * @param mixed $image
     * @param array $callback
     */
    public function run($image, array $callback)
    {
        // 执行$Image相关逻辑
        // 执行完毕后，回调$callback
        call_user_func($callback, $this);
    }
}