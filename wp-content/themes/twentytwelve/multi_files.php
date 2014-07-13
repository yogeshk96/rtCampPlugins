<?php
$failed = false;
$images = Array();
$upload_dir = "uploadImages/";

if ($_SERVER['CONTENT_LENGTH'] < 8380000) {
if (isset($_FILES['upload_files']) && $_FILES['upload_files']['error'] != 0) {    
    
        foreach($_FILES['upload_files']['tmp_name'] as $key=>$value) {

                $file = $_FILES['upload_files']['name'][$key];
                // allow only image upload
                if(preg_match('#image#',$_FILES['upload_files']['type'][$key]) || preg_match('#jpg#',$_FILES['upload_files']['type'][$key])  || preg_match('#png#',$_FILES['upload_files']['type'][$key]) ) {
                 

                        $data = file_get_contents($_FILES['upload_files']['tmp_name'][$key]);
                        $base64url = base64_encode($data);
     
                        $tempImageUrl = 'data:' . $_FILES['upload_files']['type'][$key] . ';base64,' . $base64url;
                        
                        $images[] = $tempImageUrl;                    
                } else {
                    $images = array("error"=>"Sorry, only images are allowed to upload");
                }
        }
}
} else {
    $failed = true;
    $images = array("error"=>"Sorry, Upload size exceed allowed upload size of 8MB");
}
if($failed == true) {
	$images = array("error"=>"Server Error<br/>Reported to Admin");
}
?>

<html>
 <body>
  <script type="text/javascript">
  window.parent.Uploader.done('<?php echo json_encode($images); ?>');
  </script>
 </body>
</html>


