<?php
include "/home4/rohit/gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/db_connect.php";
$urlsLarge = $_POST['urlsLarge'];
function uploadFile($imgUrl) {

	$imageExt = getImageExtension($imgUrl);

    if(strpos($imgUrl, 'base64') !== false) {
	    $imgDataPre = substr($imgUrl, 1+strrpos($imgUrl, ','));
	    $imgData = base64_decode($imgDataPre);

	    
        $path = "/home4/rohit/gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/sliderImages/slide-".rand().".".$imageExt;
        file_put_contents($path, $imgData);
    } else {

        //Rename image name. 
        $imgContent = file_get_contents($imgUrl);

		$path = "/home4/rohit/gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/sliderImages/slide-".rand().".".$imageExt;
        file_put_contents($path, $imgContent);
    }

    return $path;

}

function getImageExtension($imgUrl) {


    if(strpos($imgUrl, 'base64') !== false) {

    $explodeComma = explode(",", $imgUrl);
    $imageType = str_replace("data:", "", $explodeComma[0]);
    $imageType = str_replace(";base64", "", $imageType);
    $ext = trim(str_replace("image/", "", $imageType));
    } else {
    	
        $ext = pathinfo($imgUrl, PATHINFO_EXTENSION);
    }	
    return $ext;

}

    $sql = "SELECT * FROM slider_images";
	if(!$result = $mysqli->query($sql)) {

		die("There was an error running the query [".$mysqli->error."]");
	}
	while($row = $result->fetch_assoc()) {

        $imageArr[] = $row['slider_image'];

	}
    
    

foreach ($urlsLarge as $imgUrl) {

	
    if(strpos($imgUrl, 'http://') !== false) {

    	$imgUrl = str_replace("http://", "/home4/rohit/", $imgUrl);
    }
	$imageUrl = uploadFile($imgUrl);
	$imageUrl = str_replace("/home4/rohit/", "http://", $imageUrl);

	       
	$sql = "INSERT INTO slider_images (slider_image) VALUES ('$imageUrl')";
	if(!$result = $mysqli->query($sql)) {

		die("There was an error running the query [".$mysqli->error."]");
	}

}

    foreach($imageArr as $imageSingle) {

	    $sql = "DELETE FROM slider_images WHERE slider_image='".$imageSingle."' ";
		if(!$result = $mysqli->query($sql)) {

			die("There was an error running the query [".$mysqli->error."]");
		}
		$imageSingle = str_replace("http://", "/home4/rohit/", $imageSingle);

		unlink($imageSingle);
	}


?>