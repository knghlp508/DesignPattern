# PHP设计模式

##1、设计模式概述
<p style="text-indent:2em;">在软件工程中，设计模式（Design Pattern）是对软件设计中普遍存在（反复出现）的各种问题，所提出的解决方案。这个术语是由埃里希·伽玛（Erich Gamma）等人在1990年代从建筑设计领域引入到计算机科学的。

设计模式并不直接用来完成代码的编写，而是描述在各种不同情况下，要怎么解决问题的一种方案。面向对象设计模式通常以类或对象来描述其中的关系和相互作用，但不涉及用来完成应用程序的特定类或对象。设计模式能使不稳定依赖于相对稳定、具体依赖于相对抽象，避免会引起麻烦的紧耦合，以增强软件设计面对并适应变化的能力。

并非所有的软件模式都是设计模式，设计模式特指软件“设计”层次上的问题。还有其它非设计模式的模式，如架构模式。同时，算法不能算是一种设计模式，因为算法主要是用来解决计算上的问题，而非设计上的问题。

本系列是常见设计模式的集合以及如何在 PHP 中实现这些设计模式，并为每种模式提供了相应的示例代码。

很多人都知道设计模式，但并非都了解如何在具体应用中实现，基于此我们推出了这一系列教程。</p>

##2、常用设计模式大全
<p style="text-indent:2em;">设计模式可以按照结构被分成三种不同的类型：</p>

###2.1 创建型

<p style="text-indent:2em;">在软件工程中，创建型设计模式用于处理对象的实例化：</p>


<ul style="color:#f4645f">
<li><a style="color:#f4645f" href="./src/Creational/AbstractFactory/README.md">抽象工厂模式（Abstract Factory）</a></li>
<li><a style="color:#f4645f" href="./src/Creational/Builder/README.md">建造者模式（Builder）</a></li>
<li>工厂方法模式（Factory Method）</li>
<li>多例模式（Multiton）</li>
<li>对象池模式（Pool）</li>
<li>原型模式（Prototype）</li>
<li>简单工厂模式（Simple Factory）</li>
<li>单例模式（Singleton）</li>
<li>静态工厂模式（Static Factory）</li>
</ul>
###2.2 结构型

<p style="text-indent:2em;">结构型设计模式用于处理类和对象的组合：</p>

<ul style="color:#f4645f">
<li>适配器模式（Adapter）</li>
<li>桥梁模式（Bridge）</li>
<li>组合模式（Composite）</li>
<li>数据映射模式（Data Mapper）</li>
<li>装饰模式（Decorator）</li>
<li>依赖注入模式（Dependency Injection）</li>
<li>门面模式（Facade）</li>
<li>流接口模式（Fluent Interface）</li>
<li>代理模式（Proxy）</li>
<li>注册模式（Registry）</li>
</ul>
###2.3 行为型

<p style="text-indent:2em;">行为型设计模式用于处理类的对象间通信：</p>

<ul style="color:#f4645f">
<li>责任链模式（Chain Of Responsibilities）</li>
<li>命令行模式（Command）</li>
<li>迭代器模式（Iterator）</li>
<li>中介者模式（Mediator）</li>
<li>备忘录模式（Memento）</li>
<li>空对象模式（Null Object）</li>
<li>观察者模式（Observer）</li>
<li>规格模式（Specification）</li>
<li>状态模式（State）</li>
<li>策略模式（Strategy）</li>
<li>模板方法模式（Template Method）</li>
<li>访问者模式（Visitor）</li>
</ul>
###2.4 其它

<ul style="color:#f4645f">
<li>委托模式（Delegation）</li>
<li>服务定位器模式（Service Locator）</li>
<li>资源库模式（Repository）</li>
</ul>