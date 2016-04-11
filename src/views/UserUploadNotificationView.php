<?php
namespace qiaoliu\hw3\views;

class NotificationView extends View
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
</head>
<!--html body start-->
<body>
	<h1 style="text-align: center;"><?php
    if (empty($data)) {
    	$data = "Upload Successfully";
    }
    echo $data;
	?></h1>
	<div><a href="./index.php?c=userUpload">Upload Another Image</a></div>
	<div><a href="./index.php?c=userMain">Back to Main Page</a></div>	
		<?php
	}
}
