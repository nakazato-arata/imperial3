<?php
/**
 * The Template for displaying fudou single posts.
 *
 * @package WordPress5.9
 * @subpackage Fudousan Plugin
 * Version: 5.9.0
 */



	global $is_fudouktai,$is_fudoukaiin;
	global $is_fudoukouku;
	global $fudou_lazy_loading;

	$post_id = isset( $_GET['p'] ) ? myIsNum_f( $_GET['p'] ) : '';
	if( empty($post_id) ){
		$post_id = $post->ID;
	}

	//会員2
	$kaiin = 0;
	if( !is_user_logged_in() && get_post_meta($post_id, 'kaiin', true) > 0 ) $kaiin = 1;
	//ユーザー別会員物件リスト
	$kaiin2 = users_kaiin_bukkenlist( $post_id, get_option( 'kaiin_users_rains_register' ), get_post_meta( $post_id, 'kaiin', true ) );

	//Disable AMP canonical
	if( $kaiin == 1 ){
		//add_filter( 'amp_frontend_show_canonical', '__return_false' );
		remove_action( 'wp_head', 'amp_add_amphtml_link' );	//AMP ver2.0.0
	}


	//title変更 会員
	if ( !my_custom_kaiin_view('kaiin_title',$kaiin,$kaiin2) ){
		//WordPress ～4.3
		add_filter( 'wp_title', 'add_post_type_wp_title_ka' );
		//WordPress 4.4～
		add_filter( 'pre_get_document_title', 'add_post_type_wp_title_ka' );
		//All-in-One-SEO-Pack
		add_filter( 'aioseop_title', 'add_post_type_wp_title_ka' );
	}
	function add_post_type_wp_title_ka( $title = '' ) {
		/**
		 * Filter the separator for the document title Fudou.
		 * @since 4.4.0
		 * @param string $sep Document title separator. Default '-'.
		 */
		$sep = apply_filters( 'document_title_separator_fudou', '-' );
		$title =  '会員物件 ' . $sep . ' '. get_bloginfo( 'name', 'display' );
		return $title;
	}

	$post_id_array = get_post( $post_id ); 
	$title    = $post_id_array->post_title;
	$excerpt  = $post_id_array->post_excerpt;
	$content  = $post_id_array->post_content;
	$modified = $post_id_array->post_modified;

	//newup_mark
	$newup_mark = get_option('newup_mark');
	if($newup_mark == '') $newup_mark=14;

	$post_modified_date =  vsprintf("%d-%02d-%02d", sscanf($modified, "%d-%d-%d"));
	$post_date =  vsprintf("%d-%02d-%02d", sscanf($post_id_array->post_date, "%d-%d-%d"));

	$newup_mark_img =  '';
	if( $newup_mark != 0 && is_numeric($newup_mark) ){

		if( ( abs(strtotime($post_modified_date) - strtotime(date("Y/m/d"))) / (60 * 60 * 24) ) < $newup_mark ){
			if($post_modified_date == $post_date ){
				$newup_mark_img = '<div class="new_mark">new</div>';
			}else{
				$newup_mark_img = '<div class="new_mark">up</div>';
			}
		}
	}

	//width height ver5.5.0 single
	$default_single_width  = apply_filters( 'fudo_single_thumbnail_width', 150 );
	$default_single_height = apply_filters( 'fudo_single_thumbnail_height', 150 );
	$defaultimg_single_width_height = apply_filters( 'defaultimg_single_width_height', ' width="' . $default_single_width . '" height="' . $default_single_height . '"' );


	//会員登録 URL生成 ver1.9.4

		//SSL URL
		$fudou_ssl_site_url = get_option('fudou_ssl_site_url');

		if( defined('FUDOU_SSL_MODE') && FUDOU_SSL_MODE == 1 && $fudou_ssl_site_url !='' ){
			$site_register_url = $fudou_ssl_site_url;
		}else{
			$site_register_url = get_option('siteurl');
		}

		//会員登録URL
		$kaiin_register_url = $site_register_url . '/wp-content/plugins/fudoukaiin/wp-login.php?action=register';

		//Add thickbox class
		if ( wp_is_mobile() ) {
			$thickbox_class = '';
		}else{
			$kaiin_register_url .= '&KeepThis=true&TB_iframe=true&width=400&height=500';
			$thickbox_class = ' class="thickbox"';
		}

		/*
		 * 会員登録 URLフィルター
		 * ver 1.9.1
		 */
		$kaiin_register_url	= apply_filters( 'fudou_kaiin_register_url', $kaiin_register_url );

		// 会員登録 URLタグ
		$kaiin_register_url_tag = '<a href="' . $kaiin_register_url . '" ' . $thickbox_class . ' rel="nofollow">';

		/*
		 * 会員登録 URLタグフィルター
		 * ver 1.9.3
		 */
		$kaiin_register_url_tag     = apply_filters( 'fudou_kaiin_register_url_tag', $kaiin_register_url_tag );

	// .会員登録 URL生成


	/*
	 * VIP 物件詳細ページ非表示 404
	 *
	 * apply_filters( 'fudou_kaiin_vip_single_seigen', $view, $post_id );
	 *
	 * single_fudoXXXX.php
	 * 
	 * @param bool $view	true:表示  false: 非表示(404)
	 * Version: 1.7.5
	 */
	if( ! apply_filters( 'fudou_kaiin_vip_single_seigen', true, $post_id ) ){
		status_header( 404 );
		//header( "location: 404.php" );
		wp_redirect( home_url( '/404.php' ) );
		exit();
	}



