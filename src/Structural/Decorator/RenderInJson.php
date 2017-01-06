<?php
namespace App\Structural\Decorator;

/**
 * Class RenderInJson
 * @package App\Structural\Decorator
 */
class RenderInJson extends Decorator
{
    /**
     * render data as JSON
     * @return string
     */
    public function renderData()
    {
        $output = $this->wrapped->renderData();
        return json_encode($output);
    }
}