/*
 *  single-fudomap
 *  This script googlemaps control for single-fudo.
 *
 *  Version 5.9.0
 *  Copyright (c) 2022 nendeb
 *  Website: http://nendeb.jp 
*/

	var map, service, point;
	var picmaxWidth=75;
	var picmaxHeight=75;

	if (typeof(busstop_lat) == 'undefined') {
			var busstop_lat = '';
	}
	if (typeof(busstop_lng) == 'undefined') {
			var busstop_lng = '';
	}

	/* スクロールした時に地図を初期化 */
		var googlemaps_initialized = false;
		// 対象
		const googlemapsTrigger = document.querySelectorAll( '.map_canvas' );

		window.addEventListener( 'load', function() {
			if ( googlemapsTrigger.length  && googlemaps_initialized != true ) {
				googlemapsActive( googlemapsTrigger );
			};
		}, false );
		window.addEventListener( 'scroll', function() {
			if ( googlemapsTrigger.length  && googlemaps_initialized != true ) {
				googlemapsActive( googlemapsTrigger );
			};
		}, false );
		//print
		window.addEventListener( 'beforeprint', function() {
			if ( googlemaps_initialized != true ) {
				googlemaps_initialize();
				googlemaps_initialized = true;
			};
		}, false );

		// googlemaps
		function googlemapsActive( googlemapsTrigger ) {
			for (var i = 0; i < googlemapsTrigger.length; i++) {
				let position = googlemapsTrigger[i].getBoundingClientRect().top;
				let scroll = window.pageYOffset || document.documentElement.scrollTop;
				let offset = position + scroll;
				let windowHeight = window.innerHeight;

				if (scroll > offset - windowHeight + 50) {
					googlemaps_initialize();
					googlemaps_initialized = true;
				}
			}
		}


		/* 地図初期化 */
		function googlemaps_initialize() { 
			point = new google.maps.LatLng(lat,lng);
			map   = new google.maps.Map(document.getElementById('map_canvas'), {
				center: point,
				zoom: 15,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false
			});

			//Busstop_Markers
			busstop_marker(busmark2,gmapmark_b2);
			busstop_marker(busmark1,gmapmark_b1);

			//Gakkou_Markers
			gakkou_marker(gakkoumark1,gmapmark_gs1,gmapmark_gs2);
			gakkou_marker(gakkoumark2,gmapmark_gc1,gmapmark_gc2);


			if( fudo_map_elevation ){
				//ElevationService
				elev = new google.maps.ElevationService();
				var latlng = new Array();
				latlng[0] = new google.maps.LatLng(lat,lng);
				var req = {locations: latlng};
				elev.getElevationForLocations(req, elevResultCallback);
			}else{
				setBukkenmarker();
			}

			//DirectionsService
			if( map_directions || map_bus_directions ){

				//station_directions
				if( map_directionsFrom_lat && map_directionsFrom_lng ){
					var From = new google.maps.LatLng( map_directionsFrom_lat, map_directionsFrom_lng ); 
				}else{
					var From = map_directionsFrom;
				}
				//Bus_directions
				if(busstop_lat && busstop_lng){
					From = new google.maps.LatLng(busstop_lat,busstop_lng); 
				}


				var To = new google.maps.LatLng(lat,lng); 
				if(From != '' ){
					new google.maps.DirectionsService().route({
						origin: From, 
						destination: To,
						travelMode: google.maps.DirectionsTravelMode.WALKING 
					}, function(result, status) {
						if (status == google.maps.DirectionsStatus.OK) {
							new google.maps.DirectionsRenderer({map: map,suppressMarkers: true }).setDirections(result);
						}
					});
				};

			};

			//再ズーム
			var listener = google.maps.event.addListener(map, "idle", function() { 
				if (map.getZoom() > 15) map.setZoom(15); 
				google.maps.event.removeListener(listener); 
			});
		};



		//ElevationService
		function elevResultCallback(result, status) {

			if (status != google.maps.ElevationStatus.OK) {
				var image = new google.maps.MarkerImage( gmapmark , new google.maps.Size(44,41));
				var marker = new google.maps.Marker({
					position: point, 
					map:map,
					icon: image
				});
				var content = bukken_content + '</td></tr></table>';

			}else{
				var image = new google.maps.MarkerImage( gmapmark , new google.maps.Size(44,41));

				if( fudo_map_elevation ){
					var marker = new google.maps.Marker({
						position:result[0].location,
						//position: point, 
						title: '標高 ' + result[0].elevation.toFixed(0) + 'm' ,
						map:map,
						icon: image
					});
					var content = bukken_content + '<div class="msg">標高 ' + result[0].elevation.toFixed(0) + 'm' + '</div>' + '</td></tr></table>';
				}else{
					var marker = new google.maps.Marker({
						position: point, 
						map:map,
						icon: image
					});
					var content = bukken_content + '</td></tr></table>';
				};
			};

			var infowindow = new google.maps.InfoWindow({
				content: content,
				maxWidth: 320
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			});
		};


		//マーカーとふきだし
		function setBukkenmarker() {
			var image = new google.maps.MarkerImage( gmapmark , new google.maps.Size(44,41));

			var marker = new google.maps.Marker({
				position: point, 
				map:map,
				icon: image
			});
			var content = bukken_content + '</td></tr></table>';

			var infowindow = new google.maps.InfoWindow({
				content: content,
				maxWidth: 320
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			});
		};


		//Busstop_Markers
		function busstop_marker(data,b_marker){
			if( data ){
				var busstop_img0 = new google.maps.MarkerImage( gmapmark_b0 , new google.maps.Size(16,16));
				var busstop_img =  new google.maps.MarkerImage( b_marker , new google.maps.Size(16,16));

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
					};
				};
			};
		};

		//Gakkou_Markers
		function gakkou_marker(data,k_marker,k_marker2){
			if( data ){
				var gakkou_img1 = new google.maps.MarkerImage( k_marker, new google.maps.Size(31,29));
				var gakkou_img2 = new google.maps.MarkerImage( k_marker2, new google.maps.Size(31,29));

				for (i = 0; i < data.length; i++) {

					if( data[i][3] == 1 ){
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(data[i][1], data[i][2]),
							map:map,
							icon: gakkou_img1,
							title: data[i][0]
						});
					}else{
						var marker = new google.maps.Marker({
							position: new google.maps.LatLng(data[i][1], data[i][2]),
							map:map,
							icon: gakkou_img2,
							title: data[i][0]
						});
					};
				};
			};
		};

