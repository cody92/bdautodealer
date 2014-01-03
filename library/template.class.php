<?php

class Template
{

    protected $variables = array();
    protected $_controller;
    protected $_action;
    protected $layoutName = 'layout';
    protected $title = 'BD Auto Dealer';

    /**
     * constructor pentru template
     *
     * @param string $controller
     * @param string $action
     */
    function __construct($controller, $action)
    {
        $this->_controller = $controller;
        $this->_action = $action;
    }

    /** Set Variables * */
    function set($name, $value)
    {
        $this->variables[$name] = $value;
    }

    protected function setLayout($name)
    {
        $this->layoutName = $name;
    }

    /** Display Template * */
    function render($renderTemplate = true)
    {

        if ($renderTemplate) {
            include (ROOT . DS . 'application' . DS . 'views' . DS . $this->layoutName . '.php');
        } else {
            echo $this->getViewFile();
        }
    }

    private function getViewFile()
    {
        extract($this->variables);
        ob_start();
        ob_implicit_flush(false);
        if (file_exists(ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . $this->_action . '.php')) {
            include (ROOT . DS . 'application' . DS . 'views' . DS . $this->_controller . DS . $this->_action . '.php');
        }
        return ob_get_clean();
    }

    public function getBasePath()
    {
        return BASE_PATH;
    }

    public function setPageTitle($title)
    {
        $this->title = $title;
    }

    public function url($url)
    {
        return $this->getBasePath() . $url;
    }

}
