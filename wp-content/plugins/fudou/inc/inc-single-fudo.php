<?php
/**
 * The Template for displaying fudou single posts.
 *
 * @package WordPress5.9
 * @subpackage Fudousan Plugin
 * Version: 5.9.1
 */


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
 * 先物
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_koukaijisha_print($post_id) {
	$koukaijisha_data = get_post_meta($post_id,'koukaijisha',true);
	if($koukaijisha_data=="0")  echo '先物';
	if($koukaijisha_data=="1")  echo '自社物';
}

/**
 * 状態
 *
 * @since Fudousan Plugin 1.0.0
  *
 * @param int $post_id Post ID.
 */
function my_custom_jyoutai_print($post_id) {
	$bukkenshubetsu_data = get_post_meta($post_id,'bukkenshubetsu',true);
	$jyoutai_data = get_post_meta($post_id,'jyoutai',true);

	if($jyoutai_data=="1"){
		if( $bukkenshubetsu_data < 3000 ){
			echo '売出中';
		}else{
			echo '空有';
		}
	}
	if($jyoutai_data=="3"){ 
		if( $bukkenshubetsu_data < 3000 ){
			echo '売止';
		}else{
			echo '空無';
		}
	}
	if($jyoutai_data=="4")  echo '成約';
	if($jyoutai_data=="9")  echo '削除';
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
 * @since Fudousan Plugin 1.5.0
 *
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
		if(!empty($metas)) echo $metas->narrow_area_name;
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
	if(get_post_meta($post_id,'tatemonoshinchiku',true)=="0") echo '中古';
	if(get_post_meta($post_id,'tatemonoshinchiku',true)=="1") echo '新築・未入居';
	//text
	if( get_post_meta($post_id,'tatemonoshinchiku',true) !='' && !is_numeric(get_post_meta($post_id,'tatemonoshinchiku',true)) ) echo get_post_meta($post_id,'tatemonoshinchiku',true);
}

/**
 * 管理人
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_kanrininn_print($post_id) {
	if(get_post_meta($post_id,'kanrininn',true)=="1")	echo '管理人常駐　';
	if(get_post_meta($post_id,'kanrininn',true)=="2")	echo '管理人日勤　';
	if(get_post_meta($post_id,'kanrininn',true)=="3")	echo '管理人巡回　';
	if(get_post_meta($post_id,'kanrininn',true)=="4")	echo '管理人無　';
	if(get_post_meta($post_id,'kanrininn',true)=="5")	echo '管理人非常駐　';
	//text
	if( get_post_meta($post_id,'kanrininn',true) !='' && !is_numeric(get_post_meta($post_id,'kanrininn',true)) ) echo get_post_meta($post_id,'kanrininn',true);
}

/**
 * 管理形態人
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_kanrikeitai_print($post_id) {
	if(get_post_meta($post_id,'kanrikeitai',true)=="1")	echo '自主管理　';
	if(get_post_meta($post_id,'kanrikeitai',true)=="2")	echo '一部委託　';
	if(get_post_meta($post_id,'kanrikeitai',true)=="3")	echo '全部委託　';
	//text
	if( get_post_meta($post_id,'kanrikeitai',true) !='' && !is_numeric(get_post_meta($post_id,'kanrikeitai',true)) ) echo get_post_meta($post_id,'kanrikeitai',true);
}

/**
 * 管理管理組合
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_kanrikumiai_print($post_id) {
	if(get_post_meta($post_id,'kanrikumiai',true)=="1")	echo '管理組合無';
	if(get_post_meta($post_id,'kanrikumiai',true)=="2")	echo '管理組合有';
	//text
	if( get_post_meta($post_id,'kanrikumiai',true) !='' && !is_numeric(get_post_meta($post_id,'kanrikumiai',true)) ) echo get_post_meta($post_id,'kanrikumiai',true);
}

/**
 * 部屋向き
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_heyamuki_print($post_id) {
	if(get_post_meta($post_id,'heyamuki',true)=="1") 	echo '北';
	if(get_post_meta($post_id,'heyamuki',true)=="2") 	echo '北東';
	if(get_post_meta($post_id,'heyamuki',true)=="3") 	echo '東';
	if(get_post_meta($post_id,'heyamuki',true)=="4") 	echo '南東';
	if(get_post_meta($post_id,'heyamuki',true)=="5") 	echo '南';
	if(get_post_meta($post_id,'heyamuki',true)=="6") 	echo '南西';
	if(get_post_meta($post_id,'heyamuki',true)=="7") 	echo '西';
	if(get_post_meta($post_id,'heyamuki',true)=="8") 	echo '北西';
	//text
	if( get_post_meta($post_id,'heyamuki',true) !='' && !is_numeric(get_post_meta($post_id,'heyamuki',true)) ) echo get_post_meta($post_id,'heyamuki',true);
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
 * 間取種類
 *
 * @since Fudousan Plugin 1.7.6
 *
 * @param int $post_id Post ID.
 */
function my_custom_madorinaiyo_print($post_id) {

	global $work_madorinaiyo;
	$tmp_dat = '';
	$tmp_dat2 = '';

	foreach($work_madorinaiyo as $meta_box) {

		$madorinaiyo_data = get_post_meta($post_id, $meta_box['name'], true);

		if('select'==$meta_box['type']){
			if($madorinaiyo_data=="1")   $tmp_dat2 .= '和室';
			if($madorinaiyo_data=="2")   $tmp_dat2 .= '洋室';
			if($madorinaiyo_data=="3")   $tmp_dat2 .= 'DK';
			if($madorinaiyo_data=="4")   $tmp_dat2 .= 'LDK';
			if($madorinaiyo_data=="5")   $tmp_dat2 .= 'L';
			if($madorinaiyo_data=="6")   $tmp_dat2 .= 'D';
			if($madorinaiyo_data=="7")   $tmp_dat2 .= 'K';
			if($madorinaiyo_data=="9")   $tmp_dat2 .= 'その他';
			if($madorinaiyo_data=="21")  $tmp_dat2 .= 'LK';
			if($madorinaiyo_data=="22")  $tmp_dat2 .= 'LD';
			if($madorinaiyo_data=="23")  $tmp_dat2 .= 'S';

		}else{
			if( $madorinaiyo_data != "" ){
				if( $meta_box['description'] == '<hr />' ){
					$tmp_dat2 .= '' . $madorinaiyo_data . '室';
				}else{
					$tmp_dat2 .= '' . $madorinaiyo_data . '' . $meta_box['description'] .'';
				}
			}

			if( $tmp_dat2 && $meta_box['description'] == '<hr />' ){
				$tmp_dat .= $tmp_dat2 . '　　';
				$tmp_dat2 = '';
			}
		}
	}
	echo $tmp_dat;

}

/**
 * URL
 *
 * @since Fudousan Plugin 5.0.2
 *  *
 * @param int $post_id Post ID.
 */
function my_custom_targeturl_print($post_id) {
	$targeturl_data = get_post_meta($post_id,'targeturl',true);
	if($targeturl_data !=''){
		if(myLeft($targeturl_data,1)=="0"){
			$targeturl_data = myRight($targeturl_data,mb_strlen($targeturl_data)-3);
		}
		echo '<a href="'.$targeturl_data.'" target="_blank"  rel="noopener noreferrer nofollow">'.$targeturl_data.'</a>';
	}
}

/**
 * 賃料・価格
 *
 * @since Fudousan Plugin 5.7.1
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
 * @since Fudousan Plugin 1.7.12
 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakureikin_print($post_id) {
	$kakakureikin_data = get_post_meta($post_id,'kakakureikin',true);
		if( $kakakureikin_data == '0' ) {
			//	echo "0";
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
 * @since Fudousan Plugin 1.7.12
 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakushikikin_print($post_id) {
	$kakakushikikin_data = get_post_meta($post_id,'kakakushikikin',true);
		if( $kakakushikikin_data == '0' ) {
			//	echo "0";
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
 * @since Fudousan Plugin 1.7.12
 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakuhoshoukin_print($post_id) {
	$kakakuhoshoukin_data = get_post_meta($post_id,'kakakuhoshoukin',true);
		if( $kakakuhoshoukin_data == '0' ) {
			//	echo "0";
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
 * @since Fudousan Plugin 1.7.12
 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakukenrikin_print($post_id) {
	$kakakukenrikin_data = get_post_meta($post_id,'kakakukenrikin',true);
		if( $kakakukenrikin_data == '0' ) {
			//	echo "0";
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
 * @since Fudousan Plugin 1.7.12
 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakushikibiki_print($post_id) {
	$kakakushikibiki_data = get_post_meta($post_id,'kakakushikibiki',true);
		if( $kakakushikibiki_data == '0' ) {
			//	echo "0";
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
			//	echo "0";
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
 * 住宅保険
 *
 * @since Fudousan Plugin 5.2.5
 *
 * @param int $post_id Post ID.
 */
function my_custom_kakakuhoken_print($post_id) {
	$kakakuhoken_data = get_post_meta($post_id,'kakakuhoken',true);
	if($kakakuhoken_data == '9'){
		echo '不要　';
	}else{
		if( is_numeric($kakakuhoken_data) && $kakakuhoken_data > 100  ){
			echo apply_filters( 'fudou_number_format', $kakakuhoken_data ) . '円　';
		}else{
			if( $kakakuhoken_data == '1' ){
				echo '要　';
			}
		}
	}
}

/**
 * 借地料
 *
 * @since Fudousan Plugin 1.8.1
 *
 * @param int $post_id Post ID.
 */
function my_custom_shakuchi_print($post_id) {

	$shakuchiryo_data   = get_post_meta($post_id,'shakuchiryo',true);
	$shakuchikikan_data = get_post_meta($post_id,'shakuchikikan',true);
	$shakuchikubun_data = get_post_meta($post_id,'shakuchikubun',true);

	if( $shakuchiryo_data ){
			echo " 借地料 ".floatval($shakuchiryo_data)/10000;
			echo '万円';
	}

	if( is_numeric($shakuchikubun_data )){
		if( $shakuchikubun_data == '1' ) {
			echo " 借地期限 ". $shakuchikikan_data;
		}elseif( $shakuchikubun_data =='2' ){
			echo " 借地期間 ". $shakuchikikan_data;
		}
	}
}

/**
 * 駐車場
 *
 * @since Fudousan Plugin 5.0.2
 *
 * @param int $post_id Post ID.
 */
function my_custom_chushajo_print($post_id) {

	//駐車料金
	if( get_post_meta( $post_id,'chushajoryokin',true ) ){
		echo apply_filters( 'fudou_number_format', get_post_meta( $post_id,'chushajoryokin',true ) ) . '円　';
	}

	//駐車場有無
	$chushajokubun_data = get_post_meta( $post_id,'chushajokubun',true );
	if($chushajokubun_data=="0")	echo '';
	if($chushajokubun_data=="1")	echo '空有';
	if($chushajokubun_data=="2")	echo '空無';
	if($chushajokubun_data=="3")	echo '近隣';
	if($chushajokubun_data=="4")	echo '無';
	//text
	if( $chushajokubun_data !='' && !is_numeric($chushajokubun_data) ){
		echo $chushajokubun_data;
	}

	//駐車場備考
	if( get_post_meta( $post_id,'chushajobiko',true ) ){
		echo '　'.get_post_meta($post_id,'chushajobiko',true);
	}
}

/**
 * 現況
 *
 * @since Fudousan Plugin 5.9.1
 *
 * @param int $post_id Post ID.
 */
function my_custom_nyukyogenkyo_print($post_id) {

	$bukkenshubetsu_data = intval(get_post_meta($post_id,'bukkenshubetsu',true));
	$nyukyogenkyo_data = get_post_meta($post_id,'nyukyogenkyo',true);

	if ( ( $bukkenshubetsu_data < 1200 && $bukkenshubetsu_data > 1000 ) || $bukkenshubetsu_data == 3212  ) {
		if($nyukyogenkyo_data=="1")	echo '更地';
		if($nyukyogenkyo_data=="2")	echo '古屋あり';
		if($nyukyogenkyo_data=="10")	echo '古屋あり(更地引渡可)';
		if($nyukyogenkyo_data=="3")	echo '賃貸中';
	}else{
		if($nyukyogenkyo_data=="1")	echo '居住中';
		if($nyukyogenkyo_data=="2")	echo '空家';
		if($nyukyogenkyo_data=="3")	echo '賃貸中';
		if($nyukyogenkyo_data=="4")	echo '未完成';
	}
	//text
	if( $nyukyogenkyo_data !='' && !is_numeric($nyukyogenkyo_data) ) echo $nyukyogenkyo_data;
}

/**
 * 引渡/入居時期
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_nyukyojiki_print($post_id) {
	$nyukyojiki_data = get_post_meta($post_id,'nyukyojiki',true);
	if($nyukyojiki_data=="1")	echo '即時 ';
	if($nyukyojiki_data=="2")	echo '相談 ';
	if($nyukyojiki_data=="3")	echo '期日指定 ';
	//text
	if( $nyukyojiki_data !='' && !is_numeric($nyukyojiki_data) ) echo $nyukyojiki_data.' ';

}

/**
 * 引渡/入居旬
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_nyukyosyun_print($post_id) {
	$nyukyosyun_data = get_post_meta($post_id,'nyukyosyun',true);
	if($nyukyosyun_data=="1")	echo '上旬';
	if($nyukyosyun_data=="2")	echo '中旬';
	if($nyukyosyun_data=="3")	echo '下旬';
	//text
	if( $nyukyosyun_data !='' && !is_numeric($nyukyosyun_data) ) echo $nyukyosyun_data.'';
}

/**
 * 取引態様
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_torihikitaiyo_print($post_id) {
	$torihikitaiyo_data = get_post_meta($post_id,'torihikitaiyo',true);

	if( get_post_meta($post_id,'bukkenshubetsu',true) < 3000 ) {
		if($torihikitaiyo_data=="1")	echo '売主';
	}else{
		if($torihikitaiyo_data=="1")	echo '貸主';
	}

	if($torihikitaiyo_data=="2")	echo '代理';
	if($torihikitaiyo_data=="3")	echo '専属';
	if($torihikitaiyo_data=="4")	echo '専任';
	if($torihikitaiyo_data=="5")	echo '一般';
	if($torihikitaiyo_data=="6")	echo '仲介';
	if($torihikitaiyo_data=="9")	echo 'その他';
	//text
	if( $torihikitaiyo_data !='' && !is_numeric($torihikitaiyo_data) ) echo $torihikitaiyo_data.'';
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
 * 用途地域
 *
 * @since Fudousan Plugin 5.5.0
 *
 * @param int $post_id Post ID.
 */
function my_custom_tochiyouto_print($post_id) {
	$tochiyouto_data = get_post_meta($post_id,'tochiyouto',true);
	if($tochiyouto_data=="1")	echo '第一種低層住居専用';
	if($tochiyouto_data=="2")	echo '第二種中高層住居専用';
	if($tochiyouto_data=="3")	echo '第二種住居';
	if($tochiyouto_data=="4")	echo '近隣商業';
	if($tochiyouto_data=="5")	echo '商業';
	if($tochiyouto_data=="6")	echo '準工業';
	if($tochiyouto_data=="7")	echo '工業';
	if($tochiyouto_data=="8")	echo '工業専用';
	if($tochiyouto_data=="10")	echo '第二種低層住居専用';
	if($tochiyouto_data=="11")	echo '第一種中高層住居専用';
	if($tochiyouto_data=="12")	echo '第一種住居';
	if($tochiyouto_data=="13")	echo '準住居';
	if($tochiyouto_data=="99")	echo '無指定';
	//text
	if( $tochiyouto_data !='' && !is_numeric($tochiyouto_data) ) echo $tochiyouto_data.'';
}

/**
 * 都市計画
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochikeikaku_print($post_id) {
	$tochikeikaku_data = get_post_meta($post_id,'tochikeikaku',true);
	if($tochikeikaku_data=="1")	echo '市街化区域';
	if($tochikeikaku_data=="2")	echo '市街化調整区域';
	if($tochikeikaku_data=="3")	echo '非線引き区域';
	if($tochikeikaku_data=="4")	echo '都市計画区域外';
	//text
	if( $tochikeikaku_data !='' && !is_numeric($tochikeikaku_data) ) echo $tochikeikaku_data.'';
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
 * 土地面積計測方式
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochisokutei_print($post_id) {
	$tochisokutei_data = get_post_meta($post_id,'tochisokutei',true);
	if($tochisokutei_data=="1")	echo '公簿';
	if($tochisokutei_data=="2")	echo '実測';
	//text
	if( $tochisokutei_data !='' && !is_numeric($tochisokutei_data) ) echo $tochisokutei_data.'';
}

/**
 * セットバック
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochisetback_print($post_id) {
	$tochisetback_data = get_post_meta($post_id,'tochisetback',true);
	if($tochisetback_data=="1")	echo '無';
	if($tochisetback_data=="2")	echo '有';
	//text
	if( $tochisetback_data !='' && !is_numeric($tochisetback_data) ) echo $tochisetback_data.'';
}

/**
 * 接道状況
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochisetsudo_print($post_id) {
	$tochisetsudo_data = get_post_meta($post_id,'tochisetsudo',true);
	if($tochisetsudo_data=="1")	echo '一方';
	if($tochisetsudo_data=="2")	echo '角地';
	if($tochisetsudo_data=="3")	echo '三方';
	if($tochisetsudo_data=="4")	echo '四方';
	if($tochisetsudo_data=="5")	echo '二方(除角地)';
	if($tochisetsudo_data=="10")	echo '接道なし';
	//text
	if( $tochisetsudo_data !='' && !is_numeric($tochisetsudo_data) ) echo $tochisetsudo_data.'';
}

/**
 * 接道方向1
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochisetsudohouko1_print($post_id) {
	$tochisetsudohouko1_data = get_post_meta($post_id,'tochisetsudohouko1',true);
	if($tochisetsudohouko1_data=="1")	echo '北';
	if($tochisetsudohouko1_data=="2")	echo '北東';
	if($tochisetsudohouko1_data=="3")	echo '東';
	if($tochisetsudohouko1_data=="4")	echo '南東';
	if($tochisetsudohouko1_data=="5")	echo '南';
	if($tochisetsudohouko1_data=="6")	echo '南西';
	if($tochisetsudohouko1_data=="7")	echo '西';
	if($tochisetsudohouko1_data=="8")	echo '北西';
	//text
	if( $tochisetsudohouko1_data !='' && !is_numeric($tochisetsudohouko1_data) ) echo $tochisetsudohouko1_data.'';
}

/**
 * 接道種類1
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochisetsudoshurui1_print($post_id) {
	$tochisetsudoshurui1_data = get_post_meta($post_id,'tochisetsudoshurui1',true);
	if($tochisetsudoshurui1_data=="1")	echo '公道';
	if($tochisetsudoshurui1_data=="2")	echo '私道';
	//text
	if( $tochisetsudoshurui1_data !='' && !is_numeric($tochisetsudoshurui1_data) ) echo $tochisetsudoshurui1_data.'';
}

/**
 * 位置指定道路1
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochisetsudoichishitei1_print($post_id) {
	$tochisetsudoichishitei1_data = get_post_meta($post_id,'tochisetsudoichishitei1',true);
	if($tochisetsudoichishitei1_data=="1")	echo '位置指定道路';
	//text
	if( $tochisetsudoichishitei1_data !='' && !is_numeric($tochisetsudoichishitei1_data) ) echo $tochisetsudoichishitei1_data .'';
}

/**
 * 接道方向2
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochisetsudohouko2_print($post_id) {
	$tochisetsudohouko2_data = get_post_meta($post_id,'tochisetsudohouko2',true);
	if($tochisetsudohouko2_data=="1")	echo '北';
	if($tochisetsudohouko2_data=="2")	echo '北東';
	if($tochisetsudohouko2_data=="3")	echo '東';
	if($tochisetsudohouko2_data=="4")	echo '南東';
	if($tochisetsudohouko2_data=="5")	echo '南';
	if($tochisetsudohouko2_data=="6")	echo '南西';
	if($tochisetsudohouko2_data=="7")	echo '西';
	if($tochisetsudohouko2_data=="8")	echo '北西';
	//text
	if( $tochisetsudohouko2_data !='' && !is_numeric($tochisetsudohouko2_data) ) echo $tochisetsudohouko2_data.'';
}

/**
 * 接道種類2
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochisetsudoshurui2_print($post_id) {
	$tochisetsudoshurui2_data = get_post_meta($post_id,'tochisetsudoshurui2',true);
	if($tochisetsudoshurui2_data=="1")	echo '公道';
	if($tochisetsudoshurui2_data=="2")	echo '私道';
	//text
	if( $tochisetsudoshurui2_data !='' && !is_numeric($tochisetsudoshurui2_data) ) echo $tochisetsudoshurui2_data.'';
}

/**
 * 位置指定道路2
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochisetsudoichishitei2_print($post_id) {
	$tochisetsudoichishitei2_data = get_post_meta($post_id,'tochisetsudoichishitei2',true);
	if($tochisetsudoichishitei2_data=="1")	echo '位置指定道路';
	//text
	if( $tochisetsudoichishitei2_data !='' && !is_numeric($tochisetsudoichishitei2_data) ) echo $tochisetsudoichishitei2_data .'';
}

/**
 * 土地権利(借地権種類)
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochikenri_print($post_id) {
	$tochikenri_data = get_post_meta($post_id,'tochikenri',true);
	if($tochikenri_data=="1")	echo '所有権';
	if($tochikenri_data=="2")	echo '旧法地上';
	if($tochikenri_data=="3")	echo '旧法賃借';
	if($tochikenri_data=="4")	echo '普通地上';
	if($tochikenri_data=="5")	echo '定期地上';
	if($tochikenri_data=="6")	echo '普通賃借';
	if($tochikenri_data=="7")	echo '定期賃借';
	if($tochikenri_data=="8")	echo '一時使用';
	if($tochikenri_data=="21")	echo '地上権';
	if($tochikenri_data=="22")	echo '定期借地';
	if($tochikenri_data=="23")	echo '賃借権';
	if($tochikenri_data=="99")	echo 'その他';
	//text
	if( $tochikenri_data !='' && !is_numeric($tochikenri_data) ) echo $tochikenri_data.'';
}

/**
 * 国土法届出
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function my_custom_tochikokudohou_print($post_id) {
	$tochikokudohou_data = get_post_meta($post_id,'tochikokudohou',true);
	if($tochikokudohou_data=="1")	echo '要';
	if($tochikokudohou_data=="2")	echo '届出中';
	if($tochikokudohou_data=="3")	echo '不要';
	//text
	if( $tochikokudohou_data !='' && !is_numeric($tochikokudohou_data) ) echo $tochikokudohou_data.'';
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
 * 物件画像タイプ
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int|string $imgtype.
 * @return text
 */
function my_custom_fudoimgtype_print( $imgtype ) {

	switch ( $imgtype ) {
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


/**
 * 駅 map用
 *
 * @since Fudousan Plugin 1.9.3
 *
 * @param int $post_id Post ID.
 * @param str $latlng lat or ing.
 */
function my_custom_shozaichi_eki_map( $post_id, $latlng = '' ) {

	global $wpdb;

	$value = '';
	$geo_txt = '';
	$shozaichiken_data = get_post_meta( $post_id, 'shozaichicode', true );
	$shozaichiken_data = myLeft( $shozaichiken_data, 2 );

	if( !$shozaichiken_data ){
		$shozaichiken_data = get_post_meta( $post_id, 'shozaichiken', true );
	}

	$koutsurosen_data = get_post_meta( $post_id, 'koutsurosen1', true );
	$koutsueki_data   = get_post_meta( $post_id, 'koutsueki1', true );

	if($koutsurosen_data !="" && $koutsueki_data !=""){
		//駅
		$sql = "SELECT DTS.station_name";
		$sql = $sql . " FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
		$sql = $sql . " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
		$sql = $sql . " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
		//$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if(!empty($metas)){
			if($metas->station_name != '＊＊＊＊'){
				$value .= fudo_ken_name( $shozaichiken_data );
				if( $metas->station_name != '' ){
					$value .= '' . $metas->station_name . '駅';
				}
			}
		}
		//1.9.3
		$geo_txt = $value;

		if( $latlng ){

			//テーブルチェック
			$results1 = $wpdb->get_var( "show tables like '" . $wpdb->prefix . DB_ROSENLATLNG_TABLE . "'" ) ;

			if( $results1  ){
				$sql  = "SELECT TA.lat, TA.lng";
				$sql .= " FROM " . $wpdb->prefix . DB_ROSENLATLNG_TABLE . " AS TA ";
				$sql .= " WHERE TA.station_id=".$koutsueki_data." AND TA.rosen_id=".$koutsurosen_data."";
			//	$sql = $wpdb->prepare($sql,'');
				$meta = $wpdb->get_row( $sql );
				if(!empty($meta)){
					if( $latlng == 'lat' ){
						$value = '' . $meta->lat . ''; 
					}
					if( $latlng == 'lng' ){
						$value = '' . $meta->lng . ''; 
					}

				}else{
					$value = '';
				}
			}else{
					$value = '';
			}
		}
	}


	/*
	 * 駅名・座標用フィルター
	 *
	 * @since Fudousan Plugin 1.9.3
	 * For inc-single-fudo.php $value = apply_filters( 'fudou_shozaichi_eki_map', $value, $geo_txt, $post_id, $latlng );
	 *
	 * @param str $value.
	 * @param int $post_id.
	 * @param str $latlng. '' or 'lat' or 'lng'.
	 * @return str 駅名又は座標.
	*/
	$value = apply_filters( 'fudou_shozaichi_eki_map', $value, $geo_txt, $post_id, $latlng );

	return $value;
}

/**
 * 地図表示 GoogleMaps Places
 *
 * @since Fudousan Plugin
 * For single-fudo.php apply_filters( 'fudou_single_googlemaps', $post_id , $kaiin , $kaiin2 , $title );
 *
 * @param int $post_id Post ID.
 * @param int $kaiin.
 * @param int $kaiin2.
 * @param str $title.
 * @return text
 * ver 5.2.3
 */
function fudou_single_googlemaps( $post_id , $kaiin , $kaiin2 , $title) {

	global $wpdb;
	global $is_fudoubus,$is_fudoukouku;


	$title = esc_html( $title );

	//latlng
	$lat = get_post_meta($post_id,'bukkenido',true);
	$lng = get_post_meta($post_id,'bukkenkeido',true);

	//icon_img
	$bukkenshubetsu_data = get_post_meta($post_id,'bukkenshubetsu',true);
	$icon_url = 'gmapmark_'.$bukkenshubetsu_data.'.png';
	if($bukkenshubetsu_data == '')
		$icon_url = 'gmapmark_1399.png';
	//directions
	if( get_option('fudo_map_directions') == 'true' ){
		$fudo_map_directions = 'var  map_directions = true; ';
	}else{
		$fudo_map_directions = 'var  map_directions = false; ';
	}

	//bus directions
	if( get_option('fudo_map_bus_directions') == 'true' && $is_fudoubus ){
		$fudo_map_bus_directions = 'var  map_bus_directions = true; ';
	}else{
		$fudo_map_bus_directions = 'var  map_bus_directions = false; ';
	}


	if ( $lat && $lng ){

		/**
		 * GoogleMaps 用 jsを追加
		 *
		 * @since Fudousan Plugin 5.9.0
		 */
		function add_inc_single_fudo_js() {
			//GoogleMaps API KEY
			$googlemaps_api_key = get_option('googlemaps_api_key');

			wp_deregister_script( 'googlemapapi' );
			if( $googlemaps_api_key ){
				wp_enqueue_script( 'googlemapapi', 'https://maps.googleapis.com/maps/api/js?key=' . $googlemaps_api_key . '', array(), '', true );
			}else{
				wp_enqueue_script( 'googlemapapi', 'https://maps.googleapis.com/maps/api/js', array(), '', true );
			}

			//fudou map js
			$js_url = plugins_url( '/fudou/js/single-fudoumap.min.js' );
			wp_enqueue_script( 'single-fudo-fudoumap', $js_url, array(), '5.9.0', true );
		}
		add_action( 'wp_footer', 'add_inc_single_fudo_js' );


		//サムネイル画像
		$fudoimg_data = '';
		$fudoimg1_data = get_post_meta($post_id, 'fudoimg1', true);
		if($fudoimg1_data != '')	$fudoimg_data=$fudoimg1_data;
		$fudoimg2_data = get_post_meta($post_id, 'fudoimg2', true);
		if($fudoimg2_data != '')	$fudoimg_data=$fudoimg2_data;

		/*
		 * fudoimg_data Filter
		 *
		 * Version: 5.2.3
		 **/
		$fudoimg_data = apply_filters( 'pre_fudoimg_data', $fudoimg_data, $post_id, 'fudo_postmap', false );


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
				$j_img = '' . $fudoimg_data .'';
			}else{
				//Check attachment
				$sql  = "SELECT P.ID,P.guid";
				$sql .= " FROM $wpdb->posts AS P";
				$sql .= " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
				//$sql = $wpdb->prepare($sql,'');
				$meta = $wpdb->get_row( $sql );
				$attachmentid = '';
				if( !empty( $meta ) ){
					$attachmentid  =  $meta->ID;
				}

				/*
				 * fudoimg_data to attachmentid
				 *
				 * Version: 1.9.2
				 **/
				$attachmentid = apply_filters( 'fudoimg_data_to_attachmentid', $attachmentid, $fudoimg_data, $post_id );

				if( $attachmentid !='' ){
					//thumbnail、medium、large、full 
					$fudoimg_data1 = wp_get_attachment_image_src( $attachmentid, 'thumbnail' );
					$fudoimg_url   = $fudoimg_data1[0];

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
						$j_img = '' . $fudoimg_url.'';
					}else{
						$j_img = '' . $guid_url . '';
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
						$j_img =  ''.$fudoimg_data;
					}else{
						//$j_img =  ''.WP_PLUGIN_URL.'/fudou/img/nowprinting.jpg';
						$j_img =  ''.plugins_url().'/fudou/img/nowprinting.jpg';
					}
				}
			}

		}else{
			//$j_img =  ''.WP_PLUGIN_URL.'/fudou/img/nowprinting.jpg';
			$j_img =  ''.plugins_url().'/fudou/img/nowprinting.jpg';
		}

		?>

		<script type="text/javascript"> 
			var fudo_map_elevation;
			var lat = <?php echo $lat;?>;
			var lng = <?php echo $lng;?>;
			<?php if( get_option('fudo_map_elevation') == 'true' ){ ?>
				fudo_map_elevation = true;
			<?php } ?>

			var bukken_content = '<table class="gmapballoon"><tr>'
					+ '<td rowspan="3"><img class="gmap_img" src="<?php echo $j_img;?>" alt=""></td>'
					+ '</tr>'
					+ '<tr>'
					+ '<td class="gmapkakaku" nowrap="nowrap"><?php my_custom_kakaku_print($post_id); ?></td>'
					+ '<td class="gmapmadori" nowrap="nowrap"><?php my_custom_madorisu_print($post_id); ?> </td>'
					+ '</tr>'
					+ '<tr>'
					+ '<td colspan="2">'
					+ '<span class="gmaptitle"><?php if ( !my_custom_kaiin_view('kaiin_title',$kaiin,$kaiin2) ){echo "　会員物件";}else{echo $title;} ?></span><br />'
					+ '<?php my_custom_shozaichi_print($post_id); ?><?php echo esc_html( get_post_meta($post_id, 'shozaichimeisho', true) ); ?><br />'
					+ '<?php my_custom_koutsu1_print($post_id); ?>';
				//	+ '</td></tr></table>';		//js側で追加

			<?php echo $fudo_map_directions;?>
			<?php echo $fudo_map_bus_directions;?>

			//directions
			var map_directionsFrom = "<?php echo my_custom_shozaichi_eki_map( $post_id, '' ); ?>";
			var map_directionsFrom_lat = "<?php echo my_custom_shozaichi_eki_map( $post_id, 'lat' ); ?>";
			var map_directionsFrom_lng = "<?php echo my_custom_shozaichi_eki_map( $post_id, 'lng' ); ?>";


			<?php
			/**
			 * バス停座標 map用 DirectionsService
			 *
			 * @since Fudousan Bus Plugin 1.0.0
			 * For inc-single-fudo.php apply_filters( 'fudoubus_busstop_lat_lng_single', '', $post_id );
			 * @param int $post_id Post ID.
			 * @return str $value.
			 */
			 echo apply_filters( 'fudoubus_busstop_lat_lng_single', '', $post_id );
			 ?>

			//marker 5.2.0
			var gmapmark    = '<?php echo plugins_url();?>/fudou/img/<?php echo $icon_url;?>';
			var gmapmark_b0 = '<?php echo plugins_url();?>/fudou/img/bus_r.png';
			var gmapmark_b1 = '<?php echo plugins_url();?>/fudou/img/bus_o.png';
			var gmapmark_b2 = '<?php echo plugins_url();?>/fudou/img/bus_b.png';
			var gmapmark_gs1 = '<?php echo plugins_url();?>/fudoukouku/img/gmapmark_pschool1.png';
			var gmapmark_gc1 = '<?php echo plugins_url();?>/fudoukouku/img/gmapmark_jhschool1.png';
			var gmapmark_gs2 = '<?php echo plugins_url();?>/fudoukouku/img/gmapmark_pschool2.png';
			var gmapmark_gc2 = '<?php echo plugins_url();?>/fudoukouku/img/gmapmark_jhschool2.png';

			<?php
			/*
			 * Map用 バス停マーカー
			 *
			 * @since Fudousan Bus Plugin 1.0.0
			 * For single-fudo.php apply_filters( 'fudoubus_mapicon_single', '', $post_id, 1 );
			 *
			 * @param int $post_id Post ID.
			 * @param int $type 1 or 2.
			 * @return str $bus_marker.
			*/
			 ?>
			var busmark1 = [<?php echo apply_filters( 'fudoubus_mapicon_single', '', $post_id, 1 );?>];
			var busmark2 = [<?php echo apply_filters( 'fudoubus_mapicon_single', '', $post_id, 2 );?>];

			<?php
			/*
			 * 校区学校マーカー
			 *
			 * @since Fudousan kouku Plugin 1.0.0
			 * For single-fudo.php apply_filters( 'fudoukouku_gakkouicon_single', '', $post_id, 1 );
			 *
			 * @param int $post_id Post ID.
			 * @param int $type 1 or 2.
			 * @return str $gakko_marker.
			*/
			 ?>
			var gakkoumark1 = [<?php echo apply_filters( 'fudoukouku_gakkouicon_single', '', $post_id, 1 );?>];
			var gakkoumark2 = [<?php echo apply_filters( 'fudoukouku_gakkouicon_single', '', $post_id, 2 );?>];


			<?php 
			/*
			 * オリジナルマーカー
			 *
			 * @since Fudousan Plugin 1.7.0
			 *
			 * @param int $post_id Post ID.
			 * @return str ( javascript code ).
			*/
			do_action( 'fudou_org_lat_lng_single', $post_id, $lat, $lng );
			?>

		</script>

		<div class="map_canvas" id="map_canvas" style="border:1px solid #979797; background-color:#e5e3df; width:100%; height:400px; z-index:1">
			<div style="padding:1em; color:gray;">Loading...</div>
		</div>

		<div class="map_comment">
			<?php echo get_option('fudo_map_comment'); ?>
		</div>
	<?php 
	}
}
add_filter( 'fudou_single_googlemaps', 'fudou_single_googlemaps', 10, 4 );
