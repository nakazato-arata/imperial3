<?php
/**
 * Fudou custom post embed. 
 *
 * When a post is embedded in an iframe, this file is used to
 * create the output.
 *
 * @package WordPress4.4
 * @subpackage oEmbed
 * @subpackage Fudousan Plugin
 * Version: 1.7.0
 */


/**
 * Filter the template used for embedded posts.
 * テンプレートを差し替える
 *
 * Version: 1.6.8
 * template-loader.php
 * @param string $template Path to the template file.
 */
function fudou_embed_template( $template ){

	//deregister thickbox
	wp_deregister_script( 'thickbox' );
	wp_deregister_style( 'thickbox' );

	global $wp;
	global $wpdb;
	global $post_id;
	global $post_status;

	$post_id   = isset($wp->query_vars['p']) ? $wp->query_vars['p'] :  '' ;
	$post_name = isset($wp->query_vars['name']) ? $wp->query_vars['name'] : '' ;
	$post_type = isset($wp->query_vars['post_type']) ? $wp->query_vars['post_type'] : '';

	if( $post_type == 'fudo' ){

		if ( $post_id ) {
			$sql  =  "SELECT P.ID,P.post_status";
			$sql .=  " FROM $wpdb->posts AS P";
			$sql .=  " WHERE P.ID  = %d ";
			$sql .=  " AND P.post_type='fudo' ";
			$sql .=  " AND P.post_password='' ";
		//	$sql .=  " AND P.post_status='publish'";
			$sql = $wpdb->prepare( $sql, $post_id );
			$metas = $wpdb->get_row( $sql );

			if(!empty($metas)) {
				$post_status = $metas->post_status;
				$post_id  =  $metas->ID;
			}else{
				$post_status = '';
				$post_id  =  '';
			}
		}


		if ( is_numeric( $post_name ) && !$post_id && !$post_status ) {
			$sql  =  "SELECT P.ID,P.post_status";
			$sql .=  " FROM $wpdb->posts AS P";
			$sql .=  " WHERE P.ID  = %d ";
			$sql .=  " AND P.post_type='fudo' ";
			$sql .=  " AND P.post_password='' ";
		//	$sql .=  " AND P.post_status='publish'";
			$sql = $wpdb->prepare( $sql, $post_name );
			$metas = $wpdb->get_row( $sql );

			if(!empty($metas)) {
				$post_status = $metas->post_status;
				$post_id  =  $metas->ID;
			}else{
				$post_status = '';
				$post_id  =  '';
			}
		}


		if ( $post_name && !$post_status ) {
			$sql  =  "SELECT P.ID,P.post_status";
			$sql .=  " FROM $wpdb->posts AS P";
			$sql .=  " WHERE P.post_name  = %s ";
			$sql .=  " AND P.post_type='fudo' ";
			$sql .=  " AND P.post_password='' ";
		//	$sql .=  " AND P.post_status='publish'";
			$sql = $wpdb->prepare( $sql, $post_name );
			$metas = $wpdb->get_row( $sql );
			if(!empty($metas)) {
				$post_status = $metas->post_status;
				$post_id  =  $metas->ID;
			}else{
				$post_status = '';
				$post_id  =  '';
			}
		}


		if( $post_type == 'fudo' && $post_id && $post_status == 'publish' ){
			$template = plugin_dir_path( __FILE__ ) . 'fudou_embed-template.php';
		}
	}
	return $template;
}
add_filter( 'embed_template', 'fudou_embed_template' );



/**
 * Filter the embed HTML output for a given post.
 * <blockquote>～</blockquote> 内のタイトルを変更する。
 *
 * Version: 1.6.8
 *
 * embed-functions.php
 * @param string  $output The default HTML.
 * @param WP_Post $post   Current post object.
 */
function fudou_get_post_embed_html( $output, $post ){

	if( $post->ID && $post->post_type == 'fudo' && $post->post_status == 'publish' ){

		//会員
		if( get_post_meta( $post->ID, 'kaiin', true ) > 0 ){
			$kaiin  = 1;
			$kaiin2 = 0;	//ユーザー別会員物件リスト
		}else{
			$kaiin  = 0;
			$kaiin2 = 1;	//ユーザー別会員物件リスト
		}

		if ( my_custom_kaiin_view( 'kaiin_title', $kaiin, $kaiin2 ) ){
		}else{
			$output = str_replace( get_the_title( $post->ID ), '会員物件', $output );
		}
	}

	return $output;
}
add_filter( 'embed_html', 'fudou_get_post_embed_html', 10, 2 );

