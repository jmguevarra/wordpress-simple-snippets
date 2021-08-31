<?php
/*
 * Title: Enqueue Scripts and Styles in Admin/Front End
 *
 * Functions Name:
 * 	- admin_enqueue_scripts = enqueue scripts for admin
 * 	- wp_enqueue_scripts = add script/style file for front end
 *	- wp_enqueue_script = enqueue scripts used both admin/frontend
 *		Arguements:  
 *			id = unique id for the linked file
 *			url = path of the file to enqueue
 *			dep = just add array()
 *			version  = if you have version e.g 1.0.0
 *			in_footer = default is false which is in head. Make it true ig you want to add in footer
 *		
 * Notes:
 * 	- use get_theme_file_uri() if get_template_directory is not working for admin enqueue
 */

add_action('admin_enqueue_scripts', 'adminEnqueueScripts');
function adminEnqueueScripts(){
	//if('edit.php' != $hook){ return } // return if user is editing edit.php (optional)
	wp_enqueue_script('admin-custom', get_theme_file_uri() . '/assets/js/admin-custom-script.js', array(), false, true);
}

