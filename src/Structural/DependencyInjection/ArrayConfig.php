<?php
namespace App\Structural\DependencyInjection;

/**
 * 使用数组作为数据源
 * Class ArrayConfig
 * @package App\Structural\DependencyInjection
 */
class ArrayConfig extends AbstractConfig implements Parameters
{
    /**
     * 获取参数
     * @param int|string $key
     * @param null|mixed $default
     * @return null
     */
    public function get($key, $default = null)
    {
        if (isset($this->storage[$key])) return $this->storage[$key];
        return $default;
    }

    /**
     * 设置参数
     * @param int|string $key
     * @param mixed $value
     */
    public function set($key, $value)
    {
        $this->storage[$key]=$value;
    }
}