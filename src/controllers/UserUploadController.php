<?php
namespace qiaoliu\hw3\controllers;

require_once("./src/models/Model.php");
require_once("./src/models/SignInModel.php");
require_once("./src/views/View.php");
require_once("./src/views/UserUploadView.php");


class UserUploadController extends Controller
{
    public function processRequest($controller) {
        $view = new \qiaoliu\hw3\views\UserUploadView();
        $view->render($data = '');
    }
}