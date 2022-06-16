<?php
/*
 * 不動産プラグインウィジェット
 * @package WordPress 5.9
 * @subpackage Fudousan Plugin
 * Version: 5.9.0
*/


//物件詳細関連物件表示
function fudo_widgetInit_syousai() {
	register_widget('fudo_widget_syousai');
}
add_action('widgets_init', 'fudo_widgetInit_syousai');

/**
 * 物件詳細 関連物件表示
 * Version: 5.9.0
 */
class fudo_widget_syousai extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {

		/*
		$widget_ops = array(
			'description'                 => '物件詳細ページに関連物件を表示します。',
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fudo_syousai', '関連物件表示(物件詳細ページ)', $widget_ops );
		*/

		parent::__construct(
			'fudo_syousai', 			// Base ID
			'関連物件表示(物件詳細ページ)' ,	// Name
			array( 'description' => '物件詳細ページに関連物件を表示します。', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {

		global $is_fudoukaiin;

		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$item  = isset($instance['item'])  ? esc_attr($instance['item']) : '';
		$sort  = isset($instance['sort'])  ? esc_attr($instance['sort']) : '';

		$view1 = isset($instance['view1']) ? esc_attr($instance['view1']) : '';
		$view2 = isset($instance['view2']) ? esc_attr($instance['view2']) : '';
		$view3 = isset($instance['view3']) ? esc_attr($instance['view3']) : '';
		$view4 = isset($instance['view4']) ? esc_attr($instance['view4']) : '';
		$view5 = isset($instance['view5']) ? esc_attr($instance['view5']) : '';

		$kaiinview = isset($instance['kaiinview']) ? esc_attr($instance['kaiinview']) : '';
		$seiyaku   = isset($instance['seiyaku'])   ? esc_attr($instance['seiyaku']) : '';		//成約物件
		$button_text = isset( $instance['button_text'] ) ? esc_attr( $instance['button_text'] ) : '';

		if($item=='') $item = 4;

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		タイトル <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>


		<p><label for="<?php echo $this->get_field_id('item'); ?>">
		最大表示数 <input class="widefat" id="<?php echo $this->get_field_id('item'); ?>" name="<?php echo $this->get_field_name('item'); ?>" type="text" value="<?php echo $item; ?>" /></label></p>


		<p><label for="<?php echo $this->get_field_id('sort'); ?>">
		優先絞込 <select class="widefat" id="<?php echo $this->get_field_id('sort'); ?>" name="<?php echo $this->get_field_name('sort'); ?>">
			<option value="2"<?php if($sort == 2){echo ' selected="selected"';} ?>>地域</option>
			<option value="3"<?php if($sort == 3){echo ' selected="selected"';} ?>>駅</option>
			<option value="1"<?php if($sort == 1){echo ' selected="selected"';} ?>>地図座標(近い順)</option>
		</select></label></p>


		表示項目<br />
		<p><label for="<?php echo $this->get_field_id('view1'); ?>">
		タイトル <select class="widefat" id="<?php echo $this->get_field_id('view1'); ?>" name="<?php echo $this->get_field_name('view1'); ?>">
			<option value="1"<?php if($view1 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view1 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('view2'); ?>">
		価格 <select class="widefat" id="<?php echo $this->get_field_id('view2'); ?>" name="<?php echo $this->get_field_name('view2'); ?>">
			<option value="1"<?php if($view2 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view2 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('view3'); ?>">
		間取り・土地面積 <select class="widefat" id="<?php echo $this->get_field_id('view3'); ?>" name="<?php echo $this->get_field_name('view3'); ?>">
			<option value="1"<?php if($view3 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view3 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('view4'); ?>">
		地域 <select class="widefat" id="<?php echo $this->get_field_id('view4'); ?>" name="<?php echo $this->get_field_name('view4'); ?>">
			<option value="1"<?php if($view4 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view4 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('view5'); ?>">
		路線・駅 <select class="widefat" id="<?php echo $this->get_field_id('view5'); ?>" name="<?php echo $this->get_field_name('view5'); ?>">
			<option value="1"<?php if($view5 == 1){echo ' selected="selected"';} ?>>表示する</option>
			<option value="2"<?php if($view5 == 2){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

	<?php if($is_fudoukaiin && get_option('kaiin_users_can_register') == '1' ){ ?>
		<p><label for="<?php echo $this->get_field_id('kaiinview'); ?>">
		会員物件 <select class="widefat" id="<?php echo $this->get_field_id('kaiinview'); ?>" name="<?php echo $this->get_field_name('kaiinview'); ?>">
			<option value="1"<?php if($kaiinview == 1){echo ' selected="selected"';} ?>>会員・一般物件を表示する</option>
			<option value="2"<?php if($kaiinview == 2){echo ' selected="selected"';} ?>>会員物件を表示しない</option>
			<option value="3"<?php if($kaiinview == 3){echo ' selected="selected"';} ?>>会員物件だけ表示</option>
		</select></label></p>
	<?php } ?>

	<!-- v5.3.0 -->
		<p><label for="<?php echo $this->get_field_id('seiyaku'); ?>">
		成約物件 <select class="widefat" id="<?php echo $this->get_field_id('seiyaku'); ?>" name="<?php echo $this->get_field_name('seiyaku'); ?>">
			<option value=""<?php if( !$seiyaku ){echo ' selected="selected"';} ?>>全て表示する</option>
			<option value="1"<?php if($seiyaku == 1){echo ' selected="selected"';} ?>>成約物件を表示しない</option>
			<option value="2"<?php if($seiyaku == 2){echo ' selected="selected"';} ?>>成約物件だけ表示</option>
		</select></label></p>

	<!-- v5.9.0 -->
		<p><label for="<?php echo $this->get_field_id('button_text'); ?>">
		物件詳細リンクテキスト <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
		※空欄の場合「→物件詳細」と 表示されます</label></p>


		<?php 
	}


	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {

		global $is_fudoukaiin;
		global $wpdb;
		global $post;
		global $fudou_lazy_loading;

		$post_ID   = isset( $post->ID ) ? $post->ID : '';
		$post_type = isset( $post->post_type ) ? $post->post_type : '';

		//for block
		if( !isset( $args['widget_id'] ) ){
			$args['widget_id'] = 'syousai_box_' . mt_rand();
		}
		//ブロックエディタ判別
		$locale_user = isset( $_GET['_locale'] ) ? $_GET['_locale'] : '';

		if( $post_ID !='' && $post_type == 'fudo' ){

			$title = isset($instance['title']) ? esc_attr( $instance['title'] ) : '';
			$item  = isset($instance['item'])  ? esc_attr( $instance['item'] ) : '4';
			$sort  = isset($instance['sort'])  ? esc_attr( $instance['sort'] ) : '';

			$view1 = isset($instance['view1']) ? esc_attr( $instance['view1'] ) : '1';
			$view2 = isset($instance['view2']) ? esc_attr( $instance['view2'] ) : '1';
			$view3 = isset($instance['view3']) ? esc_attr( $instance['view3'] ) : '1';
			$view4 = isset($instance['view4']) ? esc_attr( $instance['view4'] ) : '1';
			$view5 = isset($instance['view5']) ? esc_attr( $instance['view5'] ) : '1';

			$kaiinview = isset($instance['kaiinview']) ? esc_attr( $instance['kaiinview'] ) : '1';
			$seiyaku   = isset($instance['seiyaku'])   ? esc_attr( $instance['seiyaku'] ) : '';		//成約物件

			//ボタン名 v5.9.0
			$button_text = isset( $instance['button_text'] ) ? esc_attr( $instance['button_text'] ) : '';
			if( $button_text == '' ){
				$button_text = '→物件詳細';
			}

			if( !$is_fudoukaiin || get_option('kaiin_users_can_register') != '1' ){
				$kaiinview = 1;
			}

			//NEW/UP
			$newup_mark = get_option('newup_mark');
			if($newup_mark == '') $newup_mark=14;

			//map
			$ido_data = floatval(get_post_meta($post_ID,'bukkenido',true));
			$keido_data = floatval(get_post_meta($post_ID,'bukkenkeido',true));

			//種別
			$bukkenshubetsu_data = get_post_meta($post_ID,'bukkenshubetsu',true);

			//価格
			$kakaku_data = intval(get_post_meta($post_ID,'kakaku',true));

			//面積
			$tatemonomenseki_data = floatval(get_post_meta($post_ID,'tatemonomenseki',true));

			//面積
			$tochikukaku_data = floatval(get_post_meta($post_ID,'tochikukaku',true));

			//所在地
			$shozaichicode_data = get_post_meta($post_ID,'shozaichicode',true);

			//路線・駅
			$koutsurosen1_data = get_post_meta($post_ID,'koutsurosen1',true);
			$koutsueki1_data = get_post_meta($post_ID,'koutsueki1',true);

			$koutsurosen2_data = get_post_meta($post_ID,'koutsurosen2',true);
			$koutsueki2_data = get_post_meta($post_ID,'koutsueki2',true);


			$sql  =  "SELECT DISTINCT P.ID,P.post_title,P.post_modified,P.post_date";
			$sql .=  " FROM ((((((((((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";		
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";

			//面積
			if ($tatemonomenseki_data >1 ){
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id) ";
			}else{
			$sql .=  ")";
			}

			//面積
			if ($tochikukaku_data >1 ){
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id) ";
			}else{
			$sql .=  ")";
			}

			//地域
			if ($sort == 2 || $sort == ''){
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_10 ON P.ID = PM_10.post_id) "; 
			}else{
			$sql .=  ")";
			}

			//路線・駅
			if ($sort == 3 && $koutsurosen1_data !='' && $koutsueki1_data != '' ){
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_12 ON P.ID = PM_12.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_13 ON P.ID = PM_13.post_id) ";
			}else{
			$sql .=  "))";
			}

			//座標
			if ($sort == 1 && $ido_data > 1 && $keido_data > 1 ){
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_15 ON P.ID = PM_15.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_16 ON P.ID = PM_16.post_id) ";
			}else{
			$sql .=  "))";
			}

			//会員
			if( $kaiinview != 1 ){
				$sql .= " INNER JOIN $wpdb->postmeta AS PM_4 ON P.ID = PM_4.post_id) ";
			}else{
				$sql .= " )";
			}

			//成約物件 v5.3.0
			if( $seiyaku ){
				$sql .= " INNER JOIN $wpdb->postmeta AS PM_5 ON P.ID = PM_5.post_id) ";
			}else{
				$sql .= " )";
			}

			/*
			 * 関連物件表示 org追加SQL条件 WHERE INNER JOIN
			 *
			 * Version: 1.7.4
			 */
			$sql =  apply_filters( 'fudo_widget_syousai_inner_join_data', $sql, $kaiinview );


			$sql .=  " WHERE ";

			$sql .=  " P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";

			$sql .=  " AND P.ID !=".$post_ID."";

			//種別
			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND PM.meta_value = '".$bukkenshubetsu_data."'";

			//価格
			$sql .=  " AND PM_1.meta_key='kakaku' ";

			if ($tatemonomenseki_data >1 ){
			$sql .=  " AND PM_2.meta_key='tatemonomenseki'";
			}
			if ($tochikukaku_data >1 ){
			$sql .=  " AND PM_3.meta_key='tochikukaku' ";
			}

			//地域
			if ($sort == 2 || $sort == ''){
			$sql .=  " AND PM_10.meta_key='shozaichicode' AND PM_10.meta_value = '".$shozaichicode_data."'";
			}

			//路線・駅
			if ($sort == 3 && $koutsurosen1_data !='' && $koutsueki1_data != '' ){
			$sql .=  " AND PM_12.meta_key='koutsurosen1' AND PM_12.meta_value = '".$koutsurosen1_data."'";
			$sql .=  " AND PM_13.meta_key='koutsueki1' AND PM_13.meta_value = '".$koutsueki1_data."'";
			}

			//座標
			if ($sort == 1 && $ido_data > 1 && $keido_data > 1 ){
			$sql .=  " AND PM_15.meta_key='bukkenido' AND PM_16.meta_key ='bukkenkeido'";
			}

			//会員物件を表示しない
			if( $kaiinview == 2 ){
				$sql .= " AND PM_4.meta_key='kaiin' AND PM_4.meta_value < 1 ";
			}

			//会員物件だけ表示
			if( $kaiinview == 3 ){
				$sql .= " AND PM_4.meta_key='kaiin' AND PM_4.meta_value > 0 ";
			}

			//成約物件を表示しない v5.3.0
			if( $seiyaku == 1 ){
				$sql .= " AND PM_5.meta_key='seiyakubi' AND PM_5.meta_value = '' ";
			}
			//成約物件だけを表示する
			if( $seiyaku == 2 ){
				$sql .= " AND PM_5.meta_key='seiyakubi' AND PM_5.meta_value != '' ";
			}

			/*
			 * 関連物件表示 org追加SQL条件 WHERE
			 *
			 * Version: 1.7.4
			 */
			$sql =  apply_filters( 'fudo_widget_syousai_where_data', $sql, $kaiinview );


			$order_by = '';

			//地域
			if ($sort == 2 || $sort == ''){
				$order_by .=  " ORDER BY PM_10.meta_value ASC";
			}

			//路線・駅
			if ($sort == 3 && $koutsurosen1_data !='' && $koutsueki1_data != '' ){
				$order_by .=  " ORDER BY PM_12.meta_value ASC";
			}

			//座標
			if ($sort == 1 && $ido_data > 1 && $keido_data > 1 ){
				$order_by .=  " ORDER BY ABS( PM_15.meta_value  - ".$ido_data.") + ABS( PM_16.meta_value - ".$keido_data.") ASC";
			}


			//面積
			if ($tatemonomenseki_data > 1 ){
				if($order_by == ''){
					$order_by .=  "  ORDER BY ABS( PM_2.meta_value - $tatemonomenseki_data) ASC";
				}else{
					$order_by .=  " , ABS( PM_2.meta_value - $tatemonomenseki_data) ASC";
				}
			}
			if ($tochikukaku_data > 1 ){
				if($order_by == ''){
					$order_by .=  " ORDER BY ABS( PM_3.meta_value - $tochikukaku_data) ASC";
				}else{
					$order_by .=  " , ABS( PM_3.meta_value - $tochikukaku_data) ASC";
				}
			}


			//価格に近い物件
				if($order_by == ''){
					$order_by .=  " ORDER BY ABS( PM_1.meta_value - $kakaku_data) ASC";
				}else{
					$order_by .=  " , ABS( PM_1.meta_value - $kakaku_data) ASC";
				}



			$sql .=  $order_by . " limit ".$item."";

			//$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql, ARRAY_A );

			//ユーザー別会員物件リスト
			$kaiin_users_rains_register = get_option('kaiin_users_rains_register');

			//物件詳細リンク
			if ( defined('FUDOU_BUKKEN_TARGET') && FUDOU_BUKKEN_TARGET== 1 ){
				$target_link = ' target="_blank" rel="noopener"';
			}else{
				$target_link = '';
			}

			if(!empty($metas)) {

				//width height ver5.5.0
				$default_width  = apply_filters( 'fudo_top_thumbnail_width', 150 );
				$default_height = apply_filters( 'fudo_top_thumbnail_height', 150 );
				$defaultimg_width_height = apply_filters( 'defaultimg_width_height', ' width="' . $default_width . '" height="' . $default_height . '"' );

				echo '<!-- fudo_syousai v5.9.0 -->';
				echo $args['before_widget'];

				if ( $title ){
					echo $args['before_title'] . $title . $args['after_title'];
				}


				$img_path = get_option('upload_path');
				if ($img_path == '')
					$img_path = 'wp-content/uploads';


				echo '<div id="syousai_box">';
				echo '<ul id="'.$args['widget_id'].'_1" class="syousai-content kanren">';

				//grid_count css class
				$grid_count = 1;

				foreach ( $metas as $meta ) {

					$rosen_bus = false;	//路線を「バス」に設定している?

					$meta_id =  $meta['ID'];
					$post_title =  $meta['post_title'];
					$post_url =  str_replace('&p=','&amp;p=', get_permalink($meta_id));


					//newup_mark
					$post_modified =  $meta['post_modified'];
					$post_date =   $meta['post_date'];
					$post_modified_date =  vsprintf("%d-%02d-%02d", sscanf($post_modified, "%d-%d-%d"));
					$post_date =  vsprintf("%d-%02d-%02d", sscanf($post_date, "%d-%d-%d"));

					$newup_mark_img=  '';
					if( $newup_mark != 0 && is_numeric($newup_mark) ){
						if( ( abs(strtotime($post_modified_date) - strtotime(date("Y/m/d"))) / (60 * 60 * 24) ) < $newup_mark ){
							if($post_modified_date == $post_date ){
								$newup_mark_img = '<div class="new_mark">new</div>';
							}else{
								$newup_mark_img =  '<div class="new_mark up_mark">up</div>';
							}
						}
					}

					//会員2
					$kaiin = 0;
					if( !is_user_logged_in() && get_post_meta( $meta_id, 'kaiin', true ) > 0 ) $kaiin = 1;
					//ユーザー別会員物件リスト
					$kaiin2 = users_kaiin_bukkenlist( $meta_id, $kaiin_users_rains_register, get_post_meta( $meta_id, 'kaiin', true ) );


					echo '<li class="'.$args['widget_id'].' syousai-content-li grid_count'. $grid_count . '">';

					//grid_count css class
					$grid_count++;
					if( $grid_count > 4 ){
						$grid_count = 1;
					}

					echo $newup_mark_img;

					//会員項目表示判定
					if ( !my_custom_kaiin_view('kaiin_gazo',$kaiin,$kaiin2) ){
						echo '<a href="' . $post_url . '" ' . $target_link . '>';
						echo '<img ' . $fudou_lazy_loading . ' class="box2image" src="' . apply_filters( 'fudou_kaiin_img', plugins_url() . '/fudou/img/kaiin.jpg', $meta_id ) . '" alt="会員物件" ' . $defaultimg_width_height . ' >';
						echo '</a>';
					}else{

						//サムネイル画像
						$fudoimg_data = '';
						$fudoimg1_data = get_post_meta($meta_id, 'fudoimg1', true);
						if($fudoimg1_data != '')	$fudoimg_data=$fudoimg1_data;
						$fudoimg2_data = get_post_meta($meta_id, 'fudoimg2', true);
						if($fudoimg2_data != '')	$fudoimg_data=$fudoimg2_data;

						/*
						 * fudoimg_data Filter
						 *
						 * Version: 5.2.3
						 **/
						$fudoimg_data = apply_filters( 'pre_fudoimg_data', $fudoimg_data, $meta_id, 'fudo_syousai', $args['widget_id'] );

						$fudoimg_alt = str_replace("　"," ",$post_title);

						echo '<a href="' . $post_url . '" ' . $target_link . '>';

						if($fudoimg_data !="" ){

							/*
							 * Add url fudoimg_data Pre
							 *
							 * Version: 1.7.12
							 *
							 **/
							$fudoimg_data = apply_filters( 'pre_fudoimg_data_add_url', $fudoimg_data, $meta_id );

							//Check URL
							if ( checkurl_fudou( $fudoimg_data )) {
								echo '<img ' . $fudou_lazy_loading . ' class="box2image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
							}else{
							//Check attachment

								$attachmentid = '';
								$sql  = "SELECT P.ID,P.guid";
								$sql .= " FROM $wpdb->posts AS P";
								$sql .= " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty($metas) ){
									$attachmentid  =  $metas->ID;
								}

								/*
								 * fudoimg_data to attachmentid
								 *
								 * Version: 1.9.2
								 **/
								$attachmentid = apply_filters( 'fudoimg_data_to_attachmentid', $attachmentid, $fudoimg_data, $meta_id );


								if($attachmentid !=''){
									/*
									 * thumbnail_type
									 * thumbnail、medium、large、full
									 *
									 * Version: 5.2.3
									 **/
									$fudo_top_thumbnail_type = apply_filters( 'fudo_top_thumbnail_type', 'thumbnail', 'fudo_syousai', $args['widget_id'] );

									$fudoimg_data1 = wp_get_attachment_image_src( $attachmentid, $fudo_top_thumbnail_type );
									$fudoimg_url = $fudoimg_data1[0];

									//width height ver5.5.0
									$fudoimg_width  = isset( $fudoimg_data1[1] ) ? $fudoimg_data1[1] : $default_width;
									$fudoimg_height = isset( $fudoimg_data1[2] ) ? $fudoimg_data1[2] : $default_height;
									$fudoimg_width_height = apply_filters( 'fudoimg_width_height', ' width="' . $fudoimg_width . '" height="' . $fudoimg_height . '"' );

									//light-box v1.7.9 SSL
									$large_guid_url = wp_get_attachment_image_src( $attachmentid, 'large' );
									if( $large_guid_url[0] ){
										$guid_url = $large_guid_url[0];

										//width height ver5.5.0
										$guid_width  = isset( $large_guid_url[1] ) ? $large_guid_url[1] : $default_width;
										$guid_height = isset( $large_guid_url[2] ) ? $large_guid_url[2] : $default_height;
										$guidimg_width_height = apply_filters( 'guidimg_width_height', ' width="' . $guid_width . '" height="' . $guid_height . '"' );

									}else{
										$guid_url = get_the_guid( $attachmentid );
										if( is_ssl() ){
											$guid_url= str_replace( 'http://', 'https://', $guid_url );
										}
									}

									if($fudoimg_url !=''){
										echo '<img ' . $fudou_lazy_loading . ' class="box2image" src="' . $fudoimg_url.'" alt="'.$fudoimg_alt.'" title="'.$fudoimg_alt.'" ' . $fudoimg_width_height . '>';
									}else{
										echo '<img ' . $fudou_lazy_loading . ' class="box2image" src="' . $guid_url . '" alt="'.$fudoimg_alt.'" title="'.$fudoimg_alt.'"  ' . $guidimg_width_height . ' >';
									}
								}else{

									/*
									 * Add url fudoimg_data
									 *
									 * Version: 1.7.12
									 *
									 **/
									$fudoimg_data = apply_filters( 'fudoimg_data_add_url', $fudoimg_data, $meta_id );

									if ( checkurl_fudou( $fudoimg_data )) {
										echo '<img class="box2image" src="' . $fudoimg_data . '" alt="' . $fudoimg_alt . '" title="' . $fudoimg_alt . '" />';
									}else{
										echo '<img ' . $fudou_lazy_loading . ' class="box2image" src="' . apply_filters( 'fudou_nowprinting_img', plugins_url() . '/fudou/img/nowprinting.jpg', $meta_id ) . '" alt="' . $fudoimg_data . '" ' . $defaultimg_width_height . '>';
									}
								}
							}

						}else{
							echo '<img ' . $fudou_lazy_loading . ' class="box2image" src="' . apply_filters( 'fudou_nowprinting_img', plugins_url() . '/fudou/img/nowprinting.jpg', $meta_id ) . '" alt="' . $fudoimg_alt . '" ' . $defaultimg_width_height . '>';
						}
						echo '</a>';
					}


					/*
					 * 物件詳細 関連物件表示 追加項目
					 *
					 * Version: 1.7.12
					 */
					do_action( 'fodou_syousai_bukken0', $meta_id, $kaiin, $kaiin2 );


					//ver5.9.0
					do_action( 'fodou_syousai_bukken_title_in', $meta_id, 'syousai' );

					//タイトル
					if ( my_custom_kaiin_view('kaiin_title',$kaiin,$kaiin2) ){
						if($view1=="1" && $post_title !=''){
							echo '<span class="top_title">';
							echo str_replace("　"," ",$post_title).'';
							echo '</span><br>';
						}
					}


					do_action( 'fodou_syousai_bukken1', $meta_id, $kaiin, $kaiin2 );

				/*
					//会員2
					if ( !my_custom_kaiin_view( 'kaiin_kakaku',$kaiin,$kaiin2 ) 
						&& !my_custom_kaiin_view( 'kaiin_madori', $kaiin, $kaiin2 )
						&& !my_custom_kaiin_view( 'kaiin_menseki', $kaiin, $kaiin2 )
						&& !my_custom_kaiin_view( 'kaiin_shozaichi', $kaiin, $kaiin2 )
						&& !my_custom_kaiin_view( 'kaiin_kotsu', $kaiin, $kaiin2) ){
						echo '<span class="top_kaiin">この物件は 会員様限定で公開している物件です</span>';
					}
				*/

					do_action( 'fodou_syousai_bukken2', $meta_id, $kaiin, $kaiin2 );


					//価格 v1.7.12
					if ( my_custom_kaiin_view('kaiin_kakaku',$kaiin,$kaiin2) ){

						if($view2=="1"){

							//ver5.3.3
							do_action( 'fodou_syousai_bukken_view2a', $meta_id, $kaiin, $kaiin2 );

							echo '<span class="top_price">';
							if( get_post_meta($meta_id, 'seiyakubi', true) != "" ){
								echo 'ご成約済　';
							}else{

								if(get_post_meta($meta_id,'kakakukoukai',true) == "0"){
									$kakakujoutai_data = get_post_meta($meta_id,'kakakujoutai',true);
									if($kakakujoutai_data=="1")	echo '相談';
									if($kakakujoutai_data=="2")	echo '確定';
									if($kakakujoutai_data=="3")	echo '入札';

									//価格状態 v1.9.0
									do_action( 'fudou_add_kakakujoutai', $kakakujoutai_data, $meta_id );
									echo '　';
								}else{
									$kakaku_data = get_post_meta($meta_id,'kakaku',true);
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

							//ver5.3.3
							do_action( 'fodou_syousai_bukken_view2b', $meta_id, $kaiin, $kaiin2 );
						}
					}


					do_action( 'fodou_syousai_bukken3', $meta_id, $kaiin, $kaiin2 );


					//間取り・土地面積
					if($view3=="1"){

						//ver5.3.3
						do_action( 'fodou_syousai_bukken_view3a', $meta_id, $kaiin, $kaiin2 );

						//間取り v5.9.0
						if ( my_custom_kaiin_view('kaiin_madori',$kaiin,$kaiin2) ){

							$madori = get_post_meta($meta_id,'madorisu',true);
							$madorisyurui_data = get_post_meta($meta_id,'madorisyurui',true);
							if($madorisyurui_data=="10")	$madori .= 'R ';
							if($madorisyurui_data=="20")	$madori .= 'K ';
							if($madorisyurui_data=="25")	$madori .= 'SK ';
							if($madorisyurui_data=="30")	$madori .= 'DK ';
							if($madorisyurui_data=="35")	$madori .= 'SDK ';
							if($madorisyurui_data=="40")	$madori .= 'LK ';
							if($madorisyurui_data=="45")	$madori .= 'SLK ';
							if($madorisyurui_data=="50")	$madori .= 'LDK ';
							if($madorisyurui_data=="55")	$madori .= 'SLDK ';

							if( $madori ){
								echo ' <span class="top_madori">' . $madori . '</span>';
							}
						}

						//ver5.3.3
						do_action( 'fodou_syousai_bukken_view3b', $meta_id, $kaiin, $kaiin2 );

						//土地面積 v5.9.0
						if ( my_custom_kaiin_view('kaiin_menseki',$kaiin,$kaiin2) ){
							if ( get_post_meta($meta_id,'bukkenshubetsu',true) < 1200 || get_post_meta($meta_id,'bukkenshubetsu',true) == 3212 ) {
								if( get_post_meta($meta_id, 'tochikukaku', true) !="" ) 
									echo ' '.get_post_meta($meta_id, 'tochikukaku', true).'m&sup2;';
									echo ' <span class="top_menseki">'.get_post_meta($meta_id, 'tochikukaku', true).'m&sup2;</span>';

							}
						}

						//ver5.3.3
						do_action( 'fodou_syousai_bukken_view3c', $meta_id, $kaiin, $kaiin2 );

					}


					do_action( 'fodou_syousai_bukken4', $meta_id, $kaiin, $kaiin2 );


				//	echo '<span>';

					//所在地 v5.9.0
					if ( !my_custom_kaiin_view('kaiin_shozaichi',$kaiin,$kaiin2) ){
					}else{
						if($view4=="1"){

							//ver5.3.3
							do_action( 'fodou_syousai_bukken_view4a', $meta_id, $kaiin, $kaiin2 );

							$shozaichi = '';
							$shozaichiken_data = get_post_meta($meta_id,'shozaichicode',true);
							$shozaichiken_data = myLeft($shozaichiken_data,2);
							$shozaichicode_data = get_post_meta($meta_id,'shozaichicode',true);
							$shozaichicode_data = myLeft($shozaichicode_data,5);
							$shozaichicode_data = myRight($shozaichicode_data,3);

							if($shozaichiken_data !="" && $shozaichicode_data !=""){
								$sql = "SELECT narrow_area_name FROM " . $wpdb->prefix . DB_SHIKU_TABLE . " WHERE middle_area_id=".$shozaichiken_data." and narrow_area_id =".$shozaichicode_data."";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty($metas) ){
									$shozaichi .= $metas->narrow_area_name;
								}
							}
							$shozaichi .= get_post_meta($meta_id, 'shozaichimeisho', true);

							if( $shozaichi ){
								echo '<br><span class="top_shozaichi">' . $shozaichi . '</span>';
							}

							//ver5.3.3
							do_action( 'fodou_syousai_bukken_view4b', $meta_id, $kaiin, $kaiin2 );
						}
					}


					do_action( 'fodou_syousai_bukken5', $meta_id, $kaiin, $kaiin2 );


					//交通路線 v5.9.0
					if ( !my_custom_kaiin_view('kaiin_kotsu',$kaiin,$kaiin2) ){
					}else{

						//交通路線
						if($view5=="1"){

							//ver5.3.3
							do_action( 'fodou_syousai_bukken_view5a', $meta_id, $kaiin, $kaiin2 );

							$koutsurosen = '';
							$koutsurosen_data = get_post_meta($meta_id, 'koutsurosen1', true);
							$koutsueki_data = get_post_meta($meta_id, 'koutsueki1', true);
							$shozaichiken_data = get_post_meta($meta_id,'shozaichicode',true);
							$shozaichiken_data = myLeft($shozaichiken_data,2);

							if($koutsurosen_data !=""){
								$sql = "SELECT rosen_name FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " WHERE rosen_id =".$koutsurosen_data."";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty($metas) ) {
									if( $metas->rosen_name == 'バス' ){
										$rosen_bus = true;
									}
									$koutsurosen .= $metas->rosen_name;
								}
							}

							//交通駅
							if( $koutsurosen_data && $koutsueki_data && !$rosen_bus ){
								$sql = "SELECT DTS.station_name";
								$sql .= " FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
								$sql .= " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
								$sql .= " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
							//	$sql = $wpdb->prepare($sql,'');
								$metas = $wpdb->get_row( $sql );
								if( !empty($metas) ){
									$koutsurosen .= $metas->station_name.'駅';
								}
							}

							if( $koutsurosen ){
								echo '<br><span class="top_kotsu">'. $koutsurosen . '</span>';
							}

							//ver5.3.3
							do_action( 'fodou_syousai_bukken_view5b', $meta_id, $kaiin, $kaiin2 );
						}
					}
				//	echo '</span>';


					do_action( 'fodou_syousai_bukken6', $meta_id, $kaiin, $kaiin2 );

					do_action( 'fodou_syousai_bukken7', $meta_id, $kaiin, $kaiin2 );


				echo '<div>';
					//会員ロゴ
					if( get_post_meta( $meta_id, 'kaiin', true ) == 1 ) {
						$kaiin_logo = '<span class="fudo_kaiin_type_logo"><img ' . $fudou_lazy_loading . ' src="' . plugins_url() . '/fudou/img/kaiin_s.jpg" alt="会員物件" width="40" height="20"></span>';
						echo apply_filters( 'fudou_kaiin_logo_view', $kaiin_logo );
					}
					do_action( 'fudo_kaiin_type_logo', $meta_id );	//会員ロゴ


					do_action( 'fodou_syousai_bukken8', $meta_id, $kaiin, $kaiin2 );

					echo '<span style="float:right;" class="box1low"><a href="' . $post_url . '" ' . $target_link . '>' . $button_text . '</a></span>';
					echo '</div>';

					do_action( 'fodou_syousai_bukken9', $meta_id, $kaiin, $kaiin2 );

					echo '</li>';

				}
				echo '</ul>';
				echo '</div>';

				echo $args['after_widget'];


			}else{
			//物件が無い場合

				//ブロックエディタの場合
				/*
				if( $locale_user ){
					echo '<div class="wp-block-legacy-widget__edit-no-preview">';
					echo '<h3>関連物件表示</h3>';
					echo '<p>関連物件データがありませんでした。</p>';
					echo '</div>';
				}
				*/

			} //!empty($metas)

		}else{

			//物件ページではない場合

			//ブロックエディタの場合
			/*
			if( $locale_user != '' ){

				echo '<div class="wp-block-legacy-widget__edit-no-preview">';
				echo '<h3>関連物件表示</h3>';
				echo '<p>物件ページではありません。</p>';
				echo '</div>';
			}
			*/

		} //$post_ID

	}
} // Class fudo_widget_syousai

