<?php
namespace qiaoliu\hw3\views;

class GuestMainView extends View
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
	<h1 style="text-align: center;">Image Rating</h1>
	<div style="text-align: center;"><image src="./src/styles/logo.png"/></div>
	<a href="./index.php?c=signin">Sign in</a>
	<a href="./index.php?c=signup">Sign up</a>
	<h2>Recent</h2>
		<?php
		$catlog = "recent";
		if (count($data[$catlog]) == 0) {
?>  <p>There is no data in database. Please sign in and upload image. </p>
		<?php
		} else {
				for ($i = 0; $i < count($data[$catlog]); $i++) { 
				?>
				<image src="<?php echo $data[$catlog][$i]["location"];?>"/>
				<ul>
				<li>Caption: <?php echo $data[$catlog][$i]["caption"] ?></li>
				<li>User: <?php echo $data[$catlog][$i]["username"] ?></li>
				<li>Score: <?php echo $data[$catlog][$i]["rating"] ?></li>
				<li>Create Date: <?php echo $data[$catlog][$i]["date"] ?></li>
			</ul>
		<?php }
		}
?>  <h2>Popularity</h2>
	<?php
		$catlog = "popularity";
		if (count($data[$catlog]) == 0) {
?>  <p>There is no data in database. Please sign in and upload image. </p>
		<?php
		} else {
			for ($i = 0; $i < count($data[$catlog]); $i++) { 
				?>
				<image src="<?php echo $data[$catlog][$i]["location"];?>"/>
				<ul>
				<li>Caption: <?php echo $data[$catlog][$i]["caption"] ?></li>
				<li>User: <?php echo $data[$catlog][$i]["username"] ?></li>
				<li>Score: <?php echo $data[$catlog][$i]["rating"] ?></li>
				<li>Create Date: <?php echo $data[$catlog][$i]["date"] ?></li>
			</ul>
		<?php }
		}
	}
}
