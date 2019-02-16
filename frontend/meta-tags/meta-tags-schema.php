<?php
/**
 * Schema meta tags.
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

<!-- Schema meta -->
<meta itemprop="url" content="<?php do_action( 'mule_meta_url_tag' ); ?>" />
<meta itemprop="name" content="<?php do_action( 'mule_meta_title_tag' ); ?>" />
<?php if ( is_404() ) : ?>
<meta itemprop="description" content="404 <?php esc_attr( _e( 'Not Found' ) ); ?>" />
<?php elseif ( is_singular( 'snippets' ) ) : ?>
<meta itemprop="description" content="<?php esc_attr( _e( 'Video Snippet' ) ); ?>" />
<?php else : ?>
<meta itemprop="description" content="<?php esc_attr( do_action( 'mule_meta_description_tag' ) ); ?>" />
<?php endif; ?>
<meta itemprop="author" content="<?php do_action( 'mule_meta_author_tag' ); ?>" />
<meta itemprop="datePublished" content="<?php do_action( 'mule_meta_date_pub_tag' ); ?>" />
<meta itemprop="dateModified" content="<?php do_action( 'mule_meta_date_mod_tag' ); ?>" />
<meta itemprop="image" content="<?php do_action( 'mule_meta_image_tag' ); ?>" />
