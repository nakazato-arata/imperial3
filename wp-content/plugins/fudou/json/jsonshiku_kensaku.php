<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress5.6
 * @subpackage Fudousan Plugin
 * Version: 5.6.1
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', false);

/** Loads the WordPress Environment and Template */
require_once '../../../../wp-blog-header.php';

//$wpdb->show_errors();

	global $wpdb;

	status_header( 200 );
	header("Content-Type: text/plain; charset=utf-8");
	header("X-Content-Type-Options: nosniff");

	$shu_data = isset($_POST['shu']) ? myIsNum_f($_POST['shu']) : '';
	if(empty($shu_data))
		$shu_data = isset($_GET['shu']) ? myIsNum_f($_GET['shu']) : '';

	if($shu_data == '1') 
		$shu_data = '< 3000' ;
	if($shu_data == '2') 
		$shu_data = '> 3000' ;

	if(intval($shu_data) > 3) 
		$shu_data = '= ' .$shu_data ;


	$shozaichiken_data = isset($_POST['ken']) ? myIsNum_f($_POST['ken']) : '';
	if(empty($shozaichiken_data)) 
		$shozaichiken_data = isset($_GET['ken']) ? myIsNum_f($_GET['ken']) : '';


	if(!empty($shozaichiken_data) && !empty($shu_data)) {

		//市区
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
		$sql .=  " AND P.post_status='publish' AND P.post_password = '' AND P.post_type ='fudo'";
		$sql .=  " AND PM_1.meta_key='bukkenshubetsu'";
		$sql .=  " AND CAST( PM_1.meta_value AS SIGNED ) ".$shu_data."";
		$sql .=  " AND CAST( LEFT(PM.meta_value,2) AS SIGNED ) = ". $shozaichiken_data;
		$sql .=  " AND NA.middle_area_id = ". $shozaichiken_data;

		//検索 SQL 表示制限 WHERE
		$sql .=  apply_filters( 'inc_archive_kensaku_sql_where', '' );
		//New 検索 SQL 表示制限 WHERE v5.6.1
		$sql  =  apply_filters( 'inc_archive_kensaku_sql_where_return', $sql, 'fudo_b_k' );

		$sql .=  " ORDER BY CAST( PM.meta_value AS SIGNED )";
		//$sql = $wpdb->prepare($sql,'');
		$metas = $wpdb->get_results( $sql,  ARRAY_A );

		$rstCount = 0;
		$GetDat = '';
		if(!empty($metas)) {
		
			foreach ( $metas as $meta ) {

				if ($rstCount==1){
					$GetDat = $GetDat. ",";
				}

				$meta_id = $meta['narrow_area_id'];
				$meta_valu = $meta['narrow_area_name'];

				$GetDat = $GetDat . "{'id':'".$meta_id."','name':'".$meta_valu."'}";
				$rstCount=1;

			}
			$SetDat = "{'shiku':[".$GetDat."]}";


		}else{
			$SetDat = "{'shiku':'','Err':'Err1'}";
		}
	}else{
		$SetDat = "{'shiku':'','Err':'Err2'}";
	}

	echo $SetDat;


//$wpdb->print_error();
