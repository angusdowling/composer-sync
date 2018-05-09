<?php
/**
 * Plugin Name: Composer Sync
 * Description: Sync composer requirements with installing plugins via the CMS
 * Version: 1.0.1
 * Author: Angus Dowling
 *
 * Text Domain: composer-sync
 *
 * @package CS
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define CS_PLUGIN_FILE.
if ( ! defined( 'CS_PLUGIN_FILE' ) ) {
	define( 'CS_PLUGIN_FILE', __FILE__ );
}

// Include the main CS class.
if ( ! class_exists( 'CS' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-cs.php';
}

/**
 * Main instance of CS.
 *
 * Returns the main instance of CS to prevent the need to use globals.
 *
 * @return CS
 */
function CS() {
	return CS::instance();
}

// Global for backwards compatibility.
$GLOBALS['CS'] = CS();
