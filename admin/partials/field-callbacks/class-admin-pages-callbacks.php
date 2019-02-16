<?php
/**
 * Callbacks for the Admin Pages tab on the Site Settings page.
 *
 * @package    Mule_Plugin
 * @subpackage Admin\Partials\Field_Callbacks
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Mule_Plugin\Admin\Partials\Field_Callbacks;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Callbacks for the Admin Pages tab.
 *
 * @since  1.0.0
 * @access public
 */
class Admin_Pages_Callbacks {

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

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {}

	/**
	 * Restore the TinyMCE editor.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Extra arguments passed into the callback function.
	 * @return string
	 */
	public function classic_editor( $args ) {

		$option = get_option( 'mule_classic_editor' );

		$html = '<p><input type="checkbox" id="mule_classic_editor" name="mule_classic_editor" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="mule_classic_editor"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Use the admin header.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Extra arguments passed into the callback function.
	 * @return string
	 */
	public function admin_header( $args ) {

		$option = get_option( 'mule_use_admin_header' );

		$html = '<p><input type="checkbox" id="mule_use_admin_header" name="mule_use_admin_header" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="mule_use_admin_header"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Use custom drag & drop sort order.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Extra arguments passed into the callback function.
	 * @return string
	 */
	public function custom_sort_order( $args ) {

		$option = get_option( 'mule_use_custom_sort_order' );

		$html = '<p><input type="checkbox" id="mule_use_custom_sort_order" name="mule_use_custom_sort_order" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="mule_use_custom_sort_order"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Admin footer credit.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Extra arguments passed into the callback function.
	 * @return string
	 */
	public function footer_credit( $args ) {

		$option = get_option( 'mule_footer_credit' );

		$html = '<p><input type="text" size="50" id="mule_footer_credit" name="mule_footer_credit" value="' . esc_attr( $option ) . '" placeholder="' . esc_attr( __( 'Your name/agency', 'mule-plugin' ) ) . '" /><br />';

		$html .= '<label for="mule_footer_credit"> ' . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Admin footer link.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Extra arguments passed into the callback function.
	 * @return string
	 */
	public function footer_link( $args ) {

		$option = get_option( 'mule_footer_link' );

		$html = '<p><input type="text" size="50" id="mule_footer_link" name="mule_footer_link" value="' . esc_attr( $option ) . '" placeholder="' . esc_attr( 'http://example.com/' ) . '" /><br />';

		$html .= '<label for="mule_footer_link"> ' . $args[0] . '</label></p>';

		echo $html;

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function mule_admin_pages_callbacks() {

	return Admin_Pages_Callbacks::instance();

}

// Run an instance of the class.
mule_admin_pages_callbacks();