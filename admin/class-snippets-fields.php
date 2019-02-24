<?php
/**
 * Snippets post type field groups
 *
 * @package    Mule_Plugin
 * @subpackage mule\admin
 * @since      1.0.0
 */

namespace Mule_Plugin\Admin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Site settings page field groups.
 */
final class Snippets_Fields {

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

			// Register settings page fields.
    		$instance->settings_fields();

		}

		// Return the instance.
		return $instance;

	}

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void Constructor method is empty.
	 *              Change to `self` if used.
	 */
	public function __construct() {}

	/**
	 * Register settings page fields
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function settings_fields() {

		if ( function_exists( 'acf_add_local_field_group' ) ) :

			/**
			 * Snippets post type
			 *
			 * For adding and editing singular snippets.
			 */
			acf_add_local_field_group( [
				'key'    => 'group_5c6834a0ed384',
				'title'  => 'Snippets',
				'fields' => [
					[
						'key'               => 'field_5c6834eeb05d6',
						'label'             => __( 'Vimeo Link', 'mule-plugin' ),
						'name'              => 'snippet_vimeo_link',
						'type'              => 'url',
						'instructions'      => __( 'Enter the simple URL of the Vimeo page. Do not use the embed code, the video will be embedded by the Mule plugin. Example: https://vimeo.com/288832100', 'mule-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => 'https://vimeo.com/288832100',
					],
					[
						'key'               => 'field_5c68357b378bf',
						'label'             => __( 'Video Description', 'mule-plugin' ),
						'name'              => 'snippet_description',
						'type'              => 'wysiwyg',
						'instructions'      => __( 'Enter only a description. Other content on the page can be edited on the Snippets Settings, accessed at left.', 'mule-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'tabs'              => 'all',
						'toolbar'           => 'full',
						'media_upload'      => 0,
						'delay'             => 0,
					],
				],
				'location' => [
					[
						[
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'snippets',
						],
					],
				],
				'menu_order'            => 0,
				'position'              => 'acf_after_title',
				'style'                 => 'seamless',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => [
					0 => 'the_content',
					1 => 'discussion',
					2 => 'comments',
					3 => 'revisions',
					4 => 'slug',
					5 => 'author',
					6 => 'format',
					7 => 'send-trackbacks',
				],
				'active'      => true,
				'description' => '',
				] );

			/**
			 * Snippets options page
			 *
			 * For the options page in the snippets sub menu.
			 */
			acf_add_local_field_group( [
				'key'    => 'group_5c68c94b93d62',
				'title'  => __( 'Snippets Settings', 'mule-plugin' ),
				'fields' => [
					[
						'key'               => 'field_5c69c68c65a0f',
						'label'             => __( 'Snippets Introduction', 'mule-plugin' ),
						'name'              => 'snippets_archive_intro',
						'type'              => 'textarea',
						'instructions'      => __( 'Displays above the video grid on the snippets archive pages. Paragraphs added automatically with space between lines.', 'mule-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => __( '', 'mule-plugin' ),
						'placeholder'       => __( '', 'mule-plugin' ),
						'maxlength'         => '',
						'rows'              => 6,
						'new_lines'         => 'wpautop',
					],
					[
						'key'               => 'field_5c68cb8f2d429',
						'label'             => __( 'Support Message', 'mule-plugin' ),
						'name'              => 'snippet_support_message',
						'type'              => 'textarea',
						'instructions'      => __( 'A brief message about donating to the project. Appears below the embedded video and above the support link button. Paragraphs added automatically with space between lines.', 'mule-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => __( '', 'mule-plugin' ),
						'placeholder'       => __( '', 'mule-plugin' ),
						'maxlength'         => '',
						'rows'              => 6,
						'new_lines'         => 'wpautop',
					],
					[
						'key'               => 'field_5c68cc1c10a96',
						'label'             => __( 'Disclaimer Message', 'mule-plugin' ),
						'name'              => 'snippet_disclaimer_message',
						'type'              => 'textarea',
						'instructions'      => __( 'A brief footnote about the project. Appears below the support link button.', 'mule-plugin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => __( '', 'mule-plugin' ),
						'placeholder'       => __( '', 'mule-plugin' ),
						'maxlength'         => '',
						'rows'              => 6,
						'new_lines'         => '',
					],
				],
				'location' => [
					[
						[
							'param'    => 'options_page',
							'operator' => '==',
							'value'    => 'acf-options-snippets-settings',
						],
					],
				],
				'menu_order'            => 0,
				'position'              => 'acf_after_title',
				'style'                 => 'seamless',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => '',
				'active'                => true,
				'description'           => '',
			] );

		endif;

	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function mule_snippets_fields() {

	return Snippets_Fields::instance();

}

// Run an instance of the class.
mule_snippets_fields();