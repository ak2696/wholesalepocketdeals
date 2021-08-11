<?php
/**
 * WordPress User Page
 *
 * Handles authentication, registering, resetting passwords, forgot password,
 * and other user handling.
 *
 * @package WordPress
 */

/** Make sure that the WordPress bootstrap has run before continuing. */
require __DIR__ . '/wp-load.php';
global $wpdb;
$feedID = isset($_REQUEST['feedID']) ? base64_decode($_REQUEST['feedID']) : ''; 

$inv_ratingrivews = $wpdb->prefix . 'inv_ratingrivews';
$postsTbl = $wpdb->prefix . 'posts';
$admin_email = get_option( 'admin_email' ); 
$ratingData = $wpdb->get_results("SELECT * FROM $inv_ratingrivews  WHERE id = $feedID","ARRAY_A"); 

$ratingData = $ratingData[0];
// echo "<pre>";
// print_r($ratingData);
// echo "</pre>";

$average_rating = isset($ratingData['rating']) ? $ratingData['rating'] : '0';

$review_message = isset($ratingData['review_message']) ? $ratingData['review_message'] : '0';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri()?>/assets/css/bootstrap-toggle.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">

    <?php wp_head(); ?>
</head>
<style type="text/css">
.col-md-4 {
    margin: auto;
}
</style>
<section class="sign-in-wrap">
    <div class="container">
        <div class="row">
            <div class="col-6 sign-outer">
                <div class="sign-in-form">
                    <h2><?php
                        if ( function_exists( 'the_custom_logo' ) ) {
                         the_custom_logo();
                        }
                    ?></h2>
                    <?php
                    if($average_rating == ''){
                        ?>
                        <form method="post" action="" id="submitYFeed" enctype="multipart/form-data" class="">
                            <div class="loading" style="display: none;"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/loader.gif" /></div>
                            <p class="message"></p>
                            <div class="content_tab">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="custom_input">
                                            <div class="fixotherroledd">
                                                <label for="userpassword">Give us a rating</label>
                                                <div class="rate availablerate">
                                                    <input type="radio" id="star5" name="rating" value="5" <?php echo ($average_rating >= 5)?'checked="checked"':''; ?>>
                                                    <label for="star5"></label>
                                                    <input type="radio" id="star4" name="rating" value="4" <?php echo ($average_rating >= 4)?'checked="checked"':''; ?>>
                                                    <label for="star4"></label>
                                                    <input type="radio" id="star3" name="rating" value="3" <?php echo ($average_rating >= 3)?'checked="checked"':''; ?>>
                                                    <label for="star3"></label>
                                                    <input type="radio" id="star2" name="rating" value="2" <?php echo ($average_rating >= 2)?'checked="checked"':''; ?>>
                                                    <label for="star2"></label>
                                                    <input type="radio" id="star1" name="rating" value="1" <?php echo ($average_rating >= 1)?'checked="checked"':''; ?>>
                                                    <label for="star1"></label>
                                                </div>
                                            </div>
                                            <div class="fixotherroledd">
                                                <label for="feedmessage">Message</label>
                                                <textarea name="feedmessage" id="feedmessage" required=""><?php echo $review_message['review_message'];?></textarea>
                                            </div>
                                            <input type="hidden" name="action" value="ratingfeedback"
                                                id="ratingfeedback" />
                                            <input type="hidden" name="investor_id" value="<?php echo $feedID;?>"
                                                id="ratingfeedback" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="btn-submit-btn text-center">
                                <input type="submit" name="feedSubmit" id="wp-submit" class="btn btn-primary btn-submit" value="Submit Feedback">
                            </div>
                        </form>
                        <?php
                    }else{
                        echo '<div class="feedbackclient"><p>You are already submit your feedback to us. Thanks</p></div>';
                    }
                    ?>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <div class="btn-submit-btntext-center pt-4">
                                    <a href="<?php echo site_url();?>" id="wp-submitback" class="back_to" style="font-size: 16px;color: #80001f;font-weight: 500;"><i class="fas fa-long-arrow-alt-left pr-1"></i>Back To Website</a>
                                </div>
                            </div>
                            <div class="col-md-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery.validate.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery-ui.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/bootstrap.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/bootstrap-toggle.min.js"></script>

<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery("#submitYFeed").validate({
        rules:{
        	rating:{
        		required: true
        	},
        	feedmessage:{
        		required: true
        	}
        },
        messages:{
        	rating:{
                required: 'Required'
            },
            feedmessage:{
                required: 'Required'
            }
        },
        submitHandler: function(form) {
 			jQuery('.loading').show();
 			var siteurl = '<?php echo site_url();?>';
	        jQuery(".loading").show();
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url();?>admin-ajax.php',
                data: jQuery("#submitYFeed").serialize(),
                success : function(response) {
                    var resp = JSON.parse(response);
                    if(resp.status == 2){
                        jQuery('.loading').hide();
                        toastr.options = {
                          "closeButton": true,
                          "debug": false,
                          "progressBar": true,
                          "positionClass": "toast-top-right",
                          "onclick": null,
                          "showDuration": "80000",
                          "hideDuration": "80000",
                          "timeOut": "80000",
                          "extendedTimeOut": "1000",
                          "showEasing": "linear",
                          "hideEasing": "linear",
                          "showMethod": "fadeIn",
                          "hideMethod": "fadeOut"
                        };
                        toastr.success('Thanks! You have rated '+resp.data+'"');
                    }
                    jQuery(".loading").hide();
                    setTimeout(window.location.reload(),1000);
                }
            });
	        return false;
	    }
    });
});
</script>
<?php //get_footer(); ?>