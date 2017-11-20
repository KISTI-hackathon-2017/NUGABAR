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
					<a class="navbar-brand" href="index2.php"> Find Track System </a>
				</div>
				<div class="collpase navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="index2.php"> Introduce <span class="sr-only"></span></a>
						</li>
						<li class="active"><a href="fineDustStatus.php">Fine Dust Status</a></li>
						<li><a href="index01.php"> Find Walkway <span class="sr-only"></span></a>
						</li>

						
					</ul>
					<form class="navbar-form navbar-left">
						<div class="form-group">
						<!--	<input type="text" class="form-cintrol" placeholder="Enter content"> !-->
						</div>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Language <span class="caret"></span></a>
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
								&nbsp;&nbsp; Using Data Sheet(Daegu Air Status)
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
									<h4 class="media-heading">Real Time Daegu Air Status&nbsp;<span class="badge badge-warning">New
									</h4><br>
									<span class="badge badge-error">'TIME'</span> means the time the sensor has received the value.
									<br>
									<span class="badge badge-error">'BLOCK'</span> means the section of the map. 
									<span class="badge badge-error">'LNG'</span> means longitude on the map. 
									<span class="badge badge-error">'LAT' </span> means latitude on the map.
									<br>
									<span class="badge badge-error"> 'AQI' </span> is a result of comprehensively analyzing the data mentioned above.
									<br>
									<span class="badge badge-error">'PM2_5' </span> means the ultrafine dust concentration in the air.
									<span class="badge badge-error">'PM10' </span> means the concentration of fine dust in the air.
									<br>
									<span class="badge badge-error">'SO2' </span> means the concentration of sulfur dioxide in the air.
									<span class="badge badge-error">'NO2'</span> means the concentration of nitrogen dioxide in the air.
									<br>
									<span class="badge badge-error">'CO'</span> means the concentration of carbon monoxide in the air
									<br>
									<span class="badge badge-error">'TEMP'</span> means the temperature of the outside air.
									<span class="badge badge-error">'HUM'</span> means moisture in the air. 
									<br>
									<span class="badge badge-error">'MCP' </span> means the external noise measured by the sensor.<br>
									<span class="badge badge-error">"NODE_ID" </span> is the unique number of the taxi device that measured the data.<br>
									
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
					<div class="col-sm-5" style="text-align: left;"><h5>Introduce Team Member </h5><hr><h5>윤성호(Sungho Yun), 최호주(Hoju Choi), 한해인(Haein Han)</h5></div>
					
					<div class="col-sm-5" style="text-align : left;""><h5>Providing data</h5><hr><p>Kisti(Korea Institute of Science and Technology Information)
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