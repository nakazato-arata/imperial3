<?php
/**
 * The Template for displaying fudou archive posts.
 *
 * @package WordPress5.6
 * @subpackage Fudousan Plugin
 * Version: 5.6.1
 */





/**** 検索 SQL ****/


	//SQL タクソノミー用(デフォルト)
	if( $s == '' ){
		/*
		 * カテゴリIDで検索
		 * ver1.9.1
		 */
		$term_id_dat = apply_filters( 'fudou_archive_child_cat_extraction', '', $slug_data, $taxonomy_name );

		//価格・築年月 ソート用
			$sql  =  " SELECT count(DISTINCT P.ID) AS co ";
			$sql .=  " FROM ((($wpdb->posts AS P ";
			$sql .=  " INNER JOIN $wpdb->term_relationships AS TR ON P.ID = TR.object_id) ";
			$sql .=  " INNER JOIN ($wpdb->terms AS T INNER JOIN $wpdb->term_taxonomy AS TT ON T.term_id = TT.term_id) ON TR.term_taxonomy_id = TT.term_taxonomy_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			/*
			 * 検索 SQL 表示制限 INNER JOIN
			 *
			 * inc-archive-fudo.php
			 * gmark.php
			 * $sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			 *
			 */
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_password='' AND P.post_status='publish'";

			if( $term_id_dat ){
				$sql .=  " AND T.term_id ".$term_id_dat."";	//カテゴリIDで検索
			}else{
				$sql .=  " AND T.slug='".$slug_data."'";
			}

			$sql .=  " AND TT.taxonomy='".$taxonomy_name."'";

			/*
			 * ウィジェット検索 SQL ORDER 対象
			 *
			 * inc-archive-fudo.php
			 * $sql .=  " AND PM_2.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";
			 * ver 1.9.2
			 */
			$sql .=  " AND PM_2.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";

			/*
			 * 検索 SQL 表示制限 WHERE
			 *
			 * inc-archive-fudo.php
			 * gmark.php
			 * $sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			 *
			 */
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//タクソノミーリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT TR.object_id",$sql);

			//ソート
			if( $bukken_sort_data2 == "post_modified" ||  $bukken_sort_data2 == "post_date" ){
				//更新日順・登録日順
				$sql_order = " ORDER BY P." . $bukken_sort_data2 . " " . $bukken_order_data2;
			}else{
				//テキスト順
				if($bukken_sort_data== "tatemonochikunenn"){
					$sql_order = " ORDER BY PM_2.meta_value ".$bukken_order_data;
				}else{
				//数値順
					$sql_order = " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED )".$bukken_order_data;
				}
			}

			/*
			 * ウィジェット検索 SQL ORDER
			 *
			 * inc-archive-fudo.php
			 * $sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );
			 * ver 1.9.2
			 */
			$sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );

			$sql2 .= " LIMIT ".$limit_from.",".$limit_to."";

		//面積 ソート用
		if($bukken_sort_data == "tatemonomenseki" ){

				$sql_a  =  " (SELECT P.ID , PM.meta_value";
				$sql_a .=  " FROM (((($wpdb->posts AS P ";
				$sql_a .=  " INNER JOIN $wpdb->term_relationships AS TR ON P.ID = TR.object_id) ";
				$sql_a .=  " INNER JOIN ($wpdb->terms AS T INNER JOIN $wpdb->term_taxonomy AS TT ON T.term_id = TT.term_id) ON TR.term_taxonomy_id = TT.term_taxonomy_id)";
				$sql_a .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id)";
				$sql_a .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id)";

				//検索 SQL 表示制限 INNER JOIN
				$sql_a .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
				//New 検索 SQL 表示制限 INNER JOIN v5.6.1
				$sql_a  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql_a, 'archive' );

				$sql_a .=  " WHERE P.post_password='' AND P.post_status='publish'";

				if( $term_id_dat ){
					$sql_a .=  " AND T.term_id ".$term_id_dat."";	//カテゴリIDで検索
				}else{
					$sql_a .=  " AND T.slug='".$slug_data."'";
				}

				$sql_a .=  " AND TT.taxonomy='".$taxonomy_name."'";
				$sql_a .=  " AND PM_1.meta_key='bukkenshubetsu' AND ( CAST(PM_1.meta_value AS SIGNED) > 1200 OR PM_1.meta_value != '3212' ) ";
				$sql_a .=  " AND PM.meta_key='tatemonomenseki' AND PM.meta_value > 0";

				//検索 SQL 表示制限 WHERE
				$sql_a .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
				//New 検索 SQL 表示制限 WHERE v5.6.1
				$sql_a  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql_a, 'archive' );

				$sql_a .=  "  )";

				$sql_a .=  " UNION ";

				$sql_a .=  " (SELECT P.ID , PM.meta_value";
				$sql_a .=  " FROM (((($wpdb->posts AS P ";
				$sql_a .=  " INNER JOIN $wpdb->term_relationships AS TR ON P.ID = TR.object_id) ";
				$sql_a .=  " INNER JOIN ($wpdb->terms AS T INNER JOIN $wpdb->term_taxonomy AS TT ON T.term_id = TT.term_id) ON TR.term_taxonomy_id = TT.term_taxonomy_id)";
				$sql_a .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id)";
				$sql_a .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id)";

				//検索 SQL 表示制限 INNER JOIN
				$sql_a .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
				//New 検索 SQL 表示制限 INNER JOIN v5.6.1
				$sql_a  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql_a, 'archive' );

				$sql_a .=  " WHERE P.post_password='' AND P.post_status='publish'";

				if( $term_id_dat ){
					$sql_a .=  " AND T.term_id ".$term_id_dat."";	//カテゴリIDで検索
				}else{
					$sql_a .=  " AND T.slug='".$slug_data."'";
				}

				$sql_a .=  " AND TT.taxonomy='".$taxonomy_name."'";
				$sql_a .=  " AND PM_1.meta_key='bukkenshubetsu' AND ( CAST(PM_1.meta_value AS SIGNED) < 1200 OR PM_1.meta_value = '3212' ) ";
				$sql_a .=  " AND PM.meta_key='tochikukaku' AND PM.meta_value > 0";

				//検索 SQL 表示制限 WHERE
				$sql_a .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
				//New 検索 SQL 表示制限 WHERE v5.6.1
				$sql_a  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql_a, 'archive' );

				$sql_a .=  "  )";

				//面積 タクソノミーリスト
				$sql =  "SELECT count(DISTINCT ID) AS co From ( " .$sql_a. " ) AS A";
				//面積ソート
				$sql2 = "SELECT DISTINCT ID AS object_id  From ( " .$sql_a. " ) AS A ORDER BY CAST( (meta_value*100) AS SIGNED) ".$bukken_order_data;
				$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		} //面積 ソート用


		//間取・所在地 ソート用
		if($bukken_sort_data== "madorisu" || $bukken_sort_data== "shozaichicode"){

			$sql  =  " SELECT count(DISTINCT P.ID) AS co ";
			$sql .=  " FROM (((($wpdb->posts AS P ";
			$sql .=  " INNER JOIN $wpdb->term_relationships AS TR ON P.ID = TR.object_id) ";
			$sql .=  " INNER JOIN ($wpdb->terms AS T INNER JOIN $wpdb->term_taxonomy AS TT ON T.term_id = TT.term_id) ON TR.term_taxonomy_id = TT.term_taxonomy_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_password='' AND P.post_status='publish'";

			if( $term_id_dat ){
				$sql .=  " AND T.term_id ".$term_id_dat."";	//カテゴリIDで検索
			}else{
				$sql .=  " AND T.slug='".$slug_data."'";
			}

			$sql .=  " AND TT.taxonomy='".$taxonomy_name."'";

			//数値・数値 間取り
			if($bukken_sort_data== "madorisu"){
				$sql .=  " AND PM.meta_key='madorisu' ";
				$sql .=  " AND PM_1.meta_key='madorisyurui' ";
			}
			//数値・テキスト
			if($bukken_sort_data== "shozaichicode"){
				$sql .=  " AND PM.meta_key='shozaichicode' ";
				$sql .=  " AND PM_1.meta_key='shozaichimeisho' ";
			}

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//タクソノミーリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT TR.object_id",$sql);
			//数値・数値ソート
			if($bukken_sort_data== "madorisu"){
				$sql2 .=  " ORDER BY CAST( (PM.meta_value*100) AS SIGNED)".$bukken_order_data.", CAST( (PM_1.meta_value*100) AS SIGNED)".$bukken_order_data."";
			}
			//数値・テキストソート
			if($bukken_sort_data== "shozaichicode"){
				$sql2 .=  " ORDER BY CAST( (PM.meta_value*100) AS SIGNED)".$bukken_order_data.", PM_1.meta_value".$bukken_order_data."";
			}

			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}
	}
	// end SQL タクソノミー用(デフォルト)







	//バス路線
		/*
		 * バス路線用 widget売買/賃貸バスリスト検索SQL
		 *
		 * @since Fudousan Bus Plugin 1.0.0
		 * For inc-archive-fudo.php apply_filters( 'fudoubus_line_sql_archive', '', $bukken_slug_data, $bukken_sort_data, $bukken_sort_data2, $bukken_order_data, $limit_from, $limit_to );
		 * return array $sql_data( $sql, $sql2 );
		*/
		$sql_data =  apply_filters( 'fudoubus_line_sql_archive', '', $bukken_slug_data, $bukken_sort_data, $bukken_sort_data2, $bukken_order_data, $limit_from, $limit_to );
		if( !empty( $sql_data ) && is_array( $sql_data ) ){
			if( isset( $sql_data[0] ) && isset( $sql_data[1] ) ){
				$sql  = $sql_data[0];
				$sql2 = $sql_data[1];
			}
		}







	//オリジナルフィルター $sql, $sql2
		/*
		 * オリジナルフィルター リスト検索SQL
		 *
		 * @since Fudousan Plugin 1.7.0
		 * For inc-archive-fudo.php apply_filters( 'fudou_org_line_sql_archive', '', $bukken_slug_data, $bukken_sort_data, $bukken_sort_data2, $bukken_order_data, $limit_from, $limit_to );
		 * return array $sql_data( $sql, $sql2 );
		*/
		$org_sql_data =  apply_filters( 'fudou_org_line_sql_archive', '', $bukken_slug_data, $bukken_sort_data, $bukken_sort_data2, $bukken_order_data, $limit_from, $limit_to );
		if( !empty( $org_sql_data ) && is_array( $org_sql_data ) ){
			if( isset( $org_sql_data[0] ) && isset( $org_sql_data[1] ) ){
				$sql  = $org_sql_data[0];
				$sql2 = $org_sql_data[1];
			}
		}







	//SQL キーワード検索  $s st
	$id_data = '';

	if( $bukken_slug_data == "search" && $s != '' ){

		if( $searchtype == '' ){

			//物件番号
			$sql  =  " SELECT DISTINCT P.ID";
			$sql .=  " FROM ($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
			$sql .=  " AND PM_1.meta_key='shikibesu' AND PM_1.meta_value LIKE '%$s%' ";

		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			$id_data1 = '';
			if(!empty($metas)) {
				foreach ( $metas as $meta ) {
						$id_data1 .= ','. $meta['ID'];
				}
			}

			//物件名
			$sql  =  " SELECT DISTINCT P.ID";
			$sql .=  " FROM ($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
			$sql .=  " AND PM_2.meta_key='bukkenmei' AND PM_2.meta_value LIKE '%$s%' ";
		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			$id_data2 = '';
			if(!empty($metas)) {
				foreach ( $metas as $meta ) {
						$id_data2 .= ','. $meta['ID'];
				}
			}

			//本文・タイトル・抜粋
			$sql  =  " SELECT DISTINCT P.ID";
			$sql .=  " FROM $wpdb->posts AS P";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
			$sql .=  " AND (P.post_content LIKE '%$s%' OR P.post_title LIKE '%$s%' OR  P.post_excerpt LIKE '%$s%')";
		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			$id_data3 = '';
			if(!empty($metas)) {
				foreach ( $metas as $meta ) {
						$id_data3 .= ','. $meta['ID'];
				}
			}

			//meta fudokeywords 
			$sql  =  " SELECT DISTINCT P.ID";
			$sql .=  " FROM ($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id )";
			$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";
			$sql .=  " AND PM_1.meta_key='fudokeywords' AND PM_1.meta_value LIKE '%$s%' ";
		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			$id_data4 = '';
			if(!empty($metas)) {
				foreach ( $metas as $meta ) {
						$id_data4 .= ','. $meta['ID'];
				}
			}

			$id_data = ' AND P.ID IN ( 0 ' . $id_data1 . $id_data2 . $id_data3 . $id_data4 . ')';
		}


		//間取・所在地 ソート用
		if($bukken_sort_data== "madorisu" || $bukken_sort_data== "shozaichicode"){

			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";

			if($searchtype != ''){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			}else{
				$sql .=  " ) ";
			}
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";

			if( $searchtype == '' )
				$sql .= $id_data;

			if( $searchtype == 'id' )
				$sql .=  " AND PM_1.meta_key='shikibesu' AND PM_1.meta_value LIKE '%$s' ";

			if( $searchtype == 'chou' )
				$sql .=  " AND PM_1.meta_key='shozaichimeisho' AND PM_1.meta_value LIKE '%$s%' ";

			//数値・数値
			if($bukken_sort_data== "madorisu"){
				$sql .=  " AND PM.meta_key='madorisu' ";
				$sql .=  " AND PM_3.meta_key='madorisyurui' ";
			}
			//数値・テキスト
			if($bukken_sort_data== "shozaichicode"){
				$sql .=  " AND PM.meta_key='shozaichicode' ";
				$sql .=  " AND PM_3.meta_key='shozaichimeisho' ";
			}

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//間取・所在地リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//数値・数値
			if($bukken_sort_data== "madorisu"){
				$sql2 .=  " ORDER BY CAST( (PM.meta_value*100) AS SIGNED )".$bukken_order_data.", CAST( (PM_3.meta_value*100) AS SIGNED )".$bukken_order_data."";
			}
			//数値・テキスト
			if($bukken_sort_data== "shozaichicode"){
				$sql2 .=  " ORDER BY CAST( (PM.meta_value*100) AS SIGNED )".$bukken_order_data.", PM_3.meta_value".$bukken_order_data."";
			}
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}else{

		//価格・面積・築年月ソート用
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((( $wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id ) ";

			if($searchtype != ''){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ) ";
			}else{
				$sql .=  " ) ";
			}

			if($shu_data != '')
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id )";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = ''  AND P.post_type ='fudo' ";

			//面積 ソート用
			if($bukken_sort_data== "tatemonomenseki"){
				$sql .=  " AND (PM_2.meta_key='tatemonomenseki' or PM_2.meta_key='tochikukaku')";
				$sql .=  " AND PM_2.meta_value > 0";

			}else{
				/*
				 * ウィジェット検索 SQL ORDER 対象
				 *
				 * inc-archive-fudo.php
				 * $sql .=  " AND PM_2.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";
				 * ver 1.9.2
				 */
				$sql .=  " AND PM_2.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";
			}

			if( $searchtype == '' )
				$sql .= $id_data;

			if( $searchtype == 'id' )
				$sql .=  " AND PM_1.meta_key='shikibesu' AND PM_1.meta_value LIKE '%$s' ";

			if( $searchtype == 'chou' )
				$sql .=  " AND PM_1.meta_key='shozaichimeisho' AND PM_1.meta_value LIKE '%$s%' ";

			if( $shu_data != '' )
				$sql .=  " AND PM_3.meta_key='bukkenshubetsu' AND CAST(PM_3.meta_value AS SIGNED)".$shu_data."";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//価格・面積・築年月リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);

			//ソート
			if( $bukken_sort_data2 == "post_modified" ||  $bukken_sort_data2 == "post_date" ){
				//更新日順・登録日順
				$sql_order = " ORDER BY P." . $bukken_sort_data2 . " " . $bukken_order_data2;
			}else{
				//テキスト順
				if($bukken_sort_data== "tatemonochikunenn"){
					$sql_order = " ORDER BY PM_2.meta_value ".$bukken_order_data;
				}else{
				//数値順
					$sql_order = " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED )".$bukken_order_data;
				}
			}

			/*
			 * ウィジェット検索 SQL ORDER
			 *
			 * inc-archive-fudo.php
			 * $sql2 .=  apply_filters( 'inc_archive_widget_sql_order', $sql_order );
			 * ver 1.9.2
			 */
			$sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );

			$sql2 .= " LIMIT ".$limit_from.",".$limit_to."";
		}
	}
	// end SQL キーワード $s







	//SQL 地域(県)
	if($bukken_slug_data=="ken"){

			//地域(県) 数値カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			/*
			 * ウィジェット検索 SQL ORDER 対象
			 *
			 * inc-archive-fudo.php
			 * $sql .=  " AND PM.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";
			 * ver 1.9.2
			 */
			$sql .=  " AND PM_2.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//地域(県) 数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);

			//ソート
			if( $bukken_sort_data2 == "post_modified" ||  $bukken_sort_data2 == "post_date" ){
				//更新日順・登録日順
				$sql_order = " ORDER BY P." . $bukken_sort_data2 . " " . $bukken_order_data2;
			}else{
				$sql_order = " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data;
			}

			/*
			 * ウィジェット検索 SQL ORDER
			 *
			 * inc-archive-fudo.php
			 * $sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );
			 * ver 1.9.2
			 */
			$sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );

			$sql2 .= " LIMIT ".$limit_from.",".$limit_to."";


		//面積 ソート用
		if($bukken_sort_data== "tatemonomenseki"){

			//地域(県) 面積カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND (PM_2.meta_key='tatemonomenseki' or PM_2.meta_key='tochikukaku')";
			$sql .=  " AND PM_2.meta_value > 0";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//地域(県) 面積リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//面積ソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//地域(県)テキストカウント ソート用
		if($bukken_sort_data== "tatemonochikunenn"){

			//地域(県) テキストカウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//地域(県) テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//テキストソート
			$sql2 .=  " ORDER BY PM_2.meta_value ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//地域(県)数値+数値カウント ソート用
		if($bukken_sort_data== "madorisu"){

			//地域(県) 数値・数値カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='madorisu' AND PM_3.meta_key='madorisyurui'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//地域(県) 数値・数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//数値・数値ソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data.", CAST( (PM_3.meta_value*100) AS SIGNED ) ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}


		//地域(県)数値+テキストカウント ソート用
		if($bukken_sort_data== "shozaichicode"){

			//地域(県) 数値・テキストカウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND PM_2.meta_key='shozaichicode' ";
			$sql .=  " AND PM_3.meta_key='shozaichimeisho'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//地域(県) 数値・テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//数値・テキストソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data.", PM_3.meta_value ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}

	}
	// end SQL 地域(県)







	//SQL 地域(県・市区)
	if($bukken_slug_data=="shiku"){

			//地域(県・市区) 数値カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			/*
			 * ウィジェット検索 SQL ORDER 対象
			 *
			 * inc-archive-fudo.php
			 * $sql .=  " AND PM.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";
			 * ver 1.9.2
			 */
			$sql .=  " AND PM_2.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//地域(県・市区) 数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);

			//ソート
			if( $bukken_sort_data2 == "post_modified" ||  $bukken_sort_data2 == "post_date" ){
				//更新日順・登録日順
				$sql_order = " ORDER BY P." . $bukken_sort_data2 . " " . $bukken_order_data2;
			}else{
				$sql_order = " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data;
			}

			/*
			 * ウィジェット検索 SQL ORDER
			 *
			 * inc-archive-fudo.php
			 * $sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );
			 * ver 1.9.2
			 */
			$sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );

			$sql2 .= " LIMIT ".$limit_from.",".$limit_to."";


		//面積
		if($bukken_sort_data== "tatemonomenseki"){

			//地域(県・市区) 面積カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			$sql .=  " AND (PM_2.meta_key='tatemonomenseki' or PM_2.meta_key='tochikukaku')";
			$sql .=  " AND PM_2.meta_value > 0";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//地域(県・市区) 面積リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//面積ソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//テキストカウント
		if($bukken_sort_data== "tatemonochikunenn"){

			//地域(県・市区) テキストカウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode'  AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );


			//地域(県・市区) テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//テキストソート
			$sql2 .=  " ORDER BY PM_2.meta_value ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//数値・数値カウント
		if($bukken_sort_data== "madorisu"){

			//地域(県・市区) 数値・数値カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND PM_2.meta_key='madorisu' AND PM_3.meta_key='madorisyurui'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );


			//地域(県・市区) 数値・数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//数値・数値ソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data.", CAST( (PM_3.meta_value*100) AS SIGNED ) ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//数値・テキストカウント
		if($bukken_sort_data== "shozaichicode"){

			//地域(県・市区) 数値・テキストカウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND PM.meta_key='shozaichicode' AND LEFT(PM.meta_value,2)='".$mid_id."'";
			$sql .=  " AND RIGHT(LEFT(PM.meta_value,5),3)='".$nor_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND PM_2.meta_key='shozaichicode' AND PM_3.meta_key='shozaichimeisho'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );


			//地域(県・市区) 数値・テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//数値・テキストソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data.", PM_3.meta_value ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}
	}
	// end SQL 地域(県・市区)







	//SQL 路線
	if($bukken_slug_data=="rosen"){

			//路線 数値カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";

			/*
			 * ウィジェット検索 SQL ORDER 対象
			 *
			 * inc-archive-fudo.php
			 * $sql .=  " AND PM.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";
			 * ver 1.9.2
			 */
			$sql .=  " AND PM_2.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//路線 数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);

			//ソート
			if( $bukken_sort_data2 == "post_modified" ||  $bukken_sort_data2 == "post_date" ){
				//更新日順・登録日順
				$sql_order = " ORDER BY P." . $bukken_sort_data2 . " " . $bukken_order_data2;
			}else{
				$sql_order = " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED) ".$bukken_order_data;
			}

			/*
			 * ウィジェット検索 SQL ORDER
			 *
			 * inc-archive-fudo.php
			 * $sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );
			 * ver 1.9.2
			 */
			$sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );

			$sql2 .= " LIMIT ".$limit_from.",".$limit_to."";


		//面積
		if($bukken_sort_data== "tatemonomenseki"){

			//路線 面積カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND (PM_2.meta_key='tatemonomenseki' or PM_2.meta_key='tochikukaku')";
			$sql .=  " AND PM_2.meta_value > 0";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );


			//路線 面積リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//面積ソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}


		//テキストカウント
		if($bukken_sort_data== "tatemonochikunenn"){

			//路線 テキストカウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );


			//路線 テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//テキストソート
			$sql2 .=  " ORDER BY PM_2.meta_value ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//数値・数値カウント
		if($bukken_sort_data== "madorisu"){

			//路線 数値・数値カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND PM_2.meta_key='madorisu' AND PM_3.meta_key='madorisyurui'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );


			//路線 数値・数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//数値・数値ソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data.", CAST( (PM_3.meta_value*100) AS SIGNED ) ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//数値・テキストカウント
		if($bukken_sort_data== "shozaichicode"){

			//路線 数値・テキストカウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND  PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND PM_2.meta_key='shozaichicode' AND PM_3.meta_key='shozaichimeisho'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//路線 数値・テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//数値・テキストソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data.", PM_3.meta_value ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}
	}
	// end SQL 路線







	//SQL 駅
	if($bukken_slug_data=="station"){

			//駅 数値カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND (PM_3.meta_key='koutsueki1' Or PM_3.meta_key='koutsueki2') ";
			$sql .=  " AND PM_3.meta_value='".$nor_id."'";

			/*
			 * ウィジェット検索 SQL ORDER 対象
			 *
			 * inc-archive-fudo.php
			 * $sql .=  " AND PM.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";
			 * ver 1.9.2
			 */
			$sql .=  " AND PM_2.meta_key='". apply_filters( 'inc_archive_widget_sql_meta', $bukken_sort_data ) . "'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );


			//駅 数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);

			//ソート
			if( $bukken_sort_data2 == "post_modified" ||  $bukken_sort_data2 == "post_date" ){
				//更新日順・登録日順
				$sql_order = " ORDER BY P." . $bukken_sort_data2 . " " . $bukken_order_data2;
			}else{
				$sql_order = " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED) ".$bukken_order_data;
			}

			/*
			 * ウィジェット検索 SQL ORDER
			 *
			 * inc-archive-fudo.php
			 * $sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );
			 * ver 1.9.2
			 */
			$sql2 .= apply_filters( 'inc_archive_widget_sql_order', $sql_order );

			$sql2 .= " LIMIT ".$limit_from.",".$limit_to."";


		//面積
		if($bukken_sort_data== "tatemonomenseki"){

			//駅 面積カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED) ".$shu_data."";
			$sql .=  " AND (PM_3.meta_key='koutsueki1' Or PM_3.meta_key='koutsueki2') ";
			$sql .=  " AND PM_3.meta_value='".$nor_id."'";
			$sql .=  " AND (PM_2.meta_key='tatemonomenseki' or PM_2.meta_key='tochikukaku')";
			$sql .=  " AND PM_2.meta_value > 0";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );


			//駅 面積リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//面積ソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//テキストカウント
		if($bukken_sort_data== "tatemonochikunenn"){

			//駅 テキストカウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM (((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND  PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND (PM_3.meta_key='koutsueki1' Or PM_3.meta_key='koutsueki2') ";
			$sql .=  " AND PM_3.meta_value='".$nor_id."'";
			$sql .=  " AND PM_2.meta_key='".$bukken_sort_data."'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//駅 テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//テキストソート
			$sql2 .=  " ORDER BY PM_2.meta_value ".$bukken_order_data;
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//数値・数値カウント
		if($bukken_sort_data== "madorisu"){

			//駅 数値・数値カウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_4 ON P.ID = PM_4.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND (PM_4.meta_key='koutsueki1' Or PM_4.meta_key='koutsueki2') ";
			$sql .=  " AND PM_4.meta_value='".$nor_id."'";
			$sql .=  " AND PM_2.meta_key='madorisu' AND PM_3.meta_key='madorisyurui'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//駅 数値・数値リスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//数値・数値ソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data.", CAST( (PM_3.meta_value*100) AS SIGNED ) ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}


		//数値・テキストカウント
		if($bukken_sort_data== "shozaichicode"){

			//駅 数値・テキストカウント
			$sql  =  " SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_4 ON P.ID = PM_4.post_id)";

			//検索 SQL 表示制限 INNER JOIN
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_inner_join', '' );
			//New 検索 SQL 表示制限 INNER JOIN v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_inner_join_return', $sql, 'archive' );

			$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
			$sql .=  " AND (PM.meta_key='koutsurosen1' Or PM.meta_key='koutsurosen2') ";
			$sql .=  " AND PM.meta_value='".$mid_id."'";
			$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED)".$shu_data."";
			$sql .=  " AND (PM_4.meta_key='koutsueki1' Or PM_4.meta_key='koutsueki2') ";
			$sql .=  " AND PM_4.meta_value='".$nor_id."'";
			$sql .=  " AND PM_2.meta_key='shozaichicode' AND PM_3.meta_key='shozaichimeisho'";

			//検索 SQL 表示制限 WHERE
			$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
			//New 検索 SQL 表示制限 WHERE v5.6.1
			$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'archive' );

			//駅 数値・テキストリスト
			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);
			//数値・テキストソート
			$sql2 .=  " ORDER BY CAST( (PM_2.meta_value*100) AS SIGNED ) ".$bukken_order_data.", PM_3.meta_value ".$bukken_order_data."";
			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";
		}

	}
	// end SQL 駅









	//SQL 条件検索
	if($bukken_slug_data=="jsearch"){

		$nowym= date('Ym');	//築年数
		$meta_dat = '';
		$next_sql = true;

		//複数駅
		if( $eki_data != '' ){

			$sql = "SELECT DISTINCT( P.ID )";
			$sql .=  " FROM ($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ";
			$sql .=  " WHERE  P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
		//	$sql .=    $id_data;
			$sql .=  " AND PM.meta_key='koutsurosen1' AND PM_1.meta_key='koutsueki1' ";
			$sql .=  " AND PM.meta_value !='' ";
			$sql .=  " AND concat( PM.meta_value,PM_1.meta_value) " . $eki_data . "";

		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			$id_data2 = '';
			if(!empty($metas)) {
				$id_data2 = ' OR (P.ID IN ( 0 ';
				foreach ( $metas as $meta ) {
						$id_data2 .= ','. $meta['ID'];
				}
				$id_data2 .= ') )';
			}

			$sql = "SELECT DISTINCT( P.ID )";
			$sql .=  " FROM ($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id";
			$sql .=  " WHERE ( P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
		//	$sql .=    $id_data;
			$sql .=  " AND PM_2.meta_key='koutsurosen2' AND PM_3.meta_key='koutsueki2' ";
			$sql .=  " AND PM_2.meta_value !='' ";
			$sql .=  " AND concat( PM_2.meta_value,PM_3.meta_value) " . $eki_data . ")";
			$sql .=  " " . $id_data2 . "";


		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );
			$id_data = '';
			if(!empty($metas)) {
				$id_data = ' AND P.ID IN ( 0 ';
				foreach ( $metas as $meta ) {
						$id_data .= ','. $meta['ID'];
				}
				$id_data .= ') ';
			}
		}


		if( $shu_data != '' && ( ($ken_id !='' && $ken_id != 0) || ($ros_id !='' && $ros_id != 0)  || $ksik_data !='' || $eki_data != ''  ) ){

			//地域・路線駅($meta_dat)
			$sql = "SELECT DISTINCT P.ID";
			$sql .=  " FROM ((( $wpdb->posts AS P";

			//種別
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";

			//県市区 /県市区複数
			if( $ken_id !='' && $ken_id > 0 || $ksik_data !='' ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_10 ON P.ID = PM_10.post_id) ";
			}else{
				$sql .=  " )";	
			}

			//路線
			if( $ros_id !='' && $ros_id > 0 ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_12 ON P.ID = PM_12.post_id) ";
			}else{
				$sql .=  " )";	
			}

			//駅
			if( $eki_id !='' && $eki_id > 0 ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_13 ON P.ID = PM_13.post_id ";
			}

			$sql .=  " WHERE ( ";

			$sql .=  " P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";

			//種別
			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND CAST(PM.meta_value AS SIGNED)".$shu_data."";

			//県
			if( $ken_id !='' && $ken_id > 0 ){
				$sql .=  " AND PM_10.meta_key='shozaichicode' AND LEFT(PM_10.meta_value,2)='".$ken_id."'";
			}
			//市区
			if( $sik_id !='' && $sik_id > 0 ){
				$sql .=  " AND RIGHT(LEFT(PM_10.meta_value,5),3)='".$sik_id."'";
			}


			//県市区 複数
			if( $ksik_data !='' ){
				$sql .=  " AND PM_10.meta_key='shozaichicode' AND PM_10.meta_value ".$ksik_data."";
			}


			//路線
			if( $ros_id !='' && $ros_id > 0 ){
				$sql .=  " AND PM_12.meta_key='koutsurosen1' AND PM_12.meta_value='".$ros_id."'";
			}

			//駅
			if( $eki_id !='' && $eki_id > 0 ){
				$sql .=  " AND PM_13.meta_key='koutsueki1' AND PM_13.meta_value='".$eki_id."'";
			}

			//複数駅
			if( $id_data !='') $sql .=  $id_data;

			$sql .=  " ) OR ( ";


			$sql .=  " P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";

			//種別
			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND CAST(PM.meta_value AS SIGNED)".$shu_data."";

			//県
			if( $ken_id !='' && $ken_id > 0 ){
				$sql .=  " AND PM_10.meta_key='shozaichicode' AND LEFT(PM_10.meta_value,2)='".$ken_id."'";
			}
			//市区
			if( $sik_id !='' && $sik_id > 0 ){
				$sql .=  " AND RIGHT(LEFT(PM_10.meta_value,5),3)='".$sik_id."'";
			}

			//県市区 複数
			if( $ksik_data !='' ){
				$sql .=  " AND PM_10.meta_key='shozaichicode' AND PM_10.meta_value ".$ksik_data."";
			}

			//路線
			if( $ros_id !='' && $ros_id > 0 ){
				$sql .=  " AND PM_12.meta_key='koutsurosen2' AND PM_12.meta_value='".$ros_id."'";
			}

			//駅
			if( $eki_id !='' && $eki_id > 0 ){
				$sql .=  " AND PM_13.meta_key='koutsueki2' AND PM_13.meta_value='".$eki_id."'";
			}

			//複数駅
			if( $id_data !='') $sql .=  $id_data;

			$sql .=  " ) ";

		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql, ARRAY_A );
			if(!empty($metas)) {
				$i=0;
				foreach ( $metas as $meta ) {
					if($i!=0) $meta_dat .= ",";
					$meta_dat .= $meta['ID'];
					$i++;
				}
			}else{
				$next_sql = false;
			}

		}


		//バス路線 ページ条件検索SQL 複数選択 $meta_dat

			/*
			 * バス路線用 widget条件検索SQL １回目
			 *
			 * @since Fudousan Bus Plugin 1.0.0
			 * For inc-archive-fudo.php apply_filters( 'fudoubus_meta_dat_archive', $meta_dat, $next_sql );
			 * @param  str $meta_dat.
			 * @param  bool $next_sql.
			 * @return str $meta_dat.
			*/
			/*
			 * バス路線用 ページ条件検索SQL 複数選択  ２回目
			 *
			 * @since Fudousan Bus Plugin 1.0.0
			 * For inc-archive-fudo.php apply_filters( 'fudoubus_meta_dat_archive', $meta_dat, $next_sql );
			 * @param  str $meta_dat.
			 * @param  bool $next_sql.
			 * @return str $meta_dat.
			*/
			$meta_dat = apply_filters( 'fudoubus_meta_dat_archive', $meta_dat, $next_sql );
			$next_sql = apply_filters( 'fudou_next_sql_archive', $next_sql );


		//オリジナルフィルター ページ条件検索SQL 複数選択 $meta_dat
			$meta_dat = apply_filters( 'fudou_org_meta_dat_archive', $meta_dat, $next_sql );
			$next_sql = apply_filters( 'fudou_org_next_sql_archive', $next_sql );


		if( $next_sql ){

			//カウント
			$sql = "SELECT count(DISTINCT P.ID) AS co";
			$sql .=  " FROM ((((((((((($wpdb->posts AS P";
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";		//種別

			//価格
			if($kal_data > 0 || $kah_data > 0 || $bukken_sort_data == "kakaku" ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id) ";	//価格
			}else{
				$sql .=  " )";	
			}

			//歩分
			if($hof_data > 0){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id)";		//歩分
			}else{
				$sql .=  " )";	
			}

			//面積
			if($mel_data > 0 || $meh_data > 0 || $bukken_sort_data == "tatemonomenseki" ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_3 ON P.ID = PM_3.post_id)";		//面積
			}else{
				$sql .=  " )";	
			}


			//築年数
			if($tik_data > 0 || $bukken_sort_data == "tatemonochikunenn" ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_4 ON P.ID = PM_4.post_id)";		//築年数
			}else{
				$sql .=  " )";	
			}

			//設備
			if(!empty($set_id)) {
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_5 ON P.ID = PM_5.post_id)";		//設備
			}else{
				$sql .=  " )";	
			}

			//間取
			if(!empty($madori_id) || $bukken_sort_data == "madorisu" ) {
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_6 ON P.ID = PM_6.post_id)";		//間取
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_7 ON P.ID = PM_7.post_id)";		//間取
			}else{
				$sql .=  ") )";	
			}

			//所在地
			if( $bukken_sort_data == "shozaichicode" ) {
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_10 ON P.ID = PM_10.post_id)";	//所在地
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_11 ON P.ID = PM_11.post_id)";	//所在地2
			}else{
				$sql .=  "))";	
			}

			//歩分+駅
			if($hof_data > 0  && $eki_id !='' && $eki_id > 0  ){
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_13 ON P.ID = PM_13.post_id) ";
			}else{
				$sql .=  " )";
			}

			/*
			 * 物件ソート追加用 SQL 条件検索用 INNER
			 *
			 * @since Fudousan Plugin 1.7.8
			 * For inc-archive-fudo.php
			 * apply_filters( 'bukken_sort_sql_inner', $sql2, $bukken_sort_data );
			 * @param  str $sql.
			 * @return str $sql.
			*/
			$sql = apply_filters( 'bukken_sort_sql_inner', $sql, $bukken_sort_data );


			$sql .=  " WHERE ( ";
			$sql .=  " P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo' ";

			//地域・路線駅
			if($meta_dat != ''){
				$sql .=  " AND P.ID IN (".$meta_dat.") ";
			}

			$sql .=  " AND PM.meta_key='bukkenshubetsu' AND CAST(PM.meta_value AS SIGNED)".$shu_data."";	//種別

			//価格
			if($kal_data > 0 || $kah_data > 0 || $bukken_sort_data == "kakaku" ){
				$sql .=  " AND PM_1.meta_key='kakaku' ";
				if( $kal_data > 0 )
					$sql .=  " AND CAST(PM_1.meta_value AS SIGNED) >= $kal_data ";
				if( $kah_data > 0 )
					$sql .=  " AND CAST(PM_1.meta_value AS SIGNED) <= $kah_data ";
			}


			//歩分
			if( $hof_data > 0 ){
				//歩分+駅
				if(  $eki_id !='' && $eki_id > 0  ){

					$sql .=  " AND ( ";

					$sql .=  " ( PM_13.meta_key='koutsueki1' AND PM_13.meta_value='".$eki_id."'";
					$sql .=  " AND PM_2.meta_key='koutsutoho1f' ";
					$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) > 0 AND CAST(PM_2.meta_value AS SIGNED) <= $hof_data )";

					$sql .=  " OR ( PM_13.meta_key='koutsueki2' AND PM_13.meta_value='".$eki_id."'";
					$sql .=  " AND PM_2.meta_key='koutsutoho2f' ";
					$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) > 0 AND CAST(PM_2.meta_value AS SIGNED) <= $hof_data )";

					$sql .=  " ) ";

				}else{
					$sql .=  " AND (PM_2.meta_key='koutsutoho1f' OR PM_2.meta_key='koutsutoho2f' )";
					$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) > 0 ";
					$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) <= $hof_data ";
				}

			}


			//面積
			if($mel_data > 0 || $meh_data > 0 || $bukken_sort_data == "tatemonomenseki" ){

				//tatemonomenseki or tochikukaku
				if( ($bukken_shubetsu > 1100 && $bukken_shubetsu < 1300) || $bukken_shubetsu == 3212 || $shu_data == '< 3000'  ){
						$sql .=  " AND  ( PM_3.meta_key='tochikukaku' OR PM_3.meta_key='tatemonomenseki' )";
				//		$sql .=  " AND  PM_3.meta_key='tochikukaku' ";
				}else{
					if( $is_tochi || $shu_data == '< 3000' ){
						$sql .=  " AND  ( PM_3.meta_key='tochikukaku' OR PM_3.meta_key='tatemonomenseki' )";
					}else{
						$sql .=  " AND  PM_3.meta_key='tatemonomenseki' ";
					}
				}


				if( $mel_data > 0 )
					$sql .=  " AND CAST(PM_3.meta_value AS SIGNED) >= $mel_data ";
				if( $meh_data > 0 )
					$sql .=  " AND CAST(PM_3.meta_value AS SIGNED) <= $meh_data ";
				//$sql .=  " AND PM_3.meta_value !='' ";
				$sql .=  " AND PM_3.meta_value > 0 ";

			}


			//築年数
			if($tik_data > 0 || $bukken_sort_data== "tatemonochikunenn" ){
				$sql .=  " AND PM_4.meta_key='tatemonochikunenn' ";
				if( $tik_data > 0 )
				//	$sql .=  " AND ( CAST(LEFT(PM_4.meta_value,4) AS SIGNED)  *100 + CAST(RIGHT(PM_4.meta_value,2) AS SIGNED) ) >= ($nowym- $tik_data * 100) ";
					$sql .=  " AND ( CAST(LEFT(PM_4.meta_value,4) AS SIGNED)  *100 + CASE WHEN LENGTH(PM_4.meta_value)>5 THEN CAST(RIGHT(PM_4.meta_value,2) AS SIGNED) ELSE 0 END ) >= ($nowym- $tik_data * 100) ";
			}


			//設備
			if(!empty($set_id)) {
				$sql .=  " AND (PM_5.meta_key='setsubi' AND ( ";
				$i=0;
				foreach($set_id as $meta_box){
				//	if($i!=0) $sql .= " OR ";
					if($i!=0) $sql .= " AND ";
					$sql .= " PM_5.meta_value LIKE '%".$set_id[$i]."%'";
					$i++;
				}
				$sql .=  " ))";
			}

			//間取
			if(!empty($madori_id)) {
				$sql .=  " AND ( ";
				$i=0;
				foreach( $madori_id as $meta_box ){
					$madorisu_data = $madori_id[$i];

					//2桁対策
					$madorisu_count = mb_strlen( $madorisu_data, 'utf-8');
					if($i!=0) $sql .= " OR ";
					$sql .= " (PM_6.meta_key='madorisu' AND PM_6.meta_value ='". myLeft( $madorisu_data, $madorisu_count-2 ) ."' ";
					$sql .= " AND PM_7.meta_key='madorisyurui' AND PM_7.meta_value ='".myRight( $madorisu_data, 2 )."')";
					$i++;
				}
				$sql .=  " ) ";
			}else{
				if( $bukken_sort_data== "madorisu" ){
					$sql .= " AND PM_6.meta_key='madorisu'";
					$sql .= " AND PM_7.meta_key='madorisyurui'";
				}
			}

			if( $bukken_sort_data== "shozaichicode" ) {
				$sql .=  " AND PM_10.meta_key='shozaichicode'";
				$sql .=  " AND PM_11.meta_key='shozaichimeisho'";
			}


			/*
			 * 物件ソート追加用 SQL 条件検索用 WHERE
			 *
			 * @since Fudousan Plugin 1.7.8
			 * For inc-archive-fudo.php
			 * apply_filters( 'bukken_sort_sql_where', $sql2, $bukken_sort_data );
			 * @param  str $sql.
			 * @return str $sql.
			*/
			$sql = apply_filters( 'bukken_sort_sql_where', $sql, $bukken_sort_data );

			$sql .=  " ) ";


			$sql2 = str_replace("SELECT count(DISTINCT P.ID) AS co","SELECT DISTINCT P.ID AS object_id",$sql);

			//ソート
			if( $bukken_sort_data2 == "post_modified" ||  $bukken_sort_data2 == "post_date" ){
				//更新日順・登録日順
				$sql2 .=  " ORDER BY P." . $bukken_sort_data2 . " " . $bukken_order_data2;
			}else{

				//価格
				if($bukken_sort_data == "kakaku"){
					$sql2 .=  " ORDER BY CAST(PM_1.meta_value AS SIGNED) ".$bukken_order_data;
				}

				//面積
				if($bukken_sort_data == "tatemonomenseki"){
					$sql2 .=  " ORDER BY CAST( (PM_3.meta_value*100) AS SIGNED ) ".$bukken_order_data;
				}

				//テキストカウント
				if($bukken_sort_data== "tatemonochikunenn"){
					$sql2 .=  " ORDER BY PM_4.meta_value ".$bukken_order_data;
				}

				//数値・数値カウント
				if($bukken_sort_data== "madorisu"){
					$sql2 .=  " ORDER BY CAST( (PM_6.meta_value*100) AS SIGNED) ".$bukken_order_data.", CAST( (PM_7.meta_value*100) AS SIGNED) ".$bukken_order_data."";
				}

				//数値・テキストカウント
				if($bukken_sort_data== "shozaichicode"){
					$sql2 .=  " ORDER BY CAST( (PM_10.meta_value*100) AS SIGNED) ".$bukken_order_data.", PM_11.meta_value ".$bukken_order_data."";
				}

				/*
				 * 物件ソート追加用 SQL 条件検索用
				 *
				 * @since Fudousan Plugin 1.7.8
				 * For inc-archive-fudo.php 
				 * apply_filters( 'bukken_sort_sql_order', $sql2, $bukken_sort_data, $bukken_order_data );
				 * @param  str $sql2.
				 * @return str $sql2.
				*/
				$sql2 = apply_filters( 'bukken_sort_sql_order', $sql2, $bukken_sort_data, $bukken_order_data );
			}

			$sql2 .=  " LIMIT ".$limit_from.",".$limit_to."";

		}else{	//$next_sql

			$sql= '';
			$sql2= '';

		}	//$next_sql

	}


/**** 検索 SQL END ****/
