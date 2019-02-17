<?php
/**
 * Snippets post type singular content
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
	$vimeo = null;
} else {
	$vimeo = $vimeo_data->video_id;
}

$description = get_field( 'snippet_description' );
?>
<div class="video-snippet">
	<div class="video-snippet-description">
		<?php echo $description ?>
	</div>
	<div class="video-snippet-embed">
		<iframe src="https://player.vimeo.com/video/<?php echo $vimeo; ?>?color=3c5ea2&title=0&byline=0&portrait=0" width="1280" height="720" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
	</div>
	<div class="video-snippet-project-info">
		<p><?php the_field( 'snippet_support_message', 'option' ); ?></p>
		<h3 class="video-snippet-donate"><a href="<?php echo get_permalink( get_page_by_path( 'support' ) ) ?>"><?php _e( 'Support the Film', 'mule-plugin' ); ?></a></h3>
		<p class="video-snippet-disclaimer"><small><?php the_field( 'snippet_disclaimer_message', 'option' ); ?></small></p>
	</div>
</div>