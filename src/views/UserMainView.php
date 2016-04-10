<?php
namespace qiaoliu\hw3\views;

class UserMainView extends View
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
	<h1 style="text-align: center;">Image Rating: This is UserMain. Haha!</h1>
	<div style="text-align: center;"><image src="./src/styles/logo.png"/></div>
	<a href="./index.php?c=signout">Sign Out</a>
	<a href="./index.php?c=userUpload">Upload</a>	
	<h2>Recent</h2>
		<?php
		$catlog = "recent";
		if (count($data[$catlog] == 0)) {
?>  <p>There is no data in database. Please sign in and upload image. </p>
		<?php
		}
		for ($i = 0; $i < count($data[$catlog]); $i++) { 
			?>
			<image src="src/resources/image<?php echo $i?>.png" />
			<ul>
			<li>Caption: <?php echo $data[$catlog][$i]["caption"] ?></li>
			<li>User: <?php echo $data[$catlog][$i]["user"] ?></li>
			<li>Score: <?php echo $data[$catlog][$i]["rating"] ?></li>
			<li>Create Date: <?php echo $data[$catlog][$i]["date"] ?></li>
		</ul>
		<?php 
		}
?>  <h2>Popularity</h2>
	<?php
		$catlog = "popularity";
		if (count($data[$catlog] == 0)) {
?>  <p>There is no data in database. Please sign in and upload image. </p>
		<?php
		}
		for ($i = 0; $i < count($data[$catlog]); $i++) { 
			?>
			<image src="src/resources/image<?php echo $i?>.png" />
			<ul>
			<li>Caption: <?php echo $data[$catlog][$i]["caption"] ?></li>
			<li>User: <?php echo $data[$catlog][$i]["user"] ?></li>
			<li>Score: <?php echo $data[$catlog][$i]["rating"] ?></li>
			<li>Create Date: <?php echo $data[$catlog][$i]["date"] ?></li>
		</ul>
		<?php
		}
	}
}
