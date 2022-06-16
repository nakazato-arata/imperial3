<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress4.8
 * @subpackage Fudousan Plugin
 * Version: 1.8.0
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */

define('WP_USE_THEMES', false);

/** Loads the WordPress Environment and Template */
require_once '../../../../wp-blog-header.php';

if( have_posts() ) the_post();

$post_id = myIsNum_f($_GET['p']);

//会員2
$kaiin = 0;
if( !is_user_logged_in() && get_post_meta($post_id, 'kaiin', true) > 0 ) $kaiin = 1;


//SSL
$fudou_ssl_site_url = get_option('fudou_ssl_site_url');
if( FUDOU_SSL_MODE == 1 && $fudou_ssl_site_url !=''){
	$site_url = $fudou_ssl_site_url;
}else{
	$site_url = get_option('siteurl');
}

/**
 * ContactForm 7 SSL URL
 * 
 * If you want to change the your server uri.
 */
if ( ! function_exists( 'fudou_wpcf7_form_action_url' ) ) :
function fudou_wpcf7_form_action_url( $wpcf_request_uri ) {

	//SSL設定 url
	$fudou_ssl_site_url = get_option( 'fudou_ssl_site_url' );
	$url = $fudou_ssl_site_url . $wpcf_request_uri;
	return $url;
}
endif; // fudou_wpcf7_form_action_url
//add_filter( 'wpcf7_form_action_url', 'fudou_wpcf7_form_action_url' );



status_header( 200 );

?><!DOCTYPE html>
<html dir="ltr" lang="ja">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title>問合せ</title>
<?php 
	if ( wp_is_mobile() ) {
		echo '<meta name="viewport" content="width=320; initial-scale=0.9; maximum-scale=1.0; user-scalable=0;" />';
	}
	echo '<link rel="stylesheet" id="contact-form-7-css"  href="' . $site_url . '/wp-content/plugins/contact-form-7/includes/css/styles.css" type="text/css" media="all" />';
	echo '<script type="text/javascript" src="' . $site_url . '/wp-includes/js/jquery/jquery.js"></script>';
	echo '<script type="text/javascript" src="' . $site_url . '/wp-content/plugins/contact-form-7/includes/js/jquery.form.js"></script>';
	echo '<script type="text/javascript" src="' . $site_url . '/wp-content/plugins/contact-form-7/includes/js/scripts.js"></script>';
?>

<style type="text/css">
<!--
<?php if ( wp_is_mobile() ) { ?>
	#ssl_contact {
		background: none repeat scroll 0 0 #FFFFFF;
		border: 1px solid #E5E5E5;
		border-radius: 11px 11px 11px 11px;
		box-shadow: 0 4px 18px #C8C8C8;
		font-weight: normal;
		padding: 1em 1em 2em 1em;
		line-height: 1.8;
		margin: 8px;
	}
	#ssl_contact h3 {
		border-bottom: 1px dotted #CCCCCC;
		border-left: 3px solid #CCCCCC;
		margin: 14px 0 14px;
		padding: 0 0 0 10px;
		text-shadow: 1px 1px 0 #CCCCCC;
		color: #777777;
	}

	#ssl_contact label {
		display: block;
		float: left;
		padding-right: 15px;
	}
	#ssl_contact label input { margin-left: 10px; }
	#ssl_contact input[type="text"], 
	#ssl_contact input[type="email"], 
	textarea {
		background: none repeat scroll 0 0 #FBFBFB;
		border: 1px solid #E5E5E5;
		padding: 5px;
		margin: 2px 6px 16px 0px;
		font-size: 18px;
		width: 97%;
	}

<?php }else{ ?>

	#ssl_contact {
		background: none repeat scroll 0 0 #FFFFFF;
		border: 1px solid #E5E5E5;
		border-radius: 11px 11px 11px 11px;
		box-shadow: 0 4px 18px #C8C8C8;
		font-weight: normal;
		padding: 5px 25px 40px;
		line-height: 1.2;
		width: 550px;
		margin: 8px;
	}

	#ssl_contact h3 {
		border-bottom: 1px dotted #CCCCCC;
		border-left: 3px solid #CCCCCC;
		margin: 14px 0 14px;
		padding: 5px 0 5px 10px;
		text-shadow: 1px 1px 0 #CCCCCC;
		color: #777777;
	}

	#ssl_contact p {
		overflow: hidden;	/* モダンブラウザ向け */
		zoom: 1; /* IE向け */
	}

	#ssl_contact label {
		display: block;
		float: left;
		padding-right: 15px;
	}

	#ssl_contact label input { margin-left: 10px; }

	#ssl_contact input[type="text"], 
	#ssl_contact input[type="email"], 
	#ssl_contact input[type="text"], 
	textarea {
		background: none repeat scroll 0 0 #FBFBFB;
		border: 1px solid #E5E5E5;
		box-shadow: 1px 1px 1px rgba(0, 0, 0, 0.1) inset;
		font-size: 100%;
		padding: 5px;
		margin: 2px 6px 2px 0px;
		width: 97%;
	}

<?php } ?>


#ssl_contact .wpcf7-submit {
    background: none repeat scroll 0 0 #2EA2CC;
    border-color: #0074A2;
    box-shadow: 0 1px 0 rgba(120, 200, 230, 0.5) inset, 0 1px 0 rgba(0, 0, 0, 0.15);
    color: #FFFFFF;
    text-decoration: none;

    -moz-box-sizing: border-box;
    border-radius: 3px;
    border-style: solid;
    border-width: 1px;
    cursor: pointer;
    display: inline-block;
    font-size: 16px;
    height: 28px;
    padding: 0 20px 1px;
    text-decoration: none;
    white-space: nowrap;
}

-->
</style>

</head>

<body>
<div id="ssl_contact">
<?php 

	$fudo_form = get_option('fudo_form');

	//問合せフォーム
	if( $kaiin == 1 ) {
		if($post_id !=''){
			/*
			 * 問合せフォーム Filter
			 * 
			 * Version: 1.7.12
			 */
			$fudo_form = apply_filters( 'fudo_single_form', $fudo_form, $post_id );

			$fudo_form = apply_filters( 'the_content', $fudo_form );
			$fudo_form = str_replace( ']]>', ']]&gt;', $fudo_form );
			echo $fudo_form;
		}
	}else{
		if($post_id !=''){
			/*
			 * 問合せフォーム Filter
			 * 
			 * Version: 1.7.12
			 */
			$fudo_form = apply_filters( 'fudo_single_form', $fudo_form, $post_id );

			$fudo_form = apply_filters( 'the_content', $fudo_form );
			$fudo_form = str_replace( ']]>', ']]&gt;', $fudo_form );
			echo $fudo_form;
		}
	}

?>
<?php if ( wp_is_mobile() ) 
	echo '<div align="right"><a href="' . get_permalink( $post_id ) . '">→物件詳細へ戻る</a></div>';
?>
</div><!-- .#ssl_contact -->
<script type='text/javascript'>
	/* <![CDATA[ */
	var _wpcf7 = {"loaderUrl":"..\/..\/contact-form-7\/images\/ajax-loader.gif","sending":"\u9001\u4fe1\u4e2d ..."};
	/* ]]> */
</script>

</body>
</html>

