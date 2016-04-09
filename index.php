<?php
namespace qiaoliu\hw3;

session_start();
// ------[include the controllers]------ //
require_once("src/controllers/Controller.php");
require_once("src/controllers/MainController.php");
require_once("src/controllers/SignInController.php");
require_once("src/controllers/SignUpController.php");

$default_ctrl = "guestMain";

/**echo "Request: ";
print_r($_REQUEST);
echo "---------     ";
echo "Post: \n";
print_r($_POST);
echo "--------";
echo "Server: \n";
print_r($_SERVER);
echo "--------";
*/

var_dump($_SESSION);

// Guest Controller: main, signin, signup
if(!isset($_SESSION) || !$_SESSION['signedin'] {
    if (array_key_exists("c", $_REQUEST)) {
    $controller = strtolower($_REQUEST["c"]);
} else {
    $controller = 'userMain';
}

// ------[talk to the requested controller]------ //
switch($controller){
	case "signin":
		$web = new controllers\SignInController();
		break;
    case "signup":
        $web = new controllers\SignUpController();  
        break;
    case 'userMain':
        $web = new controllers\UserController();
	default: 
		$web = new controllers\MainController();
	    break;
    }
$entry = $web::processRequest($controller);

?>
</body>
</html>
