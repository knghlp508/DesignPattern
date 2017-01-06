#多例模式

##1、模式定义
<p style="text-indent:2em;">多例模式和单例模式类似，但可以返回多个实例。比如我们有多个数据库连接，MySQL、SQLite、Postgres，又或者我们有多个日志记录器，分别用于记录调试信息和错误信息，这些都可以使用多例模式实现。</p>

##2、UML类图

![UML类图](http://laravelacademy.org/wp-content/uploads/2015/12/927f0bf6-9ed3-4367-b5ee-f386ffd50756.png)

##3、示例代码

**Multiton.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Multiton;

/**
 * Multiton类
 */
class Multiton
{
    /**
     *
     * 第一个实例
     */
    const INSTANCE_1 = '1';

    /**
     *
     * 第二个实例
     */
    const INSTANCE_2 = '2';

    /**
     * 实例数组
     *
     * @var array
     */
    private static $instances = array();

    /**
     * 构造函数是私有的，不能从外部进行实例化
     *
     */
    private function __construct()
    {
    }

    /**
     * 通过指定名称返回实例（使用到该实例的时候才会实例化）
     *
     * @param string $instanceName
     *
     * @return Multiton
     */
    public static function getInstance($instanceName)
    {
        if (!array_key_exists($instanceName, self::$instances)) {
            self::$instances[$instanceName] = new self();
        }

        return self::$instances[$instanceName];
    }

    /**
     * 防止实例从外部被克隆
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * 防止实例从外部反序列化
     *
     * @return void
     */
    private function __wakeup()
    {
    }
}

</code></pre>