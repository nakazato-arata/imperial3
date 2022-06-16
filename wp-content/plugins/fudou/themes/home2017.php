<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

/*
 * Fudou TopPage ver1.7.8
 */
get_header(); 
?>
<div class="wrap">

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="top_fbox" class="hentry">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('top_widgets') ) : ?>
				<?php endif; ?>
			</div><!-- #top_fbox -->

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
