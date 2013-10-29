<?php

abstract class Widget
{

    public $variables;

    protected function render($catchOutput = true)
    {
        extract($this->variables);
        if ($catchOutput) {
            ob_start();
            ob_implicit_flush(false);
            if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . 'widgets' . DS . 'classname' . '.php')) {
                include (ROOT . DS . 'application' . DS . 'views' . DS . 'widgets' . DS . 'classname' . '.php');
            }
            return ob_get_clean();
        } else {
            if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . 'widgets' . DS . 'classname' . '.php')) {
                include (ROOT . DS . 'application' . DS . 'views' . DS . 'widgets' . DS . 'classname' . '.php');
            }
        }
    }

    function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

}
