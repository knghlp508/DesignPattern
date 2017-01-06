<?php
namespace App\Creational\ObjectPool;

/**
 * 对象池
 * Class Pool
 * @package App\Creational\ObjectPool
 */
class Pool
{
    /**
     * 实例数组
     * @var array
     */
    private $instances = [];

    /**
     * 实例化的类
     * @var string
     */
    private $class;

    /**
     * Pool constructor.
     * @param $class
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    /**
     * 获取/出栈对象
     * @return mixed
     */
    public function get()
    {
        //如果实例数组不为空，则出栈
        if (count($this->instances) > 0) return array_pop($this->instances);
        return new $this->class();
    }

    /**
     * 处理实例
     * @param $instance
     */
    public function dispose($instance)
    {
        $this->instances[] = $instance;
    }
}