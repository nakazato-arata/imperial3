<?php
/**
 * Contains the post embed template. 
 *
 * When a post is embedded in an iframe, this file is used to
 * create the output.
 *
 * @package WordPress5.3
 * @subpackage oEmbed
 * @subpackage Fudousan Plugin
 * Version: 5.3.4
 */



if ( ! headers_sent() ) {
	header( 'X-WP-embed: true' );
}

	// Remove wp-jquery-lightbox scripts and styles
	remove_action('wp_print_styles',  'jqlb_css');	
	remove_action('wp_print_scripts', 'jqlb_js');


	/**
	 * embed用のCSSを読込むように変更する
	 *
	 * @since 4.4.0
	 * License: GPLv2 or later
	 */
	function nendebcom_embed_styles(){

		global $is_fudoukaiin_vip;
		// Add wp-embed-template used in the original stylesheet.
		wp_enqueue_style( 'wp-embed-template_org', plugin_dir_url( __FILE__ ) . 'fudou_embed-template.css' );

		if( $is_fudoukaiin_vip ){
			wp_enqueue_style( 'fudoukaiin-vip', plugins_url() .'/fudoukaiin_vip/css/fudoukaiin_vip.css' );
		}
	}
	add_filter( 'embed_head', 'nendebcom_embed_styles' );
	// Remove wp-embed-template used in the main stylesheet.
	//remove_action( 'embed_head', 'print_embed_styles' );



	/*
	 * タイトル文字をパーツごと変更する。
	 *
	 * @since WordPress 4.4.0
	 * @return array title.
	 *
	 */
	function fudou_embed_document_title_parts( $title ){
		global $post_id;
		global $post_status;

		if( $post_status == 'publish' ){

			//会員
			if( get_post_meta( $post_id, 'kaiin', true ) > 0 ){
				$kaiin  = 1;
				$kaiin2 = 0;	//ユーザー別会員物件リスト
			}else{
				$kaiin  = 0;
				$kaiin2 = 1;	//ユーザー別会員物件リスト
			}

			if ( my_custom_kaiin_view( 'kaiin_title', $kaiin, $kaiin2 ) ){
				$post_title = esc_attr( str_replace("　", " ", get_the_title( $post_id ) ) );
			}else{
				$post_title = '会員物件';
			}

			$title['title'] = $post_title;	//Title
		}else{
			$title['title'] = '';		//Title
		}

		return $title;
	}
	add_filter( 'document_title_parts', 'fudou_embed_document_title_parts' );



	/*
	 * 404対策
	 *
	 */
	function fudo_body_embed_class($class) {
		$class[0] = 'single single-fudo';
		return $class;
	}
	if( $post_type == 'fudo' && $post_status == 'publish' ){
		status_header( 200 );
		add_filter('body_class', 'fudo_body_embed_class');
	}


		$post_url   = esc_url( get_permalink( $post_id ) );

		//会員
		if( get_post_meta( $post_id, 'kaiin', true ) > 0 ){
			$kaiin  = 1;
			$kaiin2 = 0;	//ユーザー別会員物件リスト
		}else{
			$kaiin  = 0;
			$kaiin2 = 1;	//ユーザー別会員物件リスト
		}

		if ( my_custom_kaiin_view( 'kaiin_title', $kaiin, $kaiin2 ) ){
			$post_title = esc_attr( str_replace("　", " ", get_the_title( $post_id ) ) );
		}else{
			$post_title = '会員物件';
		}


?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<title><?php echo wp_get_document_title(); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php
	/**
	 * Print scripts or data in the embed template <head> tag.
	 *
	 * @since 4.4.0
	 */
	do_action( 'embed_head' );
	?>
</head>
<body <?php body_class(); ?>>
<?php

	global $fudou_lazy_loading;


		// Add post thumbnail to response if available.
		$thumbnail_id = false;

		if ( has_post_thumbnail( $post_id ) ) {
			$thumbnail_id = get_post_thumbnail_id( $post_id );
		}

		if ( $thumbnail_id ) {
			$aspect_ratio = 1;
			$measurements = array( 1, 1 );
			$image_size   = 'full'; // Fallback.

			$meta = wp_get_attachment_metadata( $thumbnail_id );
			if ( is_array( $meta ) ) {
				foreach ( $meta['sizes'] as $size => $data ) {
					if ( $data['width'] / $data['height'] > $aspect_ratio ) {
						$aspect_ratio = $data['width'] / $data['height'];
						$measurements = array( $data['width'], $data['height'] );
						$image_size   = $size;
					}
				}
			}

			/**
			 * Filter the thumbnail image size for use in the embed template.
			 *
			 * @since 4.4.0
			 *
			 * @param string $image_size Thumbnail image size.
			 */
			$image_size = apply_filters( 'embed_thumbnail_image_size', $image_size );

			$shape = $measurements[0] / $measurements[1] >= 1.75 ? 'rectangular' : 'square';


			/**
			 * Filter the thumbnail shape for use in the embed template.
			 *
			 * Rectangular images are shown above the title
			 * while square images are shown next to the content.
			 *
			 * @since 4.4.0
			 *
			 * @param string $shape Thumbnail image shape. Either 'rectangular' or 'square'.
			 */
			$shape = apply_filters( 'embed_thumbnail_image_shape', $shape );
		}

		?>
		<div <?php post_class( 'wp-embed' ); ?>>

			<?php if ( $thumbnail_id && 'rectangular' === $shape ) : ?>
				<div class="wp-embed-featured-image rectangular">
					<a href="<?php echo $post_url; ?>" target="_top">
						<?php echo wp_get_attachment_image( $thumbnail_id, $image_size ); ?>
					</a>
				</div>
			<?php endif; ?>

			<p class="wp-embed-heading">
				<a href="<?php echo $post_url; ?>" target="_top">
					<?php
					echo $post_title;

					//会員ロゴ
					if( get_post_meta( $post_id, 'kaiin', true ) == 1 ) {
						$kaiin_logo = '<span class="fudo_kaiin_type_logo"><img ' . $fudou_lazy_loading . ' src="' . plugins_url() . '/fudou/img/kaiin_s.jpg" alt="会員物件" /></span>';
						echo apply_filters( 'fudou_kaiin_logo_view', $kaiin_logo );
					} 
					?>
					<?php do_action( 'fudo_kaiin_type_logo', $post_id ); 	//会員ロゴ ?>

				</a>
			</p>

			<div class="wp-embed-excerpt"><?php bukken_view_content( $post_id ); ?></div>

			<?php
			/**
			 * Print additional content after the embed excerpt.
			 *
			 * @since 4.4.0
			 */
			do_action( 'embed_content' );
			?>

			<div class="wp-embed-footer">
				<div class="wp-embed-site-title">
					<?php
					$site_title = sprintf(
						'<a href="%s" target="_top"><img src="%s" srcset="%s 2x" width="32" height="32" alt="" class="wp-embed-site-icon"/><span>%s</span></a>',
						esc_url( home_url() ),
						esc_url( get_site_icon_url( 32, admin_url( 'images/w-logo-blue.png' ) ) ),
						esc_url( get_site_icon_url( 64, admin_url( 'images/w-logo-blue.png' ) ) ),
						esc_html( get_bloginfo( 'name' ) )
					);

					/**
					 * Filter the site title HTML in the embed footer.
					 *
					 * @since 4.4.0
					 *
					 * @param string $site_title The site title HTML.
					 */
					echo apply_filters( 'embed_site_title_html', $site_title );
					?>
				</div>

				<div class="wp-embed-meta">
					<div class="wp-embed-share">
						<button type="button" class="wp-embed-share-dialog-open" aria-label="<?php esc_attr_e( 'Open sharing dialog' ); ?>">
							<span class="dashicons dashicons-share"></span>
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="wp-embed-share-dialog hidden" role="dialog" aria-label="<?php esc_attr_e( 'Sharing options' ); ?>">
			<div class="wp-embed-share-dialog-content">
				<div class="wp-embed-share-dialog-text">
					<ul class="wp-embed-share-tabs" role="tablist">
						<li class="wp-embed-share-tab-button wp-embed-share-tab-button-wordpress" role="presentation">
							<button type="button" role="tab" aria-controls="wp-embed-share-tab-wordpress" aria-selected="true" tabindex="0"><?php esc_html_e( 'WordPress Embed' ); ?></button>
						</li>
						<li class="wp-embed-share-tab-button wp-embed-share-tab-button-html" role="presentation">
							<button type="button" role="tab" aria-controls="wp-embed-share-tab-html" aria-selected="false" tabindex="-1"><?php esc_html_e( 'HTML Embed' ); ?></button>
						</li>
					</ul>
					<div id="wp-embed-share-tab-wordpress" class="wp-embed-share-tab" role="tabpanel" aria-hidden="false">
						<input type="text" value="<?php echo $post_url; ?>" class="wp-embed-share-input" aria-describedby="wp-embed-share-description-wordpress" tabindex="0" readonly />

						<p class="wp-embed-share-description" id="wp-embed-share-description-wordpress">
							<?php _e( 'Copy and paste this URL into your WordPress site to embed' ); ?>
						</p>
					</div>
					<div id="wp-embed-share-tab-html" class="wp-embed-share-tab" role="tabpanel" aria-hidden="true">
						<textarea class="wp-embed-share-input" aria-describedby="wp-embed-share-description-html" tabindex="0" readonly><?php echo esc_textarea( get_post_embed_html( 600, 400, $post_id ) ); ?></textarea>

						<p class="wp-embed-share-description" id="wp-embed-share-description-html">
							<?php _e( 'Copy and paste this code into your site to embed' ); ?>
						</p>
					</div>
				</div>

				<button type="button" class="wp-embed-share-dialog-close" aria-label="<?php esc_attr_e( 'Close sharing dialog' ); ?>">
					<span class="dashicons dashicons-no"></span>
				</button>
			</div>
		</div>

<?php
/**
 * Print scripts or data before the closing body tag in the embed template.
 *
 * @since 4.4.0
 */
do_action( 'embed_footer' );
?>
</body>
</html>
<?php



	function bukken_view_content( $post_id ){

		global $is_fudoukaiin,$is_fudoubus;
		global $wpdb;

		$rosen_bus = false;	// 路線を「バス」に設定している?

		$post_id_array = get_post( $post_id ); 
		$post_title = $post_id_array->post_title;


		$excerpt = $post_id_array->post_excerpt;
		$content = $post_id_array->post_content;
		$post_modified = $post_id_array->post_modified;
		$post_modified_date =  vsprintf("%d-%02d-%02d", sscanf($post_modified, "%d-%d-%d"));

		$post_date =  $post_id_array->post_date;
		$post_date =  vsprintf("%d-%02d-%02d", sscanf($post_date, "%d-%d-%d"));

		$post_url	= str_replace('&p=','&amp;p=',get_permalink($post_id));


		// NEW/UP
		$newup_mark = get_option('newup_mark');
		if($newup_mark == '') $newup_mark=14;

		$view1 = 1;
		$view2 = 1;
		$view3 = 1;
		$view4 = 1;
		$view5 = 1;
		$view6 = 1;


				//newup_mark
				$newup_mark_img=  '';
				if( $newup_mark != 0 && is_numeric($newup_mark) ){
					if( ( abs(strtotime($post_modified_date) - strtotime(date("Y/m/d"))) / (60 * 60 * 24) ) < $newup_mark ){
						if($post_modified_date == $post_date ){
							$newup_mark_img = '<div class="new_mark">new</div>';
						}else{
							$newup_mark_img = '<div class="new_mark">up</div>';
						}
					}
				}


				//会員
				if( get_post_meta( $post_id, 'kaiin', true ) > 0 ){
					$kaiin  = 1;
					$kaiin2 = 0;	//ユーザー別会員物件リスト
				}else{
					$kaiin  = 0;
					$kaiin2 = 1;	//ユーザー別会員物件リスト
				}

				echo $newup_mark_img;

				//会員項目表示判定
				if ( !my_custom_kaiin_view('kaiin_gazo',$kaiin,$kaiin2) ){
					echo '<img ' . $fudou_lazy_loading . ' class="box1image kaiinimage" src="'.plugins_url().'/fudou/img/kaiin.jpg" alt="この物件は、「会員様にのみ限定公開」している物件です。" />';
				}else{

					//サムネイル画像
					$fudoimg1_data = get_post_meta($post_id, 'fudoimg1', true);
					if($fudoimg1_data != '')	$fudoimg_data=$fudoimg1_data;
					$fudoimg2_data = get_post_meta($post_id, 'fudoimg2', true);
					if($fudoimg2_data != '')	$fudoimg_data=$fudoimg2_data;
					$fudoimg_alt = str_replace("　"," ",$post_title);

					echo '<a href="' . $post_url . '" target="_top">';

					if( $fudoimg_data !="" ){

						/*
						 * Add url fudoimg_data Pre
						 *
						 * Version: 1.7.12
						 *
						 **/
						$fudoimg_data = apply_filters( 'pre_fudoimg_data_add_url', $fudoimg_data, $post_id );

						//Check URL
						if ( checkurl_fudou( $fudoimg_data )) {
							echo '<img ' . $fudou_lazy_loading . ' class="box1image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
						}else{
							//Check attachment
							$sql  = "SELECT P.ID,P.guid";
							$sql .= " FROM $wpdb->posts AS P";
							$sql .= " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
							//$sql = $wpdb->prepare($sql,'');
							$metas = $wpdb->get_row( $sql );
							$attachmentid = '';
							if(!empty($metas)) {
								$attachmentid  =  $metas->ID;
							}

							/*
							 * fudoimg_data to attachmentid
							 *
							 * Version: 1.9.2
							 **/
							$attachmentid = apply_filters( 'fudoimg_data_to_attachmentid', $attachmentid, $fudoimg_data, $post_id );

							if($attachmentid !=''){
								//thumbnail、medium、large、full 
								$fudoimg_data1 = wp_get_attachment_image_src( $attachmentid, 'thumbnail');
								$fudoimg_url = $fudoimg_data1[0];

								//light-box v1.7.9 SSL
								$large_guid_url = wp_get_attachment_image_src( $attachmentid, 'large' );
								if( $large_guid_url[0] ){
									$guid_url = $large_guid_url[0];
								}else{
									$guid_url = get_the_guid( $attachmentid );
									if( is_ssl() ){
										$guid_url= str_replace( 'http://', 'https://', $guid_url );
									}
								}

								if($fudoimg_url !=''){
									echo '<img ' . $fudou_lazy_loading . ' class="box1image" src="' . $fudoimg_url .'" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
								}else{
									echo '<img ' . $fudou_lazy_loading . ' class="box1image" src="' . $guid_url . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
								}
							}else{

								/*
								 * Add url fudoimg_data
								 *
								 * Version: 1.7.12
								 *
								 **/
								$fudoimg_data = apply_filters( 'fudoimg_data_add_url', $fudoimg_data, $post_id );

								if ( checkurl_fudou( $fudoimg_data )) {
									echo '<img ' . $fudou_lazy_loading . ' class="box1image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
								}else{
									echo '<img ' . $fudou_lazy_loading . ' class="box1image" src="' . plugins_url() . '/fudou/img/nowprinting.jpg" alt="' . $fudoimg_data . '" />';
								}
							}
						}

					}else{
						echo '<img ' . $fudou_lazy_loading . ' class="box1image" src="'.plugins_url().'/fudou/img/nowprinting.jpg" alt="" />';
					}
					echo "</a>\n";
				}


				echo '<dl>';
				//抜粋
				//$_post = & get_post( intval($post_id) ); 
				//echo $_post->post_excerpt; 

				//価格 v1.7.12
				if ( my_custom_kaiin_view('kaiin_kakaku',$kaiin,$kaiin2) ){

						if($view2=="1"){
							echo '<dt class="kakakutai">';

							if( get_post_meta($post_id,'bukkenshubetsu',true) < 3000 ){
								echo '<span class="top_price_koumoku">価格</span>';
							}else{
								echo '<span class="top_price_koumoku">賃料</span>';
							}

							echo '<span class="top_price">';
							if( get_post_meta($post_id, 'seiyakubi', true) != "" ){
								echo 'ご成約済';
							}else{

								//非公開の場合
								if( get_post_meta($post_id,'kakakukoukai',true) == "0" ){
									$kakakujoutai_data = get_post_meta($post_id,'kakakujoutai',true);
									if($kakakujoutai_data=="1")	echo '相談';
									if($kakakujoutai_data=="2")	echo '確定';
									if($kakakujoutai_data=="3")	echo '入札';

									//価格状態 v1.9.0
									do_action( 'fudou_add_kakakujoutai', $kakakujoutai_data, $post_id );

								}else{
									$kakaku_data = get_post_meta($post_id,'kakaku',true);
									if( is_numeric( $kakaku_data ) ){
										if ( function_exists( 'fudou_money_format_ja' ) ) {
											// Money Format 億万円 表示
											echo apply_filters( 'fudou_money_format_ja', $kakaku_data );
										}else{
											echo floatval($kakaku_data)/10000;
											echo "万円";
										}
									}
								}
							}
							echo '</span>';
							echo '</dt>';

						}
				}else{
					echo 'この物件は、「会員様にのみ限定公開」している物件です。';
				}


				//間取り・土地面積
				if($view3=="1"){

					//間取り
					$tmp_madori = '';
					$tmp_menseki = '';

					if ( my_custom_kaiin_view('kaiin_madori',$kaiin,$kaiin2) ){

							$madorisyurui_data = get_post_meta($post_id,'madorisyurui',true);
							$tmp_madori .= get_post_meta($post_id,'madorisu',true);
							if($madorisyurui_data=="10")	$tmp_madori .= 'R ';
							if($madorisyurui_data=="20")	$tmp_madori .= 'K ';
							if($madorisyurui_data=="25")	$tmp_madori .= 'SK ';
							if($madorisyurui_data=="30")	$tmp_madori .= 'DK ';
							if($madorisyurui_data=="35")	$tmp_madori .= 'SDK ';
							if($madorisyurui_data=="40")	$tmp_madori .= 'LK ';
							if($madorisyurui_data=="45")	$tmp_madori .= 'SLK ';
							if($madorisyurui_data=="50")	$tmp_madori .= 'LDK ';
							if($madorisyurui_data=="55")	$tmp_madori .= 'SLDK ';
					}


					//土地面積
					if ( my_custom_kaiin_view('kaiin_menseki',$kaiin,$kaiin2) ){
						if ( get_post_meta($post_id,'bukkenshubetsu',true) < 1200 || get_post_meta($post_id,'bukkenshubetsu',true) == 3212 ) {
							if( get_post_meta($post_id, 'tochikukaku', true) !="" ) {
								$tmp_menseki = ' '.get_post_meta($post_id, 'tochikukaku', true).'m&sup2;';
							}
						}
					}

					if( $tmp_madori != '' || $tmp_menseki != '' ){
						echo '<dt class="madoritai_menseki">';
						if( $tmp_madori != '' ){
							echo '<span class="top_madori_koumoku">間取</span>';
							echo '<span class="top_madori">'. $tmp_madori . '</span>';
						}


						if( $tmp_menseki != '' ){
							if( $tmp_madori != '' ) 	echo '</dt><dt>';
							echo '<span class="top_menseki_koumoku">面積</span>';
							echo '<span class="top_menseki">'. $tmp_menseki . '</span>';
						}
						echo '</dt>';
					}
				}


				//所在地
				if ( my_custom_kaiin_view('kaiin_shozaichi',$kaiin,$kaiin2) ){

						if($view4=="1"){
							echo '<dt class="shozaichi">';
							echo '<span class="top_shozaichi_koumoku">住所</span>';
							echo '<span class="top_shozaichi">';
							$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
							$shozaichiken_data = myLeft($shozaichiken_data,2);
							$shozaichicode_data = get_post_meta($post_id,'shozaichicode',true);
							$shozaichicode_data = myLeft($shozaichicode_data,5);
							$shozaichicode_data = myRight($shozaichicode_data,3);

							if($shozaichiken_data !="" && $shozaichicode_data !=""){
								$sql = "SELECT narrow_area_name FROM " . $wpdb->prefix . DB_SHIKU_TABLE . " WHERE middle_area_id=".$shozaichiken_data." and narrow_area_id =".$shozaichicode_data."";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty($metas) ) echo $metas->narrow_area_name."";
							}
							echo get_post_meta($post_id, 'shozaichimeisho', true);
							echo '</span>';
							echo '</dt>';
						}
				}

				//交通路線
				if ( my_custom_kaiin_view('kaiin_kotsu',$kaiin,$kaiin2) ){

						if($view5=="1"){
							echo '<dt class="kotsu">';
							echo '<span class="top_kotsu_koumoku">最寄駅</span>';
							echo '<span class="top_kotsu">';
							$koutsurosen_data = get_post_meta($post_id, 'koutsurosen1', true);
							$koutsueki_data = get_post_meta($post_id, 'koutsueki1', true);
							$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
							$shozaichiken_data = myLeft($shozaichiken_data,2);

							if($koutsurosen_data !=""){
								$sql = "SELECT rosen_name FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " WHERE rosen_id = ".$koutsurosen_data."";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty( $metas ) ){
									if( $metas->rosen_name == 'バス' ){
										$rosen_bus = true;
									}
									echo "".$metas->rosen_name;
								}
							}

							//交通駅
							if( $koutsurosen_data && $koutsueki_data && !$rosen_bus ){
								$sql = "SELECT DTS.station_name";
								$sql = $sql . " FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
								$sql = $sql . " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
								$sql = $sql . " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty($metas) ){
									if($metas->station_name != '＊＊＊＊'){
										echo $metas->station_name.'駅';
									}
								}
							}
							echo '</span>';
							echo '</dt>';
						}
				}

				//交通バス路線
				if ( my_custom_kaiin_view( 'kaiin_kotsu', $kaiin,$kaiin2 ) ){
						if( $view6=="1" &&  $is_fudoubus ){
							$bus_name = apply_filters( 'fudoubus_buscorse_busstop_single', '', $post_id, 1 );
							if( $bus_name ){
								echo '<dt class="kotsubus">';
								echo '<span class="top_kotsubus_koumoku">バス停</span>';
								echo '<span class="top_kotsubus">' . $bus_name .'</span>';
								echo '</dt>';
							}
						}
				}

				/*
				echo '<br />更新日:';
				echo $post_modified_date;
				*/

				echo '<dl>';

	}
