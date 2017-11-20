<?php  
@extract($_GET);
@extract($_POST);
@extract($_SERVER);
@extract($_FILES);
@extract($_ENV);
@extract($_COOKIE);
@extract($_SESSION);


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
    <title>TEST</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script
	src="https://api2.sktelecom.com/tmap/js?version=1&format=javascript&appKey=aca9d12b-29a9-41c3-863b-b63f8004b499"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>

<script language="javascript">
    var aqi = [];
    var block;
    for(var i = 0; i < 42; i++) {
        aqi[i] = [];
    }
    
    for(var i = 0; i < 42; i++) {
        for(var j = 0; j < 42; j++) {
            aqi[i][j] = 0;
        }
    }
    
    function getBlock(_block) {
        block = _block;
    }
    function getAqi(_aqi) {
        aqi = _aqi;
    }
</script>
<?php 

while($row = mysql_fetch_assoc($result)) {
            $block = (int)$row['BLOCK'];
            $aqi = (int)$row['AQI'];
            echo gettype($block);
            echo ($block);
            echo gettype($aqi);
            echo ($aqi);
            echo ("<script language=javascript> (getBlock($block));</script>");
            echo ("<script language=javascript> (getAqi($aqi));</script>");
            echo ("<script language=javascript> aqi[$block/42][$block%42] = $aqi;</script>");
            }
        ?>
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

var linearRing;
var PolygonCollection;
var mLineFeature;

var x;
var y;
var aq;




        
function initTmap(){
	map = new Tmap.Map({
		div:'map_div',
		width : "934px",
		height : "452px",
	});
	map.setCenter(new Tmap.LonLat("126.986072", "37.570028").transform("EPSG:4326", "EPSG:3857"), 15);
	routeLayer = new Tmap.Layer.Vector("route");
	map.addLayer(routeLayer);
	addPolygon();
        for(var i = 0; i < 42; i++) {
		for (var j = 0; j < 42; j++) {
                    Add(i, j);
		}
            }
    //startEnd();
    //pass();
    //requestApi();
}

function addPolygon() {
	vector_layer = new Tmap.Layer.Vector('Tmap Vector Layer'); //벡터레이어를 생성합니다.
	map.addLayers([vector_layer]); //map에 벡터 레이어를 추가합니다.
	
        

        
	x = new Array(42);
	y = new Array(42);
	aq = new Array(42);
	for(var i = 0; i < 42; i++) {
		x[i] = new Array(42);
		y[i] = new Array(42);
		aq[i] = new Array(42);
	}
	
	for(var i = 0; i < 42; i++) {
		for (var j = 0; j < 42; j++) {
	x[i][j] = defaultLng + incLng*i;
	y[i][j] = defaultLat - decLat*j
	if(aqi[i][j] !== 0) {
            
        }
        else {
            aqi[i][j] = 0;
        }
        console.log(i, " ", j, " ", aqi[i][j]);
	}
	}
        
    }
//Collection 객체를 추가하는 함수입니다.
function Add(i, j) {
	
	//polyline을 그릴 좌표를 저장 할 배열 변수입니다.
	var pointList2 = [];
        style_red = {
	      fillColor:"#FF0000",//fill에 적용 될 16진수 color입니다.
	      fillOpacity:aq[i][j] / 100.0,// fill의 투명도입니다.
	      strokeColor: "#FF0000",//stroke에 적용될 16진수 color입니다.
	      strokeWidth: 1,//stroke의 넓이(pixel 단위)입니다. 
	      strokeDashstyle: "solid",//stroke dash 의 스타일입니다.
	      pointRadius: 60,//point의 반경(pixel 단위)입니다. 
	      title: "this is a red line"//지리정보객체 위를 hover 했을 때 툴팁을 생성합니다. 
	 };
	
	pointList2.push(new Tmap.Geometry.Point(new Tmap.LonLat(x[i][j], y[i][j]).transform("EPSG:4326", "EPSG:3857").lon, new Tmap.LonLat(x[i][j], y[i][j]).transform("EPSG:4326", "EPSG:3857").lat));//Geometry.Point를 배열에 추가합니다.
	pointList2.push(new Tmap.Geometry.Point(new Tmap.LonLat(x[i][j] + incLng, y[i][j]).transform("EPSG:4326", "EPSG:3857").lon, new Tmap.LonLat(x[i][j] + incLng, y[i][j]).transform("EPSG:4326", "EPSG:3857").lat));
	pointList2.push(new Tmap.Geometry.Point(new Tmap.LonLat(x[i][j] + incLng, y[i][j] - decLat).transform("EPSG:4326", "EPSG:3857").lon, new Tmap.LonLat(x[i][j] + incLng, y[i][j] - decLat).transform("EPSG:4326", "EPSG:3857").lat));
	pointList2.push(new Tmap.Geometry.Point(new Tmap.LonLat(x[i][j], y[i][j] - decLat).transform("EPSG:4326", "EPSG:3857").lon, new Tmap.LonLat(x[i][j], y[i][j] - decLat).transform("EPSG:4326", "EPSG:3857").lat));
	
	
	linearRing = new Tmap.Geometry.LinearRing(pointList2);//시작점과 끝점이 이어지는 폐쇄된 선 형태의 지리정보 객체(Geometry)를 생성
	
	PolygonCollection = new Tmap.Geometry.Polygon(linearRing);//Geometry.LinearRing을 인자로 사용해, 다각형(Polygon) 지리정보 객체(Geometry)를 생성

	mLineFeature = new Tmap.Feature.Vector(PolygonCollection,null,style_red);//지리정보 객체(Geometry)를 벡터 레이어(Vector Layer)에 표출(drawing) 할 수 있는 형태로 변환하거나 조합하는 객체 클래스

	vector_layer.addFeatures([mLineFeature]);//벡터 레이어에 다각형(Polygon) 추가
	
} 

function startEnd() {
	// 시작
	var markerStartLayer = new Tmap.Layer.Markers("start");
	map.addLayer(markerStartLayer);

	var size = new Tmap.Size(24, 38);
	var offset = new Tmap.Pixel(-(size.w / 2), -size.h);
	var icon = new Tmap.IconHtml("<img src='http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_s.png' />", size, offset);
	var marker_s = new Tmap.Marker(new Tmap.LonLat("126.977022", "37.569758").transform("EPSG:4326", "EPSG:3857"), icon);
	markerStartLayer.addMarker(marker_s);

	// 도착
	var markerEndLayer = new Tmap.Layer.Markers("end");
	map.addLayer(markerEndLayer);

	var size = new Tmap.Size(24, 38);
	var offset = new Tmap.Pixel(-(size.w / 2), -size.h);
	var icon = new Tmap.IconHtml("<img src='http://tmapapis.sktelecom.com/upload/tmap/marker/pin_r_m_e.png' />", size, offset);
	var marker_e = new Tmap.Marker(new Tmap.LonLat("126.997589", "37.570594").transform("EPSG:4326", "EPSG:3857"), icon);
	markerEndLayer.addMarker(marker_e);
}

function pass() {
	// 3. 경유지 심볼 찍기
	var markerWaypointLayer = new Tmap.Layer.Markers("waypoint");
	map.addLayer(markerWaypointLayer);

	var size = new Tmap.Size(24, 38);
	var offset = new Tmap.Pixel(-(size.w / 2), -size.h);
	var icon = new Tmap.IconHtml("<img src='http://tmapapis.sktelecom.com/upload/tmap/marker/pin_b_m_p.png' />", size, offset);
	var marker = new Tmap.Marker(new Tmap.LonLat("126.983072", "37.573028").transform("EPSG:4326", "EPSG:3857"), icon);
	markerWaypointLayer.addMarker(marker);

	var size = new Tmap.Size(24, 38);
	var offset = new Tmap.Pixel(-(size.w / 2), -size.h);
	var icon = new Tmap.IconHtml("<img src='http://tmapapis.sktelecom.com/upload/tmap/marker/pin_b_m_p.png' />", size, offset);
	var marker = new Tmap.Marker(new Tmap.LonLat("126.987319", "37.565778").transform("EPSG:4326", "EPSG:3857"), icon);
	markerWaypointLayer.addMarker(marker);
}

function requestApi() {
	// 4. 경로 탐색 API 사용요청
	var startX = 126.977022;
	var startY = 37.569758;
	var endX = 126.997589;
	var endY = 37.570594;
	var passList = "126.983072,37.573028_126.987319,37.565778";
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
					fillColor:"#FF0000",
			        fillOpacity:0.2,
			        strokeColor: "#FF0000",
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
}

window.onload = function() {
    initTmap();
};

</script>
<title>Insert title here</title>
</head>
<body>
	<div id="map_div"></div>
</body>
</html>