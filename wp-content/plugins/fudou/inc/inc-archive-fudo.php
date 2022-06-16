<?php
/**
 * The Template for displaying fudou archive posts.
 *
 * @package WordPress5.8
 * @subpackage Fudousan Plugin
 * Version: 5.8.1
 */



	global $s;
	global $wpdb;
	global $work_setsubi;
	global $wp_query;
	global $fudou_lazy_loading;

	$sql = '';
	$sql2 = '';
	$add_url  = '';
	$joken_url  = '';

	/*
	 * Fixe is_tax Err
	 * Version: 1.7.6
	 */
	$wp_query->is_tax = false;

	//width height ver5.5.0 archive
	$default_archive_width  = apply_filters( 'fudo_archive_thumbnail_width', 150 );
	$default_archive_height = apply_filters( 'fudo_archive_thumbnail_height', 150 );
	$defaultimg_archive_width_height = apply_filters( 'defaultimg_archive_width_height', ' width="' . $default_archive_width . '" height="' . $default_archive_height . '"' );


	//WordPressのアドレス(URL)
	//$site = site_url( '/' ); 
	//サイトのアドレス(URL)
	$site = home_url( '/' );
	//$plugin_url = WP_PLUGIN_URL .'/fudou/';
	$plugin_url = plugins_url() .'/fudou/';

	//newup_mark
		$newup_mark = get_option('newup_mark');
		if($newup_mark == '') $newup_mark=14;


	//物件詳細リンク
		if ( defined('FUDOU_BUKKEN_TARGET') && FUDOU_BUKKEN_TARGET== 1 ){
			$target_link = ' target="_blank" rel="noopener"';
		}else{
			$target_link = '';
		}


	//ユーザー別会員物件リスト
		$kaiin_users_rains_register = get_option('kaiin_users_rains_register');

	//路線・県ID
		$mid_id = isset($_GET['mid']) ? myIsNum_f($_GET['mid']) : '';
		if($mid_id=='')	$mid_id = "99999";

	//駅・市区ID
		$nor_id = isset($_GET['nor']) ? myIsNum_f($_GET['nor']) : '';
		if($nor_id=='')	$nor_id = "99999";

	//カテゴリ
		$bukken = isset($_GET['bukken']) ? $_GET['bukken'] : '';
		$bukken_slug_data = esc_attr( stripslashes( $bukken ));
		$taxonomy_name = '';

		if( $bukken != 'ken' && $bukken != 'shiku' && $bukken != 'rosen' && $bukken != 'station' && $bukken != 'jsearch' && $bukken != 'search' && $bukken != 'bus' && $bukken != 'kouku' 
			/*
			 * カテゴリ($taxonomy_name)フィルター
			 *
			 * @since Fudousan Plugin 1.7.2
			 * For inc-archive-fudo.php apply_filters( 'bukken_tax_name_archive', true, $bukken );
			 *
			 * @param bool $s.
			 * @param str $bukken.
			 * @return bool.
			*/
			&& apply_filters( 'bukken_tax_name_archive', true, $bukken )
		 ){
			$taxonomy_name = 'bukken';
		}

	//投稿タグ
		if($bukken_slug_data == ''){
			$bukken_tag = isset($_GET['bukken_tag']) ? $_GET['bukken_tag'] : '';
			$bukken_slug_data = esc_attr( stripslashes( $bukken_tag ));
			$taxonomy_name = 'bukken_tag';
		}

		$bukken_slug_data = str_replace(" ","",$bukken_slug_data);
		$bukken_slug_data = str_replace(";","",$bukken_slug_data);
		$bukken_slug_data = str_replace(",","",$bukken_slug_data);
		$bukken_slug_data = str_replace("'","",$bukken_slug_data);
		//エンコード
		$slug_data = utf8_uri_encode($bukken_slug_data,0);


	//パーマリンク
		if( !isset($_GET['bukken']) ){
			//global $wp_query;
			$cat = $wp_query->get_queried_object();

			if( $cat ){
				$cat_name = $cat->taxonomy;
				$cat_name_data = $cat->name;
				$cat_slug_data = $cat->slug;

				if( $cat_name == 'bukken' ){
					$bukken_slug_data = $cat_name_data;
					$slug_data = $cat_slug_data;
					$taxonomy_name = 'bukken';
				}
				if( $cat_name == 'bukken_tag' ){
					$bukken_slug_data = $cat_name_data;
					$slug_data = $cat_slug_data;
					$taxonomy_name = 'bukken_tag';
				}
			}
		}


	//物件キーワード検索  $s st

		$s = esc_sql( esc_attr( $s ) );
		$s = str_replace(" ","",$s);
		$s = str_replace(";","",$s);
		$s = str_replace(",","",$s);
		$s = str_replace("'","",$s);
		$s = str_replace("\\","",$s);
		//ver5.8.0
		$s = str_replace('"','',$s);
		$s = myLeft( $s, 20 );

		$searchtype = isset($_GET['st']) ? esc_sql(esc_attr($_GET['st'])) : '';

	//ページ
		$bukken_page_data = isset($_GET['paged']) ? myIsNum_f($_GET['paged']) : '';
		if($bukken_page_data < 2) $bukken_page_data = "";


	//種別
		$bukken_shubetsu = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';

		//複数種別用 売買・賃貸判別
		$shub = isset($_GET['shub']) ? myIsNum_f($_GET['shub']) : '';

	//複数種別
		$is_tochi = false;

		if ( is_array($bukken_shubetsu) ) {
			$i=0;
			$shu_data = ' IN ( 0 ';
			foreach($bukken_shubetsu as $meta_set){

				//土地判定 (土地・戸建)
				$tmp_bs = (int)$bukken_shubetsu[$i];
				if( ($tmp_bs > 1100 && $tmp_bs < 1300) || $tmp_bs == 3212  ){
					$is_tochi = true;
				}

				$shu_data .= ','. $tmp_bs . '';
				$i++;
			}
			$shu_data .= ') ';

		} else {
	//単独種別
			$shu_data = " > 0 ";
			if($bukken_shubetsu == '1') 
				$shu_data = '< 3000' ;	//売買
			if($bukken_shubetsu == '2') 
				$shu_data = '> 3000' ;	//賃貸

			if(intval($bukken_shubetsu) > 3 && $bukken_slug_data == 'jsearch') 
				$shu_data = '= ' . (int)$bukken_shubetsu ;

			//土地判定
			if( ($bukken_shubetsu > 1100 && $bukken_shubetsu < 1300) || $bukken_shubetsu == 3212 || $bukken_shubetsu == 1 ){
				$is_tochi = true;
			}
		} 

	//複数種別用 売買・賃貸判別
		if($bukken_shubetsu == '' && $shub != ''){
			if ($shub == '1' )
				$shu_data = '< 3000' ;	//売買
			if ($shub == '2' )
				$shu_data = '> 3000' ;	//賃貸
		}

	//ソート項目
		$bukken_sort = isset($_GET['so']) ? esc_attr( stripslashes($_GET['so'])) : '';

		/*
		 * 物件ソートデフォルト 日付タイプ
		 *
		 * @since Fudousan Plugin 1.7.14
		 * For inc-archive-fudo.php
		 * apply_filters( 'bukken_sort_data2', '', $bukken_sort );
		*/
		$bukken_sort_data2  = apply_filters( 'bukken_sort_data2', '', $bukken_sort );


		if($bukken_sort=="tam"){
			$bukken_sort_data = "tatemonomenseki";
		}elseif($bukken_sort=="tac"){
			$bukken_sort_data = "tatemonochikunenn";
		}elseif($bukken_sort=="mad"){
			$bukken_sort_data = "madorisu";
		}elseif($bukken_sort=="sho"){
			$bukken_sort_data = "shozaichicode";
		}else{
			//デフォルト

				/*
				 * 物件ソートデフォルト
				 *
				 * @since Fudousan Plugin 1.7.12
				 * For inc-archive-fudo.php
				 * apply_filters( 'bukken_sort_data_default', 'kakaku' );
				 * apply_filters( 'bukken_sort_default', 'kak' );
				 *
				 * @param  str $bukken_sort_data , $bukken_sort
				 * @return str $bukken_sort_data , $bukken_sort
				*/
				$bukken_sort_data = apply_filters( 'bukken_sort_data_default', 'kakaku' );
				$bukken_sort	  = apply_filters( 'bukken_sort_default', 'kak', $bukken_sort_data2 );

				//価格
			//	$bukken_sort_data = "kakaku";
			//	$bukken_sort = "kak";

				//建物面積
			//	$bukken_sort_data = "tatemonomenseki";
			//	$bukken_sort = "tam";

				//築年月
			//	$bukken_sort_data = "tatemonochikunenn";
			//	$bukken_sort = "tac";

				//間取り
			//	$bukken_sort_data = "madorisu";
			//	$bukken_sort = "mad";

				//住所
			//	$bukken_sort_data = "shozaichicode";
			//	$bukken_sort = "sho";
		}

		/*
		 * 物件ソート用タグ
		 *
		 * @since Fudousan Plugin 1.7.8
		 * For inc-archive-fudo.php apply_filters( 'bukken_sort', $bukken_sort );
		 *
		 * @param  str $bukken_sort.
		 * @return str $bukken_sort.
		*/
		$bukken_sort = apply_filters( 'bukken_sort', $bukken_sort );

		/*
		 * 物件ソート用タグ
		 *
		 * @since Fudousan Plugin 1.7.8
		 * For inc-archive-fudo.php apply_filters( 'bukken_sort_data', $bukken_sort_data );
		 *
		 * @param  str $bukken_sort_data.
		 * @return str $bukken_sort_data.
		*/
		$bukken_sort_data = apply_filters( 'bukken_sort_data', $bukken_sort_data );



	//ソートORDER
		$bukken_order_data = isset($_GET['ord']) ? esc_attr( stripslashes($_GET['ord'])) : '';

		/*
		 * 物件ソート用タグ
		 *
		 * @since Fudousan Plugin 1.7.14
		 * For inc-archive-fudo.php apply_filters( 'bukken_order_data', $bukken_order_data );
		 *
		 * @param  str $bukken_order_data
		 * @return str $bukken_order_data
		*/
		$bukken_order_data = apply_filters( 'bukken_order_data', $bukken_order_data );


		if($bukken_order_data=="d"){
			$bukken_order_data = " DESC";
			$bukken_order = "";
		}else{
			$bukken_order_data = " ASC";
			$bukken_order = "d";
		}


		/*
		 * 物件ソートデフォルト 日付 ORDER 
		 *
		 * @since Fudousan Plugin 1.7.14
		 * For inc-archive-fudo.php
		 * apply_filters( 'bukken_order_data2', ' DESC' );
		*/
		$bukken_order_data2 = apply_filters( 'bukken_order_data2', ' DESC' );




	//1ページに表示する物件数
		$posts_per_page = get_option('posts_per_page');

		/*
		 * 1ページに表示する物件数フィルター
		 *
		 * @since Fudousan Plugin 1.9.7
		 * For inc-archive-fudo.php
		 * apply_filters( 'bukken_archive_posts_per_page', $posts_per_page );
		 *
		 * @param int $posts_per_page.
		 * @return int $posts_per_page.
		*/
		$posts_per_page = apply_filters( 'bukken_archive_posts_per_page', $posts_per_page );


		if($bukken_page_data == ""){
			$limit_from = "0";
			$limit_to = $posts_per_page;
		}else{
			$limit_from = $posts_per_page * $bukken_page_data - $posts_per_page;
			$limit_to = $posts_per_page;
		}

		/*
		 * 1ページに表示する物件数フィルター2
		 *
		 * @since Fudousan Plugin 1.9.7
		 * For inc-archive-fudo.php
		 * apply_filters( 'bukken_archive_limit_from', $limit_from, $posts_per_page, $bukken_page_data );
		 * apply_filters( 'bukken_archive_limit_to', $limit_to, $posts_per_page, $bukken_page_data );
		 *
		 * @param  int $limit_to, limit_from, $posts_per_page, $bukken_page_data
		 * @return int $limit_to, limit_from, $posts_per_page, $bukken_page_data
		*/
		$limit_from = apply_filters( 'bukken_archive_limit_from', $limit_from, $posts_per_page, $bukken_page_data );
		$limit_to = apply_filters( 'bukken_archive_limit_to', $limit_to, $posts_per_page, $bukken_page_data );



	//条件検索用
	$ksik_id   = isset($_GET['ksik']) ? myIsNum_f($_GET['ksik']) : '';	//県市区 //複数市区
	$rosen_eki = isset($_GET['re']) ? myIsNum_f($_GET['re']) : '';		//路線駅 //複数駅

	if($bukken_slug_data == "jsearch"){

		$ros_id = isset($_GET['ros']) ? myIsNum_f($_GET['ros']) : '';	//路線
		$eki_id = isset($_GET['eki']) ? myIsNum_f($_GET['eki']) : '';	//駅
		$ken_id = isset($_GET['ken']) ? myIsNum_f($_GET['ken']) : '';	//県
		$sik_id = isset($_GET['sik']) ? myIsNum_f($_GET['sik']) : '';	//市区

		//複数チェック
		if( is_array( $ros_id ) ){
			$ros_id= '';
		}
		if( is_array( $eki_id) ){
			$eki_id = '';
		}
		if( is_array( $ken_id ) ){
			$ken_id = '';
		}
		if( is_array( $sik_id ) ){
			$sik_id = '';
		}

		$ken_id = sprintf( "%02d", $ken_id );


		//複数市区
		$ksik_data = '';
		if (is_array($ksik_id)) {
			$i=0;
			$ksik_data = " IN ( '99999' ";
			foreach($ksik_id as $meta_set){
				if( myIsNum_f($ksik_id[$i]) ){
					$ksik_data .= ", '". myIsNum_f($ksik_id[$i]) . "000000'";
				}
				$i++;
			}
			$ksik_data .= ") ";
		}


		//複数駅
		$eki_data = '';
		if(is_array( $rosen_eki )  ){
			$i=0;
			$eki_data = ' IN ( 0 ';
			foreach($rosen_eki as $meta_set){
				if( intval(myLeft($rosen_eki[$i],6)) ){
					$eki_data .= ',' . intval(myLeft($rosen_eki[$i],6)) . intval(myRight($rosen_eki[$i],6));
				}
				$i++;
			}
			$eki_data .= ') ';
		}


		//設備条件
		$set_id = isset($_GET['set']) ? myIsNum_f($_GET['set']) : '';
		$setsubi_name = '';
		if(!empty($set_id)) {
			$setsubi_name = ' 設備条件(';
			$i=0;
			foreach($set_id as $meta_set){
				foreach($work_setsubi as $meta_setsubi){
					if($set_id[$i] == $meta_setsubi['code'] )
						$setsubi_name .= ' ' . $meta_setsubi['name'] . '';
				}
				$i++;
			}
			$setsubi_name .= ' )';
		}


		//間取り
		$madori_id = isset($_GET['mad']) ? myIsNum_f($_GET['mad']) : '';
		$madori_name = '';
		if(!empty($madori_id)) {
			$madori_name = ' 間取り( ';

			$i=0;
			foreach($madori_id as $meta_box){
				$madorisu_data = $madori_id[$i];

				//間取りタイプ
				$madorisyurui_data = myRight($madorisu_data,2);

				//2桁対策
				$madorisu_count = mb_strlen( $madorisu_data, 'utf-8');
				$madori_name .= myLeft( $madorisu_data, $madorisu_count-2 );

				if($madorisyurui_data=="10")	$madori_name .= 'R ';
				if($madorisyurui_data=="20")	$madori_name .= 'K ';
				if($madorisyurui_data=="25")	$madori_name .= 'SK ';
				if($madorisyurui_data=="30")	$madori_name .= 'DK ';
				if($madorisyurui_data=="35")	$madori_name .= 'SDK ';
				if($madorisyurui_data=="40")	$madori_name .= 'LK ';
				if($madorisyurui_data=="45")	$madori_name .= 'SLK ';
				if($madorisyurui_data=="50")	$madori_name .= 'LDK ';
				if($madorisyurui_data=="55")	$madori_name .= 'SLDK ';
				$i++;
			}
			$madori_name .= ')';
		}


		//価格
		$kalb_data = isset($_GET['kalb']) ? myIsNum_f($_GET['kalb']) : '';	//価格下限 万円
		$kahb_data = isset($_GET['kahb']) ? myIsNum_f($_GET['kahb']) : '';	//価格上限 万円
		$kalc_data = isset($_GET['kalc']) ? myIsNum_f($_GET['kalc']) : '';	//賃料下限 万円
		$kahc_data = isset($_GET['kahc']) ? myIsNum_f($_GET['kahc']) : '';	//賃料上限 万円
		$kakaku_name = '';

			$kal_data =0 ;
			$kah_data =0 ;

			//売買
			if($bukken_shubetsu == '1' || ( intval($bukken_shubetsu) < 3000 && intval($bukken_shubetsu) > 1000 ) || $shub == '1') {
				$kal_data = intval( $kalb_data ) * 10000 ;
				$kah_data = intval( $kahb_data ) * 10000 ;

					//価格条件
					if($kalb_data > 0 || $kahb_data > 0 ){
						$kakaku_name = ' 価格( ';
						if( $kalb_data > 0 )
							$kakaku_name .= $kalb_data.'万円';
						$kakaku_name .= '～';
						if( $kahb_data > 0 )
							$kakaku_name .= $kahb_data . '万円 ' ;
						$kakaku_name .= ')';
					}


			}
			//賃貸
			if($bukken_shubetsu == '2' || intval($bukken_shubetsu) > 3000  || $shub == '2') {
				$kal_data = intval( $kalc_data ) * 10000 ;
				$kah_data = intval( $kahc_data ) * 10000 ;

					//賃料条件
					if($kalc_data > 0 || $kahc_data > 0 ){
						$kakaku_name = ' 賃料( ';
						if( $kalc_data > 0 )
							$kakaku_name .= $kalc_data.'万円';
						$kakaku_name .= '～';
						if( $kahc_data > 0 )
							$kakaku_name .= $kahc_data . '万円 ' ;
						$kakaku_name .= ')';
					}
			}


		//築年数
		$tiku_name = '';
		$tik_data = isset($_GET['tik']) ? myIsNum_f($_GET['tik']) : '';
			$tik_data = intval($tik_data);

			//築年数条件
			if($tik_data > 0 )
				$tiku_name = ' 築'.$tik_data.'年以内 ';


		
		//歩分
		$hofun_name = '';
		$hof_data = isset($_GET['hof']) ? myIsNum_f($_GET['hof']) : '';

			//歩分条件
			if($hof_data > 0 )
				$hofun_name = ' 駅徒歩'.$hof_data.'分以内 ';


		//面積下限
		$mel_data = isset($_GET['mel']) ? myIsNum_f($_GET['mel']) : '';
			$mel_data = intval($mel_data);

		//面積上限
		$meh_data = isset($_GET['meh']) ? myIsNum_f($_GET['meh']) : '';
			$meh_data = intval($meh_data);

			//面積条件
			$menseki_name = '';
			if($mel_data > 0 || $meh_data > 0 ){
				$menseki_name = ' 面積( ';
				if($mel_data > 0 )
					$menseki_name .= $mel_data.'m&sup2;';
				$menseki_name .= '～';
				if($meh_data > 0)
					$menseki_name .= $meh_data . 'm&sup2; ' ;
				$menseki_name .= ')';
			}

	} //条件検索用




	//タイトル
		$org_title = '' ;

	//キーワードタイトル
		if( $s != '' && isset( $_GET['s'] ) ){
			$org_title = '検索：'.$s ;

			if($searchtype == 'id'){
				$org_title = '検索 物件番号：'.$s ;
			}

			if($searchtype == 'chou'){
				$org_title = '検索 町名：'.$s ;
			}
		}else{

	//カテゴリタイトル
			if ($taxonomy_name !=''){

				if( $taxonomy_name == 'bukken' ){
					$org_title = 'カテゴリ：';
					$joken_url  = $site .'?bukken='.$slug_data.'';
				}
				if( $taxonomy_name == 'bukken_tag'){
					$org_title = 'タグ：';
					$joken_url  = $site .'?bukken_tag='.$slug_data.'';
				}

				$sql  = "SELECT T.name";
				$sql .= " FROM $wpdb->terms AS T ";
				$sql .= " INNER JOIN $wpdb->term_taxonomy AS TT ON T.term_id = TT.term_id ";
				$sql .= " WHERE TT.taxonomy  = '".$taxonomy_name."' ";
				$sql .= " AND T.slug   = '".$slug_data."' ";

			//	$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_row( $sql );
				if(!empty($metas))
					$org_title .= $metas->name;
			}
		}


	//種別タイトル
		global $work_bukkenshubetsu;
		//複数種別
		$shu_name = '';
		if (is_array($bukken_shubetsu)) {
			$i=0;
			foreach($bukken_shubetsu as $meta_set){
				foreach($work_bukkenshubetsu as $meta_box){
					if( $bukken_shubetsu[$i] ==  $meta_box['id'] ){
						$shu_name .= ' '. $meta_box['name'] . ' ';
					}
				}
				$i++;
			}
		} else {
				foreach($work_bukkenshubetsu as $meta_box){
					if( $bukken_shubetsu ==  $meta_box['id'] ){
						$shu_name = ' '. $meta_box['name'] . ' ';
					}
				}
		} 


	//路線タイトル
		$rosen_name = '';
		if( ($bukken_slug_data=="rosen" && $mid_id !="") || ($bukken_slug_data=="jsearch" && $ros_id != '' && $eki_id == 0 ) ){
			$rosen_id = (int)$mid_id;
			if( $bukken_slug_data=="jsearch" && (int)$ros_id )
				$rosen_id = (int)$ros_id;

			$sql = "SELECT rosen_name FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " WHERE rosen_id =".$rosen_id."";
		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_row( $sql );
			if(!empty($metas)) $org_title = $metas->rosen_name;
			$rosen_name = $org_title;
		}

	//駅タイトル
		$eki_name = '';
		if( ($bukken_slug_data=="station" && $mid_id !="" && $nor_id !="") || ($bukken_slug_data=="jsearch" && $ros_id != '' && $eki_id != '' ) ){
			$rosen_id = (int)$mid_id;
			$ekin_id = (int)$nor_id;
			if( $bukken_slug_data=="jsearch" && (int)$ros_id  && (int)$eki_id ){
				$rosen_id = (int)$ros_id;
				$ekin_id = (int)$eki_id;
			}
			$sql = "SELECT DTS.station_name,DTR.rosen_name";
			$sql .=  " FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
			$sql .=  " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
			$sql .=  " WHERE DTS.rosen_id=".$rosen_id." AND DTS.station_id=".$ekin_id."";
		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_row( $sql );
			if(!empty($metas)) {
				$org_title = $metas->rosen_name.''.$metas->station_name.'駅';
				$eki_name = $org_title . ' ';
			}
		}

	//バス路線タイトル
		if( $bukken_slug_data == "bus" ){
			/*
			 * ページ条件検索SQL 複数選択 条件検索タイトル生成
			 *
			 * @since Fudousan Bus Plugin 1.0.0
			 * For inc-archive-fudo.php apply_filters( 'fudoubus_name_archive2', '' );
			 * return $bus_name;
			*/
			$org_title = apply_filters( 'fudoubus_title_archive', '' );
		}

	//県タイトル
		$ken_name = '';
		if( ($bukken_slug_data=="ken" && $mid_id !="") || ($bukken_slug_data=="jsearch" && $ken_id != '') ){
			$kenn_id = (int)$mid_id;
			if( $bukken_slug_data=="jsearch" && (int)$ken_id )
				$kenn_id = (int)$ken_id;

			if( $kenn_id != '' ){
				$org_title = fudo_ken_name( $kenn_id );
				$ken_name = $org_title;
			}
		}


	//市区タイトル
		$siku_name = '';
		if( ( $bukken_slug_data=="shiku" && $mid_id !="" && $nor_id !="") || ($bukken_slug_data=="jsearch" && $ken_id != '' && $sik_id !='') ){
			$kenn_id = (int)$mid_id;
			$sikn_id = (int)$nor_id;
			if($bukken_slug_data=="jsearch" && (int)$ken_id && (int)$sik_id ){
				$kenn_id = (int)$ken_id;
				$sikn_id = (int)$sik_id;
			}

			$sql = "SELECT narrow_area_name FROM " . $wpdb->prefix . DB_SHIKU_TABLE . " WHERE middle_area_id=".$kenn_id." and narrow_area_id =".$sikn_id."";
		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_row( $sql );
			if(!empty($metas)){
				$org_title = $metas->narrow_area_name;
				$siku_name = $org_title ;
			}
		}


	//複数駅タイトル
		if(is_array( $rosen_eki )  ){
			$i=0;
			foreach($rosen_eki as $meta_set){
				$f_rosen_id =  intval(myLeft($rosen_eki[$i],6));
				$f_eki_id   =  intval(myRight($rosen_eki[$i],6));

				$sql = "SELECT DTS.station_name";
				$sql .=  " FROM " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS";
				$sql .=  " WHERE DTS.rosen_id=".$f_rosen_id." AND DTS.station_id=".$f_eki_id."";
			//	$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_row( $sql );
				if(!empty($metas)) $eki_name .= $metas->station_name . '駅 ';

				$i++;
			}
		}


	//複数市区タイトル $ksik_id = $_GET['ksik']; //県市区
		$ksik_name = '';
		if (is_array($ksik_id)) {
			$sql  = "SELECT narrow_area_name FROM " . $wpdb->prefix . DB_SHIKU_TABLE . " ";
			$sql .= " WHERE ";
			$i=0;
			$j=0;
			foreach($ksik_id as $meta_set){
				$tmp_kenn_id = $ksik_id[$i];
				$kenn_id = myLeft($tmp_kenn_id,2);
				$sikn_id = myRight($tmp_kenn_id,3);
				if( (int)$kenn_id && (int)$sikn_id ){
					if($j > 0 ) $sql .= " OR ";
					$sql .= "( middle_area_id=". (int)$kenn_id ." and narrow_area_id =". (int)$sikn_id .")";
					$j++;
				}
				$i++;
			}
			if ($j > 0 ){
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_results( $sql, ARRAY_A );
				if(!empty($metas)) {

					foreach ( $metas as $meta ) {
						$ksik_name .= '' . $meta['narrow_area_name'] .' ';
					}
				}
			}
		}


	//条件検索タイトル生成
		if($bukken_slug_data == "jsearch"){
			$org_title = '検索 ';
			$org_title .= $shu_name;
			$org_title .= $rosen_name;
			$org_title .= $eki_name;
			/*
			 * widgetバス路線検索 タイトル
			 *
			 * @since Fudousan Bus Plugin 1.0.0
			 * For inc-archive-fudo.php apply_filters( 'fudoubus_title_archive', '' );
			 * @return str $bus_name.
			*/
			$org_title .= apply_filters( 'fudoubus_title_archive', '' );
			/*
			 * ページ条件検索SQL 複数選択 条件検索タイトル生成
			 *
			 * @since Fudousan Bus Plugin 1.0.0
			 * For inc-archive-fudo.php apply_filters( 'fudoubus_name_archive2', '' );
			 * return str $bus_name.
			*/
			$org_title .= apply_filters( 'fudoubus_title_archive2', '' );

			$org_title .= $ken_name;
			$org_title .= $siku_name;
			$org_title .= $ksik_name;
			$org_title .= $tiku_name;
			$org_title .= $hofun_name;
			$org_title .= $menseki_name;
			$org_title .= $kakaku_name;
			$org_title .= $setsubi_name;
			$org_title .= $madori_name;
		}


	//title設定
		//売買
		if($bukken_shubetsu == '1' || (intval($bukken_shubetsu) < 3000 && intval($bukken_shubetsu) > 1000) || $shub == '1' ) {
			$org_title =  '売買 > '.$org_title.' ';
		}

		//賃貸
		if($bukken_shubetsu == '2' || intval($bukken_shubetsu) > 3000 || $shub == '2' ) {
			$org_title =  '賃貸 > '.$org_title.' ';
		}


	//オリジナルフィルター $org_title v1.6.0
		$org_title = apply_filters( 'fudou_org_title_archive', $org_title );



	//title設定
		function add_archive_title_fudou( $title = '' ) {
			global $org_title, $bukken_page_data;

			$title =  $org_title . ' ';

			if( $bukken_page_data ){
				$title .=  '['. $bukken_page_data .'] ';
			}

			/**
			 * Filter the separator for the document title Fudou.
			 * @since 4.4.0
			 * @param string $sep Document title separator. Default '-'.
			 */
			$sep = apply_filters( 'document_title_separator_fudou', '-' );
			$title .=  ' ' . $sep . ' '. get_bloginfo( 'name', 'display' );

			return $title;
		}
		//WordPress ～4.3
		add_filter( 'wp_title', 'add_archive_title_fudou' );
		//WordPress 4.4～
		add_filter( 'pre_get_document_title', 'add_archive_title_fudou' );
		//All-in-One-SEO-Pack
		add_filter( 'aioseop_title', 'add_archive_title_fudou' );
		//Yoast SEO
		add_filter( 'wpseo_title', 'add_archive_title_fudou' );



/**** 検索 SQL ****/

	// ファイルのステータスのキャッシュをクリア
	//clearstatcache();

	$inc_sql_file = WP_PLUGIN_DIR . '/fudou/inc/inc-archive-fudo_sql.php';
	$inc_sql_file = apply_filters( 'inc_archive_fudo_sql', $inc_sql_file );

	if( is_file( $inc_sql_file ) ){
		require_once $inc_sql_file;
	}else{
		require_once 'inc-archive-fudo_sql.php';
	}

/**** 検索 SQL END ****/





/**
 * 坪単価
 *
 * @since Fudousan Plugin 1.0.0
 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakutsubo_print($post_id) {
	$kakakutsubo_data = get_post_meta($post_id,'kakakutsubo',true);
	if(is_numeric($kakakutsubo_data)){
		echo floatval($kakakutsubo_data)/10000;
		echo "万円";
	}
}


/**
 * 物件種別
 *
 * @since Fudousan Plugin 1.4.3 *
 * @param int $post_id Post ID.
 */
function my_custom_bukkenshubetsu_print($post_id) {
	$bukkenshubetsu_txt= '';
	$bukkenshubetsu_data = get_post_meta($post_id,'bukkenshubetsu',true);

	global $work_bukkenshubetsu;
	foreach ($work_bukkenshubetsu as $meta_box ){

		if( $bukkenshubetsu_data == $meta_box['id'] ){
			$bukkenshubetsu_txt = $meta_box['name'];
			$bukkenshubetsu_txt = str_replace( "【売地】" ,"" , $bukkenshubetsu_txt);
			$bukkenshubetsu_txt = str_replace( "【売戸建】" ,"" , $bukkenshubetsu_txt);
			$bukkenshubetsu_txt = str_replace( "【売マン】" ,"" , $bukkenshubetsu_txt);
			$bukkenshubetsu_txt = str_replace( "【売建物全部】" ,"" , $bukkenshubetsu_txt);
			$bukkenshubetsu_txt = str_replace( "【売建物一部】" ,"" , $bukkenshubetsu_txt);
			$bukkenshubetsu_txt = str_replace( "【賃貸居住】" ,"" , $bukkenshubetsu_txt);
			$bukkenshubetsu_txt = str_replace( "【賃貸事業】" ,"" , $bukkenshubetsu_txt);
			echo $bukkenshubetsu_txt;
			break;
		}
	}
}


/**
 * 所在地
 *
 * @since Fudousan Plugin 1.5.0 *
 * @param int $post_id Post ID.
 */
function my_custom_shozaichi_print($post_id) {
	global $wpdb;

	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);

	if($shozaichiken_data=="")
		$shozaichiken_data = get_post_meta($post_id,'shozaichiken',true);

	if($shozaichiken_data != ""){
		/*
		$sql = "SELECT middle_area_name FROM " . $wpdb->prefix . DB_KEN_TABLE . " WHERE middle_area_id=".$shozaichiken_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->middle_area_name;
		*/
		echo fudo_ken_name( $shozaichiken_data );
	}

	$shozaichicode_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichicode_data = myLeft($shozaichicode_data,5);
	$shozaichicode_data = myRight($shozaichicode_data,3);

	if($shozaichiken_data !="" && $shozaichicode_data !=""){
		$sql = "SELECT narrow_area_name FROM " . $wpdb->prefix . DB_SHIKU_TABLE . " WHERE middle_area_id=".$shozaichiken_data." and narrow_area_id =".$shozaichicode_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->narrow_area_name;
	}
}

/**
 * 路線 駅 バス 徒歩
 *
 * @since Fudousan Plugin 5.3.0
 *
 * @param int $post_id Post ID.
 */
function my_custom_koutsu1_print($post_id) {
	global $wpdb;
	$rosen_name = '';

	$koutsurosen_data = get_post_meta($post_id, 'koutsurosen1', true);
	$koutsueki_data = get_post_meta($post_id, 'koutsueki1', true);

	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);

	if($koutsurosen_data !=""){
		$sql = "SELECT rosen_name FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " WHERE rosen_id =".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if(!empty($metas)){
			$rosen_name = $metas->rosen_name;
			echo "".$rosen_name;
		}
	}

	if($koutsurosen_data !="" && $koutsueki_data !=""){
		$sql = "SELECT DTS.station_name";
		$sql .=  " FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
		$sql .=  " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
		$sql .=  " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if(!empty($metas)){
			if($metas->station_name != '＊＊＊＊'){
				if( $metas->station_name != '' ){
					echo ' ' . $metas->station_name.'駅';
				}
			}
		}
	}

	if(get_post_meta($post_id, 'koutsutoho1', true) !="")
		echo ' 徒歩'.get_post_meta($post_id, 'koutsutoho1', true).'m';

	if(get_post_meta($post_id, 'koutsutoho1f', true) !="")
		echo ' 徒歩'.get_post_meta($post_id, 'koutsutoho1f', true).'分';


	//バス路線
	/*
	 * バス路線名、バス停名表示
	 *
	 * @since Fudousan Bus Plugin 1.0.0
	 * For inc-single-fudo.php and inc-archive-fudo.php 
	 * admin_fudou.php fudo-widget.php fudo-widget3.php
	 * apply_filters( 'fudoubus_buscorse_busstop_single', '', $post_id, 1 );
	 *
	 * @param int $post_id Post ID.
	 * @param int $type 1 or 2.
	*/
	$koutsubusstei = apply_filters( 'fudoubus_buscorse_busstop_single', '', $post_id, 1 );

	if( !$koutsubusstei ){
		$koutsubusstei = get_post_meta($post_id, 'koutsubusstei1', true);
	}
	$koutsubussfun = get_post_meta($post_id, 'koutsubussfun1', true);
	$koutsutohob1f = get_post_meta($post_id, 'koutsutohob1f', true);

	if( $koutsubusstei || $koutsubussfun ){

		if($rosen_name == 'バス'){
			echo '(' . $koutsubusstei;
			if( !empty( $koutsubussfun ) ) echo ' 乗'.$koutsubussfun.'分';
		}else{
			echo '<br />';
			echo ' バス(' . $koutsubusstei;
			if( !empty( $koutsubussfun ) ) echo ' 乗'.$koutsubussfun.'分';
		}

		if($koutsutohob1f !="" )
			echo ' 停歩'.$koutsutohob1f.'分';
		echo ')';
	}
}

function my_custom_koutsu2_print($post_id) {
	global $wpdb;

	$rosen_name = '';
	$koutsurosen_data = get_post_meta($post_id, 'koutsurosen2', true);
	$koutsueki_data = get_post_meta($post_id, 'koutsueki2', true);

	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);


	if($koutsurosen_data !=""){
		$sql = "SELECT rosen_name FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " WHERE rosen_id =".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if(!empty($metas)){
			$rosen_name = $metas->rosen_name;
			echo "<br />".$rosen_name;
		}
	}

	if($koutsurosen_data !="" && $koutsueki_data !=""){
		$sql = "SELECT DTS.station_name";
		$sql .=  " FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
		$sql .=  " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
		$sql .=  " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if(!empty($metas)){
			if($metas->station_name != '＊＊＊＊'){
				if( $metas->station_name != '' ){
					echo ' ' . $metas->station_name.'駅';
			 	}
			 }
		}
	}

	if(get_post_meta($post_id, 'koutsutoho2', true) !="")
		echo ' 徒歩'.get_post_meta($post_id, 'koutsutoho2', true).'m';

	if(get_post_meta($post_id, 'koutsutoho2f', true) !="")
		echo ' 徒歩'.get_post_meta($post_id, 'koutsutoho2f', true).'分';


	//バス路線
	/*
	 * バス路線名、バス停名表示
	 *
	 * @since Fudousan Bus Plugin 1.0.0
	 * For inc-single-fudo.php and inc-archive-fudo.php 
	 * admin_fudou.php fudo-widget.php fudo-widget3.php
	 * apply_filters( 'fudoubus_buscorse_busstop_single', '', $post_id, 1 );
	 *
	 * @param int $post_id Post ID.
	 * @param int $type 1 or 2.
	*/
	$koutsubusstei = apply_filters( 'fudoubus_buscorse_busstop_single', '', $post_id, 2 );

	if( !$koutsubusstei ){
		$koutsubusstei = get_post_meta($post_id, 'koutsubusstei2', true);
	}
	$koutsubussfun = get_post_meta($post_id, 'koutsubussfun2', true);
	$koutsutohob2f = get_post_meta($post_id, 'koutsutohob2f', true);

	if( $koutsubusstei || $koutsubussfun ){

		if($rosen_name == 'バス'){
			echo '(' . $koutsubusstei;
			if( !empty( $koutsubussfun ) ) echo ' 乗'.$koutsubussfun.'分';
		}else{
			echo '<br />';
			echo ' バス(' . $koutsubusstei;
			if( !empty( $koutsubussfun ) ) echo ' 乗'.$koutsubussfun.'分';
		}

		if($koutsutohob2f !="" )
			echo ' 停歩'.$koutsutohob2f.'分';
		echo ')';
	}
}


/**
 * 建物構造
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tatemonokozo_print($post_id) {
	$tatemonokozo_data = get_post_meta($post_id,'tatemonokozo',true);
	if($tatemonokozo_data=="1") 	echo '木造';
	if($tatemonokozo_data=="2") 	echo 'ブロック';
	if($tatemonokozo_data=="3") 	echo '鉄骨造';
	if($tatemonokozo_data=="4") 	echo 'RC';
	if($tatemonokozo_data=="5") 	echo 'SRC';
	if($tatemonokozo_data=="6") 	echo 'PC';
	if($tatemonokozo_data=="7") 	echo 'HPC';
	if($tatemonokozo_data=="9") 	echo 'その他';
	if($tatemonokozo_data=="10") 	echo '軽量鉄骨';
	if($tatemonokozo_data=="11") 	echo 'ALC';
	if($tatemonokozo_data=="12") 	echo '鉄筋ブロック';
	if($tatemonokozo_data=="13") 	echo 'CFT(コンクリート充填鋼管)';

	//text
	if( $tatemonokozo_data !='' && !is_numeric($tatemonokozo_data) ) echo $tatemonokozo_data;

}

/**
 * 建物面積計測方式
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tatemonohosiki_print($post_id) {
	if(get_post_meta($post_id,'tatemonohosiki',true)=="1")	echo '壁芯';
	if(get_post_meta($post_id,'tatemonohosiki',true)=="2")	echo '内法';
	//text
	if( get_post_meta($post_id,'tatemonohosiki',true) !='' && !is_numeric(get_post_meta($post_id,'tatemonohosiki',true)) ) echo get_post_meta($post_id,'tatemonohosiki',true);

}

/**
 * 新築・未入居
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tatemonoshinchiku_print($post_id) {
	//if(get_post_meta($post_id,'tatemonoshinchiku',true)=="0") echo '中古　';
	if(get_post_meta($post_id,'tatemonoshinchiku',true)=="1") echo '新築未入居　';
	//text
	if( get_post_meta($post_id,'tatemonoshinchiku',true) !='' && !is_numeric(get_post_meta($post_id,'tatemonoshinchiku',true)) ) echo get_post_meta($post_id,'tatemonoshinchiku',true).'　';
}



/**
 * 間取り 部屋種類
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_madorisu_print($post_id) {
	$madorisyurui_data = get_post_meta($post_id,'madorisyurui',true);
	echo get_post_meta($post_id,'madorisu',true);
	if($madorisyurui_data=="10")	echo 'R';
	if($madorisyurui_data=="20")	echo 'K';
	if($madorisyurui_data=="25")	echo 'SK';
	if($madorisyurui_data=="30")	echo 'DK';
	if($madorisyurui_data=="35")	echo 'SDK';
	if($madorisyurui_data=="40")	echo 'LK';
	if($madorisyurui_data=="45")	echo 'SLK';
	if($madorisyurui_data=="50")	echo 'LDK';
	if($madorisyurui_data=="55")	echo 'SLDK';
}


/**
 * 賃料・価格
 *
 * @since Fudousan Plugin 5.7.2
 *
 * @param int $post_id Post ID.
 */
function my_custom_kakaku_print($post_id) {
	//非公開の場合
	if(get_post_meta($post_id,'kakakukoukai',true) == "0"){

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

		/*
		 * fudou_kakaku_after Filter
		 * Version: 5.7.2
		 * Version: 5.8.1
		 **/
		echo apply_filters( 'fudou_kakaku_after', '', $post_id );

			// 金銭面	税額 ※ 単位：円
			$kakakuzei_data = get_post_meta( $post_id, 'kakakuzei', true );
			if( $kakakuzei_data != '' && is_numeric( $kakakuzei_data )) {
				echo ' <span class="kakakuzei">(うち消費税';
				if(is_numeric($kakakuzei_data)){
					echo ( floatval($kakakuzei_data)/10000 );
					echo "万円)</span>";
				}
			}
		}

	}

		/*
		 * fudou_kakaku_after2 Filter
		 * Version: 5.7.2
		 **/
		echo apply_filters( 'fudou_kakaku_after2', '', $post_id );
}

/**
 * 礼金・万円/月数
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakureikin_print($post_id) {
	$kakakureikin_data = get_post_meta($post_id,'kakakureikin',true);
		if( $kakakureikin_data == '0' ) {
				echo "0";
		}else{
		
			if($kakakureikin_data >= 100) {
				echo floatval($kakakureikin_data)/10000;
				echo "万円";
			}else{
				echo $kakakureikin_data;
				echo "ヶ月";
			}
		}
}

/**
 * 敷金・万円/月数
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakushikikin_print($post_id) {
	$kakakushikikin_data = get_post_meta($post_id,'kakakushikikin',true);
		if( $kakakushikikin_data == '0' ) {
				echo "0";
		}else{
			if($kakakushikikin_data >= 100) {
				echo floatval($kakakushikikin_data)/10000;
				echo "万円";
			}else{
				echo $kakakushikikin_data;
				echo "ヶ月";
			}
		}
}

/**
 * 保証金・万円/月数
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakuhoshoukin_print($post_id) {
	$kakakuhoshoukin_data = get_post_meta($post_id,'kakakuhoshoukin',true);
		if( $kakakuhoshoukin_data == '0' ) {
				echo "0";
		}else{
			if($kakakuhoshoukin_data >= 100) {
				echo floatval($kakakuhoshoukin_data)/10000;
				echo "万円";
			}else{
				echo $kakakuhoshoukin_data;
				echo "ヶ月";
			}
		}
}

/**
 * 権利金・万円/月数
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakukenrikin_print($post_id) {
	$kakakukenrikin_data = get_post_meta($post_id,'kakakukenrikin',true);
		if( $kakakukenrikin_data == '0' ) {
				echo "0";
		}else{
			if($kakakukenrikin_data >= 100) {
				echo floatval($kakakukenrikin_data)/10000;
				echo "万円";
			}else{
				echo $kakakukenrikin_data;
				echo "ヶ月";
			}
		}
}

/**
 * 償却・敷引金・%/万円/月数
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakushikibiki_print($post_id) {
	$kakakushikibiki_data = get_post_meta($post_id,'kakakushikibiki',true);
		if( $kakakushikibiki_data == '0' ) {
				echo "0";
		}else{
			if($kakakushikibiki_data < 100) {
				echo $kakakushikibiki_data;
				echo "ヶ月";
			}elseif($kakakushikibiki_data>100 && $kakakushikibiki_data<=200){
				echo floatval($kakakushikibiki_data)-100;
				echo "%";
			}elseif($kakakushikibiki_data>200){
				echo floatval($kakakushikibiki_data)/10000;
				echo "万円";
			}
		}
}

/**
 * 更新料・円/月数
 *
 * @since Fudousan Plugin 5.0.2
 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakukoushin_print($post_id) {
	$kakakukoushin_data = get_post_meta($post_id,'kakakukoushin',true);
		if( $kakakukoushin_data == '0' ) {
				echo "0";
		}else{

			if($kakakukoushin_data >= 100) {
				echo apply_filters( 'fudou_number_format', $kakakukoushin_data );
				echo "円";
			}else{
				echo $kakakukoushin_data;
				echo "ヶ月";
			}
		}
}

/**
 * 駐車場
 *
 * @since Fudousan Plugin 5.4.0
 *
 * @param int $post_id Post ID.
 */
function my_custom_chushajo_print_archive($post_id) {

	$tmp_data = '';

	//駐車料金
	$chushajoryokin_data = get_post_meta($post_id,'chushajoryokin',true);

	if( $chushajoryokin_data ){
		$tmp_data .= ' ' . apply_filters( 'fudou_number_format', $chushajoryokin_data ) . '円 ';
	}

	//駐車場区分
	$chushajokubun_data = get_post_meta($post_id,'chushajokubun',true);
	if($chushajokubun_data=="0")	echo '';
	if($chushajokubun_data=="1")	$tmp_data .=  '空有';
	if($chushajokubun_data=="2")	$tmp_data .=  '空無';
	if($chushajokubun_data=="3")	$tmp_data .=  '近隣';
	if($chushajokubun_data=="4")	$tmp_data .=  '無';
	//text
	if( $chushajokubun_data !='' && !is_numeric($chushajokubun_data) ){
		$tmp_data .=  $chushajokubun_data;
	}


	if( $tmp_data != '' ){
		//$tmp_data = '<dt>駐車場</dt><dd>' . $tmp_data . '</dd>';
		$tmp_data = '' . $tmp_data . '';
	}
	echo $tmp_data;
}


/**
 * 地目
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochichimoku_print($post_id) {
	$tochichimoku_data = get_post_meta($post_id,'tochichimoku',true);
	if($tochichimoku_data=="1")	echo '宅地';
	if($tochichimoku_data=="2")	echo '田';
	if($tochichimoku_data=="3")	echo '畑';
	if($tochichimoku_data=="4")	echo '山林';
	if($tochichimoku_data=="5")	echo '雑種地';
	if($tochichimoku_data=="9")	echo 'その他';
	if($tochichimoku_data=="10")	echo '原野';
	if($tochichimoku_data=="11")	echo '田･畑';
	//text
	if( $tochichimoku_data !='' && !is_numeric($tochichimoku_data) ) echo $tochichimoku_data.'';
}

/**
 * 地勢
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochichisei_print($post_id) {
	$tochichisei_data = get_post_meta($post_id,'tochichisei',true);
	if($tochichisei_data=="1")	echo '平坦';
	if($tochichisei_data=="2")	echo '高台';
	if($tochichisei_data=="3")	echo '低地';
	if($tochichisei_data=="4")	echo 'ひな段';
	if($tochichisei_data=="5")	echo '傾斜地';
	if($tochichisei_data=="9")	echo 'その他';
	//text
	if( $tochichisei_data !='' && !is_numeric($tochichisei_data) ) echo $tochichisei_data.'';
}


/**
 * 設備・条件
 *
 * @since Fudousan Plugin 1.8.2
 *
 * @param int $post_id Post ID.
 */
function my_custom_setsubi_print($post_id) {
	global $work_setsubi;

	$setsubi_dat = '';
	$valu_dat = '';

	$setsubi_data = get_post_meta($post_id, 'setsubi', true);
	foreach($work_setsubi as $meta_box){
		if( false !== strpos($setsubi_data, $meta_box['code']) ){
			$setsubi_dat .= '<span class="setsubi_' . $meta_box['code'] . ' setsubi_dat">' . $meta_box['name']."</span> ";
		}
	}
	if( $setsubi_dat ){
	//	$valu_dat .= '<div class="setsubi_dat">';
		$valu_dat .=  $setsubi_dat;
	//	$valu_dat .= '</div>';
	}

	if( get_post_meta($post_id,'setsubisonota',true) ){
		$valu_dat .= '<div class="setsubi_sonota">' . get_post_meta($post_id,'setsubisonota',true) . '</div>';
	}

	echo $valu_dat;
}

/**
 * ページナビゲション
 *
 * @since Fudousan Plugin 1.9.6
 *
 * @param int $fw_record_count.
 * @param int $fw_page_size.
 * @param int $fw_page_count.
 * @param string $bukken_sort.
 * @param string $bukken_order.
 * @param string $s.
 * @param string $joken_url.
 * @return text
 */
function f_page_navi( $fw_record_count, $fw_page_size, $fw_page_count, $bukken_sort, $bukken_order, $s, $joken_url ){

	$navi_max = 5;
	$k = 0;

	// $s Fix
	if( strpos( $joken_url, 's=' ) !== false ){
		$s_tag = '';
	}else{
		$s_tag = '&amp;s=' . $s;
	}

	$move_str = $fw_record_count.'件 ';

	if($fw_page_count=="")
		$fw_page_count =1;

	if ($fw_record_count > $fw_page_size){

		$w_max_page = intval($fw_record_count / $fw_page_size);

		if( ($fw_record_count % $fw_page_size) <> 0 )
			$w_max_page = $w_max_page + 1;

		if( intval($fw_page_count) >= intval($navi_max)){
			$w_loop_start = $fw_page_count - intval($navi_max/2);
		}else{
			$w_loop_start = 1;
		}

		if( $w_max_page < ($fw_page_count + intval($navi_max/2)))
			$w_loop_start = $w_max_page-$navi_max + 1;

		if( $w_loop_start < 1)
			$w_loop_start =  1;


		if( $fw_page_count > 1){
			$move_str .='<a href="'.$joken_url.'&amp;paged='.($fw_page_count-1).'&amp;so='.$bukken_sort.'&amp;ord='.$bukken_order.''. $s_tag .'">&laquo;</a> ';
		}


		if( $w_loop_start <> 1)
			$move_str .='<a href="'.$joken_url.'&amp;paged=&amp;so='.$bukken_sort.'&amp;ord='.$bukken_order.''. $s_tag .'">1</a> ';

		if( $w_loop_start > 2)
			$move_str .='.. ';


		for ($j=$w_loop_start; $j<$w_max_page+1;$j++){

			if ($j == $fw_page_count){
				$move_str .='<b>'.$j.'</b> ';
			}else{
				$move_str .='<a href="'.$joken_url.'&amp;paged='.$j.'&amp;so='.$bukken_sort.'&amp;ord='.$bukken_order.''. $s_tag .'">'.$j.'</a> ';
			}
			
			$k++;
			if ($k >= $navi_max)
				break;
		}

		if($w_max_page > $j)
			$move_str .='.. ';

		if($w_max_page > $j ){
			if( $w_max_page > ($fw_page_count + intval($navi_max/2)) )
				$move_str .='<a href="'.$joken_url.'&amp;paged='.($w_max_page).'&amp;so='.$bukken_sort.'&amp;ord='.$bukken_order.''. $s_tag .'">'.$w_max_page.'</a> ';
		}

		if( $fw_record_count > $fw_page_size * $fw_page_count){
			$move_str .='<a href="'.$joken_url.'&amp;paged='.($fw_page_count+1).'&amp;so='.$bukken_sort.'&amp;ord='.$bukken_order.''. $s_tag .'">&raquo;</a>';
		}


		if( $fw_page_count > 1){
			$w_first_page = ($fw_page_count - 1) * $fw_page_size;
		}else{
			$w_first_page = 1;
		}

	}
	return $move_str;
}

/**
 * 物件画像タイプ
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int|string $imgtype.
 * @return text
 */
function my_custom_fudoimgtype_print($imgtype) {

	switch ($imgtype) {
		case "1" :
			$imgtype = "(間取)"; break;
		case "2" :
			$imgtype = "(外観)"; break;
		case "3" :
			$imgtype = "(地図)"; break;
		case "4" :
			$imgtype = "(周辺)"; break;
		case "5" :
			$imgtype = "(内装)"; break;
		case "9" :
			$imgtype = ""; break;	//(その他画像)
		case "10" :
			$imgtype = "(玄関)"; break;
		case "11" :
			$imgtype = "(居間)"; break;
		case "12" :
			$imgtype = "(キッチン)"; break;
		case "13" :
			$imgtype = "(寝室)"; break;
		case "14" :
			$imgtype = "(子供部屋)"; break;
		case "15" :
			$imgtype = "(風呂)"; break;
	}

	return $imgtype;
}


/*
 * bukken_order 逆転
 *
 * inc-archive-fudo.php
 * add_filter( 'bukken_order_reversal', 'bukken_order_reversal' )
 * ver1.9.6
 */
function bukken_order_reversal( $bukken_order ){

	if( $bukken_order == 'd' ){
		$bukken_order = '';
	}else{
		$bukken_order = 'd';
	}

	return $bukken_order;
}
add_filter( 'bukken_order_reversal', 'bukken_order_reversal' );

