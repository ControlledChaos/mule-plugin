<?php
/**
 * Standard meta tags.
 *
 * @package    Mule_Plugin
 * @subpackage Frontend\Meta_Tags
 * @since      mule 1.0.0
 */

namespace Mule_Plugin\Frontend\Meta_Tags;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} ?>

<!-- Standard meta -->
<meta name="title" content="<?php esc_attr( do_action( 'mule_meta_title_tag' ) ); ?>" />
<?php if ( is_404() ) : ?>
<meta name="description" content="404 <?php esc_attr( _e( 'Not Found', 'mule-plugin' ) ); ?>" />
<?php elseif ( is_singular( 'snippets' ) || is_post_type_archive( 'snippets' ) ) : ?>
<meta name="description" content="<?php esc_attr( _e( 'Conceived as a video journal, these short clips are compiled from 300 hours of raw footage. No image or sound enhancement has been made, and the editing is rudimentary.', 'mule-plugin' ) ); ?>" />
<?php else : ?>
<meta name="description" content="<?php esc_attr( do_action( 'mule_meta_description_tag' ) ); ?>" />
<?php endif; ?>
<?php if ( is_singular() ) : ?>
<meta name="author" content="<?php esc_attr( do_action( 'mule_meta_author_tag' ) ); ?>" />
<?php endif; ?>
<meta name='copyright' content="<?php echo esc_attr( sprintf( '© Copyright %1s %2s. %3s.', get_the_time( 'Y' ), get_bloginfo( 'name' ), __( 'All rights reserved', 'mule-plugin' ) ) ); ?>">
<meta name='language' content="<?php echo esc_attr( get_locale() ); ?>">
