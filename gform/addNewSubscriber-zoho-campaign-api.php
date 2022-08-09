<?php 
/**
 * Snippet Name: Add new list subscriber 
 * Descriptions: Using Zoho Campaign API. It adds new subscriber to its list contact module upon pre-submission in gravityform
 * Notes: It's Http Request not working in Gravity form gform_after_submission
 * Date Created: 09-08-2022
 * 
 */


/** Double-Opt in All Gravity Form */
//add_action( 'gform_pre_submission', 'leeDoubleOpt_ZohoCampaign' );
function leeDoubleOpt_ZohoCampaign($form){
	$hasEmailField = false;
	$email = '';
	foreach ( $form['fields'] as $field ) {
		if($field->type == "email"){
			$email = $_POST['input_'.$field->id];
			if(!empty($email)){
				$hasEmailField = true;
			}
			break;
		}
	}
	
	if($hasEmailField){
		$obj_id = get_queried_object_id();
		$current_url = get_permalink( $obj_id );
	
		$createSubsEnpoint = 'https://campaigns.zoho.com/api/v1.1/json/listsubscribe';
		$params = "listkey=3z52d11ca14e64924c13852fad44aecf8ee6fb33c970c0bd378b7dd99cfe2bd0e0&resfmt=JSON&sources=".$current_url."&contactinfo={Contact Email:".$email."}";
		$headers = array(
			"Authorization: Zoho-oauthtoken 1000.cc581d19840019c03aff652bf464393e.98840cfcbfbad48d7651786ad7ca303e",
			"Content-Type: application/x-www-form-urlencoded"
		);
		
		$curl = curl_init($createSubsEnpoint);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$resp = curl_exec($curl);
		curl_close($curl);
	}	
}
/** End of Double Opt */