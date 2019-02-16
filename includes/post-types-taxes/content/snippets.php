<?php
/**
 * Snippets post type content
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
		<p><?php _e( '"MULE: Living on the Outside" is a personal independent documentary, not a commercially financed venture commissioned by a media company. If you would like to be a part of getting the film completed, please consider making a tax-deductible donation.' ); ?></p>
		<h3 class="video-snippet-donate"><a href="<?php echo get_permalink( get_page_by_path( 'support' ) ) ?>"><?php _e( 'Support the Film', 'mule-plugin' ); ?></a></h3>
	</div>
	<p class="video-snippet-disclaimer"><small><?php _e( 'NOTE: John Sears and the 3 Mules are not participating, working or in association in any fundraising, marketing or production of this movie, nor will they receive any financial benefit from the sale of this movie.  This is his decision.  It would go against his core personal values to do so.' ); ?></small></p>
</div>