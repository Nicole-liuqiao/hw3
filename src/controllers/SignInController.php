<?php
namespace qiaoliu\hw3\controllers;


require_once("./src/models/Model.php");
require_once("./src/models/SignInModel.php");
require_once("./src/views/View.php");
require_once("./src/views/SignInView.php");


class SignInController extends Controller
{
    public function processRequest($controller) {

        /**
         * @param $data prompt message
         * if form is not submitted, $data = regualr prompt message
         * if form is submitted, $data is the error message after call model to process form data
         *                       if there is error message captured, call sign view with error message as prompt message
         *                       if there is no error message, login success, redirect to main user page.
         */

        $data = "";

        if (!isset($_POST['signin']))
        {
            $data = "Username and Password is required."; 
        } else {
            $formvars = self::CollectRegistrationSubmission();
            print_r($formvars);
            $model = new \qiaoliu\hw3\models\SignInModel();
            $data = $model->getResult($formvars);
        }
        if ($data) {
            $view = new \qiaoliu\hw3\views\SignInView();
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