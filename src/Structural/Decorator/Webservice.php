<?php
namespace App\Structural\Decorator;

/**
 * Class Webservice
 * @package App\Structural\Decorator
 */
class Webservice implements RendererInterface
{
    /**
     * @var mixed
     */
    protected $data;

    /**
     * Webservice constructor.
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function renderData()
    {
        return $this->data;
    }
}