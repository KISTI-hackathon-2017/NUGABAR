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
	function initialize() {
		map = new Tmap.Map({
			div : "map_div",
			width : '500px',
			height : '500px'
		});
		map.events.register("click", map, onClickMap)
	}
	function onClickMap(evt) {
		
		alert(map.getLonLatFromPixel(new Tmap.Pixel(evt.clientX, evt.clientY)));
		console.log("type= " + evt.type);
		console.log("clientX= " + evt.clientX);
		console.log("clientY= " + evt.clientY);
	}
	window.onload = function() {
		initialize();
	}
	</script>
	
</head>
<body>

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
	<script>
		function div() {
			alert(map.div.id);
		}
		function LonLatFromPixel() {
			alert(map.getLonLatFromPixel(new Tmap.Pixel(document.getElementById('x').value, document.getElementById('y').value)));
		}
		function okokok() {
			var url = 'https://apis.skplanetx.com/tmap/routes/pedestrian?version=1';
			var params = {
			        startX : 14129076.637157721
			        ,startY : 4517000.1674596295
			        ,endX : 14129150.847711671
			        ,endY : 4516442.460094549
			        ,startName : '출발지'
			        ,endName : '목적지'
			}
			 
			$.ajax({
			    method: 'POST',
			    url: url,
			    data: params,
			    beforeSend : function(xhr){
			        xhr.setRequestHeader("appKey", "85d36705-11e0-396d-94f0-f13b36743c89");
			        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			    },
			    complete: function(data) {
			        console.log(data);
			        
			        var obj_s = JSON.stringify(data, null, "\t");
			        var dataUri = "data:application/json;charset=utf-8,"+ encodeURIComponent(obj_s);
			        var link = $("#link").attr("href", dataUri);
			    }
			});
		}
		function getLL() {
			var url = 'https://apis.skplanetx.com/tmap/routes/pedestrian?version=1';
			var params = {
			        startX : 14129076.637157721
			        ,startY : 4517000.1674596295
			        ,endX : 14129150.847711671
			        ,endY : 4516442.460094549
			        ,startName : '출발지'
			        ,endName : '목적지'
			}
			 
			$.ajax({
			    method: 'POST',
			    url: url,
			    data: params,
			    beforeSend : function(xhr){
			        xhr.setRequestHeader("appKey", "85d36705-11e0-396d-94f0-f13b36743c89");
			        xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
			    },
			    complete: function(data) {
			        console.log(data);
			        
			        var obj_s = JSON.stringify(data, null, "\t");
			        var dataUri = "data:application/json;charset=utf-8,"+ encodeURIComponent(obj_s);
			        var link = $("#link").attr("href", dataUri);
			        
					var arr = new Array();
					var pointList = [];
					for(key in data['responseJSON']['features']) {
						for(num in data['responseJSON']['features'][key]['geometry']['coordinates']) {
							if(data['responseJSON']['features'][key]['geometry']['coordinates'][num].length == 2) {
								arr.push('key: ' + key + num + ' value: ' + data['responseJSON']['features'][key]['geometry']['coordinates'][num]);
								pointList.push(new Tmap.Geometry.Point(data['responseJSON']['features'][key]['geometry']['coordinates'][num][0], data['responseJSON']['features'][key]['geometry']['coordinates'][num][1]));
							}
							else if(data['responseJSON']['features'][key]['geometry']['coordinates'].length == 2) {
								arr.push('key: ' + key + num + ' value: ' + data['responseJSON']['features'][key]['geometry']['coordinates']);
								pointList.push(new Tmap.Geometry.Point(data['responseJSON']['features'][key]['geometry']['coordinates'][0], data['responseJSON']['features'][key]['geometry']['coordinates'][1]));
							}
						}
				    }
					map.setCenter(new Tmap.LonLat(14129077, 4516994));
					var lineString = new Tmap.Geometry.LineString(pointList);
					
					var style_bold = {strokeWidth: 6,
							fillOpacity: 0.2,
							strokeOpacity: 0.2};
					var mLineFeature = new Tmap.Feature.Vector(lineString, null, style_bold);
					
					var vectorLayer = new Tmap.Layer.Vector("vectorLayerID");
					map.addLayer(vectorLayer);
					
					vectorLayer.addFeatures([mLineFeature]);
				}
			});
				
		}
	<br>
	</script>
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<br>
				<input type="button" onclick="div()" value="시작점 찾기" class="btn btn-mymy"> 
				<input type="button" onClick="LonLatFromPixel()" value="산책로 찾기" class="btn btn-mymy">
			</div>
		</div>
	</div>
	<div>
		
	</div>
	<div>
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