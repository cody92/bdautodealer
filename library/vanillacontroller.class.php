<?php

class VanillaController
{

    protected $_controller;
    protected $_action;
    protected $_template;
    protected $showLayout = true;
    protected $title = 'BD Auto Dealer';
    public $show = true;

    function __construct($controller, $action)
    {

        global $inflect;

        $this->_controller = ucfirst($controller);
        $this->_action = $action;
        $this->_template = new Template($controller, $action);
        $this->_template->setPageTitle($this->title);
    }

    function set($name, $value)
    {
        $this->_template->set($name, $value);
    }

    function __destruct()
    {
        if ($this->show) {
            $this->_template->render($this->showLayout);
        }
    }

    public function validateInput($input)
    {
        if (is_string($input) && (('' === $input) || preg_match('/^\s+$/s', $input))
        ) {
            return false;
        } elseif (!is_string($input) && empty($input)) {
            return false;
        }
        return true;
    }

}
