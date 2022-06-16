<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress 5.5
 * @subpackage Fudousan Plugin
 * Version: 5.5.0
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', false);

/** Loads the WordPress Environment and Template */
require_once '../../../wp-blog-header.php';

//$wpdb->show_errors();


if ( current_user_can( 'edit_posts' ) ) {

	status_header( 200 );

	global $wpdb;
	global $work_gazo,$work_gazo2;
	global $is_fudoubus;
	global $is_fudoukouku;
	global $is_fudouchoumei;

	$type_id = isset($_POST['typ']) ? myIsNum_f($_POST['typ']) : '';
	$ex_id   = isset($_POST['ex'])  ? myIsNum_f($_POST['ex']) : '';
	$shu_id  = isset($_POST['shu']) ? myIsNum_f($_POST['shu']) : '';

	if($shu_id == '1') 
		$shu_data = '< 3000' ;
	if($shu_id == '2') 
		$shu_data = '> 3000' ;

	if( intval($shu_id) > 3 ) 
		$shu_data = '= ' .$shu_id ;

	$mot_data = isset($_POST['mot']) ? esc_sql(esc_attr($_POST['mot'])) : '';

	if( !empty( $shu_data ) && !empty( $type_id ) ){

		$sql = "SELECT DISTINCT P.ID";
		$sql .=  " FROM ($wpdb->posts AS P";
		$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id) ";
		if($type_id == '2'){
			$sql .=  " INNER JOIN $wpdb->postmeta AS PM_16 ON P.ID = PM_16.post_id ";
		}
		$sql .=  " WHERE P.post_type ='fudo' AND P.post_status != 'trash'";
		$sql .=  " AND PM.meta_key='bukkenshubetsu' AND PM.meta_value " . $shu_data ;
		if($type_id == '2'){
			$sql .=  " AND PM_16.meta_key='motozukemei' AND PM_16.meta_value = '$mot_data'";
		}
		//$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql,  ARRAY_A );

		$next_sql = true;
		$meta_dat = '';
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

		if( $next_sql ){

			if( intval($shu_id) < 3 ){

				$sql  =  "SELECT P.ID , P.post_date , P.post_modified , P.post_content , P.post_title , P.post_excerpt , P.post_status , P.post_password ,PM_17.meta_value";
				$sql .=  " FROM $wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_17 ON P.ID = PM_17.post_id ";
				$sql .=  " WHERE P.post_type ='fudo' AND P.ID IN ( $meta_dat )";
				$sql .=  " AND PM_17.meta_key='shikibesu'";
				$sql .=  " ORDER BY PM_17.meta_value";

			}else{

				$sql  =  "SELECT P.ID , P.post_date , P.post_modified , P.post_content , P.post_title , P.post_excerpt , P.post_status , P.post_password";
				$sql .=  " FROM $wpdb->posts AS P";
				$sql .=  " WHERE P.post_type ='fudo' AND P.ID IN ( $meta_dat )";
			}
		//	$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_results( $sql,  ARRAY_A );

			if(!empty($metas)) {

				ob_start();

				$header_filename = 'bukken' . date('Y-m-j-his') . '.xls';     
				$header_filename = 'Content-Disposition: attachment; filename="'.$header_filename.'"';
				@header("Content-Type: application/vnd.ms-excel");
				@header($header_filename);

?>
<html xmlns:o="urn:schemas-microsoft-com:office:office"
xmlns:x="urn:schemas-microsoft-com:office:excel"
xmlns="http://www.w3.org/TR/REC-html40">

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<style type="text/css">
<!--
td{
	mso-style-parent:style0;
	mso-number-format:"\@";
	font-family:"ＭＳ Ｐゴシック", monospace;
}
-->
</style>
</head>
<body>
<?php


					echo '<table border="1">';
					echo '<tr bgcolor="#cccccc">';
					echo '<td>物件番号</td>';

					echo '<td>登録日</td>';
					echo '<td>更新日</td>';
					echo '<td>ステータス</td>';

					echo '<td>掲載期限日</td>';
					echo '<td>物件種別</td>';

					echo '<td>タイトル</td>';

					echo '<td>価格</td>';
					echo '<td>間取</td>';
					echo '<td>共益費・管理費(円)</td>';
					echo '<td>敷金</td>';
					echo '<td>礼金</td>';
					echo '<td>保証金</td>';
					echo '<td>権利金</td>';
					echo '<td>償却・敷引金</td>';

					echo '<td>県</td>';
					echo '<td>市区</td>';
					echo '<td>所在地</td>';
					echo '<td>所在地2</td>';
					echo '<td>所在地3</td>';
					echo '<td>物件名</td>';

					echo '<td>路線1</td>';
					echo '<td>駅1</td>';

					echo '<td>バス停1</td>';
					echo '<td>バス分1</td>';
					echo '<td>バス停徒</td>';

					echo '<td>徒歩m1</td>';
					echo '<td>徒歩分1</td>';

					if($ex_id == '1'){
						echo '<td>路線2</td>';
						echo '<td>駅2</td>';

						echo '<td>バス停2</td>';
						echo '<td>バス分2</td>';
						echo '<td>バス停徒2</td>';

						echo '<td>徒歩m2</td>';
						echo '<td>徒歩分2</td>';
						echo '<td>その他交通</td>';
					}

					echo '<td>築年月</td>';
					echo '<td>建物面積</td>';
					echo '<td>建物面積計測方式</td>';

					echo '<td>建物階数地上</td>';
					echo '<td>建物階数地下</td>';
					echo '<td>部屋階数</td>';
					echo '<td>部屋・区画番号</td>';
					echo '<td>建物構造</td>';
					echo '<td>敷地全体面積</td>';
					echo '<td>延べ床面積</td>';
					echo '<td>住宅保険料(円)</td>';
					echo '<td>住宅保険期間(年)</td>';

					echo '<td>修繕積立金(円)</td>';
					echo '<td>駐車場料金(円)</td>';
					echo '<td>取引態様</td>';
					echo '<td>入居時期</td>';
					echo '<td>入居年月</td>';
					echo '<td>入居旬</td>';
					echo '<td>現況</td>';
					echo '<td>地目</td>';
					echo '<td>用途地域</td>';
					echo '<td>都市計画</td>';
					echo '<td>地勢</td>';
					echo '<td>区画面積</td>';
					echo '<td>建ぺい率</td>';
					echo '<td>容積率</td>';
					echo '<td>土地権利</td>';
					echo '<td>国土法届出</td>';

					echo '<td>報酬形態</td>';

					echo '<td>元付名</td>';
					echo '<td>元付TEL</td>';
					echo '<td>元付FAX</td>';
					echo '<td>社内用メモ</td>';


					if($ex_id == '1'){
						echo '<td>CSV TYPE</td>';
						echo '<td>keywords</td>';
						echo '<td>description</td>';
						echo '<td>成約日</td>';
					//	echo '<td>自社物フラグ</td>';
						echo '<td>状態</td>';
						echo '<td>物件名公開</td>';
						echo '<td>総戸数</td>';
						echo '<td>緯度</td>';
						echo '<td>経度</td>';
						echo '<td>土地面積計測方式</td>';
						echo '<td>セットバック</td>';
						echo '<td>私道負担面積</td>';
						echo '<td>セットバック量</td>';
						echo '<td>接道状況</td>';

						echo '<td>接道方向1</td>';
						echo '<td>接道間口1</td>';
						echo '<td>接道種別1</td>';
						echo '<td>接道幅員1</td>';
						echo '<td>位置指定道路1</td>';

						echo '<td>接道方向2</td>';
						echo '<td>接道間口2</td>';
						echo '<td>接道種別2</td>';
						echo '<td>接道幅員2</td>';
						echo '<td>位置指定道路2</td>';


						echo '<td>建築面積</td>';
						echo '<td>新築・未入居</td>';
						echo '<td>バルコニー面積</td>';
						echo '<td>部屋向き</td>';
						echo '<td>間取り備考</td>';
						echo '<td>備考URL</td>';

						echo '<td>管理人</td>';
						echo '<td>管理形態</td>';
						echo '<td>管理組合</td>';
						echo '<td>管理会社名</td>';

						echo '<td>価格税額</td>';
						echo '<td>価格公開</td>';
						echo '<td>価格状態</td>';
						echo '<td>坪単価</td>';
						echo '<td>満室時表面利回り</td>';
						echo '<td>現行利回り</td>';
						echo '<td>借地料</td>';
						echo '<td>借地契約年月</td>';
						echo '<td>契約期間(区分)</td>';
						echo '<td>駐車場区分</td>';
						echo '<td>駐車場備考</td>';
						echo '<td>小学校名</td>';
						echo '<td>中学校名</td>';

					// 物件画像 
						if( FUDOU_IMG_MAX > 10 ){
							$work_gazo = array_merge($work_gazo, $work_gazo2);
						}

						foreach($work_gazo as $meta_box) {
							echo '<td>'. $meta_box['title'] . '</td>';
						}

						echo '<td>設備</td>';
						echo '<td>設備その他</td>';


					// 間取り内容
						foreach($work_madorinaiyo as $meta_box) {
							echo '<td>間取'. $meta_box['title'] . '</td>';
						}

						echo '<td>備考</td>';
						echo '<td>抜粋</td>';
						echo '<td>特記事項</td>';

						echo '<td>会員公開</td>';
						echo '<td>物件カテゴリ</td>';
						echo '<td>物件タグ</td>';

						echo '<td>更新料</td>';
						echo '<td>その他周辺環境</td>';

					if( $is_fudoubus ){

						echo '<td>バス路線会社1</td>';
						echo '<td>バス路線路線1</td>';
						echo '<td>バス路線停1</td>';

						echo '<td>バス路線会社2</td>';
						echo '<td>バス路線路線2</td>';
						echo '<td>バス路線停2</td>';
					}

					if( $is_fudoukouku ){
						echo '<td>小学校区</td>';
						echo '<td>中学校区</td>';
					}

					if( $is_fudouchoumei ){
						echo '<td>町名</td>';
					}

					/*
					 * カスタムフィールド追加 タイトル ex_id
					 * ver 5.3.3
					 */
					do_action( 'admin_phpex_title_ex_id' );


				} //ex_id

					/*
					 * カスタムフィールド追加 タイトル
					 * ver 5.3.3
					 */
					do_action( 'admin_phpex_title' );


					echo '</tr>';

				$rst_co = 0;
				foreach ( $metas as $meta ) {

					$post_id = $meta['ID'];

					//esc_html() or esc_textarea() or esc_attr()
					$post_content_data = $meta['post_content'] ;
					//$post_content_data =  str_replace( '"' , '&quot;' , $post_content_data );
					$post_content_data =  str_replace( array("\r\n", "\r", "\n", "\t" ) , ""  , $post_content_data );

					$post_excerpt_data = $meta['post_excerpt'];
					//$post_excerpt_data =  str_replace( '"' , '&quot;' , $post_excerpt_data );
					$post_excerpt_data =  str_replace( array("\r\n", "\r", "\n", "\t" ) , ""  , $post_excerpt_data );


				//	if( $rst_co % 2 == 0 ){
				//	echo '<tr>';
				//	}else{
				//	echo '<tr bgcolor="#cccccc">';
				//	}
					echo '<tr>';
					$rst_co = $rst_co + 1 ;

					// 物件番号
						echo '<td>' . get_post_meta($post_id, 'shikibesu', true) . '</td>';
					// 登録日
						echo '<td>' . $meta['post_date'] . '</td>';
					// 更新日
						echo '<td>' . $meta['post_modified'] . '</td>';
					// ステータス
						echo '<td>';
						$post_status = $meta['post_status'];
						if($post_status=="publish")	echo '公開';
						if($post_status=="pending")	echo '保留';
						if($post_status=="draft")	echo '下書き';
						if($post_status=="future")	echo 'スケジュール済み';
						if($post_status=="private")	echo '非公開';
						if($post_status=="trash")	echo 'ゴミ箱';
						echo '</td>';

					// 掲載期限日
						echo '<td>' . get_post_meta($post_id, 'keisaikigenbi', true) . '</td>';
					// 物件種別
						echo '<td>';
						xls_custom_bukkenshubetsu_print($post_id);
						echo '</td>';
					// タイトル
						echo '<td>';
						echo '' . $meta['post_title'] . '';
						echo '</td>';
					// 価格
						echo '<td>';
						echo get_post_meta($post_id, 'kakaku', true);
						echo '</td>';
					// 間取
						echo '<td>';
						xls_custom_madorisu_print($post_id);
						echo '</td>';
					// 共益費・管理費(円)
						echo '<td>';
						echo get_post_meta($post_id, 'kakakukyouekihi', true);
						echo '</td>';
					// 敷金
						echo '<td>';
						xls_custom_kakakushikikin_print($post_id);
						echo '</td>';
					// 礼金
						echo '<td>';
						xls_custom_kakakureikin_print($post_id); 
						echo '</td>';
					// 保証金
						echo '<td>';
						xls_custom_kakakuhoshoukin_print($post_id);
						echo '</td>';
					// 権利金
						echo '<td>';
						xls_custom_kakakukenrikin_print($post_id);
						echo '</td>';
					// 償却・敷引金
						echo '<td>';
						xls_custom_kakakushikibiki_print($post_id);
						echo '</td>';
					// 県
						echo '<td>';
						xls_custom_shozaichi_print($post_id);
						echo '</td>';
					// 市区
						echo '<td>';
						xls_custom_shozaichi2_print($post_id);
						echo '</td>';
					// 所在地
						echo '<td>';
						echo get_post_meta($post_id, 'shozaichimeisho', true);
						echo '</td>';
					// 所在地2
						echo '<td>';
						echo get_post_meta($post_id, 'shozaichimeisho2', true);
						echo '</td>';
					// 所在地3
						echo '<td>';
						echo get_post_meta($post_id, 'shozaichimeisho3', true);
						echo '</td>';
					// 物件名
						echo '<td>';
						echo get_post_meta($post_id,'bukkenmei',true);
						echo '</td>';
					// 交通1路線
						echo '<td>';
						xls_custom_koutsu1_print($post_id,'r'); 
						echo '</td>';

					// 交通1駅
						echo '<td>';
						xls_custom_koutsu1_print($post_id,'e'); 
						echo '</td>';

					// バス停1
						echo '<td>';
						echo get_post_meta($post_id,'koutsubusstei1',true);
						echo '</td>';
					// バス分1
						echo '<td>';
						echo get_post_meta($post_id,'koutsubussfun1',true);
						echo '</td>';
					//バス停徒
						echo '<td>';
						echo get_post_meta($post_id,'koutsutohob1f',true);
						echo '</td>';
					// 徒歩m1
						echo '<td>';
						echo get_post_meta($post_id,'koutsutoho1',true);
						echo '</td>';
					// 徒歩分1
						echo '<td>';
						echo get_post_meta($post_id,'koutsutoho1f',true);
						echo '</td>';

				if($ex_id == '1'){

					// 交通2路線
						echo '<td>';
						xls_custom_koutsu2_print($post_id,'r'); 
						echo '</td>';

					// 交通2駅
						echo '<td>';
						xls_custom_koutsu2_print($post_id,'e'); 
						echo '</td>';

					// バス停2
						echo '<td>';
						echo get_post_meta($post_id,'koutsubusstei2',true);
						echo '</td>';
					// バス分2
						echo '<td>';
						echo get_post_meta($post_id,'koutsubussfun2',true);
						echo '</td>';
					//バス停徒2
						echo '<td>';
						echo get_post_meta($post_id,'koutsutohob2f',true);
						echo '</td>';

					// 徒歩m2
						echo '<td>';
						echo get_post_meta($post_id,'koutsutoho2',true);
						echo '</td>';
					// 徒歩分2
						echo '<td>';
						echo get_post_meta($post_id,'koutsutoho2f',true);
						echo '</td>';
					//その他交通
						echo '<td>';
						echo get_post_meta($post_id,'koutsusonota',true);
						echo '</td>';
				} //ex_id

					// 築年月
						echo '<td>';
						echo get_post_meta($post_id, 'tatemonochikunenn', true);
						echo '</td>';
					// 建物面積
						echo '<td>';
						echo get_post_meta($post_id, 'tatemonomenseki', true);
						echo '</td>';
					// 建物面積計測方式
						echo '<td>';
						xls_custom_tatemonohosiki_print($post_id);
						echo '</td>';
					// 建物階数地上
						echo '<td>';
						echo get_post_meta($post_id, 'tatemonokaisu1', true);
						echo '</td>';
					// 建物階数地下
						echo '<td>';
						echo get_post_meta($post_id, 'tatemonokaisu2', true);
						echo '</td>';
					// 部屋階数
						echo '<td>';
						echo get_post_meta($post_id, 'heyakaisu', true);
						echo '</td>';
					// 部屋・区画番号
						echo '<td>';
						echo get_post_meta($post_id, 'bukkennaiyo', true);
						echo '</td>';
					// 建物構造
						echo '<td>';
						xls_custom_tatemonokozo_print($post_id);
						echo '</td>';
					// 敷地全体面積
						echo '<td>';
						echo get_post_meta($post_id, 'tatemonozentaimenseki', true);
						echo '</td>';
					// 延べ床面積
						echo '<td>';
						echo get_post_meta($post_id, 'tatemononobeyukamenseki', true) ;
						echo '</td>';
					// 住宅保険料(円)
						echo '<td>';
						echo get_post_meta($post_id, 'kakakuhoken', true);
						echo '</td>';
					// 住宅保険期間(年)
						echo '<td>';
						echo get_post_meta($post_id, 'kakakuhokenkikan', true);
						echo '</td>';
					// 修繕積立金(円)
						echo '<td>';
						echo get_post_meta($post_id, 'kakakutsumitate', true);
						echo '</td>';
					// 駐車場料金(円)
						echo '<td>';
						echo get_post_meta($post_id, 'chushajoryokin', true);
						echo '</td>';
					// 取引態様
						echo '<td>';
						xls_custom_torihikitaiyo_print($post_id);
						echo '</td>';
					// 入居時期
						echo '<td>';
						xls_custom_nyukyojiki_print($post_id);
						echo '</td>';
					// 入居年月
						echo '<td>';
						echo get_post_meta($post_id, 'nyukyonengetsu', true);
						echo '</td>';
					// 入居旬
						echo '<td>';
						xls_custom_nyukyosyun_print($post_id);
						echo '</td>';
					// 現況
						echo '<td>';
						xls_custom_nyukyogenkyo_print($post_id);
						echo '</td>';
					// 地目
						echo '<td>';
						xls_custom_tochichimoku_print($post_id);
						echo '</td>';
					// 用途地域
						echo '<td>';
						xls_custom_tochiyouto_print($post_id);
						echo '</td>';
					// 都市計画
						echo '<td>';
						xls_custom_tochikeikaku_print($post_id);
						echo '</td>';
					// 地勢
						echo '<td>';
						xls_custom_tochichisei_print($post_id);
						echo '</td>';
					// 区画面積
						echo '<td>';
						echo get_post_meta($post_id, 'tochikukaku', true);
						echo '</td>';
					// 建ぺい率
						echo '<td>';
						echo get_post_meta($post_id, 'tochikenpei', true);
						echo '</td>';
					// 容積率
						echo '<td>';
						echo get_post_meta($post_id, 'tochiyoseki', true);
						echo '</td>';
					// 土地権利
						echo '<td>';
						xls_custom_tochikenri_print($post_id);
						echo '</td>';
					// 国土法届出
						echo '<td>';
						xls_custom_tochikokudohou_print($post_id);
						echo '</td>';
					// 報酬形態
						echo '<td>';
						echo get_post_meta($post_id, 'houshoukeitai', true);
						echo '</td>';
					// 元付名
						echo '<td>';
						echo get_post_meta($post_id, 'motozukemei', true);
						echo '</td>';
					// 元付TEL
						echo '<td>';
						echo get_post_meta($post_id, 'motozuketel', true);
						echo '</td>';
					// 元付FAX
						echo '<td>';
						echo get_post_meta($post_id, 'motozukefax', true);
						echo '</td>';
					// 社内用メモ
						echo '<td>';
						echo get_post_meta($post_id, 'shanaimemo', true);
						echo '</td>';



				if($ex_id == '1'){

					// CSV TYPE
						echo '<td>';
						echo get_post_meta($post_id, 'csvtype', true);
						echo '</td>';
					// keywords
						echo '<td>';
						echo get_post_meta($post_id, 'fudokeywords', true);
						echo '</td>';
					// description
						echo '<td>';
						echo get_post_meta($post_id, 'fudodescription', true);
						echo '</td>';
					// 成約日
						echo '<td>';
						echo get_post_meta($post_id, 'seiyakubi', true);
						echo '</td>';
								// 自社物フラグ
								//	xls_custom_koukaijisha_print($post_id);
								//	echo '</td>';
					// 状態
						echo '<td>';
						xls_custom_jyoutai_print($post_id);
						echo '</td>';
					// 物件名公開
						echo '<td>';
						xls_custom_bukkenmeikoukai_print($post_id);
						echo '</td>';
					// 総戸数
						echo '<td>';
						echo get_post_meta($post_id, 'bukkensoukosu', true);
						echo '</td>';
					// 緯度
						echo '<td>';
						echo get_post_meta($post_id, 'bukkenido', true);
						echo '</td>';
					// 経度
						echo '<td>';
						echo get_post_meta($post_id, 'bukkenkeido', true);
						echo '</td>';
					// 土地面積計測方式
						echo '<td>';
						xls_custom_tochisokutei_print($post_id);
						echo '</td>';
					// セットバック
						echo '<td>';
						xls_custom_tochisetback_print($post_id);
						echo '</td>';
					// 私道負担面積
						echo '<td>';
						echo get_post_meta($post_id, 'tochishido', true);
						echo '</td>';
					// セットバック量
						echo '<td>';
						echo get_post_meta($post_id, 'tochisetback2', true);
						echo '</td>';
					// 接道状況
						echo '<td>';
						xls_custom_tochisetsudo_print($post_id);
						echo '</td>';
					// 接道方向1
						echo '<td>';
						xls_custom_tochisetsudohouko1_print($post_id);
						echo '</td>';
					// 接道間口1
						echo '<td>';
						echo get_post_meta($post_id, 'tochisetsudomaguchi1', true);
						echo '</td>';
					// 接道種別1
						echo '<td>';
						xls_custom_tochisetsudoshurui1_print($post_id);
						echo '</td>';
					// 接道幅員1
						echo '<td>';
						echo get_post_meta($post_id, 'tochisetsudofukuin1', true);
						echo '</td>';
					// 位置指定道路1
						echo '<td>';
						xls_custom_tochisetsudoichishitei1_print($post_id);
						echo '</td>';
					// 接道方向2
						echo '<td>';
						xls_custom_tochisetsudohouko2_print($post_id);
						echo '</td>';
					// 接道間口2
						echo '<td>';
						echo get_post_meta($post_id, 'tochisetsudomaguchi2', true);
						echo '</td>';
					// 接道種別2
						echo '<td>';
						xls_custom_tochisetsudoshurui2_print($post_id);
						echo '</td>';
					// 接道幅員2
						echo '<td>';
						echo get_post_meta($post_id, 'tochisetsudofukuin2', true);
						echo '</td>';
					// 位置指定道路2
						echo '<td>';
						xls_custom_tochisetsudoichishitei2_print($post_id);
						echo '</td>';
					// 建築面積
						echo '<td>';
						echo get_post_meta($post_id, 'tatemonokentikumenseki', true);
						echo '</td>';
					// 新築・未入居
						echo '<td>';
						xls_custom_tatemonoshinchiku_print($post_id);
						echo '</td>';
					// バルコニー面積
						echo '<td>';
						echo get_post_meta($post_id, 'heyabarukoni', true);
						echo '</td>';
					// 部屋向き
						echo '<td>';
						xls_custom_heyamuki_print($post_id);
						echo '</td>';
					// 間取り備考
						echo '<td>';
						echo get_post_meta($post_id, 'madoribiko', true);
						echo '</td>';
					// 備考URL
						echo '<td>';
						echo get_post_meta($post_id, 'targeturl', true);
						echo '</td>';
					// 管理人
						echo '<td>';
						xls_custom_kanrininn_print($post_id);
						echo '</td>';
					// 管理形態
						echo '<td>';
						xls_custom_kanrikeitai_print($post_id);
						echo '</td>';
					// 管理組合
						echo '<td>';
						xls_custom_kanrikumiai_print($post_id);
						echo '</td>';
					// 管理会社名
						echo '<td>';
						echo get_post_meta($post_id, 'kanrikaisha', true);
						echo '</td>';
					// 価格税額
						echo '<td>';
						echo get_post_meta($post_id, 'kakakuzei', true) ;
						echo '</td>';
					// 価格公開
						echo '<td>';
						xls_custom_kakakukoukai_print($post_id);
						echo '</td>';
					// 価格状態
						echo '<td>';
						xls_custom_kakakujoutai_print($post_id);
						echo '</td>';
					// 坪単価
						echo '<td>';
						echo get_post_meta($post_id, 'kakakutsubo', true) ;
						echo '</td>';
					// 満室時表面利回り
						echo '<td>';
						echo get_post_meta($post_id, 'kakakuhyorimawari', true) ;
						echo '</td>';
					// 現行利回り
						echo '<td>';
						echo get_post_meta($post_id, 'kakakurimawari', true) ;
						echo '</td>';
					// 借地料
						echo '<td>';
						echo get_post_meta($post_id, 'shakuchiryo', true) ;
						echo '</td>';
					// 借地契約年月
						echo '<td>';
						echo get_post_meta($post_id, 'shakuchikikan', true) ;
						echo '</td>';
					// 契約期間(区分)
						echo '<td>';
						xls_custom_shakuchikubun_print($post_id);
						echo '</td>';
					// 駐車場区分
						echo '<td>';
						xls_custom_chushajokubun_print($post_id);
						echo '</td>';
					// 駐車場備考
						echo '<td>';
						echo get_post_meta($post_id, 'chushajobiko', true) ;
						echo '</td>';
					// 小学校名
						echo '<td>';
						echo get_post_meta($post_id, 'shuuhenshougaku', true) ;
						echo '</td>';
					// 中学校名
						echo '<td>';
						echo get_post_meta($post_id, 'shuuhenchuugaku', true) ;
						echo '</td>';

					// 物件画像 
						xls_custom_gazo( $post_id );

					// 設備・条件
						echo '<td>';
						xls_custom_setsubi( $post_id );
						echo '</td>';
					// 設備・条件 その他
						echo '<td>';
						echo get_post_meta($post_id, 'setsubisonota', true) ;
						echo '</td>';

					// 間取り内容
					xls_custom_madorinaiyo_print($post_id);

					// 本文
						echo '<td>';
						echo $post_content_data;
						echo '</td>';
					// 抜粋
						echo '<td>';
						echo $post_excerpt_data;
						echo '</td>';

					// 特記事項
						echo '<td>';
						$tokkinotices = get_post_meta($post_id, 'tokkinotices', true)  ;
						$tokkinotices =  str_replace( '"' , '&quot;' , $tokkinotices );
						$tokkinotices =  str_replace( array("\r\n", "\r", "\n") , "<br>"  , $tokkinotices );
						echo $tokkinotices;
						echo '</td>';

					//会員公開
						echo '<td>';
						if ( get_post_meta($post_id, 'kaiin', true) == '0'  ){
							 echo '一般公開';
						}else{
							if ( get_post_meta($post_id, 'kaiin', true) == '1'  ){
								echo '会員公開';
							}
						}
						do_action( 'kaiin_level_text', $post_id ); //会員 text
						echo '</td>';
					//物件カテゴリ
						echo '<td>';
						xls_custom_terms( $post_id , 'bukken');
						echo '</td>';
					//物件タグ
						echo '<td>';
						xls_custom_terms( $post_id , 'bukken_tag');
						echo '</td>';
					//更新料
						echo '<td>';
						xls_custom_kakakukoushin_print( $post_id );
						echo '</td>';
					// その他周辺環境
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'shuuhensonota',true) );
						echo '</td>';

					if( $is_fudoubus ){
					// バス会社1
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'buscorp1',true) );
						echo '</td>';
					// バス路線1
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'buscorse1',true) );
						echo '</td>';
					// バス停1
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'busstop1',true) );
						echo '</td>';
					// バス会社2
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'buscorp2',true) );
						echo '</td>';
					// バス路線2
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'buscorse2',true) );
						echo '</td>';
					// バス停2
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'busstop2',true) );
						echo '</td>';
					}

					if( $is_fudoukouku ){
					// 小学校区
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'kouku_shougaku',true) );
						echo '</td>';
					// 中学校区
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'kouku_chuugaku',true) );
						echo '</td>';
					}

					if( $is_fudouchoumei ){
					// 町名
						echo '<td>';
						echo esc_html( get_post_meta($post_id,'choumei',true) );
						echo '</td>';
					}

					/*
					 * カスタムフィールド追加 データ ex_id
					 * ver 5.3.3
					 */
					do_action( 'admin_phpex_data_ex_id', $post_id );

				} //ex_id

					/*
					 * カスタムフィールド追加 データ
					 * ver 5.3.3
					 */
					do_action( 'admin_phpex_data', $post_id );

					echo '</tr>';
				} //loop

				echo '</table>';
				echo '</body>';
				echo '</html>';

				ob_end_flush();

			}else{
				echo '物件がありませんでした';
			}

		}else{
			echo '物件があいませんでした。';
		}
	}

}else{

	header('HTTP/1.1 403 Forbidden');
	exit();

}	//is_user_logged_in() 

//$wpdb->print_error();






/**
 * 物件画像タイプ
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int|string $imgtype.
 * @return text
 */
function xls_custom_gazo( $post_id ) {
	global $work_gazo,$work_gazo2;

	if( FUDOU_IMG_MAX > 10 ){
	  $work_gazo = array_merge($work_gazo, $work_gazo2);
	}

	foreach($work_gazo as $meta_box) {

		$gazo = get_post_meta($post_id, $meta_box['name'], true) ;

		if('select' == $meta_box['type']){

			switch ( $gazo ) {
				case '1' :
					echo '<td>間取</td>';
					break;
				case '2' :
					echo '<td>外観</td>';
					break;
				case '3' :
					echo '<td>地図</td>';
					break;
				case '4' :
					echo '<td>周辺</td>';
					break;
				case '5' :
					echo '<td>内装</td>';
					break;
				case '9' :
					echo '<td>その他画像</td>';
					break;
				case '10' :
					echo '<td>玄関</td>';
					break;
				case '11' :
					echo '<td>居間</td>';
					break;
				case '12' :
					echo '<td>キッチン</td>';
					break;
				case '13' :
					echo '<td>寝室</td>';
					break;
				case '14' :
					echo '<td>子供部屋</td>';
					break;
				case '15' :
					echo '<td>風呂</td>';
					break;
				default:
					echo '<td></td>';
				break;
			}

		}else{
			echo '<td>'.$gazo.'</td>';
		}
	}
}

/**
 * 間取種類
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_madorinaiyo_print($post_id) {
	global $work_madorinaiyo;

	foreach($work_madorinaiyo as $meta_box) {

		$madorinaiyo_data = get_post_meta($post_id, $meta_box['name'], true);
		if('select'==$meta_box['type']){

			if($madorinaiyo_data=="1") $madorinaiyo_data = '和室';
			if($madorinaiyo_data=="2") $madorinaiyo_data = '洋室';
			if($madorinaiyo_data=="3") $madorinaiyo_data = 'DK';
			if($madorinaiyo_data=="4") $madorinaiyo_data = 'LDK';
			if($madorinaiyo_data=="5") $madorinaiyo_data = 'L';
			if($madorinaiyo_data=="6") $madorinaiyo_data = 'D';
			if($madorinaiyo_data=="7")  $madorinaiyo_data = 'K';
			if($madorinaiyo_data=="9")  $madorinaiyo_data = 'その他';
			if($madorinaiyo_data=="21")  $madorinaiyo_data = 'LK';
			if($madorinaiyo_data=="22")  $madorinaiyo_data = 'LD';
			if($madorinaiyo_data=="23")  $madorinaiyo_data = 'S';
		}
		echo'<td>'.$madorinaiyo_data.'</td>';
	}
}

/**
 * 設備・条件
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_setsubi( $post_id ) {

	global $work_setsubi;

	$setsubi_data =  get_post_meta($post_id, 'setsubi', true) ;
	$setsubi='設備';
	foreach($work_setsubi as $meta_box){

		if( strpos($setsubi_data, $meta_box['code']) ){
			$setsubi .= '/' . $meta_box['name'];
		}
	}
	if($setsubi != '設備') echo $setsubi;
}

/**
 * 先物
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_koukaijisha_print($post_id) {
	$koukaijisha_data = get_post_meta($post_id,'koukaijisha',true);
	if($koukaijisha_data=="0")  echo '先物';
	if($koukaijisha_data=="1")  echo '自社物';
}

/**
 * 状態
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_jyoutai_print($post_id) {
	$jyoutai_data = get_post_meta($post_id,'jyoutai',true);
	if($jyoutai_data=="1")  echo '空有/売出中';
	if($jyoutai_data=="3")  echo '空無/売止';
	if($jyoutai_data=="4")  echo '成約';
	if($jyoutai_data=="9")  echo '削除';
}

/**
 * 物件種別
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_bukkenshubetsu_print($post_id) {
	global $work_bukkenshubetsu;
	$bukkenshubetsu_data = get_post_meta($post_id,'bukkenshubetsu',true);

	foreach($work_bukkenshubetsu as $meta_box){
			if($bukkenshubetsu_data == $meta_box['id'] ) 
			echo ''.$meta_box['name'].'';
	}
}

/**
 * 物件名公開
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_bukkenmeikoukai_print($post_id) {

	$bukkenmeikoukai_data = get_post_meta($post_id,'bukkenmeikoukai',true);
	if($bukkenmeikoukai_data=="0")  echo '非公開';
	if($bukkenmeikoukai_data=="1")  echo '公開';
	if($bukkenmeikoukai_data=="2")  echo '物件名のみ公開';
}

/**
 * 所在地 県
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_shozaichi_print($post_id) {
	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);
	if($shozaichiken_data=="") $shozaichiken_data = get_post_meta($post_id,'shozaichiken',true);

	if($shozaichiken_data != ''){
		$shozaichiken_data = sprintf("%02d",$shozaichiken_data);
		$middle_area_name = fudo_ken_name($shozaichiken_data);
		echo $middle_area_name;

	}
}

/**
 * 所在地 市区
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_shozaichi2_print($post_id) {
	global $wpdb;

	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);

	$shozaichicode_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichicode_data = myLeft($shozaichicode_data,5);
	$shozaichicode_data = myRight($shozaichicode_data,3);

	if($shozaichiken_data !="" && $shozaichicode_data !=""){
		$sql = "SELECT narrow_area_name FROM ". $wpdb->prefix . DB_SHIKU_TABLE . " WHERE middle_area_id=".$shozaichiken_data." and narrow_area_id =".$shozaichicode_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->narrow_area_name;
	}
}

/**
 * 路線 駅 バス 徒歩
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_koutsu1_print($post_id,$v_t) {
	global $wpdb;

	$koutsurosen_data = get_post_meta($post_id, 'koutsurosen1', true);
	$koutsueki_data = get_post_meta($post_id, 'koutsueki1', true);

	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);

	if($v_t == 'r'){
	if($koutsurosen_data !=""){
		$sql = "SELECT `rosen_name` FROM " . $wpdb->prefix . DB_ROSEN_TABLE . " WHERE `rosen_id` =".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->rosen_name;
	}
	}

	if($v_t == 'e'){
	if($koutsurosen_data !="" && $koutsueki_data !=""){
		$sql = "SELECT DTS.station_name";
		$sql = $sql . " FROM ". $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR";
		$sql = $sql . " INNER JOIN " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
		$sql = $sql . " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->station_name.'';
	}
	}
}


function xls_custom_koutsu2_print($post_id,$v_t) {
	global $wpdb;

	$koutsurosen_data = get_post_meta($post_id, 'koutsurosen2', true);
	$koutsueki_data = get_post_meta($post_id, 'koutsueki2', true);

	$shozaichiken_data = get_post_meta($post_id,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);

	if($v_t == 'r'){
	if($koutsurosen_data !=""){
		$sql = "SELECT `rosen_name` FROM ". $wpdb->prefix . DB_ROSEN_TABLE . " WHERE `rosen_id` =".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->rosen_name;
	}
	}

	if($v_t == 'e'){
	if($koutsurosen_data !="" && $koutsueki_data !=""){
		$sql = "SELECT DTS.station_name";
		$sql = $sql . " FROM " . $wpdb->prefix. DB_ROSEN_TABLE . " AS DTR";
		$sql = $sql . " INNER JOIN ". $wpdb->prefix. DB_EKI_TABLE . " AS DTS ON DTR.rosen_id = DTS.rosen_id";
		$sql = $sql . " WHERE DTS.station_id=".$koutsueki_data." AND DTS.rosen_id=".$koutsurosen_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas) ) echo $metas->station_name.'';
	}
	}

}

/**
 * 建物構造
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_tatemonokozo_print($post_id) {
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
function xls_custom_tatemonohosiki_print($post_id) {
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
function xls_custom_tatemonoshinchiku_print($post_id) {
	if(get_post_meta($post_id,'tatemonoshinchiku',true)=="0") echo '中古';
	if(get_post_meta($post_id,'tatemonoshinchiku',true)=="1") echo '新築・未入居';
	//text
	if( get_post_meta($post_id,'tatemonoshinchiku',true) !='' && !is_numeric(get_post_meta($post_id,'tatemonoshinchiku',true)) ) echo get_post_meta($post_id,'tatemonoshinchiku',true);
}

/**
 * 部屋向き
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_heyamuki_print($post_id) {
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
function xls_custom_madorisu_print($post_id) {
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
 * 管理人
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_kanrininn_print($post_id){
	$kanrininn_data = get_post_meta($post_id,'kanrininn',true);

	if($kanrininn_data=="1")	echo '常駐';
	if($kanrininn_data=="2")	echo '日勤';
	if($kanrininn_data=="3")	echo '巡回';
	if($kanrininn_data=="4")	echo '無';
	if($kanrininn_data=="5")	echo '非常駐';
	//text
	if( $kanrininn_data!='' && !is_numeric($kanrininn_data) ) echo $kanrininn_data;
}

/**
 * 管理形態人
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_kanrikeitai_print($post_id){
	$kanrikeitai_data = get_post_meta($post_id,'kanrikeitai',true);

	if($kanrikeitai_data=="1")	echo '自主管理';
	if($kanrikeitai_data=="2")	echo '一部委託';
	if($kanrikeitai_data=="3")	echo '全部委託';
	//text
	if( $kanrikeitai_data!='' && !is_numeric($kanrikeitai_data) ) echo $kanrikeitai_data;
}

/**
 * 管理組合
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_kanrikumiai_print($post_id){
	$kanrikumiai_data = get_post_meta($post_id,'kanrikumiai',true);

	if($kanrikumiai_data=="1")	echo '無';
	if($kanrikumiai_data=="2")	echo '有';
	//text
	if( $kanrikumiai_data!='' && !is_numeric($kanrikumiai_data) ) echo $kanrikumiai_data;
}


/**
 * 価格公開
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_kakakukoukai_print($post_id) {
	$kakakukoukai_data = get_post_meta($post_id,'kakakukoukai',true);
	if($kakakukoukai_data=="0")	echo '非公開';
	if($kakakukoukai_data=="1")	echo '公開';
}

/**
 * 価格状態
 *
 * @since Fudousan Plugin 1.9.0
 *
 * @param int $post_id Post ID.
 */
function xls_custom_kakakujoutai_print($post_id) {
	$kakakujoutai_data = get_post_meta($post_id,'kakakujoutai',true);
	if($kakakujoutai_data =="1")	echo '相談';
	if($kakakujoutai_data =="2")	echo '確定';
	if($kakakujoutai_data =="3")	echo '入札';

	//価格状態 v1.9.0
	do_action( 'fudou_add_kakakujoutai', $kakakujoutai_data, $post_id );
}

/**
 * 礼金・万円/月数
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_kakakureikin_print($post_id) {
	$kakakureikin_data = get_post_meta($post_id,'kakakureikin',true);
	if(is_numeric($kakakureikin_data)){
		if($kakakureikin_data >= 100) {
			echo $kakakureikin_data;
			echo "円";
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
function xls_custom_kakakushikikin_print($post_id) {
	$kakakushikikin_data = get_post_meta($post_id,'kakakushikikin',true);
	if(is_numeric($kakakushikikin_data)){
		if($kakakushikikin_data >= 100) {
			echo $kakakushikikin_data;
			echo "円";
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
function xls_custom_kakakuhoshoukin_print($post_id) {
	$kakakuhoshoukin_data = get_post_meta($post_id,'kakakuhoshoukin',true);
	if(is_numeric($kakakuhoshoukin_data)){
		if($kakakuhoshoukin_data >= 100) {
			echo $kakakuhoshoukin_data;
			echo "円";
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
function xls_custom_kakakukenrikin_print($post_id) {
	$kakakukenrikin_data = get_post_meta($post_id,'kakakukenrikin',true);
	if(is_numeric($kakakukenrikin_data)){
		if($kakakukenrikin_data >= 100) {
			echo $kakakukenrikin_data;
			echo "円";
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
function xls_custom_kakakushikibiki_print($post_id) {
	$kakakushikibiki_data = get_post_meta($post_id,'kakakushikibiki',true);

	if(is_numeric($kakakushikibiki_data)){
		if($kakakushikibiki_data < 100) {
			echo $kakakushikibiki_data;
			echo "ヶ月";
		}elseif($kakakushikibiki_data>100 && $kakakushikibiki_data<=200){
			echo floatval($kakakushikibiki_data)-100;
			echo "%";
		}elseif($kakakushikibiki_data>200){
			echo $kakakushikibiki_data;
			echo "円";
		}
	}
}

/**
 * 更新料・円/月数
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_kakakukoushin_print($post_id) {
	$kakakukoushin_data = get_post_meta($post_id,'kakakukoushin',true);
	if(is_numeric($kakakukoushin_data)){
		if($kakakukoushin_data >= 100) {
			echo $kakakukoushin_data;
			echo "円";
		}else{
			echo $kakakukoushin_data;
			echo "ヶ月";
		}
	}
}

/**
 * 借地契約期間(区分)
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_shakuchikubun_print($post_id) {
	$shakuchikubun_data = get_post_meta($post_id,'shakuchikubun',true);
	if($shakuchikubun_data == '1') {
		echo "期限";
	}elseif($shakuchikubun_data=='2'){
		echo "期間";
	}
	//text
	if( $shakuchikubun_data !='' && !is_numeric($shakuchikubun_data) ) echo $shakuchikubun_data;
}

/**
 * 駐車場区分
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_chushajokubun_print($post_id) {

	$chushajokubun_data = get_post_meta($post_id,'chushajokubun',true);
	if($chushajokubun_data=="1")	echo '空有';
	if($chushajokubun_data=="2")	echo '空無';
	if($chushajokubun_data=="3")	echo '近隣';
	if($chushajokubun_data=="4")	echo '無';
	//text
	if( $chushajokubun_data !='' && !is_numeric($chushajokubun_data) ) echo $chushajokubun_data;
}

/**
 * 現況
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_nyukyogenkyo_print($post_id) {

	$bukkenshubetsu_data = intval(get_post_meta($post_id,'bukkenshubetsu',true));
	$nyukyogenkyo_data = get_post_meta($post_id,'nyukyogenkyo',true);

	if ( $bukkenshubetsu_data <1200 ) {
		if($nyukyogenkyo_data=="1")	echo '更地';
		if($nyukyogenkyo_data=="2")	echo '上物有';
		if($nyukyogenkyo_data=="10")	echo '上物有(更地引渡可)';
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
function xls_custom_nyukyojiki_print($post_id) {
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
function xls_custom_nyukyosyun_print($post_id) {
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
function xls_custom_torihikitaiyo_print($post_id) {
	$torihikitaiyo_data = get_post_meta($post_id,'torihikitaiyo',true);
	if($torihikitaiyo_data=="1")	echo '売主/貸主';
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
function xls_custom_tochichimoku_print($post_id) {
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
function xls_custom_tochiyouto_print($post_id) {
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
function xls_custom_tochikeikaku_print($post_id) {
	$tochikeikaku_data = get_post_meta($post_id,'tochikeikaku',true);
	if($tochikeikaku_data=="1")	echo '市街化区域';
	if($tochikeikaku_data=="2")	echo '市街化調整区域';
	if($tochikeikaku_data=="3")	echo '未線引区域';
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
function xls_custom_tochichisei_print($post_id) {
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
function xls_custom_tochisokutei_print($post_id) {
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
function xls_custom_tochisetback_print($post_id) {
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
function xls_custom_tochisetsudo_print($post_id) {
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
function xls_custom_tochisetsudohouko1_print($post_id) {
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
function xls_custom_tochisetsudoshurui1_print($post_id) {
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
function xls_custom_tochisetsudoichishitei1_print($post_id) {
	$tochisetsudoichishitei1_data = get_post_meta($post_id,'tochisetsudoichishitei1',true);
	if($tochisetsudoichishitei1_data=="1")	echo '位置指定道路';
	if($tochisetsudoichishitei1_data=="2")	echo '無';
	//text
	if( $tochisetsudoichishitei1_data !='' && !is_numeric($tochisetsudoichishitei1_data) ) echo $tochisetsudoichishitei1_data.'';
}

/**
 * 接道方向2
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_tochisetsudohouko2_print($post_id) {
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
function xls_custom_tochisetsudoshurui2_print($post_id) {
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
function xls_custom_tochisetsudoichishitei2_print($post_id) {
	$tochisetsudoichishitei2_data = get_post_meta($post_id,'tochisetsudoichishitei2',true);
	if($tochisetsudoichishitei2_data=="1")	echo '位置指定道路';
	if($tochisetsudoichishitei2_data=="2")	echo '無';
	//text
	if( $tochisetsudoichishitei2_data !='' && !is_numeric($tochisetsudoichishitei2_data) ) echo $tochisetsudoichishitei2_data.'';
}

/**
 * 土地権利(借地権種類)
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_tochikenri_print($post_id) {
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
function xls_custom_tochikokudohou_print($post_id) {
	$tochikokudohou_data = get_post_meta($post_id,'tochikokudohou',true);
	if($tochikokudohou_data=="1")	echo '要';
	if($tochikokudohou_data=="2")	echo '届出中';
	if($tochikokudohou_data=="3")	echo '不要';
	//text
	if( $tochikokudohou_data !='' && !is_numeric($tochikokudohou_data) ) echo $tochikokudohou_data.'';

}


/**
 * 物件カテゴリ・物件タグ
 *
 * @since Fudousan Plugin 1.0.0 *
 * @param int $post_id Post ID.
 */
function xls_custom_terms( $post_id , $tax_name) {

	$term_list = wp_get_post_terms($post_id, $tax_name, array("fields" => "names"));
	if(!empty($term_list)) {
		$i=0;
		foreach($term_list as $t_list) {
			if($i != 0) echo ',';
			echo $term_list[$i];
			$i++;
		}
	}
}

