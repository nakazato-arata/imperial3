<?php
/*
 * 不動産プラグイン 条件検索ページ(固定ページ)
 * @package WordPress5.5
 * @subpackage Fudousan Plugin
 * Version: 5.6.1
*/

/**
 * 物件表示ショートコード設定
 *
 * [page_jyoken shu=1]	売買
 * [page_jyoken shu=2]	賃貸
 *
 * @since Fudousan  Plugin 1.7.6
 * @param int shu.
*/
function page_jyoken_func_shortcode( $atts ) {

	$shub = isset($atts['shu']) ? (int)$atts['shu'] : '';

	if( $shub == 1 || $shub == 2 ) {
		return fudou_page_jyoken_for_themes( $shub, 'return' );
	}
}
add_shortcode('page_jyoken', 'page_jyoken_func_shortcode');


/*
 * 条件検索ページ(固定ページ)
 *
 * @since Fudousan  Plugin 5.6.1
 * For page-jyoken-XXXXX.php
 * do_action( 'fudou_page_jyoken_themes', $shub );
 *
 * @param int $shub.
 * @param str $return_type. 'return'
*/
function fudou_page_jyoken_for_themes( $shub, $return_type='' ){

	global $wpdb;
	global $work_bukkenshubetsu;
	global $work_madori;
	global $work_setsubi;

	$site = home_url( '/' ); 

	$shub_txt = '';
	$madori_dat = '';

	$page_jyoken_dat = "\n<!-- 条件検索ページ(固定ページ) -->\n";

	if( $shub ) {

		if( $shub == 1 ) {
			$shub_txt = ' (売買)';
		}
		if( $shub == 2 ) {
			$shub_txt = ' (賃貸)';
		}

		$shu_id = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';
		$shu_data = '';
	/*
		if($shu_id == '1') $shu_data = '< 3000' ;
		if($shu_id == '2') $shu_data = '> 3000' ;
		if(intval($shu_id) > 3) $shu_data = '= ' .$shu_id ;
	*/
		// for checked
		$re_id		= isset($_GET['re']) ?		myIsNum_f($_GET['re']) : ''; 	//路線駅
		$ksik_id	= isset($_GET['ksik']) ?	myIsNum_f($_GET['ksik']) : ''; 	//県市区
		$tik_data	= isset($_GET['tik']) ?		myIsNum_f($_GET['tik']) : '';  	//築年数
		$kalb_data	= isset($_GET['kalb']) ?	myIsNum_f($_GET['kalb']) : ''; 	//価格下限
		$kahb_data	= isset($_GET['kahb']) ?	myIsNum_f($_GET['kahb']) : ''; 	//価格上限
		$kalc_data	= isset($_GET['kalc']) ?	myIsNum_f($_GET['kalc']) : ''; 	//価格下限
		$kahc_data	= isset($_GET['kahc']) ?	myIsNum_f($_GET['kahc']) : ''; 	//価格上限
		$hof_data	= isset($_GET['hof']) ?		myIsNum_f($_GET['hof']) : '';  	//歩分
		$madori_id	= isset($_GET['mad']) ?		myIsNum_f($_GET['mad']) : ''; 	//間取り
		$mel_data	= isset($_GET['mel']) ?		myIsNum_f($_GET['mel']) : '';  	//面積下限
		$meh_data	= isset($_GET['meh']) ?		myIsNum_f($_GET['meh']) : '';  	//面積上限
		$set_id		= isset($_GET['set']) ?		myIsNum_f($_GET['set']) : ''; 	//設備
		$ken_id		= isset($_GET['ken']) ?		myIsNum_f($_GET['ken']) : ''; 	//設備
		$ztm_id		= isset($_GET['ztm']) ?		myIsNum_f($_GET['ztm']) : ''; 	

		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes1_return', '', $shub );

		//Newオプション ver1.9.3
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes1_new_return', $page_jyoken_dat, $shub );


		$page_jyoken_dat .= '<div id="page_jsearch_page">';

		$page_jyoken_dat .= 'ご希望の条件を選択して下さい(複数可)<br />';

		$page_jyoken_dat .= '<form method="get" id="searchpage" name="searchpage" action="' . $site . '" >';
		$page_jyoken_dat .= '<input type="hidden" name="bukken" value="jsearch">';
		//売買
		if( $shub == 1 ){
			$page_jyoken_dat .= '<input type="hidden" name="shub" value="1">';
			$shu_data = '< 3000' ;
		}
		//賃貸
		if( $shub == 2 ){
			$page_jyoken_dat .= '<input type="hidden" name="shub" value="2">';
			$shu_data = '> 3000' ;
		}

		//県 ver5.6.1
		if( $ken_id ){
			$page_jyoken_dat .= '<input type="hidden" name="ken" value="' . $ken_id . '">';
		}

		//ztm 全国都道府県マップフラグ
		if( $ztm_id ) {
			$page_jyoken_dat .= '<input type="hidden" name="ztm" value="' . $ztm_id . '">';
		}


		$page_jyoken_dat .= '<table class="form_jsearch">';

		//種別選択
		$page_jyoken_dat .= '<tr id="shubetsu2">';
		$page_jyoken_dat .= '<th>物件種別'.$shub_txt.'</th>';
		$page_jyoken_dat .= '<td class="shubetsu">';

			$sql  =  " SELECT DISTINCT PM.meta_value AS bukkenshubetsu";
			$sql .=  " FROM ($wpdb->posts AS P ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id) ";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );

			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'page_jyoken' );


			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
			$sql .=  " AND PM.meta_key='bukkenshubetsu' ";
			$sql .=  " AND CAST( PM.meta_value AS SIGNED ) ". $shu_data ;

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'page_jyoken' );


			$sql .=  " ORDER BY PM.meta_value";
		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );

			if(!empty($metas)) {
				$page_jyoken_dat .= '<ul>';
				foreach ( $metas as $meta ) {
					$bukkenshubetsu_id = $meta['bukkenshubetsu'];

					foreach($work_bukkenshubetsu as $meta_box){
						if( $bukkenshubetsu_id ==  $meta_box['id'] ){
							$page_jyoken_dat .= '<li>';
							$page_jyoken_dat .= '<input type="checkbox" name="shu[]"  value="'.$meta_box['id'].'" id="'.$meta_box['id'].'"';

							// for checked
								if( $shu_id && is_array( $shu_id ) ) {
									foreach( $shu_id as $meta_box4 ){
										if( $meta_box4 == $meta_box['id'] ) $page_jyoken_dat .= ' checked="checked"';
									}
								}

							$page_jyoken_dat .= ' /><label for="'.$meta_box['id'].'">'.$meta_box['name'].'</label>';
							$page_jyoken_dat .= '</li>';
						}
					}
				}
				$page_jyoken_dat .= '</ul>';
			}else{
				$page_jyoken_dat .= '物件がありません。';
			}
		$page_jyoken_dat .= '</td>';
		$page_jyoken_dat .= '</tr>';


		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes2_return', '', $shub );

		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes2_new_return', $page_jyoken_dat, $shub );


			$sql  = "SELECT DISTINCT DTR.rosen_name,DTR.rosen_id,DTS.station_name, DTS.station_id ,DTS.station_ranking ";
			$sql .= " FROM (((((( $wpdb->posts AS P ) ";
			$sql .= " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ) ";
			$sql .= " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ) ";
			$sql .= " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id ) ";
			$sql .= " INNER JOIN " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR ON CAST( PM_1.meta_value AS SIGNED ) = DTR.rosen_id) ";
			$sql .= " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTS.rosen_id = DTR.rosen_id AND  CAST( PM.meta_value AS SIGNED ) = DTS.station_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );

			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'page_jyoken' );

			$sql .= " WHERE";
			$sql .= "  ( P.post_status='publish' ";
			$sql .= " AND P.post_password = '' ";
			$sql .= " AND P.post_type ='fudo' ";
			$sql .= " AND PM.meta_key='koutsueki1' ";
			$sql .= " AND PM_1.meta_key='koutsurosen1' ";
			$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
			$sql .= " AND PM_2.meta_value $shu_data  ";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'page_jyoken' );

			$sql .= " ) ";
			$sql .= " OR ";
			$sql .= " ( P.post_status='publish' ";
			$sql .= " AND P.post_password = '' ";
			$sql .= " AND P.post_type ='fudo' ";
			$sql .= " AND PM.meta_key='koutsueki2' ";
			$sql .= " AND PM_1.meta_key='koutsurosen2' ";
			$sql .= " AND PM_2.meta_key='bukkenshubetsu' ";
			$sql .= " AND PM_2.meta_value $shu_data ";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'page_jyoken' );

			$sql .= " ) ";
		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql, ARRAY_A );

			if(!empty($metas)) {

				$page_jyoken_dat .= '<tr id="eki2">';
				$page_jyoken_dat .= '<th>路線駅</th>';
				$page_jyoken_dat .= '<td class="eki">';

				//ソート
				foreach($metas as $key => $row){
					$foo[$key] = $row["rosen_name"];
					$bar[$key] = $row["station_ranking"];
				}
				array_multisort($foo,SORT_DESC,$bar,SORT_ASC,$metas);

				$tmp_rosen_id= '';

				foreach ( $metas as $meta ) {

					$rosen_name =  $meta['rosen_name'];
					$rosen_id   =  $meta['rosen_id'];
					$station_name =  $meta['station_name'];
					$station_id   =  $meta['station_id'];

					$ros_code = sprintf('%06d', $rosen_id );

					//路線表示
					if( $tmp_rosen_id != $rosen_id){
						if( $tmp_rosen_id != '') $page_jyoken_dat .= "</ul>\n";
						$page_jyoken_dat .= '<h5>'.$rosen_name.'</h5>';
						$page_jyoken_dat .= '<ul>';
					}
					//駅表示
						$station_id = $ros_code . ''. sprintf('%06d', $station_id);
						$page_jyoken_dat .= '<li><input type="checkbox" name="re[]" value="'.$station_id.'" id="eki'.$station_id.'"';

						// for checked
							if( $re_id && is_array( $re_id ) ) {
								foreach( $re_id as $meta_box4 ){
									if( $meta_box4 == $station_id ) $page_jyoken_dat .= ' checked="checked"';
								}
							}

						$page_jyoken_dat .= ' /><label for="eki'.$station_id.'">'.$station_name.'</label></li>';
					$tmp_rosen_id   = $rosen_id;
				}
				$page_jyoken_dat .= "</ul>";

				$page_jyoken_dat .= '</td>';
				$page_jyoken_dat .= '</tr>';
			}


		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes3_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes3_new_return', $page_jyoken_dat, $shub );


		//市区選択
		$page_jyoken_dat .= '<tr id="shiku2">';
		$page_jyoken_dat .= '<th>エリア (市区)</th>';
		$page_jyoken_dat .= '<td class="shiku">';

			//営業県
			for( $i=1; $i<48 ; $i++ ){

				if( get_option('ken'.$i) != '' ){

					$ken_code = get_option('ken'.$i);

					$sql  =  " SELECT DISTINCT NA.narrow_area_name, LEFT(PM.meta_value,5) AS middle_narrow_area_id";
					$sql .=  " FROM ((($wpdb->posts AS P";
					$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
					$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
					$sql .=  " INNER JOIN " . $wpdb->prefix . DB_SHIKU_TABLE . " AS NA ON CAST( RIGHT(LEFT(PM.meta_value,5),3) AS SIGNED ) = NA.narrow_area_id)";

					//検索 SQL 表示制限 INNER JOIN
					$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );

					//New 検索 SQL 表示制限 INNER JOIN v5.6.1
					$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'page_jyoken' );

					$sql .=  " WHERE PM.meta_key='shozaichicode' ";
					$sql .=  " AND P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
					$sql .=  " AND PM_1.meta_key='bukkenshubetsu'";
					$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) ".$shu_data."";
					$sql .=  " AND CAST( LEFT(PM.meta_value,2) AS SIGNED ) =  ". $ken_code . "";
					$sql .=  " AND NA.middle_area_id = ". $ken_code . "";

					//検索 SQL 表示制限 WHERE
					$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

					//New 検索 SQL 表示制限 WHERE v5.6.1
					$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'page_jyoken' );

					$sql .=  " ORDER BY CAST( PM.meta_value AS SIGNED )";
				//	$sql = $wpdb->prepare($sql,'');
					$metas = $wpdb->get_results( $sql,  ARRAY_A );

					if(!empty($metas)) {

						$page_jyoken_dat .= '<h5 class="ken_name">'.fudo_ken_name($i).'</h5>';
						$page_jyoken_dat .= '<ul>';
						foreach ( $metas as $meta ) {
							$middle_narrow_area_id = $meta['middle_narrow_area_id'];
							$narrow_area_name = $meta['narrow_area_name'];
							$page_jyoken_dat .= '<li>';
							$page_jyoken_dat .= '<input type="checkbox" name="ksik[]"  value="'.$middle_narrow_area_id.'" id="'.$middle_narrow_area_id.'"';

							// for checked
								if( $ksik_id && is_array( $ksik_id ) ) {
									foreach( $ksik_id as $meta_box4 ){
										if( $meta_box4 == $middle_narrow_area_id ) $page_jyoken_dat .= ' checked="checked"';
									}
								}

							$page_jyoken_dat .= ' /><label for="'.$middle_narrow_area_id.'">'.$narrow_area_name.'</label>';
							$page_jyoken_dat .= '</li>';
						}
						$page_jyoken_dat .= '</ul>';
					}

				}
			}

		$page_jyoken_dat .= '</td>';
		$page_jyoken_dat .= '</tr>';


		//町名選択
		$page_jyoken_dat .= apply_filters( 'fudouchoumei_page_jyoken_themes_return', '', $shub );

		//校区選択
		$page_jyoken_dat .= apply_filters( 'fudoukouku_page_jyoken_themes_return', '', $shub );

		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes4_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes4_new_return', $page_jyoken_dat, $shub );


		//築年数
		$page_jyoken_dat .= '<tr id="chikunen2">';
		$page_jyoken_dat .= '<th>築年数</th>';
		$page_jyoken_dat .= '<td class="chikunen">';
		/*
			$page_jyoken_dat .= '<span style="display: inline-block">';
			$page_jyoken_dat .= '<input type="checkbox" name="tik"  value="1" id="tik1">';
			$page_jyoken_dat .= '<label for="tik1">新築</label>';
			$page_jyoken_dat .= '</span>';
		*/
		$page_jyoken_dat .= '<select title="築年数選択" name="tik" id="tik2">';
		$page_jyoken_dat .= '<option value="0">指定なし</option>';
		$page_jyoken_dat .= '<option value="1"';			if ($tik_data == '1') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1年以内</option>';
		$page_jyoken_dat .= '<option value="3"';			if ($tik_data == '3') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>3年以内</option>';
		$page_jyoken_dat .= '<option value="5"';			if ($tik_data == '5') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>5年以内</option>';
		$page_jyoken_dat .= '<option value="10"';			if ($tik_data == '10') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>10年以内</option>';
		$page_jyoken_dat .= '<option value="15"';			if ($tik_data == '15') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>15年以内</option>';
		$page_jyoken_dat .= '<option value="20"';			if ($tik_data == '20') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>20年以内</option>';
		$page_jyoken_dat .= '</select>';
		$page_jyoken_dat .= '</td>';
		$page_jyoken_dat .= '</tr>';



		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes5_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes5_new_return', $page_jyoken_dat, $shub );


		//価格選択
		if( $shub == 1 ){

			$page_jyoken_dat .= '<tr id="kakaku2">';
			$page_jyoken_dat .= '<th>価格</th>';
			$page_jyoken_dat .= '<td class="kakaku">';
			$page_jyoken_dat .= '<select title="価格選択 下限" name="kalb" id="kalb2">';
			$page_jyoken_dat .= '<option value="0">下限なし</option>';
			$page_jyoken_dat .= '<option value="300"'; 			if ($kalb_data == '300') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>300万円</option>';
			$page_jyoken_dat .= '<option value="400"';			if ($kalb_data == '400') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>400万円</option>';
			$page_jyoken_dat .= '<option value="500"';			if ($kalb_data == '500') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>500万円</option>';
			$page_jyoken_dat .= '<option value="600"';			if ($kalb_data == '600') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>600万円</option>';
			$page_jyoken_dat .= '<option value="700"';			if ($kalb_data == '700') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>700万円</option>';
			$page_jyoken_dat .= '<option value="800"';			if ($kalb_data == '800') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>800万円</option>';
			$page_jyoken_dat .= '<option value="900"';			if ($kalb_data == '900') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>900万円</option>';
			$page_jyoken_dat .= '<option value="1000"';			if ($kalb_data == '1000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1000万円</option>';
			$page_jyoken_dat .= '<option value="1100"';			if ($kalb_data == '1100') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1100万円</option>';
			$page_jyoken_dat .= '<option value="1200"';			if ($kalb_data == '1200') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1200万円</option>';
			$page_jyoken_dat .= '<option value="1300"';			if ($kalb_data == '1300') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1300万円</option>';
			$page_jyoken_dat .= '<option value="1400"';			if ($kalb_data == '1400') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1400万円</option>';
			$page_jyoken_dat .= '<option value="1500"';			if ($kalb_data == '1500') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1500万円</option>';
			$page_jyoken_dat .= '<option value="1600"';			if ($kalb_data == '1600') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1600万円</option>';
			$page_jyoken_dat .= '<option value="1700"';			if ($kalb_data == '1700') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1700万円</option>';
			$page_jyoken_dat .= '<option value="1800"';			if ($kalb_data == '1800') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1800万円</option>';
			$page_jyoken_dat .= '<option value="1900"';			if ($kalb_data == '1900') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1900万円</option>';
			$page_jyoken_dat .= '<option value="2000"';			if ($kalb_data == '2000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>2000万円</option>';
			$page_jyoken_dat .= '<option value="3000"';			if ($kalb_data == '3000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>3000万円</option>';
			$page_jyoken_dat .= '<option value="5000"';			if ($kalb_data == '5000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>5000万円</option>';
			$page_jyoken_dat .= '<option value="7000"';			if ($kalb_data == '7000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>7000万円</option>';
			$page_jyoken_dat .= '<option value="10000"';			if ($kalb_data == '10000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1億円</option>';
			$page_jyoken_dat .= '</select>　～　';
			$page_jyoken_dat .= '<select title="価格選択 上限" name="kahb" id="kahb2">';
			$page_jyoken_dat .= '<option value="300"';			if ($kahb_data == '300') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>300万円</option>';
			$page_jyoken_dat .= '<option value="400"';			if ($kahb_data == '400') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>400万円</option>';
			$page_jyoken_dat .= '<option value="500"';			if ($kahb_data == '500') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>500万円</option>';
			$page_jyoken_dat .= '<option value="600"';			if ($kahb_data == '600') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>600万円</option>';
			$page_jyoken_dat .= '<option value="700"';			if ($kahb_data == '700') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>700万円</option>';
			$page_jyoken_dat .= '<option value="800"';			if ($kahb_data == '800') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>800万円</option>';
			$page_jyoken_dat .= '<option value="900"';			if ($kahb_data == '900') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>900万円</option>';
			$page_jyoken_dat .= '<option value="1000"';			if ($kahb_data == '1000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1000万円</option>';
			$page_jyoken_dat .= '<option value="1100"';			if ($kahb_data == '1100') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1100万円</option>';
			$page_jyoken_dat .= '<option value="1200"';			if ($kahb_data == '1200') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1200万円</option>';
			$page_jyoken_dat .= '<option value="1300"';			if ($kahb_data == '1300') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1300万円</option>';
			$page_jyoken_dat .= '<option value="1400"';			if ($kahb_data == '1400') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1400万円</option>';
			$page_jyoken_dat .= '<option value="1500"';			if ($kahb_data == '1500') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1500万円</option>';
			$page_jyoken_dat .= '<option value="1600"';			if ($kahb_data == '1600') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1600万円</option>';
			$page_jyoken_dat .= '<option value="1700"';			if ($kahb_data == '1700') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1700万円</option>';
			$page_jyoken_dat .= '<option value="1800"';			if ($kahb_data == '1800') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1800万円</option>';
			$page_jyoken_dat .= '<option value="1900"';			if ($kahb_data == '1900') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1900万円</option>';
			$page_jyoken_dat .= '<option value="2000"';			if ($kahb_data == '2000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>2000万円</option>';
			$page_jyoken_dat .= '<option value="3000"';			if ($kahb_data == '3000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>3000万円</option>';
			$page_jyoken_dat .= '<option value="5000"';			if ($kahb_data == '5000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>5000万円</option>';
			$page_jyoken_dat .= '<option value="7000"';			if ($kahb_data == '7000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>7000万円</option>';
			$page_jyoken_dat .= '<option value="10000"';			if ($kahb_data == '10000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1億円</option>';
			$page_jyoken_dat .= '<option value="0"';			if ($kahb_data == '0' ||$kahb_data == '' ) $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>上限なし</option>';
			$page_jyoken_dat .= '</select>';
			$page_jyoken_dat .= '</td>';
			$page_jyoken_dat .= '</tr>';
		}


		//賃料選択
		if( $shub == 2 ){

			$page_jyoken_dat .= '<tr id="kakaku2">';
			$page_jyoken_dat .= '<th>賃料</th>';
			$page_jyoken_dat .= '<td class="kakaku">';
			$page_jyoken_dat .= '<select title="賃料選択 下限" name="kalc" id="kalc2">';
			$page_jyoken_dat .= '<option value="0">下限なし</option>';
			$page_jyoken_dat .= '<option value="3"'; 			if ($kalc_data == '3') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>3万円</option>';
			$page_jyoken_dat .= '<option value="4"';			if ($kalc_data == '4') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>4万円</option>';
			$page_jyoken_dat .= '<option value="5"';			if ($kalc_data == '5') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>5万円</option>';
			$page_jyoken_dat .= '<option value="6"';			if ($kalc_data == '6') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>6万円</option>';
			$page_jyoken_dat .= '<option value="7"';			if ($kalc_data == '7') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>7万円</option>';
			$page_jyoken_dat .= '<option value="8"';			if ($kalc_data == '8') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>8万円</option>';
			$page_jyoken_dat .= '<option value="9"';			if ($kalc_data == '9') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>9万円</option>';
			$page_jyoken_dat .= '<option value="10"';			if ($kalc_data == '10') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>10万円</option>';
			$page_jyoken_dat .= '<option value="11"';			if ($kalc_data == '11') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>11万円</option>';
			$page_jyoken_dat .= '<option value="12"';			if ($kalc_data == '12') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>12万円</option>';
			$page_jyoken_dat .= '<option value="13"';			if ($kalc_data == '13') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>13万円</option>';
			$page_jyoken_dat .= '<option value="14"';			if ($kalc_data == '14') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>14万円</option>';
			$page_jyoken_dat .= '<option value="15"';			if ($kalc_data == '15') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>15万円</option>';
			$page_jyoken_dat .= '<option value="16"';			if ($kalc_data == '16') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>16万円</option>';
			$page_jyoken_dat .= '<option value="17"';			if ($kalc_data == '17') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>17万円</option>';
			$page_jyoken_dat .= '<option value="18"';			if ($kalc_data == '18') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>18万円</option>';
			$page_jyoken_dat .= '<option value="19"';			if ($kalc_data == '19') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>19万円</option>';
			$page_jyoken_dat .= '<option value="20"';			if ($kalc_data == '20') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>20万円</option>';
			$page_jyoken_dat .= '<option value="30"';			if ($kalc_data == '30') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>30万円</option>';
			$page_jyoken_dat .= '<option value="50"';			if ($kalc_data == '50') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>50万円</option>';
			$page_jyoken_dat .= '<option value="100"';			if ($kalc_data == '100') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>100万円</option>';
			$page_jyoken_dat .= '</select>　～　';
			$page_jyoken_dat .= '<select title="賃料選択 上限" name="kahc" id="kahc2">';
			$page_jyoken_dat .= '<option value="3"';			if ($kahc_data == '3') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>3万円</option>';
			$page_jyoken_dat .= '<option value="4"';			if ($kahc_data == '4') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>4万円</option>';
			$page_jyoken_dat .= '<option value="5"';			if ($kahc_data == '5') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>5万円</option>';
			$page_jyoken_dat .= '<option value="6"';			if ($kahc_data == '6') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>6万円</option>';
			$page_jyoken_dat .= '<option value="7"';			if ($kahc_data == '7') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>7万円</option>';
			$page_jyoken_dat .= '<option value="8"';			if ($kahc_data == '8') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>8万円</option>';
			$page_jyoken_dat .= '<option value="9"';			if ($kahc_data == '9') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>9万円</option>';
			$page_jyoken_dat .= '<option value="10"';			if ($kahc_data == '10') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>10万円</option>';
			$page_jyoken_dat .= '<option value="11"';			if ($kahc_data == '11') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>11万円</option>';
			$page_jyoken_dat .= '<option value="12"';			if ($kahc_data == '12') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>12万円</option>';
			$page_jyoken_dat .= '<option value="13"';			if ($kahc_data == '13') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>13万円</option>';
			$page_jyoken_dat .= '<option value="14"';			if ($kahc_data == '14') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>14万円</option>';
			$page_jyoken_dat .= '<option value="15"';			if ($kahc_data == '15') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>15万円</option>';
			$page_jyoken_dat .= '<option value="16"';			if ($kahc_data == '16') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>16万円</option>';
			$page_jyoken_dat .= '<option value="17"';			if ($kahc_data == '17') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>17万円</option>';
			$page_jyoken_dat .= '<option value="18"';			if ($kahc_data == '18') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>18万円</option>';
			$page_jyoken_dat .= '<option value="19"';			if ($kahc_data == '19') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>19万円</option>';
			$page_jyoken_dat .= '<option value="20"';			if ($kahc_data == '20') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>20万円</option>';
			$page_jyoken_dat .= '<option value="30"';			if ($kahc_data == '30') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>30万円</option>';
			$page_jyoken_dat .= '<option value="50"';			if ($kahc_data == '50') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>50万円</option>';
			$page_jyoken_dat .= '<option value="100"';			if ($kahc_data == '100') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>100万円</option>';
			$page_jyoken_dat .= '<option value="0"';			if ($kahc_data == '0' ||$kahc_data == '' ) $page_jyoken_dat .= ' selected="selected"';		$page_jyoken_dat .= '>上限なし</option>';
			$page_jyoken_dat .= '</select>';
			$page_jyoken_dat .= '</td>';
			$page_jyoken_dat .= '</tr>';
		}


		//オプション	in_rim_
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes6_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes6_new_return', $page_jyoken_dat, $shub );

		//オプション tsubotanka
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes7_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes7_new_return', $page_jyoken_dat, $shub );


		//駅歩分
		$page_jyoken_dat .= '<tr id="hof2">';
		$page_jyoken_dat .= '<th>駅歩分</th>';
		$page_jyoken_dat .= '<td class="hof">';
		$page_jyoken_dat .= '<ul>';
		$page_jyoken_dat .= '<li><input name="hof" value="0"  id="hof0"  type="radio"';	if ($hof_data) $page_jyoken_dat .= ' checked="checked"';		$page_jyoken_dat .= ' /><label for="hof0">指定なし</label></li>';
		$page_jyoken_dat .= '<li><input name="hof" value="1"  id="hof1"  type="radio"';	if ($hof_data == '1') $page_jyoken_dat .= ' checked="checked"';		$page_jyoken_dat .= ' /><label for="hof1">1分以内</label></li>';
		$page_jyoken_dat .= '<li><input name="hof" value="3"  id="hof3"  type="radio"';	if ($hof_data == '3') $page_jyoken_dat .= ' checked="checked"';		$page_jyoken_dat .= ' /><label for="hof3">3分以内</label></li>';
		$page_jyoken_dat .= '<li><input name="hof" value="5"  id="hof5"  type="radio"';	if ($hof_data == '5') $page_jyoken_dat .= ' checked="checked"';		$page_jyoken_dat .= ' /><label for="hof5">5分以内</label></li>';
		$page_jyoken_dat .= '<li><input name="hof" value="10" id="hof10" type="radio"';	if ($hof_data == '10') $page_jyoken_dat .= ' checked="checked"';	$page_jyoken_dat .= ' /><label for="hof10">10分以内</label></li>';
		$page_jyoken_dat .= '<li><input name="hof" value="15" id="hof15" type="radio"';	if ($hof_data == '15') $page_jyoken_dat .= ' checked="checked"';	$page_jyoken_dat .= ' /><label for="hof15">15分以内</label></li>';
		$page_jyoken_dat .= '</ul>';
		$page_jyoken_dat .= '</td>';
		$page_jyoken_dat .= '</tr>';


		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes8_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes8_new_return', $page_jyoken_dat, $shub );


		//間取り
		if( $shu_data !='' ){

			$sql  =  " SELECT DISTINCT PM.meta_value AS madorisu,PM_2.meta_value AS madorisyurui";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id) ";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );

			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'page_jyoken' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu'";
			$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) ".$shu_data."";
			$sql .=  " AND PM.meta_key='madorisu'";
			$sql .=  " AND PM_2.meta_key='madorisyurui'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'page_jyoken' );

		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			if(!empty($metas)) {

				//ソート
				foreach($metas as $key => $row1){
					$foo1[$key] = $row1["madorisu"];
					$bar1[$key] = $row1["madorisyurui"];
				}
				array_multisort($foo1,SORT_ASC,$bar1,SORT_ASC,$metas);

				$madori_dat .= '<ul>';
				foreach ( $metas as $meta ) {

					$madorisu_data = $meta['madorisu'];
					$madorisyurui_data = $meta['madorisyurui'];

					if( $madorisu_data == 11 ) break;

					$madori_code = $madorisu_data;
					$madori_code .= $madorisyurui_data;

					if( $madorisu_data && $madorisyurui_data ){
						foreach( $work_madori as $meta_box ){
							if( $madorisyurui_data == $meta_box['code'] ){
								$madori_dat .= '<li><input name="mad[]" value="'.$madori_code.'" id="mad2'.$madori_code.'" type="checkbox"';

								// for checked
									if( $madori_id && is_array( $madori_id ) ) {
										foreach( $madori_id as $meta_box4 ){
											if( $meta_box4 == $madori_code ) $madori_dat .= ' checked="checked"';
										}
									}

								$madori_dat .= ' /><label for="mad2'.$madori_code.'">'.$madorisu_data.$meta_box['name'].'</label></li>';
							}
						}
					}
				}
				$madori_dat .= '</ul>';
			}
		}

		if( $madori_dat != '<ul></ul>' ){
			$page_jyoken_dat .= '<tr id="madori2">';
			$page_jyoken_dat .= '<th>間取り</th>';
			$page_jyoken_dat .= '<td class="madori">'. $madori_dat .'</td>';
			$page_jyoken_dat .= '</tr>';
		}


		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes9_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes9_new_return', $page_jyoken_dat, $shub );


		/**
		 * 面積を表示/非表示.
		 * 
		 * apply_filters( 'fudou_joken_memseki_view', true )
		 * Version: 1.9.2
		 */
		if( apply_filters( 'fudou_joken_memseki_view', true ) ){

		//面積
		$page_jyoken_dat .= '<tr id="menseki2">';
		$page_jyoken_dat .= '<th>面積</th>';
		$page_jyoken_dat .= '<td class="menseki">';
		$page_jyoken_dat .= '<select title="面積選択 下限" name="mel" id="mel2">';
		$page_jyoken_dat .= '<option value="0">下限なし</option>';
		$page_jyoken_dat .= '<option value="10"';			if ($mel_data == '10') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>10m&sup2;</option>';
		$page_jyoken_dat .= '<option value="15"';			if ($mel_data == '15') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>15m&sup2;</option>';
		$page_jyoken_dat .= '<option value="20"';			if ($mel_data == '20') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>20m&sup2;</option>';
		$page_jyoken_dat .= '<option value="25"';			if ($mel_data == '25') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>25m&sup2;</option>';
		$page_jyoken_dat .= '<option value="30"';			if ($mel_data == '30') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>30m&sup2;</option>';
		$page_jyoken_dat .= '<option value="35"';			if ($mel_data == '35') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>35m&sup2;</option>';
		$page_jyoken_dat .= '<option value="40"';			if ($mel_data == '40') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>40m&sup2;</option>';
		$page_jyoken_dat .= '<option value="50"';			if ($mel_data == '50') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>50m&sup2;</option>';
		$page_jyoken_dat .= '<option value="60"';			if ($mel_data == '60') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>60m&sup2;</option>';
		$page_jyoken_dat .= '<option value="70"';			if ($mel_data == '70') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>70m&sup2;</option>';
		$page_jyoken_dat .= '<option value="80"';			if ($mel_data == '80') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>80m&sup2;</option>';
		$page_jyoken_dat .= '<option value="90"';			if ($mel_data == '90') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>90m&sup2;</option>';
		$page_jyoken_dat .= '<option value="100"';			if ($mel_data == '100') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>100m&sup2;</option>';
		$page_jyoken_dat .= '<option value="200"';			if ($mel_data == '200') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>200m&sup2;</option>';
		$page_jyoken_dat .= '<option value="300"';			if ($mel_data == '300') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>300m&sup2;</option>';
		$page_jyoken_dat .= '<option value="400"';			if ($mel_data == '400') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>400m&sup2;</option>';
		$page_jyoken_dat .= '<option value="500"';			if ($mel_data == '500') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>500m&sup2;</option>';
		$page_jyoken_dat .= '<option value="600"';			if ($mel_data == '600') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>600m&sup2;</option>';
		$page_jyoken_dat .= '<option value="700"';			if ($mel_data == '700') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>700m&sup2;</option>';
		$page_jyoken_dat .= '<option value="800"';			if ($mel_data == '800') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>800m&sup2;</option>';
		$page_jyoken_dat .= '<option value="900"';			if ($mel_data == '900') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>900m&sup2;</option>';
		$page_jyoken_dat .= '<option value="1000"';			if ($mel_data == '1000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1000m&sup2;</option>';
		$page_jyoken_dat .= '</select>　～　';
		$page_jyoken_dat .= '<select title="面積選択 上限" name="meh" id="meh2">';
		$page_jyoken_dat .= '<option value="10"';			if ($meh_data == '10') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>10m&sup2;</option>';
		$page_jyoken_dat .= '<option value="15"';			if ($meh_data == '15') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>15m&sup2;</option>';
		$page_jyoken_dat .= '<option value="20"';			if ($meh_data == '20') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>20m&sup2;</option>';
		$page_jyoken_dat .= '<option value="25"';			if ($meh_data == '25') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>25m&sup2;</option>';
		$page_jyoken_dat .= '<option value="30"';			if ($meh_data == '30') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>30m&sup2;</option>';
		$page_jyoken_dat .= '<option value="35"';			if ($meh_data == '35') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>35m&sup2;</option>';
		$page_jyoken_dat .= '<option value="40"';			if ($meh_data == '40') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>40m&sup2;</option>';
		$page_jyoken_dat .= '<option value="50"';			if ($meh_data == '50') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>50m&sup2;</option>';
		$page_jyoken_dat .= '<option value="60"';			if ($meh_data == '60') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>60m&sup2;</option>';
		$page_jyoken_dat .= '<option value="70"';			if ($meh_data == '70') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>70m&sup2;</option>';
		$page_jyoken_dat .= '<option value="80"';			if ($meh_data == '80') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>80m&sup2;</option>';
		$page_jyoken_dat .= '<option value="90"';			if ($meh_data == '90') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>90m&sup2;</option>';
		$page_jyoken_dat .= '<option value="100"';			if ($meh_data == '100') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>100m&sup2;</option>';
		$page_jyoken_dat .= '<option value="200"';			if ($meh_data == '200') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>200m&sup2;</option>';
		$page_jyoken_dat .= '<option value="300"';			if ($meh_data == '300') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>300m&sup2;</option>';
		$page_jyoken_dat .= '<option value="400"';			if ($meh_data == '400') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>400m&sup2;</option>';
		$page_jyoken_dat .= '<option value="500"';			if ($meh_data == '500') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>500m&sup2;</option>';
		$page_jyoken_dat .= '<option value="600"';			if ($meh_data == '600') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>600m&sup2;</option>';
		$page_jyoken_dat .= '<option value="700"';			if ($meh_data == '700') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>700m&sup2;</option>';
		$page_jyoken_dat .= '<option value="800"';			if ($meh_data == '800') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>800m&sup2;</option>';
		$page_jyoken_dat .= '<option value="900"';			if ($meh_data == '900') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>900m&sup2;</option>';
		$page_jyoken_dat .= '<option value="1000"';			if ($meh_data == '1000') $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>1000m&sup2;</option>';
		$page_jyoken_dat .= '<option value="0"';			if ($meh_data == '0' ||$meh_data == '' ) $page_jyoken_dat .= ' selected="selected"';			$page_jyoken_dat .= '>上限なし</option>';
		$page_jyoken_dat .= '</select>';
		$page_jyoken_dat .= '</td>';
		$page_jyoken_dat .= '</tr>';

		} //面積を表示/非表示.

		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes10_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes10_new_return', $page_jyoken_dat, $shub );

		//イン条件選択
		$page_jyoken_dat .= apply_filters( 'fudou_in_cat_page_jyoken_themes_return', '', $shub );

		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes11_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes11_new_return', $page_jyoken_dat, $shub );


		//設備
			if( $shu_data !='' ){
				$widget_seach_setsubi = maybe_unserialize( get_option('widget_seach_setsubi') );
				$sql  =  " SELECT DISTINCT PM.meta_value AS setsubi";
				$sql .=  " FROM (($wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";

				//検索 SQL 表示制限 INNER JOIN
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );

				//New 検索 SQL 表示制限 INNER JOIN v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'page_jyoken' );

				$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
				$sql .=  " AND PM_1.meta_key='bukkenshubetsu'";
				$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) ".$shu_data."";
				$sql .=  " AND PM.meta_key='setsubi'";

				//検索 SQL 表示制限 WHERE
				$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );

				//New 検索 SQL 表示制限 WHERE v5.6.1
				$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'page_jyoken' );

				$sql .=  " ORDER BY CAST( PM.meta_value AS SIGNED )";
			//	$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_results( $sql,  ARRAY_A );

				$array_setsubi = array();

				if(!empty($metas)) {
					foreach($work_setsubi as $meta_box){
						foreach ( $metas as $meta ) {
							$setsubi_data = $meta['setsubi'];
							if( strpos($setsubi_data,$meta_box['code']) ){
								$setsubi_code = $meta_box['code'];
								$setsubi_name = $meta_box['name'];
								$data = array( $setsubi_code => array("code" => $setsubi_code,"name" => $setsubi_name));
								foreach($array_setsubi as $meta_box2){
									if ( $setsubi_code == $meta_box2['code'])
										$data = '';
								}
								if(!empty($data))
								$array_setsubi = array_merge( $data , $array_setsubi);
							//	$array_setsubi = array_push( $data , $array_setsubi);
							}
						}
					}
				}
				if( !empty( $array_setsubi ) ) {

					$setsubi_dat ='';
					krsort($array_setsubi);
					$setsubi_dat .= '<ul>';
					foreach($array_setsubi as $meta_box3){
						//$widget_seach_setsubi
						if(is_array($widget_seach_setsubi)) {
							$k=0;
							foreach($widget_seach_setsubi as $meta_box5){
								if($widget_seach_setsubi[$k] == $meta_box3['code']){
									$setsubi_dat .= '<li>';
									$setsubi_dat .= '<input type="checkbox" name="set[]"  value="'.$meta_box3['code'].'" id="set2'.$meta_box3['code'].'"';

									// for checked
										if( $set_id && is_array( $set_id ) ) {
											foreach($set_id as $meta_box4){
												if( $meta_box4 == $meta_box3['code'] ) $setsubi_dat .= ' checked="checked"';
											}
										}

									$setsubi_dat .= '>';
									$setsubi_dat .= '<label for="set2'.$meta_box3['code'].'">'.$meta_box3['name'].'</label>';
									$setsubi_dat .= '</li>';
								}
								$k++;
							}
						}else{
								$setsubi_dat .= '<li>';
								$setsubi_dat .= '<input type="checkbox" name="set[]"  value="'.$meta_box3['code'].'" id="set2'.$meta_box3['code'].'"';

									// for checked
										if( $set_id && is_array( $set_id ) ) {
											foreach($set_id as $meta_box4){
												if( $meta_box4 == $meta_box3['code'] ) $setsubi_dat .= ' checked="checked"';
											}
										}

								$setsubi_dat .= '>';
								$setsubi_dat .= '<label for="set2'.$meta_box3['code'].'">'.$meta_box3['name'].'</label>';
								$setsubi_dat .= '</li>';
						}
					}
					$setsubi_dat .= '</ul>';

					if( $setsubi_dat !='' && $setsubi_dat != '<ul></ul>' ){
						$page_jyoken_dat .= '<tr id="setsubi2">';
						$page_jyoken_dat .= '<th>条件・設備<br /> (絞込み)</th>';
						$page_jyoken_dat .= '<td class="setsubi">'. $setsubi_dat .'</td>';
						$page_jyoken_dat .= '</tr>';
					}
				}
			}


		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes12_return', '', $shub );
		//Newオプション
		$page_jyoken_dat = apply_filters( 'fudou_page_jyoken_themes12_new_return', $page_jyoken_dat, $shub );

		$page_jyoken_dat .= '</table>';
		$page_jyoken_dat .= '<div class="submit"><input type="submit" value="物件検索" /></div>';
		$page_jyoken_dat .= '</form>';


		//オプション
		$page_jyoken_dat .= apply_filters( 'fudou_page_jyoken_themes13_return', '', $shub );

		$page_jyoken_dat .= '</div>';	//page_jsearch_page

	}
	$page_jyoken_dat .= "\n<!-- .条件検索ページ(固定ページ) -->\n";


	if( $return_type == 'return' ){
		return $page_jyoken_dat;
	}else{
		echo $page_jyoken_dat;
	}


}
add_action( 'fudou_page_jyoken_themes', 'fudou_page_jyoken_for_themes', 10, 2 );

