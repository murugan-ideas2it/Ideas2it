<?php


function wpssi_menu_item()
{
   add_menu_page("Social Share Icons", "Social Share Icons","manage_options", "wpssi-options", "wpssi_settings_page" , 'dashicons-share' , "20"); 
   add_action( 'admin_init', 'wpssi_register_settings');
}

add_action("admin_menu", "wpssi_menu_item");



function wpssi_register_settings(){

  register_setting('wpssi-settings-group', 'wpsocialarrow-enable-plugin' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-enable-post' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-enable-page' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-enable-home' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-message-selection' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-custom-message' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-positioning' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-alignment' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-facebook' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-twitter' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-google' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-linkedin' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-pinterest' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-skins' , 'wpssi_sanitize_options');
  register_setting('wpssi-settings-group', 'wpsocialarrow-gfonts', 'wpssi_sanitize_options');

}


function wpssi_settings_page()
{
  global $post;

   $url = get_permalink($post->ID);
   $url = esc_url($url);
  ?>
  <!-- Top Header Brand Bra -->

  <form method="post" action="options.php" >
    <?php settings_fields('wpssi-settings-group');?>
    <div class="top-brand">
      <div class="top-brand-icon" style=""></div>
    </div>
    <!-- End Top Header Brand Bra -->

    <!-- Live Preview Container -->
    <p id="wpsocialarrow-submit-date" class="submit">
      <input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" />
    </p>
    <div id="live-preview">
      <!-- Live Preview Options Container -->
      <div id="wpsocialarrow-live-preview-options" class="col-md-12">
        <div id="wpsocialarrow-live-preview-heading" class="col-md-12 text-center">See Live Preview Here</div>
          <div id="wpsocialarrow-live-preview-options-settings" class="">
            <p>
              <span><strong>Default Message:</strong></span> 
              <span id="wpsocialarrow-default-message-option"><?php if( get_option('wpsocialarrow-custom-message') == "" ) echo get_option('wpsocialarrow-message-selection'); else { echo get_option('wpsocialarrow-custom-message'); }?></span>
            </p>
          </div>
        <div id="wpsocialarrow-live-preview-options-settings">
          <p>
            <span><strong>Post Type:</strong></span> 
            <span id="wpsocialarrow-live-preview-post"><?php if( get_option('wpsocialarrow-enable-post') != "" ) echo "Post"; else { echo ""; }?></span>
            <span id="wpsocialarrow-live-preview-page"><?php if( get_option('wpsocialarrow-enable-page') != "" ) echo "Page"; else{ echo ""; }?></span>
            <span id="wpsocialarrow-live-preview-page"><?php if( get_option('wpsocialarrow-enable-home') != "" ) echo "Home"; else{ echo ""; }?></span>
          </p>
        </div>
        <div id="wpsocialarrow-live-preview-options-settings">
          <p>
            <span><strong>Selected Skin:</strong></span> 

            <span> <?php print_r( get_option('wpsocialarrow-skins')); ?><!-- <?php if( get_option('wpsocialarrow-skins') != "" ) echo get_option('wpsocialarrow-skins'); else { echo ""; }?> --></span>
          </p>
        </div>
        <div id="wpsocialarrow-live-preview-options-settings">
          <p> 
            <span><strong>Location:</strong></span> 
            <span id="wpsocialarrow-live-preview-location"><?php if( get_option('wpsocialarrow-positioning') == "afterpost" ) echo "After Post"; else if(get_option('wpsocialarrow-positioning') == "beforepost") echo "Before Post"; else if(get_option('wpsocialarrow-positioning') == "both") echo "Before and After Post "; else{echo "";} ?></span> 
            <span id="wpsocialarrow-live-preview-align"><?php if( get_option('wpsocialarrow-alignment') == "alignleft" ) echo "Align Left"; else if(get_option('wpsocialarrow-alignment') == "alignright") echo "Align Right"; else if(get_option('wpsocialarrow-alignment') == "aligncenter") echo "Align Center"; else{echo "";} ?></span>
          </p>
        </div>


      </div>
      <!-- End Live Preview Options Container -->

      <!-- Social Skins Preview Container -->
      <span id="wpsocialarrow-messages-selection-span" style="font-family: <?php echo get_option('wpsocialarrow-gfonts'); ?>;font-size: 28px;display: block;margin-bottom: 13px;"><?php 
      if(get_option("wpsocialarrow-message-selection")=="None")
        { 
          echo ""; 
        }
        else if(get_option("wpsocialarrow-message-selection")=="Custom Message") 
          { 
            echo get_option("wpsocialarrow-custom-message"); 
          }
        else{
           echo get_option("wpsocialarrow-message-selection"); 
          }?></span>
      <div id="preview-parent" class="col-md-12 text-center">
        <!-- Live preview will show here -->
      </div>
      <!-- End Social Skins Preview Container -->

    </div>
    <!-- Live Preview Container -->


    <div id="main-container" class="margining">
      <div class="margining">
        <div class="margining">
          <div class="tabs-left">
            <div class="tab-content">

              <!-- All the Plugins Option's Container -->
              <div class="tab-pane active" id="a" style="height: 2650px;">
                <h1 class="">CONFIGURE SOCIAL SHARE SETTINGS</h1>

                <!-- Label for Plugin Enable/Disable Option -->
                <div id="wpsocialarrow-label"><label>Enable Social Share Plugin:</label></div>
                <!-- End Label for Plugin Enable/Disable Option -->

                <!-- Plugin Enable/Disable Option -->
                <div id="wpsocialarrow-value">
                  <div class="switch" style="margin-top: -8px;">
                    <input id="wpsocialarrow-enable-plugin" name="wpsocialarrow-enable-plugin" class="cmn-toggle cmn-toggle-round" type="checkbox"  value='1'<?php checked(1, get_option('wpsocialarrow-enable-plugin')); ?> >
                    <label for="wpsocialarrow-enable-plugin"></label>
                  </div>
                </div>
                <!-- End Plugin Enable/Disable Option -->
                
                 <!-- Added Google Fonts Container -->
                <div id="wpsocialarrow-label"><label>Select Fonts For Message:</label></div>

                <div id="wpsocialarrow-value">

                  <input name="" id="wpsocialarrow_gfonts" class="wpsocialarrow_msgfont" type="text" />
                  <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Premium Feature</a>

                </div>
                <!-- End Added Google Fonts Container -->

                <!-- Label for Default Message Option -->
                <div id="wpsocialarrow-label"><label>Default Message:</label></div>
                <!-- Label for Default Message Option -->

                <!-- Default Message Option Values -->
                <div id="wpsocialarrow-value">
                  <select id="wpsocialarrow-message-selection" name="wpsocialarrow-message-selection">
                    <option value="None" <?php selected( get_option('wpsocialarrow-message-selection'),'None'); ?>   >None</option>

                    <option value="Share this post"<?php selected( get_option('wpsocialarrow-message-selection'),'Share this post'); ?>   >Share this post</option>

                    <option value="Show Some Love for us!"<?php selected( get_option('wpsocialarrow-message-selection'),'Show Some Love for us!'); ?>   >Show Some Love for us!</option>

                    <option value="Sharing is Caring"<?php selected( get_option('wpsocialarrow-message-selection'),'Sharing is Caring'); ?>   >Sharing is Caring</option>

                    <option value="Hey check this out" <?php selected( get_option('wpsocialarrow-message-selection'),'Hey check this out'); ?>>Hey check this out</option>

                    <option value="Share this!"<?php selected( get_option('wpsocialarrow-message-selection'),'Share this!'); ?>   >Share this!</option>

                    <option value="Share the knowledge"<?php selected( get_option('wpsocialarrow-message-selection'),'Share the knowledge'); ?>   >Share the knowledge</option>

                    <option value="Wanna share this?"<?php selected( get_option('wpsocialarrow-message-selection'),'Wanna share this?'); ?>   >Wanna share this?</option>
                    <option value="Custom Message"<?php selected( get_option('wpsocialarrow-message-selection'),'Custom Message'); ?>   >Custom Message</option>
                  </select>
                  <input id="wpsocialarrow-custom-default-message" name="" type="text" disabled placeholder="Set your custom message"/><span id="wpsocialarrow-custom-size-span"><a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Premium Feature</a> (Add your custom message if don't use default ones)</span>
                  <p class="wpsocialarrow-custom-message-help">Select <strong>"Custom Message"</strong> option from drop down list if you want to add custom message to your social icons</p>
                </div>
                <!-- Default Message Option Values -->

                <!-- Labels for Post Types -->
                <div id="wpsocialarrow-label"><label>Social Buttons Settings:</label></div>
                <!-- End Labels for Post Types -->

                <!-- Post Type Values -->
                <div id="wpsocialarrow-value">
                  <div id="wpsocialarrow-label-value"><label id="wpsocialarrow-post-label">Show on Posts</label>
                    <div class="switch" style="margin-top: -6px;margin-left: 180px;">
                      <input id="wpsocialarrow-enable-post" name="wpsocialarrow-enable-post" class="cmn-toggle cmn-toggle-round" type="checkbox" value='1'<?php checked(1, get_option('wpsocialarrow-enable-post')); ?>>
                      <label for="wpsocialarrow-enable-post"></label>
                    </div>
                  </div>
                  <div id="wpsocialarrow-label-value"><label id="wpsocialarrow-page-label">Show on Pages</label>
                    <div class="switch" style="margin-left: 180px;">
                      <input id="wpsocialarrow-enable-page" name="wpsocialarrow-enable-page" class="cmn-toggle cmn-toggle-round" type="checkbox" value='1'<?php checked(1, get_option('wpsocialarrow-enable-page')); ?>>
                      <label for="wpsocialarrow-enable-page"></label>
                    </div>
                  </div>
                  <div id="wpsocialarrow-label-value"><label id="wpsocialarrow-page-label">Show on Home Page</label>
                    <div class="switch" style="margin-left: 180px;">
                      <input id="wpsocialarrow-enable-home" name="wpsocialarrow-enable-home" class="cmn-toggle cmn-toggle-round" type="checkbox" value='1'<?php checked(1, get_option('wpsocialarrow-enable-home')); ?>>
                      <label for="wpsocialarrow-enable-home"></label>
                    </div>
                  </div>
                </div>
                <hr style="margin-top: 140px;">
                <!-- End Post Type Values -->

                <!-- Position Selection Container for Social Icons -->
                <div id="wpsocialarrow-position-wrapper">
                  <h1 class="">SELECT THE BEST SUITABLE LOCATION</h1> 
                  <div id="wpsocialarrow-positioning-div">
                  <p id="wpsocialarrow-paragraph-seperator">Select Position of your social icons</p>
                  <div id="wpsocialarrow-positioning">
                    <label for="afterpost"><img src='<?php echo plugins_url( 'admin/images/afterpost.png', __FILE__); ?>' /></label><br/>
                    <input id="afterpost" type="radio" name="wpsocialarrow-positioning" value="afterpost" <?php checked('afterpost', get_option('wpsocialarrow-positioning')); ?> />
                  </div>
                  <div id="wpsocialarrow-positioning">
                    <label for="beforepost"><a style="font-size: 15px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Premium Feature</a><img src='<?php echo plugins_url( 'admin/images/beforepost.png', __FILE__); ?>' /></label><br/>
                    <input id="beforepost" disabled type="radio" name=""  />
                  </div>
                  <div id="wpsocialarrow-positioning">
                    <label for="both"><a style="font-size: 15px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Premium Feature</a><img src='<?php echo plugins_url( 'admin/images/both.png', __FILE__); ?>' /></label><br/>
                    <input id="both" disabled type="radio" name="" />
                  </div>
                  </div>
                  <div id="wpsocialarrow-alignment-div">
                  <p id="wpsocialarrow-paragraph-seperator">Select Alignment of your social icons</p>
                  <div id="wpsocialarrow-positioning">
                    <label for="alignleft"><img src='<?php echo plugins_url( 'admin/images/alignleft.png', __FILE__); ?>' /></label><br/>
                    <input id="alignleft"  type="radio" name="wpsocialarrow-alignment" value="alignleft"<?php checked('alignleft', get_option('wpsocialarrow-alignment')); ?>/>
                  </div>
                  <div id="wpsocialarrow-positioning">
                    <label for="aligncenter"><a style="font-size: 15px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Premium Feature</a><img src='<?php echo plugins_url( 'admin/images/aligncenter.png', __FILE__); ?>' /></label><br/>
                    <input id="aligncenter" disabled type="radio"  />
                  </div>
                  <div id="wpsocialarrow-positioning">
                    <label for="alignright"><a style="font-size: 15px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Premium Feature</a><img src='<?php echo plugins_url( 'admin/images/alignright.png', __FILE__); ?>' /></label><br/>
                    <input id="alignright" disabled type="radio" name=""  />
                  </div>
                  </div>
                </div>
                <!-- Position Selection Container for Social Icons -->
                <hr>

                <!-- Social Network Selection Container -->
                <div id="wpsocialarrow-social-network-selection">
                  <h1 class="">CUSTMOIZE YOUR SOCIAL NETWORK SETTINGS</h1>
                  <h4>SELECT SOCIAL NETWORKS</h4>
                  <div id="wpsocialarrow-selection">
                    <label for="facebook"><a class="facebook" title="Facebook"></a></label><br/>
                    <input id="facebook" class="facebookcb social-selection" type="checkbox" name="wpsocialarrow-facebook" value="wpsocialarrow-facebook" <?php checked('wpsocialarrow-facebook', get_option('wpsocialarrow-facebook')); ?> >
                  </div>
                  <div id="wpsocialarrow-selection">
                    <label for="twitter"><a class="twitter" title="Twitter"></a></label><br/>
                    <input id="twitter" class="twittercb social-selection" type="checkbox" name="wpsocialarrow-twitter" value="wpsocialarrow-twitter" <?php checked('wpsocialarrow-twitter', get_option('wpsocialarrow-twitter')); ?> >
                  </div>
                  <div id="wpsocialarrow-selection">
                    <label for="g-plus"><a class="g-plus" title="Google+"></a></label><br/>
                    <input id="g-plus" class="googlecb social-selection" type="checkbox" name="wpsocialarrow-google"
                    value="wpsocialarrow-google" <?php checked('wpsocialarrow-google', get_option('wpsocialarrow-google')); ?>>
                  </div>
                  <div id="wpsocialarrow-selection">
                    <label for="linkedin"><a class="linkedin" title="LinkedIn"></a></label><br/>
                    <input id="linkedin" class="linkedincb social-selection" type="checkbox" name="wpsocialarrow-linkedin" value="wpsocialarrow-linkedin" <?php checked('wpsocialarrow-linkedin', get_option('wpsocialarrow-linkedin')); ?>>
                  </div>
                  <div id="wpsocialarrow-selection">
                    <label for="pinterest"><a class="pinterest" title="Pinterest"></a></label><br/>
                    <input id="pinterest" class="pinterestcb social-selection" type="checkbox" name="wpsocialarrow-pinterest" value="wpsocialarrow-pinterest" <?php checked('wpsocialarrow-pinterest', get_option('wpsocialarrow-pinterest')); ?> >
                  </div>
                </div>
                <!-- End Social Network Selection Container -->


                <hr style="margin-top: 10px; ">
                <h1 class="">GIVE A UNIQUE LOOK TO YOUR SOCIAL ICONS</h1>
                <h4>SELECT SOCIAL NETWORK SKINS</h4>

                <!-- Including Skins Using js -->
                <div id="includedskin1" data-selected-skin="default-skin">
                  <div class="col-md-12">
                    <input id="default-skin"   type="radio" name="wpsocialarrow-skins" value="default-skin"  <?php checked('default-skin', get_option('wpsocialarrow-skins') ); ?> /><label id="wpsocialarrow-skins-label" for="default-skin">  Default  </label>
                    <div class="social1" style="display: block !important;">
                      <a href="#" class="facebook" title="Facebook"></a>
                      <a href="#" class="twitter" title="Twitter"></a>
                      <a href="#" class="google" title="Google+"></a>
                      <a href="#" class="linkedin" title="LinkedIn"></a>
                      <a href="#" class="pinterest" title="Pinterest"></a>
                    </div><!--End Container-->
                  </div>
                </div>
                <div id="includedskin2">
                  <div class="col-md-12">
                    <input id="social-wide" disabled type="radio" name=""  /><label id="wpsocialarrow-skins-label" for="social-wide">  Social Wide <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
                    <div class="social1">
                      <a href="#" class="facebook" title="Facebook"></a>
                      <a href="#" class="twitter" title="Twitter"></a>
                      <a href="#" class="google" title="Google+"></a>
                      <a href="#" class="linkedin" title="LinkedIn"></a>
                      <a href="#" class="pinterest" title="Pinterest"></a>
                    </div><!--End Container-->
                  </div>
                </div>
                <div id="includedskin3">
                  <div class="col-md-12">
                    <input id="bounce-up" disabled type="radio" /><label id="wpsocialarrow-skins-label" for="bounce-up">  Flip Cards (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
                    <div class="social1" style="display: block !important;">
                      <a href="http://www.facebook.com/wayne.spiegel" target="_blank">
                        <div class="social--facebook"></div>
                      </a>
                      <a href="http://www.twitter.com/waynespiegel" target="_blank">
                        <div class="social--twitter"></div>
                      </a>
                      <a href="http://www.dribbble.com/waynespiegel" target="_blank">
                        <div class="social--google"></div>
                      </a>
                      <a href="http://www.dribbble.com/waynespiegel" target="_blank">
                        <div class="social--linkedin"></div>
                      </a>
                      <a href="http://www.dribbble.com/waynespiegel" target="_blank">
                        <div class="social--pinterest"></div>
                      </a>
                    </div><!--End Container-->
                  </div>
                </div>
                <div id="includedskin4">
                  <div class="col-md-12">
                    <input id="grind-in" disabled type="radio" /><label id="wpsocialarrow-skins-label" for="grind-in">  Roller (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
                    <div class="social_icons">
                      <a class="btn_facebook"><i class="fa fa-facebook"></i><i class="fa fa-facebook"></i></a>
                      <a class="btn_twitter"><i class="fa fa-twitter"></i><i class="fa fa-twitter"></i></a>
                      <a class="btn_google-plus"><i class="fa fa-google-plus"></i><i class="fa fa-google-plus"></i></a>
                      <a class="btn_linkedin"><i class="fa fa-linkedin"></i><i class="fa fa-linkedin"></i></a>
                      <a class="btn_pinterest"><i class="fa fa-pinterest"></i><i class="fa fa-pinterest"></i></a>
                    </div>
                  </div>
                </div>
                <div id="includedskin5">
                  <div class="col-md-12">
                    <input id="paper-fold" disabled type="radio" /><label id="wpsocialarrow-skins-label" for="paper-fold">  Paper Fold (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
                    <div  id="wpsocialarrow-theme5" class="">
                      <nav>
                        <ul>
                          <li id="facebooktheme5">
                            <div><a href="#">
                              <span class="wpsocialarrow-theme5-facebook hvr-wobble-vertical"></span>
                            </a>
                          </div>
                        </li>
                        <li id="twittertheme5">
                          <div ><a href="#">
                            <span class="wpsocialarrow-theme5-twitter hvr-wobble-vertical"></span>
                          </a>
                        </div>
                      </li>
                      <li id="google-plustheme5">
                        <div >
                          <a href="#"><span class="wpsocialarrow-theme5-gplus hvr-wobble-vertical"></span>
                          </a>
                        </div>
                      </li>
                      <li id="linkedintheme5">
                        <div >
                          <a href="#">
                            <span class="wpsocialarrow-theme5-linkedin hvr-wobble-vertical"></span>
                          </a>
                        </div>
                      </li>
                      <li id="pinteresttheme5">
                        <div >
                          <a href="#">
                            <span class="wpsocialarrow-theme5-pinterest hvr-wobble-vertical"></span>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </nav>
                </div><!--End Container-->
              </div>
            </div>
            <div id="includedskin6">
              <div class="col-md-12">
                <input id="branded" disabled type="radio" /><label id="wpsocialarrow-skins-label" for="branded">  Branded (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
                <div  id="wpsocialarrow-theme6" class="">
                  <nav>
                    <ul>
                      <li id="facebooktheme6">
                        <div><a href="#">
                          <span class="wpsocialarrow-theme6-facebook hvr-outline-infacebook"></span>
                        </a>
                      </div>
                    </li>
                    <li id="twittertheme6">
                      <div ><a href="#">
                        <span class="wpsocialarrow-theme6-twitter hvr-outline-intwitter"></span>
                      </a>
                    </div>
                  </li>
                  <li id="google-plustheme6">
                    <div >
                      <a href="#"><span class="wpsocialarrow-theme6-gplus hvr-outline-ingplus"></span>
                      </a>
                    </div>
                  </li>
                  <li id="linkedintheme6">
                    <div >
                      <a href="#">
                        <span class="wpsocialarrow-theme6-linkedin hvr-outline-inlinkedin"></span>
                      </a>
                    </div>
                  </li>
                  <li id="pinteresttheme6">
                    <div >
                      <a href="#">
                        <span class="wpsocialarrow-theme6-pinterest hvr-outline-inpinterest"></span>
                      </a>
                    </div>
                  </li>
                </ul>
              </nav>
            </div><!--End Container-->
          </div>
        </div>
        <div id="includedskin7">
          <div class="col-md-12">
            <input id="radiused" disabled type="radio"  /><label id="wpsocialarrow-skins-label" for="radiused">  Radiused (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
            <div  id="wpsocialarrow-theme7" class="">
              <nav>
                <ul>
                  <li id="facebooktheme7">
                    <div><a href="#">
                      <span class="wpsocialarrow-theme7-facebook rotatefacebook"></span>
                    </a>
                  </div>
                </li>
                <li id="twittertheme7">
                  <div ><a href="#">
                    <span class="wpsocialarrow-theme7-twitter rotatetwitter"></span>
                  </a>
                </div>
              </li>
              <li id="google-plustheme7">
                <div >
                  <a href="#"><span class="wpsocialarrow-theme7-gplus rotategplus"></span>
                  </a>
                </div>
              </li>
              <li id="linkedintheme7">
                <div >
                  <a href="#">
                    <span class="wpsocialarrow-theme7-linkedin rotatelinkedin"></span>
                  </a>
                </div>
              </li>
              <li id="pinteresttheme7">
                <div >
                  <a href="#">
                    <span class="wpsocialarrow-theme7-pinterest rotatepinterest"></span>
                  </a>
                </div>
              </li>
            </ul>
          </nav>
        </div><!--End Container-->
      </div>
    </div>
    <div id="includedskin8">
      <div class="col-md-12">
        <input id="octagon" disabled type="radio"  /><label id="wpsocialarrow-skins-label" for="octagon">  Octagon (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
        <div  id="wpsocialarrow-theme8" class="">
          <nav>
            <ul>
              <li id="facebooktheme8">
                <div><a href="#">
                  <span class="wpsocialarrow-theme8-facebook hvr-float-shadow"></span>
                </a>
              </div>
            </li>
            <li id="twittertheme8">
              <div ><a href="#">
                <span class="wpsocialarrow-theme8-twitter hvr-float-shadow"></span>
              </a>
            </div>
          </li>
          <li id="google-plustheme8">
            <div >
              <a href="#"><span class="wpsocialarrow-theme8-gplus hvr-float-shadow"></span>
              </a>
            </div>
          </li>
          <li id="linkedintheme8">
            <div >
              <a href="#">
                <span class="wpsocialarrow-theme8-linkedin hvr-float-shadow"></span>
              </a>
            </div>
          </li>
          <li id="pinteresttheme8">
            <div >
              <a href="#">
                <span class="wpsocialarrow-theme8-pinterest hvr-float-shadow"></span>
              </a>
            </div>
          </li>
        </ul>
      </nav>
    </div><!--End Container-->
  </div>
</div>
<div id="includedskin9">
  <div class="col-md-12 ">
    <input id="hanging" disabled type="radio"  /><label id="wpsocialarrow-skins-label" for="hanging">  Hanging (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
    <div  id="wpsocialarrow-theme9" class="">
      <nav>
        <ul>
          <li id="facebooktheme9">
            <div><a href="#">
              <span class="wpsocialarrow-theme9-facebook hvr-wobble-bottom"></span>
            </a>
          </div>
        </li>
        <li id="twittertheme9">
          <div ><a href="#">
            <span class="wpsocialarrow-theme9-twitter hvr-wobble-bottom"></span>
          </a>
        </div>
      </li>
      <li id="google-plustheme9">
        <div >
          <a href="#"><span class="wpsocialarrow-theme9-gplus hvr-wobble-bottom"></span>
          </a>
        </div>
      </li>
      <li id="linkedintheme9">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme9-linkedin hvr-wobble-bottom"></span>
          </a>
        </div>
      </li>
      <li id="pinteresttheme9">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme9-pinterest hvr-wobble-bottom"></span>
          </a>
        </div>
      </li>
    </ul>
  </nav>
</div><!--End Container-->
</div>
</div>
<div id="includedskin10">
  <div class="col-md-12">
    <input id="tricon" disabled type="radio"  /><label id="wpsocialarrow-skins-label" for="tricon">  Tricon (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
    <div  id="wpsocialarrow-theme10" class="">
      <nav>
        <ul>
          <li id="facebooktheme10">
            <div><a href="#">
              <span class="wpsocialarrow-theme10-facebook hvr-buzz-out"></span>
            </a>
          </div>
        </li>
        <li id="twittertheme10">
          <div ><a href="#">
            <span class="wpsocialarrow-theme10-twitter hvr-buzz-out"></span>
          </a>
        </div>
      </li>
      <li id="google-plustheme10">
        <div >
          <a href="#"><span class="wpsocialarrow-theme10-gplus hvr-buzz-out"></span>
          </a>
        </div>
      </li>
      <li id="linkedintheme10">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme10-linkedin hvr-buzz-out"></span>
          </a>
        </div>
      </li>
      <li id="pinteresttheme10">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme10-pinterest hvr-buzz-out"></span>
          </a>
        </div>
      </li>
    </ul>
  </nav>
</div><!--End Container-->
</div>
</div>
<div id="includedskin11">
  <div class="col-md-12">
    <input id="hollow" disabled type="radio" /><label id="wpsocialarrow-skins-label" for="hollow">  Hollow (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
    <div  id="wpsocialarrow-theme11" class="">
      <nav>
        <ul>
          <li id="facebooktheme11">
            <div><a href="#">
              <span class="wpsocialarrow-theme11-facebook rotatefacebook"></span>
            </a>
          </div>
        </li>
        <li id="twittertheme11">
          <div ><a href="#">
            <span class="wpsocialarrow-theme11-twitter rotatetwitter"></span>
          </a>
        </div>
      </li>
      <li id="google-plustheme11">
        <div >
          <a href="#"><span class="wpsocialarrow-theme11-gplus rotategplus"></span>
          </a>
        </div>
      </li>
      <li id="linkedintheme11">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme11-linkedin rotatelinkedin"></span>
          </a>
        </div>
      </li>
      <li id="pinteresttheme11">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme11-pinterest rotatepinterest"></span>
          </a>
        </div>
      </li>
    </ul>
  </nav>
</div><!--End Container-->
</div>
</div>
<div id="includedskin12">
  <div class="col-md-12">
    <input id="sociallambs" disabled type="radio" /><label id="wpsocialarrow-skins-label" for="sociallambs">  Social Lambs (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
    <div  id="wpsocialarrow-theme12" class="">
      <nav>
        <ul>
          <li id="facebooktheme12">
            <div><a href="#">
              <span class="wpsocialarrow-theme12-facebook hvr-pop"></span>
            </a>
          </div>
        </li>
        <li id="twittertheme12">
          <div ><a href="#">
            <span class="wpsocialarrow-theme12-twitter hvr-pop"></span>
          </a>
        </div>
      </li>
      <li id="google-plustheme12">
        <div >
          <a href="#"><span class="wpsocialarrow-theme12-gplus hvr-pop"></span>
          </a>
        </div>
      </li>
      <li id="linkedintheme12">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme12-linkedin hvr-pop"></span>
          </a>
        </div>
      </li>
      <li id="pinteresttheme12">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme12-pinterest hvr-pop"></span>
          </a>
        </div>
      </li>
    </ul>
  </nav>
</div><!--End Container-->
</div>
</div>
<div id="includedskin13">
  <div class="col-md-12">
    <input id="3dicons" disabled type="radio" /><label id="wpsocialarrow-skins-label" for="3dicons">  3D Icons (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
    <div  id="wpsocialarrow-theme17" class="">
      <nav>
        <ul>
          <li id="facebooktheme17">
            <div><a href="#">
              <span class="wpsocialarrow-theme17-facebook hvr-grow-rotate"></span>
            </a>
          </div>
        </li>
        <li id="twittertheme17">
          <div ><a href="#">
            <span class="wpsocialarrow-theme17-twitter hvr-grow-rotate"></span>
          </a>
        </div>
      </li>
      <li id="google-plustheme17">
        <div >
          <a href="#"><span class="wpsocialarrow-theme17-gplus hvr-grow-rotate"></span>
          </a>
        </div>
      </li>
      <li id="linkedintheme17">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme17-linkedin hvr-grow-rotate"></span>
          </a>
        </div>
      </li>
      <li id="pinteresttheme17">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme17-pinterest hvr-grow-rotate"></span>
          </a>
        </div>
      </li>
    </ul>
  </nav>
</div><!--End Container-->
</div>
</div>
<div id="includedskin14">
  <div class="col-md-12">
    <input id="whitestitchedborder" disabled type="radio"  /><label id="wpsocialarrow-skins-label" for="whitestitchedborder">  White Stitched Border  (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
    <div  id="wpsocialarrow-theme14" class="">
      <nav>
        <ul>
          <li id="facebooktheme14">
            <div><a href="#">
              <span class="wpsocialarrow-theme14-facebook hvr-wobble-skew"></span>
            </a>
          </div>
        </li>
        <li id="twittertheme14">
          <div ><a href="#">
            <span class="wpsocialarrow-theme14-twitter hvr-wobble-skew"></span>
          </a>
        </div>
      </li>
      <li id="google-plustheme14">
        <div >
          <a href="#"><span class="wpsocialarrow-theme14-gplus hvr-wobble-skew"></span>
          </a>
        </div>
      </li>
      <li id="linkedintheme14">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme14-linkedin hvr-wobble-skew"></span>
          </a>
        </div>
      </li>
      <li id="pinteresttheme14">
        <div >
          <a href="#">
            <span class="wpsocialarrow-theme14-pinterest hvr-wobble-skew"></span>
          </a>
        </div>
      </li>
    </ul>
  </nav>
</div><!--End Container-->
</div>
</div>
<div id="includedskin15"><div class="col-md-12">
  <input id="whiterounded" disabled type="radio" /><label id="wpsocialarrow-skins-label" for="whiterounded">  White Rounded (With Animation) <a style="font-size: 20px;margin-left: 10px;" target="_blank" href="https://www.arrowplugins.com/social-share-plugin">Locked</a> </label>
  <div  id="wpsocialarrow-theme15" class="">
    <nav>
      <ul>
        <li id="facebooktheme15">
          <div><a href="#">
            <span class="wpsocialarrow-theme15-facebook hvr-bounce-out"></span>
          </a>
        </div>
      </li>
      <li id="twittertheme15">
        <div ><a href="#">
          <span class="wpsocialarrow-theme15-twitter hvr-bounce-out"></span>
        </a>
      </div>
    </li>
    <li id="google-plustheme15">
      <div >
        <a href="#">
          <span class="wpsocialarrow-theme15-gplus hvr-bounce-out"></span>
        </a>
      </div>
    </li>
    <li id="linkedintheme15">
      <div >
        <a href="#">
          <span class="wpsocialarrow-theme15-linkedin hvr-bounce-out"></span>
        </a>
      </div>
    </li>
    <li id="pinteresttheme15">
      <div >
        <a href="#">
          <span class="wpsocialarrow-theme15-pinterest hvr-bounce-out"></span>
        </a>
      </div>
    </li>
  </ul>
</nav>
</div><!--End Container-->
</div>  </div>
<!-- End Includeing Skins Using js -->
</div>
<!-- End All the Plugins Option's Container -->

</div>
</div>
</div>
</div>
</div>
<input id="wpsocialarrow-selected-skin" type="hidden" value="<?php echo get_option("wpsocialarrow-skins"); ?>"/>
<input id="wpsocialarrow-selected-social-network1" name="wpsocialarrow-selcetion-network" type="hidden" value="<?php echo get_option("wpsocialarrow-facebook"); ?>"></input>
<input id="wpsocialarrow-selected-social-network2" name="wpsocialarrow-selcetion-network" type="hidden" value="<?php echo get_option("wpsocialarrow-twitter"); ?>"></input>
<input id="wpsocialarrow-selected-social-network3" name="wpsocialarrow-selcetion-network" type="hidden" value="<?php echo get_option("wpsocialarrow-google"); ?>"></input>
<input id="wpsocialarrow-selected-social-network4" name="wpsocialarrow-selcetion-network" type="hidden" value="<?php echo get_option("wpsocialarrow-linkedin"); ?>"></input>
<input id="wpsocialarrow-selected-social-network5" name="wpsocialarrow-selcetion-network" type="hidden" value="<?php echo get_option("wpsocialarrow-pinterest"); ?>"></input>
<input id="wpsocialarrow-facebook-url" type="hidden" value="http://www.facebook.com/sharer.php?u=" . <?php echo $url; ?> ></input>
<input id="wpsocialarrow-twitter-url" type="hidden" value="https://twitter.com/share?url=". <?php echo $url; ?>></input>
<input id="wpsocialarrow-linkedin-url" type="hidden" value="http://www.linkedin.com/shareArticle?url=". <?php echo $url; ?>></input>
<input id="wpsocialarrow-google-url" type="hidden" value="https://plus.google.com/share?url" . <?php echo $url; ?>></input>
<input id="wpsocialarrow-pinterest-url" type="hidden" value="https://pinterest.com/pin/create/button/?url" .<?php echo $url; ?>></input>
</form>
<?php

}

function wpssi_sanitize_options($value){
  $value = stripslashes($value);
  $value = filter_var($value,FILTER_SANITIZE_STRING);

  return $value;
}
?>