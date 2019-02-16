<?php
/**
 * Backend search form template.
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
}

$label       = apply_filters( 'mule_search_label', esc_html__( 'Search for:', 'mule-plugin' ) );
$placeholder = apply_filters( 'mule_search_placeholder', esc_attr( esc_html__( 'Search ', 'mule-plugin' ) . get_bloginfo( 'name' ) ) );
$submit      = apply_filters( 'mule_search_submit', esc_html__( 'Submit', 'mule-plugin' ) );
?>
<form class="search-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="search-label">
        <span class="screen-reader-text"><?php echo $label; ?></span>
        <input type="search" class="search" id="search" name="s" value="" placeholder="<?php echo $placeholder; ?>" />
    </label>
    <input type="submit" value="<?php echo $submit; ?>" class="search-submit" id="search-submit" />
</form>
