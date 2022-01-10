<?php
/**
 * Snippet Name: Customizer API
 * Des: add and modify some theme setting with customizer api of wordpress
 * 
 */

 add_action('customize_register', '_themename_customize_register');

 function _themename_customize_register($customize){
     $customize->add_setting();
 }