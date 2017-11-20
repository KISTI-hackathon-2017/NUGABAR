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
						<li class="active"><a href="Dust_ko.php">미세먼지 상황</a></li>

						<li><a href="map_ko.php"> 산책로 찾기 <span class="sr-only"></span></a>
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
		<div class ="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<h3 class="panel-title"> 
								<span class="glyphicon glyphicon-list"> </span>
								&nbsp;&nbsp; 사용중인 데이터 테이블(대구광역시 공기 상황)
							</h3>
						</div>
						<div class="panel-body">
							<div class="media">
								<div class="media-left">
									<a href="#">
										<img class="media-object" src="images/daeguLogo.png" style="width : 256px; height: 256px">
									</a>
								</div>
								<div class="media-body">
									<h4 class="media-heading">실시간 대구 광역시 공기 상황&nbsp;<span class="badge badge-warning">New
									</h4><br>
									<span class="badge badge-error">'TIME'</span> 센서가 값을 수집한 시간을 의미합니다.
									<br>
									<span class="badge badge-error">'BLOCK'</span> 지도의 구역을 의미 합니다.
									<span class="badge badge-error">'LNG'</span> 지도의 경도를 의미합니다.  
									<span class="badge badge-error">'LAT' </span> 지도의 위도를 의미합니다.
									<br>
									<span class="badge badge-error"> 'AQI' </span> 다양한 변수들을 종합해 도출해낸 종합공기지수입니다.
									<br>
									<span class="badge badge-error">'PM2_5' </span> 공기중의 초미세먼지 농도를 의미합니다.
									<span class="badge badge-error">'PM10' </span> 공기중의 미세먼지 농도를 의미합니다.
									<br>
									<span class="badge badge-error">'SO2' </span> 공기중의 이산화황의 농도를 의미합니다.
									<span class="badge badge-error">'NO2'</span> 공기중의 이산화질소의 농도를 의미합니다.
									<br>
									<span class="badge badge-error">'CO'</span> 공기중의 일산화탄소의 농도를 의미합니다.
									<br>
									<span class="badge badge-error">'TEMP'</span> 센서가 측정한 외부 기온을 의미합니다.
									<span class="badge badge-error">'HUM'</span> 공기중의 습도를 의미합니다.
									<br>
									<span class="badge badge-error">'MCP' </span> 센서가 측정한 외부소음을 의미합니다.<br>
									<span class="badge badge-error">"NODE_ID" </span> 센서가 달려있는 택시의 고유번호를 의미합니다.<br>
									
								</div>
							</div>
						</div>
						
						<table class="table">
							<thead>
								<tr>
									<th> TIME </th>
									<th> BLOCK </th>
									<th> LNG </th>									
									<th> LAT </th>
									<th> AQI </th>
									<th> PM2_5 </th>
									<th> PM10 </th>
									<th> SO2 </th>
									<th> NO2 </th>
									<th> CO </th>
									<th> TEMP </th>
									<th> HUM </th>
									<th> MCP </th>
									<th> NODE_ID </th>
								</tr>
							</thead>
							<tbody>
									<?php
										while($row = mysql_fetch_assoc($result))						{
									?>
									<tr>
										<td><?php echo $row['TIME'];?></td>
										<td><?php echo $row['BLOCK'];?></td>
										<td><?php echo $row['LNG'];?></td>
										<td><?php echo $row['LAT'];?></td>
										<td><?php echo $row['AQI'];?></td>
										<td><?php echo $row['PM2_5'];?></td>
										<td><?php echo $row['PM10'];?></td>
										<td><?php echo $row['SO2'];?></td>
										<td><?php echo $row['NO2'];?></td>
										<td><?php echo $row['CO'];?></td>
										<td><?php echo $row['TEMP'];?></td>
										<td><?php echo $row['HUM'];?></td>
										<td><?php echo $row['MCP'];?></td>
										<td><?php echo $row['NODE_ID'];?></td>
									</tr>
									<?php
									}
									?>
							</tbody>
						</table>
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
			<div class="modal" id="modal" tabindex="-1">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							This System's Feature
							<button class="close" data-dismiss="modal"> &times;</button>
						</div>
						<div class="modal-body" style="text-align: center";>
							You can see fine dust data in real time. 
							<br>
							Because it collects data through a taxi around Daegu City.
							<br>
							<img src="images/taxi.jpg" id="imagepreview" style="width : 256px; height: 256px;">
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	</body>
</html>