#建造者模式

##1、模式定义
<p style="text-indent:2em;">建造者模式将一个复杂的对象的构建与它的表示分离，使得同样的构建过程可以创建不同的表示。</p>

##2、问题引出
<p style="text-indent:2em;">假设我们有个生产车的工厂，可以制造各种车，比如自行车、汽车、卡车等等，如果每辆车都是从头到尾按部就班地造，必然效率低下。</p>

##3、解决办法
<p style="text-indent:2em;">我们可以试着将车的组装和零部件生产分离开来：让一个类似“导演”的角色负责车子组装，而具体造什么样的车需要什么样的零部件让具体的“构造者”去实现，“导演”知道什么样的车怎么造，需要的零部件则让“构造者”去建造，何时完成由“导演”来控制并最终返回给客户端。</p>

##4、UML类图

![UML类图](http://laravelacademy.org/wp-content/uploads/2015/12/77ebaf54-d2d4-4eba-9a36-ef5682f8adfd.png)

##5、示例代码

<b>Director.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder;

/**
 * Director 是建造者模式的一部分，它知道建造者接口并通过建造者构建复杂对象。
 *
 * 可以通过依赖注入建造者的方式构造任何复杂对象
 */
class Director
{

    /**
     * “导演”并不知道具体实现细节
     *
     * @param BuilderInterface $builder
     *
     * @return Parts\Vehicle
     */
    public function build(BuilderInterface $builder)
    {
        $builder->createVehicle();
        $builder->addDoors();
        $builder->addEngine();
        $builder->addWheel();

        return $builder->getVehicle();
    }
}
</code></pre>

<b>BuilderInterface.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder;

/**
 * 建造者接口
 */
interface BuilderInterface
{
    /**
     * @return mixed
     */
    public function createVehicle();

    /**
     * @return mixed
     */
    public function addWheel();

    /**
     * @return mixed
     */
    public function addEngine();

    /**
     * @return mixed
     */
    public function addDoors();

    /**
    * @return mixed
    */
    public function getVehicle();
}
</code></pre>

<b>BikeBuilder.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder;

/**
 * BikeBuilder用于建造自行车
 */
class BikeBuilder implements BuilderInterface
{
    /**
     * @var Parts\Bike
     */
    protected $bike;

    /**
     * {@inheritdoc}
     */
    public function addDoors()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function addEngine()
    {
        $this->bike->setPart('engine', new Parts\Engine());
    }

    /**
     * {@inheritdoc}
     */
    public function addWheel()
    {
        $this->bike->setPart('forwardWheel', new Parts\Wheel());
        $this->bike->setPart('rearWheel', new Parts\Wheel());
    }

    /**
     * {@inheritdoc}
     */
    public function createVehicle()
    {
        $this->bike = new Parts\Bike();
    }

    /**
     * {@inheritdoc}
     */
    public function getVehicle()
    {
        return $this->bike;
    }
}
</code></pre>

<b>CarBuilder.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder;

/**
 * CarBuilder用于建造汽车
 */
class CarBuilder implements BuilderInterface
{
    /**
     * @var Parts\Car
     */
    protected $car;

    /**
     * @return void
     */
    public function addDoors()
    {
        $this->car->setPart('rightdoor', new Parts\Door());
        $this->car->setPart('leftDoor', new Parts\Door());
    }

    /**
     * @return void
     */
    public function addEngine()
    {
        $this->car->setPart('engine', new Parts\Engine());
    }

    /**
     * @return void
     */
    public function addWheel()
    {
        $this->car->setPart('wheelLF', new Parts\Wheel());
        $this->car->setPart('wheelRF', new Parts\Wheel());
        $this->car->setPart('wheelLR', new Parts\Wheel());
        $this->car->setPart('wheelRR', new Parts\Wheel());
    }

    /**
     * @return void
     */
    public function createVehicle()
    {
        $this->car = new Parts\Car();
    }

    /**
     * @return Parts\Car
     */
    public function getVehicle()
    {
        return $this->car;
    }
}
</code></pre>

<b>Parts/Vehicle.php</pre>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder\Parts;

/**
 * VehicleInterface是车辆接口
 */
abstract class Vehicle
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @param string $key
     * @param mixed $value
     */
    public function setPart($key, $value)
    {  
        $this->data[$key] = $value;
    }
}
</code></pre>

<b>Parts/Bike.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder\Parts;

/**
 * Bike
 */
class Bike extends Vehicle
{
}
</code></pre>

<b>Parts/Car.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder\Parts;

/**
 * Car
 */
class Car extends Vehicle
{
}
</code></pre>

<b>Parts/Engine.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder\Parts;

/**
 * Engine类
 */
class Engine
{
}
</code></pre>

<b>Parts/Wheel.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder\Parts;

/**
 * Wheel类
 */
class Wheel
{
}
</code></pre>

<b>Parts/Door.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder\Parts;

/**
 * Door类
 */
class Door
{
}
</code></pre>

##6、测试代码

<b>Tests/DirectorTest.php</b>

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Builder\Tests;

use DesignPatterns\Creational\Builder\Director;
use DesignPatterns\Creational\Builder\CarBuilder;
use DesignPatterns\Creational\Builder\BikeBuilder;
use DesignPatterns\Creational\Builder\BuilderInterface;

/**
 * DirectorTest 用于测试建造者模式
 */
class DirectorTest extends \PHPUnit_Framework_TestCase
{

    protected $director;

    protected function setUp()
    {
        $this->director = new Director();
    }

    public function getBuilder()
    {
        return array(
            array(new CarBuilder()),
            array(new BikeBuilder())
        );
    }

   /**
    * 这里我们测试建造过程，客户端并不知道具体的建造者。
    *
    * @dataProvider getBuilder
    */
    public function testBuild(BuilderInterface $builder)
    {
        $newVehicle = $this->director->build($builder);
        $this->assertInstanceOf('DesignPatterns\Creational\Builder\Parts\Vehicle', $newVehicle);
    }
}
</code></pre>

##7、总结
<p style="text-indent:2em;">建造者模式和抽象工厂模式很像，总体上，建造者模式仅仅只比抽象工厂模式多了一个“导演类”的角色。与抽象工厂模式相比，建造者模式一般用来创建更为复杂的对象，因为对象的创建过程更为复杂，因此将对象的创建过程独立出来组成一个新的类 —— 导演类。也就是说，抽像工厂模式是将对象的全部创建过程封装在工厂类中，由工厂类向客户端提供最终的产品；而建造者模式中，建造者类一般只提供产品类中各个组件的建造，而将完整建造过程交付给导演类。由导演类负责将各个组件按照特定的规则组建为产品，然后将组建好的产品交付给客户端。</p>