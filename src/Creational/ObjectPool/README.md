#对象池模式

##1、模式定义
<p style="text-indent:2em;">对象池（也称为资源池）被用来管理对象缓存。对象池是一组已经初始化过且可以直接使用的对象集合，用户在使用对象时可以从对象池中获取对象，对其进行操作处理，并在不需要时归还给对象池而非销毁它。</p>

<p style="text-indent:2em;">若对象初始化、实例化的代价高，且需要经常实例化，但每次实例化的数量较少的情况下，使用对象池可以获得显著的性能提升。常见的使用对象池模式的技术包括线程池、数据库连接池、任务队列池、图片资源对象池等。</p>

<p style="text-indent:2em;">当然，如果要实例化的对象较小，不需要多少资源开销，就没有必要使用对象池模式了，这非但不会提升性能，反而浪费内存空间，甚至降低性能。</p>

##2、UML类图

![UML类图](http://laravelacademy.org/wp-content/uploads/2015/12/uml16.png)

##3、示例代码

**Pool.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Pool;

class Pool
{

    private $instances = array();
    private $class;

    public function __construct($class)
    {
        $this->class = $class;
    }

    public function get()
    {
        if (count($this->instances) > 0) {
            return array_pop($this->instances);
        }

        return new $this->class();
    }

    public function dispose($instance)
    {
        $this->instances[] = $instance;
    }
}
</code></pre>

**Processor.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Pool;

class Processor
{

    private $pool;
    private $processing = 0;
    private $maxProcesses = 3;
    private $waitingQueue = [];

    public function __construct(Pool $pool)
    {
        $this->pool = $pool;
    }

    public function process($image)
    {
        if ($this->processing++ < $this->maxProcesses) {
            $this->createWorker($image);
        } else {
            $this->pushToWaitingQueue($image);
        }
    }

    private function createWorker($image)
    {
        $worker = $this->pool->get();
        $worker->run($image, array($this, 'processDone'));
    }

    public function processDone($worker)
    {
        $this->processing--;
        $this->pool->dispose($worker);

        if (count($this->waitingQueue) > 0) {
            $this->createWorker($this->popFromWaitingQueue());
        }
    }

    private function pushToWaitingQueue($image)
    {
        $this->waitingQueue[] = $image;
    }

    private function popFromWaitingQueue()
    {
        return array_pop($this->waitingQueue);
    }
}
</code></pre>

**Worker.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Pool;

class Worker
{

    public function __construct()
    {
        // let's say that constuctor does really expensive work...
        // for example creates "thread"
    }

    public function run($image, array $callback)
    {
        // do something with $image...
        // and when it's done, execute callback
        call_user_func($callback, $this);
    }
}
</code></pre>

##4、测试代码

**Tests/PoolTest.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Pool\Tests;

use DesignPatterns\Creational\Pool\Pool;

class PoolTest extends \PHPUnit_Framework_TestCase
{
    public function testPool()
    {
        $pool = new Pool('DesignPatterns\Creational\Pool\Tests\TestWorker');
        $worker = $pool->get();

        $this->assertEquals(1, $worker->id);

        $worker->id = 5;
        $pool->dispose($worker);

        $this->assertEquals(5, $pool->get()->id);
        $this->assertEquals(1, $pool->get()->id);
    }
}
</code></pre>

**Tests/TestWorker.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Pool\Tests;

class TestWorker
{
    public $id = 1;
}
</code></pre>