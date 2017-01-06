#原型模式

##1、模式定义
<p style="text-indent:2em;">通过创建原型使用克隆方法实现对象创建而不是使用标准的 new 方式。</p>

##2、UML类图

![UML类图](http://laravelacademy.org/wp-content/uploads/2015/12/120b8c2b-9cad-44e8-a286-3347d32d57dd.png)

##3、示例代码

**BookPrototype.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Prototype;

/**
 * BookPrototype类
 */
abstract class BookPrototype
{
    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $category;

    /**
     * @abstract
     * @return void
     */
    abstract public function __clone();

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
}
</code></pre>

**BarBookPrototype.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Prototype;

/**
 * BarBookPrototype类
 */
class BarBookPrototype extends BookPrototype
{
    /**
     * @var string
     */
    protected $category = 'Bar';

    /**
     * empty clone
     */
    public function __clone()
    {
    }
}
</code></pre>

**FooBookPrototype.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Prototype;

/**
 * FooBookPrototype类
 */
class FooBookPrototype extends BookPrototype
{
    protected $category = 'Foo';

    /**
     * empty clone
     */
    public function __clone()
    {
    }
}
</code></pre>

##4、测试代码

**Tests/PrototypeTest.php**

<pre><code>
&lt;?php

namespace DesignPatterns\Creational\Prototype\Tests;

use DesignPatterns\Creational\Prototype\BookPrototype;
use DesignPatterns\Creational\Prototype\FooBookPrototype;
use DesignPatterns\Creational\Prototype\BarBookPrototype;

/**
 * PrototypeTest tests the prototype pattern
 */
class PrototypeTest extends \PHPUnit_Framework_TestCase
{

     public function getPrototype(){
         return array(
             array(new FooBookPrototype()),
             array(new BarBookPrototype())
         );
     }

     /**
      * @dataProvider getPrototype
      */
     public function testCreation(BookPrototype $prototype)
     {
         $book = clone $prototype;
         $book->setTitle($book->getCategory().' Book');
         $this->assertInstanceOf('DesignPatterns\Creational\Prototype\BookPrototype', $book);
     }
}
</code></pre>

##5、总结
<p style="text-indent:2em;">原型模式的主要思想是基于现有的对象克隆一个新的对象出来，一般是用对象内部提供的克隆方法，通过该方法返回一个对象的副本，这种创建对象的方式，相比我们之前说的几类创建型模式还是有区别的，之前的讲述的工厂方法模式与抽象工厂都是通过工厂封装具体的 new 操作的过程，返回一个新的对象，有的时候我们通过这样的创建工厂创建对象不值得，特别是以下的几个场景，可能使用原型模式更简单、效率更高：</p>

<ul>
<li>如果说我们的对象类型不是刚开始就能确定，而是在运行时确定的话，那么我们通过这个类型的对象克隆出一个新的类型更容易。</li>
<li>有的时候我们可能在实际的项目中需要一个对象在某个状态下的副本，这个前提很重要，这点怎么理解呢，例如有的时候我们需要对比一个对象经过处理后的状态和处理前的状态是否发生过改变，可能我们就需要在执行某段处理之前，克隆这个对象此时状态的副本，然后等执行后的状态进行相应的对比，这样的应用在项目中也是经常会出现的。</li>
<li>当我们处理的对象比较简单，并且对象之间的区别很小，可能只是很固定的几个属性不同的时候，使用原型模式更合适。</li>
</ul>