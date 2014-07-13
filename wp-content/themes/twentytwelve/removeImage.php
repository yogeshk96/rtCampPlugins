<?php

include "/home4/rohit/gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/db_connect.php";

$imgUrl = $_POST['imgUrl'];

if(strpos($imgUrl, "base64") === false) {

    $sql = "SELECT * FROM slider_images WHERE slider_image='$imgUrl' ";
	if(!$result = $mysqli->query($sql)) {

		die("There was an error running the query [".$mysqli->error."]");
	}
	while($row = $result->fetch_assoc()) {

		$row['slider_image'] = str_replace("http://", "/home4/rohit/", $row['slider_image']);

		unlink($row['slider_image']);
		
	}

	$sql_del = "DELETE FROM slider_images WHERE slider_image='$imgUrl' ";
	if(!$result_del = $mysqli->query($sql_del)) {

		die("There was an error running the query [".$mysqli->error."]");
	}


}


?>