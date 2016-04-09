<?php
namespace qiaoliu\hw3\views;
//session_start();

class SignInView extends View
{
   public function render($data) {
      ?>
<!DOCTYPE html>
<!--html start-->
<html lang="en">
<!--html head start-->
<head>
   <title>Image Rating</title>
   <meta charset="utf-8"/>
   <link rel="icon" href="./src/styles/icon.ico"/>
         <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #ADABAB;
         }
         
         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }
         
         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }
         
         .form-signin .checkbox {
            font-weight: normal;
         }
         
         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }
         
         .form-signin .form-control:focus {
            z-index: 2;
         }
         
         .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
            border-color:#017572;
         }
         
         .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            border-color:#017572;
         }
         
         h2{
            text-align: center;
            color: #017572;
         }
      </style>
</head>
<!--html body start-->
<body>
      
      <h2>Sign In</h2> 
      <div class = "container form-signin">
      </div> <!-- /container -->
      
      <div class = "container">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h1 class = "form-signin-heading"><?php echo $data; ?></h1>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "maximum 12 characters" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "maximun 12 characters" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "signin">Sign In</button>
         </form>
         
         <!--Click here to clean <a href = "logout.php" tite = "Logout">Session.-->
         
      </div> 
      
   </body>
</html>
<?php
}
}
