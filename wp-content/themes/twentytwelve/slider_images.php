<?php
include "/home4/rohit/gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/db_connect.php";

    $sql = "SELECT * FROM slider_images";
	if(!$result = $mysqli->query($sql)) {

		die("There was an error running the query [".$mysqli->error."]");
	}

	while($row = $result->fetch_assoc()) {

		echo "<div class='imgBox'>
		<div class='ui-state-default'><img src='".$row['slider_image']."' />
		</div>
		<button class='removeImage'>Remove Image</button><div class='waitRemove hide'><img src='http://gadgets-accessories.com/rtcamp/images/upload-indicator.gif' alt=''></div>
		</div>";
	}

?>