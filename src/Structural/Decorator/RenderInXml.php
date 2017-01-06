<?php
namespace App\Structural\Decorator;

/**
 * Class RenderInXml
 * @package App\Structural\Decorator
 */
class RenderInXml extends Decorator
{
    /**
     * render data as XML
     * @return string
     */
    public function renderData()
    {
        $output=$this->wrapped->renderData();

        //做些逻辑，将xml转换成数组...

        $doc=new \DOMDocument();
        foreach ($output as $key => $value) {
            $doc->appendChild($doc->createElement($key,$value));
        }
        return $doc->saveXML();
    }
}