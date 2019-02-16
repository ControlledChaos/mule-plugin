<?php
/**
 * Settings fields for script loading and more.
 *
 * @package    Mule_Plugin
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Mule_Plugin\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Settings fields for script loading and more.
 *
 * @since  1.0.0
 * @access public
 */
class Settings_Fields_Scripts {

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

		// Register settings.
		add_action( 'admin_init', [ $this, 'settings' ] );

		// Include jQuery Migrate.
		$migrate = get_option( 'mule_jquery_migrate' );
		if ( ! $migrate ) {
			add_action( 'wp_default_scripts', [ $this, 'include_jquery_migrate' ] );
		}

	}

	/**
	 * Register settings via the WordPress/ClassicPress Settings API.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings() {

		/**
		 * Generl script options.
		 */
		add_settings_section( 'mule-scripts-general', __( 'General Options', 'mule-plugin' ), [ $this, 'scripts_general_section_callback' ], 'mule-scripts-general' );

		// Inline scripts.
		add_settings_field( 'mule_inline_scripts', __( 'Inline Scripts', 'mule-plugin' ), [ $this, 'mule_inline_scripts_callback' ], 'mule-scripts-general', 'mule-scripts-general', [ esc_html__( 'Add script contents to footer', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-general',
			'mule_inline_scripts'
		);

		// Inline styles.
		add_settings_field( 'mule_inline_styles', __( 'Inline Styles', 'mule-plugin' ), [ $this, 'mule_inline_styles_callback' ], 'mule-scripts-general', 'mule-scripts-general', [ esc_html__( 'Add script-related CSS contents to head', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-general',
			'mule_inline_styles'
		);

		// Inline jQuery.
		add_settings_field( 'mule_inline_jquery', __( 'Inline jQuery', 'mule-plugin' ), [ $this, 'mule_inline_jquery_callback' ], 'mule-scripts-general', 'mule-scripts-general', [ esc_html__( 'Deregister jQuery and add its contents to footer', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-general',
			'mule_inline_jquery'
		);

		// Include jQuery Migrate.
		add_settings_field( 'mule_jquery_migrate', __( 'jQuery Migrate', 'mule-plugin' ), [ $this, 'mule_jquery_migrate_callback' ], 'mule-scripts-general', 'mule-scripts-general', [ esc_html__( 'Use jQuery Migrate for backwards compatibility', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-general',
			'mule_jquery_migrate'
		);

		// Remove emoji script.
		add_settings_field( 'mule_remove_emoji_script', __( 'Emoji Script', 'mule-plugin' ), [ $this, 'remove_emoji_script_callback' ], 'mule-scripts-general', 'mule-scripts-general', [ esc_html__( 'Remove emoji script from <head>', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-general',
			'mule_remove_emoji_script'
		);

		// Remove WordPress/ClassicPress version appended to script links.
		add_settings_field( 'mule_remove_script_version', __( 'Script Versions', 'mule-plugin' ), [ $this, 'remove_script_version_callback' ], 'mule-scripts-general', 'mule-scripts-general', [ esc_html__( 'Remove WordPress/ClassicPress version from script and stylesheet links in <head>', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-general',
			'mule_remove_script_version'
		);

		/**
		 * Use included vendor scripts & options.
		 */
		add_settings_section( 'mule-scripts-vendor', __( 'Included Vendor Scripts', 'mule-plugin' ), [ $this, 'scripts_vendor_section_callback' ], 'mule-scripts-vendor' );

		// Use Slick.
		add_settings_field( 'mule_enqueue_slick', __( 'Slick', 'mule-plugin' ), [ $this, 'enqueue_slick_callback' ], 'mule-scripts-vendor', 'mule-scripts-vendor', [ esc_html__( 'Use Slick script and stylesheets', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-vendor',
			'mule_enqueue_slick'
		);

		// Use Tabslet.
		add_settings_field( 'mule_enqueue_tabslet', __( 'Tabslet', 'mule-plugin' ), [ $this, 'enqueue_tabslet_callback' ], 'mule-scripts-vendor', 'mule-scripts-vendor', [ esc_html__( 'Use Tabslet script', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-vendor',
			'mule_enqueue_tabslet'
		);

		// Use Sticky-kit.
		add_settings_field( 'mule_enqueue_stickykit', __( 'Sticky-kit', 'mule-plugin' ), [ $this, 'enqueue_stickykit_callback' ], 'mule-scripts-vendor', 'mule-scripts-vendor', [ esc_html__( 'Use Sticky-kit script', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-vendor',
			'mule_enqueue_stickykit'
		);

		/**
		 * Use Tooltipster.
		 *
		 * @todo Add option to enqueue on the backend.
		 */
		add_settings_field( 'mule_enqueue_tooltipster', __( 'Tooltipster', 'mule-plugin' ), [ $this, 'enqueue_tooltipster_callback' ], 'mule-scripts-vendor', 'mule-scripts-vendor', [ esc_html__( 'Use Tooltipster script and stylesheet', 'mule-plugin' ) ] );

		register_setting(
			'mule-scripts-vendor',
			'mule_enqueue_tooltipster'
		);

		// Site Settings section.
		if ( mule_acf_options() ) {

			add_settings_section( 'mule-registered-fields-activate', __( 'Registered Fields Activation', 'mule-plugin' ), [ $this, 'registered_fields_activate' ], 'mule-registered-fields-activate' );

			add_settings_field( 'mule_acf_activate_settings_page', __( 'Site Settings Page', 'mule-plugin' ), [ $this, 'registered_fields_page_callback' ], 'mule-registered-fields-activate', 'mule-registered-fields-activate', [ __( 'Deactive the field group for the "Site Settings" options page.', 'mule-plugin' ) ] );

			register_setting(
				'mule-registered-fields-activate',
				'mule_acf_activate_settings_page'
			);

		}

	}

	/**
	 * General section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function scripts_general_section_callback( $args ) {

		$html = sprintf( '<p>%1s</p>', esc_html__( 'Inline settings only apply to scripts and styles included with the plugin.' ) );

		echo $html;

	}

	/**
	 * Inline jQuery.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function mule_inline_jquery_callback( $args ) {

		$option = get_option( 'mule_inline_jquery' );

		$html = '<p><input type="checkbox" id="mule_inline_jquery" name="mule_inline_jquery" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="mule_inline_jquery"> '  . $args[0] . '</label><br />';

		$html .= '<small><em>This may break the functionality of plugins that put scripts in the head</em>.</small></p>';

		echo $html;

	}

	/**
	 * Include jQuery Migrate.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function mule_jquery_migrate_callback( $args ) {

		$option = get_option( 'mule_jquery_migrate' );

		$html = '<p><input type="checkbox" id="mule_jquery_migrate" name="mule_jquery_migrate" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="mule_jquery_migrate"> '  . $args[0] . '</label><br />';

		$html .= '<small><em>Some outdated plugins and themes may be dependent on an old version of jQuery</em></small></p>';

		echo $html;

	}

	/**
	 * Inline scripts.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function mule_inline_scripts_callback( $args ) {

		$option = get_option( 'mule_inline_scripts' );

		$html = '<p><input type="checkbox" id="mule_inline_scripts" name="mule_inline_scripts" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="mule_inline_scripts"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Inline styles.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function mule_inline_styles_callback( $args ) {

		$option = get_option( 'mule_inline_styles' );

		$html = '<p><input type="checkbox" id="mule_inline_styles" name="mule_inline_styles" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="mule_inline_styles"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Remove emoji script.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function remove_emoji_script_callback( $args ) {

		$option = get_option( 'mule_remove_emoji_script' );

		$html = '<p><input type="checkbox" id="mule_remove_emoji_script" name="mule_remove_emoji_script" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="mule_remove_emoji_script"> '  . $args[0] . '</label><br />';

		$html .= '<small><em>Emojis will still work in modern browsers</em></small></p>';

		echo $html;

	}

	/**
	 * Script options and enqueue settings.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function remove_script_version_callback( $args ) {

		$option = get_option( 'mule_remove_script_version' );

		$html = '<p><input type="checkbox" id="mule_remove_script_version" name="mule_remove_script_version" value="1" ' . checked( 1, $option, false ) . '/>';

		$html .= '<label for="mule_remove_script_version"> '  . $args[0] . '</label></p>';

		echo $html;

	}

	/**
	 * Vendor section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function scripts_vendor_section_callback( $args ) {

		$html = sprintf( '<p>%1s</p>', esc_html__( 'Look for Fancybox options on the Media Settings page.' ) );

		echo $html;

	}

	/**
	 * Use Slick.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_slick_callback( $args ) {

		$option = get_option( 'mule_enqueue_slick' );

		$html = '<p><input type="checkbox" id="mule_enqueue_slick" name="mule_enqueue_slick" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="mule_enqueue_slick"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://kenwheeler.github.io/slick/' ) ),
			esc_attr( __( 'Learn more about Slick', 'mule-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Use Tabslet.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_tabslet_callback( $args ) {

		$option = get_option( 'mule_enqueue_tabslet' );

		$html = '<p><input type="checkbox" id="mule_enqueue_tabslet" name="mule_enqueue_tabslet" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="mule_enqueue_tabslet"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://vdw.github.io/Tabslet/' ) ),
			esc_attr( __( 'Learn more about Tabslet', 'mule-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Use Sticky-kit.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_stickykit_callback( $args ) {

		$option = get_option( 'mule_enqueue_stickykit' );

		$html = '<p><input type="checkbox" id="mule_enqueue_stickykit" name="mule_enqueue_stickykit" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="mule_enqueue_stickykit"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://leafo.net/sticky-kit/' ) ),
			esc_attr( __( 'Learn more about Sticky-kit', 'mule-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Use Tooltipster.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function enqueue_tooltipster_callback( $args ) {

		$option = get_option( 'mule_enqueue_tooltipster' );

		$html = '<p><input type="checkbox" id="mule_enqueue_tooltipster" name="mule_enqueue_tooltipster" value="1" ' . checked( 1, $option, false ) . '/>';
		$html .= sprintf(
			'<label for="mule_enqueue_tooltipster"> %1s</label> <a href="%2s" target="_blank" class="tooltip" title="%3s"><span class="dashicons dashicons-editor-help"></span></a>',
			$args[0],
			esc_attr( esc_url( 'http://iamceege.github.io/tooltipster/' ) ),
			esc_attr( __( 'Learn more about Tooltipster', 'mule-plugin' ) )
		);
		$html .= '</p>';

		echo $html;

	}

	/**
	 * Site Settings section.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function registered_fields_activate() {

		if ( mule_acf_options() ) {

			echo sprintf( '<p>%1s</p>', esc_html( 'The Mule plugin registers custom fields for Advanced Custom Fields Pro that can be imported for editing. These built-in field goups must be deactivated for the imported field groups to take effect.', 'mule-plugin' ) );

		}

	}

	/**
	 * Site Settings section callback.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function registered_fields_page_callback( $args ) {

		if ( mule_acf_options() ) {

			$html = '<p><input type="checkbox" id="mule_acf_activate_settings_page" name="mule_acf_activate_settings_page" value="1" ' . checked( 1, get_option( 'mule_acf_activate_settings_page' ), false ) . '/>';

			$html .= '<label for="mule_acf_activate_settings_page"> '  . $args[0] . '</label></p>';

			echo $html;

		}

	}

	/**
	 * Include jQuery Migrate.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
    public function include_jquery_migrate( $scripts ) {

		if ( ! empty( $scripts->registered['jquery'] ) ) {

			$scripts->registered['jquery']->deps = array_diff( $scripts->registered['jquery']->deps, [ 'jquery-migrate' ] );

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
function mule_settings_fields_scripts() {

	return Settings_Fields_Scripts::instance();

}

// Run an instance of the class.
mule_settings_fields_scripts();