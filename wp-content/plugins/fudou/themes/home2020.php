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
 * @subpackage Twenty Twenty
 *
 * Fudou TopPage ver5.3.0
 */

get_header();
?>

<main id="site-content" role="main">

	<article>

		<div id="top_fbox" class="post-inner section-inner thin">
			<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('top_widgets') ) : ?>
			<?php endif; ?>
		</div><!-- #top_fbox -->

	</article>

</main><!-- #site-content -->

<?php get_template_part( 'template-parts/footer-menus-widgets' ); ?>

<?php get_footer(); ?>