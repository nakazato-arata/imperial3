<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty Twenty One
 *
 * default-max-width or alignwide
 *
 * Fudou TopPage ver5.6.0
 */

get_header();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div id="top_fbox" class="alignwide">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('top_widgets') ) : ?>
		<?php endif; ?>
	</div><!-- #top_fbox -->


</article><!-- #post-${ID} -->
<?php get_footer(); ?>