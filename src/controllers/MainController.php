<?php
namespace qiaoliu\hw3\controllers;

require_once("./src/models/Model.php");
require_once("./src/models/ImageQueryModel.php");
require_once("./src/views/View.php");
require_once("./src/views/GuestMainView.php");

class MainController extends Controller
{
	public function processRequest($controller) {
		$data = [];
		$model = new \qiaoliu\hw3\models\ImageQueryModel();
		$data = $model->getResult(null);
		$view = new \qiaoliu\hw3\views\GuestMainView();
		$view->render($data);
	}
}