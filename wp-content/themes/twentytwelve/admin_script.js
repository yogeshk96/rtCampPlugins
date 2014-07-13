//image upload function
var Uploader = (function () {

  jQuery('#upload_files').on('change', function () {
    jQuery("#wait").removeClass('hide');
    jQuery('#upload_files').parent('form').submit();
  });

  var fnUpload = function () {
    jQuery('#upload_files').trigger('click');
  }

  var fnDone = function (data) {

    var data = JSON.parse(data);
    if (typeof (data['error']) != "undefined") {
      jQuery('#sortable').html(data['error']);
      jQuery('#upload_files').val("");
      jQuery("#wait").addClass('hide');
      
      return;
    }
    var divs = [];
    for (i in data) {
      divs.push("<div class='imgBox'><div class='ui-state-default'><img src='" + data[i] + "' ></div><button class='removeImage'>Remove Image</button><div class='waitRemove hide'><img src='http://gadgets-accessories.com/rtcamp/images/upload-indicator.gif' alt=''></div></div>");
    }
    jQuery('#sortable').append(divs.join(""));
    jQuery('#upload_files').val("");
    jQuery("#wait").addClass('hide');
    jQuery(".saveButton").fadeIn();
  }

  return {
    upload: fnUpload,
    done: fnDone
  }

}());

var countDiv = $(".ui-state-default").length;

if(countDiv > 0) {

  $(".saveButton").fadeIn();
}

$('body').on('click', '.saveButton', function (){

    var urlsLarge = [];
    $("#sortable").find(".ui-state-default").each(function(){
        
        if($(this).find('img').attr('src') != "") {

          urlsLarge.push($(this).find('img').attr('src'));
        }
    }); 
    $("#waitingImage").show();
    $.post("http://gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/afterImageSelect.php", {urlsLarge:urlsLarge}, function(data){

      location.reload(true);
    });
  
});

$('body').on('click', '.removeImage', function (){

      var thisThis = this;
      var thisImgUrl = $(this).prev().find("img").attr("src");
      var imgCount = $(".ui-state-default").length;
      var hideCount = $('body').find(".hideImg").length+1;

      if(imgCount == hideCount) {

        $(".saveButton").fadeOut();
      }
      $(thisThis).parent().find(".waitRemove").show();
      $.post("http://gadgets-accessories.com/rtcamp/wp-content/themes/twentytwelve/removeImage.php", {imgUrl:thisImgUrl}, function(data){
        
          $(thisThis).parent().addClass("hideImg");
          $(thisThis).parent().find("img").attr("src", "");

          
      });


      
      
});