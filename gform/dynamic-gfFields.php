<?php 
/**
 * Snippet Name: Dynamic EMC Details
 * Descriptions: dynamic displays of EMC info for leadingedgeenergy.com.au for there Letter of Authority Form Notifications.
 * Date Created: 04-10-2022
 * 
 */


/** EMC Gravity Forn Dynamic Notification */
function extractReferrer(){
	$referredBy = '';
	$query = $_SERVER['QUERY_STRING'];
	if( empty($query) || strpos($query, 'referred_by') === false ){ return; }

	//filtering
	$queries = explode('&', $query); 
	foreach($queries as $query){
		$exQuery = explode('=', $query);
		if( in_array('referred_by', $exQuery) ){
			$referredBy =  $exQuery[1];
			break;
		}
	}

	return $referredBy;
}
function gfEmcDetails($info="name"){
	$emcs = [
		"ben_wallington" => [
			"name" => "Ben Wallington",
			"phone" => "+61412676114",
			"email" => "b.wallington@leadingedgeenergy.com.au",
			"position" => "Energy Management Consultant"
		],
		"ewen_beard" => [
			"name" => "Ewan Beard",
			"phone" => "+61481345181",
			"email" => "e.beard@leadingedgeenergy.com.au",
			"position" => "Energy Management Consultant"
		],
		"milad_samiee" => [
			"name" => "Milad Samiee",
			"phone" => "+61451767706",
			"email" => "m.samiee@leadingedgeenergy.com.au",
			"position" => "Energy Management Consultant"
		],
	];
	
	return $emcs[extractReferrer()][$info]; 
}

add_filter('gform_field_value_emc_name', function($value){ return  $value  = gfEmcDetails("name");});
add_filter('gform_field_value_emc_phone', function($value){ return  $value  = gfEmcDetails("phone");});
add_filter('gform_field_value_emc_email', function($value){ return  $value  = gfEmcDetails("email");});
add_filter('gform_field_value_emc_position', function($value){ return  $value  = gfEmcDetails("position");});
/** End EMC Gravity Forn Dynamic Notification */