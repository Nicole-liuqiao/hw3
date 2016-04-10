<?php
namespace qiaoliu\hw3\views;

class UserUploadView extends View
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
</head>
<!--html body start-->
<body>
      
      <h2>Upload file</h2> 
      <!-- The data encoding type, enctype, MUST be specified as below -->
<form enctype="multipart/form-data" action="index.php?c=userUpload" method="POST">
    <!-- MAX_FILE_SIZE must precede the file input field -->
    <input type="hidden" name="MAX_FILE_SIZE" value="1024000" />
    <!-- Name of input element determines name in $_FILES array -->
    Send this file: <input name="photo" type="file" />
    Caption: <input name='caption' type="text"/>
    <input type="submit" value="Send File" />
</form>

      
   </body>
</html>
<?php
}
}
