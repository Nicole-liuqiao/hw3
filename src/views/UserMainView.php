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
	<h1 style="text-align: center;">Image Rating</h1>
	<div style="text-align: center;"><image src="./src/styles/logo.png"/></div>
	<a href="./index.php?c=signout">Sign Out</a>
	<a href="./index.php?c=userUpload">Upload</a>	
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
				<?php 
				if ($data[$catlog][$i]["webUserScore"] == 0) {
				?>
					<form name="rate" action="./index.php?c=userMain" method="post">
					    <p><label for="rate" >Rate the image:</label>
					    	<br>
					    	<select name="rate" id="rating">
					            <option value = "1">1</option>
					    		<option value = "2">2</option>
					    		<option value = "3">3</option>
					    		<option value = "4">4</option>
					    		<option value = "5">5</option>
					    	</select>
					    	<br>
					        <button type="submit">Go</button>
					    </p>
					    <input type="hidden" name="imageid" value="<?php echo $data[$catlog][$i]["imageid"]; ?>" >
					</form>
				<?php
				} else {
					//print rate
				?>
					<li>Your rate: <?php echo $data[$catlog][$i]["webUserScore"]; ?></li>
				<?php
				}
				?>
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
