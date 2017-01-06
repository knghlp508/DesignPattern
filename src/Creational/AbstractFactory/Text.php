<?php
namespace App\Creational\AbstractFactory;

/**
 * Text类
 *
 * Class Text
 * @package DesignPattern\AbstractFactory
 */
abstract class Text implements MediaInterface
{
    /**
     * @var string
     */
    protected $text;

    public function __construct($text)
    {
        $this->text = (string)$text;
    }
}