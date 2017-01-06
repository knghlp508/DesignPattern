<?php
namespace App\Structural\DependencyInjection;

/**
 * Interface Parameters
 * @package App\Structural\DependencyInjection
 */
interface Parameters
{
    /**
     * 获取参数
     * @param string|integer $key
     * @return mixed
     */
    public function get($key);

    /**
     * 设置参数
     * @param string|integer $key
     * @param mixed $value
     * @return mixed
     */
    public function set($key, $value);
}