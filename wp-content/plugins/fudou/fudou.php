<?php
/*
Plugin Name: Fudousan Plugin
Plugin URI: http://nendeb.jp/
Description: Fudousan Plugin for Real Estate
Version: 5.9.1
Requires at least: 5.6
Requires PHP: 7.0
Author: nendeb
Author URI: http://nendeb.jp/
Update URI: fudou
License: GPLv2
*/


// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define current version constant
define( 'FUDOU_VERSION', '5.9.1' );


/*  Copyright 2022 nendeb (email : nendeb@gmail.com )

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

if ( !defined('WP_CONTENT_URL') ) define( 'WP_CONTENT_URL', get_option('siteurl').'/wp-content' );
if ( !defined('WP_CONTENT_DIR') ) define( 'WP_CONTENT_DIR', ABSPATH.'wp-content' );
if ( !defined('WP_PLUGIN_URL') )  define( 'WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins' );
if ( !defined('WP_PLUGIN_DIR') )  define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins' );

//SSL 1:使用可能 0:使用不可
if ( !defined('FUDOU_SSL_MODE') ) define( 'FUDOU_SSL_MODE', 0 );

//物件画像数
if ( !defined('FUDOU_IMG_MAX') )  define( 'FUDOU_IMG_MAX', 30 );

//物件トラックバック・コメント 1:使用可能 0:使用不可
if ( !defined('FUDOU_TRA_COMMENT' ) )  define( 'FUDOU_TRA_COMMENT', 0 );

//物件詳細リンク 0:self 1:_blank (v5.0.0)
if (!defined('FUDOU_BUKKEN_TARGET'))	define( 'FUDOU_BUKKEN_TARGET', 0 );


/**
 * admin.
 */
require_once 'data/fudo-configdatabase.php';
require_once 'data/work-fudo.php';
require_once 'admin/admin_fudou.php';
require_once 'admin/admin_fudou2.php';

//require_once 'admin/fudo-functions.php';

/**
 * admin/fudo-functions.php Filter.
 * ver 5.4.0
 */
$fudo_functions_file = apply_filters( 'fudo_functions_file', WP_PLUGIN_DIR . '/fudou/admin/fudo-functions.php' );
if( is_file( $fudo_functions_file ) ){
	require_once $fudo_functions_file;
}else{
	require_once 'admin/fudo-functions.php';
}


/**
 * widget.
 */
require_once 'widget/fudo-widget.php';
require_once 'widget/fudo-widget2.php';
require_once 'widget/fudo-widget3.php';
require_once 'widget/fudo-widget4.php';

/**
 * Incrude hack.
 */
require_once 'inc/inc-page-jyoken.php';

/**
 * Fudou custom post embed. 
 */
require_once 'oembed/oembed.php';

/**
 * Structured Data . 
 */
require_once 'inc/template-tags.php';

/**
 * Block Initializer. ver5.8.1
 */
require_once( 'block_v2/fudou_block_init.php' );


/**
 * Fse Helper . ver5.9.0
 */
require_once 'inc/inc-fse-helper.php';



remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
/*
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wp_enqueue_scripts', 1); 
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); 
remove_action('wp_head', 'feed_links_extra',3,0); 
remove_action('wp_head', 'index_rel_link'); 
remove_action('wp_head', 'parent_post_rel_link'); 
remove_action('wp_head', 'start_post_rel_link'); 
remove_action('wp_head', 'rel_canonical'); 
*/


/*
 * xml-rpc機能を無効
*/
//add_filter( 'xmlrpc_methods' , function( $methods ) { unset( $methods['pingback.ping'] ); return $methods; });


/* 非推奨関数のエラーを書き出さなくする */
/** 
 * Filter whether to trigger an error for _doing_it_wrong() calls. 
 * 
 * @since 3.1.0 
 * 
 * @param bool $trigger Whether to trigger the error for _doing_it_wrong() calls. Default true. 
 */ 
//add_action( 'doing_it_wrong_trigger_error', '__return_false' );

/** 
 * Filter whether to trigger an error for deprecated files. 
 * 
 * @since 2.5.0 
 * 
 * @param bool $trigger Whether to trigger the error for deprecated files. Default true. 
 */ 
//add_filter( 'deprecated_file_trigger_error', '__return_false' ); 

/*
 * Cancel to  Marks a constructor as deprecated and informs when it has been used.
 * PHP4 style constructor method that is deprecated.
 * @since 4.3.0
*/
//add_filter( 'deprecated_constructor_trigger_error', '__return_false' );

/**
 * Cancel to function as deprecated and inform when it has been used.
 *
 * There is a hook deprecated_function_run that will be called that can be used
 * to get the backtrace up to what file and function called the deprecated
 */
//add_filter( 'deprecated_function_trigger_error', '__return_false' );



//rss 会員
remove_filter('do_feed_rdf', 'do_feed_rdf', 10);
remove_filter('do_feed_rss', 'do_feed_rss', 10);
remove_filter('do_feed_rss2', 'do_feed_rss2', 10);
remove_filter('do_feed_atom', 'do_feed_atom', 10);


/*
 * Remove  "Displays a _doing_it_wrong() message for conflicting widget editor scripts."
 * WordPress5.8
 */
remove_action( 'admin_head', 'wp_check_widget_editor_deps' );


//rss 会員
function custom_feed_rdf_fudou() {
	$template_file = WP_PLUGIN_DIR . '/fudou/themes/feed-rdf.php';
	load_template( $template_file );
}
add_action('do_feed_rdf', 'custom_feed_rdf_fudou', 10, 1);

function custom_feed_rss_fudou() {
	$template_file = WP_PLUGIN_DIR . '/fudou/themes/feed-rss.php';
	load_template( $template_file );
}
add_action('do_feed_rss', 'custom_feed_rss_fudou', 10, 1);

function custom_feed_rss2_fudou( $for_comments ) {
	$template_file = WP_PLUGIN_DIR . '/fudou/themes/feed-rss2' . ( $for_comments ? '-comments' : '' ) . '.php';
	load_template( $template_file );
}
add_action('do_feed_rss2', 'custom_feed_rss2_fudou', 10, 1);

function custom_feed_atom_fudou( $for_comments ) {
	$template_file = WP_PLUGIN_DIR . '/fudou/themes/feed-atom' . ( $for_comments ? '-comments' : '' ) . '.php';
	load_template( $template_file );
}
add_action('do_feed_atom', 'custom_feed_atom_fudou', 10, 1); 

//RSS フィード
function rss_get_posts_fudou( $query ) {
	if ( is_feed() ) {
		$query->set( 'post_type', array( 'post', 'fudo' ) );
	}
	return $query;
}
add_filter( 'pre_get_posts', 'rss_get_posts_fudou' );


/*
 * 不動産プラグイン(本体)をシリーズ内で最初に読み込むようにする。
 * @since Fudousan Plugin 1.5.0
*/
function fudou_plugin_first_load() {

	$this_plugin = 'fudou/fudou.php';
	$active_plugins = get_option('active_plugins');
	$new_active_plugins = array();

	$insert = 0;
	foreach ( $active_plugins as $plugins ) {
		if( $plugins != $this_plugin ){
			if( strpos( $plugins , 'fudou' ) !== false && $insert == 0 ){
				$new_active_plugins[] = $this_plugin;
				$insert = 1;
			}
			$new_active_plugins[] = $plugins;
		}else{
			if( $insert == 0 ){
				$new_active_plugins[] = $this_plugin;
				$insert = 1;
			}
		}
	}
	if( !empty( $new_active_plugins ) ){
		update_option( 'active_plugins' ,  $new_active_plugins );
	}
}
add_action( "activated_plugin", "fudou_plugin_first_load" );


/*
 * 不動産プラグインデーターベース設定
 * @since Fudousan Plugin 1.0.0
*/
function init_data_tables_fudou() {
	//データーベース設定
	databaseinstallation_fudo(0);
}
register_activation_hook(__FILE__,'init_data_tables_fudou');

/*
 * 不動産プラグインデーターベース他 チェック
 * @since Fudousan Plugin 5.3.2
*/
function databaseinstallation_warnings_fudou() {

	global $wpdb;

	//データーベース チェック
	$table_name1 = $wpdb->prefix . DB_KEN_TABLE;
	$table_name2 = $wpdb->prefix . DB_SHIKU_TABLE;
	$table_name3 = $wpdb->prefix . DB_ROSENKEN_TABLE;
	$table_name4 = $wpdb->prefix . DB_ROSEN_TABLE;
	$table_name5 = $wpdb->prefix . DB_EKI_TABLE;

	$results1 = $wpdb->get_var("show tables like '$table_name1'") ;
	$results2 = $wpdb->get_var("show tables like '$table_name2'") ;
	$results3 = $wpdb->get_var("show tables like '$table_name3'") ;
	$results4 = $wpdb->get_var("show tables like '$table_name4'") ;
	$results5 = $wpdb->get_var("show tables like '$table_name5'") ;

	if( empty($results1) || empty($results2) || empty($results3) || empty($results4) || empty($results5) ){
		add_action('admin_notices', 'databaseinstallation_notices_main');
	}


	// ダッシュボードウィジェット
	add_action('wp_dashboard_setup', 'fudo_add_dashboard_widgets' );	//物件数表示
	add_action('wp_dashboard_setup', 'fudodl_add_dashboard_widgets' );	//不動産プラグイン案内


	//マルチサイト チェック
	if ( is_multisite() ) {
		add_action('admin_notices', 'multi_site_notices');
	}

	//パーマリンクチェック
	$permalink_structure = get_option('permalink_structure');
	if ( $permalink_structure != '' ) {

		//パーマリンクチェック < Ver1.5.3
		$permalink_err = false;
		if ( defined('FUDOU_HISTORY_VERSION') ) {	if ( version_compare( FUDOU_HISTORY_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }
		if ( defined('FUDOU_MAP_VERSION') ) {		if ( version_compare( FUDOU_MAP_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }
		if ( defined('FUDOU_MAIL_VERSION') ) {		if ( version_compare( FUDOU_MAIL_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }
		if ( defined('FUDOU_OGP_VERSION') ) {		if ( version_compare( FUDOU_OGP_VERSION , '1.5.3', '<') ) { $permalink_err = true; } }

		if( $permalink_err ){
			//パーマリンクは「基本」にしてください ～Ver1.5.3
			add_action('admin_notices', 'fudou_permalink_notices');
		}else{
			//パーマリンク「投稿名」設定チェック Ver1.5.3～
			$pos = strpos( $permalink_structure, 'postname' );
			if( $pos !== false ){

				$permalink_message_disable = get_option( 'permalink_message_disable' ); 
				if( !$permalink_message_disable ){

					$post_permalink_message_disable = isset($_POST['permalink_message_disable']) ? myIsNum_f($_POST['permalink_message_disable']) : ''; 
					if( $post_permalink_message_disable ){
						check_admin_referer('permalink_message_disable');
						update_option( 'permalink_message_disable', '1' );
					}else{
						add_action( 'admin_notices', 'fudou_permalink_notices2' );
					}
				}

			}
		}
	}


	//アップロードしたファイルを年月ベースのフォルダに整理 チェック
	$stored_value = get_option("uploads_use_yearmonth_folders");
	if( $stored_value ){

		$img_count = 0;
		$sql  = "SELECT count(DISTINCT P.ID) AS co";
		$sql .=" FROM $wpdb->posts AS P";
		$sql .=" WHERE P.post_type ='attachment'";
		//$sql = $wpdb->prepare($sql,'');
		$meta = $wpdb->get_row( $sql );
		if( !empty($meta) ){
			$img_count = $meta->co;
		}
		//画像が登録されていない場合だけ
		if( !$img_count ){
			add_action( 'admin_notices', 'fudou_uploads_yearmonth_notices' );
		}

	}
}
add_action('admin_init', 'databaseinstallation_warnings_fudou');

//データーベース チェック
	function databaseinstallation_notices_main() {
		echo '<div class="error" style="text-align: center;"><p>データベースを登録できませんでした。サーバーに問題があるのかも知れません。[Fudousan Plugin]</p></div>';
	}
//マルチサイト チェック
	function multi_site_notices() {
		echo '<div class="error" style="text-align: center;"><p>マルチサイトでは利用できません。</p></div>';
	}
//パーマリンクチェック  < Ver1.5.3
	function fudou_permalink_notices() {
		echo '<div class="notice notice-warning is-dismissible"><p>パーマリンクは「基本」にしてください。　<a href="options-permalink.php">パーマリンク設定</a></p></div>';
	}
//パーマリンク「投稿名」チェック Ver1.5.3～
	function fudou_permalink_notices2() {
		printf( '
			<div id="permalink_message" class="notice notice-warning">
				<p>
					<form class="permalink_message_disable" name="permalink_message_disable" method="post" action="">
					<input type="hidden" name="permalink_message_disable" value="1" />
					<strong>パーマリンクの設定が「投稿名」を使うように設定されています。</strong>
					<br />パーマリンクの「投稿名」は非推奨です。「基本」又は「数字ベース」を使用してください。　<a href="%1$s">パーマリンク設定</a>　%2$s %3$s
					</form>
				</p>
			</div>',
			esc_url( admin_url( 'options-permalink.php' ) ) ,
			'<input type="submit" name="submit" id="submit" class="button-primary" value="パーマリンクを変更せずに この表示を非表示にする"  />',
			wp_nonce_field('permalink_message_disable') 
		);
	}
//アップロードしたファイルを年月ベースのフォルダに整理 チェック
	function fudou_uploads_yearmonth_notices() {
		printf( '
			<div id="permalink_message" class="notice notice-warning">
				<p>
					<strong>メディア設定「アップロードしたファイルを年月ベースのフォルダに整理」の チェックを外してください。</strong>
					　<a href="%1$s">不動産プラグイン設定(基本設定)->メディア設定 </a>
				</p>
			</div>',
			esc_url( admin_url( 'options-general.php?page=fudou/admin/admin_fudou.php' ) ) 
		);
	}



/*
 * 不動産プラグインシリーズ 環境 チェック
 * @since Fudousan Plugin 5.3.4
*/
function fudou_version_check_warnings() {

	//不動産プラグインバージョンチェック
	global $fudou_version_check_err;

	if ( defined( 'FUDOU_INJOKEN_CAT_VERSION' ) )	{	if ( version_compare( FUDOU_INJOKEN_CAT_VERSION , '5.3.0', '<') ) 		{ $fudou_version_check_err .= ' 不動産イン条件カテゴリプラグイン を ver5.3.0以降 にバージョンアップしてください。(現在:'. FUDOU_INJOKEN_CAT_VERSION . ')<br />' ; } }
	if ( defined( 'FUDOU_INJOKEN_RIM_VERSION' ) )	{	if ( version_compare( FUDOU_INJOKEN_RIM_VERSION , '5.3.0', '<') )		{ $fudou_version_check_err .= ' 不動産イン条件利回りプラグイン を ver5.3.0以降 にバージョンアップしてください。(現在:'	. FUDOU_INJOKEN_RIM_VERSION . ')<br />' ; } }
	if ( defined( 'FUDOU_INJOKEN_TSUBOTANKA_VERSION' ) ){	if ( version_compare( FUDOU_INJOKEN_TSUBOTANKA_VERSION , '5.3.0', '<') ) 	{ $fudou_version_check_err .= ' 不動産イン条件坪単価プラグイン を ver5.3.0以降 にバージョンアップしてください。(現在:'	. FUDOU_INJOKEN_TSUBOTANKA_VERSION . ')<br />' ; } }
	if ( defined( 'FUDOU_CHOUMEI_VERSION' ) )	{	if ( version_compare( FUDOU_CHOUMEI_VERSION , '5.3.0', '<') ) 			{ $fudou_version_check_err .= ' 不動産町名検索プラグイン を ver5.3.0以降 にバージョンアップしてください。(現在:'	. FUDOU_CHOUMEI_VERSION . ')<br />' ; } }
	if ( defined( 'FUDOU_KOUKU_VERSION' ) )		{	if ( version_compare( FUDOU_KOUKU_VERSION , '5.3.0', '<') ) 			{ $fudou_version_check_err .= ' 不動産校区プラグインを ver5.3.0以降 にバージョンアップしてください。(現在:'		. FUDOU_KOUKU_VERSION . ')<br />' ; } }
	if ( defined( 'FUDOU_CUSTOM_MS_VERSION' ) )	{	if ( version_compare( FUDOU_CUSTOM_MS_VERSION , '5.3.0', '<') ) 		{ $fudou_version_check_err .= ' 不動産カスタマイズ面積検索プラグイン を ver5.3.0以降 にバージョンアップしてください。(現在:'	. FUDOU_CUSTOM_MS_VERSION . ')<br />' ; } }
	if ( defined( 'FUDOU_TOP_SLIDER_VERSION' ) )	{	if ( version_compare( FUDOU_TOP_SLIDER_VERSION , '5.3.0', '<') ) 		{ $fudou_version_check_err .= ' 不動産トップスライダープラグイン を ver5.3.0以降 にバージョンアップしてください。(現在:'	. FUDOU_TOP_SLIDER_VERSION . ')<br />' ; } }
	if ( defined( 'FUDOU_CSV_VERSION' ) ) 		{	if ( version_compare( FUDOU_CSV_VERSION , '5.0.0', '<') ) 			{ $fudou_version_check_err .= ' 不動産汎用CSVプラグインを ver5.0.0以降 にバージョンアップしてください。(現在:'		. FUDOU_CSV_VERSION . ')<br />' ; } }

	//WordPress5.3 Fix
	global $wp_version;
	if ( version_compare( $wp_version, '5.3', '>' ) ) {
		if ( defined( 'FUDOU_KAIIN_VERSION' ) )	{	if ( version_compare( FUDOU_KAIIN_VERSION , '5.3.3', '<') ) 			{ $fudou_version_check_err .= ' 不動産会員プラグイン を ver5.3.3以降 にバージョンアップしてください。(現在:'	. FUDOU_KAIIN_VERSION . ')<br />' ; } }
		if ( defined( 'FUDOU_KAIIN_VIP_VERSION' ) ){	if ( version_compare( FUDOU_KAIIN_VIP_VERSION , '5.3.4', '<') ) 		{ $fudou_version_check_err .= ' 不動産会員VIPプラグイン を ver5.3.4以降 にバージョンアップしてください。(現在:'	. FUDOU_KAIIN_VIP_VERSION . ')<br />' ; } }
	}


	if( $fudou_version_check_err ){
		add_action( 'admin_notices', 'fudou_version_check_err_notices' );
	}

}
add_action('admin_init', 'fudou_version_check_warnings' );

function fudou_version_check_err_notices() {
	global $fudou_version_check_err;
	echo '<div class="error"><p>不動産プラグインを利用するには、以下の不動産プラグインシリーズをバージョンアップしてください。<br />' . $fudou_version_check_err . '</p></div>';
}



/*
 * WordPress Coreバージョン チェック
 * @since Fudousan Plugin 5.0.0
*/
function fudou_wp_version_check_warnings() {

	global $wp_version;

	if ( version_compare( $wp_version, '4.7', '<' ) ) {
		add_action( 'admin_notices', 'fudou_wp_version_check_err_notices' );
	}
}
add_action('admin_init', 'fudou_wp_version_check_warnings' );

function fudou_wp_version_check_err_notices() {
	global $wp_version;
	echo '<div class="error"><p>不動産プラグインを利用するには、WordPressをバージョンアップしてください。現在：' . $wp_version . '</p></div>';
}




/**
 *
 * 不動産プラグインシリーズチェック
 *
 * @since Fudousan Plugin 5.9.1
 */
function fudou_active_plugins_check(){

	global $is_fudou;
	global $is_fudou_custom_cat_extraction;
	global $is_fudou_custom_jyoken_widget;
	global $is_fudou_custom_menseki_seach;
	global $is_fudouincat;
	global $is_fudouinrim;
	global $is_fudou_injyoken_seiyaku_seach;
	global $is_fudou_injyoken_tsubotanka_seach;
	global $is_shortcode;
	global $is_fudouamp;
	global $is_fudoubukkenkanrisha;
	global $is_fudouchoumei;
	global $is_fudoucsv;
	global $is_fudoudatabase;
	global $is_fudouhistory;
	global $is_fudoukaiin;
	global $is_fudoukaiin_vip;
	global $is_fudoukouku;
	global $is_fudoumail;
	global $is_fudoumap;
	global $is_fudouogptwittercards;
	global $is_fudourains_chubu;
	global $is_fudourains_higashi;
	global $is_fudourains_kinki;
	global $is_fudourains_nishi;
	global $is_fudourains_zenkoku;
	global $is_fudou_share_bottons;
	global $is_fudoutootoldpost;
	global $is_fudoutopslider;
	global $is_fudoutweetoldpost;
	global $is_fudou_tokyo23_map;
	global $is_fudou_zenkoku_todoufken_map;
	global $is_fudou_block_slider;
	global $is_fudou_favorites;

	global $is_wp_multibyte_patch;
	global $is_wp_jquery_lightbox;
	global $wp_version;

	$is_wp_multibyte_patch =false;

	$fudo_active_plugins = get_option('active_plugins');
	if(is_array($fudo_active_plugins)) {
		foreach($fudo_active_plugins as $meta_box){
			if( $meta_box == 'fudou/fudou.php')							$is_fudou=true;
			if( $meta_box == 'fudou_custom_cat_extraction/fudou_custom_cat_extraction.php')		$is_fudou_custom_cat_extraction=true;
			if( $meta_box == 'fudou_custom_jyoken_widget/fudou_custom_jyoken_widget.php')		$is_fudou_custom_jyoken_widget=true;
			if( $meta_box == 'fudou_custom_menseki_seach/fudou_custom_menseki_seach.php')		$is_fudou_custom_menseki_seach=true;
			if( $meta_box == 'fudou_injhoken_cat/fudou_injhoken_cat.php')				$is_fudouincat=true;
			if( $meta_box == 'fudou_injhoken_rim/fudou_injhoken_rim.php')				$is_fudouinrim=true;
			if( $meta_box == 'fudou_injhoken_seiyaku/fudou_injhoken_seiyaku.php')			$is_fudou_injyoken_seiyaku_seach=true;
			if( $meta_box == 'fudou_injhoken_tsubotanka/fudou_injhoken_tsubotanka.php')		$is_fudou_injyoken_tsubotanka_seach=true;
			if( $meta_box == 'fudou_shortcode/fudou_shortcode.php')					$is_shortcode=true;
			if( $meta_box == 'fudouamp/fudouamp.php')						$is_fudouamp=true;
			if( $meta_box == 'fudoubukkenkanrisha/fudoubukkenkanrisha.php')				$is_fudoubukkenkanrisha=true;
			if( $meta_box == 'fudouchoumei/fudouchoumei.php')					$is_fudouchoumei=true;
			if( $meta_box == 'fudoucsv/fudoucsv.php')						$is_fudoucsv=true;
			if( $meta_box == 'fudoudatabase/fudoudatabase.php')					$is_fudoudatabase=true;
			if( $meta_box == 'fudouhistory/fudouhistory.php')					$is_fudouhistory=true;
			if( $meta_box == 'fudoukaiin/fudoukaiin.php')						$is_fudoukaiin=true;
			if( $meta_box == 'fudoukaiin_vip/fudoukaiin_vip.php')					$is_fudoukaiin_vip=true;
			if( $meta_box == 'fudoukouku/fudoukouku.php')						$is_fudoukouku=true;
			if( $meta_box == 'fudoumail/fudoumail.php')						$is_fudoumail=true;
			if( $meta_box == 'fudoumap/fudoumap.php')						$is_fudoumap=true;
			if( $meta_box == 'fudou-ogp-twittercards/fudou-ogp-twittercards.php')			$is_fudouogptwittercards=true;
			if( $meta_box == 'fudourains_chubu/fudourains_chubu.php')				$is_fudourains_chubu=true;		//廃止
			if( $meta_box == 'fudourains_higashi/fudourains_higashi.php')				$is_fudourains_higashi=true;		//廃止
			if( $meta_box == 'fudourains_kinki/fudourains.php')					$is_fudourains_kinki=true;
			if( $meta_box == 'fudourains_nishi/fudourains_nishi.php')				$is_fudourains_nishi=true;
			if( $meta_box == 'fudourains_zenzoku/fudourains_zenzoku.php')				$is_fudourains_zenkoku=true;		//廃止
			if( $meta_box == 'fudou-share-bottons/fudou-share-bottons.php')				$is_fudou_share_bottons=true;
			if( $meta_box == 'fudou-toot-old-post/toot-old-post.php')				$is_fudoutootoldpost=true;		//廃止
			if( $meta_box == 'fudoutopslider/fudoutopslider.php')					$is_fudoutopslider=true;		//廃止
			if( $meta_box == 'fudou-tweet-old-post/tweet-old-post.php')				$is_fudoutweetoldpost=true;
			if( $meta_box == 'fudou_tokyo23_area_map/fudou_tokyo23_area_map.php')			$is_fudou_tokyo23_map=true;
			if( $meta_box == 'fudou_zenkoku_todoufken_map/fudou_zenkoku_todoufken_map.php')		$is_fudou_zenkoku_todoufken_map=true;
			if( $meta_box == 'fudou-slider/fudou-slider.php')					$is_fudou_block_slider=true;
			if( $meta_box == 'fudou_favorites/fudou_favorites.php')					$is_fudou_favorites=true;

			//他社
			if( $meta_box == 'wp-multibyte-patch/wp-multibyte-patch.php')				$is_wp_multibyte_patch=true;
		}
	}

	//WP Multibyte Patchチェック
	if( !$is_wp_multibyte_patch ){
		add_action('admin_notices', 'fudou_wp_multibyte_patch_notices');
	}
}
add_action('init', 'fudou_active_plugins_check');
//WP Multibyte Patchチェック
function fudou_wp_multibyte_patch_notices() {
	echo '<div class="error notice is-dismissible visibility-notice"><p>「WP Multibyte Patchプラグイン」をインストール・有効化してください。　<a href="' .  esc_url( admin_url( 'plugins.php' ) ) . '">プラグイン設定</a></p></div>';
}



/**
 *
 * SSL利用時に add thickbox
 *
 * @since Fudousan Plugin 1.5.2
 */
function fudou_active_thickbox(){
	global $is_iphone;
	$fudou_ssl_site_url = get_option('fudou_ssl_site_url');
	if( !wp_is_mobile() && $fudou_ssl_site_url !='' ){
		if (function_exists('add_thickbox')) add_thickbox();
	}
}
add_action( 'init', 'fudou_active_thickbox' );


/**
 * TwentyFifteen
 * 不動産閲覧履歴プラグイン CSS キャンセル
 * 不動産トップスライダープラグイン CSS キャンセル
 *
 * @since Fudousan Plugin 5.3.0
 * TwentyFifteen TwentySixteen TwentySeventeen
 */
function fudou_twentyfifteen_remove_css(){
	// theme check
	if ( function_exists('wp_get_theme') ) {
		$theme_ob = wp_get_theme();
		$template_name = $theme_ob->template;
	}else{
		$template_name = get_option('template');
	}

	if( $template_name == 'twentyfifteen' ||  $template_name == 'twentysixteen' || $template_name == 'twentyseventeen' || $template_name == 'twentynineteen' || $template_name == 'twentytwenty' ){
		//不動産閲覧履歴プラグイン の CSS を読み込まなくする (v1.5.0 ～)
		remove_action( 'wp_enqueue_scripts', 'add_header_history_css_fudou', 12 );
	}
	if( false !== strpos( $template_name , 'twenty' ) ){
		//不動産トップスライダープラグインの CSS を読み込まなくする (v1.5.0 ～)
		remove_action( 'wp_enqueue_scripts', 'add_header_topslider_css_fudou', 12 );
	}
}
add_action( 'init', 'fudou_twentyfifteen_remove_css' );



/**
 *
 * 物件詳細テンプレート切替
 *
 * @since Fudousan Plugin 5.9.0
 * @param  $template
 * @return $template
 */
function get_post_type_single_template_fudou($template = '') {

	if ( !is_multisite() ) {

		global $wp_query;
		$object = $wp_query->get_queried_object();

		if( !empty( $object->post_type ) ){

			if($object->post_type == 'fudo'){
				// theme check
				if ( function_exists('wp_get_theme') ) {
					$theme_ob = wp_get_theme();
					$template_name = $theme_ob->template;
				}else{
					$template_name = get_option('template');
				}

				switch ( $template_name ) {
					case "twentytwentyone" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2021.php', 'single-fudo.php'));
						break;
					case "twentytwenty" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2020.php', 'single-fudo.php'));
						break;
					case "twentynineteen" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2019.php', 'single-fudo.php'));
						break;
					case "twentyseventeen" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2017.php', 'single-fudo.php'));
						break;
					case "twentysixteen" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2016.php', 'single-fudo.php'));
						break;
					case "twentyfifteen" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2015.php', 'single-fudo.php'));
						break;
					case "twentyfourteen" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2014.php', 'single-fudo.php'));
						break;
					case "twentytwentytwo" :
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo2022.php', 'template-canvas.php'));
						break;
					default:
						$template = locate_template(array('../../plugins/fudou/themes/single-fudo.php', 'single-fudo.php'));
						break;
				}
			}
		}
	}
	return $template;
}
add_filter('template_include', 'get_post_type_single_template_fudou');


/**
 *
 * 物件リストテンプレート切替
 *
 * @since Fudousan Plugin 5.9.0
 * @param  $template
 * @return $template
 */
function fudo_body_archiveclass($class) {
	$class[0] = 'archive archive-fudo';
	return $class;
}
function get_post_type_archive_template_fudou($template = '') {

	if ( !is_multisite() ) {

		global $wp_query;
		$cat = $wp_query->get_queried_object();
		$cat_name = isset( $cat->taxonomy ) ? $cat->taxonomy : '';

		if ( isset( $_GET['bukken'] ) || isset( $_GET['bukken_tag'] ) 
			|| $cat_name == 'bukken' || $cat_name =='bukken_tag' ) {

			status_header( 200 );

			// theme check
			if ( function_exists('wp_get_theme') ) {
				$theme_ob = wp_get_theme();
				$template_name = $theme_ob->template;
			}else{
				$template_name = get_option('template');
			}

			switch ( $template_name ) {
				case "twentytwentyone" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2021.php', 'archive.php'));
					break;
				case "twentytwenty" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2020.php', 'archive.php'));
					break;
				case "twentynineteen" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2019.php', 'archive.php'));
					break;
				case "twentyseventeen" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2017.php', 'archive.php'));
					break;
				case "twentysixteen" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2016.php', 'archive.php'));
					break;
				case "twentyfifteen" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2015.php', 'archive.php'));
					break;
				case "twentyfourteen" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2014.php', 'archive.php'));
					break;
				case "twentytwentytwo" :
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo2022.php', 'template-canvas.php'));
					break;
				default:
					$template = locate_template(array('../../plugins/fudou/themes/archive-fudo.php', 'archive.php'));
					break;
			}
			add_filter( 'body_class', 'fudo_body_archiveclass' );
		}
	}
	return $template;
}
add_filter( 'template_include', 'get_post_type_archive_template_fudou', 11 );


/**
 *
 * テーマ別 ヘッダーに jsや CSSを 追加
 *
 * @since Fudousan Plugin 5.9.0
 */
function add_header_css_js_fudou() {

	if ( !is_multisite() ) {

		$plugin_url = plugin_dir_url( __FILE__ );

		if ( function_exists('wp_get_theme') ) {
			$theme_ob = wp_get_theme();
			$template_name = $theme_ob->template;
		}else{
			$template_name = get_option('template');
		}

		switch ( $template_name ) {
			case "twentyten" :
				wp_enqueue_style( 'twentyten-style2010', $plugin_url .'themes/style2010.css' );
				wp_enqueue_style( 'twentyten-corners2010', $plugin_url .'themes/corners2010.css' );
				break;

			case "twentyeleven" :
				wp_enqueue_style( 'twentyeleven-style2011', $plugin_url .'themes/style2011.css' );
				wp_enqueue_style( 'twentyeleven-corners2011', $plugin_url .'themes/corners2011.css' );
				break;

			case "twentytwelve" :
				wp_enqueue_style( 'twentytwelve-style2012', $plugin_url .'themes/style2012.css' );
				wp_enqueue_style( 'twentytwelve-corners2012', $plugin_url .'themes/corners2012.css' );
				break;

			case "twentythirteen" :
				wp_enqueue_style( 'twentythirteen-style2013', $plugin_url .'themes/style2013.css' );
				wp_enqueue_style( 'twentythirteen-corners2013', $plugin_url .'themes/corners2013.css' );
				break;

			case "twentyfourteen" :
				wp_enqueue_style( 'twentyfourteen-style2014', $plugin_url .'themes/style2014.css' );
				wp_enqueue_style( 'twentyfourteen-corners2014', $plugin_url .'themes/corners2014.css' );
				break;

			case "twentyfifteen" :
				wp_enqueue_style( 'twentyfifteen-style2015', $plugin_url .'themes/style2015.css' );
				wp_enqueue_style( 'twentyfifteen-corners2015', $plugin_url .'themes/corners2015.css' );
				break;

			case "twentysixteen" :
				wp_enqueue_style( 'twentysixteen-style2016', $plugin_url .'themes/style2016.css' );
				wp_enqueue_style( 'twentysixteen-corners2016', $plugin_url .'themes/corners2016.css' );
				break;

			case "twentyseventeen" :
				wp_enqueue_style( 'twentyseventeen-style2017', $plugin_url .'themes/style2017.css' );
				wp_enqueue_style( 'twentyseventeen-corners2017', $plugin_url .'themes/corners2017.css' );
				break;

			case "twentynineteen" :
				wp_enqueue_style( 'twentynineteen-style2019', $plugin_url .'themes/style2019.css' );
				wp_enqueue_style( 'twentynineteen-corners2019', $plugin_url .'themes/corners2019.css' );
				break;

			case "twentytwenty" :
				wp_enqueue_style( 'twentytwenty-style2020', $plugin_url .'themes/style2020.css' );
				wp_enqueue_style( 'twentytwenty-corners2020', $plugin_url .'themes/corners2020.css' );
				break;
			case "twentytwentyone" :
				wp_enqueue_style( 'twentytwentyone-style2021', $plugin_url .'themes/style2021.css' );
				wp_enqueue_style( 'twentytwentyone-corners2021', $plugin_url .'themes/corners2021.css' );
				break;
			case "twentytwentytwo" :
				wp_enqueue_style( 'twentytwentytwo-style2022', $plugin_url .'themes/style2022.css' );
				wp_enqueue_style( 'twentytwentytwo-corners2022', $plugin_url .'themes/corners2022.css' );
				break;
			default:
			//	wp_enqueue_style( 'twentytwelve-style2012', $plugin_url .'themes/style2012.css' );
			//	wp_enqueue_style( 'twentytwelve-corners2012', $plugin_url .'themes/corners2012.css' );
				break;
		}
	}
}
add_action( 'wp_enqueue_scripts', 'add_header_css_js_fudou', 12 );



/**
 *
 * トップテンプレート切替
 *
 * @since Fudousan Plugin 5.9.0
 * @param  $template
 * @return $template
 */
function get_post_type_top_template_fudou( $template = '' ) {

	if ( is_home() ) {

		if ( function_exists('wp_get_theme') ) {
			$theme_ob = wp_get_theme();
			$template_name = $theme_ob->template;
		}else{
			$template_name = get_option('template');
		}


		switch ( $template_name ) {
			case "twentytwentytwo" :
				$template = locate_template(array('../../plugins/fudou/themes/home2022.php', 'template-canvas.php'));
				break;
			case "twentytwentyone" :
				$template = locate_template(array('../../plugins/fudou/themes/home2021.php', 'index.php'));
				break;
			case "twentytwenty" :
				$template = locate_template(array('../../plugins/fudou/themes/home2020.php', 'index.php'));
				break;
			case "twentynineteen" :
				$template = locate_template(array('../../plugins/fudou/themes/home2019.php', 'index.php'));
				break;
			case "twentyseventeen" :
				$template = locate_template(array('../../plugins/fudou/themes/home2017.php', 'index.php'));
				break;
			case "twentysixteen" :
				$template = locate_template(array('../../plugins/fudou/themes/home2016.php', 'index.php'));
				break;
			case "twentyfifteen" :
				$template = locate_template(array('../../plugins/fudou/themes/home2015.php', 'index.php'));
				break;
			case "twentyfourteen" :
				$template = locate_template(array('../../plugins/fudou/themes/home2014.php', 'index.php'));
				break;

			default:
				$template = locate_template(array('../../plugins/fudou/themes/home.php', 'index.php'));
				break;
		}
	}
	return $template;
}
add_filter( 'template_include', 'get_post_type_top_template_fudou' );



/**
 * ヘッダー埋め込みタグ
 *
 * @since Fudousan Plugin 1.5.0
 */
function add_header_text_fudou() {
	echo "\n<!-- Fudousan Plugin Ver.".FUDOU_VERSION." -->\n";
	//ヘッダ埋め込みタグ
	if( get_option('fudo_head_tag') != '' ) echo get_option('fudo_head_tag') . "\n";
}
add_action('wp_head', 'add_header_text_fudou');


/**
 * wp58 ウィジェットブロック Fix
 *
 * ver 5.8.0
 */
function fudou_wp58_widget_fix() {
	global $pagenow;
	if( is_admin() && $pagenow == 'widgets.php' ){
		echo '<style type="text/css">';
		echo 'body.logged-in.wp-embed-responsive .widget{margin: 0 !important;}';
		echo 'body.logged-in.wp-embed-responsive #content{float: none !important;width: 100%; !important;}';
		echo '</style>';
	}
}
add_action( 'wp_head', 'fudou_wp58_widget_fix' );


/**
 *
 * フッター Fudousan Plugin Ver.XXXX
 *
 * @since Fudousan Plugin 5.9.0
 */
function add_footer_text_fudou() {

	$locale = isset($_GET['_locale']) ? $_GET['_locale'] : '';

	if ( !is_admin() ){
	//v5.9.0 widget fix
	if ( $locale != 'user' ) {
		if ( is_front_page() ){
			echo '<div id="nendebcopy"><a href="https://nendeb.jp/" target="_blank" rel="noopener noreferrer" title="WordPress 不動産プラグイン">Fudousan Plugin Ver.'.FUDOU_VERSION.'</a></div>';
		}else{
				echo '<div id="nendebcopy">Fudousan Plugin Ver.'.FUDOU_VERSION.'</div>';
		}
	}
	}
}
add_filter( 'wp_footer', 'add_footer_text_fudou' );


/**
 *
 * フッター埋め込みタグ
 *
 * @since Fudousan Plugin 1.6.5
 */
function add_footer_tag_fudou() {
	//フッター埋め込みタグ
	if( get_option('fudo_footer_tag') != '' ) echo "\n" . get_option('fudo_footer_tag') . "\n";
	echo "\n<!-- Fudousan Plugin Ver.".FUDOU_VERSION." -->\n";
}
add_filter( 'wp_footer', 'add_footer_tag_fudou' );



/**
 * matchHeight.js
 *
 * @since Fudousan Plugin 5.5.0
 */
function fudou_matchHeight_scripts() {
	$plugin_url = plugin_dir_url( __FILE__ );
	//matchHeight
	//wp_enqueue_script( 'jquery-matchHeight', $plugin_url . 'js/jquery.matchHeight-min.js', array( 'jquery' ), '', true );
	wp_enqueue_script( 'jquery-matchHeight', $plugin_url . 'js/jquery.matchHeight-min.js', array( 'jquery' ), '', false );
}
add_action( 'wp_enqueue_scripts', 'fudou_matchHeight_scripts' );


/**
 * Remove use_matchHeight 
 * apply_filters( 'fudo_use_matchHeight', true )
 *
 * @since Fudousan Plugin 5.5.1
 */
function fudou_denqueue_matchHeight_scripts() {

	//Remove use_matchHeight 
	if( !apply_filters( 'fudo_use_matchHeight', true ) ){

		//未対応プラグインの確認
		$unsupported = false;
		if ( defined('FUDOU_HISTORY_VERSION') ) {
			if ( version_compare( FUDOU_HISTORY_VERSION , '5.3.3', '<') ){
				$unsupported = true;
			}
		}
		if ( !$unsupported && defined('FUDOU_SHORT_CODE_VERSION' ) ) {
			if ( version_compare( FUDOU_SHORT_CODE_VERSION, '5.3.3', '<') ){
				$unsupported = true;
			}else{
				$unsupported = false;
			}
		}
		if ( defined('FUDOU_TOP_SLIDER_VERSION' ) ) {
				$unsupported = true;
		}

		if( !$unsupported ){
			//matchHeight を使わない
			wp_dequeue_script( 'jquery-matchHeight' );

			//imagesLoaded も使わない
			add_filter( 'fudou_imagesloaded_use', '__return_false' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'fudou_denqueue_matchHeight_scripts' );


/**
 *
 * Remove twenty_xxxx use_matchHeight
 * 
 * add_filter( 'fudo_use_matchHeight', '__return_false' ) ;
 *
 * @since Fudousan Plugin 5.5.0
 */
function fudo_twenty_remove_matchHeight() {

		if ( function_exists('wp_get_theme') ) {
			$theme_ob = wp_get_theme();
			$template_name = $theme_ob->template;
		}else{
			$template_name = get_option('template');
		}

		//twentyシリーズ
		if( false !== strpos( $template_name , 'twenty' ) ){

			//未対応プラグインの確認
			$unsupported = false;
			if ( defined('FUDOU_HISTORY_VERSION') ) {
				if ( version_compare( FUDOU_HISTORY_VERSION , '5.3.3', '<') ){
					$unsupported = true;
				}
			}
			if ( !$unsupported && defined('FUDOU_SHORT_CODE_VERSION' ) ) {
				if ( version_compare( FUDOU_SHORT_CODE_VERSION, '5.3.3', '<') ){
					$unsupported = true;
				}else{
					$unsupported = false;
				}
			}
			if ( defined('FUDOU_TOP_SLIDER_VERSION' ) ) {
					$unsupported = true;
			}

			//Remove twenty_xxxx use_matchHeight
			if( !$unsupported ){
				add_filter( 'fudo_use_matchHeight', '__return_false' ) ;
			}
		}
}
add_filter( 'init', 'fudo_twenty_remove_matchHeight' );



/**
 *
 * ヘッダーに imagesloadedを 追加
 *
 * @since Fudousan Plugin 1.8.1
 */
function add_imagesloaded_fudou() {
	if( apply_filters( 'fudou_imagesloaded_use', true ) ){
		//imagesloaded
		wp_enqueue_script( 'fudou_imagesloaded', includes_url( '/js/imagesloaded.min.js' ), array(), '', false );
	}
}
add_action( 'wp_enqueue_scripts', 'add_imagesloaded_fudou' );


/**
 * dashicons_css
 *
 * ver 5.6.0
 */
function fudou_pro_dashicons_css() {
	//dashicons-css
	wp_enqueue_style( 'dashicons', includes_url( '/css/dashicons.min.css' ), array(), '' );
}
add_action( 'wp_enqueue_scripts', 'fudou_pro_dashicons_css' );


/**
 *
 * ヘッダーに jsを 追加
 *
 * @since Fudousan Plugin 1.8.1
 */
function add_util_js_fudou() {

	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_script( 'util', $plugin_url . 'js/util.min.js', array(), '', false );
}
add_action( 'wp_enqueue_scripts', 'add_util_js_fudou', 12 );


/**
 *
 * adminヘッダーに jsを 追加
 *
 * @since Fudousan Plugin 1.7.9
 */
function add_util_js_admin_fudou() {
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_script( 'admin_util', $plugin_url . 'js/util.min.js', array(), '', false );
}
add_action( 'admin_enqueue_scripts', 'add_util_js_admin_fudou' );


/**
 *
 * Contact Form 7 フォームにデーター追加
 *
 * @since Fudousan Plugin 5.9.0
 * @param  array $tag
 * @return array $tag
 */
function wpcf7_form_tag_filter_fudou( $tag ){

	global $post;
	$post_type = '';

	if ( ! is_array( $tag ) ){
		return $tag;
	}


	if ( isset( $post->ID ) ){
		$post_id = $post->ID;
	}else{
		$post_id = isset( $_GET['p'] ) ? myIsNum_f( $_GET['p'] ) : '';
	}

	if( $post_id != "" ){
		$_post = get_post( intval( $post_id ) );
		//post_type
		$post_type = isset( $_post->post_type ) ? $_post->post_type : '';
	}

	if( $post_id != "" && $post_type == 'fudo' ){

		$name = $tag['name'];
		if($name == 'your-subject'){
			//物件番号
			$tag_val  = get_post_meta( $post_id,'shikibesu', true );

			//物件タイトル
			$tag_val .= ' ' . get_the_title( $post_id );

			//物件価格
			if( get_post_meta($post_id, 'seiyakubi', true) != "" ){
				$tag_val .= 'ご成約済';
			}else{

				//非公開の場合
				if( get_post_meta($post_id,'kakakukoukai',true) == "0" ){
					$kakakujoutai_data = get_post_meta ($post_id,'kakakujoutai',true );
					if( $kakakujoutai_data == "1" )	$tag_val .= '相談';
					if( $kakakujoutai_data == "2" )	$tag_val .= '確定';
					if( $kakakujoutai_data == "3" )	$tag_val .= '入札';

					//価格状態 v1.9.0
					$tag_val .= apply_filters( 'fudou_add_kakakujoutai_filter', '', $kakakujoutai_data, $post_id );

				}else{
					$kakaku_data = get_post_meta( $post_id,'kakaku',true );
					if( is_numeric( $kakaku_data ) ){
						if ( function_exists( 'fudou_money_format_ja' ) ) {
							// Money Format 億万円 表示
							$tag_val .= " ". apply_filters( 'fudou_money_format_ja', $kakaku_data );
						}else{
							$tag_val .= " ". floatval( $kakaku_data )/10000;
							$tag_val .= ""."万円";
						}
					}
				}
			}
			$tag['values'] = (array)$tag_val;
		}

		if( is_user_logged_in() ){

			//global $current_user;
			//get_currentuserinfo();
			$current_user = wp_get_current_user( ); 

			if( isset( $current_user->user_email ) ){
				$pos = strpos(  $current_user->user_email , 'pseudo.twitter.com' );
				if ($pos === false) {
					if($name == 'your-email') $tag['values'] = (array)$current_user->user_email;
				}
			}
			if( isset( $current_user->user_lastname ) && isset( $current_user->user_firstname ) ){
				if($name == 'your-name')  $tag['values'] = (array)($current_user->user_lastname .' '. $current_user->user_firstname );
			}
		}
	}
	return $tag;
}
add_filter( 'wpcf7_form_tag', 'wpcf7_form_tag_filter_fudou', 11 );


/**
 *
 * ビジュアルリッチエディターにボタンを追加
 *
 * @since Fudousan Plugin 1.0.0
 * @param  array $buttons
 * @return array $buttons
 */
function ilc_mce_buttons_fudou( $buttons ){
	array_push($buttons, "backcolor", "fontsizeselect", "cleanup");
	return $buttons;
}
add_filter("mce_buttons", "ilc_mce_buttons_fudou");




/*
 * suffix image
 *
 * $attachmentid = apply_filters( 'fudoimg_data_to_attachmentid', $attachmentid, $fudoimg_data, $post_id );
 * Version: 1.9.2
 **/
function fudoimg_data_to_suffix_attachmentid( $attachmentid, $fudoimg_data, $post_id ) {

	global $wpdb;
	if( empty( $attachmentid ) ){
		$sql  = "SELECT PM.post_id";
		$sql .= " FROM $wpdb->postmeta AS PM";
		$sql .= " WHERE PM.meta_key ='_wp_attached_file' ";
		$sql .= " AND ( PM.meta_value = '$fudoimg_data' OR PM.meta_value LIKE '%/$fudoimg_data' )";
		//$sql = $wpdb->prepare($sql,'');
		$meta = $wpdb->get_row( $sql );
		if( !empty($meta) ){
			$attachmentid  =  $meta->post_id;
		}
	}
	return $attachmentid;
}
add_filter( 'fudoimg_data_to_attachmentid', 'fudoimg_data_to_suffix_attachmentid', 10, 3 );



/**
 * Lazy-Loading Images 
 *
 * @since Fudousan Plugin 5.3.4
 */
if ( !function_exists( 'fudou_lazy_loading' )  ) {
	function fudou_lazy_loading() {

		global $fudou_lazy_loading;

		if( false !== apply_filters( 'fudou_lazy_loading_enabled', true ) ){
			$fudou_lazy_loading = 'loading="lazy"';
		}else{
			$fudou_lazy_loading = '';
		}
	}
	add_action( 'init', 'fudou_lazy_loading' );
}


/**
 *
 * 物件番号検索 4
 *
 * @since Fudousan Plugin 5.9.1
 */
function fudou_bukkenmei_search( $search, $wp_query) {

	global $wpdb;
	$search_id = '';

	$post_type = isset($_GET['post_type']) ? esc_attr( $_GET['post_type'] ) : '';

	if( is_search() ){

		$s = isset($_GET['s']) ? esc_sql(esc_attr( stripslashes($_GET['s']))) : '';
		$s = str_replace("&#039;","",$s);
		$s = str_replace(" ","",$s);
		$s = str_replace(";","",$s);
		$s = str_replace(",","",$s);
		$s = str_replace("'","",$s);
		$s = str_replace("\\","",$s);
		//ver5.8.0
		$s = str_replace('"','',$s);
		$s = myLeft( $s, 20 );


		if ( $s !='' ) {

			//物件番号
			$sql  = " SELECT DISTINCT P.ID ";
			$sql .= " FROM $wpdb->posts AS P ";
			$sql .= " INNER JOIN $wpdb->postmeta AS PM_SKB ON P.ID = PM_SKB.post_id ";
			$sql .= " WHERE PM_SKB.meta_key = 'shikibesu' AND PM_SKB.meta_value !='' ";

				/*
				 * キーワード検索
				 * 物件番号検索を あいまい検索に変更する
				 * add_filter( 'fudou_bukkenmei_search_shikibesu_like', '__return_true' );
				 * ver5.9.1
				 */
				if( apply_filters( 'fudou_bukkenmei_search_shikibesu_like', false ) ){
					$sql .= " AND PM_SKB.meta_value LIKE '%$s%'";
				}else{
					$sql .= " AND PM_SKB.meta_value = '$s'";
				}

			$metas = $wpdb->get_results( $sql, ARRAY_A );
			$value_id = '(0';
			if( !empty( $metas ) ) {
				foreach( $metas as $meta ){
					$value_id .= ','. $meta['ID'] . '';
				}
			}
			$value_id .= ')';

			if ( is_admin() && $post_type == 'fudo' ) {

				/*
				 * キーワード検索
				 * 管理画面での 元付/物件名/fudokeyword 検索を行わない
				 * add_filter( 'fudou_bukkenmei_search_admin', '__return_false' );
				 * ver5.9.1
				 */
				if( apply_filters( 'fudou_bukkenmei_search_admin', true ) ){

					//元付
					if( apply_filters( 'fudou_bukkenmei_search_admin_motozukemei', true ) ){
						$sql  = " SELECT DISTINCT P.ID ";
						$sql .= " FROM $wpdb->posts AS P ";
						$sql .= " INNER JOIN $wpdb->postmeta AS PM_MTZ ON P.ID = PM_MTZ.post_id ";
						$sql .= " WHERE PM_MTZ.meta_key = 'motozukemei' AND PM_MTZ.meta_value !='' AND PM_MTZ.meta_value LIKE '%$s%'";
						$sql .= " OR ( P.ID IN $value_id )";
						$metas = $wpdb->get_results( $sql, ARRAY_A );

						if( !empty( $metas ) ) {
							$value_id = '(0';
							foreach( $metas as $meta ){
								$value_id .= ','. $meta['ID'] . '';
							}
							$value_id .= ')';
						}
					}

					if( apply_filters( 'fudou_bukkenmei_search_admin_bukkenmei', true ) ){
						//物件名
						$sql  = " SELECT DISTINCT P.ID ";
						$sql .= " FROM $wpdb->posts AS P ";
						$sql .= " INNER JOIN $wpdb->postmeta AS PM_BKM ON P.ID = PM_BKM.post_id ";
						$sql .= " WHERE ( PM_BKM.meta_key = 'bukkenmei' AND PM_BKM.meta_value !='' AND PM_BKM.meta_value LIKE '%$s%' )";
						$sql .= " OR ( P.ID IN $value_id )";
						$metas = $wpdb->get_results( $sql, ARRAY_A );

						if( !empty( $metas ) ) {
							$value_id = '(0 ';
							foreach( $metas as $meta ){
								$value_id .= ','. $meta['ID'] . '';
							}
							$value_id .= ')';
						}
					}

					if( apply_filters( 'fudou_bukkenmei_search_admin_keywords', true ) ){
						//fudokeywords
						$sql  = " SELECT DISTINCT P.ID ";
						$sql .= " FROM $wpdb->posts AS P ";
						$sql .= " INNER JOIN $wpdb->postmeta AS PM_KYD ON P.ID = PM_KYD.post_id ";
						$sql .= " WHERE ( PM_KYD.meta_key = 'fudokeywords' AND PM_KYD.meta_value !='' AND PM_KYD.meta_value LIKE '%$s%' )";
						$sql .= " OR ( P.ID IN $value_id )";
						$metas = $wpdb->get_results( $sql, ARRAY_A );

						if( !empty( $metas ) ) {
							$value_id = '(0 ';
							foreach( $metas as $meta ){
								$value_id .= ','. $meta['ID'] . '';
							}
							$value_id .= ')';
						}
					}
				}

			}

			//物件IDが見つかった場合
			if( $value_id != '(0)' ){
				$value = " OR ( $wpdb->posts.ID IN $value_id )";
				$search = str_replace( ')))', ') '. $value . '))', $search );
			}
		}
	}
	return $search;
}
add_filter('posts_search', 'fudou_bukkenmei_search', 10, 2);


function fudou_shikibesu_search_distinct( $distinct, $query ){
	if ( is_search() ) {
		if( isset($_GET['s']) && $_GET['s'] != '' ){
			return 'DISTINCT';
		}
	}
	return $distinct;
}
add_filter( 'posts_distinct', 'fudou_shikibesu_search_distinct', 10, 2 );



/**
 *
 * SEO keywords description.
 *
 * @since Fudousan Plugin 5.9.0
 */
function keywords_description_fudou() {
	global $post;
	if ( is_single() ){
		if( isset( $post->ID ) && get_post_meta( $post->ID, 'fudokeywords', true ) ){
			echo "\n";
			echo '<meta name="keywords" content="' . esc_html( get_post_meta( $post->ID, 'fudokeywords', true ) ) . '">';
		}

		if( isset( $post->ID ) && get_post_meta( $post->ID, 'fudodescription',true ) ){
			echo "\n";
			echo '<meta name="description" content="' . esc_html( get_post_meta( $post->ID, 'fudodescription', true ) ) . '">';
		}
      }
}
add_action('wp_head', 'keywords_description_fudou');



/**
 * トップ SEO description
 *
 * @since Fudousan Plugin 5.9.0
 */
function add_top_header_description_fudou() {
	//ヘッダ埋め込みタグ
	if ( is_front_page() || is_home() ){
		if( get_option( 'fudo_top_meta_description' ) ){
			echo '<meta name="description" content="' . esc_html( get_option( 'fudo_top_meta_description' ) ) . '">';
			echo "\n";
		}
	}
}
add_action('wp_head', 'add_top_header_description_fudou');



/*
 * Money Format 億・万円 表示
 *
 * @since Fudousan Plugin 5.9.0
 * @param str $kakaku_data (max 99999999999999)
 * @param int $empty_process
 * @return srt $value
 */
function fudou_money_format_ja( $kakaku_data, $empty_process=0 ){

	$formated_kakaku = '';

	//数値チェック
	$kakaku_data = floor( myIsNum_f( $kakaku_data ) );

	//空の場合
	if( $kakaku_data === '' ){
		return '';
	}

	//0の場合 $empty_process:1 0円表示
	if( !$kakaku_data && !$empty_process ){
		return '';
	}

	$value = '';
        $pos = mb_strlen( $kakaku_data,"utf-8" ) ;

	$cho = intval( myRight( myLeft( $kakaku_data, $pos-12 ), 4 ) );
	$oku = intval( myRight( myLeft( $kakaku_data, $pos-8 ), 4 ) );
	$man = intval( myRight( myLeft( $kakaku_data, $pos-4 ), 4 ) );
	$yen = intval( myRight( $kakaku_data,4 ) );

	if( $kakaku_data > apply_filters( 'fudou_money_format_ja_baibai', 2000000 ) ){	//売買

		if ( $cho ) $value .= number_format( $cho ) . '兆';
		if ( $oku ) $value .= number_format( $oku ) . '億';
		if ( $man ) $value .= number_format( $man ) . '万';
		if ( $yen ) $value .= number_format( $yen ) . '';
		$formated_kakaku = $value . '円 ';

	}else{					//賃貸

		if ( $yen ) $yen = $yen/10000 ;
		if ( $man ){
			$value .= number_format( ($man + $yen), 4 );
			$value = preg_replace( "/\.?0+$/","", $value );
			$formated_kakaku = ( $value ) ? $value . "万円 " : "";
		}else{
			$value = number_format( $kakaku_data );
			$formated_kakaku = $value . '円 ';
		}
	}

	//ver5.9.0
	return apply_filters( 'formated_kakaku', $formated_kakaku );
}
add_filter( 'fudou_money_format_ja', 'fudou_money_format_ja' );


/*
 * 少額用カンマ区切り
 *
 * @since Fudousan Plugin 5.0.2
 * @param str $kakaku_data
 * @param int $decimals
 * @return srt $kakaku_data
 */
function fudou_number_format( $kakaku_data, $decimals=0 ) {
	if( is_numeric( myIsNum_f( $kakaku_data ) ) ){
		$kakaku_data = number_format( myIsNum_f( $kakaku_data ), $decimals );
	}
	return $kakaku_data;
}
add_filter( 'fudou_number_format', 'fudou_number_format', 10, 2 );



/**
 *
 * 半角数字チェック 整数/小数点
 *
 * @since Fudousan Plugin 5.8.0
 * @param num|string|array $value.
 * @return num|array $value
 */
if (!function_exists('myIsNum_f')) {
	function myIsNum_f( $value ) {
		$data = array();
		if( is_array( $value ) ){
			foreach ( $value as $k => $v ) {
				$v = str_replace(array("\r\n","\n","\r"), '', $v );
				if ( is_array($v) ){
					$data[$k] = myIsNum_f( $v );
				}else{
					if ( preg_match( "/\A([0-9]\d*|0)(\.\d+)?\z/", $v) ) {
						//$data[] = $v;
						$data[] = myLeft( $v, 14 );
					}
				}
			}
		}else{
			$value = str_replace(array("\r\n","\n","\r"), '', $value );
			if ( preg_match( "/\A([0-9]\d*|0)(\.\d+)?\z/", $value ) ) {
				//return $value;
				return  myLeft( $value, 14 );
			}
		}
		if( !empty($data) ){
			return (array)$data;
		}else{
			return '';
		}
	}
}

/**
 *
 * 正規表現 URL アドレス の判別
 *
 * @since Fudousan Plugin 1.5.0
 * @param string $value.
 * @return bool $value
 */
if (!function_exists('checkurl_fudou')) {
	function checkurl_fudou( $url ){
		if( preg_match('/^(http|https):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i' , $url )){
			return true;
		}
		return false;
	}
}

/**
 *
 * Adds template class to the array of body classes.
 *
 * @since Fudousan Plugin 5.6.1
 */
function fudou_template_body_class( $classes ) {

	global $wp_query;
	$object = $wp_query->get_queried_object();
	$post_type = isset( $object->post_type ) ? $object->post_type : '';
	$post_id   = isset( $object->ID ) ? $object->ID : 0;

	//成約 class
	if( $post_type == 'fudo' && get_post_meta( $post_id, 'seiyakubi', true ) != '' ){
		$classes[] = 'seiyaku';
	}
	//会員 class
	if( $post_type == 'fudo' && get_post_meta( $post_id, 'kaiin', true ) > 0 ){
		$classes[] = 'kaiin';
	}

	//テーマ class
	if ( function_exists('wp_get_theme') ) {
		$theme_ob = wp_get_theme();
		$template_name = $theme_ob->template;
	}else{
		$template_name = get_option('template');
	}

	if ( $template_name != '' ){
		//8market 例外
		if( $template_name == '8market' ){
			$template_name = 'hachimarket';
		}
		$classes[] = $template_name;
	}

	return $classes;
}
add_filter( 'body_class', 'fudou_template_body_class' );



/**
 *
 * Adds theme class to the array of admin body classes.
 *
 * @since Fudousan Plugin 5.2.0
 */
function fudou_theme_admin_body_class( $admin_body_class ) {

	// theme check
	if ( function_exists('wp_get_theme') ) {
		$theme_ob = wp_get_theme();
		$template_name = $theme_ob->template;
	}else{
		$template_name = get_option('template');
	}

	if( $template_name ){
		$admin_body_class .= '' . apply_filters( 'fudou_theme_admin_body_class', $template_name, $admin_body_class );
	}
	return $admin_body_class;
}
add_filter( 'admin_body_class', 'fudou_theme_admin_body_class' );



/**
 * content_width 設定
 *
 * @since Fudousan Plugin 5.0.0
 * @global int $content_width
 */
function fudou_content_width() {

	global $content_width;
	global $wp_query;

	$object = $wp_query->get_queried_object();

	if( !empty( $object->post_type ) ){

		// theme check
		if ( function_exists('wp_get_theme') ) {
			$theme_ob = wp_get_theme();
			$template_name = $theme_ob->template;
		}else{
			$template_name = get_option('template');
		}

		//2020
		if( $template_name == 'twentytwenty' ){
			$content_width = 760;
		}

		//2017
		if( $template_name == 'twentyseventeen' ){
			if( $object->post_type == 'fudo' ){
				$content_width = 594;
			}
			if( $object->post_type == 'page' ){
				$content_width = 633;
			}
			if( $object->post_type == 'post' ){
				$content_width = 594;
			}
		}

		//2016
		if( $template_name == 'twentysixteen' ){
			if( $object->post_type == 'fudo' ){
				$content_width = 840;
			}
			if( $object->post_type == 'page' ){
				$content_width = 840;
			}
			if( $object->post_type == 'post' ){
				$content_width = 580;
			}
		}

		//2015
		if( $template_name == 'twentyfifteen' ){
			if( $object->post_type == 'fudo' ){
				$content_width = 660;
			}
			if( $object->post_type == 'page' ){
				$content_width = 660;
			}
			if( $object->post_type == 'post' ){
				$content_width = 660;
			}
		}

		//2014
		if( $template_name == 'twentyfourteen' ){
			if( $object->post_type == 'fudo' ){
				$content_width = 630;
			}
			if( $object->post_type == 'page' ){
				$content_width = 630;
			}
			if( $object->post_type == 'post' ){
				$content_width = 630;
			}
		}

		//2013
		if( $template_name == 'twentythirteen' ){
			if( $object->post_type == 'fudo' ){
				$content_width = 604;
			}
			if( $object->post_type == 'page' ){
				$content_width = 630;
			}
			if( $object->post_type == 'post' ){
				$content_width = 604;
			}
		}

		//2012
		if( $template_name == 'twentytwelve' ){
			if( $object->post_type == 'fudo' ){
				$content_width = 703;
			}
			if( $object->post_type == 'page' ){
				$content_width = 703;
			}
			if( $object->post_type == 'post' ){
				$content_width = 703;
			}
		}

		//2011
		if( $template_name == 'twentyeleven' ){
			if( $object->post_type == 'fudo' ){
				$content_width = 658;
			}
			if( $object->post_type == 'page' ){
				$content_width = 960;
			}
			if( $object->post_type == 'post' ){
				$content_width = 960;
			}
		}

		//2010
		if( $template_name == 'twentyten' ){
			if( $object->post_type == 'fudo' ){
				$content_width = 682;
			}
			if( $object->post_type == 'page' ){
				$content_width = 700;
			}
			if( $object->post_type == 'post' ){
				$content_width = 700;
			}
		}
	}
}
add_action( 'template_redirect', 'fudou_content_width', 10 );



/** 
 * JetPack パブリサイズにカスタム投稿タイプ追加
 *
 * @since Fudousan Plugin 1.7.0
 */
function fudou_jetpack_custom_posttype_publicize(){
	add_post_type_support( 'fudo', 'publicize' );
}
add_action( 'init', 'fudou_jetpack_custom_posttype_publicize' );

/** 
 * JetPack Sitemapにカスタム投稿タイプ追加
 *
 * JetPack 4.8.0
 * @since Fudousan Plugin 1.7.14
 */
function fudou_jetpack_sitemap_post_types( $post_types ) {

	if( array_search( 'fudo', $post_types ) === false ){
		$post_types[] = 'fudo';
	}
	return $post_types;
}
add_filter( 'jetpack_sitemap_post_types', 'fudou_jetpack_sitemap_post_types' );
add_filter( 'jetpack_sitemap_news_sitemap_post_types', 'fudou_jetpack_sitemap_post_types' );



/** 
 * fudou Simple Minify
 *
 * @since Fudousan Plugin 5.6.1
 */
function fudou_minify_buffer( $buffer, $type='' ) {

	// Delete character code
	$buffer = str_replace( '@charset "utf-8";', '', $buffer );
	$buffer = str_replace( '@charset"utf-8";', '', $buffer );

	// Delete comment.
	$buffer = preg_replace( '/\t\/\/.+$/m', '', $buffer );				// tab + //
	$buffer = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer );		// /*～*/

	// Remove tabs and line breaks.
	$buffer = str_replace( array("\r\n", "\r", "\n", "\t" ), '', $buffer );

	// Remove spaces.
	$buffer = str_replace( array( '  ', '    ', '    '), ' ', $buffer );
	$buffer = str_replace( array( '  ', '    ', '    '), ' ', $buffer );
	$buffer = str_replace( array( '  ', '    ', '    '), ' ', $buffer );

	$buffer = "\n" . $buffer . "\n";

	return $buffer;
}
add_filter( 'fudou_minify_buffer', 'fudou_minify_buffer', 10, 2 );



/**
 *
 * admin login user_check fudous.
 * checks for USER_AGENT,Dummy_Item,CSRF,wp-submit.
 *
 * @since Fudousan Plugin 1.7.7
 *
 */
if ( !function_exists('fudou_add_spam_login_user_check') && !function_exists('fudou_add_spam_login_nonce') ) {
	// admin login user_check fudou
	function fudou_add_spam_login_user_check() {
		$is_spams = false;
		//Empty USER AGENT
		$useragent = esc_attr($_SERVER["HTTP_USER_AGENT"]);
		if ( empty($useragent) ) $is_spams = true;

		$user_login = isset( $_POST["log"] ) ? $_POST["log"] : '';
		if(!$user_login) $user_login = isset( $_GET["log"] ) ? $_GET["log"] : '';
		$user_pass  = isset( $_POST["pwd"] ) ? $_POST["pwd"] : '';
		if(!$user_pass) $user_pass  = isset( $_GET["pwd"] ) ? $_GET["pwd"] : '';

		//Dummy Item
		$user_url = isset( $_POST["url"] ) ? $_POST["url"] : '';
		if(!$user_url) $user_url = isset( $_GET["url"] ) ? $_GET["url"] : '';
		if ( $user_url != '' )  $is_spams = true;

		//verify_nonce
		$login_nonce = isset($_POST['fudou_login_nonce']) ?  $_POST['fudou_login_nonce'] : '';
		if( !$login_nonce ) $login_nonce = isset($_GET['fudou_login_nonce']) ?  $_GET['fudou_login_nonce'] : '';
		if ( !$is_spams && $user_login && !$login_nonce )  $is_spams = true;
		if ( !$is_spams && $user_login && !wp_verify_nonce( $login_nonce, 'fudou_login_nonce') )  $is_spams = true;

		//wp-submit
		$wp_submit = isset($_POST['wp-submit']) ?  $_POST['wp-submit'] : '';
		if( !$wp_submit ) $wp_submit = isset( $_GET["wp-submit"] ) ? $_GET["wp-submit"] : '';
		if ( !$is_spams && $user_login && !$wp_submit )  $is_spams = true;
		//if ( !$is_spams && $user_login && $wp_submit == '%E3%83%AD%E3%82%B0%E3%82%A4%E3%83%B3' )  $is_spams = true;

		if ( $is_spams ){
			status_header( 403 );
			exit();
		}
	}
	add_action( 'login_init', 'fudou_add_spam_login_user_check', 2 );

	// admin login user_check verify_nonce & dummy item
	function fudou_add_spam_login_nonce() {
		echo '<input type="hidden" name="fudou_login_nonce" value="' .wp_create_nonce( 'fudou_login_nonce' ) . '" />';
		echo '<p class="form-url" style="display:none"><label>URL</label><input type="text" name="url" id="url" class="input" size="30" /></p>';
	}
	add_action( 'login_form', 'fudou_add_spam_login_nonce', 10 );
}

