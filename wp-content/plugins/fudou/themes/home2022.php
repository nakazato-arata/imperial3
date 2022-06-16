<?php
/**
 * The Template for displaying fudou home.
 *
 * Template: home2022.php
 * 
 * @package WordPress
 * @subpackage Twenty Twenty Two
 *
 * Fudou TopPage ver5.9.0
 */



	/**
	 * Template header data feom canvas file.
	 * front-page.html
	 */

	//FSEヘッダー Twenty Twenty-Two ver1.0.0 home.html
	$header_content = '<!-- wp:template-part {"slug":"header-small-dark","tagName":"header"} /-->';
	/**
	 * header_content Filter
	 * ver5.9.0
	 */
	$header_content = apply_filters( 'fudou_fse_header_content', $header_content, 'home' );
	$header_content = str_replace( '} /-->', ',"theme":"' . get_template() . '"} /-->', $header_content);


	//FSEフッター Twenty Twenty-Two ver1.0.0 home.html
	$footer_content = '<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->';
	/**
	 * footer_content Filter
	 * ver5.9.0
	 */
	$footer_content = apply_filters( 'fudou_fse_footer_content', $footer_content, 'home' );
	$footer_content = str_replace( '} /-->', ',"theme":"' . get_template() . '"} /-->', $footer_content);


?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="wp-site-blocks">
<?php 
	//header
	echo fudou_gutenberg_get_the_template_html( $header_content );
?>

<main class="wp-container wp-block-group alignwide">

	<div id="top_fbox">
		<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('top_widgets') ) : ?>
		<?php endif; ?>
	</div><!-- #top_fbox -->

</main>

<?php 
	//footer
	echo fudou_gutenberg_get_the_template_html( $footer_content );
?>
<?php wp_footer(); ?>

</div><!-- .wp-site-blocks -->
</body>
</html>
