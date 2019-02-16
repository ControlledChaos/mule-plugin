<?php
/**
 * Settings fields for site development.
 *
 * @package    Controlled_Chaos_Plugin
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 *
 * @todo       Add a "Dev Mode", functionality to be determined.
 * @todo       Finish converting the debug plugin to work with a setting.
 */

namespace Mule_Plugin\Plugin_Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Settings fields for site development.
 *
 * @since  1.0.0
 * @access public
 */
class Settings_Fields_Dev_Tools {

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
	public function __construct() {

		// Start settings for page.
		add_action( 'admin_init', [ $this, 'dev_settings' ] );

	}

	/**
	 * Settings for the development page.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function dev_settings() {

		/**
		 * Site development.
		 */

		// Site development settings section.
		add_settings_section(
			'mule-site-development-general',
			__( 'General Website Development', 'mule-plugin' ),
			[ $this, 'site_development_section_callback' ],
			'mule-site-development-general'
		);

		// Site development settings field.
		add_settings_field(
			'mule_site_development',
			__( 'Debug Mode', 'mule-plugin' ),
			[ $this, 'mule_site_development_callback' ],
			'mule-site-development-general',
			'mule-site-development-general',
			[ esc_html__( 'Put the site in Debug Mode via wp-config.', 'mule-plugin' ) ]
		);

		// Register the Site development field.
		register_setting(
			'mule-site-development-general',
			'mule_site_development'
		);

		// Live theme test settings field.
		add_settings_field(
			'mule_theme_test',
			__( 'Live Theme Test', 'mule-plugin' ),
			[ $this, 'mule_theme_test_callback' ],
			'mule-site-development-general',
			'mule-site-development-general',
			[ esc_html__( 'Find the theme test page under Appearances.', 'mule-plugin' ) ]
		);

		// Register the live theme test field.
		register_setting(
			'mule-site-development-general',
			'mule_theme_test'
		);

		// Customizer reset settings field.
		add_settings_field(
			'mule_customizer_reset',
			__( 'Customizer Reset', 'mule-plugin' ),
			[ $this, 'mule_customizer_reset_callback' ],
			'mule-site-development-general',
			'mule-site-development-general',
			[ esc_html__( 'Add a reset button to the Customizer for getting a fresh start.', 'mule-plugin' ) ]
		);

		// Register the Customizer reset field.
		register_setting(
			'mule-site-development-general',
			'mule_customizer_reset'
		);

		// Database reset settings field.
		add_settings_field(
			'mule_database_reset',
			__( 'Database Reset', 'mule-plugin' ),
			[ $this, 'mule_database_reset_callback' ],
			'mule-site-development-general',
			'mule-site-development-general',
			[ esc_html__( 'Add a tool to reset select tables or all of the database.', 'mule-plugin' ) ]
		);

		// Register the database reset field.
		register_setting(
			'mule-site-development-general',
			'mule_database_reset'
		);

		// RTL (right to left) test settings field.
		add_settings_field(
			'mule_rtl_test',
			__( 'RTL (Right to Left) Test', 'mule-plugin' ),
			[ $this, 'mule_rtl_test_callback' ],
			'mule-site-development-general',
			'mule-site-development-general',
			[ esc_html__( 'Add RTL button to the toolbar to test layout in languages that read right to left.', 'mule-plugin' ) ]
		);

		// Register the RTL test field.
		register_setting(
			'mule-site-development-general',
			'mule_rtl_test'
		);

	}

	/**
	 * Site development section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Holds the settings section array.
	 * @return string Returns the section HTML.
	 */
	public function site_development_section_callback( $args ) {

		$html = sprintf(
			'<p>%1s</p>',
			esc_html__( '', 'mule-plugin' )
		);

		echo $html;

	}

	/**
	 * Site development field callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Holds the settings field array.
	 * @return string Returns the field HTML.
	 */
	public function mule_site_development_callback( $args ) {

		$option = get_option( 'mule_site_development' );

		$html   = '<p><input type="checkbox" id="mule_site_development" name="mule_site_development" value="1" ' . checked( 1, $option, false ) . '/>';
		$html  .= '<label for="mule_site_development"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Live theme test field callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Holds the settings field array.
	 * @return string Returns the field HTML.
	 */
	public function mule_theme_test_callback( $args ) {

		$option = get_option( 'mule_theme_test' );

		$html   = '<p><input type="checkbox" id="mule_theme_test" name="mule_theme_test" value="1" ' . checked( 1, $option, false ) . '/>';
		$html  .= sprintf(
			'<label for="mule_theme_test">%1s</label></p>',
			$args[0]
		 );

		echo $html;

	}

	/**
	 * Customizer reset field callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Holds the settings field array.
	 * @return string Returns the field HTML.
	 */
	public function mule_customizer_reset_callback( $args ) {

		$option = get_option( 'mule_customizer_reset' );

		$html   = '<p><input type="checkbox" id="mule_customizer_reset" name="mule_customizer_reset" value="1" ' . checked( 1, $option, false ) . '/>';
		$html  .= sprintf(
			'<label for="mule_customizer_reset">%1s</label></p>',
			$args[0]
		 );

		echo $html;

	}

	/**
	 * Database reset field callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Holds the settings field array.
	 * @return string Returns the field HTML.
	 */
	public function mule_database_reset_callback( $args ) {

		$option = get_option( 'mule_database_reset' );

		$html   = '<p><input type="checkbox" id="mule_database_reset" name="mule_database_reset" value="1" ' . checked( 1, $option, false ) . '/>';
		$html  .= sprintf(
			'<label for="mule_database_reset">%1s</label></p>',
			$args[0]
		 );

		echo $html;

	}

	/**
	 * RTL test field callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $args Holds the settings field array.
	 * @return string Returns the field HTML.
	 */
	public function mule_rtl_test_callback( $args ) {

		$option = get_option( 'mule_rtl_test' );

		$html   = '<p><input type="checkbox" id="mule_rtl_test" name="mule_rtl_test" value="1" ' . checked( 1, $option, false ) . '/>';
		$html  .= sprintf(
			'<label for="mule_rtl_test">%1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a></p>',
			$args[0],
			esc_url( 'https://codex.wordpress.org/Right_to_Left_Language_Support' ),
			__( 'Read more in the WordPress Codex (also applies to ClassicPress)', 'mule-plugin' )
		 );

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
function mule_settings_fields_dev_tools() {

	return Settings_Fields_Dev_Tools::instance();

}

// Run an instance of the class.
mule_settings_fields_dev_tools();