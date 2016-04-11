<?php
namespace qiaoliu\hw3\controllers;

//session_start();
require_once("./src/models/Model.php");
require_once("./src/models/SignInModel.php");
require_once("./src/views/View.php");
require_once("./src/views/SignInView.php");


class SignInController extends Controller
{
    public function processRequest($controller) {

        /**
         * According to the request, call different model to process form data and get the result from models.
         * @param $data prompt/error message
         * if form is not submitted, $data = some regular prompt message
         * if form is submitted, $data is the error message after call model to process form data
         */

        $data = [];
        if (!isset($_POST['signin']))
        {
            $data['errMsg'] = "Username and Password is required."; 
        } else {
            $formvars = self::CollectRegistrationSubmission();
            $model = new \qiaoliu\hw3\models\SignInModel();
            $data = $model->getResult($formvars);           
        }
        //return;

        /** 
         * According to the result from medels, call different view.
         * @param $data prompt/error message
         * if there is error message captured, call sign view with error message as prompt message
         * if there is no error message, login success, redirect to main user page.
         */
        if (isset($data['userid'])) {
            session_start();
            $_SESSION['signedin'] = true;
            $_SESSION['userid'] = $data['userid'];
            $redirect = "";
            //default controller
            if(!isset($_REQUEST['redirect'])) {
                $redirect = "userMain";
            } else {
                $redirect = $_REQUEST['redirect'];
            }
            header("Location: index.php?c=" . $redirect );
        } else {
            $view = new \qiaoliu\hw3\views\SignInView();
            $view->render($data['errMsg']); 
        }
    }

    function CollectRegistrationSubmission()
    {
        $formvars['username'] = $_POST['username'];
        $formvars['password'] = $_POST['password'];
        return $formvars;
    }
}