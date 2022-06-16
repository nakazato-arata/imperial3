<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress 5.2
 * @subpackage Fudousan Plugin
 * Version: 5.2.0
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', false);

/** Loads the WordPress Environment and Template */
require_once '../../../../wp-blog-header.php';

	if ( !current_user_can( 'edit_posts' ) ) {
		header('HTTP/1.1 403 Forbidden');
		exit();
	}

	status_header( 200 );

	$mode = '';
	$jusho   = isset($_GET['ju']) ? htmlentities($_GET['ju'], ENT_QUOTES, "UTF-8") : '';
	$post_id = isset($_GET['post_id']) ?  myIsNum_f($_GET['post_id']) : '';

	if($jusho=="")
		$jusho = "東京都";

	$lat = isset($_GET['lat']) ? myIsNum_f($_GET['lat']) : '';
	$lng = isset($_GET['lng']) ? myIsNum_f($_GET['lng']) : '';

	if( $post_id ){
		$lat = get_post_meta( $post_id, 'bukkenido', true );
		$lng = get_post_meta( $post_id, 'bukkenkeido', true );
	}


	if($lat==""){
		$lat = "35.689488";
		$mode = "geo";
	}

	if($lng==""){
		$lng = "139.691706";
		$mode = "geo";
	}

	//GoogleMaps API KEY
	$googlemaps_api_key = get_option('googlemaps_api_key');
	//GoogleMaps API KEY local use map1.7.5
	$googlemaps_api_key_local = get_option('googlemaps_api_key_local');
	$is_local = strpos( home_url() , '/localhost/' );

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<title></title>
<?php
	if( $googlemaps_api_key && $is_local === false ){ 
		echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=' . $googlemaps_api_key . '"></script>';
	}else{
		//GoogleMaps API KEY local use map1.7.5
		if( $googlemaps_api_key && $is_local !== false && $googlemaps_api_key_local ){
			echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=' . $googlemaps_api_key . '"></script>';
		}else{
			echo '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>';
		}
	} 
?>

<script type="text/javascript">
	var geocoder;
	var map;
	var gmapmark_b0 = '<?php echo plugins_url();?>/fudou/img/bus_r.png';
	var gmapmark_b1 = '<?php echo plugins_url();?>/fudou/img/bus_o.png';
	var gmapmark_b2 = '<?php echo plugins_url();?>/fudou/img/bus_b.png';
	var busmark1 = [<?php echo apply_filters( 'fudoubus_mapicon_single', '', $post_id, 1 );?>];
	var busmark2 = [<?php echo apply_filters( 'fudoubus_mapicon_single', '', $post_id, 2 );?>];

	function initialize() {
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(<?php echo $lat;?>, <?php echo $lng;?>);
		var myOptions = {
			zoom: 16,
			center: latlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			streetViewControl: true
		}
		map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		busstop_marker(busmark2,gmapmark_b2);
		busstop_marker(busmark1,gmapmark_b1);

		var centerIcon = new google.maps.Marker({
			icon: image
		});
		var image = new google.maps.MarkerImage(
			'centerMark.gif'
			, new google.maps.Size(39, 39)
			, new google.maps.Point(0,0)
			, new google.maps.Point(19,19)
		);
		var centerIcon = new google.maps.Marker({
			position: latlng,
			icon: image,
			map: map
		});


		function drawMarker(centerLocation){
			centerIcon.setPosition(centerLocation);
		}

		var centerd = map.getCenter();
		document.frm.lat.value=centerd.lat().toFixed(6); 
		document.frm.lng.value=centerd.lng().toFixed(6); 

		google.maps.event.addListener(map, 'center_changed', function(event) {
			var center = map.getCenter();
			document.frm.lat.value=center.lat().toFixed(6); 
			document.frm.lng.value=center.lng().toFixed(6); 
			drawMarker(map.getCenter());

		});

		<?php 
		if($mode == "geo")
			echo '	codeAddress();';
		?>

		//Busstop_Markers
		function busstop_marker(data,b_marker){

			if( data ){
				var busstop_img0 = new google.maps.MarkerImage( gmapmark_b0 , new google.maps.Size(16,16));
				var busstop_img = new google.maps.MarkerImage( b_marker , new google.maps.Size(16,16));

				for (i = 0; i < data.length; i++) {

					if( data[i][3] == 1 ){
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(data[i][1], data[i][2]),
							map:map,
							icon: busstop_img0,
							title: data[i][0]
						});
					}else{
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(data[i][1], data[i][2]),
							map:map,
							icon: busstop_img,
							title: data[i][0]
						});
					}
				}
			}

		};
	}

	function codeAddress() {
		var address = document.getElementById("address").value;
		geocoder.geocode( { 'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
			} else {
				alert("座標が見つかりませんでした。\n「 " + address + "」\n手動で座標を設定してください。" );
			}
		});
	}
</script>
</head>
<style type="text/css">
	html { height: 100% }
	body { height: 100%; margin: 0px; padding: 0px }
	body,input{
		font-family: "メイリオ", Meiryo,"ヒラギノ角ゴ Pro W3", "Hiragino Kaku Gothic Pro",  Osaka, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif;
		font-size: 12px;
	}
</style>
<body onload="initialize()">
	<div>
		<form name="frm">
		<input id="address" type="textbox" size="20" value="<?php echo $jusho;?>">
		<input type="button" value="Geo" onclick="codeAddress()">

		緯度：<input type="text" name="lat" size="6">
		経度：<input type="text" name="lng" size="6">
		<input type="button" value="決定" onclick="notifyParent();">
		<div style="padding: 1; display:none" id="msgPreview"> </div>
		</form>
	</div>
	<div id="map_canvas" style="width:100%; height:95%; z-index:1"></div>

<script type="text/javascript">
	function notifyParent(){
		var obj = {"album" : document.frm.lat.value };
		var obj2 = {"album2" : document.frm.lng.value};
		window.opener.update(obj,obj2);
		window.close();
	}
</script>

</body>
</html>

