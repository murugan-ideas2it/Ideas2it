jQuery(document).ready(function($) { 

var allOptions = $(".fs-results").children('li:not(.init)');
$(".fs-results").on("click", "li:not(.init)", function() {
    
});
  $('.fs-results li').click(function() {
    allOptions.removeClass('selected');
    $(this).addClass('selected');
    $(".fs-results").children('.init').html($(this).html());
    var selected_message_font = $("ul").find(".selected").data("value")
    $('#wpsocialarrow-messages-selection-span').css('font-family',selected_message_font);
});
  if($( "#wpsocialarrow-message-selection option:selected" ).text()=="Custom Message"){
        $("#wpsocialarrow-custom-default-message").prop('disabled', false);
      }
  $("#wpsocialarrow-message-selection").change(function()
    {
      if($( "#wpsocialarrow-message-selection option:selected" ).text()=="None"){
        $("#wpsocialarrow-custom-default-message").prop('disabled', true);
        $("#wpsocialarrow-messages-selection-span").html("");
      }
 else if($( "#wpsocialarrow-message-selection option:selected" ).text()=="Custom Message"){
        $("#wpsocialarrow-custom-default-message").prop('disabled', false);
      }
      else{
        $("#wpsocialarrow-custom-default-message").prop('disabled', true);
      $("#wpsocialarrow-messages-selection-span").html($( "#wpsocialarrow-message-selection option:selected" ).text());
    }

    });
  $(window).load(function() {
    $('#wpsocialarrow-enable-plugin').click(function(){
      if($('#wpsocialarrow-enable-plugin').prop('checked')) {
       
      } else {
      
      }
    });
    $(document).ready(function() {
      $( "#wpsocialarrow-message-selection" ).change(function () {
        var str = "";
        $( "select option:selected" ).each(function() {
          str += $( this ).text() + " ";
        });
        document.getElementById("wpsocialarrow-default-message-option").innerHTML = str;
      })

    });
    var seleced_skin_data = $("#wpsocialarrow-social-icons-box");

var user_selected_skin = seleced_skin_data.data("selected-skin");


if(user_selected_skin == "default-skin"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div class="social1"><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share facebook" href="#"  title="Facebook"  data-1="wpsocialarrow-facebook"></a><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share twitter" href="#" title="Twitter" data-2="wpsocialarrow-twitter"></a><a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share google" href="#"  title="Google+" data-3="wpsocialarrow-google"></a><a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share linkedin" href="#"  title="LinkedIn" data-4="wpsocialarrow-linkedin"></a><a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share pinterest" href="#" title="Pinterest" data-5="wpsocialarrow-pinterest"></a></div><!--End Container--></div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
 skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div class="social1"><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share facebook" href="#"  title="Facebook"  data-1="wpsocialarrow-facebook"></a><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share twitter" href="#" title="Twitter" data-2="wpsocialarrow-twitter"></a><a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share google" href="#" title="Google+" data-3="wpsocialarrow-google"></a><a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share linkedin" href="#" title="LinkedIn" data-4="wpsocialarrow-linkedin"></a><a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share pinterest" href="#" title="Pinterest" data-5="wpsocialarrow-pinterest"></a></div><!--End Container--></div>';
 $('.wpsocialarrow-social-icons-box').append(skin_data);
}
}
if(user_selected_skin == "social-wide"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div class="social1 social-wide"> <a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share facebook theme2" href="#" title="Facebook"  data-1="wpsocialarrow-facebook"></a> <a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share twitter theme2" href="#"  title="Twitter" data-2="wpsocialarrow-twitter"></a> <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share google theme2" href="#" title="Google+" data-3="wpsocialarrow-google"></a> <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share linkedin theme2" href="#" title="LinkedIn" data-4="wpsocialarrow-linkedin"></a> <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share pinterest theme2" href="#" title="Pinterest" data-5="wpsocialarrow-pinterest"></a> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
 skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div class="social1 social-wide"> <a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share facebook theme2" href="#"  title="Facebook"  data-1="wpsocialarrow-facebook"></a> <a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share twitter theme2" href="#"  title="Twitter" data-2="wpsocialarrow-twitter"></a> <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share google theme2" href="#" title="Google+" data-3="wpsocialarrow-google"></a> <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share linkedin theme2" href="#"  title="LinkedIn" data-4="wpsocialarrow-linkedin"></a> <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share pinterest theme2" href="#" title="Pinterest" data-5="wpsocialarrow-pinterest"></a> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
}
if(user_selected_skin == "bounce-up"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"> <div class="social1"> <a class="wpsocialarrow-facebook-share" href="" target="_blank"   data-1="wpsocialarrow-facebook"> <div class="social--facebook"></div> </a> <a class="wpsocialarrow-twitter-share" href="" target="_blank" data-2="wpsocialarrow-twitter"> <div class="social--twitter"></div> </a> <a class="wpsocialarrow-google-share" href="" target="_blank" data-3="wpsocialarrow-google"> <div class="social--google"></div> </a> <a class="wpsocialarrow-linkedin-share" href="" target="_blank" data-4="wpsocialarrow-linkedin"> <div class="social--linkedin"></div> </a> <a class="wpsocialarrow-pinterest-share" href="" target="_blank" data-5="wpsocialarrow-pinterest"> <div class="social--pinterest"></div> </a> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12">  <div class="social1"> <a class="wpsocialarrow-facebook-share" href="" target="_blank"   data-1="wpsocialarrow-facebook"> <div class="social--facebook"></div> </a> <a class="wpsocialarrow-twitter-share" href="" target="_blank" data-2="wpsocialarrow-twitter"> <div class="social--twitter"></div> </a> <a class="wpsocialarrow-google-share" href="" target="_blank" data-3="wpsocialarrow-google"> <div class="social--google"></div> </a> <a class="wpsocialarrow-linkedin-share" href="" target="_blank" data-4="wpsocialarrow-linkedin"> <div class="social--linkedin"></div> </a> <a class="wpsocialarrow-pinterest-share" href="" target="_blank" data-5="wpsocialarrow-pinterest"> <div class="social--pinterest"></div> </a> </div><!--End Container--> </div>';
$('.wpsocialarrow-social-icons-box').append(skin_data);
}
  
}
if(user_selected_skin == "grind-in"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div class="social_icons"> <a class="wpsocialarrow-facebook-share btn_facebook"  target="_blank"   data-1="wpsocialarrow-facebook"><i class="fa fa-facebook"></i><i class="fa fa-facebook"></i></a> <a class="wpsocialarrow-twitter-share btn_twitter" target="_blank" data-2="wpsocialarrow-twitter"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a> <a class="wpsocialarrow-google-share btn_google-plus" target="_blank" data-3="wpsocialarrow-google"><i class="fa fa-google-plus"></i><i class="fa fa-google-plus"></i></a> <a class="wpsocialarrow-linkedin-share btn_linkedin" target="_blank" class="" data-4="wpsocialarrow-linkedin"><i class="fa fa-linkedin"></i><i class="fa fa-linkedin"></i></a> <a class="wpsocialarrow-pinterest-share btn_pinterest" target="_blank" data-5="wpsocialarrow-pinterest"><i class="fa fa-pinterest"></i><i class="fa fa-pinterest"></i></a> </div></div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div class="social_icons"> <a class="wpsocialarrow-facebook-share btn_facebook" target="_blank"   data-1="wpsocialarrow-facebook"><i class="fa fa-facebook"></i><i class="fa fa-facebook"></i></a> <a class="wpsocialarrow-twitter-share btn_twitter" target="_blank" data-2="wpsocialarrow-twitter"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a> <a class="wpsocialarrow-google-share btn_google-plus" target="_blank"  data-3="wpsocialarrow-google"><i class="fa fa-google-plus"></i><i class="fa fa-google-plus"></i></a> <a class="wpsocialarrow-linkedin-share btn_linkedin" target="_blank" data-4="wpsocialarrow-linkedin"><i class="fa fa-linkedin"></i><i class="fa fa-linkedin"></i></a> <a class="wpsocialarrow-pinterest-share btn_pinterest" target="_blank" class="" data-5="wpsocialarrow-pinterest"><i class="fa fa-pinterest"></i><i class="fa fa-pinterest"></i></a> </div></div>';
$('.wpsocialarrow-social-icons-box').append(skin_data);
}
  
}
if(user_selected_skin == "paper-fold"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme5" class=""> <nav> <ul> <li id="facebooktheme5"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme5-facebook hvr-wobble-vertical"></span> </a> </div> </li> <li id="twittertheme5" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme5-twitter hvr-wobble-vertical"></span> </a> </div> </li> <li id="google-plustheme5" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme5-gplus hvr-wobble-vertical"></span> </a> </div> </li> <li id="linkedintheme5" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme5-linkedin hvr-wobble-vertical"></span> </a> </div> </li> <li id="pinteresttheme5" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme5-pinterest hvr-wobble-vertical"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme5" class=""> <nav> <ul> <li id="facebooktheme5"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme5-facebook hvr-wobble-vertical"></span> </a> </div> </li> <li id="twittertheme5" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme5-twitter hvr-wobble-vertical"></span> </a> </div> </li> <li id="google-plustheme5" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme5-gplus hvr-wobble-vertical"></span> </a> </div> </li> <li id="linkedintheme5" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme5-linkedin hvr-wobble-vertical"></span> </a> </div> </li> <li id="pinteresttheme5" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme5-pinterest hvr-wobble-vertical"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);

}
  
}
if(user_selected_skin == "branded"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme6" class=""> <nav> <ul> <li id="facebooktheme6"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme6-facebook hvr-outline-infacebook"></span> </a> </div> </li> <li id="twittertheme6" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme6-twitter hvr-outline-intwitter"></span> </a> </div> </li> <li id="google-plustheme6" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme6-gplus hvr-outline-ingplus"></span> </a> </div> </li> <li id="linkedintheme6" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme6-linkedin hvr-outline-inlinkedin"></span> </a> </div> </li> <li id="pinteresttheme6" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme6-pinterest hvr-outline-inpinterest"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme6" class=""> <nav> <ul> <li id="facebooktheme6"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme6-facebook hvr-outline-infacebook"></span> </a> </div> </li> <li id="twittertheme6" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme6-twitter hvr-outline-intwitter"></span> </a> </div> </li> <li id="google-plustheme6" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme6-gplus hvr-outline-ingplus"></span> </a> </div> </li> <li id="linkedintheme6" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme6-linkedin hvr-outline-inlinkedin"></span> </a> </div> </li> <li id="pinteresttheme6" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme6-pinterest hvr-outline-inpinterest"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);


  }
}
if(user_selected_skin == "radiused"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme7" class=""> <nav> <ul> <li id="facebooktheme7"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme7-facebook rotatefacebook"></span> </a> </div> </li> <li id="twittertheme7" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme7-twitter rotatetwitter"></span> </a> </div> </li> <li id="google-plustheme7" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme7-gplus rotategplus"></span> </a> </div> </li> <li id="linkedintheme7" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme7-linkedin rotatelinkedin"></span> </a> </div> </li> <li id="pinteresttheme7" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme7-pinterest rotatepinterest"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme7" class=""> <nav> <ul> <li id="facebooktheme7"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme7-facebook rotatefacebook"></span> </a> </div> </li> <li id="twittertheme7" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme7-twitter rotatetwitter"></span> </a> </div> </li> <li id="google-plustheme7" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme7-gplus rotategplus"></span> </a> </div> </li> <li id="linkedintheme7" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme7-linkedin rotatelinkedin"></span> </a> </div> </li> <li id="pinteresttheme7" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme7-pinterest rotatepinterest"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
 $('.wpsocialarrow-social-icons-box').append(skin_data);
  }
}
if(user_selected_skin == "octagon"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme8" class=""> <nav> <ul> <li id="facebooktheme8"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme8-facebook hvr-float-shadow"></span> </a> </div> </li> <li id="twittertheme8" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme8-twitter hvr-float-shadow"></span> </a> </div> </li> <li id="google-plustheme8" data-3="wpsocialarrow-google"> <div > <a target="_blank" target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme8-gplus hvr-float-shadow"></span> </a> </div> </li> <li id="linkedintheme8" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme8-linkedin hvr-float-shadow"></span> </a> </div> </li> <li id="pinteresttheme8" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme8-pinterest hvr-float-shadow"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme8" class=""> <nav> <ul> <li id="facebooktheme8"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme8-facebook hvr-float-shadow"></span> </a> </div> </li> <li id="twittertheme8" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme8-twitter hvr-float-shadow"></span> </a> </div> </li> <li id="google-plustheme8" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme8-gplus hvr-float-shadow"></span> </a> </div> </li> <li id="linkedintheme8" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme8-linkedin hvr-float-shadow"></span> </a> </div> </li> <li id="pinteresttheme8" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme8-pinterest hvr-float-shadow"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
 $('.wpsocialarrow-social-icons-box').append(skin_data);
  }
}
if(user_selected_skin == "hanging"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme9" class=""> <nav> <ul> <li id="facebooktheme9"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme9-facebook hvr-wobble-bottom"></span> </a> </div> </li> <li id="twittertheme9" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme9-twitter hvr-wobble-bottom"></span> </a> </div> </li> <li id="google-plustheme9" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme9-gplus hvr-wobble-bottom"></span> </a> </div> </li> <li id="linkedintheme9" data-4="wpsocialarrow-linkedin"> <div > <a  target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme9-linkedin hvr-wobble-bottom"></span> </a> </div> </li> <li id="pinteresttheme9" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme9-pinterest hvr-wobble-bottom"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme9" class=""> <nav> <ul> <li id="facebooktheme9"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme9-facebook hvr-wobble-bottom"></span> </a> </div> </li> <li id="twittertheme9" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme9-twitter hvr-wobble-bottom"></span> </a> </div> </li> <li id="google-plustheme9" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme9-gplus hvr-wobble-bottom"></span> </a> </div> </li> <li id="linkedintheme9" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme9-linkedin hvr-wobble-bottom"></span> </a> </div> </li> <li id="pinteresttheme9" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme9-pinterest hvr-wobble-bottom"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);

  }
}
if(user_selected_skin == "tricon"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme10" class=""> <nav> <ul> <li id="facebooktheme10"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme10-facebook hvr-buzz-out"></span> </a> </div> </li> <li id="twittertheme10" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme10-twitter hvr-buzz-out"></span> </a> </div> </li> <li id="google-plustheme10" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme10-gplus hvr-buzz-out"></span> </a> </div> </li> <li id="linkedintheme10" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme10-linkedin hvr-buzz-out"></span> </a> </div> </li> <li id="pinteresttheme10" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme10-pinterest hvr-buzz-out"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme10" class=""> <nav> <ul> <li id="facebooktheme10"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme10-facebook hvr-buzz-out"></span> </a> </div> </li> <li id="twittertheme10" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme10-twitter hvr-buzz-out"></span> </a> </div> </li> <li id="google-plustheme10" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme10-gplus hvr-buzz-out"></span> </a> </div> </li> <li id="linkedintheme10" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme10-linkedin hvr-buzz-out"></span> </a> </div> </li> <li id="pinteresttheme10" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme10-pinterest hvr-buzz-out"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
$('.wpsocialarrow-social-icons-box').append(skin_data);
}
  
}
if(user_selected_skin == "hollow"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme11" class=""> <nav> <ul> <li id="facebooktheme11"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme11-facebook rotatefacebook"></span> </a> </div> </li> <li id="twittertheme11" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme11-twitter rotatetwitter"></span> </a> </div> </li> <li id="google-plustheme11" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme11-gplus rotategplus"></span> </a> </div> </li> <li id="linkedintheme11" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme11-linkedin rotatelinkedin"></span> </a> </div> </li> <li id="pinteresttheme11" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme11-pinterest rotatepinterest"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme11" class=""> <nav> <ul> <li id="facebooktheme11"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme11-facebook rotatefacebook"></span> </a> </div> </li> <li id="twittertheme11" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme11-twitter rotatetwitter"></span> </a> </div> </li> <li id="google-plustheme11" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme11-gplus rotategplus"></span> </a> </div> </li> <li id="linkedintheme11" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme11-linkedin rotatelinkedin"></span> </a> </div> </li> <li id="pinteresttheme11" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" href="#"> <span class="wpsocialarrow-theme11-pinterest rotatepinterest"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);

  }
}
if(user_selected_skin == "sociallambs"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"> <div id="wpsocialarrow-theme12" class=""> <nav> <ul> <li id="facebooktheme12"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme12-facebook hvr-pop"></span> </a> </div> </li> <li id="twittertheme12" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme12-twitter hvr-pop"></span> </a> </div> </li> <li id="google-plustheme12" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme12-gplus hvr-pop"></span> </a> </div> </li> <li id="linkedintheme12" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme12-linkedin hvr-pop"></span> </a> </div> </li> <li id="pinteresttheme12" data-5="wpsocialarrow-pinterest"> <div > <a class="wpsocialarrow-pinterest-share" target="_blank" href="#"> <span class="wpsocialarrow-theme12-pinterest hvr-pop"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"> <div id="wpsocialarrow-theme12" class=""> <nav> <ul> <li id="facebooktheme12"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme12-facebook hvr-pop"></span> </a> </div> </li> <li id="twittertheme12" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme12-twitter hvr-pop"></span> </a> </div> </li> <li id="google-plustheme12" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme12-gplus hvr-pop"></span> </a> </div> </li> <li id="linkedintheme12" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme12-linkedin hvr-pop"></span> </a> </div> </li> <li id="pinteresttheme12" data-5="wpsocialarrow-pinterest"> <div > <a class="wpsocialarrow-pinterest-share" target="_blank" href="#"> <span class="wpsocialarrow-theme12-pinterest hvr-pop"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);

  }
}
if(user_selected_skin == "3dicons"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme17" class=""> <nav> <ul> <li id="facebooktheme17"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme17-facebook hvr-grow-rotate"></span> </a> </div> </li> <li id="twittertheme17" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme17-twitter hvr-grow-rotate"></span> </a> </div> </li> <li id="google-plustheme17" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme17-gplus hvr-grow-rotate"></span> </a> </div> </li> <li id="linkedintheme17" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme17-linkedin hvr-grow-rotate"></span> </a> </div> </li> <li id="pinteresttheme17" data-5="wpsocialarrow-pinterest"> <div > <a class="wpsocialarrow-pinterest-share" target="_blank" href="#"> <span class="wpsocialarrow-theme17-pinterest hvr-grow-rotate"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme17" class=""> <nav> <ul> <li id="facebooktheme17"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme17-facebook hvr-grow-rotate"></span> </a> </div> </li> <li id="twittertheme17" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme17-twitter hvr-grow-rotate"></span> </a> </div> </li> <li id="google-plustheme17" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme17-gplus hvr-grow-rotate"></span> </a> </div> </li> <li id="linkedintheme17" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme17-linkedin hvr-grow-rotate"></span> </a> </div> </li> <li id="pinteresttheme17" data-5="wpsocialarrow-pinterest"> <div > <a class="wpsocialarrow-pinterest-share" target="_blank" href="#"> <span class="wpsocialarrow-theme17-pinterest hvr-grow-rotate"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);

  }
}
if(user_selected_skin == "whitestitchedborder"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme14" class=""> <nav> <ul> <li id="facebooktheme14" data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme14-facebook hvr-wobble-skew"></span> </a> </div> </li> <li id="twittertheme14" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme14-twitter hvr-wobble-skew"></span> </a> </div> </li> <li id="google-plustheme14" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme14-gplus hvr-wobble-skew"></span> </a> </div> </li> <li id="linkedintheme14" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme14-linkedin hvr-wobble-skew"></span> </a> </div> </li> <li id="pinteresttheme14" data-5="wpsocialarrow-pinterest"> <div > <a class="wpsocialarrow-pinterest-share" target="_blank" href="#"> <span class="wpsocialarrow-theme14-pinterest hvr-wobble-skew"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"><div id="wpsocialarrow-theme14" class=""> <nav> <ul> <li id="facebooktheme14"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme14-facebook hvr-wobble-skew"></span> </a> </div> </li> <li id="twittertheme14" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme14-twitter hvr-wobble-skew"></span> </a> </div> </li> <li id="google-plustheme14" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme14-gplus hvr-wobble-skew"></span> </a> </div> </li> <li id="linkedintheme14" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme14-linkedin hvr-wobble-skew"></span> </a> </div> </li> <li id="pinteresttheme14" data-5="wpsocialarrow-pinterest"> <div > <a class="wpsocialarrow-pinterest-share" target="_blank" href="#"> <span class="wpsocialarrow-theme14-pinterest hvr-wobble-skew"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);

  }
}
if(user_selected_skin == "whiterounded"){
   if($('#wpsocialarrow-selected-positioning').val() == "both"){
  skin_data = '<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"> <div id="wpsocialarrow-theme15" class=""> <nav> <ul> <li id="facebooktheme15"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme15-facebook hvr-bounce-out"></span> </a> </div> </li> <li id="twittertheme15" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme15-twitter hvr-bounce-out"></span> </a> </div> </li> <li id="google-plustheme15" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme15-gplus hvr-bounce-out"></span> </a> </div> </li> <li id="linkedintheme15" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme15-linkedin hvr-bounce-out"></span> </a> </div> </li> <li id="pinteresttheme15" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share"  href="#"> <span class="wpsocialarrow-theme15-pinterest hvr-bounce-out"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div>';
  $('.wpsocialarrow-social-icons-box').append(skin_data);
}
else{
skin_data ='<p id="wpsocialarrow-user-sharing-message" class="wpsocialarrow-user-sharing-message"></p><div class="col-md-12"> <div id="wpsocialarrow-theme15" class=""> <nav> <ul> <li id="facebooktheme15"  data-1="wpsocialarrow-facebook"> <div><a target="_blank" id="wpsocialarrow-facebook-share" class="wpsocialarrow-facebook-share" href="#"> <span class="wpsocialarrow-theme15-facebook hvr-bounce-out"></span> </a> </div> </li> <li id="twittertheme15" data-2="wpsocialarrow-twitter"> <div ><a target="_blank" id="wpsocialarrow-twitter-share" class="wpsocialarrow-twitter-share" href="#"> <span class="wpsocialarrow-theme15-twitter hvr-bounce-out"></span> </a> </div> </li> <li id="google-plustheme15" data-3="wpsocialarrow-google"> <div > <a target="_blank" id="wpsocialarrow-google-share" class="wpsocialarrow-google-share" href="#"><span class="wpsocialarrow-theme15-gplus hvr-bounce-out"></span> </a> </div> </li> <li id="linkedintheme15" data-4="wpsocialarrow-linkedin"> <div > <a target="_blank" id="wpsocialarrow-linkedin-share" class="wpsocialarrow-linkedin-share" href="#"> <span class="wpsocialarrow-theme15-linkedin hvr-bounce-out"></span> </a> </div> </li> <li id="pinteresttheme15" data-5="wpsocialarrow-pinterest"> <div > <a target="_blank" href="#" id="wpsocialarrow-pinterest-share" class="wpsocialarrow-pinterest-share" > <span class="wpsocialarrow-theme15-pinterest hvr-bounce-out"></span> </a> </div> </li> </ul> </nav> </div><!--End Container--> </div> ';
  $('.wpsocialarrow-social-icons-box').append(skin_data);

}
  
}

    jQuery(document).ready(function(){
      var selectedskin = $('#wpsocialarrow-selected-skin').val();
      var selectedSocialNetworkArray = new Array();
      $("#"+selectedskin).click();
      $("input[name=wpsocialarrow-selcetion-network]").each(function() {
        selectedSocialNetworkArray.push($(this).val());
      });
 
        if ( selectedSocialNetworkArray[0] == "" ) {
          var selectedskin = document.getElementById("wpsocialarrow-selected-skin").value+"-preview";
          $("#"+selectedskin).find('[name=facebook]').hide();
        }
        if ( selectedSocialNetworkArray[1] == "" ) {
          var selectedskin = document.getElementById("wpsocialarrow-selected-skin").value+"-preview";
          $("#"+selectedskin).find('[name=twitter]').hide();
        }
        if ( selectedSocialNetworkArray[2] == "" ) {
          var selectedskin = document.getElementById("wpsocialarrow-selected-skin").value+"-preview";
          $("#"+selectedskin).find('[name=google]').hide();
          $("#"+selectedskin).find('[name=g-plus]').hide();
        }
        if ( selectedSocialNetworkArray[3] == "" ) {
          var selectedskin = document.getElementById("wpsocialarrow-selected-skin").value+"-preview";
          $("#"+selectedskin).find('[name=linkedin]').hide();
        }
        if ( selectedSocialNetworkArray[4] == "" ) {
          var selectedskin = document.getElementById("wpsocialarrow-selected-skin").value+"-preview";
          $("#"+selectedskin).find('[name=pinterest]').hide();
        }
    });
  });

  $(document).ready(function() {
    $(".social-selection").change(function() {

      if ($(this).prop('checked')) {
        if(this.id == "facebook" && $("#wpsocialarrow-selected-social-network1").val() == ""){
          $("#wpsocialarrow-selected-social-network1").val("wpsocialarrow-facebook");
      }
      if(this.id == "twitter" && $("#wpsocialarrow-selected-social-network2").val() == ""){
          $("#wpsocialarrow-selected-social-network2").val("wpsocialarrow-twitter");
      }
       if(this.id == "g-plus" && $("#wpsocialarrow-selected-social-network3").val() == ""){
          $("#wpsocialarrow-selected-social-network3").val("wpsocialarrow-google");
      }
      if(this.id == "linkedin" && $("#wpsocialarrow-selected-social-network4").val() == ""){
          $("#wpsocialarrow-selected-social-network4").val("wpsocialarrow-linkedin");
      }
      if(this.id == "pinterest" && $("#wpsocialarrow-selected-social-network5").val() == ""){
          $("#wpsocialarrow-selected-social-network5").val("wpsocialarrow-pinterest");
      }
        var selectedskin = document.getElementById("wpsocialarrow-selected-skin").value+"-preview";
        if(selectedskin == "3dicons-preview"){
          $("#threedicons-preview").find('[name='+this.id+']').show();
        }
        $("#"+selectedskin).find('[name='+this.id+']').show();
      }
      else {
        if(this.id == "facebook" && $("#wpsocialarrow-selected-social-network1").val() != ""){
          $("#wpsocialarrow-selected-social-network1").val("");
      }
      if(this.id == "twitter" && $("#wpsocialarrow-selected-social-network2").val() != ""){
          $("#wpsocialarrow-selected-social-network2").val("");
      }
       if(this.id == "g-plus" && $("#wpsocialarrow-selected-social-network3").val() != ""){
          $("#wpsocialarrow-selected-social-network3").val("");
      }
      if(this.id == "linkedin" && $("#wpsocialarrow-selected-social-network4").val() != ""){
          $("#wpsocialarrow-selected-social-network4").val("");
      }
      if(this.id == "pinterest" && $("#wpsocialarrow-selected-social-network5").val() != ""){
          $("#wpsocialarrow-selected-social-network5").val("");
      }
        var selectedskin = document.getElementById("wpsocialarrow-selected-skin").value+"-preview";
        if(selectedskin == "3dicons-preview"){
          $("#threedicons-preview").find('[name='+this.id+']').hide();
        }
        $("#"+selectedskin).find('[name='+this.id+']').hide();
      }
    });
    $('label').click(function() {
      if($(this).attr('for') == "afterpost"){
        document.getElementById("wpsocialarrow-live-preview-location").innerHTML="After Post,";
      }
      else if($(this).attr('for') == "beforepost"){
        document.getElementById("wpsocialarrow-live-preview-location").innerHTML="Before Post,";
      }
      else if($(this).attr('for') == "both"){
        document.getElementById("wpsocialarrow-live-preview-location").innerHTML="Before & After Post,";
      }
      else if($(this).attr('for') == "alignleft"){
        document.getElementById("wpsocialarrow-live-preview-align").innerHTML="Align Left";
      }
      else if($(this).attr('for') == "alignright"){
        document.getElementById("wpsocialarrow-live-preview-align").innerHTML="Align Right";
      }
      else if($(this).attr('for') == "aligncenter"){
        document.getElementById("wpsocialarrow-live-preview-align").innerHTML="Align Center";
      }
    });

    $('#wpsocialarrow-enable-post').click(function(){
      if($('#wpsocialarrow-enable-post').prop('checked')) {
        $("#wpsocialarrow-live-preview-post").text("Post ");
      } else {
        $("#wpsocialarrow-live-preview-post").text(" ");
      }
    });

    $('#wpsocialarrow-enable-page').click(function(){
      if($('#wpsocialarrow-enable-page').prop('checked')) {
        $("#wpsocialarrow-live-preview-page").text("Page");
      } else {
        $("#wpsocialarrow-live-preview-page").text(" ");
      }
    });



  });

});
