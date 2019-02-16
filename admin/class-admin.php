<?php
/**
 * Admin functiontionality and settings.
 *
 * @package    Mule_Plugin
 * @subpackage Admin
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 *
 * @todo       Add admin and user access checks.
 */

namespace Mule_Plugin\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Admin functiontionality and settings.
 *
 * @since  1.0.0
 * @access public
 */
class Admin {

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

			// Require the class files.
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

		// Remove theme & plugin editor links.
		add_action( 'admin_init', [ $this, 'remove_editor_links' ] );

		// Redirect theme & plugin editor pages.
		add_action( 'admin_init', [ $this, 'redirect_editor_pages' ] );

		// Remove the WordPress/ClassicPress logo from the admin bar.
		add_action( 'admin_bar_menu', [ $this, 'remove_wp_logo' ], 999 );

		// Remove search from frontend admin toolbar.
		add_action( 'wp_before_admin_bar_render', [ $this, 'adminbar_search' ] );

		// Hide the WordPress/ClassicPress update notification to all but admins.
		add_action( 'admin_head', [ $this, 'admin_only_updates' ], 1 );

		// Credits in admin footer.
		add_filter( 'admin_footer_text', [ $this, 'admin_footer' ], 1 );

		/**
		 * Backend search form template.
		 *
		 * The necessity for this came from a search widget in the custom welcome
		 * panel with the Twenty Seventeen theme activated. The SVG used in the
		 * theme template does not display. So the thought here is to use a basic
		 * form as a reset.
		 *
		 * Filters have also been applied for changing placeholder and button text.
		 *
		 * @since 1.0.0
		 */
		add_filter( 'get_search_form', [ $this, 'search_form' ] );

		// Enqueue the stylesheets for the admin area.
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );

		// Enqueue the JavaScript for the admin area.
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

		// Register nav menus.
		add_action( 'after_setup_theme', [ $this, 'nav_menus' ], 11 );

	}

	/**
	 * Class dependency files.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function dependencies() {

		// The core settings class for the plugin.
		require_once MULE_PATH . 'admin/class-settings.php';

		// Add icons to the titles of ACF tab and accordion fields, if active.
		if ( mule_acf_pro() && ! get_option( 'mule_acf_activate_settings_page' ) ) {
			include_once MULE_PATH . 'admin/class-acf-tab-icons.php';
		}

		// Include custom fields for Advanced Custom Fields Pro, if active.
		if ( mule_acf_pro() ) {
			include_once MULE_PATH . 'admin/class-settings-fields-site-acf.php';
		}

		// Field group for the front page.
		require_once MULE_PATH . 'admin/class-front-page-fields.php';

		// Field group for the snippets post type.
		require_once MULE_PATH . 'admin/class-snippets-fields.php';

		// Functions for dasboard widgets, excluding the welcome panel.
		require_once MULE_PATH . 'admin/dashboard/class-dashboard.php';

		// Functions for admin menu item positions and visibility.
		require_once MULE_PATH . 'admin/class-admin-menu.php';

		// Add menus to the admin toolbar.
		require_once MULE_PATH . 'admin/class-admin-toolbar-menus.php';

		// Functions for various admin pages and edit screens.
		require_once MULE_PATH . 'admin/class-admin-pages.php';

		// Filter by page template.
		require_once MULE_PATH . 'admin/class-admin-template-filter.php';

	}

	/**
     * Remove theme & plugin editor links.
     *
     * @since  1.0.0
	 * @access public
	 * @return array
     */
    public function remove_editor_links() {

		$remove_theme_editor  = remove_submenu_page( 'themes.php', 'theme-editor.php' );
		$remove_plugin_editor = remove_submenu_page( 'plugins.php', 'plugin-editor.php' );

		return array( $remove_theme_editor, $remove_plugin_editor );

	}

	/**
	 * Redirect theme & plugin editor pages.
	 *
	 * A temporary redirect to the dashboard is created.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object pagenow Gets the current admin screen.
	 * @return void
	 */
	public function redirect_editor_pages() {

		global $pagenow;

		// Redirect if user is on the theme or plugin editor page.
		if ( $pagenow == 'plugin-editor.php' || $pagenow == 'theme-editor.php' ) {
			wp_redirect( admin_url( '/', 'http' ), 302 );
			exit;
		}

	}

	/**
	 * Remove the WordPress/ClassicPress logo from the admin bar.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object $wp_admin_bar
	 * @return void
	 *
	 * @todo Make this optional on the Site Settings screen.
	 */
	public function remove_wp_logo( $wp_admin_bar ) {

		$wp_admin_bar->remove_node( 'wp-logo' );

	}

	/**
	 * Remove the search bar from the frontend admin toolbar.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object wp_admin_bar
	 * @return void
	 *
	 * @todo Make this optional on the Site Settings screen.
	 */
	public function adminbar_search() {

		global $wp_admin_bar;

		$wp_admin_bar->remove_menu( 'search' );

	}

	/**
	 * Hide the WordPress/ClassicPress update notification to all but admins.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 *
	 * @todo Make this optional on the Site Settings screen.
	 */
	public function admin_only_updates() {

		// The `update_core` capability includes admins and super admins.
		if ( ! current_user_can( 'update_core' ) ) {
			remove_action( 'admin_notices', 'update_nag', 3 );
		}

	}

	/**
	 * Developer credits in the admin footer text.
	 *
	 * Give yourself credit for your work and provide your clients
	 * with a link to your site.
	 *
	 * Replaces the "Thank you for creating with WordPress/ClassicPress" text
	 * in the #wpfooter div at the bottom of all admin screens.
	 *
	 * The output strings contain a trailing space after the period
	 * because other plugins may also tap into the footer. a high
	 * priority is used on the hook in attempt to put our text first.
	 *
	 * This replaces text inside the default paragraph (<<p>>) tags.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return string
	 */
	public function admin_footer() {

		// Get the name of the site from Settings > General.
		$site = get_bloginfo( 'name' );

		/**
		 * Default message by CMS.
		 *
		 * The default message vaies whether WordPress or ClassicPress is used.
		 *
		 * @since  1.0.0
		 */

		// If the site is running ClassicPress.
		if ( mule_classicpress() ) {
			$default = __( 'website powered by ClassicPress', 'mule-plugin' );

		// If the site is running WordPress.
		} else {
			$default = __( 'website powered by WordPress', 'mule-plugin' );
		}

		/**
		 * If the Advanced Custom Fields Pro plugin is active then
		 * we use the input from the fields on the ACF options page.
		 *
		 * @since  1.0.0
		 */
		if ( mule_acf_options() ) {

			/**
			 * Get the fields registered by this plugin. An additional parameter
			 * of 'option' must be included to target the options page.
			 */
			$credit = get_field( 'mule_admin_footer_credit', 'option' );
			$link   = get_field( 'mule_admin_footer_link', 'option' );

			// If a name and a URL are provided.
			if ( $credit && $link ) {
				$footer = sprintf(
					'%1s %2s <a href="%3s" target="_blank">%4s</a>. ',
					$site,
					esc_html__( 'website designed & developed by', 'mule-plugin' ),
					esc_url( $link ),
					$credit
				);
			// If only a name is provided.
			} elseif ( $credit ) {
				$footer = sprintf(
					'%1s %2s %3s. ',
					$site,
					esc_html__( 'website designed & developed by', 'mule-plugin' ),
					$credit
				);
			// If no input we use the name of the site.
			} else {
				$footer = sprintf(
					'%1s %2s. ',
					$site,
					esc_html__( $default )
				);
			}

		/**
		 * If the Advanced Custom Fields Pro plugin is not active then
		 * we use the input from the fields on the WordPress/ClassicPress options page.
		 *
		 * @since  1.0.0
		 */
		} else {

			$credit = sanitize_text_field( get_option( 'mule_footer_credit' ) );
			$link   = esc_url_raw( get_option( 'mule_footer_link' ) );

			// If a name and a URL are provided.
			if ( $credit && $link ) {
				$footer = sprintf(
					'%1s %2s <a href="%3s" target="_blank">%4s</a>. ',
					$site,
					esc_html__( 'website designed & developed by', 'mule-plugin' ),
					esc_url( $link ),
					$credit
				);
			// If only a name is provided.
			} elseif ( $credit ) {
				$footer = sprintf(
					'%1s %2s %3s. ',
					$site,
					esc_html__( 'website designed & developed by', 'mule-plugin' ),
					$credit
				);
			// If no input we use the name of the site.
			} else {
				$footer = sprintf(
					'%1s %2s. ',
					$site,
					esc_html__( $default )
				);
			}

		}

		// Apply a filter for unforseen possibilities.
		$admin_footer = apply_filters( 'mule_admin_footer', $footer );

		// Echo the string.
		echo $admin_footer;

	}

	/**
	 * Enqueue the stylesheets for the admin area.
	 *
	 * Uses the universal slug partial for admin pages. Set this
     * slug in the core plugin file.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_styles() {

		/**
		 * Enqueue the general backend styles.
		 *
		 * Included are just a few style rules for features added by this plugin.
		 *
		 * @since 1.0.0
		 */
		wp_enqueue_style( MULE_ADMIN_SLUG . '-admin', MULE_URL . 'admin/assets/css/admin.min.css', [], MULE_VERSION, 'all' );

		/**
		 * Enqueue the jQuery tooltips styles.
		 *
		 * These are the default styles from jQuery. Design the as you see fir
		 * to jive with your backend styles.
		 *
		 * For more control over tooltips, replace jQuery tooltips with Tooltipster,
		 * which is included with this plugin.
		 *
		 * @since 1.0.0
		 */
		wp_enqueue_style( MULE_ADMIN_SLUG . '-tooltips', MULE_URL . 'admin/assets/css/tooltips.min.css', [], MULE_VERSION, 'all' );

		/**
		 * Enqueue Advanced Custom Fields styles.
		 *
		 * Only if the free or pro version of the plugin is active.
		 *
		 * @since 1.0.0
		 */
		if ( mule_acf() ) {
			wp_enqueue_style( MULE_ADMIN_SLUG . '-acf', MULE_URL . 'admin/assets/css/acf.css', [], MULE_VERSION, 'all' );
		}

		/**
		 * Enqueue the custom welcome panel styles.
		 *
		 * Will only enqueue if the option is selected to use the panel.
		 *
		 * @since 1.0.0
		 */
		$welcome = get_option( 'mule_custom_welcome' );
		if ( $welcome ) {
			wp_enqueue_style( MULE_ADMIN_SLUG . '-welcome', MULE_URL . 'admin/assets/css/welcome.css', [], MULE_VERSION, 'all' );
		}

	}

	/**
	 * Get the backend search form template.
	 *
	 * @since  1.0.0
	 * @return mixed Returns the HTML of the search form.
	 */
	public function get_search_form() {

		// Bail if not in admin.
		if ( ! is_admin() ) {
			return;
		}

		ob_start();

		require MULE_PATH . 'admin/partials/searchform.php';

		$form = ob_get_clean();

		return $form;

	}

	/**
	 * Output the backend search form.
	 *
	 * @since  1.0.0
	 * @param  mixed $form
	 * @return mixed Returns the HTML of the search form.
	 */
	public function search_form( $form ) {

		// Bail if not in admin.
		if ( ! is_admin() ) {
			return;
		}

		// Get the HTML of the form.
		$form = $this->get_search_form();

		return $form;

	}

	/**
	 * Enqueue the JavaScript for the admin area.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_scripts() {

		// Enqueue jQuery tabs from WordPress/ClassicPress.
		wp_enqueue_script( 'jquery-ui-tabs' );

		/**
		 * Enqueue jQuery tooltips from WordPress/ClassicPress.
		 *
		 * For more control over tooltips, replace jQuery tooltips with Tooltipster,
		 * which is included with this plugin.
		 *
		 * @todo Conditionally enqueue this depending on backend Tooltipster.
		 */
		wp_enqueue_script( 'jquery-ui-tooltip' );

		// Enqueue Conditionalize for conditional form fields.
		wp_enqueue_script( MULE_ADMIN_SLUG . '-conditionalize', MULE_URL . 'admin/assets/js/admin.js', [ 'jquery' ], MULE_VERSION, true );

		// Enqueue scripts for backend functionality of this plugin.
		wp_enqueue_script( MULE_ADMIN_SLUG . '-admin', MULE_URL . 'admin/assets/js/conditionize.flexible.jquery.min.js', [ 'jquery' ], MULE_VERSION, true );

	}

	/**
	 * Register nav menus
	 *
	 * For menus that correspond with post content handled
	 * by this plugin, avoid errors if the theme is swiched.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function nav_menus() {

		// For snippets post type pages.
		register_nav_menus( [ 'snippets' => __( 'Snippets Menu', 'mule-theme' ) ] );

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function mule_admin() {

	return Admin::instance();

}

// Run an instance of the class.
mule_admin();