<?php
namespace qiaoliu\hw3\controllers;

abstract class Controller
{
	public abstract function processRequest($controller);

/*
	protected function SanitizeForSQL($str) {
        if( function_exists( "mysqli_real_escape_string" ) )
        {
              $ret_str = mysqli_real_escape_string($str);
        }
        else
        {
              $ret_str = addslashes($str);
        }
        return $ret_str;
    }
*/
}
