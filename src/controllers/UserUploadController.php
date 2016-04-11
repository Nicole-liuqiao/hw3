<?php
namespace qiaoliu\hw3\controllers;

require_once("./src/models/Model.php");
require_once("./src/models/UserUploadModel.php");
require_once("./src/views/View.php");
require_once("./src/views/UserUploadView.php");


class UserUploadController extends Controller
{
    public function processRequest($controller) {
        if (!isset($_FILES['photo'])) {
            $view = new \qiaoliu\hw3\views\UserUploadView();
            $view->render($data = '');
        } else {
            var_dump($_FILES);
            $model = new \qiaoliu\hw3\models\UserUploadModel();
            $data = $model->getResult($formvals = '');

        }
    }
}