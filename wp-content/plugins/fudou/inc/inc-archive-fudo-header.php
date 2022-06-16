<?php
/**
 * The Template for displaying fudou archive posts header.
 *
 * @package WordPress5.9
 * @subpackage Fudousan Plugin
 * Version: 5.9.1
 */


	//カウント
		$metas_co = 0;
		if($sql !=''){
			//$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_row( $sql );
			if( !empty( $metas ) ){
				$metas_co = $metas->co;
			}
		}else{
			$metas_co = 0;
		}



	//ソート・ページナビ ver1.9.6
		$page_navigation = '';

		//条件検索URL
		if($bukken_slug_data=="jsearch"){

			//url生成

			//間取り
			$madori_url = '';
			if(!empty($madori_id)) {
				$i=0;
				foreach($madori_id as $meta_box){
					$madori_url .= '&amp;mad%5B%5D='.$madori_id[$i];
					$i++;
				}
			}

			//設備条件
			$setsubi_url = '';
			if(!empty($set_id)) {
				$i=0;
				foreach($set_id as $meta_box){
					$setsubi_url .= '&amp;set%5B%5D='.$set_id[$i];
					$i++;
				}
			}

			$add_url  = '';

			//複数種別
			if( $shub !='' ) $add_url  .= '&amp;shub='.$shub;

			if (is_array($bukken_shubetsu)) {
				$i=0;
				foreach($bukken_shubetsu as $meta_set){
					$add_url  .= '&amp;shu%5B%5D='.$bukken_shubetsu[$i];
					$i++;
				}

			} else {
				$add_url  .= '&amp;shu='.$bukken_shubetsu;
			} 


			$add_url .= '&amp;ros='. $ros_id;
			$add_url .= '&amp;eki='. $eki_id;
			$add_url .= apply_filters( 'fudoubus_add_url_archive', '' );

			if($ken_id == '00') $ken_id = '0';
			$add_url .= '&amp;ken='. $ken_id;
			$add_url .= '&amp;sik='. $sik_id;
			$add_url .= '&amp;kalc='.$kalc_data;
			$add_url .= '&amp;kahc='.$kahc_data;
			$add_url .= '&amp;kalb='.$kalb_data;
			$add_url .= '&amp;kahb='.$kahb_data;
			$add_url .= '&amp;hof='. $hof_data;
			$add_url .= $madori_url;
			$add_url .= '&amp;tik='. $tik_data;
			$add_url .= '&amp;mel='. $mel_data;
			$add_url .= '&amp;meh='. $meh_data;
			$add_url .= $setsubi_url;

			$joken_url  = $site .'?bukken=jsearch';


			//複数市区
			if (is_array($ksik_id)) {
				$i=0;
				foreach($ksik_id as $meta_set){
					$add_url .= '&amp;ksik%5B%5D='.$ksik_id[$i];
					$i++;
				}
			}

			//複数駅
			if(is_array( $rosen_eki )  ){
				$i=0;
				foreach($rosen_eki as $meta_set){
					$add_url .= '&amp;re%5B%5D='.$rosen_eki[$i];
					$i++;
				}
			}

			//オリジナルフィルター $joken_url ver1.9.1
			$joken_url = apply_filters( 'fudou_org_joken_url_archive', $joken_url );

			//オリジナルフィルター $add_url
			$add_url = apply_filters( 'fudou_org_add_url_archive', $add_url );

			$joken_url .= $add_url;
			if( $s != '' ){
				$s_tag = '&amp;s=' . $s;
			}else{
				$s_tag = '';
			}

			//オリジナルフィルターafter $joken_url ver5.9.0
			$joken_url = apply_filters( 'fudou_org_joken_url_archive_after', $joken_url );


		}else{
			//物件カテゴリ・物件タグ
			if( $taxonomy_name == 'bukken_tag' ){
				$joken_url = $site.'?bukken_tag='.$slug_data.'';
			}else{
				$joken_url = $site.'?bukken='.$slug_data.'';
			}

			//キーワード
			if( $s != '' ){
				$joken_url  = $site .'?s='.$s.'&bukken=search';

				if($searchtype == 'id')
					$joken_url  .= '&amp;st=id';

				if($searchtype == 'chou')
					$joken_url  .= '&amp;st=chou';
			}


			$bukken = isset( $_GET['bukken'] ) ? $_GET['bukken'] : '';
			$bukken_slug_data = esc_attr( stripslashes( $bukken ));
			$add_url  = '&amp;bk='.$bukken;

			$add_url .= '&amp;shu='.$bukken_shubetsu;

			if($mid_id=='99999')	$mid_id = "";
			$add_url .= '&amp;mid='.$mid_id;

			if($nor_id=='99999')	$nor_id = "";
			$add_url .= '&amp;nor='.$nor_id;
			$add_url .= apply_filters( 'fudoubus_add_url_archive', '' );

			//オリジナルフィルター $joken_url ver1.9.1
			$joken_url = apply_filters( 'fudou_org_joken_url_archive', $joken_url );

			//オリジナルフィルター $add_url
			$add_url = apply_filters( 'fudou_org_add_url_archive', $add_url );

			if ( $taxonomy_name == '' ){
				$joken_url .= $add_url;
			}


			//オリジナルフィルターafter $joken_url ver5.9.0
			$joken_url = apply_filters( 'fudou_org_joken_url_archive_after', $joken_url );

			$s_tag = '';

		}

		//ソートORDER 画像・ページナビ用 ver1.9.6
		global $page_navi_type;
		$page_navi_type = '1.9.6';

		/*
		 * bukken_order2 Fix
		 *
		 * inc-archive-fudo.php
		 * add_filter( 'bukken_order_reversal', 'bukken_order_reversal' )
		 * ver1.9.6
		 */
		$bukken_order2 = apply_filters( 'bukken_order_reversal', $bukken_order );

		//物件がある場合
		if( $metas_co != 0 ){

			//ソート用画像

			//価格画像
			$kak_img = '<img ' . $fudou_lazy_loading . ' alt="価格並び替え" src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort == 'kak' && $bukken_order2 =='')
				$kak_img = '<img ' . $fudou_lazy_loading . ' alt="価格並び替え" src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='kak' && $bukken_order2 =='d')
				$kak_img = '<img ' . $fudou_lazy_loading . ' alt="価格並び替え" src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';

			if($bukken_sort_data2 == "post_modified" && $bukken_sort == '')
				$kak_img = '<img ' . $fudou_lazy_loading . ' src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';

			//面積
			$tam_img = '<img ' . $fudou_lazy_loading . ' alt="面積並び替え" src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='tam' && $bukken_order2 =='')
				$tam_img = '<img ' . $fudou_lazy_loading . ' alt="面積並び替え" src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';

			if($bukken_sort=='tam' && $bukken_order2 =='d')
				$tam_img = '<img ' . $fudou_lazy_loading . ' alt="面積並び替え" src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';

			//間取り
			$mad_img = '<img ' . $fudou_lazy_loading . ' alt="間取り並び替え" src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='mad' && $bukken_order2 =='')
				$mad_img = '<img ' . $fudou_lazy_loading . ' alt="間取り並び替え" src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='mad' && $bukken_order2 =='d')
				$mad_img = '<img ' . $fudou_lazy_loading . ' alt="間取り並び替え" src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';


			//住所
			$sho_img = '<img ' . $fudou_lazy_loading . ' alt="地域並び替え" src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='sho' && $bukken_order2 =='')
				$sho_img = '<img ' . $fudou_lazy_loading . ' alt="地域並び替え" src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='sho' && $bukken_order2 =='d')
				$sho_img = '<img ' . $fudou_lazy_loading . ' alt="地域並び替え" src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';


			//築年月
			$tac_img = '<img ' . $fudou_lazy_loading . ' alt="築年月並び替え" src="'.$plugin_url.'img/sortbtms_.png" border="0" align="absmiddle">';
			if($bukken_sort=='tac' && $bukken_order2 =='')
				$tac_img = '<img ' . $fudou_lazy_loading . ' alt="築年月並び替え" src="'.$plugin_url.'img/sortbtms_asc.png" border="0" align="absmiddle">';
			if($bukken_sort=='tac' && $bukken_order2 =='d')
				$tac_img = '<img ' . $fudou_lazy_loading . ' alt="築年月並び替え" src="'.$plugin_url.'img/sortbtms_desc.png" border="0" align="absmiddle">';


			//$page_navigation = '<div id="nav-above1" class="navigation hentry">';
			$page_navigation  = '<div class="navigation hentry">';

			$page_navigation .= '<div class="nav-previous">';

			//価格
			if($bukken_sort=='kak'){
				$page_navigation .= '<b><a class="kak" href="'.$joken_url.'&amp;so=kak&amp;ord='.$bukken_order.$s_tag.'">'.$kak_img.'価格</a></b> ';
			}else{
				$page_navigation .= '<a class="kak" href="'.$joken_url.'&amp;so=kak&amp;ord='. $s_tag.'">'.$kak_img.'価格</a> ';
			}

			//面積
			if($bukken_sort=='tam'){
				$page_navigation .= '<b><a class="tam" href="'.$joken_url.'&amp;so=tam&amp;ord='.$bukken_order.$s_tag.'">'.$tam_img.'面積</a></b> ';
			}else{
				$page_navigation .= '<a class="tam" href="'.$joken_url.'&amp;so=tam&amp;ord=' . $s_tag.'">'.$tam_img.'面積</a> ';
			}

			//間取り
			if($bukken_sort=='mad'){
				$page_navigation .= '<b><a class="mad" href="'.$joken_url.'&amp;so=mad&amp;ord='.$bukken_order.$s_tag.'">'.$mad_img.'間取</a></b> ';
			}else{
				$page_navigation .= '<a class="mad" href="'.$joken_url.'&amp;so=mad&amp;ord=' . $s_tag.'">'.$mad_img.'間取</a> ';
			}

			//住所
			if($bukken_sort=='sho'){
				$page_navigation .= '<b><a class="sho" href="'.$joken_url.'&amp;so=sho&amp;ord='.$bukken_order.$s_tag.'">'.$sho_img.'住所</a></b> ';
			}else{
				$page_navigation .= '<a class="sho" href="'.$joken_url.'&amp;so=sho&amp;ord=' . $s_tag.'">'.$sho_img.'住所</a> ';
			}

			//築年月
			if($bukken_sort=='tac'){
				$page_navigation .= '<b><a class="tac" href="'.$joken_url.'&amp;so=tac&amp;ord='.$bukken_order.$s_tag.'">'.$tac_img.'築年月</a></b> ';
			}else{
				$page_navigation .= '<a class="tac" href="'.$joken_url.'&amp;so=tac&amp;ord=' . $s_tag.'">'.$tac_img.'築年月</a> ';
			}

			/*
			 * 追加 物件ソート用タグ
			 *
			 * @since Fudousan Plugin 1.7.8
			 * For archive-fudoXXXX.php apply_filters( 'fudou_archive_navigation', $page_navigation, $bukken_sort, $joken_url, $bukken_page_data, $bukken_order, $s_tag );
			*/
			$page_navigation = apply_filters( 'fudou_archive_navigation', $page_navigation, $bukken_sort, $joken_url, $bukken_page_data, $bukken_order, $s_tag );


			$page_navigation .= '</div>';	//nav-previous

			$page_navigation .= '<div class="nav-next">';

			//ver5.9.1
			$page_navigation = apply_filters( 'fudou_archive_nav_next1', $page_navigation );

			//ページナビ
			$page_navigation .= f_page_navi($metas_co,$posts_per_page,$bukken_page_data,$bukken_sort,$bukken_order2,$s,$joken_url);

			//ver5.9.1
			$page_navigation = apply_filters( 'fudou_archive_nav_next2', $page_navigation );

			$page_navigation .= '</div>';	//nav-next

			$page_navigation .= '</div>';	//navigation

		}	//物件がある場合

	// .ソート・ページナビ


		//パーマリンクチェック
		$permalink_structure = get_option('permalink_structure');
		if ( $permalink_structure != '' ) {
			$add_url_point = mb_strlen( $add_url, "utf-8" ) ;
			if( $add_url_point > 5 ){
				$add_url_point = $add_url_point - 5;
				$add_url = '?' . myRight( $add_url, $add_url_point ) ;
			}else{
				$add_url = '';
			}
		}



