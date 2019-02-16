<?php
/**
 * About page site settings output.
 *
 * Uses the universal slug partial for admin pages. Set this
 * slug in the core plugin file.
 *
 * @package    Controlled_Chaos_Plugin
 * @subpackage Admin\Partials
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

namespace Mule_Plugin\Admin\Partials;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} ?>
<h3><?php _e( 'Website settings', 'mule-plugin' ); ?></h3>
<?php echo sprintf(
	'<p>%1s <a href="%2s">%3s</a> %4s</p>',
	__( 'The plugin is equipped with', 'mule-plugin' ),
	esc_url( admin_url( '?page=' . MULE_ADMIN_SLUG . '-settings' ) ),
	__( 'an admin page', 'mule-plugin' ),
	__( 'for customizing the user interface of WordPress/ClassicPress, as well as other useful features.', 'mule-plugin' )
 ); ?>
<h3><?php _e( 'Clean Up the Admin', 'mule-plugin' ); ?></h3>
<ul>
	<li><?php _e( 'Remove dashboard widgets: WordPress/ClassicPress news, quick press', 'mule-plugin' ); ?></li>
	<li><?php _e( 'Make Menus and Widgets top level menu items', 'mule-plugin' ); ?></li>
	<li><?php _e( 'Remove select admin menu items', 'mule-plugin' ); ?></li>
	<li><?php _e( 'Remove WordPress/ClassicPress logo from admin bar', 'mule-plugin' ); ?></li>
	<li><?php _e( 'Remove access to theme and plugin editors', 'mule-plugin' ); ?></li>
</ul>
<h3><?php _e( 'Enchance the Admin', 'mule-plugin' ); ?></h3>
<ul>
	<li><?php _e( 'Add three admin bar menus', 'mule-plugin' ); ?></li>
	<li><?php _e( 'Add custom post types to the At a Glance widget', 'mule-plugin' ); ?></li>
	<li><?php _e( 'Custom admin footer message', 'mule-plugin' ); ?></li>
</ul>