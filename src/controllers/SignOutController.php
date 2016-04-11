<?php
namespace qiaoliu\hw3\controllers;

//session_start();
require_once("./src/models/Model.php");
require_once("./src/models/ImageQueryModel.php");
require_once("./src/views/View.php");
require_once("./src/views/GuestMainView.php");


class SignOutController extends Controller
{
    public function processRequest($controller) {
    	echo "-------";
        session_unset();
        header("Location: index.php");
    }
}