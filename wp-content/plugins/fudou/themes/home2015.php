<?php
/**
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress4.1
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div id="top_fbox" class="hentry">
				<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('top_widgets') ) : ?>
				<?php endif; ?>
			</div><!-- #top_fbox -->

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>