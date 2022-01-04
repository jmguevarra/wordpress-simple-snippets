<?php
/**
 * Snippet Name: WP Login Form
 * Desc: Login form of wordpress.
 * Screenshot: 
 * 
 * Author: Jaime Guevarra Jr.
 * Email: jaimeguevarra22@gmail.com
 */

$redirect_url = get_permalink();
wp_login_form(array('redirect' => $redirect_url ));