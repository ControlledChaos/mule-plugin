<?php
/**
 * Custom content for post types
 *
 * @package    Mule_Plugin
 * @subpackage Includes\Post_Types_Taxes
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Mule_Plugin\Includes\Post_Types_Taxes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Custom content class
 *
 * @since  1.0.0
 * @access public
 */
class Custom_Content {

	/**
	 * Get an instance of the class.
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
			// $instance->dependencies();

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Filter the snippets post type singular content.
		add_filter( 'the_content', [ $this, 'snippets_singular_filter' ], 10, 2 );

		// Filter the snippets post type archive content.
		add_filter( 'the_content', [ $this, 'snippets_archive_filter' ], 10, 2 );

	}

	/**
	 * Filter the snippets post type singular content
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $content
	 * @return mixed Returns the custom HTML output.
	 */
	public function snippets_singular_filter( $content ) {

		// Return the default content if not snippets.
		if ( ! is_singular( 'snippets' ) ) {
			return $content;
		}

		ob_start();

		// Include the snippet content.
		include MULE_PATH . 'includes/post-types-taxes/content/singular-snippets.php';

		$content = ob_get_contents();
		ob_end_clean();
		echo $content;

	}

	/**
	 * Filter the snippets post type archive content
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $content
	 * @return mixed Returns the custom HTML output.
	 */
	public function snippets_archive_filter( $content ) {

		// Return the default content if not snippets.
		if ( ! is_post_type_archive( 'snippets' ) ) {
			return $content;
		}

		ob_start();

		// Include the snippet content.
		include MULE_PATH . 'includes/post-types-taxes/content/archive-snippets.php';

		$content = ob_get_contents();
		ob_end_clean();
		echo $content;

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function mule_custom_content() {

	return Custom_Content::instance();

}

// Run an instance of the class.
mule_custom_content();