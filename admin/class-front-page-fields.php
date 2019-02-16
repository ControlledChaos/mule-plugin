<?php
/**
 * Front page field groups
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
final class Front_Page_Fields {

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

			acf_add_local_field_group( [
				'key'    => 'group_5475df5568c6b',
				'title'  => 'Front Page',
				'fields' => [
					[
						'key'               => 'field_58d2b65b5edcf',
						'label'             => __( 'Intro Image', 'mule-pligin' ),
						'name'              => 'intro_image',
						'type'              => 'image',
						'instructions'      => __( '', 'mule-pligin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'return_format'     => 'id',
						'preview_size'      => 'medium',
						'library'           => 'all',
						'min_width'         => 2048,
						'min_height'        => '',
						'min_size'          => '',
						'max_width'         => '',
						'max_height'        => '',
						'max_size'          => '',
						'mime_types'        => '',
					],
					[
						'key'               => 'field_58dbeebe65c62',
						'label'             => __( 'Tagline', 'mule-pligin' ),
						'name'              => 'mule_tagline',
						'type'              => 'text',
						'instructions'      => __( '', 'mule-pligin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
					[
						'key'               => 'field_58dbf5c3b9b29',
						'label'             => __( 'Tagline Background Image', 'mule-pligin' ),
						'name'              => 'mule_tagline_image',
						'type'              => 'image',
						'instructions'      => __( '', 'mule-pligin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'return_format'     => 'id',
						'preview_size'      => 'medium',
						'library'           => 'all',
						'min_width'         => 2048,
						'min_height'        => '',
						'min_size'          => '',
						'max_width'         => '',
						'max_height'        => '',
						'max_size'          => '',
						'mime_types'        => '',
					],
					[
						'key'               => 'field_5475df8fc8223',
						'label'             => __( 'Featured Video', 'mule-pligin' ),
						'name'              => 'featured_video',
						'type'              => 'text',
						'instructions'      => __( 'Paste in the embed code from Vimeo or YouTube.', 'mule-pligin' ),
						'required'          => 1,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => '<iframe src="//player.vimeo.com/video/XXXXXXXX></iframe>',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
						'readonly'          => 0,
						'disabled'          => 0,
					],
					[
						'key'               => 'field_5475e2360641b',
						'label'             => __( 'Featured Video Title', 'mule-pligin' ),
						'name'              => 'featured_video_title',
						'type'              => 'text',
						'instructions'      => __( '', 'mule-pligin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
					[
						'key'               => 'field_58dec646d5f2f',
						'label'             => __( 'Donate Button', 'mule-pligin' ),
						'name'              => 'mule_donate_button',
						'type'              => 'text',
						'instructions'      => __( '', 'mule-pligin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => __( 'Support the Film', 'mule-pligin' ),
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
					[
						'key'               => 'field_58dc1ecfcf0ed',
						'label'             => __( 'Donate Message', 'mule-pligin' ),
						'name'              => 'mule_donate_message',
						'type'              => 'text',
						'instructions'      => __( '', 'mule-pligin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => '',
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
					[
						'key'               => 'field_58dc29d528e78',
						'label'             => __( 'Add News/Blog Link', 'mule-pligin' ),
						'name'              => 'mule_add_blog_link',
						'type'              => 'true_false',
						'instructions'      => __( '', 'mule-pligin' ),
						'required'          => 0,
						'conditional_logic' => 0,
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'message'           => __( 'Check to add the News/Blog link to the bottom of the content.', 'mule-pligin' ),
						'default_value'     => 1,
						'ui'                => 0,
						'ui_on_text'        => '',
						'ui_off_text'       => '',
					],
					[
						'key'               => 'field_58dc2a3928e79',
						'label'             => __( 'News/Blog Link Text', 'mule-pligin' ),
						'name'              => 'mule_blog_link_text',
						'type'              => 'text',
						'instructions'      => __( '', 'mule-pligin' ),
						'required'          => 0,
						'conditional_logic' => [
							[
								[
									'field'    => 'field_58dc29d528e78',
									'operator' => '==',
									'value'    => '1',
								],
							],
						],
						'wrapper'           => [
							'width' => '',
							'class' => '',
							'id'    => '',
						],
						'default_value'     => '',
						'placeholder'       => __( 'Catch up on news & events', 'mule-pligin' ),
						'prepend'           => '',
						'append'            => '',
						'maxlength'         => '',
					],
				],
				'location' => [
					[
						[
							'param'    => 'page_type',
							'operator' => '==',
							'value'    => 'front_page',
						],
					],
				],
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'seamless',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'hide_on_screen'        => [
					0  => 'permalink',
					1  => 'the_content',
					2  => 'custom_fields',
					3  => 'discussion',
					4  => 'comments',
					5  => 'revisions',
					6  => 'slug',
					7  => 'author',
					8  => 'categories',
					9  => 'tags',
					10 => 'send-trackbacks',
				],
				'active'      => true,
				'description' => '',
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
function mule_front_page_fields() {

	return Front_Page_Fields::instance();

}

// Run an instance of the class.
mule_front_page_fields();