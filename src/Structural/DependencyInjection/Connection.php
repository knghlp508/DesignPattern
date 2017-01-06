<?php
namespace App\Structural\DependencyInjection;

/**
 * 依赖注入模式需要在调用者外部完成容器创建以及容器中接口与实现类的运行时绑定工作，
 * 在 Laravel 中该容器就是服务容器，而接口与实现类的运行时绑定则在服务提供者中完成。
 * 此外，除了在调用者的构造函数中进行依赖注入外，还可以通过在调用者的方法中进行依赖注入。
 * Class Connection
 * @package App\Structural\DependencyInjection
 */
class Connection
{
    /**
     * 主机配置
     * @var Parameters
     */
    protected $configuration;

    /**
     * 目前连接的主机
     * @var
     */
    protected $host;

    /**
     * Connection constructor.
     * @param Parameters $config
     */
    public function __construct(Parameters $config)
    {
        $this->configuration=$config;
    }

    /**
     * 使用初始化依赖注入的配置连接主机
     */
    public function connect()
    {
        $host=$this->configuration->get('host');
        //连接主机，验证等...

        //如果连接成功
        $this->host=$host;
    }

    /**
     * 获取当前连接的主机
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }
}