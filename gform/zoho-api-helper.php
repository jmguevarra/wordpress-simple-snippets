<?php 
/**
 * Filename: Zoho API Helper
 * 
 */ 
function getTempZohoToken(){
	$accessToken = "";
	$result = file_get_contents(get_stylesheet_directory(). '/js/zoho-token-temp.json');
	$decodedResult = json_decode($result, true);
	if($decodedResult["access_token"] != ""){
		$accessToken = $decodedResult["access_token"];
	}
	return $accessToken;
}

function updateTempZohoToken($newToken, $isSuccess){
	$filePath = get_stylesheet_directory(). '/js/zoho-token-temp.json';
	$result = file_get_contents($filePath);
	$decodedResult = json_decode($result, true);
	if($isSuccess){
		$decodedResult["error"] = false;
		$decodedResult["success"] = true;
		$decodedResult["access_token"] = $newToken;
	}else{
		$decodedResult["error"] = true;
		$decodedResult["success"] = false;
		$decodedResult["access_token"] = "";
	}
	
	$newTempToken = json_encode($decodedResult);
	//Save the file.
	file_put_contents($filePath, $newTempToken);
}

/** Double-Opt in All Gravity Form */
//Token Generation from refresable token
function getNewAccessToken(){
	$newToken = '';
	$endpoint = "https://accounts.zoho.com/oauth/v2/token";
	$params = array(
		"refresh_token"	=>	"1000.2de87e3f7abcf5436bb27b44f765126a.710ec02956ed0d7e8372314b82719382",
		"client_id"		=>	"1000.HJNJIVHRQGMRB1TJPT9WPJOZDILU7B",
		"client_secret"	=>	"9f3d763a094868767927979b8c6828b5240476773e",
		"grant_type"	=>	"refresh_token"
	);	
	$curl = curl_init($endpoint);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
	curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$resp = curl_exec($curl);
	$resultStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	
	$result = json_decode($resp,true);
	if($resultStatus == 200){
		$newToken = $result["access_token"];
	}
	return $newToken;
}
function addNewContactInList($token, $email){
	$createSubsEnpoint = 'https://campaigns.zoho.com/api/v1.1/addlistsubscribersinbulk';
	$params = array(
		"listkey"		=> "3z52d11ca14e64924c13852fad44aecf8ee6fb33c970c0bd378b7dd99cfe2bd0e0",
		"resfmt"		=> "JSON",
		"emailids"		=>	$email
	);
	$headers = array(
		"Authorization: Zoho-oauthtoken ".$token,
		"Content-Type: application/x-www-form-urlencoded"
	);

	$curl = curl_init($createSubsEnpoint);
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$resp = curl_exec($curl);
	curl_close($curl);
	
	return $resp;
}

add_action( 'gform_pre_submission', 'leeDoubleOpt_ZohoCampaign' );
function leeDoubleOpt_ZohoCampaign($form){
	$hasEmailField = false;
	$wantToSubscribe = false;
	$email = '';
	foreach ( $form['fields'] as $field ) {
		if($field->type == "email"){
			$email = $_POST['input_'.$field->id];
			if(!empty($email)){
				$hasEmailField = true;
			}
		}
		$fieldClass = strpos($field->cssClass, "lee-subscriber");
		if(!empty($field->cssClass) && $fieldClass !== false){
			$checkbox_field = GFAPI::get_field( $form, $field->id );
			$values = $checkbox_field->get_value_submission( array() );
			$isChecked = array_values($values);
			if($isChecked[0]){
				$wantToSubscribe = true;
			}
		}
	}
	
	
	if($hasEmailField && $wantToSubscribe){	
		//send with invalid token
		$callback = addNewContactInList(getTempZohoToken(), $email);
		$result = json_decode($callback, true);

		if($result["status"] == "error" && $result["Code"] == "1007"){ //generate token and resend
			$newToken = getNewAccessToken();
			if($newToken != ''){
				updateTempZohoToken($newToken, true); //update temp data from json file and get it by getTempZohoToken
				$resendResult = addNewContactInList(getTempZohoToken(), $email); //it must send else it has error
			}else{
				updateTempZohoToken("", false);
			}
 		}
	}
}
/** End of Double Opt */