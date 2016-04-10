<?php
namespace qiaoliu\hw3\controllers;

//session_start();
require_once("./src/models/Model.php");
require_once("./src/models/ImageQueryModel.php");
require_once("./src/views/View.php");
require_once("./src/views/UserMainView.php");

class UserController extends Controller
{
	public function processRequest($controller) {

		/** 
		 * call ImageQueryModel to get the data
		 * @param $data array
		 */
		$data = [];
		$model = new \qiaoliu\hw3\models\ImageQueryModel();
		$data = $model->getResult(null);

		/** 
		 * call UserMainView to rend the view after user loged in.
		 */
		$view = new \qiaoliu\hw3\views\UserMainView();
		$view->render($data);
	}
}