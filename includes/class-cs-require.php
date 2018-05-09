<?php
/**
 * Composer Sync Require
 *
 * @author      Angus Dowling
 * @package     CS
 * @version     1.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'CS_Require', false ) ) :

/**
 * CS_Require Class.
 */
class CS_Require {

	/**
	 * CS_Require Constructor.
	 */
	public function __construct() {
		$this->init_hooks();
	}

	/**
	 * Hook into actions and filters.
	 * 
	 * @since 1.0.0
	 */
	private function init_hooks() {
		// When plugin is installed
		add_action( 'upgrader_process_complete', array( $this, 'cs_require' ), 9 );

		// When plugin is deleted
		add_action( 'delete_plugin', array( $this, 'cs_remove' ), 9 );
	}

	/**
	 * Get the path of the composer.json file
	 * 
	 * @since 1.0.0
	 */
	private function get_path() {
		$path = rtrim( get_home_path(), '/' );
		$path = explode("/", $path);

		if( end( $path ) == 'web' ) {
			array_pop( $path );
		}

		$path = implode("/" , $path);

		return $path;
	}

	/**
	 * Check if plugin exists in composer file
	 * 
	 * @since 1.0.1
	 */
	private function exists($plugin_name) {
		return is_null ( shell_exec("composer show wpackagist-plugin/{$plugin_name}") );
	}

	/**
	 * Add plugin to composer
	 * 
	 * @since 1.0.0
	 */
	public function cs_require( $args ) {
		$plugin_name = $args->result['destination_name'];

		chdir( $this->get_path() );

		if( $this->exists( $plugin_name ) ) {
			$output = shell_exec("composer require wpackagist-plugin/{$plugin_name}:*");
		}
	}

	/**
	 * Remove plugin from composer
	 * 
	 * @since 1.0.0
	 */
	public function cs_remove( $file ) {
		$plugin_name = explode( "/", $file )[0];

		chdir( $this->get_path() );

		if( $this->exists( $plugin_name ) ) {
			$output = shell_exec("composer remove wpackagist-plugin/{$plugin_name}");
		}

	}

}

endif;

return new CS_Require();