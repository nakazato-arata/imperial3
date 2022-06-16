<?php
/*
 * 不動産プラグインデーターベース設定
 * @package WordPress 5.0
 * @subpackage Fudousan Plugin
 * Version: 5.0.0
*/

if( !defined('DB_KEN_TABLE') )		define('DB_KEN_TABLE'	,'area_middle_area');
if( !defined('DB_SHIKU_TABLE') )	define('DB_SHIKU_TABLE'	,'area_narrow_area');
if( !defined('DB_ROSENKEN_TABLE') )	define('DB_ROSENKEN_TABLE','train_area_rosen');
if( !defined('DB_ROSEN_TABLE') )	define('DB_ROSEN_TABLE'	,'train_rosen');
if( !defined('DB_EKI_TABLE') )		define('DB_EKI_TABLE'	,'train_station');
if( !defined('DB_ROSENLATLNG_TABLE') )	define('DB_ROSENLATLNG_TABLE'	,'train_latlng');


function databaseinstallation_fudo($state){

	if ( current_user_can('activate_plugins') ) {

		global $wpdb;

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		include_once('fudo_database.php');

		$char = defined("DB_CHARSET") ? DB_CHARSET : "utf8";

		//テーブル DB_KEN_TABLE
		$table_name = $wpdb->prefix . DB_KEN_TABLE;
		if($wpdb->get_var( "show tables like '$table_name'") != $table_name ) {
			$table1 = "CREATE TABLE " . $table_name . " (";
			$table1 .= "	middle_area_id int(11) NOT NULL,";
			$table1 .= "	middle_area_name varchar(8) NOT NULL,";
			$table1 .= "	PRIMARY KEY  (middle_area_id)";
			$table1 .= "	) DEFAULT CHARSET=$char;";
			$result = $wpdb->query( $table1 );
			dbDelta( $table1 );

			$results1 = fudo_createdata( $table_name );
			//$results1 = $wpdb->get_var("show tables like '$table_name'") ;
		}


		//テーブル DB_SHIKU_TABLE 1.5.3
		$table_name = $wpdb->prefix . DB_SHIKU_TABLE;
		if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name) {
			$table2 = "CREATE TABLE " . $table_name . " (";
			$table2 .= "	narrow_area_id int(11) NOT NULL,";
			$table2 .= "	narrow_area_name varchar(20) NOT NULL,";
			$table2 .= "	middle_area_id int(11) NOT NULL,";
			$table2 .= "	city_area_id int(11) NOT NULL,";
			$table2 .= "	KEY narrow_middle_area_id (narrow_area_id,middle_area_id),";
			$table2 .= "	KEY middle_area_id (middle_area_id),";
			$table2 .= "	KEY city_area_id (city_area_id),";
			$table2 .= "	KEY narrow_area_name (narrow_area_name)";
			$table2 .= "	) DEFAULT CHARSET=$char;";
			$result = $wpdb->query( $table2 );
			dbDelta( $table2 );

			$results2 = fudo_createdata( $table_name );
			//$results2 = $wpdb->get_var("show tables like '$table_name'") ;

			if( empty( $results1 ) && empty( $results2 ) ){
				update_option( "fudo_area_db_version", FUDOU_AREA_DB_VERSION );
			}
		}


		//テーブル DB_ROSENKEN_TABLE
		$table_name = $wpdb->prefix . DB_ROSENKEN_TABLE;
		if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name) {
			$table3 = "CREATE TABLE " . $table_name . " (";
			$table3 .= "	middle_area_id int(11) NOT NULL,";
			$table3 .= "	rosen_id int(11) NOT NULL,";
			$table3 .= "	KEY  middle_area_id (middle_area_id),";
			$table3 .= "	KEY  rosen_id (rosen_id)";
			$table3 .= "	) DEFAULT CHARSET=$char;";
			$result = $wpdb->query( $table3 );
			dbDelta( $table3 );

			$results3 = fudo_createdata( $table_name );
			//$results3 = $wpdb->get_var("show tables like '$table_name'") ;
		}


		//テーブル DB_ROSEN_TABLE 1.5.0
		$table_name = $wpdb->prefix . DB_ROSEN_TABLE;
		if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name) {
			$table4 = "CREATE TABLE " . $table_name . " (";
			$table4 .= "	rosen_id int(11) NOT NULL,";
			$table4 .= "	rosen_name varchar(32) NOT NULL,";
			$table4 .= "	line_cd varchar(64) DEFAULT NULL,";
			$table4 .= "	company_cd int(11) NOT NULL,";
			$table4 .= "	PRIMARY KEY  (rosen_id) ,";
			$table4 .= "	KEY rosen_name (rosen_name)";
			$table4 .= "	) DEFAULT CHARSET=$char;";
			$result = $wpdb->query( $table4 );
			dbDelta( $table4 );

			$results4 = fudo_createdata( $table_name );
			//$results4 = $wpdb->get_var("show tables like '$table_name'") ;
		}


		//テーブル DB_EKI_TABLE
		$table_name = $wpdb->prefix . DB_EKI_TABLE;
		if($wpdb->get_var( "show tables like '$table_name'" ) != $table_name) {
			$table5 = "CREATE TABLE " . $table_name . " (";
			$table5 .= "	rosen_id int(11) NOT NULL,";
			$table5 .= "	station_id int(11) NOT NULL,";
			$table5 .= "	station_name varchar(32) NOT NULL,";
			$table5 .= "	station_ranking int(11) NOT NULL,";
			$table5 .= "	middle_area_id int(11) NOT NULL,";
			$table5 .= "	PRIMARY KEY  (rosen_id,station_id) ,";
			$table5 .= "	KEY rosen_id (rosen_id) ,";
			$table5 .= "	KEY station_id (station_id) ,";
			$table5 .= "	KEY station_name (station_name)";
			$table5 .= "	) DEFAULT CHARSET=$char;";
			$result = $wpdb->query( $table5 );
			dbDelta( $table5 );

			$results5 = fudo_createdata( $table_name );
			//$results5 = $wpdb->get_var("show tables like '$table_name'") ;

			if( empty( $results3 ) && empty( $results4 ) && empty( $results5 ) ){
				update_option( "fudo_train_db_version", FUDOU_TRAIN_DB_VERSION );
			}
		}
	}
}

