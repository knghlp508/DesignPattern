<?php
namespace App\Structural\Adapter;

/**
 * 电子书接口
 * Interface EBookInterface
 * @package App\Structural\Adapter
 */
interface EBookInterface
{
    /**
     * 电子书翻页
     * @return mixed
     */
    public function pressNext();


    /**
     * 打开电子书
     * @return mixed
     */
    public function pressStart();
}