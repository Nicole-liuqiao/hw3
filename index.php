<?php
namespace qiaoliu\hw3;

// ------[include the controllers]------ //
require_once("src/controllers/Controller.php");
require_once("src/controllers/MainController.php");
require_once("src/controllers/SignInController.php");
require_once("src/controllers/SignUpController.php");

$default_ctrl = "guestMain";
$default_page = "1";
$default_view = "display";

echo "Request: ";
print_r($_REQUEST);
echo "---------     ";
echo "Post: \n";
print_r($_POST);
echo "--------";
echo "Server: \n";
print_r($_SERVER);
echo "--------";

if (array_key_exists("c", $_REQUEST)) {
    $controller = strtolower($_REQUEST["c"]);
} else if (array_key_exists('signup', $_REQUEST)) {

    $controller = "signup";
}
else $controller = $default_ctrl;
    
if (array_key_exists("p", $_REQUEST))
    $page = $_REQUEST["p"];
else $page = $default_page;

if (array_key_exists("v", $_REQUEST))
    $view = strtolower($_REQUEST["v"]);
else $view = $default_view;

// ------[talk to the requested controller]------ //
/*
switch($controller)
{
    case "signin":
        signinEntry($page, $view);
        break;
    case "main":
    default: // default to main :)
        mainEntry($page, $view);
        break;
}
*/


echo "Controller: \n";
print_r($controller);
echo "--------";
switch($controller){
	case "signin":
		$web = new controllers\SignInController();
		break;
    case "signup":
        $web = new controllers\SignUpController();
        break;
	default: 
		$web = new controllers\MainController();
	    break;
    }
$entry = $web::processRequest($controller);

?>
</body>
</html>
