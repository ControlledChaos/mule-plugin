<?php
/**
 * Register post types.
 *
 * @package    Mule_Plugin
 * @subpackage Includes\Post_Types_Taxes
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 *
 * @link       https://codex.wordpress.org/Function_Reference/register_post_type
 */

namespace Mule_Plugin\Includes\Post_Types_Taxes;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Register post types.
 *
 * @since  1.0.0
 * @access public
 */
final class Post_Types_Register {

    /**
	 * Constructor magic method.
     *
     * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

        // Register snippet types.
		add_action( 'init', [ $this, 'register' ] );

	}

    /**
     * Register snippet types.
     *
     * Note for WordPress 5.0 or greater:
     * If you want your post type to adopt the block edit_form_image_editor
     * rather than using the classic editor then set `show_in_rest` to `true`.
     *
     * @since  1.0.0
	 * @access public
	 * @return void
     */
    public function register() {

        /**
         * Post Type: Snippets
         */

        $labels = [
            'name'                  => __( 'Snippets', 'mule-plugin' ),
            'singular_name'         => __( 'Snippet', 'mule-plugin' ),
            'menu_name'             => __( 'Snippets', 'mule-plugin' ),
            'all_items'             => __( 'All Snippets', 'mule-plugin' ),
            'add_new'               => __( 'Add New', 'mule-plugin' ),
            'add_new_item'          => __( 'Add New Snippet', 'mule-plugin' ),
            'edit_item'             => __( 'Edit Snippet', 'mule-plugin' ),
            'new_item'              => __( 'New Snippet', 'mule-plugin' ),
            'view_item'             => __( 'View Snippet', 'mule-plugin' ),
            'view_items'            => __( 'View Snippets', 'mule-plugin' ),
            'search_items'          => __( 'Search Snippets', 'mule-plugin' ),
            'not_found'             => __( 'No Snippets Found', 'mule-plugin' ),
            'not_found_in_trash'    => __( 'No Snippets Found in Trash', 'mule-plugin' ),
            'parent_item_colon'     => __( 'Parent Snippet', 'mule-plugin' ),
            'featured_image'        => __( 'Featured image for this snippet', 'mule-plugin' ),
            'set_featured_image'    => __( 'Set featured image for this snippet', 'mule-plugin' ),
            'remove_featured_image' => __( 'Remove featured image for this snippet', 'mule-plugin' ),
            'use_featured_image'    => __( 'Use as featured image for this snippet', 'mule-plugin' ),
            'archives'              => __( 'Snippet archives', 'mule-plugin' ),
            'insert_into_item'      => __( 'Insert into Snippet', 'mule-plugin' ),
            'uploaded_to_this_item' => __( 'Uploaded to this Snippet', 'mule-plugin' ),
            'filter_items_list'     => __( 'Filter Snippets', 'mule-plugin' ),
            'items_list_navigation' => __( 'Snippets list navigation', 'mule-plugin' ),
            'items_list'            => __( 'Snippets List', 'mule-plugin' ),
            'attributes'            => __( 'Snippet Attributes', 'mule-plugin' ),
            'parent_item_colon'     => __( 'Parent Snippet', 'mule-plugin' ),
        ];

        // Apply a filter to labels for customization.
        $labels = apply_filters( 'snippets_labels', $labels );

        $options = [
            'label'               => __( 'Snippets', 'mule-plugin' ),
            'labels'              => $labels,
            'description'         => __( 'Custom post type description.', 'mule-plugin' ),
            'public'              => true,
            'publicly_queryable'  => true,
            'show_ui'             => true,
            'show_in_rest'        => false,
            'rest_base'           => 'snippets_rest_api',
            'has_archive'         => true,
            'show_in_menu'        => true,
            'exclude_from_search' => false,
            'capability_type'     => 'post',
            'map_meta_cap'        => true,
            'hierarchical'        => false,
            'rewrite'             => [
                'slug'       => 'snippets',
                'with_front' => true
            ],
            'query_var'           => 'snippets',
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-video-alt',
            'supports'            => [
                'title',
                'editor',
                'thumbnail',
                'excerpt',
                'trackbacks',
                'custom-fields',
                'comments',
                'revisions',
                'author',
                'page-attributes',
                'post-formats'
            ],
            'taxonomies'          => [
                'category',
                'post_tag'
            ],
        ];

        // Apply a filter to arguments for customization.
        $options = apply_filters( 'snippets_args', $options );

        /**
         * Register the post type
         *
         * Maximum 20 characters, cannot contain capital letters or spaces.
         */
        register_post_type(
            'snippets',
            $options
        );

    }

}

// Run the class.
$snippetss = new Post_Types_Register;