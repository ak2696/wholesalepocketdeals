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
$userid = isset($_REQUEST['userid']) ? $_REQUEST['userid'] : ''; 
global $wpdb;
$userTBL = $wpdb->prefix . "users";
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
				    <form method="post" action="" id="lostpasswordFrm" enctype="multipart/form-data" class="">
				    	<div class="loading" style="display: none;"><img src="<?php echo get_stylesheet_directory_uri();?>/assets/images/loader.gif" /></div>
				    	<p class="message"></p>
				    	<div class="content_tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="custom_input">
                                    	<?php
                                    	$user = get_user_by( 'id', $userid );
                                    	// echo "<pre>";
                                    	$user_email = $user->data->user_email;
                                    	$role = $user->roles[0];
                                    	?>
                                    	<div class="fixotherrole">
                                            <label for="user_loginemail">Email</label>
                                            <input type="email" name="user_loginemail" id="user_loginemail" value="<?php echo $user_email;?>" readonly>
                                        </div>
                                        <?php
                                        $getlogins = $wpdb->get_results("SELECT * FROM $userTBL WHERE user_email='".$user_email."'",ARRAY_A);
                                    	// echo "<pre>";
                                    	// print_r($getlogins);
                                    	// echo "</pre>";
                                    	if(!empty($getlogins)){
                                    		if($role !== 'administrator'){
                                    			?>
	                                    		<div class="custom_input">
					                                <label for="loginsuser">Users Login</label>
					                                <select name="loginsuser" class="" id="loginsuser" placeholder="">
					                                    <option value="">Select A Users</option>
					                                    <?php foreach($getlogins as $usersALl){ echo '<option value="'.$usersALl['ID'].'">'.$usersALl['user_login'].'</option>'; } ?>
					                                </select>
					                                <small>Please select user type in which you want to change password</small>
					                            </div>
	                                    		<?php
                                    		}else{
                                    			?>
	                                    		<input type="hidden" name="loginsuser" id="loginsuser" value="<?php echo $user->data->ID;?>">
	                                    		<?php
                                    		}
                                    	}
                                    	?>
                                        <div class="fixotherrole">
                                            <label for="userpassword">Password</label>
                                            <input type="password" name="userpassword" id="userpassword" required="">
                                        </div>
                                        <div class="fixotherrole">
                                            <label for="cpassword">
                                            Confirm Password</label>
                                            <input type="password" name="cpassword" id="cpassword" required="">
                                        </div>
                                        <!-- Only for admin -->
                                            <input type="hidden" name="redirect_to" value="<?php echo $redirect ?>">
                                        <input type="hidden" name="action" value="resetpasswordaction"
                                            id="resetpasswordaction" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-submit-btn text-center">
                            <input type="submit" name="wpsubmitreset" id="wp-submit" class="btn btn-primary btn-submit" value="Reset Password">
                        </div>
				    </form>
                </div>
                <div class="container">
                    <div class="btn-submit-btntext-center pt-4 text-center">
                        <a href="<?php echo site_url();?>" id="wp-submitback" class="back_to" style="font-size: 16px;color: #80001f;font-weight: 500;"><i class="fas fa-long-arrow-alt-left pr-1"></i>Home Page</a>
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
    jQuery("#lostpasswordFrm").validate({
        rules:{
        	loginsuser:{
        		required: true
        	},
        	password:{
        		required: true
        	},
        	cpassword:{
        		required: true,
        		equalTo: "#userpassword"
        	}
        },
        messages:{
        	loginsuser:{
        		required: 'Please select user type in which you want to change password'
        	},
        	password:{
        		required: 'Password is required'
        	},
        	cpassword:{
        		required: 'Password is required',
        		equalTo: "Confirm password is not match with password"
        	}
        },
        submitHandler: function(form) {
 			jQuery('.loading').show();
 			var siteurl = '<?php echo site_url();?>';
	        jQuery.ajax({
	            url: "<?php echo admin_url();?>admin-ajax.php", 
	            type: "POST",             
	            data: jQuery("#lostpasswordFrm").serialize(),
	            success: function(responce) {
	            	jQuery('.loading').hide();
	            	var responceA = JSON.parse(responce);
	            	var msg = responceA.message;
	            	var status = responceA.status;
	            	if(status == 'success'){
	            		jQuery(".message").css('color','green');
		            	jQuery('.loading').hide();
		                jQuery(".message").html(msg);
		                setTimeout("window.location='"+siteurl+"'",1000);
	            	}else{
	            		jQuery('.loading').hide();
	            		jQuery(".message").css('color','red');
		                jQuery(".message").html(msg);
	            	}
	            }
	        });
	        return false;
	    }
    });
});
</script>
<?php //get_footer(); ?>