<?php
/**
 * The Template for displaying fudou single posts.
 *
 * Template: single-fudo.php
 *
 * @package WordPress 5.9
 * @subpackage Fudousan Plugin
 * @subpackage Twenty_XXX
 * Version: 5.9.0
 */

	/**** functions ****/
	require_once WP_PLUGIN_DIR . '/fudou/inc/inc-single-fudo.php';

	/**** ヘッダー(前処理) ****/
	require_once WP_PLUGIN_DIR . '/fudou/inc/inc-single-fudo-header.php';


	status_header( 200 );
	get_header(); 
	the_post();

?>
<div id="container" class="site-content">

	<div id="content" role="main">

		<?php do_action( 'single-fudo0', $post_id ); ?>


		<!-- ここから物件詳細情報 -->
		<div id="list_simplepage2">

			<!-- #nav-above -->
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php do_action( 'single-fudo1', $post_id ); ?>

				<div class="list_simple_box">

							<!-- ここから左ブロック --> 
							<div class="list_picsam">
								<?php

								//画像
								if (!defined('FUDOU_IMG_MAX')){
									$fudou_img_max = 10;
								}else{
									$fudou_img_max = FUDOU_IMG_MAX;
								}

								//サムネイル画像
								$img_path = get_option('upload_path');
								if ($img_path == '')	$img_path = 'wp-content/uploads';

								for( $imgid=1; $imgid<=10; $imgid++ ){

									$fudoimg_data = get_post_meta($post_id, "fudoimg$imgid", true);
									$fudoimgcomment_data = get_post_meta($post_id, "fudoimgcomment$imgid", true);

									//物件画像コメント + 画像タイプ v5.8.0
									$fudoimg_alt = $fudoimgcomment_data . my_custom_fudoimgtype_print(get_post_meta($post_id, "fudoimgtype$imgid", true));
									//タイトル + 画像No
									if( $fudoimg_alt == '' ){
										$fudoimg_alt = $title . ' 画像' . $imgid;
									}

									if($fudoimg_data !="" ){

										/*
										 * Add url fudoimg_data Pre
										 *
										 * Version: 1.7.12
										 **/
										$fudoimg_data = apply_filters( 'pre_fudoimg_data_add_url', $fudoimg_data, $post_id );

										//Check URL
										if ( checkurl_fudou( $fudoimg_data )) {
											echo '<a href="' . $fudoimg_data . '" rel="lightbox lytebox['.$post_id.']" title="'.$fudoimg_alt.'">';
											echo '<img ' . $fudou_lazy_loading . ' class="box3image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" /></a>';
											
										}else{
											//Check attachment
											$sql  = "SELECT P.ID,P.guid";
											$sql .= " FROM $wpdb->posts AS P";
											$sql .= " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
											//$sql = $wpdb->prepare($sql,'');
											$metas = $wpdb->get_row( $sql );
											$attachmentid = '';
											if( !empty($metas) ){
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

												//width height ver5.5.0 single
												$fudoimg_single_width  = isset( $fudoimg_data1[1] ) ? $fudoimg_data1[1] : $default_single_width;
												$fudoimg_single_height = isset( $fudoimg_data1[2] ) ? $fudoimg_data1[2] : $default_single_height;
												$fudoimg_single_width_height = apply_filters( 'fudoimg_single_width_height', ' width="' . $fudoimg_single_width . '" height="' . $fudoimg_single_height . '"' );

												//light-box v1.7.9 SSL
												$large_guid_url = wp_get_attachment_image_src( $attachmentid, 'large' );
												if( $large_guid_url[0] ){
													$guid_url = $large_guid_url[0];

													//width height ver5.5.0 single
													$guid_single_width  = isset( $large_guid_url[1] ) ? $large_guid_url[1] : $default_single_width;
													$guid_single_height = isset( $large_guid_url[2] ) ? $large_guid_url[2] : $default_single_height;
													$guidimg_single_width_height = apply_filters( 'guidimg_single_width_height', ' width="' . $guid_single_width . '" height="' . $guid_single_height . '"' );

												}else{
													$guid_url = get_the_guid( $attachmentid );
													if( is_ssl() ){
														$guid_url= str_replace( 'http://', 'https://', $guid_url );
													}
												}

												echo '<a href="' . $guid_url . '" rel="lightbox lytebox['.$post_id.']" title="'.$fudoimg_alt.'">';
												if($fudoimg_url !=''){
													echo '<img ' . $fudou_lazy_loading . ' class="box3image" src="' . $fudoimg_url.'" alt="'.$fudoimg_alt.'" title="'.$fudoimg_alt.'" ' . $fudoimg_single_width_height . '></a>';
												}else{
													echo '<img ' . $fudou_lazy_loading . ' class="box3image" src="' . $guid_url . '"  alt="'.$fudoimg_alt.'" title="'.$fudoimg_alt.'" ' . $guidimg_single_width_height . '></a>';
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
													echo '<a href="' . $fudoimg_data . '" rel="lightbox lytebox['.$post_id.']" title="'.$fudoimg_alt.'">';
													echo '<img ' . $fudou_lazy_loading . ' class="box3image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" ' . $defaultimg_single_width_height . '></a>';
												}else{
													//echo '<img ' . $fudou_lazy_loading . ' class="box3image" src="' . plugins_url() . '/fudou/img/nowprinting.jpg" alt="' . $fudoimg_data . '" ' . $defaultimg_single_width_height . '>';
													echo '<img ' . $fudou_lazy_loading . ' class="box3image" src="' . apply_filters( 'fudou_nowprinting_img', plugins_url() . '/fudou/img/nowprinting.png', $post_id ) . '" alt="' . $fudoimg_data . '" ' . $defaultimg_single_width_height . '>';
												}
											}
										}

									}else{
										if( $imgid==1 )
										//echo '<img ' . $fudou_lazy_loading . ' class="box3image" src="'.plugins_url().'/fudou/img/nowprinting.jpg" alt="'.$fudoimg_alt.'" ' . $defaultimg_single_width_height . '>';
										echo '<img ' . $fudou_lazy_loading . ' class="box3image" src="' . apply_filters( 'fudou_nowprinting_img', plugins_url() . '/fudou/img/nowprinting.png', $post_id ) . '" alt="' . $fudoimg_alt . '" ' . $defaultimg_single_width_height . '>';
									}
									echo "\n";
								}

								//携帯QR
								if ( apply_filters( 'fudou_ktai_qr', false ) ){
									$yoursubject = '%e7%89%a9%e4%bb%b6%e3%82%b5%e3%82%a4%e3%83%88%e3%81%aeURL'; //物件サイトのURL
									echo "\n";
									echo '<a href="mailto:?subject='.$yoursubject.'&body='. urlencode( get_permalink($post_id) ) .'">';
									$options = '';
									$culum3 = false;
									if (function_exists('unpc_get_theme_options')) 
										$options = unpc_get_theme_options();

									if ( is_array( $options ) ){
										$current_layout = $options['theme_layout'];
										if ( in_array( $current_layout, array( 'sidebar-content-sidebar' ) ) )
											$culum3 = true;
									}

									if ( $culum3 ){
										echo '<img src="//chart.googleapis.com/chart?chs=100x100&amp;cht=qr&amp;chl=' . urlencode( get_permalink($post_id) ) . '" alt="クリックでURLをメール送信" title="クリックでURLをメール送信" /></a>';
									}else{
										echo '<img src="//chart.googleapis.com/chart?chs=130x130&amp;cht=qr&amp;chl=' . urlencode( get_permalink($post_id) ) . '" alt="クリックでURLをメール送信" title="クリックでURLをメール送信" /></a>';
									}
								}
							?>
							</div>

							<!-- ここから右ブロック -->
							<div class="list_detail">

								<?php do_action( 'single-fudo2', $post_id ); ?>

									<table>
										<tr>
											<td class="list_price<?php if( get_post_meta($post_id,'bukkenshubetsu',true) > 3000 ) echo ' rent'; ?>">
											<dl style="padding:0;margin:0;">
												<dt><?php if ( get_post_meta($post_id,'bukkenshubetsu',true) <3000 ) { echo '価格';}else{echo '賃料';} ?></dt>

												<dd><?php my_custom_bukkenshubetsu_print($post_id); ?></dd>

												<?php if( get_post_meta($post_id, 'madorisu', true) !=""){ ;?>

												<?php } ?>
											</dl>
											</td>
										</tr>

									</table>

								<?php do_action( 'single-fudo10', $post_id ); ?>

								<!-- 2列table -->
								<div id="list_add_table">
								<table id="list_add">
									<tr>
										<th>所在地</th>
										<td><?php my_custom_shozaichi_print($post_id); ?><?php echo get_post_meta($post_id, 'shozaichimeisho', true); ?>
										<?php if ( get_post_meta($post_id,'bukkenmeikoukai',true) != '0' ) echo '　'. get_post_meta($post_id,'bukkenmei',true);?></td>
									</tr>
								</table>
								</div>

								<?php do_action( 'single-fudo11', $post_id ); ?>

								<div id="list_other_table">
								<table id="list_other">
			
								<?php do_action( 'single-fudo12', $post_id ); ?>

									<?php if( get_post_meta($post_id,'targeturl',true)!='' ){ ?>
									<tr>
										<th class="th1">URL</th>
										<td class="td1" colspan="3"><?php my_custom_targeturl_print($post_id); ?></td>
									</tr>
									<?php } ?>

									<tr>
										<th class="th1">物件番号</th>
										<td class="td1" <?php if( get_post_meta($post_id,'keisaikigenbi',true)=='' ) echo ' colspan="3"'; ?>>
										<?php echo get_post_meta($post_id, 'shikibesu', true);?></td>

										<?php if( get_post_meta($post_id,'keisaikigenbi',true)!='' ){ ?>
										<th class="th2">掲載期限日</th>
										<td class="td2"><?php echo get_post_meta($post_id, 'keisaikigenbi', true);?></td>
										<?php } ?>
									</tr>

									<tr>
										<th>所在地(英語表記)</th>
										<td><?php echo get_post_meta( $post_id, 'shozaichimeishoen', true ); ?></td>
									</tr>
									<tr>
										<th>Square Ft</th>
										<td><?php echo get_post_meta( $post_id, 'sqft', true ); ?></td>
										<th>Parking</th>
										<td><?php echo get_post_meta( $post_id, 'parking', true ); ?></td>
									</tr>
									<tr>
										<th>Bedroom</th>
										<td><?php echo get_post_meta( $post_id, 'bedroom', true ); ?></td>
										<th>Bathroom	</th>
										<td><?php echo get_post_meta( $post_id, 'bathroom', true ); ?></td>
									</tr>


									<?php if( get_post_meta( $post_id, 'tokkinotices', true ) !='' ){ //不動産プラグイン v5.0.0 ?>
									<tr>
										<th class="th1">特記事項</th>
										<td class="td1" colspan="3"><?php echo get_post_meta( $post_id, 'tokkinotices', true ); ?></td>
									</tr>
									<?php } ?>


									<?php do_action( 'single-fudo3', $post_id ); ?>

								</table>
								</div>
								<!-- .2列table -->

								<?php do_action( 'single-fudo13', $post_id ); ?>


							<!-- 地図 -->
								<?php 
								/**
								 * 地図表示 GoogleMaps Places
								 *
								 * @since Fudousan Plugin ver1.7.12
								 * For single-fudo.php apply_filters( 'fudou_single_googlemaps', $post_id , $kaiin , $kaiin2 , $title );
								 *
								 * @param int $post_id Post ID.
								 * @param int $kaiin.
								 * @param int $kaiin2.
								 * @param str $title.
								 * @return text
								 */
								apply_filters( 'fudou_single_googlemaps', $post_id , $kaiin , $kaiin2 , $title ); 
								?>
							<!-- // 地図 -->


								<?php do_action( 'single-fudo15', $post_id ); ?>

						<?php
							//画像 11～20
							if( $fudou_img_max > 10 ){

								$second_img = '';

								for( $imgid=11; $imgid<=$fudou_img_max; $imgid++ ){

									$fudoimg_data = get_post_meta($post_id, "fudoimg$imgid", true);
									$fudoimgcomment_data = get_post_meta($post_id, "fudoimgcomment$imgid", true);

									//物件画像コメント + 画像タイプ v5.8.0
									$fudoimg_alt = $fudoimgcomment_data . my_custom_fudoimgtype_print(get_post_meta($post_id, "fudoimgtype$imgid", true));
									//タイトル + 画像No
									if( $fudoimg_alt == '' ){
										$fudoimg_alt = $title . ' 画像' . $imgid;
									}

									if($fudoimg_data !="" ){

										/*
										 * Add url fudoimg_data Pre
										 *
										 * Version: 1.7.12
										 *
										 **/
										$fudoimg_data = apply_filters( 'pre_fudoimg_data_add_url', $fudoimg_data, $post_id );

										//Check URL
										if ( checkurl_fudou( $fudoimg_data )) {
											$second_img .= '<a href="' . $fudoimg_data . '" rel="lightbox lytebox['.$post_id.']" title="'.$fudoimg_alt.'">';
											$second_img .= '<img ' . $fudou_lazy_loading . ' src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" /></a>';
											
										}else{
											//Check attachment
											$sql  = "SELECT P.ID,P.guid";
											$sql .= " FROM $wpdb->posts AS P";
											$sql .= " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
										//	$sql = $wpdb->prepare($sql,'');
											$metas = $wpdb->get_row( $sql );
											$attachmentid = '';
											if( !empty($metas) ){
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

												//width height ver5.5.0 single
												$fudoimg_single_width  = isset( $fudoimg_data1[1] ) ? $fudoimg_data1[1] : $default_single_width;
												$fudoimg_single_height = isset( $fudoimg_data1[2] ) ? $fudoimg_data1[2] : $default_single_height;
												$fudoimg_single_width_height = apply_filters( 'fudoimg_single_width_height', ' width="' . $fudoimg_single_width . '" height="' . $fudoimg_single_height . '"' );


												//light-box v1.7.9 SSL
												$large_guid_url = wp_get_attachment_image_src( $attachmentid, 'large' );
												if( $large_guid_url[0] ){
													$guid_url = $large_guid_url[0];

													//width height ver5.5.0 single
													$guid_single_width  = isset( $large_guid_url[1] ) ? $large_guid_url[1] : $default_single_width;
													$guid_single_height = isset( $large_guid_url[2] ) ? $large_guid_url[2] : $default_single_height;
													$guidimg_single_width_height = apply_filters( 'guidimg_single_width_height', ' width="' . $guid_single_width . '" height="' . $guid_single_height . '"' );

												}else{
													$guid_url = get_the_guid( $attachmentid );
													if( is_ssl() ){
														$guid_url= str_replace( 'http://', 'https://', $guid_url );
													}
												}

												$second_img .= '<a href="' . $guid_url . '" rel="lightbox lytebox['.$post_id.']" title="'.$fudoimg_alt.'">';
												if($fudoimg_url !=''){
													$second_img .= '<img ' . $fudou_lazy_loading . ' src="' . $fudoimg_url.'" alt="'.$fudoimg_alt.'" title="'.$fudoimg_alt.'" ' . $fudoimg_single_width_height . '></a>';
												}else{
													$second_img .= '<img ' . $fudou_lazy_loading . ' src="' . $guid_url . '"  alt="'.$fudoimg_alt.'" title="'.$fudoimg_alt.'" ' . $guidimg_single_width_height . '>';
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
													$second_img .= '<a href="' . $fudoimg_data . '" rel="lightbox lytebox['.$post_id.']" title="'.$fudoimg_alt.'">';
													$second_img .= '<img ' . $fudou_lazy_loading . ' src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" ' . $defaultimg_single_width_height . '></a>';
												}else{
													//$second_img .= '<img ' . $fudou_lazy_loading . ' src="' . plugins_url() . '/fudou/img/nowprinting.jpg" alt="' . $fudoimg_data . '" ' . $defaultimg_single_width_height . ' />';
													//$second_img .= '<img ' . $fudou_lazy_loading . ' src="' . apply_filters( 'fudou_nowprinting_img', plugins_url() . '/fudou/img/nowprinting.png', $post_id ) . '" alt="' . $fudoimg_data . '" ' . $defaultimg_single_width_height . '>';
												}
											}
										}
									}
								} // for loop

								if( $second_img ){
									echo '<div id="second_img">' . $second_img . '</div>';
								}
							}
						?>
						<div class="list_detail_bottom_info">※物件掲載内容と現況に相違がある場合は現況を優先と致します。</div>

							<?php do_action( 'single-fudo16', $post_id ); ?>

							<!-- 物件詳細ウィジェット -->
							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('syousai_widgets') ) : ?>
							<?php endif; ?>


							<?php do_action( 'single-fudo4', $post_id ); ?>


						</div><!-- .list_detail -->

				</div><!-- .list_simple_box -->

				<!-- .byline -->
				<?php fudou_entry_meta( $post_id ); ?>

			</div><!-- .#nav-above#post-## -->

			<?php do_action( 'single-fudo17', $post_id ); ?>

<?php 
			//SSL
			$fudou_ssl_site_url = get_option('fudou_ssl_site_url');


			//物件問合せ先
			echo '<div id="toiawasesaki">';

			if( $fudou_ssl_site_url != ''){
				//Tweet, Like, Google +1 and Share
				if ( function_exists('disp_social') ) 
					add_filter('the_content', 'disp_social',1);
				//WP Social Bookmarking Light
				if ( function_exists('wp_social_bookmarking_light_the_content') ) 
					add_filter('the_content', 'wp_social_bookmarking_light_the_content');
			}

			$fudo_annnai = get_option('fudo_annnai');
			/*
			 * 物件問合せ先 Filter
			 * 
			 * Version: 1.7.12
			 */
			$fudo_annnai = apply_filters( 'fudo_single_annnai', $fudo_annnai, $post_id );

			$fudo_annnai = apply_filters( 'the_content', $fudo_annnai );
			$fudo_annnai = str_replace( ']]>', ']]&gt;', $fudo_annnai );
			echo $fudo_annnai;

			echo '</div>';


			do_action( 'single-fudo5', $post_id );


			if( $kaiin == 1 ) {
			}else{

				if ( $kaiin2 ){

					//SSL
					if( $fudou_ssl_site_url !=''){
						//SSL問合せフォーム
						echo '<div id="ssl_botton" align="center">';
						echo '<a href="'.$fudou_ssl_site_url.'/wp-content/plugins/fudou/themes/contact.php?post_type=fudo&p='.$post_id.'&KeepThis=true&TB_iframe=true&height=500&width=620" ' . $thickbox_class . '>';
						echo '<img ' . $fudou_lazy_loading . ' src="'.get_option('siteurl').'/wp-content/plugins/fudou/img/ask_botton.jpg" alt="物件お問合せ" title="物件お問合せ" width="300" height="65"></a>';
						echo '</div>';
						echo '<br />';
					}else{

						//問合せフォーム
						echo '<div id="contact_form">';

						//Tweet, Like, Google +1 and Share
						if ( function_exists('disp_social') ) 
							add_filter('the_content', 'disp_social',1);
						//WP Social Bookmarking Light
						if ( function_exists('wp_social_bookmarking_light_the_content') ) 
							add_filter('the_content', 'wp_social_bookmarking_light_the_content');

						$fudo_form = get_option('fudo_form');

						/*
						 * 問合せフォーム Filter
						 * 
						 * Version: 1.7.12
						 */
						$fudo_form = apply_filters( 'fudo_single_form', $fudo_form, $post_id );

						$fudo_form = apply_filters( 'the_content', $fudo_form );
						$fudo_form = str_replace( ']]>', ']]&gt;', $fudo_form );
						echo $fudo_form;
						echo '</div>';
					}

				} //kaiin2
			} //kaiin

			//コメント
			if( FUDOU_TRA_COMMENT )	 comments_template( '', true ); 

			do_action( 'single-fudo6', $post_id );

?>
		</div><!-- .list_simplepage2 -->


		<?php edit_post_link( '[編集]', '<span class="edit-link">', '</span>' ); ?>

	</div><!-- .#content -->

</div><!-- .#container -->


<?php 
	get_sidebar();
	get_footer();
