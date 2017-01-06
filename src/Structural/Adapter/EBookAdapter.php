<?php
namespace App\Structural\Adapter;

/**
 * EBookAdapter 是电子书适配器类
 *
 * 该适配器实现了 PaperBookInterface 接口,
 * 但是你不必修改客户端使用纸质书的代码
 * Class EBookAdapter
 * @package App\Structural\Adapter
 */
class EBookAdapter implements PaperBookInterface
{
    /**
     * @var EBookInterface
     */
    protected $eBook;

    /**
     * 注意该构造函数注入了电子书接口EBookInterface
     * EBookAdapter constructor.
     * @param EBookInterface $eBook
     */
    public function __construct(EBookInterface $eBook)
    {
        $this->eBook = $eBook;
    }

    /**
     * 电子书将纸质书打开的方法转化成电子书的打开方法
     */
    public function open()
    {
        $this->eBook->pressStart();
    }

    /**
     * 纸质书翻页转换成电子书翻页
     */
    public function turnPage()
    {
        $this->eBook->pressNext();
    }
}