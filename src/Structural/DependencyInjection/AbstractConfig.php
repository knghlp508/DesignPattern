<?php
namespace App\Structural\DependencyInjection;

/**
 * Class AbstractConfig
 * @package App\Structural\DependencyInjection
 */
abstract class AbstractConfig
{
    /**
     * Storage of data
     * @var
     */
    protected $storage;

    /**
     * AbstractConfig constructor.
     * @param $storage
     */
    public function __construct($storage)
    {
        $this->storage=$storage;
    }
}