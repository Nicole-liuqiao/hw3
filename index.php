<?php
namespace qiaoliu\hw3;

session_start();
// ------[include the controllers]------ //
require_once("src/controllers/Controller.php");
require_once("src/controllers/GuestController.php");
require_once("src/controllers/SignInController.php");
require_once("src/controllers/SignUpController.php");
require_once("src/controllers/UserController.php");
require_once("src/controllers/SignOutController.php");

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

$userDomain = ['userMain','userUpload'];

$isSignIn = false;
if(isset($_SESSION) && isset($_SESSION['signedin']) && $_SESSION['signedin']) {
    $isSignIn = true;
} 
$controller = "";
if(!isset($_REQUEST['c']) || $_REQUEST['c'] == "") {
    if ($isSignIn) {
        $controller = "userMain";
    } else {
        $controller = "guestMain";
    } 
} else {
    $controller = $_REQUEST['c'];
    if (in_array($controller, $userDomain)) {
        if (!$isSignIn) {
            header("Location: index.php?c=signin&redirect=" . $controller);
        }
    }
}


/*

if(isset($_SESSION) && isset($_SESSION['signedin']) && $_SESSION['signedin']) {
    $isSignIn = true;
    //$controller = 'userMain';
} elseif (isset($_REQUEST['c'])) {
    $controller = strtolower($_REQUEST['c']);
}
*/

var_dump($controller);


// ------[talk to the requested controller]------ //
switch($controller){
    case "signup":
        $web = new controllers\SignUpController();  
        break;
    case "signin":
        $web = new controllers\SignInController();
        break;
    case 'userMain':
        $web = new controllers\UserController();
        break;
    case 'signout':
        $web = new controllers\SignOutController();
        break;
	case 'guestMain': 
		$web = new controllers\GuestController();
	    break;
    }
$entry = $web::processRequest($controller);

?>
</body>
</html>
