<?php
/**
 * Debugging Options
 * 
 * Notes:
 *  - if you encounter const WP_DEBUG.. etc is already defined in function.php. You need to find the defined variable or add it in wp_config.php instead
 */

// Enable WP_DEBUG mode
define('WP_DEBUG', true);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings
define( 'WP_DEBUG_DISPLAY', false );

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define( 'SCRIPT_DEBUG', false );