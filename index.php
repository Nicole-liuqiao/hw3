<?php
namespace qiaoliu\hw3;

session_start();

// ------[require the controllers]------ //
require_once("src/controllers/Controller.php");
require_once("src/controllers/GuestController.php");
require_once("src/controllers/SignInController.php");
require_once("src/controllers/SignUpController.php");
require_once("src/controllers/UserController.php");
require_once("src/controllers/SignOutController.php");
require_once("src/controllers/UserUploadController.php");

// controllers for loginned in user
$userDomain = ['userMain','userUpload'];

/**
 * if in $userDomain controller, check if signed in. 
 *                               if it's not signed in, redirect to signin page
 * if not in $userDomain controller, call conresponding controller
 */
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
    case 'userUpload':
        $web = new controllers\UserUploadController();
        break;
    }
$entry = $web::processRequest($controller);

?>
</body>
</html>
