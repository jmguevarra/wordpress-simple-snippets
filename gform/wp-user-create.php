<?php 
/**
 * Snippet Name: Add WP User from gravity form details
 * Descriptions: Upon pre submission of the form there's a validation and wp user creation as subscriber on this code.
 * Date Created: 09-08-2022
 * 
 */

//Validation
add_filter( 'gform_validation_122', 'leeSubs_Validation' );
function leeSubs_Validation( $validation_result ) {
    $form = $validation_result['form'];
	
	if( email_exists($_POST['input_5']) ){ //email validation
		 $validation_result['is_valid'] = false;
		 foreach( $form['fields'] as &$field ) {
 
            if ( $field->id == '5' ) {
                $field->failed_validation = true;
                $field->validation_message = 'Email already is already registered!';
                break;
            }
        }
	}
	
    //Assign modified $form object back to the validation result
    $validation_result['form'] = $form;
    return $validation_result;
}
//Subscriber Creation
add_action( 'gform_pre_submission_122', 'leeAddSubscriber' );
function leeAddSubscriber($form){
	$subscriberInfo = array(
		'first_name'	=> 	$_POST['input_3'],
		'last_name'		=> 	$_POST['input_4'],
		'user_email'	=> 	$_POST['input_5'],
		'user_login'	=> 	$_POST['input_6'],
		'user_pass'		=> 	$_POST['input_9_2'],
		'role'			=>  'subscriber',
		'display_name'	=>	$_POST['input_3']. ' ' . $_POST['input_4']
	);
	
	wp_insert_user($subscriberInfo);
}
/*End of Subscriber Creation*/