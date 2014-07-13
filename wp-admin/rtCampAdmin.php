<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Sortable - Display as grid</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/admin.css">
  
  <script>
  $(function() {
    $( "#sortable" ).sortable();
    $( "#sortable" ).disableSelection();
  });
  </script>

</head>
<body>
 
      <div id="upload_form" class="hide">

  			<form action="http://gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/multi_files.php" target="hidden_iframe" enctype="multipart/form-data" method="post">
  				<input type="file" multiple name="upload_files[]" id="upload_files">
  			</form>
			</div>
			<div class="preAuth"style="margin-bottom:10px;">
				<h4 style="text-align:center;">Select photos from your computer</h4>
				<div  align="center" style="padding:10px"> 
					<button onclick="Uploader.upload();" class="btn btn-large btn-red">Upload Files</button>
					<div id="wait" class="hide"><img src="http://gadgets-accessories.com/rtcamp/images/upload-indicator.gif" alt=""></div>
				</div>
			</div>

			<div>
				<iframe name="hidden_iframe" id="hidden_iframe" class="hide"></iframe>
			</div>

		

<div id="sortable">
  <?php

    include "/home4/rohit/gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/slider_images.php";
  ?>
</div>
<div class="clear" style="height:10px;"></div>
<div class="saveButton hide"><Button>Save</Button></div><div id="waitingImage" class="hide"><img src="http://gadgets-accessories.com/rtcamp/images/upload-indicator.gif" alt=""></div>
<div id="result"></div>

<script src="http://gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/admin_script.js"></script>
</body>
</html>