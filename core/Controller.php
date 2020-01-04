<?php
class Controller
{
    var $vars = [];
    var $layout = "application";

    function set($d)
    {
        $this->vars = array_merge($this->vars, $d);
    }

    function render($filename)
    {
        extract($this->vars);
        ob_start();
        require(ROOT . "views/" . ucfirst(str_replace('Controller', '', get_class($this))) . '/' . $filename . '.php');
        $content_for_layout = ob_get_clean();
        if ($this->layout == false)
        {
            $content_for_layout;
        }
        else
        {
            require(ROOT . "views/layout/" . $this->layout . '.php');
        }
    }
}