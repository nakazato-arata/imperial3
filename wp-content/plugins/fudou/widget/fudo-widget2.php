<?php
/*
 * 不動産プラグインウィジェット
 * @package WordPress5.8
 * @subpackage Fudousan Plugin
 * Version: 5.9.0
*/

// 物件条件検索
function fudo_widgetInit_b_k() {
	register_widget('fudo_widget_b_k');
}
add_action('widgets_init', 'fudo_widgetInit_b_k');


// 更新情報(Twitter) Ver1.1
function fudo_widgetInit_twitter2() {
	register_widget('fudo_widget_twitter2');
}
add_action('widgets_init', 'fudo_widgetInit_twitter2');



/*
 * 物件条件検索
 * Version: 5.9.0
 */
class fudo_widget_b_k extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {

		/*
		$widget_ops = array(
			'description'                 => '物件条件検索フォームをサイドバーに設置します。(1箇所のみ)',
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fudo_b_k', '物件条件検索', $widget_ops );
		*/

		parent::__construct(
			'fudo_b_k', 		// Base ID
			'物件条件検索' ,	// Name
			array( 'description' => '物件条件検索フォームを設置します。(1箇所のみ)', )	// Args
		);

		//テーマカスタマイザー option に登録
		add_filter( 'customize_save_after', array( $this, 'customize_save_after_widget_fudo_b_k' ) );
	}


	/** option */
	function fudo_widget_b_k_option($name,$value) {

		$stored_value = get_option($name);

		if ($stored_value === false) {
			add_option($name, $value);
		} else {
			update_option($name, $value);
		}
	}


	/** @see WP_Widget::form */	
	function form($instance) {

		global $is_fudouchoumei;

		$title  = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$view1  = isset($instance['view1']) ? esc_attr($instance['view1']) : '';		//表示種類

		$r_view   = isset($instance['r_view'])   ? esc_attr($instance['r_view']) : '';		//路線
		$c_view   = isset($instance['c_view'])   ? esc_attr($instance['c_view']) : '';		//地域
		$kak_view = isset($instance['kak_view']) ? esc_attr($instance['kak_view']) : '';	//価格
		$hof_view = isset($instance['hof_view']) ? esc_attr($instance['hof_view']) : '';	//駅歩分
		$mad_view = isset($instance['mad_view']) ? esc_attr($instance['mad_view']) : '';	//間取り
		$tik_view = isset($instance['tik_view']) ? esc_attr($instance['tik_view']) : '';	//築年数
		$men_view = isset($instance['men_view']) ? esc_attr($instance['men_view']) : '';	//面積
		$set_view = isset($instance['set_view']) ? esc_attr($instance['set_view']) : '';	//設備

		$choumei_view = isset($instance['choumei_view']) ? esc_attr($instance['choumei_view']) : '';

		do_action( 'jsearch_widget_form_pre', $this, $instance );
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		タイトル <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>


		<p><label for="<?php echo $this->get_field_id('view1'); ?>">
		表示種類 <select class="widefat" id="<?php echo $this->get_field_id('view1'); ?>" name="<?php echo $this->get_field_name('view1'); ?>">
			<option value="0"<?php if($view1 == 0){echo ' selected="selected"';} ?>>売買・賃貸両方</option>
			<option value="1"<?php if($view1 == 1){echo ' selected="selected"';} ?>>売買のみ</option>
			<option value="2"<?php if($view1 == 2){echo ' selected="selected"';} ?>>賃貸のみ</option>
		</select></label></p>

		<?php do_action( 'jsearch_widget_form1', $this, $instance );?>

		<p><label for="<?php echo $this->get_field_id('r_view'); ?>">
		路線表示 <select class="widefat" id="<?php echo $this->get_field_id('r_view'); ?>" name="<?php echo $this->get_field_name('r_view'); ?>">
			<option value="0"<?php if($r_view == 0){echo ' selected="selected"';} ?>>表示する</option>
			<option value="1"<?php if($r_view == 1){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>


		<?php do_action( 'jsearch_widget_form2', $this, $instance );?>


		<p><label for="<?php echo $this->get_field_id('c_view'); ?>">
		地域表示 <select class="widefat" id="<?php echo $this->get_field_id('c_view'); ?>" name="<?php echo $this->get_field_name('c_view'); ?>">
			<option value="0"<?php if($c_view == 0){echo ' selected="selected"';} ?>>表示する</option>
			<option value="1"<?php if($c_view == 1){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('kak_view'); ?>">
		価格表示 <select class="widefat" id="<?php echo $this->get_field_id('kak_view'); ?>" name="<?php echo $this->get_field_name('kak_view'); ?>">
			<option value="0"<?php if($kak_view == 0){echo ' selected="selected"';} ?>>表示する</option>
			<option value="1"<?php if($kak_view == 1){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>


		<p><label for="<?php echo $this->get_field_id('hof_view'); ?>">
		駅歩分表示 <select class="widefat" id="<?php echo $this->get_field_id('hof_view'); ?>" name="<?php echo $this->get_field_name('hof_view'); ?>">
			<option value="0"<?php if($hof_view == 0){echo ' selected="selected"';} ?>>表示する</option>
			<option value="1"<?php if($hof_view == 1){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('mad_view'); ?>">
		間取り表示 <select class="widefat" id="<?php echo $this->get_field_id('mad_view'); ?>" name="<?php echo $this->get_field_name('mad_view'); ?>">
			<option value="0"<?php if($mad_view == 0){echo ' selected="selected"';} ?>>表示する</option>
			<option value="1"<?php if($mad_view == 1){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('tik_view'); ?>">
		築年数表示 <select class="widefat" id="<?php echo $this->get_field_id('tik_view'); ?>" name="<?php echo $this->get_field_name('tik_view'); ?>">
			<option value="0"<?php if($tik_view == 0){echo ' selected="selected"';} ?>>表示する</option>
			<option value="1"<?php if($tik_view == 1){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>

		<p><label for="<?php echo $this->get_field_id('men_view'); ?>">
		面積表示 <select class="widefat" id="<?php echo $this->get_field_id('men_view'); ?>" name="<?php echo $this->get_field_name('men_view'); ?>">
			<option value="0"<?php if($men_view == 0){echo ' selected="selected"';} ?>>表示する</option>
			<option value="1"<?php if($men_view == 1){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label></p>



		<?php do_action( 'jsearch_widget_form3', $this, $instance );?>

		<?php if( $is_fudouchoumei ){ ?>
		<p><label for="<?php echo $this->get_field_id('choumei_view'); ?>">
		町名表示 <select class="widefat" id="<?php echo $this->get_field_id('choumei_view'); ?>" name="<?php echo $this->get_field_name('choumei_view'); ?>">
			<option value="0"<?php if($choumei_view == 0){echo ' selected="selected"';} ?>>表示しない</option>
			<option value="1"<?php if($choumei_view == 1){echo ' selected="selected"';} ?>>セレクトボックス</option>
			<option value="2"<?php if($choumei_view == 2){echo ' selected="selected"';} ?>>チェックボックス</option>
		</select></label></p>
		<?php } ?>

		<?php do_action( 'jsearch_widget_form4', $this, $instance );?>


		<p><label for="<?php echo $this->get_field_id('set_view'); ?>">
		設備表示 <select class="widefat" id="<?php echo $this->get_field_id('set_view'); ?>" name="<?php echo $this->get_field_name('set_view'); ?>">
			<option value="0"<?php if($set_view == 0){echo ' selected="selected"';} ?>>表示する</option>
			<option value="1"<?php if($set_view == 1){echo ' selected="selected"';} ?>>表示しない</option>
		</select></label> 

		<a href="options-general.php?page=fudou/admin/admin_fudou.php#set" target="_blank" rel="noopener">設備項目設定</a></label></p>
<?php 

	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {

		if( !is_customize_preview() ){
			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_title',  	esc_attr( $new_instance['title'] ) );
			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_view1',  	esc_attr( $new_instance['view1'] ) );

			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_r_view', 	esc_attr( $new_instance['r_view'] ) );
			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_c_view', 	esc_attr( $new_instance['c_view'] ) );
			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_kak_view', 	esc_attr( $new_instance['kak_view'] ) );
			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_hof_view', 	esc_attr( $new_instance['hof_view'] ) );
			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_mad_view', 	esc_attr( $new_instance['mad_view'] ) );
			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_tik_view', 	esc_attr( $new_instance['tik_view'] ) );
			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_men_view', 	esc_attr( $new_instance['men_view'] ) );
			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_set_view', 	esc_attr( $new_instance['set_view'] ) );

			$this->fudo_widget_b_k_option( 'widget_fudo_b_k_choumei_view', esc_attr( $new_instance['choumei_view'] ) );
		}
		return apply_filters( 'jsearch_widget_form_update', $new_instance, $old_instance );
		//return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {

		global $wpdb;
		global $work_bukkenshubetsu;
		global $work_setsubi;
		global $work_madori;

		//２重表示防止
		global $fudo_b_k;
		if( $fudo_b_k ){
			return;
		}else{
			$fudo_b_k = 1;
		}

		// inmap時表示防止 v5.9.0
		global $wp_query;
		$inmap_endpoint = apply_filters( 'inmap_endpoint', 'map' );
		$pagename = isset($wp_query->query_vars['name']) ? $wp_query->query_vars['name'] : '';	//rewrite
    		$page = isset($_GET['page']) ? esc_attr( stripslashes( $_GET['page'])) : '' ;
    		if( ( $page == $inmap_endpoint && is_front_page() ) || $pagename == $inmap_endpoint ){
			return;
		}


		//WordPressのアドレス(URL)
		//$site = site_url( '/' ); 
		//サイトのアドレス(URL)
		$site = home_url( '/' );

		echo '<!--  ver5.8.0 -->';


		$title    = isset($instance['title'])  	 ? esc_attr( apply_filters( 'widget_title', $instance['title'] ) ) : '';
		$view1    = isset($instance['view1'])  	 ? esc_attr( $instance['view1'] ) : '';		//表示種類
		$r_view   = isset($instance['r_view']) 	 ? esc_attr( $instance['r_view'] ) : '';	//路線
		$c_view   = isset($instance['c_view']) 	 ? esc_attr( $instance['c_view'] ) : '';	//地域
		$kak_view = isset($instance['kak_view']) ? esc_attr( $instance['kak_view'] ) : '';	//価格
		$hof_view = isset($instance['hof_view']) ? esc_attr( $instance['hof_view'] ) : '';	//駅歩分
		$mad_view = isset($instance['mad_view']) ? esc_attr( $instance['mad_view'] ) : '';	//間取り
		$tik_view = isset($instance['tik_view']) ? esc_attr( $instance['tik_view'] ) : '';	//築年数
		$men_view = isset($instance['men_view']) ? esc_attr( $instance['men_view'] ) : '';	//面積
		$set_view = isset($instance['set_view']) ? esc_attr( $instance['set_view'] ) : '';	//設備


		echo $args['before_widget'];

		//title
		if ( $title ){
			echo $args['before_title'] . $title . $args['after_title'];
		}else{
			echo $args['before_title'] . '物件検索' . $args['after_title'];
		}

		//種別
		$shu_id = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';
		$shu_data = '';
		if($shu_id == '1') $shu_data = '< 3000' ;
		if($shu_id == '2') $shu_data = '> 3000' ;
		if(intval($shu_id) > 3) $shu_data = '= ' .$shu_id ;


		$ros_id = isset($_GET['ros']) ? myIsNum_f($_GET['ros']) : ''; 		//路線
		$eki_id = isset($_GET['eki']) ? myIsNum_f($_GET['eki']) : ''; 		//駅
		$ken_id = isset($_GET['ken']) ? myIsNum_f($_GET['ken']) : ''; 		//県
		$sik_id = isset($_GET['sik']) ? myIsNum_f($_GET['sik']) : ''; 		//市区

		$set_id    = isset($_GET['set']) ? myIsNum_f($_GET['set']) : ''; 	//設備
		$madori_id = isset($_GET['mad']) ? myIsNum_f($_GET['mad']) : ''; 	//間取り

		$kalb_data = isset($_GET['kalb']) ? myIsNum_f($_GET['kalb']) : ''; 	//価格下限
		$kahb_data = isset($_GET['kahb']) ? myIsNum_f($_GET['kahb']) : ''; 	//価格上限

		$kalc_data = isset($_GET['kalc']) ? myIsNum_f($_GET['kalc']) : ''; 	//価格下限
		$kahc_data = isset($_GET['kahc']) ? myIsNum_f($_GET['kahc']) : ''; 	//価格上限

		$tik_data  = isset($_GET['tik'])  ? myIsNum_f($_GET['tik']) : '';  	//築年数

		$hof_data  = isset($_GET['hof'])  ? myIsNum_f($_GET['hof']) : '';  	//歩分
		$mel_data  = isset($_GET['mel'])  ? myIsNum_f($_GET['mel']) : '';  	//面積下限
		$meh_data  = isset($_GET['meh'])  ? myIsNum_f($_GET['meh']) : '';  	//面積上限


		//価格切り替え
		$kakaku_b_style = 'div.kakaku_b { display:none; }';
		$kakaku_c_style = 'div.kakaku_c { display:none; }';
		if($shu_id == 1 || ($shu_id > 999 && $shu_id < 3000) ) {
			$kakaku_b_style = 'div.kakaku_b { display:block; }';
			$kakaku_c_style = 'div.kakaku_c { display:none; }';
		}
		if($shu_id == 2 || $shu_id > 3000 ) {
			$kakaku_b_style = 'div.kakaku_b { display:none; }';
			$kakaku_c_style = 'div.kakaku_c { display:block; }';
		}
		echo '<style type="text/css">';
		echo $kakaku_b_style;
		echo $kakaku_c_style;
		echo '</style>';


		//カテゴリ
		$bukken  = isset($_GET['bukken'])	? esc_attr( stripslashes( $_GET['bukken'] )) : '';  		//カテゴリ
		$bukken2 = isset($_GET['bk'])		? esc_attr( stripslashes( $_GET['bk'])) : '';  			//カテゴリ

		if( $bukken == 'rosen' || $bukken == 'station' || $bukken2 == 'rosen' || $bukken2 == 'station'  ){
			$ros_id = isset($_GET['mid']) ? myIsNum_f($_GET['mid']) : ''; 		//路線
			$eki_id = isset($_GET['nor']) ? myIsNum_f($_GET['nor']) : ''; 		//駅
		}

		if( $bukken == 'ken' || $bukken  == 'shiku' || $bukken2 == 'ken' || $bukken2  == 'shiku'  ){
			$ken_id = isset($_GET['mid']) ? myIsNum_f($_GET['mid']) : ''; 		//県
			$sik_id = isset($_GET['nor']) ? myIsNum_f($_GET['nor']) : ''; 		//市区
		}


		//条件検索後用 非同期 遅延読み込み
		echo '<script type="text/javascript">';
			//間取り
			$madori_ar_txt = 'var madori_ar = new Array("0"';
			if(is_array($madori_id)) {
				foreach($madori_id as $meta_box4){
					if( (int)$meta_box4 ){
						$madori_ar_txt .= ',"'.$meta_box4.'"';
					}
				}
			}
			$madori_ar_txt .= ');';
			echo $madori_ar_txt;

			//設備
			$set_ar_txt = 'var set_ar = new Array("0"';
			if(is_array($set_id)) {
				foreach($set_id as $meta_box5){
					if( (int)$meta_box5 ){
						$set_ar_txt .= ',"'.$meta_box5.'"';
					}
				}
			}
			$set_ar_txt .= ');';
			echo $set_ar_txt;
			if($shu_id != ''){
			?>
				addOnload_jyoken(function() { setTimeout(SShu2,500); });
				function addOnload_jyoken(func){
					try {
						window.addEventListener("load", func, false);
					} catch (e) {   
						window.attachEvent("onload", func);   	// IE用
					}
				}
			<?php
			}
		echo '</script>';

		echo '<form method="get" id="searchitem" name="searchitem" action="'.$site.'" >';
		echo '<input type="hidden" name="bukken" value="jsearch" >';
		//echo '<input type="hidden" name="nonce" value="' .wp_create_nonce( 'fudou_jsearch_nonce' ) . '" />';

		//for add_action
		do_action( 'jsearch_widget1', $instance );

		echo '<div class="jsearch_caution1">ご希望の種別を選択して下さい</div>';

		//種別選択
		echo '<div id="shubetsu" class="shubetsu">';
		echo '<select title="種別選択" name="shu" id="shu" onchange="SShu(this)">';
		echo '<option value="0">種別選択</option>';

		//売買
		if( $view1 < 2 ){

			$sql  =  " SELECT DISTINCT PM.meta_value AS bukkenshubetsu";
			$sql .=  " FROM ($wpdb->posts AS P ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id) ";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'fudo_b_k' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
			$sql .=  " AND PM.meta_key='bukkenshubetsu' ";
			$sql .=  " AND CAST( PM.meta_value AS SIGNED ) < 3000 ";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'fudo_b_k' );

			$sql .=  " ORDER BY PM.meta_value";
			//$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );

			if(!empty($metas)) {

				echo '<option value="1"';
				if($shu_id == '1' )
					echo ' selected="selected"';
				echo '>売買　全て</option>';

				foreach ( $metas as $meta ) {
					$bukkenshubetsu_id = $meta['bukkenshubetsu'];

					foreach($work_bukkenshubetsu as $meta_box){
						if( $bukkenshubetsu_id ==  $meta_box['id'] ){
							echo '<option value="'.$meta_box['id'].'"';
							if($shu_id == $meta_box['id'] )
								echo ' selected="selected"';
							echo '>'.$meta_box['name'].'</option>';
						}
					}
				}
			}
		}

		//賃貸
		if( $view1 != 1 ){

			$sql  =  " SELECT DISTINCT PM.meta_value AS bukkenshubetsu";
			$sql .=  " FROM ($wpdb->posts AS P ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id) ";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'fudo_b_k' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
			$sql .=  " AND PM.meta_key='bukkenshubetsu' ";
			$sql .=  " AND CAST( PM.meta_value AS SIGNED ) > 3000 ";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'fudo_b_k' );

			$sql .=  " ORDER BY PM.meta_value";
			//$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );

			if(!empty($metas)) {
				echo '<option value="2"';
				if($shu_id == '2' )
					echo ' selected="selected"';
				echo '>賃貸　全て</option>';

				foreach ( $metas as $meta ) {
					$bukkenshubetsu_id = $meta['bukkenshubetsu'];

					foreach($work_bukkenshubetsu as $meta_box){
						if( $bukkenshubetsu_id ==  $meta_box['id'] ){
							echo '<option value="'.$meta_box['id'].'"';
							if($shu_id == $meta_box['id'] )
								echo ' selected="selected"';
							echo '>'.$meta_box['name'].'</option>';
						}
					}
				}
			}
		}

		echo '</select>';
		echo '</div>';


		echo '<div class="jsearch_caution2">以下ご希望の条件を選択して物件検索ボタンを押して下さい</div>';

		//for add_action
		do_action( 'jsearch_widget2', $instance );

		//路線選択
		if( $r_view != 1 ){

			echo '<div id="roseneki" class="roseneki">';
			echo '<span class="jsearch_roseneki">駅選択</span><br />';
			echo '<select title="路線選択" name="ros" id="ros" onchange="SEki(this)">';
			echo '<option value="0">路線選択</option>';

			if( $shu_data !=''){

				$sql  =  " SELECT DISTINCT DTR.rosen_name, PM.meta_value AS rosen_id";
				$sql .=  " FROM ((($wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
				$sql .=  " INNER JOIN " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR ON CAST( PM.meta_value AS SIGNED ) = DTR.rosen_id)";

				//検索 SQL 表示制限 INNER JOIN
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
				//New 検索 SQL 表示制限 INNER JOIN v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'fudo_b_k' );

				$sql .=  " WHERE (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
				$sql .=  " AND P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' AND PM_1.meta_key='bukkenshubetsu'";
				$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) " . $shu_data;

				//検索 SQL 表示制限 WHERE
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
				//New 検索 SQL 表示制限 WHERE v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'fudo_b_k' );

				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_results( $sql,  ARRAY_A );

				if(!empty($metas)) {

					arsort($metas);

					foreach ( $metas as $meta ) {
						echo '<option value="'.$meta['rosen_id'].'"';
						if($ros_id == $meta['rosen_id'] )
							echo ' selected="selected"';
						echo '>'.$meta['rosen_name'].'</option>';
					}
				}
			}

			echo '</select><br />';


			//駅選択
			echo '<select title="駅選択" name="eki" id="eki">';
			echo '<option value="0">駅選択</option>';

			if( $shu_data && $ros_id ){

				$sql  =  " SELECT DISTINCT PM.meta_value AS station_id ";
				$sql .=  " FROM ((( $wpdb->posts AS P ";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id )";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id )";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id )";

				//検索 SQL 表示制限 INNER JOIN
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
				//New 検索 SQL 表示制限 INNER JOIN v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'fudo_b_k' );

				$sql .=  " WHERE";
				$sql .=  " (";
				$sql .=  " 	P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
				$sql .=  " 	AND PM.meta_key='koutsueki1'";
				$sql .=  " 	AND PM_1.meta_key='koutsurosen1' AND PM_1.meta_value = ".$ros_id."";
				$sql .=  " 	AND PM_2.meta_key='bukkenshubetsu' AND PM_2.meta_value ".$shu_data."";

				//検索 SQL 表示制限 WHERE
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
				//New 検索 SQL 表示制限 WHERE v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'fudo_b_k' );

				$sql .=  " )";
				$sql .=  " or";
				$sql .=  " (";
				$sql .=  " 	P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
				$sql .=  " 	AND PM.meta_key='koutsueki2'";
				$sql .=  " 	AND PM_1.meta_key='koutsurosen2' AND PM_1.meta_value = ".$ros_id."";
				$sql .=  " 	AND PM_2.meta_key='bukkenshubetsu' AND PM_2.meta_value ".$shu_data."";

				//検索 SQL 表示制限 WHERE
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
				//New 検索 SQL 表示制限 WHERE v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'fudo_b_k' );

				$sql .=  " )";
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_results( $sql,  ARRAY_A );

				$tmp_eki = '';
				if(!empty($metas)) {
					$tmp_eki = '0';
					foreach ( $metas as $meta ) {
						if( $meta['station_id'] != '')
							$tmp_eki .= ','. $meta['station_id'];
					}
				}

				if( $tmp_eki != ''){
					$sql  =  " SELECT DISTINCT DTS.station_name , DTS.station_id ";
					$sql .=  " FROM " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS";
					$sql .=  " WHERE DTS.rosen_id=".$ros_id." AND DTS.station_id in (".$tmp_eki.") ";
					$sql .=  " ORDER BY DTS.station_ranking";
				//	$sql = $wpdb->prepare($sql,'');
					$metas = $wpdb->get_results( $sql,  ARRAY_A );
					if(!empty($metas)) {

						foreach ( $metas as $meta ) {
							echo '<option value="'.$meta['station_id'].'"';
							if($eki_id == $meta['station_id'] )
								echo ' selected="selected"';
							echo '>'.$meta['station_name'].'</option>';
						}
					}
				}

			}
			echo '</select>';
			echo '</div>';
		}


		//for add_action
		do_action( 'jsearch_widget3', $instance );
		do_action( 'jsearch_widget3a', $instance );


		//地域選択
		if( $c_view != 1 ){

			//県選択
			echo '<div id="chiiki" class="chiiki">';
			echo '<span class="jsearch_chiiki">市区選択</span><br />';
			echo '<select title="県選択" name="ken" id="ken" onchange="SSik(this)">';
			echo '<option value="0">県選択</option>';

			if( $shu_data !=''){
				$sql  =  " SELECT DISTINCT MA.middle_area_name, PM.meta_value AS middle_area_id";
				$sql .=  " FROM ((($wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
				$sql .=  " INNER JOIN " . $wpdb->prefix . DB_KEN_TABLE . " AS MA ON CAST( PM.meta_value AS SIGNED ) = MA.middle_area_id)";

				//検索 SQL 表示制限 INNER JOIN
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
				//New 検索 SQL 表示制限 INNER JOIN v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'fudo_b_k' );

				$sql .=  " WHERE PM.meta_key='shozaichiken' ";
				$sql .=  " AND P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
				$sql .=  " AND PM_1.meta_key='bukkenshubetsu'";
				$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) ".$shu_data."";

				//検索 SQL 表示制限 WHERE
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
				//New 検索 SQL 表示制限 WHERE v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'fudo_b_k' );

				$sql .=  " ORDER BY CAST( PM.meta_value AS SIGNED )";
			//	$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_results( $sql,  ARRAY_A );
				if(!empty($metas)) {

					foreach ( $metas as $meta ) {
						echo '<option value="'.$meta['middle_area_id'].'"';
						if($ken_id == $meta['middle_area_id'] )
							echo ' selected="selected"';
						echo '>'.$meta['middle_area_name'].'</option>';
					}
				}
			}
			echo '</select><br />';


			//市区選択
			echo '<select title="市区選択" name="sik" id="sik">';
			echo '<option value="0">市区選択</option>';

			if( $shu_data !='' && $ken_id !='' ){

				$sql  =  " SELECT DISTINCT NA.narrow_area_name, CAST( RIGHT(LEFT(PM.meta_value,5),3) AS SIGNED ) AS narrow_area_id";
				$sql .=  " FROM ((($wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
				$sql .=  " INNER JOIN " . $wpdb->prefix . DB_SHIKU_TABLE . " AS NA ON CAST( RIGHT(LEFT(PM.meta_value,5),3) AS SIGNED ) = NA.narrow_area_id)";

				//検索 SQL 表示制限 INNER JOIN
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
				//New 検索 SQL 表示制限 INNER JOIN v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'fudo_b_k' );

				$sql .=  " WHERE PM.meta_key='shozaichicode' ";
				$sql .=  " AND P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
				$sql .=  " AND PM_1.meta_key='bukkenshubetsu'";
				$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) ".$shu_data."";
				$sql .=  " AND CAST( LEFT(PM.meta_value,2) AS SIGNED ) = ". $ken_id;
				$sql .=  " AND NA.middle_area_id = ". $ken_id;

				//検索 SQL 表示制限 WHERE
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
				//New 検索 SQL 表示制限 WHERE v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'fudo_b_k' );

				$sql .=  " ORDER BY CAST( PM.meta_value AS SIGNED )";
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_results( $sql,  ARRAY_A );
				if(!empty($metas)) {
					foreach ( $metas as $meta ) {
						echo '<option value="'.$meta['narrow_area_id'].'"';
						if( $sik_id == $meta['narrow_area_id'] )
							echo ' selected="selected"';
						echo '>'.$meta['narrow_area_name'].'</option>';
					}
				}
			}
			echo '</select>';
			echo '</div>';

		}	//$c_view


		//for add_action
		do_action( 'jsearch_widget4', $instance );


		//価格選択
		if( $kak_view != 1 ){
			echo '<div id="kakaku_c" class="kakaku_c">';
			echo '<span class="jsearch_kakaku">賃料</span><br />';
			echo '<select title="賃料選択 下限" name="kalc" id="kalc" class="half_size">';
			echo '<option value="0">下限なし</option>';
			echo '<option value="3"'; 			if ($kalc_data == '3') echo ' selected="selected"';			echo '>3万円</option>';
			echo '<option value="4"';			if ($kalc_data == '4') echo ' selected="selected"';			echo '>4万円</option>';
			echo '<option value="5"';			if ($kalc_data == '5') echo ' selected="selected"';			echo '>5万円</option>';
			echo '<option value="6"';			if ($kalc_data == '6') echo ' selected="selected"';			echo '>6万円</option>';
			echo '<option value="7"';			if ($kalc_data == '7') echo ' selected="selected"';			echo '>7万円</option>';
			echo '<option value="8"';			if ($kalc_data == '8') echo ' selected="selected"';			echo '>8万円</option>';
			echo '<option value="9"';			if ($kalc_data == '9') echo ' selected="selected"';			echo '>9万円</option>';
			echo '<option value="10"';			if ($kalc_data == '10') echo ' selected="selected"';			echo '>10万円</option>';
			echo '<option value="11"';			if ($kalc_data == '11') echo ' selected="selected"';			echo '>11万円</option>';
			echo '<option value="12"';			if ($kalc_data == '12') echo ' selected="selected"';			echo '>12万円</option>';
			echo '<option value="13"';			if ($kalc_data == '13') echo ' selected="selected"';			echo '>13万円</option>';
			echo '<option value="14"';			if ($kalc_data == '14') echo ' selected="selected"';			echo '>14万円</option>';
			echo '<option value="15"';			if ($kalc_data == '15') echo ' selected="selected"';			echo '>15万円</option>';
			echo '<option value="16"';			if ($kalc_data == '16') echo ' selected="selected"';			echo '>16万円</option>';
			echo '<option value="17"';			if ($kalc_data == '17') echo ' selected="selected"';			echo '>17万円</option>';
			echo '<option value="18"';			if ($kalc_data == '18') echo ' selected="selected"';			echo '>18万円</option>';
			echo '<option value="19"';			if ($kalc_data == '19') echo ' selected="selected"';			echo '>19万円</option>';
			echo '<option value="20"';			if ($kalc_data == '20') echo ' selected="selected"';			echo '>20万円</option>';
			echo '<option value="30"';			if ($kalc_data == '30') echo ' selected="selected"';			echo '>30万円</option>';
			echo '<option value="50"';			if ($kalc_data == '50') echo ' selected="selected"';			echo '>50万円</option>';
			echo '<option value="100"';			if ($kalc_data == '100') echo ' selected="selected"';			echo '>100万円</option>';
			echo '</select>～';

			echo '<select title="賃料選択 上限" name="kahc" id="kahc" class="half_size">';
			echo '<option value="3"';			if ($kahc_data == '3') echo ' selected="selected"';			echo '>3万円</option>';
			echo '<option value="4"';			if ($kahc_data == '4') echo ' selected="selected"';			echo '>4万円</option>';
			echo '<option value="5"';			if ($kahc_data == '5') echo ' selected="selected"';			echo '>5万円</option>';
			echo '<option value="6"';			if ($kahc_data == '6') echo ' selected="selected"';			echo '>6万円</option>';
			echo '<option value="7"';			if ($kahc_data == '7') echo ' selected="selected"';			echo '>7万円</option>';
			echo '<option value="8"';			if ($kahc_data == '8') echo ' selected="selected"';			echo '>8万円</option>';
			echo '<option value="9"';			if ($kahc_data == '9') echo ' selected="selected"';			echo '>9万円</option>';
			echo '<option value="10"';			if ($kahc_data == '10') echo ' selected="selected"';			echo '>10万円</option>';
			echo '<option value="11"';			if ($kahc_data == '11') echo ' selected="selected"';			echo '>11万円</option>';
			echo '<option value="12"';			if ($kahc_data == '12') echo ' selected="selected"';			echo '>12万円</option>';
			echo '<option value="13"';			if ($kahc_data == '13') echo ' selected="selected"';			echo '>13万円</option>';
			echo '<option value="14"';			if ($kahc_data == '14') echo ' selected="selected"';			echo '>14万円</option>';
			echo '<option value="15"';			if ($kahc_data == '15') echo ' selected="selected"';			echo '>15万円</option>';
			echo '<option value="16"';			if ($kahc_data == '16') echo ' selected="selected"';			echo '>16万円</option>';
			echo '<option value="17"';			if ($kahc_data == '17') echo ' selected="selected"';			echo '>17万円</option>';
			echo '<option value="18"';			if ($kahc_data == '18') echo ' selected="selected"';			echo '>18万円</option>';
			echo '<option value="19"';			if ($kahc_data == '19') echo ' selected="selected"';			echo '>19万円</option>';
			echo '<option value="20"';			if ($kahc_data == '20') echo ' selected="selected"';			echo '>20万円</option>';
			echo '<option value="30"';			if ($kahc_data == '30') echo ' selected="selected"';			echo '>30万円</option>';
			echo '<option value="50"';			if ($kahc_data == '50') echo ' selected="selected"';			echo '>50万円</option>';
			echo '<option value="100"';			if ($kahc_data == '100') echo ' selected="selected"';			echo '>100万円</option>';
			echo '<option value="0"';			if ($kahc_data == '0' ||$kahc_data == '' ) echo ' selected="selected"';			echo '>上限なし</option>';
			echo '</select>';
			echo '</div>';



			echo '<div id="kakaku_b" class="kakaku_b">';
			echo '<span class="jsearch_kakaku">価格</span><br />';
			echo '<select title="価格選択 下限" name="kalb" id="kalb" class="half_size">';
			echo '<option value="0">下限なし</option>';
			echo '<option value="300"'; 			if ($kalb_data == '300') echo ' selected="selected"';			echo '>300万円</option>';
			echo '<option value="400"';			if ($kalb_data == '400') echo ' selected="selected"';			echo '>400万円</option>';
			echo '<option value="500"';			if ($kalb_data == '500') echo ' selected="selected"';			echo '>500万円</option>';
			echo '<option value="600"';			if ($kalb_data == '600') echo ' selected="selected"';			echo '>600万円</option>';
			echo '<option value="700"';			if ($kalb_data == '700') echo ' selected="selected"';			echo '>700万円</option>';
			echo '<option value="800"';			if ($kalb_data == '800') echo ' selected="selected"';			echo '>800万円</option>';
			echo '<option value="900"';			if ($kalb_data == '900') echo ' selected="selected"';			echo '>900万円</option>';
			echo '<option value="1000"';			if ($kalb_data == '1000') echo ' selected="selected"';			echo '>1000万円</option>';
			echo '<option value="1100"';			if ($kalb_data == '1100') echo ' selected="selected"';			echo '>1100万円</option>';
			echo '<option value="1200"';			if ($kalb_data == '1200') echo ' selected="selected"';			echo '>1200万円</option>';
			echo '<option value="1300"';			if ($kalb_data == '1300') echo ' selected="selected"';			echo '>1300万円</option>';
			echo '<option value="1400"';			if ($kalb_data == '1400') echo ' selected="selected"';			echo '>1400万円</option>';
			echo '<option value="1500"';			if ($kalb_data == '1500') echo ' selected="selected"';			echo '>1500万円</option>';
			echo '<option value="1600"';			if ($kalb_data == '1600') echo ' selected="selected"';			echo '>1600万円</option>';
			echo '<option value="1700"';			if ($kalb_data == '1700') echo ' selected="selected"';			echo '>1700万円</option>';
			echo '<option value="1800"';			if ($kalb_data == '1800') echo ' selected="selected"';			echo '>1800万円</option>';
			echo '<option value="1900"';			if ($kalb_data == '1900') echo ' selected="selected"';			echo '>1900万円</option>';
			echo '<option value="2000"';			if ($kalb_data == '2000') echo ' selected="selected"';			echo '>2000万円</option>';
			echo '<option value="3000"';			if ($kalb_data == '3000') echo ' selected="selected"';			echo '>3000万円</option>';
			echo '<option value="5000"';			if ($kalb_data == '5000') echo ' selected="selected"';			echo '>5000万円</option>';
			echo '<option value="7000"';			if ($kalb_data == '7000') echo ' selected="selected"';			echo '>7000万円</option>';
			echo '<option value="10000"';			if ($kalb_data == '10000') echo ' selected="selected"';			echo '>1億円</option>';
			echo '</select>～';

			echo '<select title="価格選択 上限" name="kahb" id="kahb" class="half_size">';
			echo '<option value="300"';			if ($kahb_data == '300') echo ' selected="selected"';			echo '>300万円</option>';
			echo '<option value="400"';			if ($kahb_data == '400') echo ' selected="selected"';			echo '>400万円</option>';
			echo '<option value="500"';			if ($kahb_data == '500') echo ' selected="selected"';			echo '>500万円</option>';
			echo '<option value="600"';			if ($kahb_data == '600') echo ' selected="selected"';			echo '>600万円</option>';
			echo '<option value="700"';			if ($kahb_data == '700') echo ' selected="selected"';			echo '>700万円</option>';
			echo '<option value="800"';			if ($kahb_data == '800') echo ' selected="selected"';			echo '>800万円</option>';
			echo '<option value="900"';			if ($kahb_data == '900') echo ' selected="selected"';			echo '>900万円</option>';
			echo '<option value="1000"';			if ($kahb_data == '1000') echo ' selected="selected"';			echo '>1000万円</option>';
			echo '<option value="1100"';			if ($kahb_data == '1100') echo ' selected="selected"';			echo '>1100万円</option>';
			echo '<option value="1200"';			if ($kahb_data == '1200') echo ' selected="selected"';			echo '>1200万円</option>';
			echo '<option value="1300"';			if ($kahb_data == '1300') echo ' selected="selected"';			echo '>1300万円</option>';
			echo '<option value="1400"';			if ($kahb_data == '1400') echo ' selected="selected"';			echo '>1400万円</option>';
			echo '<option value="1500"';			if ($kahb_data == '1500') echo ' selected="selected"';			echo '>1500万円</option>';
			echo '<option value="1600"';			if ($kahb_data == '1600') echo ' selected="selected"';			echo '>1600万円</option>';
			echo '<option value="1700"';			if ($kahb_data == '1700') echo ' selected="selected"';			echo '>1700万円</option>';
			echo '<option value="1800"';			if ($kahb_data == '1800') echo ' selected="selected"';			echo '>1800万円</option>';
			echo '<option value="1900"';			if ($kahb_data == '1900') echo ' selected="selected"';			echo '>1900万円</option>';
			echo '<option value="2000"';			if ($kahb_data == '2000') echo ' selected="selected"';			echo '>2000万円</option>';
			echo '<option value="3000"';			if ($kahb_data == '3000') echo ' selected="selected"';			echo '>3000万円</option>';
			echo '<option value="5000"';			if ($kahb_data == '5000') echo ' selected="selected"';			echo '>5000万円</option>';
			echo '<option value="7000"';			if ($kahb_data == '7000') echo ' selected="selected"';			echo '>7000万円</option>';
			echo '<option value="10000"';			if ($kahb_data == '10000') echo ' selected="selected"';			echo '>1億円</option>';
			echo '<option value="0"';			if ($kahb_data == '0' ||$kahb_data == '' ) echo ' selected="selected"';			echo '>上限なし</option>';
			echo '</select>';
			echo '</div>';

		}	//$kak_view

		//for add_action
		do_action( 'jsearch_widget5', $instance );


		//駅歩分
		if( $hof_view != 1 ){
			echo '<div id="hofun" class="hofun">';
			echo '<span class="jsearch_hofun">駅歩分</span><br />';
			echo '<select title="駅歩分選択" name="hof" id="hofn">';
			echo '<option value="0">指定なし</option>';
			echo '<option value="1"';
				if ($hof_data == '1') echo ' selected="selected"';
				echo '>1分以内</option>';
			echo '<option value="3"';
				if ($hof_data == '3') echo ' selected="selected"';
				echo '>3分以内</option>';
			echo '<option value="5"';
				if ($hof_data == '5') echo ' selected="selected"';
				echo '>5分以内</option>';
			echo '<option value="10"';
				if ($hof_data == '10') echo ' selected="selected"';
				echo '>10分以内</option>';
			echo '<option value="15"';
				if ($hof_data == '15') echo ' selected="selected"';
				echo '>15分以内</option>';
			echo '</select>';
			echo '</div>';
		}


		//for add_action
		do_action( 'jsearch_widget6', $instance );


		//間取り
		if( $mad_view != 1 ){
			echo '<div id="madori_cb" class="madori_cb"></div>';
		}

		//for add_action
		do_action( 'jsearch_widget7', $instance );


		//築年数
		if( $tik_view != 1 ){
			echo '<div id="chikunen" class="chikunen">';
			echo '<span class="jsearch_chikunen">築年数</span><br />';
			echo '<select title="築年数選択" name="tik" id="tik">';
			echo '<option value="0">指定なし</option>';
			echo '<option value="1"';			if ($tik_data == '1') echo ' selected="selected"';			echo '>1年以内</option>';
			echo '<option value="3"';			if ($tik_data == '3') echo ' selected="selected"';			echo '>3年以内</option>';
			echo '<option value="5"';			if ($tik_data == '5') echo ' selected="selected"';			echo '>5年以内</option>';
			echo '<option value="10"';			if ($tik_data == '10') echo ' selected="selected"';			echo '>10年以内</option>';
			echo '<option value="15"';			if ($tik_data == '15') echo ' selected="selected"';			echo '>15年以内</option>';
			echo '<option value="20"';			if ($tik_data == '20') echo ' selected="selected"';			echo '>20年以内</option>';
			echo '</select>';
			echo '</div>';
		}


		//for add_action
		do_action( 'jsearch_widget8a', $instance );


		//面積
		if( $men_view != 1 ){

			//for add_action
			do_action( 'jsearch_widget8', $instance );

			/**
			 * 面積を表示/非表示.
			 * 
			 * apply_filters( 'fudou_joken_memseki_view', true )
			 * Version: 1.9.2
			 */
			if( apply_filters( 'fudou_joken_memseki_view', true ) ){

				//面積
				echo '<div id="memseki" class="memseki">';
				echo '<span class="jsearch_memseki">面積</span><br />';
				echo '<select title="面積選択 下限" name="mel" id="mel" class="half_size">';
				echo '<option value="0">下限なし</option>';
				echo '<option value="10"';			if ($mel_data == '10') echo ' selected="selected"';			echo '>10m&sup2;</option>';
				echo '<option value="15"';			if ($mel_data == '15') echo ' selected="selected"';			echo '>15m&sup2;</option>';
				echo '<option value="20"';			if ($mel_data == '20') echo ' selected="selected"';			echo '>20m&sup2;</option>';
				echo '<option value="25"';			if ($mel_data == '25') echo ' selected="selected"';			echo '>25m&sup2;</option>';
				echo '<option value="30"';			if ($mel_data == '30') echo ' selected="selected"';			echo '>30m&sup2;</option>';
				echo '<option value="35"';			if ($mel_data == '35') echo ' selected="selected"';			echo '>35m&sup2;</option>';
				echo '<option value="40"';			if ($mel_data == '40') echo ' selected="selected"';			echo '>40m&sup2;</option>';
				echo '<option value="50"';			if ($mel_data == '50') echo ' selected="selected"';			echo '>50m&sup2;</option>';
				echo '<option value="60"';			if ($mel_data == '60') echo ' selected="selected"';			echo '>60m&sup2;</option>';
				echo '<option value="70"';			if ($mel_data == '70') echo ' selected="selected"';			echo '>70m&sup2;</option>';
				echo '<option value="80"';			if ($mel_data == '80') echo ' selected="selected"';			echo '>80m&sup2;</option>';
				echo '<option value="90"';			if ($mel_data == '90') echo ' selected="selected"';			echo '>90m&sup2;</option>';
				echo '<option value="100"';			if ($mel_data == '100') echo ' selected="selected"';			echo '>100m&sup2;</option>';
				echo '<option value="200"';			if ($mel_data == '200') echo ' selected="selected"';			echo '>200m&sup2;</option>';
				echo '<option value="300"';			if ($mel_data == '300') echo ' selected="selected"';			echo '>300m&sup2;</option>';
				echo '<option value="400"';			if ($mel_data == '400') echo ' selected="selected"';			echo '>400m&sup2;</option>';
				echo '<option value="500"';			if ($mel_data == '500') echo ' selected="selected"';			echo '>500m&sup2;</option>';
				echo '<option value="600"';			if ($mel_data == '600') echo ' selected="selected"';			echo '>600m&sup2;</option>';
				echo '<option value="700"';			if ($mel_data == '700') echo ' selected="selected"';			echo '>700m&sup2;</option>';
				echo '<option value="800"';			if ($mel_data == '800') echo ' selected="selected"';			echo '>800m&sup2;</option>';
				echo '<option value="900"';			if ($mel_data == '900') echo ' selected="selected"';			echo '>900m&sup2;</option>';
				echo '<option value="1000"';			if ($mel_data == '1000') echo ' selected="selected"';			echo '>1000m&sup2;</option>';
				echo '</select>～';

				echo '<select title="面積選択 上限" name="meh" id="meh" class="half_size">';
				echo '<option value="10"';			if ($meh_data == '10') echo ' selected="selected"';			echo '>10m&sup2;</option>';
				echo '<option value="15"';			if ($meh_data == '15') echo ' selected="selected"';			echo '>15m&sup2;</option>';
				echo '<option value="20"';			if ($meh_data == '20') echo ' selected="selected"';			echo '>20m&sup2;</option>';
				echo '<option value="25"';			if ($meh_data == '25') echo ' selected="selected"';			echo '>25m&sup2;</option>';
				echo '<option value="30"';			if ($meh_data == '30') echo ' selected="selected"';			echo '>30m&sup2;</option>';
				echo '<option value="35"';			if ($meh_data == '35') echo ' selected="selected"';			echo '>35m&sup2;</option>';
				echo '<option value="40"';			if ($meh_data == '40') echo ' selected="selected"';			echo '>40m&sup2;</option>';
				echo '<option value="50"';			if ($meh_data == '50') echo ' selected="selected"';			echo '>50m&sup2;</option>';
				echo '<option value="60"';			if ($meh_data == '60') echo ' selected="selected"';			echo '>60m&sup2;</option>';
				echo '<option value="70"';			if ($meh_data == '70') echo ' selected="selected"';			echo '>70m&sup2;</option>';
				echo '<option value="80"';			if ($meh_data == '80') echo ' selected="selected"';			echo '>80m&sup2;</option>';
				echo '<option value="90"';			if ($meh_data == '90') echo ' selected="selected"';			echo '>90m&sup2;</option>';
				echo '<option value="100"';			if ($meh_data == '100') echo ' selected="selected"';			echo '>100m&sup2;</option>';
				echo '<option value="200"';			if ($meh_data == '200') echo ' selected="selected"';			echo '>200m&sup2;</option>';
				echo '<option value="300"';			if ($meh_data == '300') echo ' selected="selected"';			echo '>300m&sup2;</option>';
				echo '<option value="400"';			if ($meh_data == '400') echo ' selected="selected"';			echo '>400m&sup2;</option>';
				echo '<option value="500"';			if ($meh_data == '500') echo ' selected="selected"';			echo '>500m&sup2;</option>';
				echo '<option value="600"';			if ($meh_data == '600') echo ' selected="selected"';			echo '>600m&sup2;</option>';
				echo '<option value="700"';			if ($meh_data == '700') echo ' selected="selected"';			echo '>700m&sup2;</option>';
				echo '<option value="800"';			if ($meh_data == '800') echo ' selected="selected"';			echo '>800m&sup2;</option>';
				echo '<option value="900"';			if ($meh_data == '900') echo ' selected="selected"';			echo '>900m&sup2;</option>';
				echo '<option value="1000"';			if ($meh_data == '1000') echo ' selected="selected"';			echo '>1000m&sup2;</option>';
				echo '<option value="0"';			if ($meh_data == '0' ||$meh_data == '' ) echo ' selected="selected"';			echo '>上限なし</option>';
				echo '</select>';
				echo '</div>';

			} //面積を表示/非表示

		}	//$men_view


		//for add_action
		do_action( 'jsearch_widget9', $instance );

		//設備
		if( $set_view != 1 ){
			echo '<div id="setsubi_cb" class="setsubi_cb"></div>';
		}

		//for add_action
		do_action( 'jsearch_widget10', $instance );


		echo '<input type="submit" id="btn" value="物件検索" />';
		echo '</form>';


		//after_widget
		echo $args['after_widget'];

		//5.2.1
		$tmp_url = plugins_url();
		echo '<script type="text/javascript">';
		echo 'var getsite="' . $tmp_url . '/fudou/json/";';
		echo 'var r_view="'.$r_view.'";';
		echo 'var c_view="'.$c_view.'";';
		echo 'var kak_view="'.$kak_view.'";';
		echo 'var mad_view="'.$mad_view.'";';
		echo 'var set_view="'.$set_view.'";';
		echo '</script>';
		echo '<script type="text/javascript" src="'.$tmp_url.'/fudou/js/jsearch.min.js?ver=5.2.3"></script>';
		?>
		<script type="text/javascript">
			function jsearch_widget_after_js(){
				<?php
				/**
				 * add after js
				 *
				 * @since UNPC 1.8.1
				 */
				do_action( 'jsearch_widget_after_js' )
				?>
			}
		</script>
		<?php

		if( get_option('template') == 'twentythirteen' ){
			?>
			<script type="text/javascript">
				function reload_twentyThirteen(){
					jQuery( function() {
						var sidebar   = jQuery( '#secondary .widget-area' ),
						secondary = ( 0 == sidebar.length ) ? -40 : sidebar.height(),
						margin    = jQuery( '#tertiary .widget-area' ).height() - jQuery( '#content' ).height() - secondary;

						if ( margin > 0 && window.innerWidth > 999 )
							jQuery( '#colophon' ).css( 'margin-top', margin + 'px' );
					} );
				}

				addOnload_twentyThirteen(function() { setTimeout(reload_twentyThirteen,3000); });
				function addOnload_twentyThirteen(func){
					try {
						window.addEventListener("load", func, false);
					} catch (e) {   
						window.attachEvent("onload", func);   	// IE用
					}
				}
			</script>
			<?php
		}

	}

	/*
	 * テーマカスタマイザー option に登録
	 *
	 * Version: 5.2.3
	 *
	*/
	function customize_save_after_widget_fudo_b_k( $wp_customize ) {

		$_post_values = json_decode( wp_unslash( $_POST['customized'] ), true );

		if( $_post_values ){

			foreach( $_post_values as $widget_name=>$value){
				$pos = strpos( $widget_name, 'widget_fudo_b_k' );
				if( $pos !== false ){

					$data = $wp_customize->get_setting( $widget_name )->post_value();

					if( isset( $data['title'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_title', esc_attr( $data['title'] ) );
					}
					if( isset( $data['view1'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_view1', esc_attr( $data['view1'] ) );
					}
					if( isset( $data['r_view'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_r_view', esc_attr( $data['r_view'] ) );
					}
					if( isset( $data['c_view'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_c_view', esc_attr( $data['c_view'] ) );
					}
					if( isset( $data['kak_view'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_kak_view', esc_attr( $data['kak_view'] ) );
					}
					if( isset( $data['hof_view'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_hof_view', esc_attr( $data['hof_view'] ) );
					}
					if( isset( $data['mad_view'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_mad_view', esc_attr( $data['mad_view'] ) );
					}
					if( isset( $data['tik_view'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_tik_view', esc_attr( $data['tik_view'] ) );
					}
					if( isset( $data['men_view'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_men_view', esc_attr( $data['men_view'] ) );
					}
					if( isset( $data['set_view'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_set_view', esc_attr( $data['set_view'] ) );
					}

					if( isset( $data['choumei_view'] ) ){
						$this->fudo_widget_b_k_option( 'widget_fudo_b_k_choumei_view', esc_attr( $data['choumei_view'] ) );
					}
				}
			}
		}
	} 


} // Class fudo_widget_b_k






/*
 * 更新情報(Twitter)2
 * Version: 5.8.0
 */
class fudo_widget_twitter2 extends WP_Widget {

	/**
	 * Register widget with WordPress 4.3.
	 */
	function __construct() {

		/*
		$widget_ops = array(
			'description'                 => 'Twitterのつぶやきを更新情報として表示します。',
			'customize_selective_refresh' => true,
			'show_instance_in_rest'       => true,
		);
		parent::__construct( 'fudo_twitter2', '更新情報(Twitter)', $widget_ops );
		*/

		parent::__construct(
			'fudo_twitter2', 			// Base ID
			'更新情報(Twitter)' ,			// Name
			array( 'description' => 'Twitterのつぶやきを更新情報として表示します', )	// Args
		);
	}

	/** @see WP_Widget::form */	
	function form($instance) {

		$title  = isset($instance['title']) 	? esc_attr($instance['title']) : '';
		$t_user = isset($instance['t_user']) 	? esc_attr($instance['t_user']) : '';
		$item   = isset($instance['item']) 	? esc_attr($instance['item']) : '';

		$consumerKey = isset($instance['consumerKey']) 			? esc_attr($instance['consumerKey']) : '';
		$consumerSecret = isset($instance['consumerSecret']) 		? esc_attr($instance['consumerSecret']) : '';
		$accessToken = isset($instance['accessToken']) 			? esc_attr($instance['accessToken']) : '';
		$accessTokenSecret = isset($instance['accessTokenSecret']) 	? esc_attr($instance['accessTokenSecret']) : '';


		if($item=='') $item = 5;

		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>">
		<?php _e('title'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('t_user'); ?>">
		Twitterのユーザ名 <input class="widefat" id="<?php echo $this->get_field_id('t_user'); ?>" name="<?php echo $this->get_field_name('t_user'); ?>" type="text" value="<?php echo $t_user; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('item'); ?>">
		表示数<input class="widefat" id="<?php echo $this->get_field_id('item'); ?>" name="<?php echo $this->get_field_name('item'); ?>" type="text" value="<?php echo $item; ?>" /></label></p>

		Twitter OAuth settings
		<p><label for="<?php echo $this->get_field_id('consumerKey'); ?>">
		Consumer key <input class="widefat" id="<?php echo $this->get_field_id('consumerKey'); ?>" name="<?php echo $this->get_field_name('consumerKey'); ?>" type="text" value="<?php echo $consumerKey; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('consumerSecret'); ?>">
		Consumer secret <input class="widefat" id="<?php echo $this->get_field_id('consumerSecret'); ?>" name="<?php echo $this->get_field_name('consumerSecret'); ?>" type="text" value="<?php echo $consumerSecret; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('accessToken'); ?>">
		Access token <input class="widefat" id="<?php echo $this->get_field_id('accessToken'); ?>" name="<?php echo $this->get_field_name('accessToken'); ?>" type="text" value="<?php echo $accessToken; ?>" /></label></p>

		<p><label for="<?php echo $this->get_field_id('accessTokenSecret'); ?>">
		Access token secret <input class="widefat" id="<?php echo $this->get_field_id('accessTokenSecret'); ?>" name="<?php echo $this->get_field_name('accessTokenSecret'); ?>" type="text" value="<?php echo $accessTokenSecret; ?>" /></label></p>

		<?php 

		if (!function_exists('json_decode')) {	//for php <5.2
			echo '*json_decodeを有効にしてください。<br />';
		}
		if (!function_exists('curl_init')) {	//XAMP
			echo '*php_curl.dllを有効にしてください。<br />';
		}

		/*
		php.ini
		；extension=php_curl.dll
		▼
		extension=php_curl.dll 
		*/

	}

	/** @see WP_Widget::update */
	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	/** @see WP_Widget::widget */
	function widget($args, $instance) {

		global $fudou_lazy_loading;

		//$site = home_url( '/' ); 
		$site = site_url( '/' ); 

		$title 			= isset($instance['title']) 		? esc_attr( apply_filters('widget_title', $instance['title']) ) : '';
		$t_user 		= isset($instance['t_user']) 		? esc_attr( $instance['t_user'] ) : '' ;
		$item 			= isset($instance['item']) 		? esc_attr( $instance['item'] ) : '';
		$consumerKey		= isset($instance['consumerKey'])	? esc_attr( trim($instance['consumerKey']) ) : '' ;
		$consumerSecret		= isset($instance['consumerSecret'])	? esc_attr( trim($instance['consumerSecret']) ) : '' ;
		$accessToken		= isset($instance['accessToken'])	? esc_attr( trim($instance['accessToken']) ) : '' ;
		$accessTokenSecret	= isset($instance['accessTokenSecret']) ? esc_attr( trim($instance['accessTokenSecret']) ) : '' ;

		//for block
		if( !isset( $args['widget_id'] ) ){
			$args['widget_id'] = 'fudo_twitter_' . mt_rand();
		}

		if( $consumerKey != '' && $consumerSecret != '' && $accessToken != '' && $accessTokenSecret != '' ){

			echo $args['before_widget'];

			if ( $title =='' ) $title = '更新情報 (Twitter)';
			echo $args['before_title']  .'<span style="float: right;"><a href="https://twitter.com/'.$t_user.'" target="_blank" rel="noopener noreferrer nofollow"><img ' . $fudou_lazy_loading . ' src="'.$site.'wp-content/plugins/fudou/img/twitter-forrow.png" alt="@'.$t_user.'をフォローしましょう" title="@'.$t_user.'をフォローしましょう" /></a></span>' . $title . $args['after_title']; 

			if ( function_exists('json_decode') ) {	//for php > 5.2

				//cache
				$cache_interval = get_option('cache_interval');
				if($cache_interval == '' ) $cache_interval = 5;	//min
				$cache_time = get_option( 'cache_'. $args['widget_id']. '_time' );
				$cache_data = get_option( 'cache_'. $args['widget_id'] );

				//$cache_interval = 0;	//test

				if( $cache_interval != 0 && !empty( $cache_data ) && strtotime( $cache_time ) > strtotime(date("Y/m/d  H:i:s",strtotime("-$cache_interval min")))){
					echo "\n<!-- cache_data " . $cache_time . " -->\n";
					$decode = $cache_data;
				}else{

					//Twitter
					require_once("twitteroauth/twitteroauth.php");
					$twObj = new TwitterOAuth($consumerKey,$consumerSecret,$accessToken,$accessTokenSecret);
					$json = $twObj->OAuthRequest("https://api.twitter.com/1.1/statuses/user_timeline.json","GET",array("count"=>"$item"));
					$decode = json_decode($json, true);

					if( isset($decode[0]['text']) ){
						if( $cache_interval != 0 ){
							update_option( 'cache_'. $args['widget_id'], $decode );
							update_option( 'cache_'. $args['widget_id']. '_time', date("Y/m/d H:i:s") );
						}
					}else{	//取得できない場合
						echo "\n<!-- cache_data " . $cache_time . " -->\n";
						$decode = $cache_data;
					}
				}

				echo '<ul id="twitter_update_list">';
				if( isset($decode[0]['text']) ){

					foreach ($decode as $val) {
						$text    = isset($val['text']) ? $val['text'] : '';
						$pattern = array ("/(https?:\/\/[a-zA-Z0-9\-\.\/~_]+)/","/(\s|^)@([a-zA-Z0-9\.\/~\-_]+)\b/",);
						$replace = array (
							"<a href='\\1' target=\"_blank\" rel=\"noopener noreferrer\">\\1</a>",
							"<a href=\"http://twitter.com/\\2\" target=\"_blank\" rel=\"noopener noreferrer external\">@\\2</a> ",
						);

						$text = preg_replace($pattern, $replace, $text);
						if ( isset($val['entities']['hashtags']) ) {
							foreach ($val['entities']['hashtags'] as $hashtag) {
								$pattern = "/(\s|　|^)#".$hashtag['text']."/";
								$replace = " <a href=\"https://twitter.com/search?q=%23".$hashtag['text']."\" rel=\"noopener noreferrer external\" target=\"_blank\">#".$hashtag['text']."</a>";
								$text = preg_replace($pattern, $replace, $text);
							}
						}
						$tweet_id = isset($val['id_str']) ? $val['id_str'] : '';
						$time     = isset($val['created_at']) ? strtotime($val['created_at']) : '';
						if( $time != '' ){
							$date = date("c", $time);
							$date = date("Y/n/j", $time);
							echo '<li><a class="tw_date" href="http://twitter.com/' .$t_user. '/status/' .$tweet_id. '" rel="noopener noreferrer external" target="_blank">'.$date.'</a> <span class="tw_status">' .$text. '</span></li>';
						}
					}
				}
				echo '</ul>';
			}

			echo $args['after_widget'];
		}
	}
} // Class fudo_widget_twitter2


