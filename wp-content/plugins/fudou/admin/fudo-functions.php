<?php
/*
 * 不動産プラグインカスタムフィールド
 * @package WordPress5.9
 * @subpackage Fudousan Plugin
 * Version: 5.9.1
*/

// csv type
add_action('admin_menu', 'my_custom_csvtype') ;
add_action('save_post', 'custom_save_csvtype') ;


// meta
add_action('admin_menu', 'my_custom_meta') ;
add_action('save_post', 'custom_save_meta') ;


// 物件番号
// 掲載期限日
// 成約日
add_action('admin_menu', 'my_custom_shikibesu') ;
add_action('save_post', 'custom_save_shikibesu') ;


// 自社物
// 状態
add_action('admin_menu', 'my_custom_koukai') ;
add_action('save_post', 'custom_save_koukaijisha') ;


// 物件種別
add_action('admin_menu', 'my_custom_bukkenshubetsu') ;
add_action('save_post', 'custom_save_bukkenshubetsu') ;


// 建物名(物件名)
// 物件名公開
// 総戸数・総区画数 物件の総数 (部屋:総戸数 土地:総区画数)
// 空き物件内容 部屋:空部屋の番号 土地:区画番号等
add_action('admin_menu', 'my_custom_bukkenmei') ;
add_action('save_post', 'custom_save_bukkenmei') ;


// 県
// 市区
// 所在地名称	
// 所在地詳細	
add_action('admin_menu', 'my_custom_shozaichi') ;
add_action('save_post', 'custom_save_shozaichiken') ;


// 緯度
// 経度
add_action('admin_menu', 'my_custom_bukkenidokeido') ;
add_action('save_post', 'custom_save_bukkenido') ;


// 交通路線1
// 交通駅1
// 交通バス停名1
// 交通バス時間1
// 交通徒歩距離1
add_action('admin_menu', 'my_custom_koutsu1') ;
add_action('save_post', 'custom_save_koutsurosen1') ;


// 交通路線2
// 交通駅2
// 交通バス停名2
// 交通バス時間2
// 交通徒歩距離2
add_action('admin_menu', 'my_custom_koutsu2') ;
add_action('save_post', 'custom_save_koutsurosen2') ;


// 交通その他
add_action('admin_menu', 'my_custom_koutsusonota') ;
add_action('save_post', 'custom_save_koutsusonota') ;


// 地目
// 用途地域
// 都市計画
// 地勢
// 土地面積計測方式
// 区画面積
// 私道負担面積
// セットバック
// セットバック量
// 建ぺい率
// 容積率
// 接道状況
// 接道方向1
// 接道間口1
// 接道種別1
// 接道幅員1
// 位置指定道路1
// 接道方向2
// 接道間口2
// 接道種別2
// 接道幅員2
// 位置指定道路2
// 土地権利(借地権種類) 
// 国土法届出
add_action('admin_menu', 'my_custom_tochi') ;
add_action('save_post', 'custom_save_tochichimoku') ;


// 建物構造
// 建物面積計測方式
// 建物面積・専有面積
// 敷地全体面積
// 延べ床面積
// 建築面積
// 建物階数(地上)
// 建物階数(地下)
// 築年月
// 新築・未入居フラグ
add_action('admin_menu', 'my_custom_tatemono') ;
add_action('save_post', 'custom_save_tatemonokozo') ;


// 管理人
// 管理形態
// 管理組合有無
// 管理会社名
add_action('admin_menu', 'my_custom_kanrininn') ;
add_action('save_post', 'custom_save_kanrininn') ;


// 部屋階数 部屋の所在階数
// バルコニー面積
// 向き
add_action('admin_menu', 'my_custom_heya') ;
add_action('save_post', 'custom_save_heyakaisu') ;


// 間取部屋数
// 間取部屋種類
// 間取備考
add_action('admin_menu', 'my_custom_madori') ;
add_action('save_post', 'custom_save_madorisu') ;


// 間取(種類)
// 間取(畳数)
// 間取(所在階)
// 間取(室数)
add_action('admin_menu', 'my_custom_madorinaiyo');  
add_action('save_post', 'custom_save_madorinaiyo');


// 備考	URL
add_action('admin_menu', 'my_custom_targeturl');
add_action('save_post', 'custom_save_targeturl');


// 社内用メモ
// 分配率(客付分)
// 元付け	名称
// 電話番号
add_action('admin_menu', 'my_custom_shanaimemo');
add_action('save_post', 'custom_save_shanaimemo');


// 賃料・価格
// 価格公開
// 価格状態
// 税額
// 坪単価
// 共益費・管理費
// 礼金・月数
// 敷金・月数
// 保証金・月数
// 権利金 
// 償却・敷引金
// 満室時表面利回り
// 現行利回り
// 住宅保険料
// 住宅保険期間 
// 借地料
// 契約期間(年)
// 契約期間(月)	
// 契約期間(区分)
// 修繕積立金
add_action('admin_menu', 'my_custom_kinsenmen') ;
add_action('save_post', 'custom_save_kakaku') ;


// 駐車場料金
// 駐車場区分
// 駐車場備考
add_action('admin_menu', 'my_custom_chushajo') ;
add_action('save_post', 'custom_save_chushajoryokin') ;


// 現況
// 引渡/入居時期
// 引渡/入居年月 年月
// 引渡/入居旬
add_action('admin_menu', 'my_custom_nyukyo') ;
add_action('save_post', 'custom_save_nyukyogenkyo') ;


// 小学校名
// 中学校名
add_action('admin_menu', 'my_custom_shuuhen') ;
add_action('save_post', 'custom_save_shuuhenshougaku') ;


// 取引態様
add_action('admin_menu', 'my_custom_torihikitaiyo') ;
add_action('save_post', 'custom_save_torihikitaiyo') ;


// 物件画像
add_action('admin_menu', 'my_custom_gazo');
add_action('save_post', 'custom_save_gazo');


// 設備・条件
add_action('admin_menu', 'my_custom_setsubi');
add_action('save_post', 'custom_save_setsubi');


// 特記事項
add_action('admin_menu', 'my_custom_tokkinotices') ;
add_action('save_post', 'custom_save_tokkinotices') ;








// csvtype
function my_custom_csvtype() {
	add_meta_box( 'my_custom_csvtype_area', 'CSV TYPE', 'my_custom_csvtype_in', 'fudo', 'advanced' );
}


// meta
function my_custom_meta() {
	add_meta_box( 'my_custom_meta_area', 'meta', 'my_custom_meta_in', 'fudo', 'advanced' );
}


// 物件番号
// 掲載期限日
// 成約日
function my_custom_shikibesu() {
	add_meta_box( 'my_custom_shikibesu_area', '物件', 'my_custom_shikibesu_in', 'fudo', 'advanced' );
}


// 公開
// 状態
function my_custom_koukai() {
	add_meta_box( 'my_custom_koukai_area', '状態', 'my_custom_koukai_in', 'fudo', 'advanced' );
}


// 種別
function my_custom_bukkenshubetsu() {
	add_meta_box( 'my_custom_bukkenshubetsu_area', '物件種別', 'my_custom_bukkenshubetsu_in', 'fudo', 'advanced' );
}


// 建物名(物件名)
// 物件名公開
// 総戸数・総区画数 物件の総数 (部屋:総戸数 土地:総区画数) 
// 部屋:空部屋の番号 土地:区画番号等
function my_custom_bukkenmei() {
	add_meta_box( 'my_custom_bukkenmei_area', '物件名', 'my_custom_bukkenmei_in', 'fudo', 'advanced' );
}


// 所在地 所在地コード
// 所在地名称
// 所在地詳細_表示部
// 所在地詳細_非表示部
function my_custom_shozaichi() {
	add_meta_box( 'my_custom_shozaichi_area', '所在地', 'my_custom_shozaichi_in', 'fudo', 'advanced' );
}


// 緯度
// 経度
function my_custom_bukkenidokeido() {
	add_meta_box( 'my_custom_bukkenidokeid_area', '地図座標', 'my_custom_bukkenidokeido_in', 'fudo', 'advanced' );
}


// 交通路線1
// 交通駅1
// 交通バス停名
// 交通バス時間1
// 交通徒歩距離1
function my_custom_koutsu1() {
	add_meta_box( 'my_custom_koutsu1_area', '交通1', 'my_custom_koutsu1_in', 'fudo', 'advanced' );
}


// 交通路線2 
// 交通駅2
// 交通バス停名2
// 交通バス時間2 
// 交通徒歩距離2 
function my_custom_koutsu2() {
	add_meta_box( 'my_custom_koutsu2_area', '交通2', 'my_custom_koutsu2_in', 'fudo', 'advanced' );
}


// 交通その他 
function my_custom_koutsusonota() {
	add_meta_box( 'my_custom_koutsusonota_area', '交通 その他交通', 'my_custom_koutsusonota_in', 'fudo', 'advanced' );
}


// 地目
// 用途地域
// 都市計画
// 地勢
// 土地面積計測方式
// 区画面積
// セットバック
// セットバック量
// 建ぺい率
// 容積率
// 接道状況
// 接道方向
// 接道間口
// 接道種別
// 接道幅員
// 位置指定道路
// 土地権利(借地権種類)
// 国土法届出
function my_custom_tochi() {
	add_meta_box( 'my_custom_tochi_area', '土地', 'my_custom_tochi_in', 'fudo', 'advanced' );
}


// 建物構造
// 建物面積計測方式
// 建物面積・専有面積
// 建物階数(地上)
// 建物階数(地下)
// 築年月 
// 新築・未入居
function my_custom_tatemono() {
	add_meta_box( 'my_custom_tatemono_area', '建物構造', 'my_custom_tatemono_in', 'fudo', 'advanced' );
}


// 管理人
// 管理形態
// 管理組合有無
// 管理会社名
function my_custom_kanrininn() {
	add_meta_box( 'my_custom_kanrininn_area', '管理形態', 'my_custom_kanrininn_in', 'fudo', 'advanced' );
}


// 部屋階数 部屋の所在階数 
// バルコニー面積
// 向き
function my_custom_heya() {
	add_meta_box( 'my_custom_heya_area', '部屋', 'my_custom_heya_in', 'fudo', 'advanced' );
}


// 間取部屋数
// 間取部屋種類 
// 間取り備考
function my_custom_madori() {
	add_meta_box( 'my_custom_madori_area', '間取', 'my_custom_madori_in', 'fudo', 'advanced' );
}


// 間取(種類)
// 間取(畳数)
// 間取(所在階)
// 間取(室数)
function my_custom_madorinaiyo() {
	add_meta_box( 'my_custom_madorinaiyo_area', '間取内容', 'my_custom_madorinaiyo_in', 'fudo', 'advanced' );
}


// 備考	URL
function my_custom_targeturl() {
	add_meta_box( 'my_custom_targeturl_area', 'リンクURL', 'my_custom_targeturl_in', 'fudo', 'advanced' );
}

// 社内用メモ
// 分配率(客付分)
// 元付け	名称
// 電話番号
function my_custom_shanaimemo() {
	add_meta_box( 'my_custom_shanaimemo_area', '社内用メモ (非公開)', 'my_custom_shanaimemo_in', 'fudo', 'advanced' );
}


// 賃料・価格
// 税額
// 坪単価
// 共益費・管理費
// 礼金・月数
// 敷金・月数
// 保証金・月数
// 権利金
// 償却・敷引金 
// 満室時表面利回り
// 現行利回り
// 住宅保険料 
// 住宅保険期間 
// 借地料
// 契約期間(年)
// 契約期間(月)	
// 契約期間(区分)
// 修繕積立金
function my_custom_kinsenmen() {
	add_meta_box( 'my_custom_kinsenmen_area', '金銭面', 'my_custom_kinsenmen_in', 'fudo', 'advanced' );
}


// 駐車場料金
// 駐車場区分
function my_custom_chushajo() {
	add_meta_box( 'my_custom_chushajo_area', '駐車場', 'my_custom_chushajo_in', 'fudo', 'advanced' );
}


// 現況
// 引渡/入居時期
// 引渡/入居年月 年月
// 引渡/入居旬 
function my_custom_nyukyo() {
	add_meta_box( 'my_custom_nyukyo_area', '引渡/入居', 'my_custom_nyukyo_in', 'fudo', 'advanced' );
}


// 小学校名
// 中学校名
function my_custom_shuuhen() {
	add_meta_box( 'my_custom_shuuhen_area', '周辺環境', 'my_custom_shuuhen_in', 'fudo', 'advanced' );
}


// 取引態様
function my_custom_torihikitaiyo() {
	add_meta_box( 'my_custom_torihikitaiyo_area', '取引態様', 'my_custom_torihikitaiyo_in', 'fudo', 'advanced' );
}


// 物件画像
function my_custom_gazo() {
	add_meta_box( 'my_custom_gazo_area', '物件画像', 'my_custom_gazo_in', 'fudo', 'advanced' );
}


// 設備・条件
function my_custom_setsubi() {
	add_meta_box( 'my_custom_setsubi_area', '設備・条件', 'my_custom_setsubi_in', 'fudo', 'advanced' );
}


// 特記事項
function my_custom_tokkinotices() {
	add_meta_box( 'my_custom_tokkinotices_area', '特記事項', 'my_custom_tokkinotices_in', 'fudo', 'advanced' );
}

/*
 * csvtype
 *
 * Version: 1.8.0
 */
function my_custom_csvtype_in() {

	global $post;
	global $is_fudourains, $is_fudoucsv, $is_fudouapaman;
	global $is_fudourains_higashi, $is_fudourains_nishi, $is_fudourains_chubu, $is_fudourains_zenkoku;
	global $is_fudoucsv_homes;
	global $is_fudoucsv_c21;

	global $is_fudourims;

	$csvtype_data = get_post_meta($post->ID,'csvtype',true);
	echo '<input type="hidden" name="mycustom_csvtype_name" id="mycustom_csvtype_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';
	echo '<td>';
	echo '<label for="csvtype">CSV TYPE</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="csvtype" id="csvtype">';
	echo '<option value="">無し</option>';

	//ホームズ
	if( $is_fudoucsv_homes || $csvtype_data=="homes" ){ 
		echo '<option value="homes"';  if($csvtype_data=="homes"){  		 echo ' selected="selected"';  }
		echo '>ホームズ</option>';
	}
	//東日本レインズ
	if($is_fudourains_higashi || $csvtype_data=="h_rains" ){ 
		echo '<option value="h_rains"';  if($csvtype_data=="h_rains"){  	 echo ' selected="selected"';  }
		echo '>東日本レインズ</option>';
	}
	//中部レインズ
	if($is_fudourains_chubu || $csvtype_data=="c_rains" ){ 
		echo '<option value="c_rains"';  if($csvtype_data=="c_rains"){  	 echo ' selected="selected"';  }
		echo '>中部レインズ</option>';
	}
	//近畿レインズ新
	if($is_fudourains || $csvtype_data=="k_rains2" ){ 
		echo '<option value="k_rains2"';  if($csvtype_data=="k_rains2"){  	 echo ' selected="selected"';  }
		echo '>近畿レインズ新</option>';
	}
	//西日本レインズ
	if($is_fudourains_nishi || $csvtype_data=="n_rains" ){ 
		echo '<option value="n_rains"';  if($csvtype_data=="n_rains"){  	 echo ' selected="selected"';  }
		echo '>西日本レインズ</option>';
	}
	//全国レインズ
	if($is_fudourains_zenkoku || $csvtype_data=="z_rains" ){ 
		echo '<option value="z_rains"';  if($csvtype_data=="z_rains"){  	 echo ' selected="selected"';  }
		echo '>レインズ</option>';
	}

	//センチュリー21
	if($is_fudoucsv_c21 || $csvtype_data=="c21" ){ 
		echo '<option value="c21"';  if($csvtype_data=="c21"){  		 echo ' selected="selected"';  }
		echo '>センチュリー21</option>';
	}

	//アパマン
	if($is_fudouapaman || $csvtype_data=="apaman" ){ 
		echo '<option value="apaman"';  if($csvtype_data=="apaman"){  	 echo ' selected="selected"';  }
		echo '>アパマン</option>';
	}

	//汎用
	if($is_fudoucsv || $csvtype_data=="fudoucsv" ){ 
		echo '<option value="fudoucsv"';  if($csvtype_data=="fudoucsv"){  	 echo ' selected="selected"';  }
		echo '>汎用</option>';
	}

	//RIMS
	if($is_fudourims || $csvtype_data=="rims" ){ 
		echo '<option value="rims"';  if($csvtype_data=="rims"){  	 echo ' selected="selected"';  }
		echo '>RIMS</option>';
	}

	//他
	if( $csvtype_data != "homes" 
		&& $csvtype_data != "h_rains"
		&& $csvtype_data != "c_rains"
		&& $csvtype_data != "k_rains"
		&& $csvtype_data != "k_rains2"
		&& $csvtype_data != "n_rains"
		&& $csvtype_data != "z_rains"
		&& $csvtype_data != "c21"
		&& $csvtype_data != "apaman"
		&& $csvtype_data != "fudoucsv"
		&& $csvtype_data != "rims"

		&& $csvtype_data != ""
	){

		$fudou_custom_csvtype_in = '<option value="' . $csvtype_data . '" selected="selected">' . $csvtype_data . '</option>';
		echo  apply_filters( 'fudou_custom_csvtype_in', $fudou_custom_csvtype_in, $csvtype_data ) ;
	}
	echo '</select>';
	echo '</td>';
	echo '</tr></table>';
}



//meta
function my_custom_meta_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_meta_name" id="mycustom_meta_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<label for="fudokeywords">keywords 　( テキスト<font color="#ff0000">,</font> 区切り )</label> ';
	echo '<textarea rows="2" cols="60" name="fudokeywords" id="fudokeywords" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'fudokeywords',true)) .'</textarea>';
	echo '<br /><br />';
	echo '<label for="fudodescription">description　( 文章のみ入力してください )</label> ';
	echo '<textarea rows="2" cols="60" name="fudodescription" id="fudodescription" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'fudodescription',true)) .'</textarea>';
}



// 物件番号
function my_custom_shikibesu_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_shikibesu_name" id="mycustom_shikibesu_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';

	// 物件番号
	echo '<td>';
	echo '<label for="shikibesu">物件番号</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="shikibesu" id="shikibesu" value="'.get_post_meta($post->ID,'shikibesu',true).'" size="25" />';
	echo ' <font color="#ff0000">*必須</font>';
	echo '</td>';

	echo '</tr><tr>';

	// 掲載期限日
	echo '<td>';
	echo '<label for="keisaikigenbi">掲載期限日</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="keisaikigenbi" id="keisaikigenbi" value="'.get_post_meta($post->ID,'keisaikigenbi',true).'" size="25" /> (yyyy/mm/ddの形式)';
	echo '</td>';

	echo '</tr><tr>';

	// 成約日
	echo '<td>';
	echo '<label for="seiyakubi">成約日</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="seiyakubi" id="seiyakubi" value="'.get_post_meta($post->ID,'seiyakubi',true).'" size="25" /> (yyyy/mm/ddの形式)';
	echo '</td>';

	echo '</tr></table>';
}



// 自社物
// 状態
function my_custom_koukai_in() {
	global $post;

	echo '<input type="hidden" name="mycustom_koukaijisha_name" id="mycustom_koukaijisha_name"  value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '<table><tr>';
	// 自社物フラグ 0:先物　1:自社物
	echo '<td>';
	echo '<label for="koukaijisha">自社物</label> ';
	echo '</td>';
	echo '<td>';
	echo '<select name="koukaijisha" id="koukaijisha">';
	echo '<option value="">自社物選択</option>';
	echo '<option value="0"';	if(get_post_meta($post->ID,'koukaijisha',true)=="0"){ 	 echo ' selected="selected"';	}
	echo '>先物</option>';
	echo '<option value="1"';	if(get_post_meta($post->ID,'koukaijisha',true)=="1"){ 	 echo ' selected="selected"';	}
	echo '>自社物</option>';
	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';

	// 状態 1:空有/売出中 3:空無/売止 4:成約 9:削除 (1:空有/売出中 の場合に掲載されます)
	$jyoutai_data = get_post_meta($post->ID,'jyoutai',true);
	echo '<td>';
	echo '<label for="jyoutai">空状態</label> ';
	echo '</td>';
	echo '<td>';
	echo '<select name="jyoutai" id="jyoutai">';
	echo '<option value="">選択</option>';
	echo '<option value="1"';	if($jyoutai_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>空有/売出中</option>';
	echo '<option value="3"';	if($jyoutai_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>空無/売止</option>';
	echo '<option value="4"';	if($jyoutai_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>成約</option>';
	echo '<option value="9"';	if($jyoutai_data=="9"){ 	 echo ' selected="selected"';	}
	echo '>削除</option>';


	//空状態   option_in ver5.9.0
	do_action( 'jyoutai_option_in', $jyoutai_data );

	//text
	if($jyoutai_data !='' && !is_numeric($jyoutai_data) && apply_filters( 'jyoutai_option_text', true ) ){
		echo '<option value="'.$jyoutai_data.'" selected="selected">'.$jyoutai_data.'</option>';
	}


	echo '</select>';
	echo '</td>';

	echo '</tr><tr>';

	// 会員 1:会員公開
	echo '<td>';
	echo '<label for="kaiin">会員公開</label> ';
	echo '</td>';
	echo '<td>';
	echo '<select name="kaiin" id="kaiin">';
	echo '<option value="0"';	if(get_post_meta($post->ID,'kaiin',true)=="0"){ 	 echo ' selected="selected"';	}
	echo '>一般公開</option>';
	echo '<option value="1"';	if(get_post_meta($post->ID,'kaiin',true)=="1"){ 	 echo ' selected="selected"';	}
	echo '>会員公開</option>';

	do_action( 'kaiin_level_in' );

	echo '</select>';

	echo '</td>';

	echo '</tr></table>';
}



// 物件種別
function my_custom_bukkenshubetsu_in() {
	global $post;
	global $work_bukkenshubetsu;

	echo '<input type="hidden" name="mycustom_bukkenshubetsu_name" id="mycustom_bukkenshubetsu_name"  value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';
	echo '<td>';
	echo '<label for="bukkenshubetsu">物件種別</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="bukkenshubetsu" id="bukkenshubetsu">';
	echo '<option value="">種別選択</option>';

		$bukkenshubetsu_data = get_post_meta($post->ID,'bukkenshubetsu',true);
		foreach($work_bukkenshubetsu as $meta_box){
			echo '<option value="'.$meta_box['id'].'"';
			if($bukkenshubetsu_data == $meta_box['id'] ) echo ' selected="selected"';
			echo '>'.$meta_box['name'].'</option>';
		}

	echo '</select>';
	echo ' <font color="#ff0000">*必須</font>';
	echo '</td>';
	echo '</tr></table>';
}



// 建物名(物件名)
// 物件名公開
// 総戸数・総区画数 物件の総数 (部屋:総戸数 土地:総区画数) 
// 部屋:空部屋の番号 土地:区画番号等
function my_custom_bukkenmei_in() {
	global $post;
	echo '<input type="hidden"  name="mycustom_bukkenmei_name" id="mycustom_bukkenmei_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';

	// 建物名(物件名)
	echo '<td>';
	echo '<label for="bukkenmei">建物名(物件名)</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="bukkenmei" id="bukkenmei" value="'.get_post_meta($post->ID,'bukkenmei',true).'" size="25" /><br />';
	echo '</td>';

	echo '</tr><tr>';


	// 物件名公開 0:非公開 1:公開 (空物件内容の表示も同時に制御) 2:物件名のみ公開
	echo '<td>';
	echo '<label for="bukkenmeikoukai">物件名公開</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="bukkenmeikoukai" id="bukkenmeikoukai">';
	echo '<option value="">公開選択</option>';
	echo '<option value="1"';  if(get_post_meta($post->ID,'bukkenmeikoukai',true)=="1"){  	 echo ' selected="selected"';  }
	echo '>公開</option>';
	echo '<option value="2"';  if(get_post_meta($post->ID,'bukkenmeikoukai',true)=="2"){  	 echo ' selected="selected"';  }
	echo '>物件名のみ公開</option>';
	echo '<option value="0"';  if(get_post_meta($post->ID,'bukkenmeikoukai',true)=="0"){  	 echo ' selected="selected"';  }
	echo '>非公開</option>';
	echo '</select>';
	echo '</td>';

	echo '</tr><tr>';

	// 空き物件内容 部屋:空部屋の番号 土地:区画番号等
	echo '<td>';
	echo '<label for="bukkennaiyo">部屋番号/区画番号</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="bukkennaiyo" id="bukkennaiyo" value="'.get_post_meta($post->ID,'bukkennaiyo',true).'" size="25" /> (部屋:空部屋の番号 土地:区画番号等)<br />';
	echo '</td>';

	echo '</tr><tr>';

	echo '<td>';
	echo '<hr>';
	echo '</td>';
	echo '<td>';
	echo '<hr>';
	echo '</td>';

	echo '</tr><tr>';

	// 総戸数・総区画数 物件の総数 (部屋:総戸数 土地:総区画数)
	echo '<td>';
	echo '<label for="bukkensoukosu">総戸(区画)数</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="bukkensoukosu" id="bukkensoukosu" value="'.get_post_meta($post->ID,'bukkensoukosu',true).'" size="25" /> (部屋:総戸数 土地:総区画数) *非公開対象外<br />';
	echo '</td>';

	echo '</tr></table>';
}



// 所在地コード v5.0.0
function my_custom_shozaichi_in() {
	global $post;
	global $wpdb;

	echo '
		<script language="JavaScript">
		<!--
		var request;
		var getsite="../wp-content/plugins/fudou/json/";
		var syoki1="県を選択してください";
		var syoki2="市区を選択してください";

		function STiku(slct) {
			//var postDat = encodeURI("shozaichiken="+document.post.shozaichiken.options[slct.selectedIndex].value);
			var postDat = encodeURI("shozaichiken="+document.getElementById("shozaichiken").options[slct.selectedIndex].value);

			// request = new ActiveXObject("Microsoft.XMLHTTP");
			request = new XMLHttpRequest();
			request.open("POST", getsite+"jsonshiku.php", true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
			request.send(postDat);
			request.onreadystatechange = function() {
				if (request.readyState == 4 && request.status == 200) {
					var id = null;
					var name = null;
					var val = null;
					shozaichicodecrea();
					var jsDat = request.responseText;
					var data = eval("("+jsDat+")");
					if (data.shiku.length>0) {
						//document.post.shozaichicode.options[0]=new Option(syoki2,"0",false,false);
						document.getElementById("shozaichicode").options[0]=new Option(syoki2,"0",false,false);
					}else{
						//document.post.shozaichicode.options[0]=new Option(syoki1,"0",false,false);
						document.getElementById("shozaichicode").options[0]=new Option(syoki1,"0",false,false);
					}
					for(var i=0; i<data.shiku.length; i++) {
						id = data.shiku[i].id;
						name = data.shiku[i].name;
						val = false;
						//document.post.shozaichicode.options[i+1] = new Option(name,id,false,val);
						document.getElementById("shozaichicode").options[i+1] = new Option(name,id,false,val);
					}
				}
			}
		}
		function shozaichicodecrea(){
			//var cnt = document.post.shozaichicode.length;
			var cnt = document.getElementById("shozaichicode").length;
			for(var i=cnt; i>=0; i--) {
				//document.post.shozaichicode.options[i] = null;
				document.getElementById("shozaichicode").options[i] = null;
			}
		}
		//-->
		</script>
	';

	echo '<input type="hidden" name="mycustom_shozaichiken_name" id="mycustom_shozaichiken_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$shozaichiken_data = get_post_meta($post->ID,'shozaichicode',true);
	$shozaichiken_data = myLeft($shozaichiken_data,2);


	//営業県だけ表示
	$ken_count = 0;
	$shozaichiken_data_e = '0';
	for( $i=1; $i<48 ; $i++ ){
		if( get_option('ken'.$i) != ''){
			$shozaichiken_data_e .= ','.get_option('ken'.$i);
			$ken_count ++;
		}
	}

	if( empty( $shozaichiken_data_e ) ){
		echo '※<a href="options-general.php?page=fudou%2Fadmin%2Fadmin_fudou.php">営業県</a>を設定してください。';
	}

	echo '<table><tr>';
	echo '<td>県・市区</td>';
	echo '<td>';

	if( $ken_count >= 47 ){
		//全ての県表示
		$sql = "SELECT middle_area_id, middle_area_name FROM " . $wpdb->prefix . DB_KEN_TABLE . " ORDER BY middle_area_id";
	}else{
		$sql = "SELECT middle_area_id, middle_area_name FROM " . $wpdb->prefix . DB_KEN_TABLE . " WHERE middle_area_id in ( $shozaichiken_data_e ) ORDER BY middle_area_id";
	}
//	$sql = $wpdb->prepare($sql,'');
	$metas = $wpdb->get_results( $sql, ARRAY_A );
	if(!empty($metas)) {

		echo '<select name="shozaichiken" id="shozaichiken" onchange="STiku(this)">';
		echo '<option value="">県選択</option>';
		foreach ( $metas as $meta ) {
			$meta_id = $meta['middle_area_id'];
			$meta_valu = $meta['middle_area_name'];

			echo '<option value="'.sprintf("%02d",$meta_id).'"';
			if($shozaichiken_data==sprintf("%02d",$meta_id)){ 
			 	 echo ' selected="selected"';
			}
			echo '>'.$meta_valu.'</option>';
		}
		echo '</select>';
	}


	$shozaichicode_data = get_post_meta($post->ID,'shozaichicode',true);
	$shozaichicode_data = myLeft($shozaichicode_data,5);
	$shozaichicode_data = myRight($shozaichicode_data,3);

	if($shozaichiken_data != ""){ 

		$sql = "SELECT narrow_area_id,narrow_area_name FROM " . $wpdb->prefix . DB_SHIKU_TABLE . " WHERE middle_area_id in (".$shozaichiken_data.") ORDER BY narrow_area_id ASC";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );
		if(!empty($metas)) {
			echo '<select name="shozaichicode" id="shozaichicode">';
			echo '<option value="">選択してください</option>';
			foreach ( $metas as $meta ) {
				$meta_id = $meta['narrow_area_id'];
				$meta_valu = $meta['narrow_area_name'];

				echo '<option value="'.$meta_id.'"';
					
				if($shozaichicode_data==$meta_id){ 
				 	 echo ' selected="selected"';
				}
				echo '>'.$meta_valu.'</option>';
			}
			echo '</select>';
		}else{
			echo '<select name="shozaichicode" id="shozaichicode">';
			echo '<option value="">県を選択してください</option>';
			echo '</select>';
		}

	}else{
			echo '<select name="shozaichicode" id="shozaichicode">';
			echo '<option value="">県を選択してください</option>';
			echo '</select>';
	}
	echo ' <font color="#ff0000">*必須</font><br />';

	//町村
	do_action( 'shozaichi_chouson_in' );

	echo '</td>';

	echo '</tr><tr>';

	// 所在地名称
	echo '<td>';
	echo '<label for="shozaichimeisho">所在地名称</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="shozaichimeisho" id="shozaichimeisho" value="'.get_post_meta($post->ID,'shozaichimeisho',true).'" size="25" /> (字・丁目までの所在地詳細文字列)<br />';
	echo '</td>';

	echo '</tr><tr>';

	// 所在地詳細
	echo '<td>';
	echo '<label for="shozaichimeisho2">所在地詳細</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="shozaichimeisho2" id="shozaichimeisho2" value="'.get_post_meta($post->ID,'shozaichimeisho2',true).'" size="25" /> (字・丁目以降の番地・号　非公開)<br />';
	echo '</td>';

	echo '</tr><tr>';

	// 所在地詳細_非表示部
	echo '<td>';
	echo '<label for="shozaichimeisho3">所在地詳細</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="shozaichimeisho3" id="shozaichimeisho3" value="'.get_post_meta($post->ID,'shozaichimeisho3',true).'" size="25" /> (非公開)';
	echo '</td>';
	echo '</tr></table>';
}



// 緯度経度 v1.7.9
function my_custom_bukkenidokeido_in() {

	global $wpdb;
	echo '<input type="hidden" name="mycustom_bukkenido_name" id="mycustom_bukkenido_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	?>
	<!-- #GoogleMap -->
	<script type="text/javascript">

	function update(obj,obj2) {
		window.document.getElementById('bukkenido').value = obj.album;
		window.document.getElementById('bukkenkeido').value = obj2.album2;
	}

	function openSubWindow(url){

		var ken   =  changeSelect('shozaichiken');
		var ciku  =  changeSelect('shozaichicode');

		//var chou  =  document.post.shozaichimeisho.value;
		//var chou2 =  document.post.shozaichimeisho2.value;
		//var chou3 =  document.post.shozaichimeisho3.value;

		var chou  =  document.getElementById('shozaichimeisho').value;
		var chou2 =  document.getElementById('shozaichimeisho2').value;
		var chou3 =  document.getElementById('shozaichimeisho3').value;


		if( ken  == "県選択" ) ken  = '';
		if( ciku == "県を選択してください" ) ciku = '';
		if( ciku == "市区を選択してください" ) ciku = '';
		if( ciku == "選択してください" ) ciku = '';

		url = url + '&ju=' + ken + ciku + chou + chou2 + chou3;

		var sub = window.open( url,'','width=650,height=550,status=0,location=0,resizable=0,scrollbars=1,toolbar=0' );

		sub.focus();
	}

	function closeWithoutAlert(){
		if( document.all ){
			window.opener = true;
		}
		window.close();
	}

	function changeSelect(value){
		var select = document.getElementById(value);
		var options = document.getElementById(value).options;
		return( options.item(select.selectedIndex).innerHTML );
	}
	</script>
	<?php

	// 緯度
	global $post;
	echo '<label for="bukkenido">緯度</label> ';
	echo '<input type="text" name="bukkenido" id="bukkenido" value="'.get_post_meta($post->ID,'bukkenido',true).'" size="25" />';

	// 経度
	echo '　<label for="bukkenkeido">経度</label> ';
	echo '<input type="text" name="bukkenkeido" id="bukkenkeido" value="'.get_post_meta($post->ID,'bukkenkeido',true).'" size="25" />';

	$shozaichicode_data = get_post_meta($post->ID,'shozaichicode',true);

	if($shozaichicode_data != ""){
		$shozaichiken_data = myLeft($shozaichicode_data,2);
		$shozaichicode_data = myLeft($shozaichicode_data,5);
		$shozaichichiku_data = myRight($shozaichicode_data,3);

		$sql = "SELECT MA.middle_area_name, NA.narrow_area_name";
		$sql .= " FROM " . $wpdb->prefix . DB_KEN_TABLE . " AS MA";
		$sql .= " INNER JOIN " . $wpdb->prefix . DB_SHIKU_TABLE . " AS NA ON MA.middle_area_id = NA.middle_area_id";
		$sql .= " WHERE MA.middle_area_id=".$shozaichiken_data." AND NA.narrow_area_id=".$shozaichichiku_data."";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_row( $sql );
		if( !empty($metas )){
			$middle_area_name = $metas->middle_area_name;
			$narrow_area_name = $metas->narrow_area_name;
		}else{
			$middle_area_name = '';
			$narrow_area_name = '';
		}
	}else{
			$middle_area_name = '';
			$narrow_area_name = '';
	}

	$shozaichimeisho = get_post_meta($post->ID,'shozaichimeisho',true);
	$shozaichimeisho2 = get_post_meta($post->ID,'shozaichimeisho2',true);
	$shozaichimei = urlencode($middle_area_name.$narrow_area_name.$shozaichimeisho.$shozaichimeisho2);

	$bukkenido_data = get_post_meta($post->ID,'bukkenido',true);
	$bukkenkeido_data = get_post_meta($post->ID,'bukkenkeido',true);

	//$maps_url = "'../wp-content/plugins/fudou/googlemaps/googlemaps_latlng.php?post_id=".$post->ID."&lat=".$bukkenido_data."&lng=".$bukkenkeido_data."'";
	$maps_url = "'../wp-content/plugins/fudou/googlemaps/googlemaps_latlng.php?post_id=".$post->ID."'";

	echo ' <input type="button" value="座標設定" onclick="openSubWindow('.$maps_url.');">';
}



// 交通路線1
// 交通駅1
// 交通バス停名1
// 交通バス時間1
// 交通徒歩距離1
function my_custom_koutsu1_in() {
	global $post;
	global $wpdb;
	global $is_fudoubus;

	echo '<input type="hidden" name="mycustom_koutsurosen1_name" id="mycustom_koutsurosen1_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

//	$shozaichiken_data = get_post_meta( $post->ID, 'shozaichicode',true );
//	$shozaichiken_data = myLeft( $shozaichiken_data, 2 );

	$shozaichiken_data = '';

	//営業県
	if( $shozaichiken_data=="" ){
		$shozaichiken_data = '0';
		for( $i=1; $i<48 ; $i++ ){
			if( get_option('ken'.$i) != ''){
				$shozaichiken_data .= ','.get_option('ken'.$i);
			}
		}
	}


	echo '
	<script language="JavaScript">
	var request;
	var getsite="../wp-content/plugins/fudou/json/";

	function SEki(slct) {

		var syoki1="路線を選択してください";
		var syoki2="駅を選択してください";

		//var postDat = encodeURI("shozaichiken='. $shozaichiken_data .'") + encodeURI("&koutsurosen="+document.post.koutsurosen1.options[slct.selectedIndex].value);
		var postDat = encodeURI("shozaichiken='. $shozaichiken_data .'") + encodeURI("&koutsurosen=" + document.getElementById("koutsurosen1").options[slct.selectedIndex].value );

		// request = new ActiveXObject("Microsoft.XMLHTTP");
		request = new XMLHttpRequest();
		request.open("POST", getsite+"jsoneki.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
		request.send(postDat);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				var id = null;
				var name = null;
				var val = null;
				ekicodecrea();
				var jsDat = request.responseText;
				var data = eval("("+jsDat+")");
				if (data.eki.length>0) {
					//document.post.koutsueki1.options[0]=new Option(syoki2,"0",false,false);
					document.getElementById("koutsueki1").options[0]=new Option(syoki2,"0",false,false);
				}else{
					//document.post.koutsueki1.options[0]=new Option(syoki1,"0",false,false);
					document.getElementById("koutsueki1").options[0]=new Option(syoki1,"0",false,false);
				}
				for(var i=0; i<data.eki.length; i++) {
					id = data.eki[i].id;
					name = data.eki[i].name;
					val = false;
					//document.post.koutsueki1.options[i+1] = new Option(name,id,false,val);
					document.getElementById("koutsueki1").options[i+1] = new Option(name,id,false,val);
				}
			}
		}
	}
	function ekicodecrea(){
		//var cnt = document.post.koutsueki1.length;
		var cnt = document.getElementById("koutsueki1").length;
		for(var i=cnt; i>=0; i--) {
			//document.post.koutsueki1.options[i] = null;
			document.getElementById("koutsueki1").options[i] = null;
		}
	}
	</script>';


	$koutsurosen_data = get_post_meta($post->ID,'koutsurosen1',true);
	$koutsueki_data   = get_post_meta($post->ID,'koutsueki1',true);

	echo '<table><tr>';

	// 交通路線1  (0：数値4桁 1：数値4桁)
	echo '<td>';
	echo '<label for="koutsurosen1">路線</label> ';
	echo '</td>';

	echo '<td>';

	if( !empty( $shozaichiken_data ) ){ 

		echo '<select name="koutsurosen1" id="koutsurosen1" onchange="SEki(this)">';
		echo '<option value="">路線を選択してください</option>';

		$sql = "SELECT DISTINCT DTR.rosen_id, DTR.rosen_name";
		$sql = $sql . " FROM " . $wpdb->prefix . DB_ROSENKEN_TABLE . " AS DTAR";
		$sql = $sql . " INNER JOIN " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR ON DTAR.rosen_id = DTR.rosen_id";
		$sql = $sql . " WHERE DTAR.middle_area_id in (".$shozaichiken_data.") ";
		$sql = $sql . " ORDER BY DTR.rosen_name";
		//$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );

		if( !empty( $metas ) ) {

			foreach ( $metas as $meta ) {
				$meta_id   = $meta['rosen_id'];
				$meta_valu = $meta['rosen_name'];

				echo '<option value="'.$meta_id.'"';
				if( $koutsurosen_data == $meta_id ){ 
				 	 echo ' selected="selected"';
				}
				echo '>'.$meta_valu.'</option>';
			}
		}
		echo '</select>';

	}else{
		echo '<select name="koutsurosen1" id="koutsurosen1" onchange="SEki(this)">';
		echo '<option value="">路線を選択してください</option>';
		echo '</select>';
	}
	echo '</td>';


	// 交通駅1 (0：数値5桁 1：数値3桁)
	echo '<td>';
	echo '　<label for="koutsueki1">駅</label> ';
	echo '</td>';


	echo '<td>';
	if( !empty( $shozaichiken_data ) && !empty( $koutsurosen_data ) ){

		echo '<select name="koutsueki1" id="koutsueki1">';
		echo '<option value="">駅を選択してください</option>';

		$sql = "SELECT DTS.station_id, DTS.station_name";
		$sql = $sql . " FROM " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS";
		$sql = $sql . " WHERE DTS.rosen_id=".$koutsurosen_data." AND DTS.middle_area_id in (".$shozaichiken_data.")";
		$sql = $sql . " ORDER BY DTS.station_ranking";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );

		if(!empty($metas)) {
			foreach ( $metas as $meta ) {
				$meta_id = $meta['station_id'];
				$meta_valu = $meta['station_name'];

				echo '<option value="'.$meta_id.'"';
				if( $koutsueki_data == $meta_id ){ 
				 	 echo ' selected="selected"';
				}
				echo '>'.$meta_valu.'</option>';
			}
		}
		echo '</select>';

	}else{
			echo '<select name="koutsueki1" id="koutsueki1">';
			echo '<option value="">駅を選択してください</option>';
			echo '</select>';
	}
	echo ' <font color="#ff0000">*</font><br />';
	echo '</td>';
	echo '</tr></table>';


	echo '<table><tr>';

	// 交通徒歩時間 分
	echo '<td>';
	echo '<label for="koutsutoho1f">徒歩時間</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsutoho1f" id="koutsutoho1f" value="'.get_post_meta($post->ID,'koutsutoho1f',true).'" size="5" /> 分 (駅またはバス停からの時間（分)';
	echo '</td>';

	echo '</tr><tr>';

	// 交通徒歩距離1  駅またはバス停からの距離（単位：） 距離＝徒歩時間×80
	echo '<td>';
	echo '<label for="koutsutoho1">徒歩距離</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsutoho1" id="koutsutoho1" value="'.get_post_meta($post->ID,'koutsutoho1',true).'" size="5" /> m (駅またはバス停からの距離（m） 距離＝徒歩時間×80)';
	echo '</td>';
	echo '</tr></table>';

	echo '<br />';


	//バス
	do_action( 'koutsu1_bus_in' );


	echo '<table><tr>';

	// 交通バス停名1  バス乗車時間（バス停からの距離は、徒歩距離に入れる）
	echo '<td>';
	echo '<label for="koutsubusstei1">バス停名</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsubusstei1" id="koutsubusstei1" value="'.get_post_meta($post->ID,'koutsubusstei1',true).'" size="15" /> ';
	if ( $is_fudoubus ) {
		echo '　(バス会社・バス路線・バス停を設定時は非公開)';
	}
	echo '</td>';

	echo '</tr><tr>';

	// 交通バス時間1  単位：分
	echo '<td>';
	echo '<label for="koutsubussfun1">バス乗車時間</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsubussfun1" id="koutsubussfun1" value="'.get_post_meta($post->ID,'koutsubussfun1',true).'" size="5" /> 分';
	echo '</td>';

	echo '</tr><tr>';

	// バス停交通徒歩時間 分
	echo '<td>';
	echo '<label for="koutsutohob1f">バス停徒歩時間</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsutohob1f" id="koutsutohob1f" value="'.get_post_meta($post->ID,'koutsutohob1f',true).'" size="5" /> 分 ';
	echo '</td>';

	echo '</tr></table>';
}



// 交通路線2
// 交通駅2
// 交通バス停名2
// 交通バス時間2
// 交通徒歩距離2
function my_custom_koutsu2_in() {
	global $post;
	global $wpdb;
	global $is_fudoubus;

	echo '<input type="hidden" name="mycustom_koutsurosen2_name" id="mycustom_koutsurosen2_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	//$shozaichiken_data = get_post_meta($post->ID,'shozaichicode',true);
	//$shozaichiken_data = myLeft($shozaichiken_data,2);

	$shozaichiken_data = '';

	//営業県
	if($shozaichiken_data==""){
		$shozaichiken_data = '0';
		for( $i=1; $i<48 ; $i++ ){
			if( get_option('ken'.$i) != ''){
				$shozaichiken_data .= ','.get_option('ken'.$i);
			}
		}
	}


	echo '
	<script language="JavaScript">
	var request;
	var getsite="../wp-content/plugins/fudou/json/";

	function SEki2(slct) {

		var syoki1="路線を選択してください";
		var syoki2="駅を選択してください";

		//var postDat = encodeURI("shozaichiken='. $shozaichiken_data .'") + encodeURI("&koutsurosen="+document.post.koutsurosen2.options[slct.selectedIndex].value);
		var postDat = encodeURI("shozaichiken='. $shozaichiken_data .'") + encodeURI("&koutsurosen="+document.getElementById("koutsurosen2").options[slct.selectedIndex].value);
		// request = new ActiveXObject("Microsoft.XMLHTTP");
		request = new XMLHttpRequest();
		request.open("POST", getsite+"jsoneki.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
		request.send(postDat);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				var id = null;
				var name = null;
				var val = null;
				ekicodecrea2();
				var jsDat = request.responseText;
				var data = eval("("+jsDat+")");
				if (data.eki.length>0) {
					//document.post.koutsueki2.options[0]=new Option(syoki2,"0",false,false);
					document.getElementById("koutsueki2").options[0]=new Option(syoki2,"0",false,false);
				}else{
					//document.post.koutsueki2.options[0]=new Option(syoki1,"0",false,false);
					document.getElementById("koutsueki2").options[0]=new Option(syoki1,"0",false,false);
				}
				for(var i=0; i<data.eki.length; i++) {
					id = data.eki[i].id;
					name = data.eki[i].name;
					val = false;
					//document.post.koutsueki2.options[i+1] = new Option(name,id,false,val);
					document.getElementById("koutsueki2").options[i+1] = new Option(name,id,false,val);
				}
			}
		}
	}
	function ekicodecrea2(){
		//var cnt = document.post.koutsueki2.length;
		var cnt = document.getElementById("koutsueki2").length;
		for(var i=cnt; i>=0; i--) {
			//document.post.koutsueki2.options[i] = null;
			document.getElementById("koutsueki2").options[i] = null;
		}
	}
	</script>';

	$koutsurosen_data = get_post_meta($post->ID,'koutsurosen2',true);
	$koutsueki_data = get_post_meta($post->ID,'koutsueki2',true);

	echo '<table><tr>';

	// 交通路線2  (0：数値4桁 1：数値4桁)
	echo '<td>';
	echo '<label for="koutsurosen2">路線</label> ';
	echo '</td>';

	echo '<td>';


	if( !empty( $shozaichiken_data ) ){ 

		echo '<select name="koutsurosen2" id="koutsurosen2" onchange="SEki2(this)">';
		echo '<option value="">路線を選択してください</option>';

		$sql = "SELECT DISTINCT DTR.rosen_id, DTR.rosen_name";
		$sql = $sql . " FROM " . $wpdb->prefix . DB_ROSENKEN_TABLE . " AS DTAR ";
		$sql = $sql . " INNER JOIN " . $wpdb->prefix . DB_ROSEN_TABLE . " AS DTR ON DTAR.rosen_id = DTR.rosen_id";
		$sql = $sql . " WHERE DTAR.middle_area_id in (".$shozaichiken_data.")";
		$sql = $sql . " ORDER BY DTR.rosen_name";
		//$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );

		if( !empty( $metas ) ) {
			foreach ( $metas as $meta ) {
				$meta_id   = $meta['rosen_id'];
				$meta_valu = $meta['rosen_name'];
				echo '<option value="'.$meta_id.'"';
				if( $koutsurosen_data == $meta_id ){ 
				 	 echo ' selected="selected"';
				}
				echo '>'.$meta_valu.'</option>';
			}
		}
		echo '</select>';
	}else{
		echo '<select name="koutsurosen2" id="koutsurosen2" onchange="SEki2(this)">';
		echo '<option value="">路線を選択してください</option>';
		echo '</select>';
	}
	echo '</td>';



	// 交通駅2  (0：数値5桁 1：数値3桁)
	echo '<td>';
	echo '　<label for="koutsueki2">駅</label> ';
	echo '</td>';

	echo '<td>';
	if( !empty( $shozaichiken_data ) && !empty( $koutsurosen_data ) ){

		echo '<select name="koutsueki2" id="koutsueki2">';
		echo '<option value="">駅を選択してください</option>';

		$sql = "SELECT DTS.station_id, DTS.station_name";
		$sql = $sql . " FROM " . $wpdb->prefix . DB_EKI_TABLE . " AS DTS";
		$sql = $sql . " WHERE DTS.rosen_id=".$koutsurosen_data." AND DTS.middle_area_id in (".$shozaichiken_data.")";
		$sql = $sql . " ORDER BY DTS.station_ranking";
	//	$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql, ARRAY_A );

		if(!empty($metas)) {
			foreach ( $metas as $meta ) {
				$meta_id = $meta['station_id'];
				$meta_valu = $meta['station_name'];
				echo '<option value="'.$meta_id.'"';
				if( $koutsueki_data == $meta_id ){ 
				 	 echo ' selected="selected"';
				}
				echo '>'.$meta_valu.'</option>';
			}
		}
		echo '</select>';

	}else{
			echo '<select name="koutsueki2" id="koutsueki2">';
			echo '<option value="">駅を選択してください</option>';
			echo '</select>';
	}
	echo '</td>';
	echo '</tr></table>';


	echo '<table><tr>';

	// 交通徒歩時間 分
	echo '<td>';
	echo '<label for="koutsutoho2f">徒歩時間</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsutoho2f" id="koutsutoho2f" value="'.get_post_meta($post->ID,'koutsutoho2f',true).'" size="5" /> 分 (駅またはバス停からの時間（分)';
	echo '</td>';

	echo '</tr><tr>';

	// 交通徒歩距離2  駅またはバス停からの距離（単位：） 距離＝徒歩時間×80
	echo '<td>';
	echo '<label for="koutsutoho2">徒歩距離</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsutoho2" id="koutsutoho2" value="'.get_post_meta($post->ID,'koutsutoho2',true).'" size="5" /> m (駅またはバス停からの距離（m） 距離＝徒歩時間×80)';
	echo '</td>';
	echo '</tr></table>';

	echo '<br />';

	//バス
	do_action( 'koutsu2_bus_in' );


	echo '<table><tr>';

	// 交通バス停名2  バス乗車時間（バス停からの距離は、徒歩距離に入れる）
	echo '<td>';
	echo '<label for="koutsubusstei2">バス停名</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsubusstei2" id="koutsubusstei2" value="'.get_post_meta($post->ID,'koutsubusstei2',true).'" size="15" /> ';

	if ( $is_fudoubus ) {
		echo '　(バス会社・バス路線・バス停を設定時は非公開)';
	}

	echo '</td>';

	echo '</tr><tr>';

	// 交通バス時間2  単位：分
	echo '<td>';
	echo '<label for="koutsubussfun2">バス乗車時間</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsubussfun2" id="koutsubussfun2" value="'.get_post_meta($post->ID,'koutsubussfun2',true).'" size="5" /> 分';
	echo '</td>';

	echo '</tr><tr>';

	// バス停交通徒歩時間 分
	echo '<td>';
	echo '<label for="koutsutohob2f">バス停徒歩時間</label> ';
	echo '</td>';
	echo '<td>';
	echo '<input type="text" name="koutsutohob2f" id="koutsutohob2f" value="'.get_post_meta($post->ID,'koutsutohob2f',true).'" size="5" /> 分 ';
	echo '</td>';

	echo '</tr></table>';
}



// 交通その他
function my_custom_koutsusonota_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_koutsusonota_name" id="mycustom_koutsusonota_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '<label for="koutsusonota">その他交通</label> ';
//	echo '<input type="text" name="koutsusonota" value="'.get_post_meta($post->ID,'koutsusonota',true).'" size="50" />';
	echo '<textarea rows="2" cols="60" name="koutsusonota" id="koutsusonota" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'koutsusonota',true)) .'</textarea>';

}



// 地目
// 用途地域
// 都市計画
// 地勢
// 土地面積計測方式
// 区画面積
// セットバック
// セットバック量
// 建ぺい率
// 容積率
// 接道状況
// 接道方向
// 接道間口
// 接道種別
// 接道幅員
// 位置指定道路
// 土地権利(借地権種類)
// 国土法届出
function my_custom_tochi_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_tochichimoku_name" id="mycustom_tochichimoku_name"  value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';

	// 地目 【改REINS】1:宅地 2:田 3:畑 4:山林 5:雑種地 9:その他 10:原野 11:田･畑 (10,11は将来的に廃止) 
	$tochichimoku_data = get_post_meta($post->ID,'tochichimoku',true);
	echo '<td>';
	echo '<label for="tochichimoku">地目</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochichimoku" id="tochichimoku">';
	echo '<option value="">地目選択</option>';
	echo '<option value="1"';	if($tochichimoku_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>宅地</option>';
	echo '<option value="2"';	if($tochichimoku_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>田</option>';
	echo '<option value="3"';	if($tochichimoku_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>畑</option>';
	echo '<option value="4"';	if($tochichimoku_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>山林</option>';
	echo '<option value="5"';	if($tochichimoku_data=="5"){ 	 echo ' selected="selected"';	}
	echo '>雑種地</option>';
	echo '<option value="9"';	if($tochichimoku_data=="9"){ 	 echo ' selected="selected"';	}
	echo '>その他</option>';
	echo '<option value="10"';	if($tochichimoku_data=="10"){ 	 echo ' selected="selected"';	}
	echo '>原野</option>';
	echo '<option value="11"';	if($tochichimoku_data=="11"){ 	 echo ' selected="selected"';	}
	echo '>田･畑</option>';

	//地目区分 option_in ver5.4.0
	do_action( 'tochichimoku_option_in', $tochichimoku_data );

	//for option textdata ver5.4.0
	if( $tochichimoku_data !='' && !is_numeric( $tochichimoku_data ) && apply_filters( 'tochichimoku_option_text', true ) ){
		echo '<option value="'.$tochichimoku_data.'" selected="selected">'.$tochichimoku_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 用途地域 【REINS】1:第一種低層住居専用 2:第二種中高層住居専用 3:第二種住居 4:近隣商業 5:商業 6:準工業 7:工業 8:工業専用 10:第二種低層住居専用 11:第一種中高層住居専用 12:第一種住居 13:準住居 99:無指定	
	// 田園住居地域 v1.9.5
	$tochiyouto_data = get_post_meta($post->ID,'tochiyouto',true);
	echo '<td>';
	echo '<label for="tochiyouto">用途地域</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochiyouto" id="tochiyouto">';
	echo '<option value="">用途地域選択</option>';
	echo '<option value="1"';	if($tochiyouto_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>第一種低層住居専用</option>';
	echo '<option value="2"';	if($tochiyouto_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>第二種中高層住居専用</option>';
	echo '<option value="3"';	if($tochiyouto_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>第二種住居</option>';
	echo '<option value="4"';	if($tochiyouto_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>近隣商業</option>';
	echo '<option value="5"';	if($tochiyouto_data=="5"){ 	 echo ' selected="selected"';	}
	echo '>商業</option>';
	echo '<option value="6"';	if($tochiyouto_data=="6"){ 	 echo ' selected="selected"';	}
	echo '>準工業</option>';
	echo '<option value="7"';	if($tochiyouto_data=="7"){ 	 echo ' selected="selected"';	}
	echo '>工業</option>';
	echo '<option value="8"';	if($tochiyouto_data=="8"){ 	 echo ' selected="selected"';	}
	echo '>工業専用</option>';
	echo '<option value="10"';	if($tochiyouto_data=="10"){ 	 echo ' selected="selected"';	}
	echo '>第二種低層住居専用</option>';
	echo '<option value="11"';	if($tochiyouto_data=="11"){ 	 echo ' selected="selected"';	}
	echo '>第一種中高層住居専用</option>';
	echo '<option value="12"';	if($tochiyouto_data=="12"){ 	 echo ' selected="selected"';	}
	echo '>第一種住居</option>';
	echo '<option value="13"';	if($tochiyouto_data=="13"){ 	 echo ' selected="selected"';	}
	echo '>準住居</option>';

	echo '<option value="田園住居地域"';	if($tochiyouto_data=="田園住居地域"){ 	 echo ' selected="selected"';	}
	echo '>田園住居地域</option>';

	echo '<option value="99"';	if($tochiyouto_data=="99"){ 	 echo ' selected="selected"';	}
	echo '>無指定</option>';

	//用途地域 option_in ver5.4.0
	do_action( 'tochiyouto_option_in', $tochiyouto_data );

	//for option textdata ver5.4.0
	if( $tochiyouto_data !='' && !is_numeric( $tochiyouto_data ) && $tochiyouto_data != "田園住居地域" && apply_filters( 'tochiyouto_option_text', true ) ){
		echo '<option value="'.$tochiyouto_data.'" selected="selected">'.$tochiyouto_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 都市計画 【REINS】1:市街化区域 2:市街化調整区域 3:(非線引き区域)未線引区域 4:都市計画区域外
	$tochikeikaku_data = get_post_meta($post->ID,'tochikeikaku',true);
	echo '<td>';
	echo '<label for="tochikeikaku">都市計画</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochikeikaku" id="tochikeikaku">';
	echo '<option value="">都市計画選択</option>';
	echo '<option value="1"';	if($tochikeikaku_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>市街化区域</option>';
	echo '<option value="2"';	if($tochikeikaku_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>市街化調整区域</option>';
	echo '<option value="3"';	if($tochikeikaku_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>非線引き区域</option>';
	echo '<option value="4"';	if($tochikeikaku_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>都市計画区域外</option>';

	//都市計画 option_in ver5.4.0
	do_action( 'tochikeikaku_option_in', $tochikeikaku_data );

	//for option textdata ver5.4.0
	if( $tochikeikaku_data !='' && !is_numeric( $tochikeikaku_data ) && apply_filters( 'tochikeikaku_option_text', true ) ){
		echo '<option value="'.$tochikeikaku_data.'" selected="selected">'.$tochikeikaku_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 地勢 【REINS】1:平坦 2:高台 3:低地 4:ひな段 5:傾斜地 9:その他
	$tochichisei_data = get_post_meta($post->ID,'tochichisei',true);
	echo '<td>';
	echo '<label for="tochichisei">地勢</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochichisei" id="tochichisei">';
	echo '<option value="">地勢選択</option>';
	echo '<option value="1"';	if($tochichisei_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>平坦</option>';
	echo '<option value="2"';	if($tochichisei_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>高台</option>';
	echo '<option value="3"';	if($tochichisei_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>低地</option>';
	echo '<option value="4"';	if($tochichisei_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>ひな段</option>';
	echo '<option value="5"';	if($tochichisei_data=="5"){ 	 echo ' selected="selected"';	}
	echo '>傾斜地</option>';
	echo '<option value="9"';	if($tochichisei_data=="9"){ 	 echo ' selected="selected"';	}
	echo '>その他</option>';

	//地勢 option_in ver5.4.0
	do_action( 'tochichisei_option_in', $tochichisei_data );

	//for option textdata ver5.4.0
	if( $tochichisei_data !='' && !is_numeric( $tochichisei_data ) && apply_filters( 'tochichisei_option_text', true ) ){
		echo '<option value="'.$tochichisei_data.'" selected="selected">'.$tochichisei_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 土地面積計測方式 【REINS】1:公簿 2:実測
	$tochisokutei_data = get_post_meta($post->ID,'tochisokutei',true);
	echo '<td>';
	echo '<label for="tochisokutei">面積計測方式</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochisokutei" id="tochisokutei">';
	echo '<option value="">面積計測方式選択</option>';
	echo '<option value="1"';	if( $tochisokutei_data  == "1" ){ 	 echo ' selected="selected"';	}
	echo '>公簿</option>';
	echo '<option value="2"';	if( $tochisokutei_data  == "2" ){ 	 echo ' selected="selected"';	}
	echo '>実測</option>';

	//土地面積計測方式 option_in ver5.4.0
	do_action( 'tochisokutei_option_in', $tochisokutei_data );

	//for option textdata ver5.4.0
	if( $tochisokutei_data != '' && !is_numeric( $tochisokutei_data ) && apply_filters( 'tochisokutei_option_text', true ) ){
		echo '<option value="'.$tochisokutei_data .'" selected="selected">'.$tochisokutei_data .'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 土地(区画)面積
	echo '<td>';
	echo '<label for="tochikukaku">土地(区画)面積</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tochikukaku" id="tochikukaku" value="'.get_post_meta($post->ID,'tochikukaku',true).'" size="15" /> ㎡<br />';
	echo '</td>';

	//土地面積in ver5.3.0
	do_action( 'tochi_menseki_in' );

	echo '</tr><tr>';


	// セットバック 1:無 2:有
	echo '<td>';
	echo '<label for="tochisetback">セットバック</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochisetback" id="tochisetback">';
	echo '<option value="">セットバック選択</option>';
	echo '<option value="1"';	if(get_post_meta($post->ID,'tochisetback',true)=="1"){ 	 echo ' selected="selected"';	}
	echo '>無</option>';
	echo '<option value="2"';	if(get_post_meta($post->ID,'tochisetback',true)=="2"){ 	 echo ' selected="selected"';	}
	echo '>有</option>';
	//text
	if(get_post_meta($post->ID,'tochisetback',true) !='' && !is_numeric(get_post_meta($post->ID,'tochisetback',true)) ){
		echo '<option value="'.get_post_meta($post->ID,'tochisetback',true).'" selected="selected">'.get_post_meta($post->ID,'tochisetback',true).'</option>';
	}
	echo '</select><br />';
	echo '</td>';


	echo '</tr><tr>';


	// 私道負担面積 ㎡
	echo '<td>';
	echo '<label for="tochishido">私道負担面積</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tochishido" id="tochishido" value="'.get_post_meta($post->ID,'tochishido',true).'" size="15" /> ㎡<br />';
	echo '</td>';


	echo '</tr><tr>';


	// セットバック量 ㎡
	echo '<td>';
	echo '<label for="tochisetback2">セットバック量</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tochisetback2" id="tochisetback2" value="'.get_post_meta($post->ID,'tochisetback2',true).'" size="15" /> ㎡<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 建ぺい率 %
	echo '<td>';
	echo '<label for="tochikenpei">建ぺい率</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tochikenpei" id="tochikenpei" value="'.get_post_meta($post->ID,'tochikenpei',true).'" size="15" /> %<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 容積率 %
	echo '<td>';
	echo '<label for="tochiyoseki">容積率</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tochiyoseki" id="tochiyoseki" value="'.get_post_meta($post->ID,'tochiyoseki',true).'" size="15" /> %<br />';
	echo '</td>';


	echo '</tr><tr>';


	//接道状況【改REINS】1:一方 2:角地 3:三方 4:四方 5:二方(除角地) 10:接道なし
	echo '<td>';
	$tochisetsudo_data = get_post_meta($post->ID,'tochisetsudo',true);
	echo '<label for="tochisetsudo">接道状況</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochisetsudo" id="tochisetsudo">';
	echo '<option value="">接道状況選択</option>';
	echo '<option value="1"';	if($tochisetsudo_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>一方</option>';
	echo '<option value="2"';	if($tochisetsudo_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>角地</option>';
	echo '<option value="3"';	if($tochisetsudo_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>三方</option>';
	echo '<option value="4"';	if($tochisetsudo_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>四方</option>';
	echo '<option value="5"';	if($tochisetsudo_data=="5"){ 	 echo ' selected="selected"';	}
	echo '>二方(除角地)</option>';
	echo '<option value="10"';	if($tochisetsudo_data=="10"){ 	 echo ' selected="selected"';	}
	echo '>接道なし</option>';
	//text
	if($tochisetsudo_data !='' && !is_numeric($tochisetsudo_data) ){
		echo '<option value="'.$tochisetsudo_data.'" selected="selected">'.$tochisetsudo_data.'</option>';
	}
	echo '</select><br />';
	echo '</td>';


	echo '</tr><tr>';


	// 土地権利(借地権種類) ※ 【改REINS】1:所有権 2:旧法地上 3: 旧法賃借 4:普通地上 5:定期地上 6:普通賃借 7:定期賃借 8:一時使用 21:地上権 22:定期借地 23:賃借権 99:その他 (21,22,23,99は将来的に廃止)	
	echo '<td>';
	$tochikenri_data = get_post_meta($post->ID,'tochikenri',true);
	echo '<label for="tochikenri">土地権利(借地権種類)</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochikenri" id="tochikenri">';
	echo '<option value="">土地権利(借地権種類)選択</option>';
	echo '<option value="1"';	if($tochikenri_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>所有権</option>';
	echo '<option value="2"';	if($tochikenri_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>旧法地上</option>';
	echo '<option value="3"';	if($tochikenri_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>旧法賃借</option>';
	echo '<option value="4"';	if($tochikenri_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>普通地上</option>';
	echo '<option value="5"';	if($tochikenri_data=="5"){ 	 echo ' selected="selected"';	}
	echo '>定期地上</option>';
	echo '<option value="6"';	if($tochikenri_data=="6"){ 	 echo ' selected="selected"';	}
	echo '>普通賃借</option>';
	echo '<option value="7"';	if($tochikenri_data=="7"){ 	 echo ' selected="selected"';	}
	echo '>定期賃借</option>';
	echo '<option value="8"';	if($tochikenri_data=="8"){ 	 echo ' selected="selected"';	}
	echo '>一時使用</option>';
	echo '<option value="21"';	if($tochikenri_data=="21"){ 	 echo ' selected="selected"';	}
	echo '>地上権</option>';
	echo '<option value="22"';	if($tochikenri_data=="22"){ 	 echo ' selected="selected"';	}
	echo '>定期借地</option>';
	echo '<option value="23"';	if($tochikenri_data=="23"){ 	 echo ' selected="selected"';	}
	echo '>賃借権</option>';
	echo '<option value="99"';	if($tochikenri_data=="99"){ 	 echo ' selected="selected"';	}
	echo '>その他</option>';

	//土地権利 option_in ver5.4.0
	do_action( 'tochikenri_option_in', $tochikenri_data );

	//for option textdata ver5.4.0
	if( $tochikenri_data !='' &&  !is_numeric( $tochikenri_data ) && apply_filters( 'tochikenri_option_text', true ) ){
		echo '<option value="'.$tochikenri_data.'" selected="selected">'.$tochikenri_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 国土法届出	【REINS】1:要 2: 届出中 3:不要 
	$tochikokudohou_data = get_post_meta( $post->ID,'tochikokudohou', true );
	echo '<td>';
	echo '<label for="tochikokudohou">国土法届出</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochikokudohou" id="tochikokudohou">';
	echo '<option value="">国土法届出選択</option>';
	echo '<option value="1"';	if($tochikokudohou_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>要</option>';
	echo '<option value="2"';	if($tochikokudohou_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>届出中</option>';
	echo '<option value="3"';	if($tochikokudohou_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>不要</option>';

	//国土法届出 option_in ver5.4.0
	do_action( 'tochikokudohou_option_in', $tochikokudohou_data );

	//for option textdata ver5.4.0
	if( $tochikokudohou_data != '' &&  !is_numeric( $tochikokudohou_data ) && apply_filters( 'tochikokudohou_option_text', true ) ){
		echo '<option value="'.$tochikokudohou_data.'" selected="selected">'.$tochikokudohou_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';

	echo '<td>　';
	echo '</td>';

	echo '</tr><tr>';



	//接道方向1	1:北 2:北東 3:東 4:南東 5:南 6:南西 7:西 8:北西
	echo '<td>';
	$tochisetsudohouko1_data = get_post_meta($post->ID,'tochisetsudohouko1',true);
	echo '<label for="tochisetsudohouko1">接道方向1</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochisetsudohouko1" id="tochisetsudohouko1">';
	echo '<option value="">接道方向1選択</option>';
	echo '<option value="1"';	if($tochisetsudohouko1_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>北</option>';
	echo '<option value="2"';	if($tochisetsudohouko1_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>北東</option>';
	echo '<option value="3"';	if($tochisetsudohouko1_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>東</option>';
	echo '<option value="4"';	if($tochisetsudohouko1_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>南東</option>';
	echo '<option value="5"';	if($tochisetsudohouko1_data=="5"){ 	 echo ' selected="selected"';	}
	echo '>南</option>';
	echo '<option value="6"';	if($tochisetsudohouko1_data=="6"){ 	 echo ' selected="selected"';	}
	echo '>南西</option>';
	echo '<option value="7"';	if($tochisetsudohouko1_data=="7"){ 	 echo ' selected="selected"';	}
	echo '>西</option>';
	echo '<option value="8"';	if($tochisetsudohouko1_data=="8"){ 	 echo ' selected="selected"';	}
	echo '>北西</option>';
	//text
	if($tochisetsudohouko1_data !='' &&  !is_numeric($tochisetsudohouko1_data) ){
		echo '<option value="'.$tochisetsudohouko1_data.'" selected="selected">'.$tochisetsudohouko1_data.'</option>';
	}
	echo '</select><br />';
	echo '</td>';


	echo '</tr><tr>';


	// 接道間口1	単位:m 
	echo '<td>';
	echo '<label for="tochisetsudomaguchi1">接道間口1</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tochisetsudomaguchi1" id="tochisetsudomaguchi1" value="'.get_post_meta($post->ID,'tochisetsudomaguchi1',true).'" size="15" /> m<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 接道種別1	1:公道 2:私道 
	echo '<td>';
	$tochisetsudoshurui1_data = get_post_meta($post->ID,'tochisetsudoshurui1',true);
	echo '<label for="tochisetsudoshurui1">接道種別1</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochisetsudoshurui1" id="tochisetsudoshurui1">';
	echo '<option value="">接道種別1選択</option>';
	echo '<option value="1"';
	if($tochisetsudoshurui1_data=="1"){ 
	 echo ' selected="selected"';
	}
	echo '>公道</option>';
	echo '<option value="2"';
	if($tochisetsudoshurui1_data=="2"){ 
	 echo ' selected="selected"';
	}
	echo '>私道</option>';
	//text
	if($tochisetsudoshurui1_data !='' &&  !is_numeric($tochisetsudoshurui1_data) ){
		echo '<option value="'.$tochisetsudoshurui1_data.'" selected="selected">'.$tochisetsudoshurui1_data.'</option>';
	}
	echo '</select><br />';
	echo '</td>';


	echo '</tr><tr>';


	// 接道幅員1	単位:m 
	echo '<td>';
	echo '<label for="tochisetsudofukuin1">接道幅員1</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tochisetsudofukuin1" id="tochisetsudofukuin1" value="'.get_post_meta($post->ID,'tochisetsudofukuin1',true).'" size="15" /> m<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 位置指定道路1	1:位置指定道路
	echo '<td>';
	$tochisetsudoichishitei1_data = get_post_meta($post->ID,'tochisetsudoichishitei1',true);
	echo '<label for="tochisetsudoichishitei1">位置指定道路1</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochisetsudoichishitei1" id="tochisetsudoichishitei1">';
	echo '<option value="">位置指定道路選択</option>';
	echo '<option value="1"';	if($tochisetsudoichishitei1_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>位置指定道路</option>';
	echo '<option value="2"';	if($tochisetsudoichishitei1_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>無</option>';
	//text
	if($tochisetsudoichishitei1_data !='' &&  !is_numeric($tochisetsudoichishitei1_data) ){
		echo '<option value="'.$tochisetsudoichishitei1_data.'" selected="selected">'.$tochisetsudoichishitei1_data.'</option>';
	}
	echo '</select><br />';
	echo '</td>';


	echo '</tr><tr>';


	// 接道方向2	1:北 2:北東 3:東 4:南東 5:南 6:南西 7:西 8:北西
	echo '<td>';
	$tochisetsudohouko2_data = get_post_meta($post->ID,'tochisetsudohouko2',true);
	echo '<label for="tochisetsudohouko2">接道方向2</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochisetsudohouko2" id="tochisetsudohouko2">';
	echo '<option value="">接道方向2選択</option>';
	echo '<option value="1"';	if($tochisetsudohouko2_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>北</option>';
	echo '<option value="2"';	if($tochisetsudohouko2_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>北東</option>';
	echo '<option value="3"';	if($tochisetsudohouko2_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>東</option>';
	echo '<option value="4"';	if($tochisetsudohouko2_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>南東</option>';
	echo '<option value="5"';	if($tochisetsudohouko2_data=="5"){ 	 echo ' selected="selected"';	}
	echo '>南</option>';
	echo '<option value="6"';	if($tochisetsudohouko2_data=="6"){ 	 echo ' selected="selected"';	}
	echo '>南西</option>';
	echo '<option value="7"';	if($tochisetsudohouko2_data=="7"){ 	 echo ' selected="selected"';	}
	echo '>西</option>';
	echo '<option value="8"';	if($tochisetsudohouko2_data=="8"){ 	 echo ' selected="selected"';	}
	echo '>北西</option>';
	//text
	if($tochisetsudohouko2_data !='' &&  !is_numeric($tochisetsudohouko2_data) ){
		echo '<option value="'.$tochisetsudohouko2_data.'" selected="selected">'.$tochisetsudohouko2_data.'</option>';
	}
	echo '</select><br />';
	echo '</td>';


	echo '</tr><tr>';


	// 接道間口2	単位:m
	echo '<td>';
	echo '<label for="tochisetsudomaguchi2">接道間口2</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tochisetsudomaguchi2" id="tochisetsudomaguchi2" value="'.get_post_meta($post->ID,'tochisetsudomaguchi2',true).'" size="15" /> m<br />';
	echo '</td>';

	echo '</tr><tr>';


	// 接道種別2	1:公道 2:私道
	echo '<td>';
	$tochisetsudoshurui2_data = get_post_meta($post->ID,'tochisetsudoshurui2',true);
	echo '<label for="tochisetsudoshurui2">接道種別2</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochisetsudoshurui2" id="tochisetsudoshurui2">';
	echo '<option value="">接道種別2選択</option>';
	echo '<option value="1"';	if($tochisetsudoshurui2_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>公道</option>';
	echo '<option value="2"';	if($tochisetsudoshurui2_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>私道</option>';
	//text
	if($tochisetsudoshurui2_data !='' &&  !is_numeric($tochisetsudoshurui2_data) ){
		echo '<option value="'.$tochisetsudoshurui2_data.'" selected="selected">'.$tochisetsudoshurui2_data.'</option>';
	}
	echo '</select><br />';
	echo '</td>';


	echo '</tr><tr>';


	// 接道幅員2	単位:m 
	echo '<td>';
	echo '<label for="tochisetsudofukuin2">接道幅員2</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tochisetsudofukuin2" id="tochisetsudofukuin2" value="'.get_post_meta($post->ID,'tochisetsudofukuin2',true).'" size="15" /> m<br />';
	echo '</td>';

	echo '</tr><tr>';


	// 位置指定道路2	1:位置指定道路 
	echo '<td>';
	$tochisetsudoichishitei2_data = get_post_meta($post->ID,'tochisetsudoichishitei2',true);
	echo '<label for="tochisetsudoichishitei2">位置指定道路2</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tochisetsudoichishitei2" id="tochisetsudoichishitei2">';
	echo '<option value="">位置指定道路2選択</option>';
	echo '<option value="1"';	if($tochisetsudoichishitei2_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>位置指定道路</option>';
	echo '<option value="2"';	if($tochisetsudoichishitei2_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>無</option>';
	//text
	if($tochisetsudoichishitei2_data !='' &&  !is_numeric($tochisetsudoichishitei2_data) ){
		echo '<option value="'.$tochisetsudoichishitei2_data.'" selected="selected">'.$tochisetsudoichishitei2_data.'</option>';
	}
	echo '</select><br />';
	echo '</td>';

	echo '</tr></table>';
}



// 建物構造
// 建物面積計測方式
// 建物面積・専有面積
// 建物階数(地上)
// 建物階数(地下)
// 築年月 
// 新築・未入居
function my_custom_tatemono_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_tatemonokozo_name" id="mycustom_tatemonokozo_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';

	// 建物構造【改REINS】1:木造 2:ブロック 3:鉄骨造 4:RC 5:SRC 6:PC 7:HPC 9:その他 10:軽量鉄骨 11:ALC 12:鉄筋ブロック 13:CFT(コンクリート充填鋼管) 
	$tatemonokozo_data = get_post_meta( $post->ID, 'tatemonokozo',true );
	echo '<td>';
	echo '<label for="tatemonokozo">建物構造</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tatemonokozo" id="tatemonokozo">';
	echo '<option value="">建物構造選択</option>';
	echo '<option value="1"';	if($tatemonokozo_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>木造</option>';
	echo '<option value="2"';	if($tatemonokozo_data=="2"){ 	 echo ' selected="selected"';	}
	echo '>ブロック</option>';
	echo '<option value="3"';	if($tatemonokozo_data=="3"){ 	 echo ' selected="selected"';	}
	echo '>鉄骨造</option>';
	echo '<option value="4"';	if($tatemonokozo_data=="4"){ 	 echo ' selected="selected"';	}
	echo '>RC</option>';
	echo '<option value="5"';	if($tatemonokozo_data=="5"){ 	 echo ' selected="selected"';	}
	echo '>SRC</option>';
	echo '<option value="6"';	if($tatemonokozo_data=="6"){ 	 echo ' selected="selected"';	}
	echo '>PC</option>';
	echo '<option value="7"';	if($tatemonokozo_data=="7"){ 	 echo ' selected="selected"';	}
	echo '>HPC</option>';
	echo '<option value="9"';	if($tatemonokozo_data=="9"){ 	 echo ' selected="selected"';	}
	echo '>その他</option>';
	echo '<option value="10"';	if($tatemonokozo_data=="10"){  echo ' selected="selected"';	}
	echo '>軽量鉄骨</option>';
	echo '<option value="11"';	if($tatemonokozo_data=="11"){  echo ' selected="selected"';	}
	echo '>ALC</option>';
	echo '<option value="12"';	if($tatemonokozo_data=="12"){  echo ' selected="selected"';	}
	echo '>鉄筋ブロック</option>';
	echo '<option value="13"';	if($tatemonokozo_data=="13"){  echo ' selected="selected"';	}
	echo '>CFT(コンクリート充填鋼管)</option>';

	//建物構造 option_in ver5.4.0
	do_action( 'tatemonokozo_option_in', $tatemonokozo_data );

	//for option textdata ver5.4.0
	if( $tatemonokozo_data  !='' && !is_numeric( $tatemonokozo_data ) && apply_filters( 'tatemonokozo_option_text', true ) ){
		echo '<option value="' . $tatemonokozo_data . '" selected="selected">' . $tatemonokozo_data . '</option>';
	}

	echo '</select>';

	//建物構造in ver5.4.0
	do_action( 'tatemonokozo_in' );

	echo '</td>';
	echo '</tr>';


	echo '<tr>';

	// 建物面積計測方式 【REINS】1:壁芯 2:内法
	$tatemonohosiki_data = get_post_meta($post->ID,'tatemonohosiki',true);
	echo '<td>';
	echo '<label for="tatemonohosiki">建物面積計測方式</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tatemonohosiki" id="tatemonohosiki">';
	echo '<option value="">建物面積計測方式選択</option>';
	echo '<option value="1"';	if($tatemonohosiki_data=="1"){  echo ' selected="selected"';	}
	echo '>壁芯</option>';
	echo '<option value="2"';	if($tatemonohosiki_data=="2"){  echo ' selected="selected"';	}
	echo '>内法</option>';

	//建物面積計測方式  option_in ver5.4.0
	do_action( 'tatemonohosiki_option_in', $tatemonohosiki_data );

	//for option textdata ver5.4.0
	if( $tatemonohosiki_data != '' &&  !is_numeric( $tatemonohosiki_data ) && apply_filters( 'tatemonohosiki_option_text', true ) ){
		echo '<option value="'.$tatemonohosiki_data.'" selected="selected">'.$tatemonohosiki_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 建物面積・専有面積
	echo '<td>';
	echo '<label for="tatemonomenseki">建物面積・専有面積</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tatemonomenseki" id="tatemonomenseki" value="'.get_post_meta($post->ID,'tatemonomenseki',true).'" size="15" /> ㎡';
	echo ' <font color="#ff0000">*</font><br />';
	echo '</td>';

	//専有面積in ver5.3.0
	do_action( 'senyu_menseki_in' );

	echo '</tr><tr>';


	// 敷地全体面積
	echo '<td>';
	echo '<label for="tatemonozentaimenseki">敷地全体面積</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tatemonozentaimenseki" id="tatemonozentaimenseki" value="'.get_post_meta($post->ID,'tatemonozentaimenseki',true).'" size="15" /> ㎡<br />';
	echo '</td>';

	//敷地全体面積in ver5.3.2
	do_action( 'zentai_menseki_in' );

	echo '</tr><tr>';


	// 延べ床面積
	echo '<td>';
	echo '<label for="tatemononobeyukamenseki">延べ床面積</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tatemononobeyukamenseki" id="tatemononobeyukamenseki" value="'.get_post_meta($post->ID,'tatemononobeyukamenseki',true).'" size="15" /> ㎡<br />';
	echo '</td>';


	//延べ床面積in ver5.3.2
	do_action( 'nobeyuka_menseki_in' );

	echo '</tr><tr>';


	// 建築面積
	echo '<td>';
	echo '<label for="tatemonokentikumenseki">建築面積</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tatemonokentikumenseki" id="tatemonokentikumenseki" value="'.get_post_meta($post->ID,'tatemonokentikumenseki',true).'" size="15" /> ㎡<br />';
	echo '</td>';

	//建築面積in ver5.3.2
	do_action( 'kentiku_menseki_in' );

	echo '</tr><tr>';


	// 建物階数(地上)
	echo '<td>';
	echo '<label for="tatemonokaisu1">建物階数(地上)</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tatemonokaisu1" id="tatemonokaisu1" value="'.get_post_meta($post->ID,'tatemonokaisu1',true).'" size="5" /> 階';
	echo '</td>';


	echo '</tr><tr>';


	// 建物階数(地下) 
	echo '<td>';
	echo '<label for="tatemonokaisu2">建物階数(地下)</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tatemonokaisu2" id="tatemonokaisu2" value="'.get_post_meta($post->ID,'tatemonokaisu2',true).'" size="5" /> 階';
	echo '</td>';


	echo '</tr><tr>';

	// 築年月
	echo '<td>';
	echo '<label for="tatemonochikunenn">築年月</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="tatemonochikunenn" id="tatemonochikunenn" value="'.get_post_meta($post->ID,'tatemonochikunenn',true).'" size="15" /> (yyyy/mm 形式) 昭和60年=1985 平成1年=1989 令和1年=2019<br />';
	echo '</td>';


	echo '</tr><tr>';

	// 新築・未入居フラグ 0:中古 1:新築・未入居
	$tatemonoshinchiku_data = get_post_meta($post->ID,'tatemonoshinchiku',true);
	echo '<td>';
	echo '<label for="tatemonoshinchiku">新築・未入居</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="tatemonoshinchiku" id="tatemonoshinchiku">';
	echo '<option value="">新築・未入居選択</option>';
	echo '<option value="0"';	if($tatemonoshinchiku_data=="0"){ 	 echo ' selected="selected"';	}
	echo '>中古</option>';
	echo '<option value="1"';	if($tatemonoshinchiku_data=="1"){ 	 echo ' selected="selected"';	}
	echo '>新築・未入居</option>';

	//新築・未入居フラグ  option_in ver5.4.0
	do_action( 'tatemonoshinchiku_option_in', $tatemonoshinchiku_data );

	//for option textdata ver5.4.0
	if( $tatemonoshinchiku_data != '' &&  !is_numeric( $tatemonoshinchiku_data ) && apply_filters( 'tatemonoshinchiku_option_text', true ) ){
		echo '<option value="'.$tatemonoshinchiku_data.'" selected="selected">'.$tatemonoshinchiku_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr></table>';
}



// 管理人
// 管理形態
// 管理組合有無
// 管理会社名
function my_custom_kanrininn_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_kanrininn_name" id="mycustom_kanrininn_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';

	// 管理人 1:常駐 2:日勤 3:巡回 4:無 5:非常駐
	$kanrininn_data = get_post_meta($post->ID,'kanrininn',true);
	echo '<td>';
	echo '<label for="kanrininn">管理人</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="kanrininn" id="kanrininn">';
	echo '<option value="">管理人選択</option>';
	echo '<option value="1"';	if($kanrininn_data=="1"){  echo ' selected="selected"';	}
	echo '>常駐</option>';
	echo '<option value="2"';	if($kanrininn_data=="2"){  echo ' selected="selected"';	}
	echo '>日勤</option>';
	echo '<option value="3"';	if($kanrininn_data=="3"){  echo ' selected="selected"';	}
	echo '>巡回</option>';
	echo '<option value="4"';	if($kanrininn_data=="4"){  echo ' selected="selected"';	}
	echo '>無</option>';
	echo '<option value="5"';	if($kanrininn_data=="5"){  echo ' selected="selected"';	}
	echo '>非常駐</option>';

	//管理人 option_in ver5.4.0
	do_action( 'kanrininn_option_in', $kanrininn_data );

	//for option textdata ver5.4.0
	if( $kanrininn_data != '' &&  !is_numeric( $kanrininn_data ) && apply_filters( 'kanrininn_option_text', true ) ){
		echo '<option value="'.$kanrininn_data.'" selected="selected">'.$kanrininn_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 管理形態 【REINS】1:自主管理 2:一部委託 3:全部委託
	echo '<td>';
	$kanrikeitai_data = get_post_meta($post->ID,'kanrikeitai',true);
	echo '<label for="kanrikeitai">管理形態</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="kanrikeitai" id="kanrikeitai">';
	echo '<option value="">管理形態選択</option>';
	echo '<option value="1"';
	if($kanrikeitai_data=="1"){  echo ' selected="selected"';	}
	echo '>自主管理</option>';
	echo '<option value="2"';
	if($kanrikeitai_data=="2"){  echo ' selected="selected"';	}
	echo '>一部委託</option>';
	echo '<option value="3"';
	if($kanrikeitai_data=="3"){  echo ' selected="selected"';	}
	echo '>全部委託</option>';

	//管理形態 option_in ver5.4.0
	do_action( 'kanrikeitai_option_in', $kanrikeitai_data );

	//for option textdata ver5.4.0
	if( $kanrikeitai_data != '' &&  !is_numeric( $kanrikeitai_data ) && apply_filters( 'kanrikeitai_option_text', true ) ){
		echo '<option value="'.$kanrikeitai_data.'" selected="selected">'.$kanrikeitai_data.'</option>';
	}

	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 管理組合有無 1:無 2:有
	$kanrikumiai_data = get_post_meta($post->ID,'kanrikumiai',true);
	echo '<td>';
	echo '<label for="kanrikumiai" id="kanrikumiai">管理組合</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="kanrikumiai">';
	echo '<option value="">管理形態選択</option>';
	echo '<option value="1"';	if($kanrikumiai_data=="1"){  echo ' selected="selected"';	}
	echo '>無</option>';
	echo '<option value="2"';	if($kanrikumiai_data=="2"){  echo ' selected="selected"';	}
	echo '>有</option>';

	//text
	if($kanrikumiai_data !='' &&  !is_numeric($kanrikumiai_data) ){
		echo '<option value="'.$kanrikumiai_data.'" selected="selected">'.$kanrikumiai_data.'</option>';
	}
	echo '</select>';
	echo '</td>';


	echo '</tr><tr>';


	// 管理会社名
	echo '<td>';
	echo '<label for="kanrikaisha">管理会社名</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kanrikaisha" id="kanrikaisha" value="'.get_post_meta($post->ID,'kanrikaisha',true).'" size="50" /> (非公開)';
	echo '</td>';

	echo '</tr></table>';
}


// 部屋階数 部屋の所在階数 
// バルコニー面積
// 向き
function my_custom_heya_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_heyakaisu_name" id="mycustom_heyakaisu_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';

	// 部屋階数 部屋の所在階数 (マイナスの場合は地下)
	echo '<td>';
	echo '<label for="heyakaisu">部屋階数</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="heyakaisu" id="heyakaisu" value="'.get_post_meta($post->ID,'heyakaisu',true).'" size="5" /> 階<br />';
	echo '</td>';


	echo '</tr><tr>';


	// バルコニー面積
	echo '<td>';
	echo '<label for="heyabarukoni">バルコニー面積</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="heyabarukoni" id="heyabarukoni" value="'.get_post_meta($post->ID,'heyabarukoni',true).'" size="5" /> ㎡<br /> ';
	echo '</td>';


	echo '</tr><tr>';


	// 部屋	向き【REINS】1:北 2:北東 3:東 4:南東 5:南 6:南西 7:西 8:北西 
	echo '<td>';
	echo '<label for="heyamuki">部屋・建物向き</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="heyamuki" id="heyamuki">';
	echo '<option value="">部屋・建物向き選択</option>';
	echo '<option value="1"';	if(get_post_meta($post->ID,'heyamuki',true)=="1"){ 	 echo ' selected="selected"';	}
	echo '>北</option>';
	echo '<option value="2"';	if(get_post_meta($post->ID,'heyamuki',true)=="2"){ 	 echo ' selected="selected"';	}
	echo '>北東</option>';
	echo '<option value="3"';	if(get_post_meta($post->ID,'heyamuki',true)=="3"){ 	 echo ' selected="selected"';	}
	echo '>東</option>';
	echo '<option value="4"';	if(get_post_meta($post->ID,'heyamuki',true)=="4"){ 	 echo ' selected="selected"';	}
	echo '>南東</option>';
	echo '<option value="5"';	if(get_post_meta($post->ID,'heyamuki',true)=="5"){ 	 echo ' selected="selected"';	}
	echo '>南</option>';
	echo '<option value="6"';	if(get_post_meta($post->ID,'heyamuki',true)=="6"){ 	 echo ' selected="selected"';	}
	echo '>南西</option>';
	echo '<option value="7"';	if(get_post_meta($post->ID,'heyamuki',true)=="7"){ 	 echo ' selected="selected"';	}
	echo '>西</option>';
	echo '<option value="8"';	if(get_post_meta($post->ID,'heyamuki',true)=="8"){ 	 echo ' selected="selected"';	}
	echo '>北西</option>';
	//text
	if( get_post_meta($post->ID,'heyamuki',true) !='' && !is_numeric(get_post_meta($post->ID,'heyamuki',true)) ){
		echo '<option value="'.get_post_meta($post->ID,'heyamuki',true).'" selected="selected">'.get_post_meta($post->ID,'heyamuki',true).'</option>';
	}
	echo '</select>';
	echo '</td>';

	echo '</tr></table>';
}



// 間取部屋数
// 間取部屋種類 
// 間取り備考
function my_custom_madori_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_madorisu_name" id="mycustom_madorisu_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';

	// 間取部屋数
	echo '<td>';
	echo '<label for="madorisu">間取部屋数</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="madorisu" id="madorisu" value="'.get_post_meta($post->ID,'madorisu',true).'" size="3" /> ';

	// 間取部屋種類 10:R 20:K 25:SK 30:DK 35:SDK 40:LK 45:SLK 50:LDK 55:SLDK
	echo '<select name="madorisyurui" id="madorisyurui">';
	echo '<option value="">間取部屋種類選択</option>';
	echo '<option value="10"';	if(get_post_meta($post->ID,'madorisyurui',true)=="10"){ 	 echo ' selected="selected"';	}
	echo '>R</option>';
	echo '<option value="20"';	if(get_post_meta($post->ID,'madorisyurui',true)=="20"){ 	 echo ' selected="selected"';	}
	echo '>K</option>';
	echo '<option value="25"';	if(get_post_meta($post->ID,'madorisyurui',true)=="25"){ 	 echo ' selected="selected"';	}
	echo '>SK</option>';
	echo '<option value="30"';	if(get_post_meta($post->ID,'madorisyurui',true)=="30"){ 	 echo ' selected="selected"';	}
	echo '>DK</option>';
	echo '<option value="35"';	if(get_post_meta($post->ID,'madorisyurui',true)=="35"){ 	 echo ' selected="selected"';	}
	echo '>SDK</option>';
	echo '<option value="40"';	if(get_post_meta($post->ID,'madorisyurui',true)=="40"){ 	 echo ' selected="selected"';	}
	echo '>LK</option>';
	echo '<option value="45"';	if(get_post_meta($post->ID,'madorisyurui',true)=="45"){ 	 echo ' selected="selected"';	}
	echo '>SLK</option>';
	echo '<option value="50"';	if(get_post_meta($post->ID,'madorisyurui',true)=="50"){ 	 echo ' selected="selected"';	}
	echo '>LDK</option>';
	echo '<option value="55"';	if(get_post_meta($post->ID,'madorisyurui',true)=="55"){ 	 echo ' selected="selected"';	}
	echo '>SLDK</option>';
	echo '"</select>';
	echo ' <font color="#ff0000">*</font><br />';
	echo '</td>';


	echo '</tr><tr>';

	// 間取り備考	madoribiko
	echo '<td>';
	echo '<label for="madoribiko">間取り備考</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="madoribiko" id="madoribiko" value="'.get_post_meta($post->ID,'madoribiko',true).'" size="50" /> ';
	echo '</td>';

	echo '</tr></table>';
}



// 間取(種類) 【改REINS】1:和室 2:洋室 3:DK 4:LDK 5:L 6:D 7:K 9:その他 21:LK 22:LD 23:S
// 間取(畳数)
// 間取(所在階)
// 間取(室数)
function my_custom_madorinaiyo_in() {
	global $post,$work_madorinaiyo;

	echo '<input type="hidden" name="mycustom_madorinaiyo_name" id="mycustom_madorinaiyo_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '　';

	foreach($work_madorinaiyo as $meta_box) {

		$meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);

		if($meta_box_value == "")
		$meta_box_value = $meta_box['std'];

	//	echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
		echo'<label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';

		if('select'==$meta_box['type']){

			echo '<select name="'.$meta_box['name'].'" id="'.$meta_box['name'].'">';
			echo '<option value="">選択</option>';
			echo '<option value="1"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="1"){	echo ' selected="selected"';	}
			echo '>和室</option>';
			echo '<option value="2"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="2"){ 	echo ' selected="selected"';	}
			echo '>洋室</option>';
			echo '<option value="3"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="3"){ 	echo ' selected="selected"';	}
			echo '>DK</option>';
			echo '<option value="4"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="4"){ 	echo ' selected="selected"';	}
			echo '>LDK</option>';
			echo '<option value="5"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="5"){ 	echo ' selected="selected"';	}
			echo '>L</option>';
			echo '<option value="6"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="6"){ 	echo ' selected="selected"';	}
			echo '>D</option>';
			echo '<option value="7"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="7"){	echo ' selected="selected"';	}
			echo '>K</option>';
			echo '<option value="9"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="9"){	echo ' selected="selected"';	}
			echo '>その他</option>';
			echo '<option value="21"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="21"){	echo ' selected="selected"';	}
			echo '>LK</option>';
			echo '<option value="22"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="22"){	echo ' selected="selected"';	}
			echo '>LD</option>';
			echo '<option value="23"'; if(get_post_meta($post->ID, $meta_box['name'], true)=="23"){	echo ' selected="selected"';	}
			echo '>S</option>';
			echo '</select>　';
		}else{
			echo'<input type="text" name="'.$meta_box['name'].'" id="'.$meta_box['name'].'" value="'.$meta_box_value.'" size="5" /> ';
			echo''.$meta_box['description'].'　';
		}
	}
}



// URL
function my_custom_targeturl_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_targeturl_name" id="mycustom_targeturl_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '<label for="targeturl">リンクURL</label> ';
	echo '<input type="text" name="targeturl" id="targeturl" value="'.get_post_meta($post->ID,'targeturl',true).'" size="60" /><br />';
}



// 社内用メモ
// 分配率(客付分)
// 名称
// 電話番号
function my_custom_shanaimemo_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_shanaimemo_name" id="mycustom_shanaimemo_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<label for="shanaimemo">社内用メモ</label> ';
	echo '<textarea rows="4" cols="60" name="shanaimemo" id="shanaimemo" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'shanaimemo',true)) .'</textarea>';

	//ver1.9.6
	do_action( 'shanaimemo_in' );

	echo '<label for="houshoukeitai">報酬形態</label> ';
	echo '<textarea rows="2" cols="60" name="houshoukeitai" id="houshoukeitai" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'houshoukeitai',true)) .'</textarea><br />';

	echo '<table><tr>';

	echo '<td>';
	echo '<label for="motozukemei">元付け 名称</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="motozukemei" id="motozukemei" value="'.get_post_meta($post->ID,'motozukemei',true).'" size="40" /><br />';
	echo '</td>';


	echo '</tr><tr>';

	echo '<td>';
	echo '<label for="motozuketel">元付け 電話番号</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="motozuketel" id="motozuketel" value="'.get_post_meta($post->ID,'motozuketel',true).'" size="40" /><br />';
	echo '</td>';


	echo '</tr><tr>';

	echo '<td>';
	echo '<label for="motozukefax">元付け FAX番号</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="motozukefax" id="motozukefax" value="'.get_post_meta($post->ID,'motozukefax',true).'" size="40" /><br />';
	echo '</td>';
	echo '</tr></table>';
}



// 賃料・価格
// 税額
// 坪単価
// 共益費・管理費
// 礼金・月数
// 敷金・月数
// 保証金・月数
// 権利金
// 償却・敷引金 
// 満室時表面利回り
// 現行利回り
// 住宅保険料 
// 住宅保険期間 
// 借地料
// 契約期間(年)
// 契約期間(月)	
// 契約期間(区分)
// 修繕積立金
function my_custom_kinsenmen_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_kakaku_name" id="mycustom_kakaku_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	echo '<table><tr>';

	// 賃料・価格 ※ 単位：円
	$kakaku_data = get_post_meta($post->ID,'kakaku',true);
	echo '<td>';
	echo '<label for="kakaku">賃料・価格</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakaku" id="kakaku" value="'. $kakaku_data .'" size="15" /> 円 (半角数値)';
	echo ' <font color="#ff0000">*</font><br />';
	echo '</td>';


	//価格in ver5.8.1
	do_action( 'kakaku_in' );


	echo '</tr><tr>';


	// 税額 ※ 単位：円
	echo '<td>';
	echo '<label for="kakakuzei">うち消費税</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakuzei" value="'.get_post_meta($post->ID,'kakakuzei',true).'" size="15" /> 円 (半角数値)';
	echo '</td>';


	//価格in ver5.8.1
	do_action( 'kakakuzei_in' );


	echo '</tr><tr>';


	// 価格公開	0:非公開 1:公開 (投資用物件以外では、常に公開される)
	echo '<td>';
	echo '<label for="kakakukoukai">価格公開</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="kakakukoukai" id="kakakukoukai">';
	echo '<option value="">価格公開</option>';
	echo '<option value="1"';  if(get_post_meta($post->ID,'kakakukoukai',true)=="1"){  	 echo ' selected="selected"';  }
	echo '>公開</option>';
	echo '<option value="0"';  if(get_post_meta($post->ID,'kakakukoukai',true)=="0"){  	 echo ' selected="selected"';  }
	echo '>非公開</option>';
	echo '</select><br />';
	echo '</td>';


	echo '</tr><tr>';


	// 価格状態	1:相談 2:確定 3:入札(投資用物件のみ)
	$kakakujoutai_data = get_post_meta($post->ID,'kakakujoutai',true);
	echo '<td>';
	echo '<label for="kakakujoutai">価格状態</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="kakakujoutai" id="kakakujoutai">';
	echo '<option value="">価格状態(非公開の場合)</option>';
	echo '<option value="1"';  if($kakakujoutai_data=="1"){  	 echo ' selected="selected"';  }
	echo '>相談</option>';
	echo '<option value="2"';  if($kakakujoutai_data=="2"){  	 echo ' selected="selected"';  }
	echo '>確定</option>';
	echo '<option value="3"';  if($kakakujoutai_data=="3"){  	 echo ' selected="selected"';  }
	echo '>入札</option>';

	//価格状態 v1.9.0 管理画面 物件入力
	do_action( 'fudou_add_kakakujoutai_admin_in', $kakakujoutai_data, $post->ID );

	echo '</select><br />';
	echo '</td>';


	echo '</tr><tr>';


	// 坪単価 単位：円
	echo '<td>';
	echo '<label for="kakakutsubo">坪単価</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakutsubo" id="kakakutsubo" value="'.get_post_meta($post->ID,'kakakutsubo',true).'" size="15" /> 円 (半角数値)<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 共益費・管理費 単位：円 
	echo '<td>';
	echo '<label for="kakakukyouekihi">' . apply_filters( 'kakakukyoueki_name', '共益費・管理費' ) . '</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakukyouekihi" id="kakakukyouekihi" value="'.get_post_meta($post->ID,'kakakukyouekihi',true).'" size="15" /> 円 (半角数値)<br />';
	echo '</td>';

	echo '</tr><tr>';


	//共益費・管理費 Fix
	do_action( 'kakakukyoueki_in' );


	// 礼金・月数 ※ 100以上の場合は単位は"円"、それ以外は"ヶ月"
	echo '<td>';
	echo '<label for="kakakureikin">礼金・月数</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakureikin" id="kakakureikin" value="'.get_post_meta($post->ID,'kakakureikin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 敷金・月数 ※ 100以上の場合は単位は"円"、それ以外は"ヶ月"
	echo '<td>';
	echo '<label for="kakakushikikin">敷金・月数</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakushikikin" id="kakakushikikin" value="'.get_post_meta($post->ID,'kakakushikikin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 保証金・月数 ※ 100以上の場合は単位は"円"、それ以外は"ヶ月" 
	echo '<td>';
	echo '<label for="kakakuhoshoukin">保証金・月数</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakuhoshoukin" id="kakakuhoshoukin" value="'.get_post_meta($post->ID,'kakakuhoshoukin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
	echo '</td>';


	echo '</tr><tr>';

	// 権利金 100以上の場合は単位は"円"、それ以外は"ヶ月"
	echo '<td>';
	echo '<label for="kakakukenrikin">権利金</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakukenrikin" id="kakakukenrikin" value="'.get_post_meta($post->ID,'kakakukenrikin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 償却・敷引金 1～99:"ヶ月"、101～200:100を引いて"%" 201以上の場合単位は"円"
	echo '<td>';
	echo '<label for="kakakushikibiki">償却・敷引金</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakushikibiki" id="kakakushikibiki" value="'.get_post_meta($post->ID,'kakakushikibiki',true).'" size="10" /> (1～99:ヶ月、101～200:100を引いて % 、201以上の場合単位は円)<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 更新料	月数 ※ 100以上の場合は単位は"円"、それ以外は"ヶ月"
	echo '<td>';
	echo '<label for="kakakukoushin">更新料</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakukoushin" id="kakakukoushin" value="'.get_post_meta($post->ID,'kakakukoushin',true).'" size="10" /> (100以上の場合は単位は円、それ以外は ヶ月)<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 満室時表面利回り
	echo '<td>';
	echo '<label for="kakakuhyorimawari">満室時表面利回り</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakuhyorimawari" id="kakakuhyorimawari" value="'.get_post_meta($post->ID,'kakakuhyorimawari',true).'" size="10" /> %　　';
	echo '</td>';


	echo '</tr><tr>';

	// 現行利回り
	echo '<td>';
	echo '<label for="kakakurimawari">現行利回り</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakurimawari" id="kakakurimawari" value="'.get_post_meta($post->ID,'kakakurimawari',true).'" size="10" /> %<br />';
	echo '</td>';


	echo '</tr><tr>';

	// 住宅保険料 
	echo '<td>';
	echo '<label for="kakakuhoken">住宅保険料</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakuhoken" id="kakakuhoken" value="'.get_post_meta($post->ID,'kakakuhoken',true).'" size="10" /> 円 (半角数値)  (1:要　9:不要)<br />';
	echo '</td>';


	echo '</tr><tr>';

	// 住宅保険期間 
	echo '<td>';
	echo '<label for="kakakuhokenkikan">住宅保険期間</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakuhokenkikan" id="kakakuhokenkikan" value="'.get_post_meta($post->ID,'kakakuhokenkikan',true).'" size="10" /> 年<br />';
	echo '</td>';


	echo '</tr><tr>';


	// 修繕積立金 売買：マンションのみ　単位：円/
	echo '<td>';
	echo '<label for="kakakutsumitate">修繕積立金</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="kakakutsumitate" id="kakakutsumitate" value="'.get_post_meta($post->ID,'kakakutsumitate',true).'" size="10" /> 円 (売買：マンションのみ) (半角数値)<br />';
	echo '</td>';

	echo '</tr><tr>';

	// 借地料
	echo '<td>';
	echo '<label for="shakuchiryo">借地料</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="shakuchiryo" id="shakuchiryo" value="'.get_post_meta($post->ID,'shakuchiryo',true).'" size="10" /> 円　';
	echo '</td>';


	echo '</tr><tr>';

	// 借地契約期間(年)
	// 借地契約期間(月)	
	echo '<td>';
	echo '<label for="shakuchikikan">借地契約年月</label> ';
	echo '</td>';

	echo '<td>';
	echo '<input type="text" name="shakuchikikan" id="shakuchikikan" value="'.get_post_meta($post->ID,'shakuchikikan',true).'" size="10" /> 年/月<br />';
	echo '</td>';


	echo '</tr><tr>';

	// 契約期間(区分)
	echo '<td>';
	echo '<label for="shakuchikubun">借地契約(区分)</label> ';
	echo '</td>';

	echo '<td>';
	echo '<select name="shakuchikubun" id="shakuchikubun">';
	echo '<option value="">区分選択</option>';
	echo '<option value="1"';  if(get_post_meta($post->ID,'shakuchikubun',true)=="1"){  	 echo ' selected="selected"';  }
	echo '>期限</option>';
	echo '<option value="2"';  if(get_post_meta($post->ID,'shakuchikubun',true)=="2"){  	 echo ' selected="selected"';  }
	echo '>期間</option>';
	//text
	if(get_post_meta($post->ID,'shakuchikubun',true) !='' &&  !is_numeric(get_post_meta($post->ID,'shakuchikubun',true)) ){
		echo '<option value="'.get_post_meta($post->ID,'shakuchikubun',true).'" selected="selected">'.get_post_meta($post->ID,'shakuchikubun',true).'</option>';
	}
	echo '</select><br />';
	echo '</td>';




	//価格他in ver5.8.1
	do_action( 'kakaku_etc_in' );



	echo '</tr></table>';
}



// 駐車場料金
// 駐車場区分
function my_custom_chushajo_in() {

	global $post;

	echo '<input type="hidden" name="mycustom_chushajoryokin_name" id="mycustom_chushajoryokin_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	// 駐車場料金
	echo '<label for="chushajoryokin">駐車場料金</label> ';
	echo '<input type="text" name="chushajoryokin" id="chushajoryokin" value="'.get_post_meta($post->ID,'chushajoryokin',true).'" size="10" /> 円 (半角数値)　';


	// 駐車場区分 【改REINS】1:空有 2:空無 3:近隣 4:無
	$chushajokubun_data = get_post_meta( $post->ID, 'chushajokubun', true );
	echo '<label for="chushajokubun">駐車場区分</label> ';
	echo '<select name="chushajokubun" id="chushajokubun">';
	echo '<option value="">駐車場区分選択</option>';
	echo '<option value="1"';  if( $chushajokubun_data=="1" ){  	 echo ' selected="selected"';  }
	echo '>空有</option>';
	echo '<option value="2"';  if( $chushajokubun_data=="2" ){  	 echo ' selected="selected"';  }
	echo '>空無</option>';
	echo '<option value="3"';  if( $chushajokubun_data=="3" ){  	 echo ' selected="selected"';  }
	echo '>近隣</option>';
	echo '<option value="4"';  if( $chushajokubun_data=="4" ){  	 echo ' selected="selected"';  }
	echo '>無</option>';

	//駐車場区分 option_in ver5.4.0
	do_action( 'chushajokubun_option_in', $chushajokubun_data );

	//for option textdata ver5.4.0
	if( $chushajokubun_data != '' && !is_numeric( $chushajokubun_data ) && apply_filters( 'chushajokubun_option_text', true ) ){
		echo '<option value="' . $chushajokubun_data . '" selected="selected">' . $chushajokubun_data . '</option>';
	}

	echo '</select><br />';


	// 駐車場備考
	echo '<label for="chushajobiko">駐車場備考</label> ';
	echo '<textarea rows="2" cols="60" name="chushajobiko" id="chushajobiko" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'chushajobiko',true)) .'</textarea>';

}

/*
 * 現況
 * 引渡/入居時期
 * 引渡/入居年月 年月
 * 引渡/入居旬 
 *
 * Version: 5.9.1
 */
function my_custom_nyukyo_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_nyukyogenkyo_name" id="mycustom_nyukyogenkyo_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	// 引渡/入居日	現況  【改REINS】(土地)1:更地 2:古屋あり 10:古屋あり更地引渡可    (戸建・マン・外全・外一)1:居住中(居住用物件) 2:空家 3:賃貸中(投資用物件) 4:未完成
	$bukkenshubetsu_data = get_post_meta($post->ID,'bukkenshubetsu',true);
	$nyukyogenkyo_data   = get_post_meta($post->ID,'nyukyogenkyo',true);


	//ロード時の設定 id
	if ( ( $bukkenshubetsu_data < 1200 && $bukkenshubetsu_data > 1000 ) || $bukkenshubetsu_data == 3212  ) {
		//種別設定 土地
		echo '<style>#nyukyogenkyo_tochi{display:inline-block;}#nyukyogenkyo{display:none;}#nyukyogenkyo_none{display:none;}</style>';

		//select name
		$load_name_none  = 'nyukyogenkyo_none';
		$load_name_tochi = 'nyukyogenkyo';
		$load_name	 = 'nyukyogenkyo_none';

	}else{
		if ( !$bukkenshubetsu_data ) {
			//種別設定 無し
			echo '<style>#nyukyogenkyo_tochi{display:none;}#nyukyogenkyo{display:none;}#nyukyogenkyo_none{display:inline-block;}</style>';

			//select name
			$load_name_none  = 'nyukyogenkyo';
			$load_name_tochi = 'nyukyogenkyo_none';
			$load_name	 = 'nyukyogenkyo_none';

		}else{
			//種別設定 土地以外
			echo '<style>#nyukyogenkyo_tochi{display:none;}#nyukyogenkyo{display:inline-block;}#nyukyogenkyo_none{display:none;}</style>';

			//select name
			$load_name_none  = 'nyukyogenkyo_none';
			$load_name_tochi = 'nyukyogenkyo_none';
			$load_name	 = 'nyukyogenkyo';
		}
	}

	echo '<label for="nyukyogenkyo">現況</label> ';

		//種別設定 無し
			echo '<select name="' . $load_name_none . '" id="nyukyogenkyo_none">';
			echo '<option value="">物件種別を選択してください</option>';
			/*
			echo '<option value="">現況選択</option>';
			echo '<option value="1"';  if($nyukyogenkyo_data=="1"){  	 echo ' selected="selected"';  }
			echo '>居住中 (土地の場合:更地)</option>';
			echo '<option value="2"';  if($nyukyogenkyo_data=="2"){  	 echo ' selected="selected"';  }
			echo '>空家 (土地の場合:古屋あり)</option>';
			echo '<option value="3"';  if($nyukyogenkyo_data=="3"){  	 echo ' selected="selected"';  }
			echo '>賃貸中</option>';
			echo '<option value="4"';  if($nyukyogenkyo_data=="4"){  	 echo ' selected="selected"';  }
			echo '>未完成</option>';
			echo '<option value="10"';  if($nyukyogenkyo_data=="10"){  	 echo ' selected="selected"';  }
			echo '>土地の場合:古屋あり(更地引渡可)</option>';

			//for option textdata ver5.4.0
			if( $nyukyogenkyo_data != '' &&  !is_numeric( $nyukyogenkyo_data ) && apply_filters( 'nyukyogenkyo_option_text', true ) ){
				echo '<option value="'.$nyukyogenkyo_data.'" selected="selected">'.$nyukyogenkyo_data.'</option>';
			}
			*/
			echo '</select>　';


		//種別設定 土地

			echo '<select name="' . $load_name_tochi . '" id="nyukyogenkyo_tochi">';
			echo '<option value="">現況選択</option>';
			echo '<option value="1"';  if($nyukyogenkyo_data=="1"){  	 echo ' selected="selected"';  }
			echo '>更地</option>';
			echo '<option value="2"';  if($nyukyogenkyo_data=="2"){  	 echo ' selected="selected"';  }
			echo '>古屋あり</option>';
			echo '<option value="10"';  if($nyukyogenkyo_data=="10"){  	 echo ' selected="selected"';  }
			echo '>古屋あり(更地引渡可)</option>';
			//echo '<option value="3"';  if($nyukyogenkyo_data=="3"){  	 echo ' selected="selected"';  }
			//echo '>賃貸中</option>';

			//現況 option_in ver5.4.0
			do_action( 'nyukyogenkyo_option_in', $nyukyogenkyo_data );

			//for option textdata ver5.4.0
			if( $nyukyogenkyo_data != '' &&  !is_numeric( $nyukyogenkyo_data ) && apply_filters( 'nyukyogenkyo_option_text', true ) ){
				echo '<option value="'.$nyukyogenkyo_data.'" selected="selected">'.$nyukyogenkyo_data.'</option>';
			}

			echo '</select>　';

		//種別設定 土地以外

			echo '<select name="' . $load_name . '" id="nyukyogenkyo">';
			echo '<option value="">現況選択</option>';
			echo '<option value="1"';  if($nyukyogenkyo_data=="1"){  	 echo ' selected="selected"';  }
			echo '>居住中</option>';
			echo '<option value="2"';  if($nyukyogenkyo_data=="2"){  	 echo ' selected="selected"';  }
			echo '>空家</option>';
			echo '<option value="3"';  if($nyukyogenkyo_data=="3"){  	 echo ' selected="selected"';  }
			echo '>賃貸中</option>';
			echo '<option value="4"';  if($nyukyogenkyo_data=="4"){  	 echo ' selected="selected"';  }
			echo '>未完成</option>';

			//現況 option_in ver5.4.0
			do_action( 'nyukyogenkyo_option_in', $nyukyogenkyo_data );

			//for option textdata ver5.4.0
			if( $nyukyogenkyo_data != '' &&  !is_numeric( $nyukyogenkyo_data ) && apply_filters( 'nyukyogenkyo_option_text', true ) ){
				echo '<option value="'.$nyukyogenkyo_data.'" selected="selected">'.$nyukyogenkyo_data.'</option>';
			}

			echo '</select>　';


	//現況 切り替え ver5.9.1
	echo '<script>
	let shubetsu = document.getElementById( "bukkenshubetsu" );
	shubetsu.addEventListener( "change", shubetsuGenkyoChange );
	function shubetsuGenkyoChange(event){
		var bukkenshubetsu_data = event.currentTarget.value;

		if ( ( bukkenshubetsu_data < 1200 && bukkenshubetsu_data > 1000 ) || bukkenshubetsu_data == 3212  ) {
			//種別設定 土地
			document.getElementById( "nyukyogenkyo_none" ).style.display = "none";
			document.getElementById( "nyukyogenkyo_tochi" ).style.display = "inline-block";
			document.getElementById( "nyukyogenkyo" ).style.display = "none";

			document.getElementById( "nyukyogenkyo_none" ).name = "none";
			document.getElementById( "nyukyogenkyo_tochi" ).name = "nyukyogenkyo";
			document.getElementById( "nyukyogenkyo" ).name = "none";
		}else{

			if ( bukkenshubetsu_data == "" ) {
			//種別設定 無し
				document.getElementById( "nyukyogenkyo_none" ).style.display = "inline-block";
				document.getElementById( "nyukyogenkyo_tochi" ).style.display = "none";
				document.getElementById( "nyukyogenkyo" ).style.display = "none";

				document.getElementById( "nyukyogenkyo_none" ).name = "nyukyogenkyo";
				document.getElementById( "nyukyogenkyo_tochi" ).name = "none";
				document.getElementById( "nyukyogenkyo" ).name = "none";

			}else{
			//種別設定 土地以外
				document.getElementById( "nyukyogenkyo_none" ).style.display = "none";
				document.getElementById( "nyukyogenkyo_tochi" ).style.display = "none";
				document.getElementById( "nyukyogenkyo" ).style.display = "inline-block";

				document.getElementById( "nyukyogenkyo_none" ).name = "none";
				document.getElementById( "nyukyogenkyo_tochi" ).name = "none";
				document.getElementById( "nyukyogenkyo" ).name = "nyukyogenkyo";
			};
		};
	};
	</script>';


	// 引渡/入居時期 1:即時 2:相談 3:期日指定
	$nyukyojiki_data = get_post_meta($post->ID,'nyukyojiki',true);
	echo '<label for="nyukyojiki">引渡/入居時期</label> ';
	echo '<select name="nyukyojiki" id="nyukyojiki">';
	echo '<option value="">引渡/入居時期選択</option>';
	echo '<option value="1"';  if($nyukyojiki_data =="1"){  	 echo ' selected="selected"';  }
	echo '>即時</option>';
	echo '<option value="2"';  if($nyukyojiki_data =="2"){  	 echo ' selected="selected"';  }
	echo '>相談</option>';
	echo '<option value="3"';  if($nyukyojiki_data =="3"){  	 echo ' selected="selected"';  }
	echo '>期日指定</option>';

	//引渡/入居日 引渡/入居時期  option_in ver5.9.0
	do_action( 'nyukyojiki_option_in', $nyukyojiki_data );

	//text
	if($nyukyojiki_data !='' && !is_numeric($nyukyojiki_data) && apply_filters( 'nyukyojiki_option_text', true ) ){
		echo '<option value="'.$nyukyojiki_data.'" selected="selected">'.$nyukyojiki_data.'</option>';
	}

	echo '</select><br /> ';


	// 引渡/入居年月 年月（引渡/入居時期で期日指定をした場合のみ) yyyy/mm 形式の文字列
	echo '<br /><label for="nyukyonengetsumain">*引渡/入居時期で期日指定をした場合</label><br /> ';
	echo '<label for="nyukyonengetsu">入居時期</label> ';
	echo '<input type="text" name="nyukyonengetsu" id="nyukyonengetsu" value="'.get_post_meta($post->ID,'nyukyonengetsu',true).'" size="15" /> (yyyy/mm 形式)　';

	// 引渡/入居旬 1:上旬　2:中旬　3:下旬（引渡/入居時期で期日指定をした場合のみ) 
	$nyukyosyun_data = get_post_meta($post->ID,'nyukyosyun',true);
	echo '<label for="nyukyosyun">旬</label> ';
	echo '<select name="nyukyosyun" id="nyukyosyun">';
	echo '<option value="">入居旬選択</option>';
	echo '<option value="1"';  if($nyukyosyun_data=="1"){  	 echo ' selected="selected"';  }
	echo '>上旬</option>';
	echo '<option value="2"';  if($nyukyosyun_data=="2"){  	 echo ' selected="selected"';  }
	echo '>中旬</option>';
	echo '<option value="3"';  if($nyukyosyun_data=="3"){  	 echo ' selected="selected"';  }
	echo '>下旬</option>';

	//引渡/入居旬 option_in ver5.9.0
	do_action( 'nyukyosyun_option_in', $nyukyosyun_data );

	//text
	if($nyukyosyun_data !='' &&  !is_numeric($nyukyosyun_data) && apply_filters( 'nyukyosyun_option_text', true ) ){
		echo '<option value="'.$nyukyosyun_data.'" selected="selected">'.$nyukyosyun_data.'</option>';
	}
	echo '</select><br /> ';
}



// 小学校名
// 中学校名
function my_custom_shuuhen_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_shuuhenshougaku_name" id="mycustom_shuuhenshougaku_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	// 小学校名
	echo '<label for="shuuhenshougaku">小学校名</label> ';
	echo '<input type="text" name="shuuhenshougaku" id="shuuhenshougaku" value="'.get_post_meta($post->ID,'shuuhenshougaku',true).'" size="25" />';
	echo '<br />';

	// 中学校名
	echo '<label for="shuuhenchuugaku">中学校名</label> ';
	echo '<input type="text" name="shuuhenchuugaku" id="shuuhenchuugaku" value="'.get_post_meta($post->ID,'shuuhenchuugaku',true).'" size="25" />';
	echo '<br />';

	// その他周辺環境
	echo '<br /><label for="shuuhensonota">その他周辺環境</label> ';
	echo '<textarea rows="2" cols="60" name="shuuhensonota" id="shuuhensonota" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'shuuhensonota',true)) .'</textarea>';
}



// 取引態様 【改REINS】1:売主/貸主 2:代理 3:専属 4: 専任 5:一般 6:仲介 9:その他
function my_custom_torihikitaiyo_in() {
	global $post;

	$torihikitaiyo_data = get_post_meta($post->ID,'torihikitaiyo',true);
	echo '<input type="hidden" name="mycustom_torihikitaiyo_name" id="mycustom_torihikitaiyo_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '<label for="torihikitaiyo">取引態様</label> ';
	echo '<select name="torihikitaiyo" id="torihikitaiyo">';
	echo '<option value="">取引態様選択</option>';
	echo '<option value="1"';  if($torihikitaiyo_data=="1"){  	 echo ' selected="selected"';  }
	echo '>売主/貸主</option>';
	echo '<option value="2"';  if($torihikitaiyo_data=="2"){  	 echo ' selected="selected"';  }
	echo '>代理</option>';
	echo '<option value="3"';  if($torihikitaiyo_data=="3"){  	 echo ' selected="selected"';  }
	echo '>専属</option>';
	echo '<option value="4"';  if($torihikitaiyo_data=="4"){  	 echo ' selected="selected"';  }
	echo '>専任</option>';
	echo '<option value="5"';  if($torihikitaiyo_data=="5"){  	 echo ' selected="selected"';  }
	echo '>一般</option>';
	echo '<option value="6"';  if($torihikitaiyo_data=="6"){  	 echo ' selected="selected"';  }
	echo '>仲介</option>';
	echo '<option value="9"';  if($torihikitaiyo_data=="9"){  	 echo ' selected="selected"';  }
	echo '>その他</option>';

	//取引態様 option_in ver5.4.0
	do_action( 'torihikitaiyo_option_in', $torihikitaiyo_data );

	//for option textdata ver5.4.0
	if( $torihikitaiyo_data != '' &&  !is_numeric( $torihikitaiyo_data ) && apply_filters( 'torihikitaiyo_option_text', true ) ){
		echo '<option value="'.$torihikitaiyo_data.'" selected="selected">'.$torihikitaiyo_data.'</option>';
	}

	echo '</select>';
}



/*
 * 物件画像サムネイル生成
 *
 * Version: 1.9.2
 *
 * @param str $fudoimg_data FileName
 * @param str $fudoimg_id ImgFileNo
 * @param int $post_id 
 * @param str $css_class class Name
 */
function admin_custom_gazo_pickup( $fudoimg_data , $fudoimg_id, $post_id, $css_class='box3image' ) {

	global $wpdb;

	if( $fudoimg_data ){

		/*
		 * Add url fudoimg_data Pre
		 *
		 * Version: 1.7.12
		 *
		 **/
		$fudoimg_data = apply_filters( 'pre_fudoimg_data_add_url', $fudoimg_data, $post_id );

		//Check URL
		if ( checkurl_fudou( $fudoimg_data )) {
			return '<img  class="' . $css_class . '"  src="' . $fudoimg_data . '" alt="' . $fudoimg_data . '" />';
		}else{
			//Check attachment
			$sql  = "SELECT P.ID,P.guid";
			$sql .= " FROM $wpdb->posts AS P";
			$sql .= " WHERE P.post_type ='attachment' AND P.guid LIKE '%/$fudoimg_data' ";
			//$sql = $wpdb->prepare($sql,'');
			$metas = $wpdb->get_row( $sql );
			$attachmentid = '';
			if ( $metas != '' ){
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
					return '<img class="' . $css_class . '" src="' . $fudoimg_url.'" alt="" />';
				}else{
					return '<img class="' . $css_class . '" src="' . $guid_url .  '" alt="" />';
				}

			}else{
				/*
				 * Add url fudoimg_data
				 *
				 * Version: 1.7.12
				 *
				 **/
				$fudoimg_data = apply_filters( 'fudoimg_data_add_url', $fudoimg_data, $post_id  );

				if ( checkurl_fudou( $fudoimg_data )) {
					return '<img class="' . $css_class . '" src="' . $fudoimg_data . '" alt="" />';
				}else{
					//return '<img class="' . $css_class . '" src="' . WP_PLUGIN_URL . '/fudou/img/nowprinting.jpg" alt="" />';
					return '<img class="' . $css_class . '" src="' . plugins_url() . '/fudou/img/nowprinting.jpg" alt="" />';
				}
			}
		}

	}else{

		if( $fudoimg_id == 'fudoimg1' || $fudoimg_id == 'fudoimg2' ){
			//return '<img class="' . $css_class . '" src="'.WP_PLUGIN_URL.'/fudou/img/nowprinting.jpg" alt="" />';
			return '<img class="' . $css_class . '" src="'.plugins_url().'/fudou/img/nowprinting.jpg" alt="" />';
		}else{

			if( $fudoimg_id == 'kannri_tanto_pic' ){
				//return '<img class="' . $css_class . '" src="'.WP_PLUGIN_URL.'/fudou/img/dare.png" alt="" />';
				return '<img class="' . $css_class . '" src="'.plugins_url().'/fudou/img/dare.png" alt="" />';
			}else{
				//return '<img class="' . $css_class . '" src="'.WP_PLUGIN_URL.'/fudou/img/blank.gif" alt="" />';
				return '<img class="' . $css_class . '" src="'.plugins_url().'/fudou/img/blank.gif" alt="" />';
			}
		}
	}
}



/*
 * 物件画像
 *
 * Version: 1.7.12
 *
 **/
function my_custom_gazo_in() {
	global $post,$work_gazo,$work_gazo2;
	global $wp_version;
	echo '<input type="hidden" name="mycustom_gazo_name" id="mycustom_gazo_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	if( FUDOU_IMG_MAX > 10 ){
		$work_gazo = array_merge($work_gazo, $work_gazo2);
	}

	echo '<table>';
	foreach($work_gazo as $meta_box) {

		$meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);

		//サムネイル
		if($meta_box['std']=="1"){
			echo '<tr>';
			echo '<td rowspan="4">';
			echo '<div id="thumbnail'.$meta_box['name'].'">';
			echo admin_custom_gazo_pickup( $meta_box_value , $meta_box['name'], $post->ID  );
			echo '</div>';
			echo '</td>';
			echo '</tr>';
		}

		//画像タイプ fudoimgtype
		if('select' == $meta_box['type'] ){

			echo '<tr>';
			echo '<td>';
			echo '<label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';
			echo '</td>';

			echo '<td>';
			echo '<select name="'.$meta_box['name'].'" id="'.$meta_box['name'].'">';
			echo '<option value="">選択</option>';

			$img_id = get_post_meta($post->ID, $meta_box['name'], true);

			echo '<option value="1"'; if( $img_id =="1"){ 	 echo ' selected="selected"';	}
			echo '>間取</option>';

			echo '<option value="2"'; if( $img_id =="2"){ 	 echo ' selected="selected"';	}
			echo '>外観</option>';

			echo '<option value="3"'; if( $img_id =="3"){ 	 echo ' selected="selected"';	}
			echo '>地図</option>';

			echo '<option value="4"'; if( $img_id =="4"){ 	 echo ' selected="selected"';	}
			echo '>周辺</option>';

			echo '<option value="5"'; if( $img_id =="5"){ 	 echo ' selected="selected"';	}
			echo '>内装</option>';

			echo '<option value="9"'; if( $img_id =="9"){ 	 echo ' selected="selected"';	}
			echo '>その他画像</option>';

			echo '<option value="10"'; if( $img_id =="10"){  echo ' selected="selected"';	}
			echo '>玄関</option>';

			echo '<option value="11"'; if( $img_id =="11"){  echo ' selected="selected"';	}
			echo '>居間</option>';

			echo '<option value="12"'; if( $img_id =="12"){  echo ' selected="selected"';	}
			echo '>キッチン</option>';

			echo '<option value="13"'; if( $img_id =="13"){  echo ' selected="selected"';	}
			echo '>寝室</option>';

			echo '<option value="14"'; if( $img_id =="14"){  echo ' selected="selected"';	}
			echo '>子供部屋</option>';

			echo '<option value="15"'; if( $img_id =="15"){  echo ' selected="selected"';	}
			echo '>風呂</option>';

			//画像タイプ option_in ver5.4.0
			do_action( 'fudoimgtype_option_in', $img_id );

			//for option textdata ver5.4.0
			if( $img_id && !is_numeric( $img_id ) && apply_filters( 'fudoimgtype_option_text', true ) ){
				echo '<option value="' . $img_id . '"  selected="selected">' . $img_id . '</option>　';
			}

			echo '</select>';
			echo '</td>';
			echo '</tr>';

		}else{
			echo '<tr>';
			echo '<td>';
			echo '<label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>';
			echo '</td>';
			echo '<td>';
			echo '<input type="text" name="'.$meta_box['name'].'" value="'.$meta_box_value.'" size="25" />';
			echo''.$meta_box['description'].'';

			if($meta_box['std']=="1"){
				echo ' '.$meta_box['com'].'　<button id="'.$meta_box['name'].'">画像を設定</button>';
			}
			echo '</td>';
			echo '</tr>';
		}
	}
	echo '</table>';

	echo '<script type="text/javascript">';
	echo 'var image_uploaders = new Array ( ';
		for( $i=1 ; $i<=FUDOU_IMG_MAX ; $i++ ){
			if ( $i>1 ) echo ",";
			echo '"fudoimg' . $i . '"' ;
		}
	echo ');';
	echo '</script>';

}



// 設備・条件	スラッシュ(/) 区切り形式
function my_custom_setsubi_in() {
	global $post,$work_setsubi;
	echo '<input type="hidden" name="mycustom_setsubi_name" id="mycustom_setsubi_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';

	$setsubi_data = get_post_meta($post->ID, 'setsubi', true);
	if($setsubi_data==""){
		$setsubi_data = "99900";
	}
	foreach($work_setsubi as $meta_box){

		//条件
		//if( $meta_box['code'] == "10001") echo "<hr />";
		//キッチン                                    
		if( $meta_box['code'] == "20701") echo "<hr />";
		//バス・トイレ                                
		if( $meta_box['code'] == "21001") echo "<hr />";
		//冷暖房                                      
		if( $meta_box['code'] == "21301") echo "<hr />";
		//収納                                        
		if( $meta_box['code'] == "21401") echo "<hr />";
		//放送・通信                                  
		if( $meta_box['code'] == "21901") echo "<hr />";
		//セキュリティ                                
		if( $meta_box['code'] == "22301") echo "<hr />";
		//ガス水道                                    
		if( $meta_box['code'] == "20101") echo "<hr />";
		//その他                                      
		if( $meta_box['code'] == "22401") echo "<hr />";

		if( strpos($setsubi_data, $meta_box['code']) ){
			echo '<span style="display: inline-block"><input type="checkbox" name="setsubi'.$meta_box['code'].'"  value="/'.$meta_box['code'].'" id="'.$meta_box['code'].'"';
			echo ' checked="checked"';
			echo '>';
			echo '<label for="'.$meta_box['code'].'"><b>'.$meta_box['name'].'</b></label>';
			echo '</span>　';
		}else{
			echo '<span style="display: inline-block"><input type="checkbox" name="setsubi'.$meta_box['code'].'"  value="/'.$meta_box['code'].'" id="'.$meta_box['code'].'"';
			echo '>';
			echo '<label for="'.$meta_box['code'].'">'.$meta_box['name'].'</label>';
			echo '</span>　';
		}

	}
	echo'<br /><br /><label for="setsubisonota">設備・条件 その他</label>';
	echo '<textarea rows="3" cols="60" name="setsubisonota" id="setsubisonota" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'setsubisonota',true)) .'</textarea>';

}



// 特記事項
function my_custom_tokkinotices_in() {
	global $post;
	echo '<input type="hidden" name="mycustom_tokkinotices_name" id="mycustom_tokkinotices_name" value="' .wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
	echo '<label for="tokkinotices">内容</label> ';
	echo '<textarea rows="5" cols="60" name="tokkinotices" id="tokkinotices" style="width:100%" >'. esc_textarea(get_post_meta($post->ID,'tokkinotices',true)) .'</textarea>';
	echo '※改行したい場合は、改行位置に　&lt;br&gt;　と記入してください、';

}













//csvtype v5.7.2
function custom_save_csvtype ( $post_id ) {
	if ( isset($_POST['mycustom_csvtype_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_csvtype_name'], plugin_basename(__FILE__) ) ) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}
		$my_custom_csvtype_data = isset($_POST['csvtype']) ? esc_attr( stripslashes( $_POST['csvtype'] )): '';
		if( strcmp($my_custom_csvtype_data,get_post_meta($post_id, 'csvtype', true)) != 0 )
			update_post_meta($post_id, 'csvtype',$my_custom_csvtype_data);
		elseif($my_custom_csvtype_data == "")
			delete_post_meta($post_id, 'csvtype',get_post_meta($post_id,'csvtype',true));
	}else{
			return $post_id;
	}
}


//meta
function custom_save_meta ( $post_id ) {
	if ( isset($_POST['mycustom_meta_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_meta_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		$my_custom_fudokeywords_data = isset($_POST['fudokeywords']) ? esc_attr( stripslashes( $_POST['fudokeywords'] )): '';
		$my_custom_fudokeywords_data = str_replace( array("\r\n", "\r", "\n"), '', $my_custom_fudokeywords_data );	//改行

		if( strcmp($my_custom_fudokeywords_data,get_post_meta($post_id, 'fudokeywords', true)) != 0 )
			update_post_meta($post_id, 'fudokeywords',$my_custom_fudokeywords_data);
		elseif($my_custom_fudokeywords_data == "")
			delete_post_meta($post_id, 'fudokeywords',get_post_meta($post_id,'fudokeywords',true));


		$my_custom_fudodescription_data = isset($_POST['fudodescription']) ? esc_attr( stripslashes( $_POST['fudodescription'] )) : '';
		$my_custom_fudodescription_data = str_replace( array("\r\n", "\r", "\n"), '', $my_custom_fudodescription_data );	//改行

		if( strcmp($my_custom_fudodescription_data,get_post_meta($post_id, 'fudodescription', true)) != 0 )
			update_post_meta($post_id, 'fudodescription',$my_custom_fudodescription_data);
		elseif($my_custom_fudodescription_data == "")
			delete_post_meta($post_id, 'fudodescription',get_post_meta($post_id,'fudodescription',true));
	}else{
			return $post_id;
	}
}


// 物件番号 v1.7.11
function custom_save_shikibesu ( $post_id ) {
	if ( isset($_POST['mycustom_shikibesu_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_shikibesu_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 自社管理物件番号 v5.7.2
		$my_custom_shikibesu_data = isset($_POST['shikibesu']) ? esc_attr( stripslashes( $_POST['shikibesu'] )): '';
		if( strcmp($my_custom_shikibesu_data,get_post_meta($post_id, 'shikibesu', true)) != 0 )
			update_post_meta($post_id, 'shikibesu', $my_custom_shikibesu_data);

		elseif($my_custom_shikibesu_data=="")
			delete_post_meta($post_id, 'shikibesu',get_post_meta($post_id,'shikibesu',true));


		// 掲載期限日 v5.7.2
		$my_custom_keisaikigenbi_data = isset($_POST['keisaikigenbi']) ? esc_attr( stripslashes( $_POST['keisaikigenbi'] )) : '';
		if( strcmp($my_custom_keisaikigenbi_data,get_post_meta($post_id, 'keisaikigenbi', true)) != 0 )
			update_post_meta($post_id, 'keisaikigenbi',$my_custom_keisaikigenbi_data);
		elseif($my_custom_keisaikigenbi_data == "")
			delete_post_meta($post_id, 'keisaikigenbi',get_post_meta($post_id,'keisaikigenbi',true));

		// 成約日 v5.7.2
		$my_custom_seiyakubi_data = isset($_POST['seiyakubi']) ? esc_attr( stripslashes( $_POST['seiyakubi'] )) : '';
		if( strcmp($my_custom_seiyakubi_data,get_post_meta($post_id, 'seiyakubi', true)) != 0 )
			update_post_meta($post_id, 'seiyakubi',$my_custom_seiyakubi_data);
		elseif($my_custom_seiyakubi_data == "")
			//delete_post_meta($post_id, 'seiyakubi',get_post_meta($post_id,'seiyakubi',true));
			update_post_meta($post_id, 'seiyakubi',$my_custom_seiyakubi_data);
	}else{
			return $post_id;
	}
}


// 自社物  v1.7.11
function custom_save_koukaijisha ( $post_id ) {
	if ( isset($_POST['mycustom_koukaijisha_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_koukaijisha_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 自社物フラグ v5.7.2
		$my_custom_koukaijisha_data = isset($_POST['koukaijisha']) ? esc_attr( stripslashes( $_POST['koukaijisha'] )): '';
		if( strcmp($my_custom_koukaijisha_data,get_post_meta($post_id, 'koukaijisha', true)) != 0 )
			update_post_meta($post_id, 'koukaijisha',$my_custom_koukaijisha_data);
		elseif($my_custom_koukaijisha_data == "")
			delete_post_meta($post_id, 'koukajishai',get_post_meta($post_id,'koukaijisha',true));

		// 状態 v5.7.2
		$my_custom_jyoutai_data = isset($_POST['jyoutai']) ? esc_attr( stripslashes( $_POST['jyoutai'] )): '';
		if( strcmp($my_custom_jyoutai_data,get_post_meta($post_id, 'jyoutai', true)) != 0 )
			update_post_meta($post_id, 'jyoutai',$my_custom_jyoutai_data);
		elseif($my_custom_jyoutai_data == "")
			delete_post_meta($post_id, 'jyoutai',get_post_meta($post_id,'jyoutai',true));

		// 会員 v5.7.2
		$my_custom_kaiin_data = isset($_POST['kaiin']) ? esc_attr( stripslashes( $_POST['kaiin'] )): '';
		if( strcmp($my_custom_kaiin_data,get_post_meta($post_id, 'kaiin', true)) != 0 )
			update_post_meta($post_id, 'kaiin',$my_custom_kaiin_data);
		elseif($my_custom_kaiin_data == "")
			//delete_post_meta($post_id, 'kaiin',get_post_meta($post_id,'kaiin',true));
			update_post_meta($post_id, 'kaiin',$my_custom_kaiin_data);
	}else{
			return $post_id;
	}
}


// 物件種別 v5.7.2
function custom_save_bukkenshubetsu ( $post_id ) {
	if ( isset($_POST['mycustom_bukkenshubetsu_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_bukkenshubetsu_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		$my_custom_bukkenshubetsu_data = isset($_POST['bukkenshubetsu']) ? esc_attr( stripslashes( $_POST['bukkenshubetsu'] )) : '';
		if( strcmp($my_custom_bukkenshubetsu_data,get_post_meta($post_id, 'bukkenshubetsu', true)) != 0 )
			update_post_meta($post_id, 'bukkenshubetsu',$my_custom_bukkenshubetsu_data);
		elseif($my_custom_bukkenshubetsu_data == "")
			delete_post_meta($post_id, 'bukkenshubetsu',get_post_meta($post_id,'bukkenshubetsu',true));
	}else{
			return $post_id;
	}
}


// 建物名(物件名)
function custom_save_bukkenmei ( $post_id ) {
	if ( isset($_POST['mycustom_bukkenmei_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_bukkenmei_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 建物名(物件名) v5.7.2
		$my_custom_bukkenmei_data = isset($_POST['bukkenmei']) ? esc_attr( stripslashes( $_POST['bukkenmei'] )) : '';
		if( strcmp($my_custom_bukkenmei_data,get_post_meta($post_id, 'bukkenmei', true)) != 0 )
			update_post_meta($post_id, 'bukkenmei',$my_custom_bukkenmei_data);
		elseif($my_custom_bukkenmei_data == "")
			delete_post_meta($post_id, 'bukkenmei',get_post_meta($post_id,'bukkenmei',true));

		// 物件名公開 v5.7.2
		$my_custom_bukkenmeikoukai_data = isset($_POST['bukkenmeikoukai']) ? esc_attr( stripslashes( $_POST['bukkenmeikoukai'] )): '';
		if( strcmp($my_custom_bukkenmeikoukai_data,get_post_meta($post_id, 'bukkenmeikoukai', true)) != 0 )
			update_post_meta($post_id, 'bukkenmeikoukai',$my_custom_bukkenmeikoukai_data);
		elseif($my_custom_bukkenmeikoukai_data == "")
			delete_post_meta($post_id, 'bukkenmeikoukai',get_post_meta($post_id,'bukkenmeikoukai',true));

		// 総戸数・総区画数 v5.7.2 
		$my_custom_bukkensoukosu_data = isset($_POST['bukkensoukosu']) ? esc_attr( stripslashes( $_POST['bukkensoukosu'] )): '';
		if( strcmp($my_custom_bukkensoukosu_data,get_post_meta($post_id, 'bukkensoukosu', true)) != 0 )
			update_post_meta($post_id, 'bukkensoukosu',$my_custom_bukkensoukosu_data);
		elseif($my_custom_bukkensoukosu_data == "")
			delete_post_meta($post_id, 'bukkensoukosu',get_post_meta($post_id,'bukkensoukosu',true));

		// 部屋:空部屋の番号 土地:区画番号 v5.7.2
		$my_custom_bukkennaiyo_data = isset($_POST['bukkennaiyo']) ? esc_attr( stripslashes( $_POST['bukkennaiyo'] )): '';
		if( strcmp($my_custom_bukkennaiyo_data,get_post_meta($post_id, 'bukkennaiyo', true)) != 0 )
			update_post_meta($post_id, 'bukkennaiyo',$my_custom_bukkennaiyo_data);
		elseif($my_custom_bukkennaiyo_data == "")
			delete_post_meta($post_id, 'bukkennaiyo',get_post_meta($post_id,'bukkennaiyo',true));
	}else{
			return $post_id;
	}
}


// 所在地
function custom_save_shozaichiken ( $post_id ) {
	if ( isset($_POST['mycustom_shozaichiken_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_shozaichiken_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 県 v5.7.2
		$my_custom_shozaichiken_data = isset($_POST['shozaichiken']) ? esc_attr( stripslashes( $_POST['shozaichiken'] )) : '';
		if( strcmp($my_custom_shozaichiken_data,get_post_meta($post_id, 'shozaichiken', true)) != 0 ){
			update_post_meta($post_id, 'shozaichiken',$my_custom_shozaichiken_data);
		}
		elseif($my_custom_shozaichiken_data == "")
			delete_post_meta($post_id, 'shozaichiken',get_post_meta($post_id,'shozaichiken',true));

		// 市区 v5.7.2
		if($my_custom_shozaichiken_data == ""){
			$my_custom_shozaichiken_data = "00";
		}
		$my_custom_shozaichicode_data = isset($_POST['shozaichicode']) ? esc_attr( stripslashes( $_POST['shozaichicode'] )): '';
		if( strcmp($my_custom_shozaichicode_data,get_post_meta($post_id, 'shozaichicode', true)) != 0 ){
			$my_custom_shozaichicode_data2 = $my_custom_shozaichiken_data.$my_custom_shozaichicode_data;
			$my_custom_shozaichicode_data2 .= "000000";
			update_post_meta($post_id, 'shozaichicode',$my_custom_shozaichicode_data2);

		}elseif($my_custom_shozaichicode_data == "")
			delete_post_meta($post_id, 'shozaichicode',get_post_meta($post_id,'shozaichicode',true));

		// 所在地名称 v5.7.2
		$my_custom_shozaichimeisho_data = isset($_POST['shozaichimeisho']) ? esc_attr( stripslashes( $_POST['shozaichimeisho'] )): '';
		if( strcmp($my_custom_shozaichimeisho_data,get_post_meta($post_id, 'shozaichimeisho', true)) != 0 )
			update_post_meta($post_id, 'shozaichimeisho',$my_custom_shozaichimeisho_data);
		elseif($my_custom_shozaichimeisho_data == "")
			update_post_meta($post_id, 'shozaichimeisho','');

		// 所在地詳細_表示部 v5.7.2
		$my_custom_shozaichimeisho2_data = isset($_POST['shozaichimeisho2']) ? esc_attr( stripslashes( $_POST['shozaichimeisho2'] )): '';
		if( strcmp($my_custom_shozaichimeisho2_data,get_post_meta($post_id, 'shozaichimeisho2', true)) != 0 )
			update_post_meta($post_id, 'shozaichimeisho2',$my_custom_shozaichimeisho2_data);
		elseif($my_custom_shozaichimeisho2_data == "")
			delete_post_meta($post_id, 'shozaichimeisho2',get_post_meta($post_id,'shozaichimeisho2',true));


		// 所在地詳細_非表示部 v5.7.2
		$my_custom_shozaichimeisho3_data = isset($_POST['shozaichimeisho3']) ? esc_attr( stripslashes( $_POST['shozaichimeisho3'] )): '';
		if( strcmp($my_custom_shozaichimeisho3_data,get_post_meta($post_id, 'shozaichimeisho3', true)) != 0 )
			update_post_meta($post_id, 'shozaichimeisho3',$my_custom_shozaichimeisho3_data);
		elseif($my_custom_shozaichimeisho3_data == "")
			delete_post_meta($post_id, 'shozaichimeisho3',get_post_meta($post_id,'shozaichimeisho3',true));
	}else{
			return $post_id;
	}
}

// 緯度
// 経度
function custom_save_bukkenido ( $post_id ) {
	if ( isset($_POST['mycustom_bukkenido_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_bukkenido_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 緯度 v5.7.2
		$my_custom_bukkenido_data = isset($_POST['bukkenido']) ? myIsNum_f( $_POST['bukkenido'] ): '';
		if($my_custom_bukkenido_data !=get_post_meta($post_id, 'bukkenido', true))
			update_post_meta($post_id, 'bukkenido',$my_custom_bukkenido_data);
		elseif($my_custom_bukkenido_data == "")
			delete_post_meta($post_id, 'bukkenido',get_post_meta($post_id,'bukkenido',true));

		// 経度 v5.7.2
		$my_custom_bukkenkeido_data = isset($_POST['bukkenkeido']) ? myIsNum_f( $_POST['bukkenkeido'] ): '';
		if($my_custom_bukkenkeido_data !=get_post_meta($post_id, 'bukkenkeido', true))
			update_post_meta($post_id, 'bukkenkeido',$my_custom_bukkenkeido_data);
		elseif($my_custom_bukkenkeido_data == "")
			delete_post_meta($post_id, 'bukkenkeido',get_post_meta($post_id,'bukkenkeido',true));
	}else{
			return $post_id;
	}
}


// 交通路線1
function custom_save_koutsurosen1 ( $post_id ) {
	if ( isset($_POST['mycustom_koutsurosen1_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_koutsurosen1_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 交通路線1 v5.7.2
		$my_custom_koutsurosen1_data = isset($_POST['koutsurosen1']) ? esc_attr( stripslashes( $_POST['koutsurosen1'] )): '';
		if($my_custom_koutsurosen1_data !=get_post_meta($post_id, 'koutsurosen1', true))
			update_post_meta($post_id, 'koutsurosen1',$my_custom_koutsurosen1_data);
		elseif($my_custom_koutsurosen1_data == "")
			delete_post_meta($post_id, 'koutsurosen1',get_post_meta($post_id,'koutsurosen1',true));

		// 交通駅1 v5.7.2
		$my_custom_koutsueki1_data = isset($_POST['koutsueki1']) ? esc_attr( stripslashes( $_POST['koutsueki1'] )): '';
		if($my_custom_koutsueki1_data !=get_post_meta($post_id, 'koutsueki1', true))
			update_post_meta($post_id, 'koutsueki1',$my_custom_koutsueki1_data);
		elseif($my_custom_koutsueki1_data == "")
			delete_post_meta($post_id, 'koutsueki1',get_post_meta($post_id,'koutsueki1',true));

		// 交通バス停名1 v5.7.2
		$my_custom_koutsubusstei1_data = isset($_POST['koutsubusstei1']) ? esc_attr( stripslashes( $_POST['koutsubusstei1'] )): '';
		if( strcmp($my_custom_koutsubusstei1_data,get_post_meta($post_id, 'koutsubusstei1', true)) != 0 )
			update_post_meta($post_id, 'koutsubusstei1',$my_custom_koutsubusstei1_data);
		elseif($my_custom_koutsubusstei1_data == "")
			delete_post_meta($post_id, 'koutsubusstei1',get_post_meta($post_id,'koutsubusstei1',true));

		// 交通バス時間1 v5.7.2
		$my_custom_koutsubussfun1_data = isset($_POST['koutsubussfun1']) ? esc_attr( stripslashes( $_POST['koutsubussfun1'] )): '';
		if($my_custom_koutsubussfun1_data !=get_post_meta($post_id, 'koutsubussfun1', true))
			update_post_meta($post_id, 'koutsubussfun1',$my_custom_koutsubussfun1_data);
		elseif($my_custom_koutsubussfun1_data == "")
			delete_post_meta($post_id, 'koutsubussfun1',get_post_meta($post_id,'koutsubussfun1',true));

		// 交通徒歩距離1 v5.7.2
		$my_custom_koutsutoho1_data = isset($_POST['koutsutoho1']) ? esc_attr( stripslashes( $_POST['koutsutoho1'] )): '';
		if($my_custom_koutsutoho1_data !=get_post_meta($post_id, 'koutsutoho1', true))
			update_post_meta($post_id, 'koutsutoho1',$my_custom_koutsutoho1_data);
		elseif($my_custom_koutsutoho1_data == "")
			delete_post_meta($post_id, 'koutsutoho1',get_post_meta($post_id,'koutsutoho1',true));

		// 交通徒歩 v5.7.2
		$my_custom_koutsutoho1f_data = isset($_POST['koutsutoho1f']) ? esc_attr( stripslashes( $_POST['koutsutoho1f'] )): '';
		if($my_custom_koutsutoho1f_data !=get_post_meta($post_id, 'koutsutoho1f', true))
			update_post_meta($post_id, 'koutsutoho1f',$my_custom_koutsutoho1f_data);
		elseif($my_custom_koutsutoho1f_data == "")
			delete_post_meta($post_id, 'koutsutoho1f',get_post_meta($post_id,'koutsutoho1f',true));

		// バス停交通徒歩時間 v5.7.2
		$my_custom_koutsutohob1f_data = isset($_POST['koutsutohob1f'] ) ? esc_attr( stripslashes( $_POST['koutsutohob1f'] )): '';
		if($my_custom_koutsutohob1f_data !=get_post_meta($post_id, 'koutsutohob1f', true))
			update_post_meta($post_id, 'koutsutohob1f',$my_custom_koutsutohob1f_data);
		elseif($my_custom_koutsutohob1f_data == "")
			delete_post_meta($post_id, 'koutsutohob1f',get_post_meta($post_id,'koutsutohob1f',true));
	}else{
			return $post_id;
	}
}


// 交通路線2
function custom_save_koutsurosen2 ( $post_id ) {
	if ( isset($_POST['mycustom_koutsurosen2_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_koutsurosen2_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 交通路線2 v5.7.2
		$my_custom_koutsurosen2_data = isset($_POST['koutsurosen2']) ? esc_attr( stripslashes( $_POST['koutsurosen2'] )): '';
		if($my_custom_koutsurosen2_data !=get_post_meta($post_id, 'koutsurosen2', true))
			update_post_meta($post_id, 'koutsurosen2',$my_custom_koutsurosen2_data);
		elseif($my_custom_koutsurosen2_data == "")
			delete_post_meta($post_id, 'koutsurosen2',get_post_meta($post_id,'koutsurosen2',true));

		// 交通駅2 v5.7.2
		$my_custom_koutsueki2_data = isset($_POST['koutsueki2']) ? esc_attr( stripslashes( $_POST['koutsueki2'] )): '';
		if($my_custom_koutsueki2_data !=get_post_meta($post_id, 'koutsueki2', true))
			update_post_meta($post_id, 'koutsueki2',$my_custom_koutsueki2_data);
		elseif($my_custom_koutsueki2_data == "")
			delete_post_meta($post_id, 'koutsueki2',get_post_meta($post_id,'koutsueki2',true));

		// 交通バス停名2 v5.7.2
		$my_custom_koutsubusstei2_data = isset($_POST['koutsubusstei2']) ? esc_attr( stripslashes( $_POST['koutsubusstei2'] )): '';
		if( strcmp($my_custom_koutsubusstei2_data,get_post_meta($post_id, 'koutsubusstei2', true)) != 0 )
			update_post_meta($post_id, 'koutsubusstei2',$my_custom_koutsubusstei2_data);
		elseif($my_custom_koutsubusstei2_data == "")
			delete_post_meta($post_id, 'koutsubusstei2',get_post_meta($post_id,'koutsubusstei2',true));

		// 交通バス時間2 v5.7.2
		$my_custom_koutsubussfun2_data = isset($_POST['koutsubussfun2']) ? esc_attr( stripslashes( $_POST['koutsubussfun2'] )): '';
		if($my_custom_koutsubussfun2_data !=get_post_meta($post_id, 'koutsubussfun2', true))
			update_post_meta($post_id, 'koutsubussfun2',$my_custom_koutsubussfun2_data);
		elseif($my_custom_koutsubussfun2_data == "")
			delete_post_meta($post_id, 'koutsubussfun2',get_post_meta($post_id,'koutsubussfun2',true));

		// 交通徒歩距離2 v5.7.2
		$my_custom_koutsutoho2_data = isset($_POST['koutsutoho2']) ? esc_attr( stripslashes( $_POST['koutsutoho2'] )): '';
		if($my_custom_koutsutoho2_data !=get_post_meta($post_id, 'koutsutoho2', true))
			update_post_meta($post_id, 'koutsutoho2',$my_custom_koutsutoho2_data);
		elseif($my_custom_koutsutoho2_data == "")
			delete_post_meta($post_id, 'koutsutoho2',get_post_meta($post_id,'koutsutoho2',true));

		// 交通徒歩2 v5.7.2
		$my_custom_koutsutoho2f_data = isset($_POST['koutsutoho2f']) ? esc_attr( stripslashes( $_POST['koutsutoho2f'] )): '';
		if($my_custom_koutsutoho2f_data !=get_post_meta($post_id, 'koutsutoho2f', true))
			update_post_meta($post_id, 'koutsutoho2f',$my_custom_koutsutoho2f_data);
		elseif($my_custom_koutsutoho2f_data == "")
			delete_post_meta($post_id, 'koutsutoho2f',get_post_meta($post_id,'koutsutoho2f',true));

		// バス停交通徒歩時間 v5.7.2
		$my_custom_koutsutohob2f_data = isset($_POST['koutsutohob2f']) ? esc_attr( stripslashes( $_POST['koutsutohob2f'] )): '';
		if($my_custom_koutsutohob2f_data !=get_post_meta($post_id, 'koutsutohob2f', true))
			update_post_meta($post_id, 'koutsutohob2f',$my_custom_koutsutohob2f_data);
		elseif($my_custom_koutsutohob2f_data == "")
			delete_post_meta($post_id, 'koutsutohob2f',get_post_meta($post_id,'koutsutohob2f',true));
	}else{
			return $post_id;
	}
}


// 交通その他 TexaArea v5.7.2 
function custom_save_koutsusonota ( $post_id ) {
	if ( isset($_POST['mycustom_koutsusonota_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_koutsusonota_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		$my_custom_koutsusonota_data = isset($_POST['koutsusonota']) ? $_POST['koutsusonota'] : '';
		$my_custom_koutsusonota_data = wp_kses( $my_custom_koutsusonota_data, wp_kses_allowed_html( 'post' ));

		if( strcmp($my_custom_koutsusonota_data,get_post_meta($post_id, 'koutsusonota', true)) != 0 )
			update_post_meta($post_id, 'koutsusonota',$my_custom_koutsusonota_data);
		elseif($my_custom_koutsusonota_data == "")
			delete_post_meta($post_id, 'koutsusonota',get_post_meta($post_id,'koutsusonota',true));
	}else{
			return $post_id;
	}
}


// 地目
function custom_save_tochichimoku ( $post_id ) {
	if ( isset($_POST['mycustom_tochichimoku_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_tochichimoku_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 地目 v5.7.2
		$my_custom_tochichimoku_data = isset($_POST['tochichimoku']) ? esc_attr( stripslashes( $_POST['tochichimoku'] )): '';
		if($my_custom_tochichimoku_data !=get_post_meta($post_id, 'tochichimoku', true))
			update_post_meta($post_id, 'tochichimoku',$my_custom_tochichimoku_data);
		elseif($my_custom_tochichimoku_data == "")
			delete_post_meta($post_id, 'tochichimoku',get_post_meta($post_id,'tochichimoku',true));

		// 用途地域 v5.7.2
		$my_custom_tochiyouto_data = isset($_POST['tochiyouto'] ) ? esc_attr( stripslashes( $_POST['tochiyouto'] )): '';
		if($my_custom_tochiyouto_data !=get_post_meta($post_id, 'tochiyouto', true))
			update_post_meta($post_id, 'tochiyouto',$my_custom_tochiyouto_data);
		elseif($my_custom_tochiyouto_data == "")
			delete_post_meta($post_id, 'tochiyouto',get_post_meta($post_id,'tochiyouto',true));

		// 都市計画 v5.7.2
		$my_custom_tochikeikaku_data = isset($_POST['tochikeikaku']) ? esc_attr( stripslashes( $_POST['tochikeikaku'] )): '';
		if($my_custom_tochikeikaku_data !=get_post_meta($post_id, 'tochikeikaku', true))
			update_post_meta($post_id, 'tochikeikaku',$my_custom_tochikeikaku_data);
		elseif($my_custom_tochikeikaku_data == "")
			delete_post_meta($post_id, 'tochikeikaku',get_post_meta($post_id,'tochikeikaku',true));

		// 地勢 v5.7.2
		$my_custom_tochichisei_data = isset($_POST['tochichisei']) ? esc_attr( stripslashes( $_POST['tochichisei'] )): '';
		if($my_custom_tochichisei_data !=get_post_meta($post_id, 'tochichisei', true))
			update_post_meta($post_id, 'tochichisei',$my_custom_tochichisei_data);
		elseif($my_custom_tochichisei_data == "")
			delete_post_meta($post_id, 'tochichisei',get_post_meta($post_id,'tochichisei',true));

		// 土地面積計測方式 v5.7.2
		$my_custom_tochisokutei_data = isset($_POST['tochisokutei']) ? esc_attr( stripslashes( $_POST['tochisokutei'] )): '';
		if($my_custom_tochisokutei_data !=get_post_meta($post_id, 'tochisokutei', true))
			update_post_meta($post_id, 'tochisokutei',$my_custom_tochisokutei_data);
		elseif($my_custom_tochisokutei_data == "")
			delete_post_meta($post_id, 'tochisokutei',get_post_meta($post_id,'tochisokutei',true));

		// 区画面積 v5.7.2
		$my_custom_tochikukaku_data = isset($_POST['tochikukaku']) ? myIsNum_f( $_POST['tochikukaku'] ): '';
		if($my_custom_tochikukaku_data !=get_post_meta($post_id, 'tochikukaku', true))
			update_post_meta($post_id, 'tochikukaku',$my_custom_tochikukaku_data);
		elseif($my_custom_tochikukaku_data == "")
			update_post_meta($post_id, 'tochikukaku','');

		// 私道負担面積 v5.7.2
		$my_custom_tochishido_data = isset($_POST['tochishido']) ? myIsNum_f( $_POST['tochishido'] ): '';
		if($my_custom_tochishido_data !=get_post_meta($post_id, 'tochishido', true))
			update_post_meta($post_id, 'tochishido',$my_custom_tochishido_data);
		elseif($my_custom_tochishido_data == "")
			delete_post_meta($post_id, 'tochishido',get_post_meta($post_id,'tochishido',true));

		// セットバック v5.7.2
		$my_custom_tochisetback_data = isset($_POST['tochisetback']) ? myIsNum_f( $_POST['tochisetback'] ): '';
		if($my_custom_tochisetback_data !=get_post_meta($post_id, 'tochisetback', true))
			update_post_meta($post_id, 'tochisetback',$my_custom_tochisetback_data);
		elseif($my_custom_tochisetback_data == "")
			delete_post_meta($post_id, 'tochisetback',get_post_meta($post_id,'tochisetback',true));

		// セットバック量 v5.7.2
		$my_custom_tochisetback2_data = isset($_POST['tochisetback2']) ? myIsNum_f( $_POST['tochisetback2'] ): '';
		if($my_custom_tochisetback2_data !=get_post_meta($post_id, 'tochisetback2', true))
			update_post_meta($post_id, 'tochisetback2',$my_custom_tochisetback2_data);
		elseif($my_custom_tochisetback2_data == "")
			delete_post_meta($post_id, 'tochisetback2',get_post_meta($post_id,'tochisetback2',true));

		// 建ぺい率 v5.7.2
		$my_custom_tochikenpei_data = isset($_POST['tochikenpei']) ? myIsNum_f( $_POST['tochikenpei'] ) : '';
		if($my_custom_tochikenpei_data !=get_post_meta($post_id, 'tochikenpei', true))
			update_post_meta($post_id, 'tochikenpei',$my_custom_tochikenpei_data);
		elseif($my_custom_tochikenpei_data == "")
			delete_post_meta($post_id, 'tochikenpei',get_post_meta($post_id,'tochikenpei',true));

		// 容積率 v5.7.2	
		$my_custom_tochiyoseki_data = isset($_POST['tochiyoseki']) ? myIsNum_f( $_POST['tochiyoseki'] ) : '';
		if($my_custom_tochiyoseki_data !=get_post_meta($post_id, 'tochiyoseki', true))
			update_post_meta($post_id, 'tochiyoseki',$my_custom_tochiyoseki_data);
		elseif($my_custom_tochiyoseki_data == "")
			delete_post_meta($post_id, 'tochiyoseki',get_post_meta($post_id,'tochiyoseki',true));

		// 接道状況 v5.7.2
		$my_custom_tochisetsudo_data = isset($_POST['tochisetsudo']) ? esc_attr( stripslashes( $_POST['tochisetsudo'] )): '';
		if($my_custom_tochisetsudo_data !=get_post_meta($post_id, 'tochisetsudo', true))
			update_post_meta($post_id, 'tochisetsudo',$my_custom_tochisetsudo_data);
		elseif($my_custom_tochisetsudo_data == "")
			delete_post_meta($post_id, 'tochisetsudo',get_post_meta($post_id,'tochisetsudo',true));

		// 接道方向1 v5.7.2
		$my_custom_tochisetsudohouko1_data = isset($_POST['tochisetsudohouko1']) ? esc_attr( stripslashes( $_POST['tochisetsudohouko1'] )): '';
		if($my_custom_tochisetsudohouko1_data !=get_post_meta($post_id, 'tochisetsudohouko1', true))
			update_post_meta($post_id, 'tochisetsudohouko1',$my_custom_tochisetsudohouko1_data);
		elseif($my_custom_tochisetsudohouko1_data == "")
			delete_post_meta($post_id, 'tochisetsudohouko1',get_post_meta($post_id,'tochisetsudohouko1',true));

		// 接道間口1 v5.7.2
		$my_custom_tochisetsudomaguchi1_data = isset($_POST['tochisetsudomaguchi1']) ? myIsNum_f( $_POST['tochisetsudomaguchi1'] ): '';
		if($my_custom_tochisetsudomaguchi1_data !=get_post_meta($post_id, 'tochisetsudomaguchi1', true))
			update_post_meta($post_id, 'tochisetsudomaguchi1',$my_custom_tochisetsudomaguchi1_data);
		elseif($my_custom_tochisetsudomaguchi1_data == "")
			delete_post_meta($post_id, 'tochisetsudomaguchi1',get_post_meta($post_id,'tochisetsudomaguchi1',true));

		// 接道種別1 v5.7.2
		$my_custom_tochisetsudoshurui1_data = isset($_POST['tochisetsudoshurui1']) ? esc_attr( stripslashes( $_POST['tochisetsudoshurui1'] )) : '';
		if($my_custom_tochisetsudoshurui1_data !=get_post_meta($post_id, 'tochisetsudoshurui1', true))
			update_post_meta($post_id, 'tochisetsudoshurui1',$my_custom_tochisetsudoshurui1_data);
		elseif($my_custom_tochisetsudoshurui1_data == "")
			delete_post_meta($post_id, 'tochisetsudoshurui1',get_post_meta($post_id,'tochisetsudoshurui1',true));

		// 接道幅員1 v5.7.2
		$my_custom_tochisetsudofukuin1_data = isset($_POST['tochisetsudofukuin1']) ? myIsNum_f( $_POST['tochisetsudofukuin1'] ): '';
		if($my_custom_tochisetsudofukuin1_data !=get_post_meta($post_id, 'tochisetsudofukuin1', true))
			update_post_meta($post_id, 'tochisetsudofukuin1',$my_custom_tochisetsudofukuin1_data);
		elseif($my_custom_tochisetsudofukuin1_data == "")
			delete_post_meta($post_id, 'tochisetsudofukuin1',get_post_meta($post_id,'tochisetsudofukuin1',true));

		// 位置指定道路1 v5.7.2
		$my_custom_tochisetsudoichishitei1_data = isset($_POST['tochisetsudoichishitei1']) ? esc_attr( stripslashes( $_POST['tochisetsudoichishitei1'] )): '';
		if($my_custom_tochisetsudoichishitei1_data !=get_post_meta($post_id, 'tochisetsudoichishitei1', true))
			update_post_meta($post_id, 'tochisetsudoichishitei1',$my_custom_tochisetsudoichishitei1_data);
		elseif($my_custom_tochisetsudoichishitei1_data == "")
			delete_post_meta($post_id, 'tochisetsudoichishitei1',get_post_meta($post_id,'tochisetsudoichishitei1',true));

		// 接道方向2 v5.7.2
		$my_custom_tochisetsudohouko2_data = isset($_POST['tochisetsudohouko2']) ? esc_attr( stripslashes( $_POST['tochisetsudohouko2'] )): '';
		if($my_custom_tochisetsudohouko2_data !=get_post_meta($post_id, 'tochisetsudohouko2', true))
			update_post_meta($post_id, 'tochisetsudohouko2',$my_custom_tochisetsudohouko2_data);
		elseif($my_custom_tochisetsudohouko2_data == "")
			delete_post_meta($post_id, 'tochisetsudohouko2',get_post_meta($post_id,'tochisetsudohouko2',true));

		// 接道間口2 v5.7.2
		$my_custom_tochisetsudomaguchi2_data = isset($_POST['tochisetsudomaguchi2']) ? myIsNum_f( $_POST['tochisetsudomaguchi2'] ): '';
		if($my_custom_tochisetsudomaguchi2_data !=get_post_meta($post_id, 'tochisetsudomaguchi2', true))
			update_post_meta($post_id, 'tochisetsudomaguchi2',$my_custom_tochisetsudomaguchi2_data);
		elseif($my_custom_tochisetsudomaguchi2_data == "")
			delete_post_meta($post_id, 'tochisetsudomaguchi2',get_post_meta($post_id,'tochisetsudomaguchi2',true));

		// 接道種別2 v5.7.2
		$my_custom_tochisetsudoshurui2_data = isset($_POST['tochisetsudoshurui2']) ? esc_attr( stripslashes( $_POST['tochisetsudoshurui2'] )): '';
		if($my_custom_tochisetsudoshurui2_data !=get_post_meta($post_id, 'tochisetsudoshurui2', true))
			update_post_meta($post_id, 'tochisetsudoshurui2',$my_custom_tochisetsudoshurui2_data);
		elseif($my_custom_tochisetsudoshurui2_data == "")
			delete_post_meta($post_id, 'tochisetsudoshurui2',get_post_meta($post_id,'tochisetsudoshurui2',true));

		// 接道幅員2 v5.7.2
		$my_custom_tochisetsudofukuin2_data = isset($_POST['tochisetsudofukuin2']) ? myIsNum_f( $_POST['tochisetsudofukuin2'] ): '';
		if($my_custom_tochisetsudofukuin2_data !=get_post_meta($post_id, 'tochisetsudofukuin2', true))
			update_post_meta($post_id, 'tochisetsudofukuin2',$my_custom_tochisetsudofukuin2_data);
		elseif($my_custom_tochisetsudofukuin2_data == "")
			delete_post_meta($post_id, 'tochisetsudofukuin2',get_post_meta($post_id,'tochisetsudofukuin2',true));

		// 位置指定道路2 v5.7.2
		$my_custom_tochisetsudoichishitei2_data = isset($_POST['tochisetsudoichishitei2']) ? esc_attr( stripslashes( $_POST['tochisetsudoichishitei2'] )): '';
		if($my_custom_tochisetsudoichishitei2_data !=get_post_meta($post_id, 'tochisetsudoichishitei2', true))
			update_post_meta($post_id, 'tochisetsudoichishitei2',$my_custom_tochisetsudoichishitei2_data);
		elseif($my_custom_tochisetsudoichishitei2_data == "")
			delete_post_meta($post_id, 'tochisetsudoichishitei2',get_post_meta($post_id,'tochisetsudoichishitei2',true));

		// 土地権利 v5.7.2
		$my_custom_tochikenri_data = isset($_POST['tochikenri']) ? esc_attr( stripslashes( $_POST['tochikenri'] )): '';
		if($my_custom_tochikenri_data !=get_post_meta($post_id, 'tochikenri', true))
			update_post_meta($post_id, 'tochikenri',$my_custom_tochikenri_data);
		elseif($my_custom_tochikenri_data == "")
			delete_post_meta($post_id, 'tochikenri',get_post_meta($post_id,'tochikenri',true));

		// 国土法届 v5.7.2
		$my_custom_tochikokudohou_data = isset($_POST['tochikokudohou']) ? esc_attr( stripslashes( $_POST['tochikokudohou'] )): '';
		if($my_custom_tochikokudohou_data !=get_post_meta($post_id, 'tochikokudohou', true))
			update_post_meta($post_id, 'tochikokudohou',$my_custom_tochikokudohou_data);
		elseif($my_custom_tochikokudohou_data == "")
			delete_post_meta($post_id, 'tochikokudohou',get_post_meta($post_id,'tochikokudohou',true));
	}else{
			return $post_id;
	}
}


// 建物構造
function custom_save_tatemonokozo ( $post_id ) {
	if ( isset($_POST['mycustom_tatemonokozo_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_tatemonokozo_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 建物構造 v5.7.2
		$my_custom_tatemonokozo_data = isset($_POST['tatemonokozo']) ? esc_attr( stripslashes( $_POST['tatemonokozo'] )): '';
		if($my_custom_tatemonokozo_data !=get_post_meta($post_id, 'tatemonokozo', true))
			update_post_meta($post_id, 'tatemonokozo',$my_custom_tatemonokozo_data);
		elseif($my_custom_tatemonokozo_data == "")
			delete_post_meta($post_id, 'tatemonokozo',get_post_meta($post_id,'tatemonokozo',true));

		// 面積計測方式 v5.7.2
		$my_custom_tatemonohosiki_data = isset($_POST['tatemonohosiki']) ? esc_attr( stripslashes( $_POST['tatemonohosiki'] )): '';
		if($my_custom_tatemonohosiki_data !=get_post_meta($post_id, 'tatemonohosiki', true))
			update_post_meta($post_id, 'tatemonohosiki',$my_custom_tatemonohosiki_data);
		elseif($my_custom_tatemonohosiki_data == "")
			delete_post_meta($post_id, 'tatemonohosiki',get_post_meta($post_id,'tatemonohosiki',true));

		// 建物面積・専有面積 v5.7.2
		$my_custom_tatemonomenseki_data = isset($_POST['tatemonomenseki']) ? myIsNum_f( $_POST['tatemonomenseki'] ) : '';
		if($my_custom_tatemonomenseki_data !=get_post_meta($post_id, 'tatemonomenseki', true))
			update_post_meta($post_id, 'tatemonomenseki',$my_custom_tatemonomenseki_data);
		elseif($my_custom_tatemonomenseki_data == "")
			update_post_meta($post_id, 'tatemonomenseki','');

		// 敷地全体面積 v5.7.2
		$my_custom_tatemonozentaimenseki_data = isset($_POST['tatemonozentaimenseki']) ? myIsNum_f( $_POST['tatemonozentaimenseki'] ): '';
		if($my_custom_tatemonozentaimenseki_data !=get_post_meta($post_id, 'tatemonozentaimenseki', true))
			update_post_meta($post_id, 'tatemonozentaimenseki',$my_custom_tatemonozentaimenseki_data);
		elseif($my_custom_tatemonozentaimenseki_data == "")
			update_post_meta($post_id, 'tatemonozentaimenseki','');

		// 延床面積 v5.7.2
		$my_custom_tatemononobeyukamenseki_data = isset($_POST['tatemononobeyukamenseki']) ? myIsNum_f( $_POST['tatemononobeyukamenseki'] ) : '';
		if($my_custom_tatemononobeyukamenseki_data !=get_post_meta($post_id, 'tatemononobeyukamenseki', true))
			update_post_meta($post_id, 'tatemononobeyukamenseki',$my_custom_tatemononobeyukamenseki_data);
		elseif($my_custom_tatemononobeyukamenseki_data == "")
			delete_post_meta($post_id, 'tatemononobeyukamenseki',get_post_meta($post_id,'tatemononobeyukamenseki',true));

		// 建築面積 v5.7.2
		$my_custom_tatemonokentikumenseki_data = isset($_POST['tatemonokentikumenseki']) ? myIsNum_f( $_POST['tatemonokentikumenseki'] ): '';
		if($my_custom_tatemonokentikumenseki_data !=get_post_meta($post_id, 'tatemonokentikumenseki', true))
			update_post_meta($post_id, 'tatemonokentikumenseki',$my_custom_tatemonokentikumenseki_data);
		elseif($my_custom_tatemonokentikumenseki_data == "")
			update_post_meta($post_id, 'tatemonokentikumenseki','');

		// 建物階数(地上)  v5.7.2
		$my_custom_tatemonokaisu1_data = isset($_POST['tatemonokaisu1']) ? esc_attr( stripslashes($_POST['tatemonokaisu1'] )): '';
		if($my_custom_tatemonokaisu1_data !=get_post_meta($post_id, 'tatemonokaisu1', true))
			update_post_meta($post_id, 'tatemonokaisu1',$my_custom_tatemonokaisu1_data);
		elseif($my_custom_tatemonokaisu1_data == "")
			delete_post_meta($post_id, 'tatemonokaisu1',get_post_meta($post_id,'tatemonokaisu1',true));

		// 建物階数(地下) v5.7.2
		$my_custom_tatemonokaisu2_data = isset($_POST['tatemonokaisu2']) ? esc_attr( stripslashes($_POST['tatemonokaisu2'] )): '';
		if($my_custom_tatemonokaisu2_data !=get_post_meta($post_id, 'tatemonokaisu2', true))
			update_post_meta($post_id, 'tatemonokaisu2',$my_custom_tatemonokaisu2_data);
		elseif($my_custom_tatemonokaisu2_data == "")
			delete_post_meta($post_id, 'tatemonokaisu2',get_post_meta($post_id,'tatemonokaisu2',true));

		// 築年月 v5.7.2 
		$my_custom_tatemonochikunenn_data = isset($_POST['tatemonochikunenn']) ? esc_attr( stripslashes($_POST['tatemonochikunenn'] )): '';
		if( strcmp($my_custom_tatemonochikunenn_data,get_post_meta($post_id, 'tatemonochikunenn', true)) != 0 )
			update_post_meta($post_id, 'tatemonochikunenn',$my_custom_tatemonochikunenn_data);
		elseif($my_custom_tatemonochikunenn_data == "")
			update_post_meta($post_id, 'tatemonochikunenn','');

		// 新築・未入居 v5.7.2
		$my_custom_tatemonoshinchiku_data = isset($_POST['tatemonoshinchiku']) ? esc_attr( stripslashes( $_POST['tatemonoshinchiku'] )): '';
		if($my_custom_tatemonoshinchiku_data !=get_post_meta($post_id, 'tatemonoshinchiku', true))
			update_post_meta($post_id, 'tatemonoshinchiku',$my_custom_tatemonoshinchiku_data);
		elseif($my_custom_tatemonoshinchiku_data == "")
			delete_post_meta($post_id, 'tatemonoshinchiku',get_post_meta($post_id,'tatemonoshinchiku',true));
	}else{
			return $post_id;
	}
}


// 管理人
function custom_save_kanrininn ( $post_id ) {

	if ( isset($_POST['mycustom_kanrininn_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_kanrininn_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		//管理人 v5.7.2
		$my_custom_kanrininn_data = isset($_POST['kanrininn']) ? esc_attr( stripslashes( $_POST['kanrininn'] )): '';
		if($my_custom_kanrininn_data !=get_post_meta($post_id, 'kanrininn', true))
			update_post_meta($post_id, 'kanrininn',$my_custom_kanrininn_data);
		elseif($my_custom_kanrininn_data == "")
			delete_post_meta($post_id, 'kanrininn',get_post_meta($post_id,'kanrininn',true));

		// 管理形態 v5.7.2
		$my_custom_kanrikeitai_data = isset($_POST['kanrikeitai']) ? esc_attr( stripslashes( $_POST['kanrikeitai'] )): '';
		if($my_custom_kanrikeitai_data !=get_post_meta($post_id, 'kanrikeitai', true))
			update_post_meta($post_id, 'kanrikeitai',$my_custom_kanrikeitai_data);
		elseif($my_custom_kanrikeitai_data == "")
			delete_post_meta($post_id, 'kanrikeitai',get_post_meta($post_id,'kanrikeitai',true));

		// 管理組合有無 v5.7.2
		$my_custom_kanrikumiai_data = isset($_POST['kanrikumiai']) ? esc_attr( stripslashes( $_POST['kanrikumiai'] )): '';
		if($my_custom_kanrikumiai_data !=get_post_meta($post_id, 'kanrikumiai', true))
			update_post_meta($post_id, 'kanrikumiai',$my_custom_kanrikumiai_data);
		elseif($my_custom_kanrikumiai_data == "")
			delete_post_meta($post_id, 'kanrikumiai',get_post_meta($post_id,'kanrikumiai',true));

		// 管理会社名 v5.7.2
		$my_custom_kanrikaisha_data = isset($_POST['kanrikaisha']) ? esc_attr( stripslashes($_POST['kanrikaisha'] )): '';
		if($my_custom_kanrikaisha_data !=get_post_meta($post_id, 'kanrikaisha', true))
			update_post_meta($post_id, 'kanrikaisha',$my_custom_kanrikaisha_data);
		elseif($my_custom_kanrikaisha_data == "")
			delete_post_meta($post_id, 'kanrikaisha',get_post_meta($post_id,'kanrikaisha',true));
	}else{
			return $post_id;
	}
}


// 部屋階数
function custom_save_heyakaisu ( $post_id ) {
	if ( isset($_POST['mycustom_heyakaisu_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_heyakaisu_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 部屋階数 v5.7.2
		$my_custom_heyakaisu_data = isset($_POST['heyakaisu']) ? esc_attr( stripslashes($_POST['heyakaisu'] )): '';
		if($my_custom_heyakaisu_data !=get_post_meta($post_id, 'heyakaisu', true))
			update_post_meta($post_id, 'heyakaisu',$my_custom_heyakaisu_data);
		elseif($my_custom_heyakaisu_data == "")
			delete_post_meta($post_id, 'heyakaisu',get_post_meta($post_id,'heyakaisu',true));

		// バルコニー面積 v5.7.2
		$my_custom_heyabarukoni_data = isset($_POST['heyabarukoni']) ? myIsNum_f($_POST['heyabarukoni'] ): '';
		if($my_custom_heyabarukoni_data !=get_post_meta($post_id, 'heyabarukoni', true))
			update_post_meta($post_id, 'heyabarukoni',$my_custom_heyabarukoni_data);
		elseif($my_custom_heyabarukoni_data == "")
			delete_post_meta($post_id, 'heyabarukoni',get_post_meta($post_id,'heyabarukoni',true));

		// 向き v5.7.2
		$my_custom_heyamuki_data = isset($_POST['heyamuki']) ? esc_attr( stripslashes( $_POST['heyamuki'] )): '';
		if($my_custom_heyamuki_data !=get_post_meta($post_id, 'heyamuki', true))
			update_post_meta($post_id, 'heyamuki',$my_custom_heyamuki_data);
		elseif($my_custom_heyamuki_data == "")
			delete_post_meta($post_id, 'heyamuki',get_post_meta($post_id,'heyamuki',true));
	}else{
			return $post_id;
	}
}


// 間取り間取部屋数
function custom_save_madorisu ( $post_id ) {
	if ( isset($_POST['mycustom_madorisu_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_madorisu_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 間取り v5.7.2
		$my_custom_madorisu_data = isset($_POST['madorisu']) ? esc_attr( stripslashes( $_POST['madorisu'] )): '';
		$my_custom_madorisu_data = mb_convert_kana($my_custom_madorisu_data,"a","UTF-8" );
		if($my_custom_madorisu_data !=get_post_meta($post_id, 'madorisu', true))
			update_post_meta($post_id, 'madorisu',$my_custom_madorisu_data);
		elseif($my_custom_madorisu_data == "")
			update_post_meta($post_id, 'madorisu','');

		// 間取部屋種類 v5.7.2
		$my_custom_madorisyurui_data = isset($_POST['madorisyurui']) ? esc_attr( stripslashes( $_POST['madorisyurui'] )): '';
		if($my_custom_madorisyurui_data !=get_post_meta($post_id, 'madorisyurui', true))
			update_post_meta($post_id, 'madorisyurui',$my_custom_madorisyurui_data);
		elseif($my_custom_madorisyurui_data == "")
			update_post_meta($post_id, 'madorisyurui','');

		// 間取り備考 madoribiko v5.7.2
		$my_custom_madoribiko_data = isset($_POST['madoribiko']) ? esc_attr( stripslashes( $_POST['madoribiko'] )): '';
		if( strcmp($my_custom_madoribiko_data,get_post_meta($post_id, 'madoribiko', true)) != 0 )
			update_post_meta($post_id, 'madoribiko',$my_custom_madoribiko_data);
		elseif($my_custom_madoribiko_data == "")
			delete_post_meta($post_id, 'madoribiko',get_post_meta($post_id,'madoribiko',true));
	}else{
			return $post_id;
	}
}


// 90間取り 間取(種類)1 
// 91間取り 間取(畳数)1 
// 92間取り 間取(所在階)1 
// 93間取り 間取(室数)1 v5.7.2
function custom_save_madorinaiyo( $post_id ) {
	global $post, $work_madorinaiyo;
	if ( isset($_POST['mycustom_madorinaiyo_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_madorinaiyo_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
		}

		foreach($work_madorinaiyo as $meta_box) {
			$data = isset($_POST[$meta_box['name']]) ? esc_attr( stripslashes( $_POST[$meta_box['name']] )): '';
			if(get_post_meta($post_id, $meta_box['name']) == "")
				add_post_meta($post_id, $meta_box['name'], $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'], true))
				update_post_meta($post_id, $meta_box['name'], $data);
			elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
		}
	}else{
			return $post_id;
	}
}


// URL v5.7.2
function custom_save_targeturl ( $post_id ) {
	if ( isset($_POST['mycustom_targeturl_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_targeturl_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		$my_custom_targeturl_data = isset($_POST['targeturl']) ? esc_url( $_POST['targeturl'] ): '';
		if( strcmp($my_custom_targeturl_data,get_post_meta($post_id, 'targeturl', true)) != 0 )
			update_post_meta($post_id, 'targeturl',$my_custom_targeturl_data);
		elseif($my_custom_targeturl_data == "")
			delete_post_meta($post_id, 'targeturl',get_post_meta($post_id,'targeturl',true));
	}else{
			return $post_id;
	}
}


// 社内用メモ
// 分配率(客付分)	houshoukeitai
// 名称	motozukemei
// 電話番号	motozuketel
function custom_save_shanaimemo ( $post_id ) {
	if ( isset($_POST['mycustom_shanaimemo_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_shanaimemo_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 社内用メモ v5.7.2
		$my_custom_shanaimemo_data = isset($_POST['shanaimemo']) ? esc_attr( stripslashes( $_POST['shanaimemo'] )): '';
		if( strcmp($my_custom_shanaimemo_data,get_post_meta($post_id, 'shanaimemo', true)) != 0 )
			update_post_meta($post_id, 'shanaimemo',$my_custom_shanaimemo_data);
		elseif($my_custom_shanaimemo_data == "")
			delete_post_meta($post_id, 'shanaimemo',get_post_meta($post_id,'shanaimemo',true));

		// 分配率(客付分)	houshoukeitai v5.7.2
		$my_custom_houshoukeitai_data = isset($_POST['houshoukeitai']) ? esc_attr( stripslashes( $_POST['houshoukeitai'] )) : '';
		if( strcmp($my_custom_houshoukeitai_data,get_post_meta($post_id, 'houshoukeitai', true)) != 0 )
			update_post_meta($post_id, 'houshoukeitai',$my_custom_houshoukeitai_data);
		elseif($my_custom_houshoukeitai_data == "")
			delete_post_meta($post_id, 'houshoukeitai',get_post_meta($post_id,'houshoukeitai',true));

		// 名称	motozukemei v5.7.2
		$my_custom_motozukemei_data = isset($_POST['motozukemei']) ? esc_attr( stripslashes( $_POST['motozukemei'] )): '';
		if( strcmp($my_custom_motozukemei_data,get_post_meta($post_id, 'motozukemei', true)) != 0 )
			update_post_meta($post_id, 'motozukemei',$my_custom_motozukemei_data);
		elseif($my_custom_motozukemei_data == "")
			delete_post_meta($post_id, 'motozukemei',get_post_meta($post_id,'motozukemei',true));

		// 電話番号	motozuketel v5.7.2
		$my_custom_motozuketel_data = isset($_POST['motozuketel']) ? esc_attr( stripslashes( $_POST['motozuketel'] )): '';
		if( strcmp($my_custom_motozuketel_data,get_post_meta($post_id, 'motozuketel', true)) != 0 )
			update_post_meta($post_id, 'motozuketel',$my_custom_motozuketel_data);
		elseif($my_custom_motozuketel_data == "")
			delete_post_meta($post_id, 'motozuketel',get_post_meta($post_id,'motozuketel',true));

		// FAX番号	motozuketel v5.7.2
		$my_custom_motozukefax_data = isset($_POST['motozukefax']) ? esc_attr( stripslashes( $_POST['motozukefax'] )) : '';
		if( strcmp($my_custom_motozukefax_data,get_post_meta($post_id, 'motozukefax', true)) != 0 )
			update_post_meta($post_id, 'motozukefax',$my_custom_motozukefax_data);
		elseif($my_custom_motozukefax_data == "")
			delete_post_meta($post_id, 'motozukefax',get_post_meta($post_id,'motozukefax',true));
	}else{
			return $post_id;
	}
}


// 賃料・価格 ver1.9.3
function custom_save_kakaku ( $post_id ) {
	if ( isset($_POST['mycustom_kakaku_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_kakaku_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}


		// 賃料・価格 v5.7.2
		$my_custom_kakaku_data = isset($_POST['kakaku']) ? $_POST['kakaku'] : '';
		$my_custom_kakaku_data = mb_convert_kana($my_custom_kakaku_data,"a","UTF-8" );
		$my_custom_kakaku_data = str_replace(",","",$my_custom_kakaku_data);
		$my_custom_kakaku_data = str_replace("\\","",$my_custom_kakaku_data);
		$my_custom_kakaku_data = str_replace("￥","",$my_custom_kakaku_data);
		$my_custom_kakaku_data = myIsNum_f( $my_custom_kakaku_data );

		if($my_custom_kakaku_data !=get_post_meta($post_id, 'kakaku', true))
			update_post_meta($post_id, 'kakaku',$my_custom_kakaku_data);
		elseif($my_custom_kakaku_data == "")
			update_post_meta($post_id, 'kakaku','');

		// 価格公開 v5.7.2
		$my_custom_kakakukoukai_data = isset($_POST['kakakukoukai']) ? esc_attr( stripslashes( $_POST['kakakukoukai'] )): '';
		if($my_custom_kakakukoukai_data !=get_post_meta($post_id, 'kakakukoukai', true))
			update_post_meta($post_id, 'kakakukoukai',$my_custom_kakakukoukai_data);
		elseif($my_custom_kakakukoukai_data == "")
			delete_post_meta($post_id, 'kakakukoukai',get_post_meta($post_id,'kakakukoukai',true));

		// 価格状態 v5.7.2
		$my_custom_kakakujoutai_data = isset($_POST['kakakujoutai']) ? esc_attr( stripslashes( $_POST['kakakujoutai'] )): '';
			if($my_custom_kakakujoutai_data !=get_post_meta($post_id, 'kakakujoutai', true))
			update_post_meta($post_id, 'kakakujoutai',$my_custom_kakakujoutai_data);
		elseif($my_custom_kakakujoutai_data == "")
			delete_post_meta($post_id, 'kakakujoutai',get_post_meta($post_id,'kakakujoutai',true));

		// うち税額 v5.7.2
		$my_custom_kakakuzei_data = isset($_POST['kakakuzei']) ? $_POST['kakakuzei'] : '';
		$my_custom_kakakuzei_data = mb_convert_kana($my_custom_kakakuzei_data,"a","UTF-8" );
		$my_custom_kakakuzei_data = str_replace(",","",$my_custom_kakakuzei_data);
		$my_custom_kakakuzei_data = str_replace("\\","",$my_custom_kakakuzei_data);
		$my_custom_kakakuzei_data = str_replace("￥","",$my_custom_kakakuzei_data);
		$my_custom_kakakuzei_data = myIsNum_f( $my_custom_kakakuzei_data );

		if($my_custom_kakakuzei_data !=get_post_meta($post_id, 'kakakuzei', true))
			update_post_meta($post_id, 'kakakuzei',$my_custom_kakakuzei_data);
		elseif($my_custom_kakakuzei_data == "")
			delete_post_meta($post_id, 'kakakuzei',get_post_meta($post_id,'kakakuzei',true));

		// 坪単価 v5.7.2
		$my_custom_kakakutsubo_data = isset($_POST['kakakutsubo']) ? $_POST['kakakutsubo'] : '';
		$my_custom_kakakutsubo_data = mb_convert_kana($my_custom_kakakutsubo_data,"a","UTF-8" );
		$my_custom_kakakutsubo_data = str_replace(",","",$my_custom_kakakutsubo_data);
		$my_custom_kakakutsubo_data = str_replace("\\","",$my_custom_kakakutsubo_data);
		$my_custom_kakakutsubo_data = str_replace("￥","",$my_custom_kakakutsubo_data);
		$my_custom_kakakutsubo_data = myIsNum_f( $my_custom_kakakutsubo_data );

		/*
		 * 坪単価 計算
		 * ver1.9.3
		 */
		$my_custom_kakakutsubo_data =  apply_filters( 'tsubotanka_calculate', $my_custom_kakakutsubo_data, $post_id );

		if($my_custom_kakakutsubo_data !=get_post_meta($post_id, 'kakakutsubo', true))
			update_post_meta($post_id, 'kakakutsubo',$my_custom_kakakutsubo_data);
		elseif($my_custom_kakakutsubo_data == "")
			delete_post_meta($post_id, 'kakakutsubo',get_post_meta($post_id,'kakakutsubo',true));

		// 共益費・管理費 v5.7.2
		$my_custom_kakakukyouekihi_data = isset($_POST['kakakukyouekihi']) ? $_POST['kakakukyouekihi'] : '';
		$my_custom_kakakukyouekihi_data = mb_convert_kana($my_custom_kakakukyouekihi_data,"a","UTF-8" );
		$my_custom_kakakukyouekihi_data = str_replace(",","",$my_custom_kakakukyouekihi_data);
		$my_custom_kakakukyouekihi_data = str_replace("\\","",$my_custom_kakakukyouekihi_data);
		$my_custom_kakakukyouekihi_data = str_replace("￥","",$my_custom_kakakukyouekihi_data);
		$my_custom_kakakukyouekihi_data = myIsNum_f( $my_custom_kakakukyouekihi_data );

		if($my_custom_kakakukyouekihi_data !=get_post_meta($post_id, 'kakakukyouekihi', true))
			update_post_meta($post_id, 'kakakukyouekihi',$my_custom_kakakukyouekihi_data);
		elseif($my_custom_kakakukyouekihi_data == "")
			delete_post_meta($post_id, 'kakakukyouekihi',get_post_meta($post_id,'kakakukyouekihi',true));

		// 礼金 v5.7.2
		$my_custom_kakakureikin_data = isset($_POST['kakakureikin']) ? $_POST['kakakureikin'] : '';
		$my_custom_kakakureikin_data = mb_convert_kana($my_custom_kakakureikin_data,"a","UTF-8" );
		$my_custom_kakakureikin_data = str_replace(",","",$my_custom_kakakureikin_data);
		$my_custom_kakakureikin_data = str_replace("\\","",$my_custom_kakakureikin_data);
		$my_custom_kakakureikin_data = str_replace("￥","",$my_custom_kakakureikin_data);
		$my_custom_kakakureikin_data = myIsNum_f( $my_custom_kakakureikin_data );

		if($my_custom_kakakureikin_data !=get_post_meta($post_id, 'kakakureikin', true))
			update_post_meta($post_id, 'kakakureikin',$my_custom_kakakureikin_data);
		elseif($my_custom_kakakureikin_data == "")
			delete_post_meta($post_id, 'kakakureikin',get_post_meta($post_id,'kakakureikin',true));

		// 敷金 v5.7.2
		$my_custom_kakakushikikin_data = isset($_POST['kakakushikikin']) ? $_POST['kakakushikikin'] : '';
		$my_custom_kakakushikikin_data = mb_convert_kana($my_custom_kakakushikikin_data,"a","UTF-8" );
		$my_custom_kakakushikikin_data = str_replace(",","",$my_custom_kakakushikikin_data);
		$my_custom_kakakushikikin_data = str_replace("\\","",$my_custom_kakakushikikin_data);
		$my_custom_kakakushikikin_data = str_replace("￥","",$my_custom_kakakushikikin_data);
		$my_custom_kakakushikikin_data = myIsNum_f( $my_custom_kakakushikikin_data );

		if($my_custom_kakakushikikin_data !=get_post_meta($post_id, 'kakakushikikin', true))
			update_post_meta($post_id, 'kakakushikikin',$my_custom_kakakushikikin_data);
		elseif($my_custom_kakakushikikin_data == "")
			delete_post_meta($post_id, 'kakakushikikin',get_post_meta($post_id,'kakakushikikin',true));

		// 保証金 v5.7.2
		$my_custom_kakakuhoshoukin_data = isset($_POST['kakakuhoshoukin']) ? $_POST['kakakuhoshoukin'] : '';
		$my_custom_kakakuhoshoukin_data = mb_convert_kana($my_custom_kakakuhoshoukin_data,"a","UTF-8" );
		$my_custom_kakakuhoshoukin_data = str_replace(",","",$my_custom_kakakuhoshoukin_data);
		$my_custom_kakakuhoshoukin_data = str_replace("\\","",$my_custom_kakakuhoshoukin_data);
		$my_custom_kakakuhoshoukin_data = str_replace("￥","",$my_custom_kakakuhoshoukin_data);
		$my_custom_kakakuhoshoukin_data = myIsNum_f( $my_custom_kakakuhoshoukin_data);

		if($my_custom_kakakuhoshoukin_data !=get_post_meta($post_id, 'kakakuhoshoukin', true))
			update_post_meta($post_id, 'kakakuhoshoukin',$my_custom_kakakuhoshoukin_data);
		elseif($my_custom_kakakuhoshoukin_data == "")
			delete_post_meta($post_id, 'kakakuhoshoukin',get_post_meta($post_id,'kakakuhoshoukin',true));

		// 権利金 v5.7.2
		$my_custom_kakakukenrikin_data = isset($_POST['kakakukenrikin']) ? $_POST['kakakukenrikin'] : '';
		$my_custom_kakakukenrikin_data = mb_convert_kana($my_custom_kakakukenrikin_data,"a","UTF-8" );
		$my_custom_kakakukenrikin_data = str_replace(",","",$my_custom_kakakukenrikin_data);
		$my_custom_kakakukenrikin_data = str_replace("\\","",$my_custom_kakakukenrikin_data);
		$my_custom_kakakukenrikin_data = str_replace("￥","",$my_custom_kakakukenrikin_data);
		$my_custom_kakakukenrikin_data = myIsNum_f( $my_custom_kakakukenrikin_data );

		if($my_custom_kakakukenrikin_data !=get_post_meta($post_id, 'kakakukenrikin', true))
			update_post_meta($post_id, 'kakakukenrikin',$my_custom_kakakukenrikin_data);
		elseif($my_custom_kakakukenrikin_data == "")
			delete_post_meta($post_id, 'kakakukenrikin',get_post_meta($post_id,'kakakukenrikin',true));


		// 償却・敷引金 v5.7.2 
		$my_custom_kakakushikibiki_data = isset($_POST['kakakushikibiki']) ? $_POST['kakakushikibiki'] : '';
		$my_custom_kakakushikibiki_data = mb_convert_kana($my_custom_kakakushikibiki_data,"a","UTF-8" );
		$my_custom_kakakushikibiki_data = str_replace(",","",$my_custom_kakakushikibiki_data);
		$my_custom_kakakushikibiki_data = str_replace("\\","",$my_custom_kakakushikibiki_data);
		$my_custom_kakakushikibiki_data = str_replace("￥","",$my_custom_kakakushikibiki_data);
		$my_custom_kakakushikibiki_data = myIsNum_f( $my_custom_kakakushikibiki_data );

		if($my_custom_kakakushikibiki_data !=get_post_meta($post_id, 'kakakushikibiki', true))
			update_post_meta($post_id, 'kakakushikibiki',$my_custom_kakakushikibiki_data);
		elseif($my_custom_kakakushikibiki_data == "")
			delete_post_meta($post_id, 'kakakushikibiki',get_post_meta($post_id,'kakakushikibiki',true));


		// 更新料 v5.7.2
		$my_custom_kakakukoushin_data = isset($_POST['kakakukoushin']) ? $_POST['kakakukoushin'] : '';
		$my_custom_kakakukoushin_data = mb_convert_kana($my_custom_kakakukoushin_data,"a","UTF-8" );
		$my_custom_kakakukoushin_data = str_replace(",","",$my_custom_kakakukoushin_data);
		$my_custom_kakakukoushin_data = str_replace("\\","",$my_custom_kakakukoushin_data);
		$my_custom_kakakukoushin_data = str_replace("￥","",$my_custom_kakakukoushin_data);
		$my_custom_kakakukoushin_data = myIsNum_f( $my_custom_kakakukoushin_data );

		if($my_custom_kakakukoushin_data !=get_post_meta($post_id, 'kakakukoushin', true))
			update_post_meta($post_id, 'kakakukoushin',$my_custom_kakakukoushin_data);
		elseif($my_custom_kakakukoushin_data == "")
			delete_post_meta($post_id, 'kakakukoushin',get_post_meta($post_id,'kakakukoushin',true));


		// 満室時表面利回り v5.7.2
		$my_custom_kakakuhyorimawari_data =isset($_POST['kakakuhyorimawari']) ? $_POST['kakakuhyorimawari'] : '';
		$my_custom_kakakuhyorimawari_data = mb_convert_kana($my_custom_kakakuhyorimawari_data,"a","UTF-8" );
		$my_custom_kakakuhyorimawari_data = myIsNum_f( $my_custom_kakakuhyorimawari_data );

		if($my_custom_kakakuhyorimawari_data !=get_post_meta($post_id, 'kakakuhyorimawari', true))
			update_post_meta($post_id, 'kakakuhyorimawari',$my_custom_kakakuhyorimawari_data);
		elseif($my_custom_kakakuhyorimawari_data == "")
			delete_post_meta($post_id, 'kakakuhyorimawari',get_post_meta($post_id,'kakakuhyorimawari',true));

		// 現行利回り v5.7.2
		$my_custom_kakakurimawari_data = isset($_POST['kakakurimawari']) ? $_POST['kakakurimawari'] : '';
		$my_custom_kakakurimawari_data = mb_convert_kana($my_custom_kakakurimawari_data,"a","UTF-8" );
		$my_custom_kakakurimawari_data = myIsNum_f( $my_custom_kakakurimawari_data );

		if($my_custom_kakakurimawari_data !=get_post_meta($post_id, 'kakakurimawari', true))
			update_post_meta($post_id, 'kakakurimawari',$my_custom_kakakurimawari_data);
		elseif($my_custom_kakakurimawari_data == "")
			delete_post_meta($post_id, 'kakakurimawari',get_post_meta($post_id,'kakakurimawari',true));

		// 住宅保険料 v5.7.2
		$my_custom_kakakuhoken_data = isset($_POST['kakakuhoken']) ? $_POST['kakakuhoken'] : '';
		$my_custom_kakakuhoken_data = mb_convert_kana($my_custom_kakakuhoken_data,"a","UTF-8" );
		$my_custom_kakakuhoken_data = str_replace(",","",$my_custom_kakakuhoken_data);
		$my_custom_kakakuhoken_data = str_replace("\\","",$my_custom_kakakuhoken_data);
		$my_custom_kakakuhoken_data = str_replace("￥","",$my_custom_kakakuhoken_data);
		$my_custom_kakakuhoken_data = myIsNum_f( $my_custom_kakakuhoken_data );

		if($my_custom_kakakuhoken_data !=get_post_meta($post_id, 'kakakuhoken', true))
			update_post_meta($post_id, 'kakakuhoken',$my_custom_kakakuhoken_data);
		elseif($my_custom_kakakuhoken_data == "")
			delete_post_meta($post_id, 'kakakuhoken',get_post_meta($post_id,'kakakuhoken',true));

		// 住宅保険期間 v5.7.2
		$my_custom_kakakuhokenkikan_data = isset($_POST['kakakuhokenkikan']) ? esc_attr( stripslashes( $_POST['kakakuhokenkikan'] )): '';
		if($my_custom_kakakuhokenkikan_data !=get_post_meta($post_id, 'kakakuhokenkikan', true))
			update_post_meta($post_id, 'kakakuhokenkikan',$my_custom_kakakuhokenkikan_data);
		elseif($my_custom_kakakuhokenkikan_data == "")
			delete_post_meta($post_id, 'kakakuhokenkikan',get_post_meta($post_id,'kakakuhokenkikan',true));

		// 借地料 v5.7.2
		$my_custom_shakuchiryo_data = isset($_POST['shakuchiryo']) ? $_POST['shakuchiryo'] : '';
		$my_custom_shakuchiryo_data = mb_convert_kana($my_custom_shakuchiryo_data,"a","UTF-8" );
		$my_custom_shakuchiryo_data = str_replace(",","",$my_custom_shakuchiryo_data);
		$my_custom_shakuchiryo_data = str_replace("\\","",$my_custom_shakuchiryo_data);
		$my_custom_shakuchiryo_data = str_replace("￥","",$my_custom_shakuchiryo_data);
		$my_custom_shakuchiryo_data = myIsNum_f( $my_custom_shakuchiryo_data );

		if($my_custom_shakuchiryo_data !=get_post_meta($post_id, 'shakuchiryo', true))
			update_post_meta($post_id, 'shakuchiryo',$my_custom_shakuchiryo_data);
		elseif($my_custom_shakuchiryo_data == "")
			delete_post_meta($post_id, 'shakuchiryo',get_post_meta($post_id,'shakuchiryo',true));

		// 契約期間(年)
		// 契約期間(月)	 v5.7.2
		$my_custom_shakuchikikan_data = isset($_POST['shakuchikikan']) ? esc_attr( stripslashes( $_POST['shakuchikikan'] )) : '';
		if( strcmp($my_custom_shakuchikikan_data,get_post_meta($post_id, 'shakuchikikan', true)) != 0 )
			update_post_meta($post_id, 'shakuchikikan',$my_custom_shakuchikikan_data);
		elseif($my_custom_shakuchikikan_data == "")
			delete_post_meta($post_id, 'shakuchikikan',get_post_meta($post_id,'shakuchikikan',true));

		// 契約期間(区分) v5.7.2
		$my_custom_shakuchikubun_data = isset($_POST['shakuchikubun']) ? esc_attr( stripslashes( $_POST['shakuchikubun'] )): '';
		if($my_custom_shakuchikubun_data !=get_post_meta($post_id, 'shakuchikubun', true))
			update_post_meta($post_id, 'shakuchikubun',$my_custom_shakuchikubun_data);
		elseif($my_custom_shakuchikubun_data == "")
			delete_post_meta($post_id, 'shakuchikubun',get_post_meta($post_id,'shakuchikubun',true));

		// 修繕積立金 v5.7.2	
		$my_custom_kakakutsumitate_data = isset($_POST['kakakutsumitate']) ? $_POST['kakakutsumitate'] : '';
		$my_custom_kakakutsumitate_data = mb_convert_kana($my_custom_kakakutsumitate_data,"a","UTF-8" );
		$my_custom_kakakutsumitate_data = str_replace(",","",$my_custom_kakakutsumitate_data);
		$my_custom_kakakutsumitate_data = str_replace("\\","",$my_custom_kakakutsumitate_data);
		$my_custom_kakakutsumitate_data = str_replace("￥","",$my_custom_kakakutsumitate_data);
		$my_custom_kakakutsumitate_data = myIsNum_f( $my_custom_kakakutsumitate_data );

		if($my_custom_kakakutsumitate_data !=get_post_meta($post_id, 'kakakutsumitate', true))
			update_post_meta($post_id, 'kakakutsumitate',$my_custom_kakakutsumitate_data);
		elseif($my_custom_kakakutsumitate_data == "")
			delete_post_meta($post_id, 'kakakutsumitate',get_post_meta($post_id,'kakakutsumitate',true));
	}else{
			return $post_id;
	}
}


// 駐車場料金 
function custom_save_chushajoryokin ( $post_id ) {
	if ( isset($_POST['mycustom_chushajoryokin_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_chushajoryokin_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 駐車場料金 v5.7.2
		$my_custom_chushajoryokin_data = isset($_POST['chushajoryokin']) ? $_POST['chushajoryokin'] : '';
		$my_custom_chushajoryokin_data = mb_convert_kana($my_custom_chushajoryokin_data,"a","UTF-8" );
		$my_custom_chushajoryokin_data = str_replace(",","",$my_custom_chushajoryokin_data);
		$my_custom_chushajoryokin_data = str_replace("\\","",$my_custom_chushajoryokin_data);
		$my_custom_chushajoryokin_data = str_replace("￥","",$my_custom_chushajoryokin_data);
		$my_custom_chushajoryokin_data = myIsNum_f( $my_custom_chushajoryokin_data );

		if($my_custom_chushajoryokin_data !=get_post_meta($post_id, 'chushajoryokin', true))
			update_post_meta($post_id, 'chushajoryokin',$my_custom_chushajoryokin_data);
		elseif($my_custom_chushajoryokin_data == "")
			delete_post_meta($post_id, 'chushajoryokin',get_post_meta($post_id,'chushajoryokin',true));

		// 駐車場区分 v5.7.2
		$my_custom_chushajokubun_data = isset($_POST['chushajokubun']) ? esc_attr( stripslashes( $_POST['chushajokubun'] )): '';
		if($my_custom_chushajokubun_data !=get_post_meta($post_id, 'chushajokubun', true))
			update_post_meta($post_id, 'chushajokubun',$my_custom_chushajokubun_data);
		elseif($my_custom_chushajokubun_data == "")
			delete_post_meta($post_id, 'chushajokubun',get_post_meta($post_id,'chushajokubun',true));

		// 駐車場備考 TexaArea v5.7.2
		$my_custom_chushajobiko_data = isset($_POST['chushajobiko']) ? $_POST['chushajobiko']: '';
		$my_custom_chushajobiko_data= wp_kses( $my_custom_chushajobiko_data, wp_kses_allowed_html( 'post' ));

		if($my_custom_chushajobiko_data !=get_post_meta($post_id, 'chushajobiko', true))
			update_post_meta($post_id, 'chushajobiko',$my_custom_chushajobiko_data);
		elseif($my_custom_chushajobiko_data == "")
			delete_post_meta($post_id, 'chushajobiko',get_post_meta($post_id,'chushajobiko',true));
	}else{
			return $post_id;
	}
}


// 現況 
function custom_save_nyukyogenkyo ( $post_id ) {
	if ( isset($_POST['mycustom_nyukyogenkyo_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_nyukyogenkyo_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 現況 v5.7.2
		$my_custom_nyukyogenkyo_data = isset($_POST['nyukyogenkyo']) ? esc_attr( stripslashes( $_POST['nyukyogenkyo'] )): '';
		if($my_custom_nyukyogenkyo_data !=get_post_meta($post_id, 'nyukyogenkyo', true))
			update_post_meta($post_id, 'nyukyogenkyo',$my_custom_nyukyogenkyo_data);
		elseif($my_custom_nyukyogenkyo_data == "")
			delete_post_meta($post_id, 'nyukyogenkyo',get_post_meta($post_id,'nyukyogenkyo',true));

		// 引渡/入居時期 v5.7.2
		$my_custom_nyukyojiki_data = isset($_POST['nyukyojiki']) ? esc_attr( stripslashes( $_POST['nyukyojiki'] )): '';
		if($my_custom_nyukyojiki_data !=get_post_meta($post_id, 'nyukyojiki', true))
			update_post_meta($post_id, 'nyukyojiki',$my_custom_nyukyojiki_data);
		elseif($my_custom_nyukyojiki_data == "")
			delete_post_meta($post_id, 'nyukyojiki',get_post_meta($post_id,'nyukyojiki',true));

		// 引渡/入居年月 v5.7.2
		$my_custom_nyukyonengetsu_data = isset($_POST['nyukyonengetsu']) ? esc_attr( stripslashes( $_POST['nyukyonengetsu'] )): '';
		if($my_custom_nyukyonengetsu_data !=get_post_meta($post_id, 'nyukyonengetsu', true))
			update_post_meta($post_id, 'nyukyonengetsu',$my_custom_nyukyonengetsu_data);
		elseif($my_custom_nyukyonengetsu_data == "")
			delete_post_meta($post_id, 'nyukyonengetsu',get_post_meta($post_id,'nyukyonengetsu',true));

		// 引渡/入居旬 v5.7.2
		$my_custom_nyukyosyun_data = isset($_POST['nyukyosyun']) ? esc_attr( stripslashes( $_POST['nyukyosyun'] )): '';
		if($my_custom_nyukyosyun_data !=get_post_meta($post_id, 'nyukyosyun', true))
			update_post_meta($post_id, 'nyukyosyun',$my_custom_nyukyosyun_data);
		elseif($my_custom_nyukyosyun_data == "")
			delete_post_meta($post_id, 'nyukyosyun',get_post_meta($post_id,'nyukyosyun',true));
	}else{
			return $post_id;
	}
}


// 周辺環境
function custom_save_shuuhenshougaku ( $post_id ) {
	if ( isset($_POST['mycustom_shuuhenshougaku_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_shuuhenshougaku_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 小学校名 v5.7.2
		$my_custom_shuuhenshougaku_data = isset($_POST['shuuhenshougaku'] ) ? esc_attr( stripslashes( $_POST['shuuhenshougaku'] )): '';
		if( strcmp($my_custom_shuuhenshougaku_data,get_post_meta($post_id, 'shuuhenshougaku', true)) != 0 )
			update_post_meta($post_id, 'shuuhenshougaku',$my_custom_shuuhenshougaku_data);
		elseif($my_custom_shuuhenshougaku_data == "")
			delete_post_meta($post_id, 'shuuhenshougaku',get_post_meta($post_id,'shuuhenshougaku',true));

		// 中学校名 v5.7.2
		$my_custom_shuuhenchuugaku_data = isset($_POST['shuuhenchuugaku']) ? esc_attr( stripslashes( $_POST['shuuhenchuugaku'] )): '';
		if( strcmp($my_custom_shuuhenchuugaku_data,get_post_meta($post_id, 'shuuhenchuugaku', true)) != 0 )
			update_post_meta($post_id, 'shuuhenchuugaku',$my_custom_shuuhenchuugaku_data);
		elseif($my_custom_shuuhenchuugaku_data == "")
			delete_post_meta($post_id, 'shuuhenchuugaku',get_post_meta($post_id,'shuuhenchuugaku',true));


		// その他周辺環境 TexaArea v5.7.2
		$my_custom_shuuhensonota_data = isset($_POST['shuuhensonota']) ? $_POST['shuuhensonota'] : '';
		$my_custom_shuuhensonota_data = wp_kses( $my_custom_shuuhensonota_data, wp_kses_allowed_html( 'post' ));

		if( strcmp($my_custom_shuuhensonota_data,get_post_meta($post_id, 'shuuhensonota', true)) != 0 )
			update_post_meta($post_id, 'shuuhensonota',$my_custom_shuuhensonota_data);
		elseif($my_custom_shuuhensonota_data == "")
			delete_post_meta($post_id, 'shuuhensonota',get_post_meta($post_id,'shuuhensonota',true));

	}else{
			return $post_id;
	}
}


// 取引態様 v5.7.2
function custom_save_torihikitaiyo ( $post_id ) {
	if ( isset($_POST['mycustom_torihikitaiyo_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_torihikitaiyo_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		$my_custom_torihikitaiyo_data = isset($_POST['torihikitaiyo']) ? esc_attr( stripslashes( $_POST['torihikitaiyo'] )): '';
		if($my_custom_torihikitaiyo_data !=get_post_meta($post_id, 'torihikitaiyo', true))
			update_post_meta($post_id, 'torihikitaiyo',$my_custom_torihikitaiyo_data);
		elseif($my_custom_torihikitaiyo_data == "")
			delete_post_meta($post_id, 'torihikitaiyo',get_post_meta($post_id,'torihikitaiyo',true));
	}else{
			return $post_id;
	}
}


// 物件画像 v5.7.2
function custom_save_gazo( $post_id ) {
	global $post,$work_gazo,$work_gazo2;

	if( FUDOU_IMG_MAX > 10 ){
		$work_gazo = array_merge($work_gazo, $work_gazo2);
	}
	if ( isset($_POST['mycustom_gazo_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_gazo_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}

		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id ))
			return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id ))
			return $post_id;
		}

		foreach($work_gazo as $meta_box) {

			$data = isset($_POST[$meta_box['name']]) ? esc_attr( stripslashes( $_POST[$meta_box['name']] )): '';
			if(get_post_meta($post_id, $meta_box['name']) == "")
				add_post_meta($post_id, $meta_box['name'], $data, true);
			elseif($data != get_post_meta($post_id, $meta_box['name'], true))
				update_post_meta($post_id, $meta_box['name'], $data);
			elseif($data == "")
				delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
		}
	}else{
			return $post_id;
	}
}


// 設備・条件 v5.7.2
function custom_save_setsubi( $post_id ) {
	global $post, $work_setsubi;

	if ( isset($_POST['mycustom_setsubi_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_setsubi_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		$my_custom_setsubi_data = "99900";

		foreach($work_setsubi as $meta_box){
			$work_pos_namet="setsubi".$meta_box['code'];
			$my_custom_setsubi_data .= isset($_POST[$work_pos_namet]) ? esc_attr( stripslashes( $_POST[$work_pos_namet] )): '';
		}
		if( strcmp($my_custom_setsubi_data,get_post_meta($post_id, 'setsubi', true)) != 0 )
			update_post_meta($post_id, 'setsubi',$my_custom_setsubi_data);
		elseif($my_custom_setsubi_data == "")
			delete_post_meta($post_id, 'setsubi',get_post_meta($post_id,'setsubi',true));

		// 設備・条件その他 TexaArea v5.7.2
		$my_custom_setsubisonota_data = isset($_POST['setsubisonota']) ? $_POST['setsubisonota'] : '';
		$my_custom_setsubisonota_data = wp_kses( $my_custom_setsubisonota_data, wp_kses_allowed_html( 'post' ));

		if($my_custom_setsubisonota_data !=get_post_meta($post_id, 'setsubisonota', true))
			update_post_meta($post_id, 'setsubisonota',$my_custom_setsubisonota_data);
		elseif($my_custom_setsubisonota_data == "")
			delete_post_meta($post_id, 'setsubisonota',get_post_meta($post_id,'setsubisonota',true));
	}else{
			return $post_id;
	}
}


// 特記事項 tokkinotices
function custom_save_tokkinotices ( $post_id ) {
	if ( isset($_POST['mycustom_tokkinotices_name']) ){
		if ( !wp_verify_nonce( $_POST['mycustom_tokkinotices_name'], plugin_basename(__FILE__) )) {
			return $post_id;
		}
		if ( isset($_POST['post_type']) && 'fudo' == $_POST['post_type'] ) {
			if ( !current_user_can( 'edit_page', $post_id )) return $post_id;
		} else {
			if ( !current_user_can( 'edit_post', $post_id )) return $post_id;
		}

		// 特記事項 TexaArea v5.7.2
		$my_custom_tokkinotices_data = isset($_POST['tokkinotices'] ) ? $_POST['tokkinotices'] : '';
		$my_custom_tokkinotices_data = wp_kses( $my_custom_tokkinotices_data, wp_kses_allowed_html( 'post' ));

		if( strcmp($my_custom_tokkinotices_data,get_post_meta($post_id, 'tokkinotices', true)) != 0 )
			update_post_meta($post_id, 'tokkinotices',$my_custom_tokkinotices_data);
		elseif($my_custom_tokkinotices_data == "")
			delete_post_meta($post_id, 'tokkinotices',get_post_meta($post_id,'tokkinotices',true));

	}else{
			return $post_id;
	}
}


/**
 *
 * Left関数 $str文字列を左からn文字取得して返す 
 *
 * @since Fudousan Plugin 1.0.0
 * @param  string $str
 * @param  int g$n
 * @return $str
 */
if (!function_exists('myLeft')) {
function myLeft($str,$n){
        if(mb_strlen($str,"utf-8") <= $n){
		return $str;
	}else{
		return mb_substr($str,0,(mb_strlen($str,"utf-8")-$n)*-1,"utf-8");
	}
}
}

/**
 *
 * Right関数 $str文字列を右からn文字取得して返す 
 *
 * @since Fudousan Plugin 1.0.0
 * @param  string $str
 * @param  int $n
 * @return $str
 */
if (!function_exists('myRight')) {
function myRight($str,$n){
	return mb_substr($str,($n)*-1);
}
}



/*
 *
 * 不動産会員2チェック
 * ユーザー別会員物件リスト
 *
 * @since Fudousan Plugin 1.7.12
 * @subpackage Fudousan mail Plugin
 * @param  int $post_id
 * @param  int $kaiin_users_rains_register
 * @param  int $kaiin
 * @return bool true/false
*/
function users_kaiin_bukkenlist( $post_id, $kaiin_users_rains_register, $kaiin ){

	global $is_fudoumail;

	$id_data = '';

	//if($kaiin_users_rains_register == 1 && $kaiin == 1 && $is_fudoumail ){
	if($kaiin_users_rains_register == 1 && $kaiin > 0 && $is_fudoumail ){

		global $wpdb;

		//global $userdata; 
		//get_currentuserinfo();
		$userdata = wp_get_current_user( ); 
		if( isset( $userdata->ID ) ){
			$user_mail_ID = $userdata->ID;
		}else{
			$user_mail_ID = 0;
		}

		//条件種別
			$user_mail_shu = maybe_unserialize( get_user_meta( $user_mail_ID, 'user_mail_shu', true) );

			if ( $user_mail_shu && is_array( $user_mail_shu ) ) {
				$i=0;
				$shu_data = ' IN ( 0 ';
				foreach($user_mail_shu as $meta_set){
					if( $user_mail_shu[$i] ){
						$shu_data .= ','. $user_mail_shu[$i] . '';
						$i++;
					}
				}
				$shu_data .= ') ';

				$sql = "SELECT DISTINCT( P.ID )";
				$sql .=  " FROM $wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ";
				$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
				$sql .=  " AND PM.meta_key='bukkenshubetsu' AND PM.meta_value ".$shu_data."";
				$sql .=  " AND P.ID = ".$post_id."";
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_row( $sql );
				if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';
			}

		//echo '<br />条件種別 ';
		//echo $id_data;


		//条件エリア
			$user_mail_sik = maybe_unserialize( get_user_meta( $user_mail_ID, 'user_mail_sik', true) );

			if( $user_mail_sik && is_array( $user_mail_sik ) && $id_data !='' ){
				$i=0;
				$sik_data = ' IN ( 0 ';
				foreach($user_mail_sik as $meta_set){
					if( $user_mail_sik[$i] ){
						$sik_data .= ','. $user_mail_sik[$i] . '';
						$i++;
					}
				}
				$sik_data .= ') ';

				$sql  = "SELECT DISTINCT( P.ID )";
				$sql .= " FROM $wpdb->posts AS P";
				$sql .= " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ";
				$sql .= " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
				$sql .= " AND PM.meta_key='shozaichicode' AND PM.meta_value ".$sik_data."";
				$sql .= " AND P.ID = ".$post_id."";
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_row( $sql );
				if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';
			}


		//echo '<br />条件エリア ';
		//echo $id_data;


		//条件路線駅
			$user_mail_eki = maybe_unserialize( get_user_meta( $user_mail_ID, 'user_mail_eki', true) );

			if( $user_mail_eki && is_array( $user_mail_eki ) && $id_data !='' ){
				$i=0;
				$eki_data = ' IN ( 0 ';
				foreach($user_mail_eki as $meta_set){
					if( $user_mail_eki[$i] ){
						$eki_data .= ',' . intval(myLeft($user_mail_eki[$i],6)) . intval(myRight($user_mail_eki[$i],6));
						$i++;
					}
				}
				$eki_data .= ') ';

				$sql = "SELECT DISTINCT( P.ID )";
				$sql .=  " FROM ($wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ";
				$sql .=  " WHERE  P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
				$sql .=  " AND PM.meta_key='koutsurosen1' AND PM_1.meta_key='koutsueki1' ";
				$sql .=  " AND concat( PM.meta_value,PM_1.meta_value) " . $eki_data . "";
				$sql .=  " AND P.ID = ".$post_id."";
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_row( $sql );
				if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';

				//交通2 try
				if($id_data == ''){ 

					$sql = "SELECT DISTINCT( P.ID )";
					$sql .=  " FROM ($wpdb->posts AS P";
					$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
					$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ";
					$sql .=  " WHERE  P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
					$sql .=  " AND PM.meta_key='koutsurosen2' AND PM_1.meta_key='koutsueki2' ";
					$sql .=  " AND concat( PM.meta_value,PM_1.meta_value) " . $eki_data . "";
					$sql .=  " AND P.ID = ".$post_id."";
					//$sql = $wpdb->prepare($sql,'');
					$metas = $wpdb->get_row( $sql );
					if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';
				}
			}

		//echo '<br />条件路線駅 ';
		//echo $id_data;


		//条件追加用
			$id_data = apply_filters( 'users_kaiin_bukkenlist_org', $id_data, $post_id, $user_mail_ID );


		//条件価格
			$kalb_data = intval( get_user_meta( $user_mail_ID, 'user_mail_kalb', true ) );
			$kahb_data = intval( get_user_meta( $user_mail_ID, 'user_mail_kahb', true ) );
			$kalc_data = intval( get_user_meta( $user_mail_ID, 'user_mail_kalc', true ) );
			$kahc_data = intval( get_user_meta( $user_mail_ID, 'user_mail_kahc', true ) );

			if( ( $kalb_data + $kahb_data + $kalc_data + $kahc_data ) > 0 && $id_data !='' ){

				//売買
				$kalb_data =$kalb_data*10000 ;
				if($kahb_data == 0 ){
					$kahb_data = 1000000000 ;
				}else{
					$kahb_data =$kahb_data*10000 ;
				}

				//賃貸
				$kalc_data =$kalc_data*10000 ;
				if($kahc_data == 0 ){
					$kahc_data = 9990000 ;
				}else{
					$kahc_data =$kahc_data*10000 ;
				}


				$sql = "SELECT DISTINCT( P.ID )";
				$sql .=  " FROM ($wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id )";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ";
				$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
				$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED) < 3000";
				$sql .=  " AND PM.meta_key='kakaku'";
				$sql .=  " AND CAST(PM.meta_value AS SIGNED) >= $kalb_data AND CAST(PM.meta_value AS SIGNED) <= $kahb_data  ";
				$sql .=  " AND P.ID = ".$post_id."";
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_row( $sql );
				if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';


				if($id_data == ''){ 
					$sql = "SELECT DISTINCT( P.ID )";
					$sql .=  " FROM ($wpdb->posts AS P";
					$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id )";
					$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ";
					$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
					$sql .=  " AND PM_1.meta_key='bukkenshubetsu' AND CAST(PM_1.meta_value AS SIGNED) > 3000";
					$sql .=  " AND PM.meta_key='kakaku'";
					$sql .=  " AND CAST(PM.meta_value AS SIGNED) >= $kalc_data  AND CAST(PM.meta_value AS SIGNED) <= $kahc_data ";
				//	$sql .=  " OR ( P.ID " . $id_data2 . ")";
					$sql .=  " AND P.ID = ".$post_id."";
					//$sql = $wpdb->prepare($sql,'');
					$metas = $wpdb->get_row( $sql );
					if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';
				}
			}

		//echo '<br />価格 ';
		//echo $id_data;



		//専有面積
			$tatemo_l_data = get_user_meta( $user_mail_ID, 'user_mail_tatemonomenseki_l', true);
			$tatemo_h_data = get_user_meta( $user_mail_ID, 'user_mail_tatemonomenseki_h', true);

			if( !empty($tatemo_l_data) || !empty($tatemo_h_data) ){

				if( empty($tatemo_l_data) ) $tatemo_l_data = 1 ;
				if( empty($tatemo_h_data) ) $tatemo_h_data = 9999 ;

				if(( $tatemo_l_data != 1 || $tatemo_h_data != 9999 ) && $id_data !='' ){
					$sql = "SELECT DISTINCT( P.ID )";
					$sql .=  " FROM $wpdb->posts AS P";
					$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id ";
					$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
					$sql .=  " AND PM_2.meta_key='tatemonomenseki'";
					$sql .=  " AND PM_2.meta_value *100 >= $tatemo_l_data*100 ";
					$sql .=  " AND PM_2.meta_value *100 <= $tatemo_h_data*100 ";
					$sql .=  " AND P.ID = ".$post_id."";
					//$sql = $wpdb->prepare($sql,'');
					$metas = $wpdb->get_row( $sql );
					if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';
				}
			}

		//echo '<br />専有面積 ';
		//echo $metas->ID;


		//土地面積
			$tochim_l_data = get_user_meta( $user_mail_ID, 'user_mail_tochikukaku_l', true);
			$tochim_h_data = get_user_meta( $user_mail_ID, 'user_mail_tochikukaku_h', true);

			if( !empty($tochim_l_data) || !empty($tochim_h_data) ){

				if( empty($tochim_l_data) ) $tochim_l_data = 1 ;
				if( empty($tochim_h_data) ) $tochim_h_data = 9999 ;

				if(( $tochim_l_data != 1 || $tochim_h_data != 9999 ) && $id_data !='' ){
					$sql = "SELECT DISTINCT( P.ID )";
					$sql .=  " FROM $wpdb->posts AS P";
					$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2 ON P.ID = PM_2.post_id ";
					$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
					$sql .=  " AND PM_2.meta_key='tochikukaku'";
					$sql .=  " AND PM_2.meta_value *100 >= $tochim_l_data*100 ";
					$sql .=  " AND PM_2.meta_value *100 <= $tochim_h_data*100 ";
					$sql .=  " AND P.ID = ".$post_id."";
					//$sql = $wpdb->prepare($sql,'');
					$metas = $wpdb->get_row( $sql );
					if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';
				}
			}
		//echo '<br />土地面積 ';
		//echo $metas->ID;




		//条件間取り
			$user_mail_madori = maybe_unserialize( get_user_meta( $user_mail_ID, 'user_mail_madori', true) );

			if( $user_mail_madori && is_array( $user_mail_madori ) && $id_data !='' ){
				$i=0;
				$madori_data = ' IN ( 0 ';
				foreach($user_mail_madori as $meta_set){
					if( $user_mail_madori[$i] ){
						$madori_data .= ','. $user_mail_madori[$i] . '';
						$i++;
					}
				}
				$madori_data .= ') ';

				$sql = "SELECT DISTINCT( P.ID )";
				$sql .=  " FROM ($wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM   ON P.ID = PM.post_id) ";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_1 ON P.ID = PM_1.post_id ";
				$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
				$sql .=  " AND PM.meta_key='madorisu' AND PM_1.meta_key='madorisyurui' ";
				$sql .=  " AND concat( PM.meta_value,PM_1.meta_value) " . $madori_data . "";
				$sql .=  " AND P.ID = ".$post_id."";
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_row( $sql );
				if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';

			}

		//echo '<br />間取り ';
		//echo $id_data;

		//駅歩分
			$hof_data = get_user_meta( $user_mail_ID, 'user_mail_hohun', true);

			if( $hof_data != 0  && $id_data !='' ){

				$sql = "SELECT DISTINCT( P.ID )";
				$sql .=  " FROM $wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM_2   ON P.ID = PM_2.post_id ";
				$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
				$sql .=  " AND (PM_2.meta_key='koutsutoho1f' OR PM_2.meta_key='koutsutoho2f' )";
				$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) > 0 ";
				$sql .=  " AND CAST(PM_2.meta_value AS SIGNED) <= $hof_data ";
				$sql .=  " AND P.ID = ".$post_id."";
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_row( $sql );
				if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';
			}

		//echo '<br />歩分 ';
		//echo $id_data;


		//条件設備
			$user_mail_setsubi = maybe_unserialize( get_user_meta( $user_mail_ID, 'user_mail_setsubi', true) );

			if( $user_mail_setsubi && is_array( $user_mail_setsubi ) && $id_data !='' ){
				$i=0;
				$setsubi_data = " AND (";
				foreach($user_mail_setsubi as $meta_set){
				//	if($i!=0) $setsubi_data .= " OR ";
					if($i!=0) $setsubi_data .= " AND ";
					if( $user_mail_setsubi[$i] ){
						$setsubi_data .= " PM.meta_value LIKE '%/". $user_mail_setsubi[$i] . "%' ";
						$i++;
					}
				}
				$setsubi_data .= ")";

				$sql = "SELECT DISTINCT( P.ID )";
				$sql .=  " FROM $wpdb->posts AS P";
				$sql .=  " INNER JOIN $wpdb->postmeta AS PM ON P.ID = PM.post_id ";
				$sql .=  " WHERE P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
				$sql .=  " AND PM.meta_key='setsubi' ".$setsubi_data."";
				$sql .=  " AND P.ID = ".$post_id."";
				//$sql = $wpdb->prepare($sql,'');
				$metas = $wpdb->get_row( $sql );
				if( !empty($metas->ID) ) $id_data = $metas->ID; else $id_data ='';

			}

		//echo '<br />設備 ';
		//echo $id_data;

		if( $id_data != ''){
			$view = true;	//表示
		}else{
			$view = false;	//非表示
		}
	}else{
		$view = true;	//表示
	}

	return apply_filters( 'users_kaiin_bukkenlist', $view, $post_id, $kaiin_users_rains_register, $kaiin );
}

/*
 *
 * 不動産会員チェック
 * 会員項目表示判定
 *
 * @since Fudousan Plugin 1.7.4
 * @subpackage Fudousan mail Plugin
 * @param  int $koumoku
 * @param  int $kaiin
 * @param  int $kaiin2
 * @return bool true/false
*/
function my_custom_kaiin_view( $koumoku, $kaiin, $kaiin2 ) {

	$koumoku_value = get_option( $koumoku );
	//if( ( $koumoku_value != 1 && $kaiin == 1 )  || ( $koumoku_value != 1 && $kaiin == 0 && !$kaiin2 ) ) {
	if( ( $koumoku_value != 1 && $kaiin > 0 )  || ( $koumoku_value != 1 && $kaiin == 0 && !$kaiin2 ) ) {
		$view = false;	//非表示
	}else{
		$view = true;	//表示
	}
	return apply_filters( 'fudou_kaiin_bukken_tiramise', $view, $koumoku, $kaiin, $kaiin2 );
}



/*
 * プレースホルダー
 *
 * ver5.2.0
 */
function fudou_add_mce_content_placeholder( $plugin_array ){

	//Gutenberg 利用
	$opt_fudo_use_gutenberg = get_option( 'fudo_use_gutenberg' );
	if( $opt_fudo_use_gutenberg != 'true' ){
		if( 'fudo' === get_post_type() ){
			$plugin_array[ 'placeholder' ] = plugins_url( '/fudou/js/mce_plugin_manager.min.js' );
		}
	}
	return $plugin_array;
}
add_filter( 'mce_external_plugins', 'fudou_add_mce_content_placeholder' );

function fudou_add_the_editor_placeholder( $the_editor_html ){

	//Gutenberg 利用
	$opt_fudo_use_gutenberg = get_option( 'fudo_use_gutenberg' );
	if( $opt_fudo_use_gutenberg != 'true' ){
		if( 'fudo' === get_post_type() ){
			$placeholder = '【コンテンツ欄】物件をアピールするコンテンツがあれば自由に入力してください。';
			$the_editor_html = preg_replace( '/<textarea/', "<textarea placeholder=\"{$placeholder}\"", $the_editor_html );
		}
	}
	return $the_editor_html;
}
add_filter( 'the_editor', 'fudou_add_the_editor_placeholder' );



/*
 * リターンキー無効 Gutenberg利用時
 *
 * ver5.3.1
 */
function fudou_admin_footer_keydown_script(){

	global $post;
	if( !empty( $post->post_type ) &&  $post->post_type == 'fudo' ){

		//Gutenberg 利用
		$opt_fudo_use_gutenberg = get_option( 'fudo_use_gutenberg' );
		if( $opt_fudo_use_gutenberg == 'true' ){
			?>
			<script language="javascript">
				jQuery(function(){
					jQuery("input"). keydown(function(e) {
						if ((e.which && e.which === 13) || (e.keyCode && e.keyCode === 13)) {
							return false;
						} else {
							return true;
						};
					});
				});
			</script>
			<?php
		}
	}
}
add_filter( 'admin_footer-post.php', 'fudou_admin_footer_keydown_script' );
add_filter( 'admin_footer-post-new.php', 'fudou_admin_footer_keydown_script' );

