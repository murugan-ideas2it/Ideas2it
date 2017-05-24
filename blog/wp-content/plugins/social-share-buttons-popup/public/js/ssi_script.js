var wpsocialarrow_networks = new Array();
var wpsocialarrow_networks_links = new Array();
jQuery(document).ready(function($) {   
	$(window).load(function() {

		wpsocialarrow_networks =["facebook" , 
		"twitter" , 
		"google" , 
		"linkedin" , 
		"pinterest"];
		wpsocialarrow_networks_ids = ["wpsocialarrow-facebook-share",
		"wpsocialarrow-twitter-share",
		"wpsocialarrow-google-share",
		"wpsocialarrow-linkedin-share",
		"wpsocialarrow-pinterest-share"];
		wpsocialarrow_networks_url = ["http://www.facebook.com/sharer/sharer.php?u=",
		"https://twitter.com/share?url=",
		"https://plus.google.com/share?url=",
		"http://www.linkedin.com/shareArticle?url=",
		"http://pinterest.com/pin/create/button/?url="];
		arrayLength = wpsocialarrow_networks.length;
		arrayLengthlink = wpsocialarrow_networks_ids.length;
		post_url = $("#wpsocialarrow-get-post-id").val();
		for (var i = 0; i < arrayLength ; i++) {
		
			if($("#wpsocialarrow-selected-social-network"+[i+1]).val() ==''){
				$(".wpsocialarrow-social-icons-box").find("[data-"+[i+1]+"]").remove();
			}
			else{

			}
		}

		for (var j = 0 ; j < arrayLengthlink; j++) {
		
			$("."+wpsocialarrow_networks_ids[j]).attr("href", wpsocialarrow_networks_url[j]+post_url);
		}
		if($("#wpsocialarrow-selected-alignment").val() == "alignleft"){
			$('.wpsocialarrow-social-icons-box').addClass("wpsocialarrow-alignleft");
		}
		if($("#wpsocialarrow-selected-alignment").val() == "alignright"){
			$('.wpsocialarrow-social-icons-box').addClass("wpsocialarrow-alignright");
		}
		if($("#wpsocialarrow-selected-alignment").val() == "aligncenter"){
			$('.wpsocialarrow-social-icons-box').addClass("wpsocialarrow-aligncenter");
		}	


		var message = $("#wpsocialarrow-selected-message").val();
		var customMessage = $("#wpsocialarrow-selected-custom-message").val();

		if($("#wpsocialarrow-selected-message").val()=="None"){
			$(".wpsocialarrow-user-sharing-message").append("");	
		}
		else if($("#wpsocialarrow-selected-message").val()=="Custom Message"){
			$(".wpsocialarrow-user-sharing-message").append(customMessage);	
		}
		else{
		$(".wpsocialarrow-user-sharing-message").append(message);	
		}
		var message_font = $("#wpsocialarrow-selected-message-font").val();
		$('.wpsocialarrow-user-sharing-message').css('font-family',message_font);
		message_font = message_font.replace(/\s+/g, '+');
		$("<link href='https://fonts.googleapis.com/css?family="+message_font+"' rel='stylesheet' type='text/css'>").appendTo(document.head);



	});

});
