<?php
namespace qiaoliu\hw3\controllers;

require_once("./src/models/Model.php");
require_once("./src/models/UserUploadModel.php");
require_once("./src/views/View.php");
require_once("./src/views/UserUploadView.php");
require_once("./src/views/UserUploadNotificationView.php");

class UserUploadController extends Controller
{
    public function processRequest($controller) {
        //$data notification message
        $data = '';

        if(isset($_REQUEST['notification'])) {
            $view = new \qiaoliu\hw3\views\NotificationView();
            $view->render($data);
        }

        if (!isset($_FILES['photo'])) {
            $view = new \qiaoliu\hw3\views\UserUploadView();
            $view->render($data);
        } else {
            if (!empty($_FILES['photo']['error'])) {
                $data = "There is error: " . $_FILES['photo']['error'];
            }
            if (strcmp($_FILES['photo']['type'], 'image/jpeg')) {
                $data = "Only support jpeg format";
            }
            if ($_POST['MAX_FILE_SIZE'] < $_FILES['photo']['size']) {
                $data = "file is too large";
            }

            $model = new \qiaoliu\hw3\models\UserUploadModel();
            $data = $model->getResult($formvals = '');

            header("Location: index.php?c=userUpload&notification=" . $data);
        }
    }
}