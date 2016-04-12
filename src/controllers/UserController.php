<?php
namespace qiaoliu\hw3\controllers;

//session_start();
require_once("./src/models/Model.php");
require_once("./src/models/ImageQueryModel.php");
require_once("./src/models/RateModel.php");
require_once("./src/views/View.php");
require_once("./src/views/UserMainView.php");

class UserController extends Controller
{
	public function processRequest($controller) {

		/** 
		 * call ImageQueryModel to get the data
		 * @param $data array
		 */
		if (isset($_POST['rate'])){

		    $model = new \qiaoliu\hw3\models\RateModel();
        	$data = $model->getResult($_POST['rate']);

        }
        
			$data = [];
			$model = new \qiaoliu\hw3\models\ImageQueryModel();
			$data = $model->getResult($webUserid = $_SESSION['userid']);

			/** 
			 * call UserMainView to rend the view after user loged in.
			 */
        
        $view = new \qiaoliu\hw3\views\UserMainView();
		$view->render($data);

	}
}