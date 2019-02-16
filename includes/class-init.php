<?php
/**
 * The core plugin class
 *
 * @package    Mule_Plugin
 * @subpackage Includes
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Mule_Plugin\Includes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Get plugins path to check for active plugins.
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Define the core functionality of the plugin.
 *
 * @since  1.0.0
 * @access public
 */
final class Init {

	/**
	 * Instance of the class
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object Returns the instance.
	 */
	public static function instance() {

		// Varialbe for the instance to be used outside the class.
		static $instance = null;

		if ( is_null( $instance ) ) {

			// Set variable for new instance.
			$instance = new self;

			// Get class dependencies.
			$instance->dependencies();

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access private
	 * @return self
	 */
	private function __construct() {

		// Remove the Draconian capital P filter.
		remove_filter( 'the_title', 'capital_P_dangit', 11 );
		remove_filter( 'the_content', 'capital_P_dangit', 11 );
		remove_filter( 'comment_text', 'capital_P_dangit', 31 );

		// Load classes to extend plugins.
		add_action( 'init', [ $this, 'plugin_support' ] );

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		// Translation functionality.
		require_once MULE_PATH . 'includes/class-i18n.php';

		// Admin/backend functionality, scripts and styles.
		require_once MULE_PATH . 'admin/class-admin.php';

		// Frontend functionality, scripts and styles.
		require_once MULE_PATH . 'frontend/class-frontend.php';

		// Various media and media library functionality.
		require_once MULE_PATH . 'includes/media/class-media.php';

		/**
		 * Register custom editor blocks.
		 *
		 * @todo Remove conditional statement when Gutenberg is in core?
		 */
		if ( mule_acf_pro() ) {
			$editor = get_field( 'mule_classic_editor', 'option' );
		} else {
			$editor = get_option( 'mule_classic_editor' );
		}
		if ( ( mule_classicpress() || mule_new_cms() ) && ! $editor || is_plugin_active( 'gutenberg/gutenberg.php' ) ) {
			require_once MULE_PATH . 'includes/editor-blocks/class-register-block-types.php';
		}

		// Post types and taxonomies.
		require_once MULE_PATH . 'includes/post-types-taxes/class-post-type-tax.php';

		// User funtionality.
		require_once MULE_PATH . 'includes/users/class-users.php';

		// Dev and maintenance tools.
		require_once MULE_PATH . 'includes/tools/class-tools.php';

	}

	/**
	 * Load classes to extend plugins.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function plugin_support() {

		// Add Advanced Custom Fields Support.
		if ( mule_acf() ) {
			include_once MULE_PATH . 'includes/acf/class-extend-acf.php';
		}

		// Add Beaver Builder support.
		if ( class_exists( 'FLBuilder' ) ) {
			include_once MULE_PATH . 'includes/beaver/class-beaver-builder.php';
		}

		// Add Elementor support.
		if ( class_exists( '\Elementor\Plugin' ) ) {
			include_once MULE_PATH . 'includes/elementor/class-elementor.php';
		}

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function mule_init() {

	return Init::instance();

}

// Run an instance of the class.
mule_init();