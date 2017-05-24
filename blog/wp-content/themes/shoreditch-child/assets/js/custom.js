
jQuery(document).ready(function() {

        jQuery("#contact_mail").click(function () { 
            var URL = "/ideas2it/lib/post-contact-mail.php";
            var EmailID = jQuery('#email_id').val();
            var contact = 'contact@ideas2it.com';
            var postUrl = window.location.href;
            var cameFrom = "I2I Blog";
            var userName = "I2I Blog Visitor";
            var pageName = "I2I Blog Post";
             if(jQuery.trim(EmailID).length == 0){
                jQuery("#email_id").attr("placeholder","Please enter your email").addClass("changePlaceColor1").addClass("changePlaceColor2").addClass("changePlaceColor3").addClass("changePlaceColor4");
            }else if(!validateEmail(EmailID)){
                jQuery("#email_id").val("").attr("placeholder","Please enter valid email").addClass("changePlaceColor1").addClass("changePlaceColor2").addClass("changePlaceColor3").addClass("changePlaceColor4");
            }else if (jQuery.trim(EmailID).length != 0 && validateEmail(EmailID)) {
                console.log("success");
            jQuery('#contact-mail').attr("disabled", true);
            var m_data = new FormData();
            m_data.append( 'userName', userName);
            m_data.append( 'email', EmailID);
            m_data.append( 'subject', "Ideas2IT - Blog");
            m_data.append( 'postUrl', postUrl);
            m_data.append( 'toEmail', contact);
            m_data.append( 'cameFrom', cameFrom);
            m_data.append( 'pageName', pageName);
             jQuery('#loading').show();
                jQuery.ajax({
                    type: 'POST',
                    url: URL,
                    data: m_data,
                    processData: false,
                    contentType: false,
                    success: function (result) {
                        
                        jQuery("#alertMsg").delay(200).fadeIn(100);
                        jQuery('#email_id').val('');
                        jQuery('#contact-mail').attr("disabled", false);
                        jQuery('#loading').hide();
                        
                    }
                });
                jQuery("#errorMsg").hide();
                jQuery(".contactfor_form_section").hide();
                jQuery(".success_box").fadeIn(200);
            }
            else {
                jQuery('#errorMsg').fadeIn(200);
                jQuery('#contact-mail').attr("disabled", false);
            }

        });
        
    });
	function validateEmail(email) {
	    var filter = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    if (filter.test(email)) {
	            return true;
	        }
	        else {
	            return false;
	        }
	}
     