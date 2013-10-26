<?php

class VanillaController {
	
	protected $_controller;
	protected $_action;
	protected $_template;

	public $showLayout = true;
	public $show = true;

	function __construct($controller, $action) {
		
		global $inflect;

		$this->_controller = ucfirst($controller);
		$this->_action = $action;
		$this->_template =new Template($controller,$action);

	}

	function set($name,$value) {
		$this->_template->set($name,$value);
	}

	function __destruct() {
		if ($this->show) {
			$this->_template->render($this->showLayout);
		}
	}
		
}