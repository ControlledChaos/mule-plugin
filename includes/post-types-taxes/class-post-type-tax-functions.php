<?php
/**
 * Functions for post types and taxonomies.
 *
 * @package    Site_Plugin
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
 * Functions for post types and taxonomies.
 *
 * @since  1.0.0
 * @access public
 */
class Post_Type_Tax_Functions {

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

		// Replace "Post" in the update messages.
		add_filter( 'post_updated_messages', [ $this, 'update_messages' ], 99 );

		// Add excerpts to pages for use in meta data.
		add_action( 'init', [ $this, 'page_excerpts' ] );

		// Add "read more" to ellipse in excerpt.
		add_filter( 'the_excerpt', [ $this, 'mule_replace_excerpt' ] );

		// Change screen incidents of Post to News.
		add_action( 'admin_menu', [ $this, 'change_post_label' ] );
		add_action( 'init', [ $this, 'change_post_object' ] );
		add_action( 'admin_menu', [ $this, 'add_news_icon' ] );
		add_filter( 'post_updated_messages', [ $this, 'news_messages' ] );

	}

	/**
	 * Add excerpts to pages for use in meta data
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function page_excerpts() {
		add_post_type_support( 'page', 'excerpt' );
	}

	/**
	 * Add "read more" to ellipse in excerpt
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  string $content Gets the output of the excerpt.
	 * @return string Rturns the modified excerpt.
	 */
	function mule_replace_excerpt( $content ) {

		$read_more = \sprintf(
			'&hellip; <a class="read-more" href="%1s">Read more</a>',
			esc_attr( get_permalink() )
		);

		return str_replace( '[&hellip;]', $read_more, $content );
	}

	/**
	 * Replace "Post" in the update messages for custom post types.
	 *
	 * Example: where the edit screen reads "Post updated" and "View post"
	 * it would read "Project updated" and "View project" for post type Project.
	 *
	 * @since  1.0.0
	 * @access public
	 * @global object post
	 * @global int post_ID
	 * @param array $messages
	 * @return string Returns the text appropriate for each condition.
	 */
	public function update_messages( $messages ) {

		global $post, $post_ID;

		$post_types = get_post_types(
			[
				'show_ui'  => true,
				'_builtin' => false
			],
			'objects' );

		foreach ( $post_types as $post_type => $post_object ) {

			$messages[ $post_type ] = [
				0  => '', /* Unused. Messages start at index 1 */

				1  => sprintf(
					__( '%1s updated. <a href="%2s">View %3s</a>', 'mule-plugin' ), $post_object->labels->singular_name,
					esc_url( get_permalink( $post_ID ) ),
					$post_object->labels->singular_name
				),
				2  => __( 'Custom field updated.', 'mule-plugin' ),
				3  => __( 'Custom field deleted.', 'mule-plugin' ),
				4  => sprintf(
					__( '1%s updated.', 'mule-plugin' ),
					$post_object->labels->singular_name
				),
				5  => isset( $_GET['revision']) ? sprintf(
					__( '%1s restored to revision from %2s', 'mule-plugin' ),
					$post_object->labels->singular_name,
					wp_post_revision_title( (int) $_GET['revision'], false )
					) : false,
				6  => sprintf(
					__( '%1s published. <a href="%2s">View %3s</a>', 'mule-plugin' ),
					$post_object->labels->singular_name,
					esc_url( get_permalink( $post_ID ) ),
					$post_object->labels->singular_name
				),
				7  => sprintf(
					__( '%1s saved.', 'mule-plugin' ),
					$post_object->labels->singular_name
				),
				8  => sprintf(
					__( '%1s submitted. <a target="_blank" href="%2s">Preview %3s</a>', 'mule-plugin' ),
					$post_object->labels->singular_name,
					esc_url( add_query_arg( 'preview', 'true',
					get_permalink( $post_ID ) ) ),
					$post_object->labels->singular_name
				),
				9  => sprintf(
					__( '%1s scheduled for: <strong>%2s</strong>. <a target="_blank" href="%3s">Preview %4s</a>', 'mule-plugin' ),
					$post_object->labels->singular_name,
					date_i18n( __( 'M j, Y @ G:i', 'mule-plugin' ),
					strtotime( $post->post_date ) ),
					esc_url( get_permalink( $post_ID ) ),
					$post_object->labels->singular_name
				),
				10 => sprintf(
					__( '%1s draft updated. <a target="_blank" href="%2s">Preview %3s</a>', 'mule-plugin' ),
					$post_object->labels->singular_name,
					esc_url( add_query_arg( 'preview', 'true',
					get_permalink( $post_ID ) ) ),
					$post_object->labels->singular_name
				),
			];

		}

		return $messages;
	}

	public function change_post_label() {

		// Access global variables.
		global $menu, $submenu;

		$menu[5][0]                 = __( 'MULE News', 'mule-plugin' );
		$submenu['edit.php'][5][0]  = __( 'MULE News', 'mule-plugin' );
		$submenu['edit.php'][10][0] = __( 'Add News', 'mule-plugin' );
		$submenu['edit.php'][16][0] = __( 'News Tags', 'mule-plugin' );

		echo '';

	}

	public function change_post_object() {

		// Access global variables.
		global $wp_post_types;

		$labels                     = $wp_post_types['post']->labels;
		$labels->name               = __( 'MULE News', 'mule-plugin' );
		$labels->singular_name      = __( 'News', 'mule-plugin' );
		$labels->add_new            = __( 'Add News', 'mule-plugin' );
		$labels->add_new_item       = __( 'Add News', 'mule-plugin' );
		$labels->edit_item          = __( 'Edit News Post', 'mule-plugin' );
		$labels->new_item           = __( 'News', 'mule-plugin' );
		$labels->view_item          = __( 'View News Post', 'mule-plugin' );
		$labels->search_items       = __( 'Search news posts', 'mule-plugin' );
		$labels->not_found          = __( 'No news posts found', 'mule-plugin' );
		$labels->not_found_in_trash = __( 'No news posts found in Trash', 'mule-plugin' );
		$labels->screen_items       = __( 'News', 'mule-plugin' );
		$labels->menu_name          = __( 'MULE News', 'mule-plugin' );
		$labels->name_admin_bar     = __( 'News Post', 'mule-plugin' );
	}

	// Change the pin icon to a megaphone.
	public function add_news_icon() {

		// Access global variables.
		global $menu;

		foreach ( $menu as $key => $val ) {

			if ( __( 'MULE News') == $val[0] ) {
				$menu[$key][6] = 'dashicons-megaphone';
			}
		}
	}

	/**
	 * Change post messages
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  array $messages Array of default post messages.
	 * @global object $post Gets the post object.
	 * @global integer $post_ID Gets the post ID.
	 * @return array Returns the array of modified messages.
	 */
	public function news_messages( $messages ) {

		// Access global variables.
		global $post, $post_ID;

		// News post published message.
		$published = sprintf(
			__( 'News published. <a href="%s">View News Post</a>' ),
			esc_url( get_permalink( $post_ID ) )
		);

		// News post updated message.
		$updated = sprintf(
			__( 'News Updated. <a href="%s">View News Post</a>' ),
			esc_url( get_permalink( $post_ID ) )
		);

		// News post submitted message.
		$submitted = sprintf(
			__( 'News submitted. <a target="_blank" href="%s">Preview News Post</a>' ),
			esc_url(
				add_query_arg(
					'preview',
					'true',
					get_permalink( $post_ID )
				)
			)
		);

		// News post scheduled message.
		$scheduled = sprintf(
			__( 'News scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview News Post</a>' ),
			date_i18n( __( 'M j, Y @ G:i' ),
			strtotime( $post->post_date ) ),
			esc_url( get_permalink( $post_ID ) )
		);

		// News post draft updated message.
		$draft_updated = sprintf(
			__( 'News draft updated. <a target="_blank" href="%s">Preview News Post</a>' ),
			esc_url(
				add_query_arg(
					'preview',
					'true',
					get_permalink( $post_ID )
				)
			)
		);

		// News post revision restored message.
		if ( isset( $_GET['revision'] ) ) {
			$restored = sprintf(
				__( 'News post restored to revision from %s' ),
				wp_post_revision_title( (int) $_GET['revision'], false )
			);
		} else {
			$restored = false;
		}

		// Messages start at index 1.
		$messages['post'] = [
			0  => '',
			1  => $updated,
			2  => __( 'Custom field updated.' ),
			3  => __( 'Custom field deleted.' ),
			4  => __( 'News updated.' ),
			5  => $restored,
			6  => $published,
			7  => __( 'News saved.' ),
			8  => $submitted,
			9  => $scheduled,
			10 => $draft_updated,
		];

		// Return the array of modified messages.
		return $messages;
	}

}

/**
 * Put an instance of the class into a function.
 *
 * @since  1.0.0
 * @access public
 * @return object Returns an instance of the class.
 */
function mule_type_taxes_functions() {

	return Post_Type_Tax_Functions::instance();

}

// Run an instance of the class.
mule_type_taxes_functions();