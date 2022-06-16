<?php
/**
 * The template for displaying the home page.
 *
 * @package WordPress4.8
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.8.2
 */

get_header(); ?>

<div id="main-content" class="main-content">

<?php
	if ( is_front_page() && twentyfourteen_has_featured_posts() ) {
		// Include the featured content template.
		get_template_part( 'featured-content' );
	}
?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<article id="top_fbox">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('top_widgets') ) : ?>
				<?php endif; ?>
			</article><!-- #top_fbox -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->
	<?php get_sidebar( 'content' ); ?>
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();
