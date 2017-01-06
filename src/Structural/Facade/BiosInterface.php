<?php
namespace App\Structural\Facade;

/**
 * Interface BiosInterface
 * @package App\Structural\Facede
 */
interface BiosInterface
{
    /**
     * 执行BIOS
     * @return mixed
     */
    public function execute();

    /**
     * 等待键入
     * @return mixed
     */
    public function waitForKeyPress();

    /**
     * 启动OS
     * @param OsInterface $os
     * @return mixed
     */
    public function launch(OsInterface $os);

    /**
     * 关闭BIOS
     * @return mixed
     */
    public function powerDown();
}