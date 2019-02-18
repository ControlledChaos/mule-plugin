<?php
/**
 * Snippets post type archive content
 *
 * @package    Mule_Plugin
 * @subpackage Includes\Post_Types_Taxes
 *
 * @since      1.0.0
 * @author     Greg Sweet <greg@ccdzine.com>
 */

/**
 * Fields registered by Advanced Custom Fields
 *
 * @since  1.0.0
 */

if ( ! class_exists( 'acf' ) ) {
	return;
}

$get_vimeo   = get_field( 'snippet_vimeo_link' );
$vimeo_data  = json_decode( file_get_contents( 'http://vimeo.com/api/oembed.json?url=' . $get_vimeo ) );

if ( ! $vimeo_data ) {
	$vimeo_img = null;
} else {
	$vimeo_img = $vimeo_data->thumbnail_url;
}

$description = get_field( 'snippet_description' );
?>
<li>
	<figure>
		<a href="<?php the_permalink(); ?>"><img src="<?php echo $vimeo_img ?>" alt="<?php the_title(); ?>" /></a>
		<figcaption><?php the_title(); ?></figcaption>
	</figure>
</li>