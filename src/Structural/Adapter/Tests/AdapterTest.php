<?php
namespace App\Structural\Adapter\Tests;

use App\Structural\Adapter\Book;
use App\Structural\Adapter\EBookAdapter;
use App\Structural\Adapter\Kindle;
use App\Structural\Adapter\PaperBookInterface;

require '../../../../vendor/autoload.php';

/**
 * Class AdapterTest
 * @package App\Structural\Adapter\Tests
 */
class AdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @return array
     */
    public function getBook()
    {
        return [
            [new Book()],
            [new EBookAdapter(new Kindle())]
        ];
    }

    /**
     * 客户端只知道有纸质书，实际上第二本书是电子书，
     * 但是对客户来说代码一致，不需要做任何改动
     *
     * @param PaperBookInterface $book
     * @dataProvider getBook
     */
    public function testIAmAnOldClient(PaperBookInterface $book)
    {
        $this->assertTrue(method_exists($book,'open'));
        $this->assertTrue(method_exists($book,'turnPage'));
    }
}