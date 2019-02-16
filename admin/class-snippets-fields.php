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

		if( function_exists('acf_add_local_field_group') ):

			acf_add_local_field_group(array(
				'key' => 'group_5c6834a0ed384',
				'title' => 'Snippets',
				'fields' => array(
					array(
						'key' => 'field_5c6834eeb05d6',
						'label' => 'Vimeo Link',
						'name' => 'snippet_vimeo_link',
						'type' => 'url',
						'instructions' => 'Enter the simple URL of the Vimeo page. Do not use the embed code, the video will be embedded by the Mule plugin.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'placeholder' => '',
					),
					array(
						'key' => 'field_5c68357b378bf',
						'label' => 'Video Description',
						'name' => 'snippet_description',
						'type' => 'wysiwyg',
						'instructions' => 'Enter only a description. Links to the Vimeo channel and the donation page, etc., are handled by the Snippets Menu in the menus page, accessed at left.',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 0,
						'delay' => 0,
					),
				),
				'location' => array(
					array(
						array(
							'param' => 'post_type',
							'operator' => '==',
							'value' => 'snippets',
						),
					),
				),
				'menu_order' => 0,
				'position' => 'acf_after_title',
				'style' => 'seamless',
				'label_placement' => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen' => array(
					0 => 'the_content',
					1 => 'discussion',
					2 => 'comments',
					3 => 'revisions',
					4 => 'slug',
					5 => 'author',
					6 => 'format',
					7 => 'send-trackbacks',
				),
				'active' => true,
				'description' => '',
			));

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