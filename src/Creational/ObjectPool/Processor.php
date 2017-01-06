<?php
namespace App\Creational\ObjectPool;

/**
 * Class Processor
 * @package App\Creational\ObjectPool
 */
class Processor
{
    /**
     * 连接对象池
     * @var Pool
     */
    private $pool;

    /**
     * 线程
     * @var integer
     */
    private $processing = 0;

    /**
     * 最大处理线程
     * @var integer
     */
    private $maxProcesses = 3;

    /**
     * 等待队列数组
     * @var array
     */
    private $waitingQueue = [];

    /**
     * Processor constructor.
     * @param Pool $pool
     */
    public function __construct(Pool $pool)
    {
        $this->pool = $pool;
    }

    /**
     * 处理
     * @param mixed $image
     */
    public function process($image)
    {
        if ($this->processing++ < $this->maxProcesses) {
            //小于最大执行线程，则立刻则行Worker
            $this->createWorker($image);
        } else {
            //超过最大执行线程，则推送到等待队列
            $this->pushToWaitingQueue($image);
        }
    }

    /**
     * 创建并执行Worker
     * @param $image
     */
    private function createWorker($image)
    {
        //从对象池获取对象
        $worker = $this->pool->get();
        //进入Worker类执行run方法，并回调processDone方法
        $worker->run($image, array($this, 'processDone'));
    }

    /**
     * 执行完毕
     * @param mixed $worker
     */
    public function processDone($worker)
    {
        //执行完毕，线程减一
        $this->processing--;
        //处理已执行完毕的对象（丢到对象池，并添加到实例数组里，方便下次直接从对象池的实例数组直接调用）
        $this->pool->dispose($worker);

        //如果等待队列中尚有未处理的线程，则出栈队列并继续创建执行Worker
        if (count($this->waitingQueue) > 0) $this->createWorker($this->popFromWaitingQueue());
    }

    /**
     * 推送到等待队列
     * @param mixed|object $image
     */
    private function pushToWaitingQueue($image)
    {
        $this->waitingQueue[] = $image;
    }

    /**
     * 从等待队列中出栈
     * @return mixed
     */
    private function popFromWaitingQueue()
    {
        return array_pop($this->waitingQueue);
    }
}