<?php
/**
 * Snippet Name: Populating Dynamic Fields
 * Desc: Populating fields by filtering. Just like adding default value
 * Screenshot: https://prnt.sc/216073i
 * 
 * Author: Jaime Guevarra Jr.
 * Email: jaimeguevarra22@gmail.com
 */

if( !function_exists('gfSourceField') ){ //optional just to check if function exists
	add_filter('gform_field_value_source_url', 'gfSourceField');
	function gfSourceField($value){
		$currentUrl = '';
		if( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ){
			$currentUrl = 'https://';
		}else{
			$currentUrl = 'http://';
		}
					  //hostname				//page
		$currentUrl .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; //full URL
		if( strpos($currentUrl, '?') > 0 ){ //check if there's query string
			$explodedUrl = explode('?', $currentUrl); 
			$currentUrl = $explodedUrl[0];
		}
	
		return $currentUrl;
	}

}