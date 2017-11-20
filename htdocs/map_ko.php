<?php  
$db_host = "localhost";
$db_user = "root";
$db_passwd = "root";
$db_name = "airstatus";
mysql_connect($db_host,$db_user,$db_passwd);
mysql_select_db($db_name);
mysql_query('set session character_set_connection=utf8;');
mysql_query('set session character_set_results=utf8;');
mysql_query('set session character_set_client=utf8;');
$result = mysql_query("SELECT * FROM daeguair ORDER BY TIME DESC");
$rows = array();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name ="viewport" content="width=device-width", initial-scale="1">
	<title> Find Trail System </title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/codingBooster.css">
	<script language="javascript"
	src="https://apis.skplanetx.com/tmap/js?version=1&format=javascript&appKey=85d36705-11e0-396d-94f0-f13b36743c89"></script>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	
	<script type="text/javascript">
var map;
var routeLayer;
var vector_layer;
var pointList;
var lineString,lineString2;
var lineCollection;
var style_red;
var mLineFeature;

var defaultLng = 128.347808;
var defaultLat = 36.06123;
var incLng = 0.01001019;
var decLat = 0.00997869;

var startLonLat;
var endLonLat;
var passLonLat;

var linearRing;
var PolygonCollection;
var mLineFeature;

var x;
var y;
var aq = new Array(42);
for(var i = 0; i <42; i++) {
			aq[i] = new Array(42);
}

function initTmap(){


	map = new Tmap.Map({
		div:'map_div',
		width : "934px",
		height : "452px",
	});
	routeLayer = new Tmap.Layer.Vector("route");
	map.addLayer(routeLayer);
	
	vector_layer = new Tmap.Layer.Vector('Tmap Vector Layer'); //벡터레이어를 생성합니다.
	map.addLayers([vector_layer]); //map에 벡터 레이어를 추가합니다.
	 map.events.register("click", map, onClick);
	
	x = new Array(42);
	y = new Array(42);
	for(var i = 0; i < 42; i++) {
		x[i] = new Array(42);
		y[i] = new Array(42);

	}
	
	
	for(var i = 0; i < 42; i++) {
		for (var j = 0; j < 42; j++) {
	x[i][j] = defaultLng + incLng*i;
	y[i][j] = defaultLat - decLat*j
	aq[i][j] = 0;
	
		}
	}
	map.setCenter(new Tmap.LonLat(x[20][20], y[20][20]).transform("EPSG:4326", "EPSG:3857"), 15);
$(function() {
		$.ajax({
			type: "GET",
			url: "./index.php",
			dataType:"json",
			success: function(data) {
				$.each(data, function(index, item) {					
					var block = Number(item['BLOCK']);
					var aqiParse = Number(item['AQI']);
	aq[parseInt(block/42)][block%42] = aqiParse;
	
				})

			},
			complete: function() {
				for(var i = 0; i < 42; i++) {
					for (var j = 0; j < 42; j++) {

				style_red = {
					      fillColor:"#FF0000",//fill에 적용 될 16진수 color입니다.
					      fillOpacity:parseFloat(aq[i][j] / 200),// fill의 투명도입니다.
					      strokeColor: "#FF0000",//stroke에 적용될 16진수 color입니다.
					      strokeWidth: 1,//stroke의 넓이(pixel 단위)입니다. 
					      strokeDashstyle: "solid",//stroke dash 의 스타일입니다.
					      pointRadius: 60,//point의 반경(pixel 단위)입니다. 
					      title: "this is a red line"//지리정보객체 위를 hover 했을 때 툴팁을 생성합니다. 
					 };
				
				//polyline을 그릴 좌표를 저장 할 배열 변수입니다.
				var pointList2 = [];
				
				pointList2.push(new Tmap.Geometry.Point(new Tmap.LonLat(x[i][j], y[i][j]).transform("EPSG:4326", "EPSG:3857").lon, new Tmap.LonLat(x[i][j], y[i][j]).transform("EPSG:4326", "EPSG:3857").lat));//Geometry.Point를 배열에 추가합니다.
				pointList2.push(new Tmap.Geometry.Point(new Tmap.LonLat(x[i][j] + incLng, y[i][j]).transform("EPSG:4326", "EPSG:3857").lon, new Tmap.LonLat(x[i][j] + incLng, y[i][j]).transform("EPSG:4326", "EPSG:3857").lat));
				pointList2.push(new Tmap.Geometry.Point(new Tmap.LonLat(x[i][j] + incLng, y[i][j] - decLat).transform("EPSG:4326", "EPSG:3857").lon, new Tmap.LonLat(x[i][j] + incLng, y[i][j] - decLat).transform("EPSG:4326", "EPSG:3857").lat));
				pointList2.push(new Tmap.Geometry.Point(new Tmap.LonLat(x[i][j], y[i][j] - decLat).transform("EPSG:4326", "EPSG:3857").lon, new Tmap.LonLat(x[i][j], y[i][j] - decLat).transform("EPSG:4326", "EPSG:3857").lat));
				
				linearRing = new Tmap.Geometry.LinearRing(pointList2);//시작점과 끝점이 이어지는 폐쇄된 선 형태의 지리정보 객체(Geometry)를 생성
				
				PolygonCollection = new Tmap.Geometry.Polygon(linearRing);//Geometry.LinearRing을 인자로 사용해, 다각형(Polygon) 지리정보 객체(Geometry)를 생성

				mLineFeature = new Tmap.Feature.Vector(PolygonCollection,null,style_red);//지리정보 객체(Geometry)를 벡터 레이어(Vector Layer)에 표출(drawing) 할 수 있는 형태로 변환하거나 조합하는 객체 클래스

				vector_layer.addFeatures([mLineFeature]);//벡터 레이어에 다각형(Polygon) 추가
					}
				}
			}

	});
});
}

function onClick(e){
	  var lonlat = map.getLonLatFromViewPortPx(e.xy);//클릭한 부분의 ViewPorPx를 LonLat로 변환합니다. 
	  startLonLat = lonlat;
	  var result ='출발지'+lonlat+'로 선택되었습니다.'; 
	  var resultDiv = document.getElementById("result");
	  resultDiv.innerHTML = result;
	  
		
		// 2. 시작, 도착 심볼찍기
		// 시작
		var markerStartLayer = new Tmap.Layer.Markers("start");
		map.addLayer(markerStartLayer);

		var size = new Tmap.Size(24, 38);
		var offset = new Tmap.Pixel(-(size.w / 2), -size.h);
		var icon = new Tmap.IconHtml("<img src='http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_s.png' />", size, offset);
		var marker_s = new Tmap.Marker(lonlat, icon);
		//markerStartLayer.addMarker(marker_s);
		
	  $(function() {
			$.ajax({
				type: "GET",
				url: "./index.php",
				dataType:"json",
				success: function(data) {
					$.each(data, function(index, item) {					
						var block = Number(item['BLOCK']);
						var aqiParse = Number(item['AQI']);
		aq[parseInt(block/42)][block%42] = aqiParse;
		
					})

				},
				complete: function() {
					
					var startIndex = 0;
				    var maxIndex = 41;
				    
				    var resultIndex1 = 0;
				    var resultIndex2 = 0;
				    
				    while(startIndex < maxIndex) {
				       var middle = parseInt((startIndex + maxIndex)/2);
				     	if(new Tmap.LonLat(x[middle][0], y[0][0]).transform("EPSG:4326", "EPSG:3857").lon > startLonLat.lon)
				          maxIndex = middle-1;
				       else
				          startIndex = middle+1;
				    }
				    resultIndex1 = startIndex;
				    
				    
				    startIndex = 0;
				    maxIndex = 41;
				    
				    while(startIndex < maxIndex) {
				       	var middle = parseInt((startIndex + maxIndex)/2);
				       	if(new Tmap.LonLat(x[0][0], y[0][middle]).transform("EPSG:4326", "EPSG:3857").lat < startLonLat.lat)
				        	maxIndex = middle-1;
				       else
							startIndex = middle+1;
				    }
				    resultIndex2 = startIndex;
					
				    var min = 500;
				    var first = resultIndex1;
				    var second = resultIndex2;
				    for(var i = 0; i < 2; i++) {
				    	for(var j = 0; j < 2; j++) {
							if(i == 1 && j == 1) continue;
							if(aq[resultIndex1 - 1 + i][resultIndex2 - 1 + j] < min) {
								min = aq[resultIndex1 - 1 + i][resultIndex2 - 1 + j];
								resultIndex1 = first - 1 + i;
	                            resultIndex2 = second - 1 + j;
							}
						}
				    }
				 // 3. 경유지 심볼 찍기
				    var markerWaypointLayer = new Tmap.Layer.Markers("waypoint");
				    map.addLayer(markerWaypointLayer);

				    var size = new Tmap.Size(24, 38);
				    var offset = new Tmap.Pixel(-(size.w / 2), -size.h);
				    var icon = new Tmap.IconHtml("<img src='http://tmapapis.sktelecom.com/upload/tmap/marker/pin_b_m_p.png' />", size, offset);
				    var marker = new Tmap.Marker(new Tmap.LonLat(x[resultIndex1][resultIndex2], y[resultIndex1][resultIndex2]).transform("EPSG:4326", "EPSG:3857"), icon);
				   // markerWaypointLayer.addMarker(marker);
				    
				    var tmpx = x[resultIndex1][resultIndex2];
				    var tmpy = y[resultIndex1][resultIndex2];
					
					
				    min = 500;
				    for(var i = 0; i < 2; i++) {
				    	for(var j = 0; j < 2; j++) {
							if(i == 1 && j == 1) continue;
							if(resultIndex1 - 1 + i == first && resultIndex2 - 1 + j == second) continue;
							if(aq[resultIndex1 - 1 + i][resultIndex2 - 1 + j] < min) {
								min = aq[resultIndex1 - 1 + i][resultIndex2 - 1 + j];
								resultIndex1 = first - 1 + i;
	                            resultIndex2 = second - 1 + j;
							}
						}
				    }
					

					// 도착
					var markerEndLayer = new Tmap.Layer.Markers("end");
					map.addLayer(markerEndLayer);

					var size = new Tmap.Size(24, 38);
					var offset = new Tmap.Pixel(-(size.w / 2), -size.h);
					var icon = new Tmap.IconHtml("<img src='http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_e.png' />", size, offset);
					var marker_e = new Tmap.Marker(new Tmap.LonLat(x[resultIndex1][resultIndex2]).transform("EPSG:4326", "EPSG:3857"), icon);
					//markerEndLayer.addMarker(marker_e);
					
					console.log(resultIndex1 + " " + resultIndex2)
					
					// 경로탐색
					var startX = x[first][second];
					var startY = y[first][second];
					var endX = x[resultIndex1][resultIndex2];
					var endY = y[resultIndex1][resultIndex2];
					var passList = tmpx.toString() + "," + tmpy.toString();
					var prtcl;
					var headers = {}; 
					headers["appKey"]="aca9d12b-29a9-41c3-863b-b63f8004b499";
					$.ajax({
						method:"POST",
						headers : headers,
						url:"https://api2.sktelecom.com/tmap/routes?version=1&format=xml",//
						async:false,
						data:{
							startX : startX,
							startY : startY,
							endX : endX,
							endY : endY,
							passList : passList,
							reqCoordType : "WGS84GEO",
							resCoordType : "EPSG3857",
							angle : "172",
						},
						success:function(response){
							prtcl = response;
							
							
							
						},
						error:function(request,status,error){
							console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
						}
					});

					
					// 5. 경로 탐색  결과 Line 그리기
					//경로 탐색  결과 POINT 찍기
					/* -------------- Geometry.Point -------------- */
					var pointLayer = new Tmap.Layer.Vector("point");
					var prtclString = new XMLSerializer().serializeToString(prtcl);//xml to String	
					   xmlDoc = $.parseXML( prtclString ),
					   $xml = $( xmlDoc ),
					   $intRate = $xml.find("Placemark");
					   var style_red = {
					           fillColor:"#FF0000",
					           fillOpacity:0.2,
					           strokeColor: "#FF0000",
					           strokeWidth: 3,
					           strokeDashstyle: "solid",
					           pointRadius: 2,
					           title: "this is a red line"
					      };
					   $intRate.each(function(index, element) {
					   	var nodeType = element.getElementsByTagName("tmap:nodeType")[0].childNodes[0].nodeValue;
						if(nodeType == "POINT"){
							var point = element.getElementsByTagName("coordinates")[0].childNodes[0].nodeValue.split(',');
							var geoPoint =new Tmap.Geometry.Point(point[0],point[1]);
							var pointFeature = new Tmap.Feature.Vector(geoPoint, null, style_red); 
							pointLayer.addFeatures([pointFeature]);
						}
					   });
					map.addLayer(pointLayer);
					/* -------------- Geometry.Point -------------- */
					//경로 탐색  결과 Line 그리기
					routeLayer.style ={
							fillColor:"#000000",
					        fillOpacity:0.2,
					        strokeColor: "#000000",
					        strokeWidth: 3,
					        strokeDashstyle: "solid",
					        pointRadius: 2,
					        title: "this is a red line"	
					}
					var kmlForm = new Tmap.Format.KML().read(prtcl);
					routeLayer.addFeatures(kmlForm);
					
					// 6. 경로탐색 결과 반경만큼 지도 레벨 조정
					map.zoomToExtent(routeLayer.getDataExtent());
					
				},
				error:function(request,status,error){
					console.log("code:"+request.status+"\n"+"message:"+request.responseText+"\n"+"error:"+error);
				}
			});
					
					
	});
	  
}
</script>
	
</head>
<body onload="initTmap()">
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapsed" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="intro_ko.php"> 산책로 찾기 시스템 </a>
				</div>
				<div class="collpase navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="intro_ko.php"> 소개 <span class="sr-only"></span></a>
						</li>
						<li><a href="Dust_ko.php">미세먼지 상황</a></li>

						<li class="active"><a href="map_ko.php"> 산책로 찾기 <span class="sr-only"></span></a>
						</li>						

					</ul>
					<form class="navbar-form navbar-left">
						<div class="form-group">
						<!--	<input type="text" class="form-cintrol" placeholder="Enter content"> !-->
						</div>
						<!--<button type="submit" class="btn btn-defualt">Search</button>!-->
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> 언어 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="index2.php">English</a></li>
								<li><a href="intro_ko.php">Korean</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div> 
		</nav>
		<div class = "container">
			<div class="row">
				<div class="col-xs-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title">
								<span class="glyphicon glyphicon-road"></span>
								&nbsp;&nbsp; 산책로 찾기(대구 광역시)
							</h3>
						</div>
						<div class="panel-body">
								<div id="map_div"></div>
								<p id="result"></p>				
						</div>
					</div>
				</div>
			</div>
		</div>

	<footer style="background-color : #2b6af9; color:#ffffff">
			<div class="container">
				<br>
				<div class="row">
					<div class="col-sm-5" style="text-align: left;"><h5>팀 멤버 소개 </h5><hr><h5>윤성호(Sungho Yun), 최호주(Hoju Choi), 한해인(Haein Han)</h5></div>
					
					<div class="col-sm-5" style="text-align : left;""><h5>데이터 제공처</h5><hr><p>Kisti(Korea Institute of Science and Technology Information)
						<br> Daegu City</p></div>
					</div>		
				</div>
			</div>
		</footer>
		<div class="row">
		</div>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</body>
</html>