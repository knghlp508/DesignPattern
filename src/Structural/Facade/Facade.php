<?php
namespace App\Structural\Facade;

/**
 * 门面模式对客户屏蔽子系统组件，因而减少了客户处理的对象的数目并使得子系统使用起来更加方便；
 * 实现了子系统与客户之间的松耦合关系，而子系统内部的功能组件往往是紧耦合的，
 * 松耦合关系使得子系统的组件变化不会影响到它的客户；如果应用需要，门面模式并不限制客户程序使用子系统类，
 * 因此你可以让客户程序在系统易用性和通用性之间加以选择。
 * Laravel 中门面模式的使用也很广泛，基本上每个服务容器中注册的服务提供者类都对应一个门面类。
 * Class Facade
 * @package App\Structural\Facade
 */
class Facade
{
    protected $os;

    protected $bios;

    /**
     * 使用依赖注入来创建两个类的实例
     * Facade constructor.
     * @param BiosInterface $bios
     * @param OsInterface $os
     */
    public function __construct(BiosInterface $bios, OsInterface $os)
    {
        $this->os=$os;
        $this->bios=$bios;
    }

    /**
     * 打开系统
     */
    public function turnOn()
    {
        $this->bios->execute();
        $this->bios->waitForKeyPress();
        $this->bios->launch($this->os);
    }

    /**
     * 关闭系统
     */
    public function turnOff()
    {
        $this->os->halt();
        $this->bios->powerDown();
    }
}