<?php
/**
 * CS setup
 *
 * @package  CS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main CS Class.
 *
 * @class CS
 */
final class CS {

	/**
	 * CS version.
	 *
	 * @var string
	 */
	public $version = '1.0.1';

	/**
	 * The single instance of the class.
	 *
	 * @var CS
	 */
	protected static $_instance = null;

	/**
	 * Main CS Instance.
	 *
	 * Ensures only one instance of CS is loaded or can be loaded.
	 *
	 * @static
	 * @see CS()
	 * @return CS - Main instance.
	 * 
	 * @since 1.0.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * CS Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();

		do_action( 'cs_loaded' );
	}

	/**
	 * Define CS Constants.
	 * 
	 * @since 1.0.0
	 */
	private function define_constants() {
		$this->define( 'CS_ABSPATH', dirname( CS_PLUGIN_FILE ) . '/' );
		$this->define( 'CS_VERSION', $this->version );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 * 
	 * @since 1.0.0
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 * 
	 * @since 1.0.0
	 */
	public function includes() {
		include_once CS_ABSPATH . 'includes/class-cs-require.php';
	}

	/**
	 * Get the plugin url.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', CS_PLUGIN_FILE ) );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( CS_PLUGIN_FILE ) );
	}

}