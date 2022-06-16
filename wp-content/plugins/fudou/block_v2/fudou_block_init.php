<?php
/*
 * Blocks Initializer
 *
 * 不動産プラグイン(本体)ブロック
 * @package WordPress 5.8
 * @subpackage Fudousan Plugin
 * Version: 5.8.1
 * @package create-block
 * apiVersion 2,
*/



	//条件検索(固定ページ用)
	include 'block_fudou_page_jyoken.php';


	/*
	 * 管理画面側 block用 script
	 */
	function admin_fudou_block_script() {

		global $wpdb;

		echo '<script type="text/javascript">';

		//不動産町名検索プラグイン 条件検索(固定ページ)
		global $is_fudouchoumei;
		if( $is_fudouchoumei ){
			echo 'var is_fudouchoumei = true;';
		}else{
			echo 'var is_fudouchoumei = false;';
		}

		//不動産校区プラグイン 条件検索(固定ページ)
		global $is_fudoukouku;
		if( $is_fudoukouku ){
			echo 'var is_fudoukouku = true;';
		}else{
			echo 'var is_fudoukouku = false;';
		}

		//不動産イン条件坪単価プラグイン 条件検索(固定ページ)
		global $is_fudou_injyoken_tsubotanka_seach;
		if( $is_fudou_injyoken_tsubotanka_seach ){
			echo 'var is_fudou_injyoken_tsubotanka_seach = true;';
		}else{
			echo 'var is_fudou_injyoken_tsubotanka_seach = false;';
		}

		//不動産イン条件カテゴリプラグイン 条件検索(固定ページ)
		global $is_fudouincat;
		if( $is_fudouincat ){
			echo 'var is_fudouincat = true;';
		}else{
			echo 'var is_fudouincat = false;';
		}


		//不動産イン条件利回りプラグイン 条件検索(固定ページ)
		global $is_fudouinrim;
		if( $is_fudouinrim ){
			echo 'var is_fudouinrim = true;';
		}else{
			echo 'var is_fudouinrim = false;';
		}

		//不動産会員プラグイン 物件ショートコード
		global $is_fudoukaiin;
		if( $is_fudoukaiin ){
			echo 'var is_fudoukaiin = true;';
		}else{
			echo 'var is_fudoukaiin = false;';
		}

		//不動産会員VIPプラグイン 条件検索(固定ページ)
		global $is_fudoukaiin_vip;
		if( $is_fudoukaiin_vip ){
			echo 'var is_fudoukaiin_vip = true;';
		}else{
			echo 'var is_fudoukaiin_vip = false;';
		}

		//不動産イン条件成約プラグイン 条件検索(固定ページ)
		global $is_fudou_injyoken_seiyaku_seach;
		if( $is_fudou_injyoken_seiyaku_seach ){
			echo 'var is_fudou_injyoken_seiyaku_seach = true;';
		}else{
			echo 'var is_fudou_injyoken_seiyaku_seach = false;';
		}

		//営業県リスト (カスタマイズ条件検索、物件ショートコード)
		echo "var EigyoukenSelections = [];";
		//営業県
		$ken_count = 0;
		$shozaichiken_data_e = '0';
		for( $i=1; $i<48 ; $i++ ){
			if( get_option('ken'.$i) != ''){
				$shozaichiken_data_e .= ','.get_option('ken'.$i);
				$ken_count ++;
			}
		}
		if( $ken_count == 0 ){
			echo "EigyoukenSelections.push({label: '営業県を設定してください', value: ''});";
		}else{
			echo "EigyoukenSelections.push({label: '県設定', value: ''});";
			$sql = "SELECT middle_area_id, middle_area_name FROM " . $wpdb->prefix . DB_KEN_TABLE . " WHERE middle_area_id in ( $shozaichiken_data_e ) ORDER BY middle_area_id";
			//$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql, ARRAY_A );
			if(!empty($metas)) {
				foreach ( $metas as $meta ) {
					$meta_id = $meta['middle_area_id'];
					$meta_valu = $meta['middle_area_name'];

					echo "EigyoukenSelections.push({label: '" . $meta_valu . "', value: '" . sprintf( "%02d", $meta_id ) . "'});";
				}
			}
		}

		//路線リスト (物件ショートコード)
		echo "var RosenSelections = [];";
		if( $ken_count == 0 ){
			echo "RosenSelections.push({label: '営業県を設定してください', value: ''});";
		}else{
			echo "RosenSelections.push({label: '路線設定', value: ''});";
			$sql = "SELECT DISTINCT DTR.rosen_id, DTR.rosen_name";
			$sql = $sql . " FROM " . $wpdb->prefix . DB_ROSENKEN_TABLE . " AS DTAR";
			$sql = $sql . " INNER JOIN " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR ON DTAR.rosen_id = DTR.rosen_id";
			$sql = $sql . " WHERE DTAR.middle_area_id in (". $shozaichiken_data_e .") ";
			$sql = $sql . " ORDER BY DTR.rosen_name";
			//$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql, ARRAY_A );
			if(!empty($metas)) {
				foreach ( $metas as $meta ) {
					$meta_id = $meta['rosen_id'];
					$meta_valu = $meta['rosen_name'];
					echo "RosenSelections.push({label: '" . $meta_valu . "', value: '" . sprintf( "%02d", $meta_id ) . "'});";
				}
			}
		}

		echo '</script>';

	}
	//add_action( 'admin_print_scripts-post.php', 'admin_fudou_block_script' );
	//add_action( 'admin_print_scripts-post-new.php', 'admin_fudou_block_script' );
	add_action( 'admin_print_scripts', 'admin_fudou_block_script' );



	/**
	 * Registers all block assets so that they can be enqueued through the block editor
	 * in the corresponding context.
	 *
	 * Version: 5.8.1
	 */
	function fudou_block_init() {

		$dir = __DIR__;

		$script_asset_path = "$dir/build/index.asset.php";
		if ( ! file_exists( $script_asset_path ) ) {
			throw new Error(
				'You need to run `npm start` or `npm run build` for the "nendeb/block-slider" block first.'
			);
		}

		$script_asset = require( $script_asset_path );

		wp_register_script(
			'fudou-block-js',
			plugins_url( '/build/index.js', __FILE__ ),
			$script_asset['dependencies'],
			$script_asset['version']
		);
	}
	add_action( 'init', 'fudou_block_init' );


	/*
	 * block_categories
	 * Returns all the block categories that will be shown in the block editor.
	 * wp-admin/includes/post.php get_block_categories()
	 *
	 * @since 5.0.0
	 * ver 5.8.0 block_categories_all
	 * @param array[] Array of block categories.
	 * @return array[] Array of block categories.
	 */
	if ( !function_exists( 'fudou_plugin_block_categories' ) ) {

		function fudou_plugin_block_categories( $categories ) {

			$fudou_categories = 
				array(
				'slug' => 'fudou',
				'title' => '不動産プラグイン',
				'icon'  => null,
			);

			$category_slugs = wp_list_pluck( $categories, 'slug' );
 
			if ( ! in_array( $fudou_categories['slug'], $category_slugs, true ) ) {
				$categories = array_merge(
					$categories,
					array(
						array(
							'title' => $fudou_categories['title'],	// Required
							'slug'  => $fudou_categories['slug'],	// Required
							'icon'  => $fudou_categories['icon'],	// Slug of a WordPress Dashicon or custom SVG
						),
					)
				);
			}

			return $categories;
		}

		// ver5.8.0 block_categories_all
		if ( function_exists( 'get_default_block_categories' ) && function_exists( 'get_block_editor_settings' ) ) {
			add_filter( 'block_categories_all', 'fudou_plugin_block_categories' );
		}else{
			add_filter( 'block_categories', 'fudou_plugin_block_categories' );
		}
	}


