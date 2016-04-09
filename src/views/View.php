<?php
namespace qiaoliu\hw3\views;

abstract class View
{
	public $view;

	public function __construct($view = null) {
		//$this->view = ;
	}
	public abstract function render($data);
}
