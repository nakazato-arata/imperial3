 /****************************************************************
  *                                                              *
  *  条件検索用js                                                *
  *  ------------                                                *
  *                                                              *
  *  This script generates json control for nendeb search.       *
  *                                                              *
  *  Version 5.2.3                                               *
  *  Copyright (c) 2019 nendeb                                   *
  *                                                              *
  *  Website: http://nendeb.jp                                   *
  *  Email:   nendeb@gmail.com                                   *
  *                                                              *
  ****************************************************************/


	var syoki11="種別を選択してください";
	var syoki12="路線を選択してください";
	var syoki22="駅を選択してください";
	var syoki13="県を選択してください";
	var syoki23="市区を選択してください";

	if (typeof(r_view) == "undefined") {
			var r_view = '0';
	};

	if (typeof(c_view) == "undefined") {
			var c_view = '0';
	};

	if (typeof(kak_view) == "undefined") {
			var kak_view = '0';
	};

	if (typeof(mad_view) == "undefined") {
			var mad_view = '0';
	};

	if (typeof(set_view) == "undefined") {
			var set_view = '0';
	};

	consent_check();


	//非同期 遅延読み込み
	function SShu2() {
		madori_cb();
		setsubi_cb();
		kakaku_view();

		if ( typeof jsearch_widget_after_js == "function")  {
			jsearch_widget_after_js();
		};
	};

	//種別選択後
	function SShu(slct) {
		var request;

		if( r_view == '1'){

			if( c_view != '1'){
				kencodecrea();
				document.searchitem.ken.options[0]=new Option(syoki13,"0",false,false);	//県を選択してください

				sikcodecrea();
				document.searchitem.sik.options[0]=new Option(syoki13,"0",false,false);	//県を選択してください

				SKen(slct);
			};

			madori_cb();
			setsubi_cb();
			kakaku_view();

			consent_check();

			if ( typeof jsearch_widget_after_js == "function")  {
				jsearch_widget_after_js();
			};

		}else{

			//路線
			var postDat = encodeURI("shu="+document.searchitem.shu.options[slct.selectedIndex].value);
			//request = new XMLHttpRequest();
			request = new createXmlHttpRequest(); 
			request.open("POST", getsite+"jsonrosen_kensaku.php", true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
			request.send(postDat);
			request.onreadystatechange = function() {
				if (request.readyState == 4 && request.status == 200) {
					var id = null;
					var name = null;
					var val = null;
					rosencodecrea();
					var jsDat = request.responseText;

					if(jsDat !=''){
						var data = eval("("+jsDat+")");
						if (data.rosen.length>0) {
							document.searchitem.ros.options[0]=new Option(syoki12,"0",false,false);		//路線を選択してください
							ekicodecrea();
							document.searchitem.eki.options[0]=new Option(syoki12,"0",false,false);		//路線を選択してください

							if( c_view != '1'){
								sikcodecrea();
								document.searchitem.sik.options[0]=new Option(syoki13,"0",false,false);	//県を選択してください
							};
							madori_cb();
							setsubi_cb();
							kakaku_view();

						}else{
							document.searchitem.ros.options[0]=new Option(syoki11,"0",false,false);		//種別を選択してください
						};
						for(var i=0; i<data.rosen.length; i++) {
							id = data.rosen[i].id;
							name = data.rosen[i].name;
							val = false;
							document.searchitem.ros.options[i+1] = new Option(name,id,false,val);
						};
					}else{
						document.searchitem.ros.options[0]=new Option(syoki11,"0",false,false);		//種別を選択してください
						ekicodecrea();
						document.searchitem.eki.options[0]=new Option(syoki12,"0",false,false);		//路線を選択してください
						if( c_view != '1'){
							sikcodecrea();
							document.searchitem.sik.options[0]=new Option(syoki13,"0",false,false);	//県を選択してください
						};
						madori_cb_crea();
						setsubi_cb_crea();

						if ( typeof jsearch_widget_after_js == "function")  {
							jsearch_widget_after_js();
						};
					};
				};
				consent_check();
			};

			if( c_view != '1'){
				SKen(slct);
			};
		};
	};


	function rosencodecrea(){
		var cnt = document.searchitem.ros.length;
		for(var i=cnt; i>=0; i--) {
			document.searchitem.ros.options[i] = null;
		};
	};


	//路線選択
	function SEki(slct) {
		var request;

		//駅
		var postDat = encodeURI("shu="+document.searchitem.shu.options[document.searchitem.shu.selectedIndex].value) + encodeURI("&ros="+document.searchitem.ros.options[slct.selectedIndex].value);
		//request = new XMLHttpRequest();
		request = new createXmlHttpRequest(); 
		request.open("POST", getsite+"jsoneki_kensaku.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
		request.send(postDat);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				var id = null;
				var name = null;
				var val = null;
				ekicodecrea();
				var jsDat2 = request.responseText;
				var data = eval("("+jsDat2+")");

				if (data.eki.length>0) {
					document.searchitem.eki.options[0]=new Option(syoki22,"0",false,false);	//駅を選択してください
				}else{
					document.searchitem.eki.options[0]=new Option(syoki12,"0",false,false);	//路線を選択してください
				};
				for(var i=0; i<data.eki.length; i++) {
					id = data.eki[i].id;
					name = data.eki[i].name;
					val = false;
					document.searchitem.eki.options[i+1] = new Option(name,id,false,val);
				};

				if( c_view != '1'){
					document.searchitem.ken.options[0].selected="true";
					sikcodecrea();
					document.searchitem.sik.options[0]=new Option(syoki22,"0",false,false);	//駅を選択してください
				};

			};
		};
	};
	function ekicodecrea(){
		var cnt = document.searchitem.eki.length;
		for(var i=cnt; i>=0; i--) {
			document.searchitem.eki.options[i] = null;
		};
	};



	//県
	function SKen(slct) {
		var request;

		//県
		var postDat = encodeURI("shu="+document.searchitem.shu.options[slct.selectedIndex].value);
		//request = new XMLHttpRequest();
		request = new createXmlHttpRequest(); 
		request.open("POST", getsite+"jsonken_kensaku.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
		request.send(postDat);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				var id = null;
				var name = null;
				var val = null;
				kencodecrea();

				var jsDat3 = request.responseText;
				if(jsDat3 !=''){
					data = eval("("+jsDat3+")");
					if (data.ken.length > 0) {
						document.searchitem.ken.options[0]=new Option(syoki13,"0",false,false);	//県を選択してください
					}else{
						document.searchitem.ken.options[0]=new Option(syoki11,"0",false,false);	//種別を選択してください
					};
					for(var i=0; i<data.ken.length; i++) {
						id = data.ken[i].id;
						name = data.ken[i].name;
						val = false;
						document.searchitem.ken.options[i+1] = new Option(name,id,false,val);
					};

				}else{
					document.searchitem.ken.options[0]=new Option(syoki11,"0",false,false);		//種別を選択してください
				};
			};
		};

	};

	function kencodecrea(){
		var cnt = document.searchitem.ken.length;
		for(var i=cnt; i>=0; i--) {
			document.searchitem.ken.options[i] = null;
		};
	};



	//市区
	function SSik(slct) {
		var request;

		var postDat =encodeURI("shu="+document.searchitem.shu.options[document.searchitem.shu.selectedIndex].value) +  encodeURI("&ken="+document.searchitem.ken.options[slct.selectedIndex].value);
		//request = new XMLHttpRequest();
		request = new createXmlHttpRequest(); 
		request.open("POST", getsite+"jsonshiku_kensaku.php", true);
		request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
		request.send(postDat);
		request.onreadystatechange = function() {
			if (request.readyState == 4 && request.status == 200) {
				var id = null;
				var name = null;
				var val = null;
				sikcodecrea();
				var jsDat4 = request.responseText;
				if(jsDat4 !=''){
					var data = eval("("+jsDat4+")");
					if (data.shiku.length>0) {
						document.searchitem.sik.options[0]=new Option(syoki23,"0",false,false);	//市区を選択してください
					}else{
						document.searchitem.sik.options[0]=new Option(syoki13,"0",false,false);	//県を選択してください
					};
					for(var i=0; i<data.shiku.length; i++) {
						id = data.shiku[i].id;
						name = data.shiku[i].name;
						val = false;
						document.searchitem.sik.options[i+1] = new Option(name,id,false,val);
					};

					if( r_view != '1'){
						document.searchitem.ros.options[0].selected="true";
						document.searchitem.eki.options[0].selected="true";
					};

				}else{
					document.searchitem.ken.options[0]=new Option(syoki13,"0",false,false);	//県を選択してください
					sikcodecrea();
					document.searchitem.sik.options[0]=new Option(syoki23,"0",false,false);	//市区を選択してください
				};

				if( r_view != '1'){
					document.searchitem.ros.options[0].selected="true";
					ekicodecrea();
					document.searchitem.eki.options[0]=new Option(syoki12,"0",false,false);	//路線を選択してください
				};
			};
		};
	};
	function sikcodecrea(){
		var cnt = document.searchitem.sik.length;
		for(var i=cnt; i>=0; i--) {
			document.searchitem.sik.options[i] = null;
		};
	};


	//設備
	function setsubi_cb() {

		if( set_view != '1'){
			var request;

			//set_ar
			var postDat_chk = '';
			if (1 in set_ar) {
				for ( var i = 0; i < set_ar.length; ++i ) {
					postDat_chk += "&set[]=" + set_ar[i] + "";
				};
			};

			var postDat =encodeURI( "shu="+document.searchitem.shu.options[document.searchitem.shu.selectedIndex].value + postDat_chk );
			//request = new XMLHttpRequest();
			request = new createXmlHttpRequest(); 
			request.open("POST", getsite+"jsonshubetsu_kensaku.php", true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
			request.send(postDat);
			request.onreadystatechange = function() {
				if (request.readyState == 4 && request.status == 200) {
					setsubi_cb_crea();
					var jsDat5 = request.responseText;
					if(jsDat5 !=''){
						document.getElementById('setsubi_cb').innerHTML = jsDat5;

						if ( typeof jsearch_widget_after_js == "function")  {
							jsearch_widget_after_js();
						};

					}else{
						document.getElementById('setsubi_cb').innerHTML = '';
					};
				};
			};
		};
	};
	function setsubi_cb_crea() {
		if( set_view != '1'){
			document.getElementById('setsubi_cb').innerHTML = '';
		};

	};


	//間取り
	function madori_cb() {

		if( mad_view != '1'){
			var request;

			//madori_ar
			var postDat_chk = '';
			if (1 in madori_ar) {
				for ( var i = 0; i < madori_ar.length; ++i ) {
					postDat_chk += "&mad[]=" + madori_ar[i] + "";
				};
			};

			var postDat =encodeURI( "shu="+document.searchitem.shu.options[document.searchitem.shu.selectedIndex].value + postDat_chk );
			//request = new XMLHttpRequest();
			request = new createXmlHttpRequest(); 
			request.open("POST", getsite+"jsonmadori_kensaku.php", true);
			request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=utf-8");
			request.send(postDat);
			request.onreadystatechange = function() {
				if (request.readyState == 4 && request.status == 200) {
					madori_cb_crea();
					var jsDat6 = request.responseText;
					if(jsDat6 !=''){
						document.getElementById('madori_cb').innerHTML = jsDat6;

						if ( typeof jsearch_widget_after_js == "function")  {
							jsearch_widget_after_js();
						};

					}else{
						document.getElementById('madori_cb').innerHTML = '';
					};
				};
			};
		};
	};
	function madori_cb_crea() {
		if( mad_view != '1'){
			document.getElementById('madori_cb').innerHTML = '';
		};
	};



	//価格切替
	function kakaku_view() {

		if( kak_view != '1'){
			var shu =document.searchitem.shu.options[document.searchitem.shu.selectedIndex].value;
			var div1=document.getElementById('kakaku_b');
			var div2=document.getElementById('kakaku_c');
			if(shu == 1 || (shu > 999 && shu < 3000) ) {
				div1.style.display="block";
				div2.style.display="none";
			};

			if(shu == 2 || (shu > 3000) ) {
				div1.style.display="none";
				div2.style.display="block";
			};

			if ( typeof jsearch_widget_after_js == "function")  {
				jsearch_widget_after_js();
			};
		};
	};

	//ボタン
	function consent_check() {
		if (document.searchitem.shu.options[document.searchitem.shu.selectedIndex].value == '0'){
			document.searchitem.btn.disabled = true;
		}else{
			document.searchitem.btn.disabled = false;
		};
	};

