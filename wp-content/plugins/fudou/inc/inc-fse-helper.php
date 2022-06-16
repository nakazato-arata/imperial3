<?php
/**
 * The Fse helper for Fudousan Plugin templates
 *
 * @package WordPress5.9
 * @subpackage Fudousan Plugin
 * Version: 5.9.0
 */


/**
 * Returns the markup for the current template.
 * Base function : get_the_block_template_html()
 * block-template.php
 * ver5.9.0
 */
function fudou_gutenberg_get_the_template_html( $_wp_current_template_content ){

	global $wp_embed;

	$content = $wp_embed->run_shortcode( $_wp_current_template_content );
	$content = $wp_embed->autoembed( $content );
	$content = do_blocks( $content );
	$content = wptexturize( $content );
	$content = wp_filter_content_tags( $content );
	$content = str_replace( ']]>', ']]&gt;', $content );

	return $content;
}

