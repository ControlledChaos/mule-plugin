<?php
/**
 * Twitter card meta tags.
 *
 * @package    Mule_Plugin
 * @subpackage Frontend\Meta_Tags
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 *
 * @link       https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/markup.html
 */

namespace Mule_Plugin\Frontend\Meta_Tags;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
} ?>

<!-- Twitter Card meta -->
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:domain" content="<?php echo esc_attr( esc_url( home_url() ) ); ?>">
<meta name="twitter:site" content="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" />
<?php if ( ! is_404() ) : ?>
<meta name="twitter:url" content="<?php esc_attr( esc_url( do_action( 'mule_meta_url_tag' ) ) ); ?>" />
<?php endif; ?>
<meta name="twitter:title" content="<?php esc_attr( do_action( 'mule_meta_title_tag' ) ); ?>" />
<?php if ( is_404() ) : ?>
<meta name="twitter:description" content="404 <?php esc_attr( _e( 'Not Found', 'mule-plugin' ) ); ?>" />
<?php elseif ( is_singular( 'snippets' ) || is_post_type_archive( 'snippets' ) ) : ?>
<meta name="twitter:description" content="<?php esc_attr( _e( 'Conceived as a video journal, these short clips are compiled from 300 hours of raw footage. No image or sound enhancement has been made, and the editing is rudimentary.', 'mule-plugin' ) ); ?>" />
<?php else : ?>
<meta name="twitter:description" content="<?php esc_attr( do_action( 'mule_meta_description_tag' ) ); ?>" />
<?php endif; ?>
<meta name="twitter:image:src" content="<?php esc_attr( do_action( 'mule_meta_image_tag' ) ); ?>" />
