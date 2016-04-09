<?php
namespace qiaoliu\hw3\controllers;


require_once("./src/models/Model.php");
require_once("./src/models/SignUpModel.php");
require_once("./src/views/View.php");
require_once("./src/views/SignUpView.php");


class SignUpController extends Controller
{
	public function processRequest($controller) {
        $data = "";
        if (!isset($_POST['signup']))
        {
            $data = "Username and Password is required."; 
        } else {
            $formvars = self::CollectRegistrationSubmission();
            $model = new \qiaoliu\hw3\models\SignUpModel();
            $data = $model->getResult($formvars);
        }
        if ($data) {
            $view = new \qiaoliu\hw3\views\SignUpView();
            $view->render($data); 
        } else {
            header("Location: " . $_SERVER['REQUEST_URI']);
        }

    }

    function CollectRegistrationSubmission()
    {
        $formvars['username'] = $_POST['username'];
        $formvars['password'] = $_POST['password'];
        return $formvars;
    }
}