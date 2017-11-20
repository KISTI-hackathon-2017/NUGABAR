<!DOCTYPE html>
<html>
	<head>
			<meta charset="UTF-8">
			<meta name ="viewport" content="width=device-width", initial-scale="1">
			<title> 산책로 찾기 시스템 </title>
			<link rel="stylesheet" href="css/bootstrap.css">
			<link rel="stylesheet" href="css/codingBooster.css">
	</head>

	<body>
		<style type="text/css">
			.jumbotron{
				background-image: url(images/jumbotronBackgroundImage2.png);
				background-size : cover;
				text-shadow: black 0.1em 0.1em 0.1em;
				color:white;
			}
		</style>
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
						<li class="active"><a href="intro_ko.php"> 소개 <span class="sr-only"></span></a>
						</li>
						<li><a href="Dust_ko.php">미세먼지 상황</a></li>
						<li><a href="map_ko.php"> 산책로 찾기 <span class="sr-only"></span></a>
						</li>

						<!--<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Satus <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="#">Daegu</a></li>
							</ul>
						</li> !-->
					</ul>
					<form class="navbar-form navbar-left">
						<div class="form-group">
						<!--	<input type="text" class="form-cintrol" placeholder="Enter content"> !-->
						</div>
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
			<div class="jumbotron">
				<h1 class="text-center"> 산책로 찾기 시스템을 소개 합니다. </h1>
				<p class="text-center"> 이 웹사이트는 미세먼지를 피해서 산책할수 있는 산책로를 제공해 줍니다. </p>
				<p class="text-center"><a class="btn btn-primary btn-lg" href="map_ko.php" role="button>">산책로 찾기<a></p>
			</div>
			<div class="row">

				<div class="col-md-4">
					<h4> 웹사이트를 소개합니다. </h4>
					<p> 이 웹사이트에서는 미세먼지를 피할수 있는 산책로를 간편하게 제공해 드립니다.</p>
					<!--<p><a class="btn btn-defualt" href="#"> More Detail </a></p>!-->
				</div>
				<div class="col-md-4">
					<h4> 실시간 데이터 </h4>
					<p> 대구에서 운행하고 있는 택시에서 데이터를 수집합니다.
						<br>
						그래서 보다 정확하고 실시간 데이터를 수집할수 있습니다.
					</p>
					<p><a class="btn btn-defualt" href="Dust_ko.php">	자세히 알아보기 </a></p>
				</div>
				<div class="col-md-4">
					<h4> 이 시스템의 특징 </h4>
					<p> 이 시스템의 특징은 실시간 데이터를 사용하여 누구나 쉽게 접근해서 자신에게 맞는 산책로를 찾을수 있다는것 입니다.</p>
					<!--<p><a class="btn btn-defualt" href="#"> More Detail </a></p>!-->
				</div>
			</div>
			<hr>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><span class="glyphicon glyphicon-gift"></span>
						&nbsp;&nbsp; 산책로 관련 용품</h3>
				</div>
				<div class="panel-body">
					<div class="media">
						<div class="media-left">
						</div>
						<div class="media-body">
							<div class="row">
								<div class="col-sm-12">
								<h4 class="media-heading">산책할 때 필요한 용품들을 확인해보세요<a href="#"></a>&nbsp;<span class="badge badge-error">HOT</span></h4>
								</div>
								<div class="col-sm-3"  style="text-align: center;">
								<a href="https://goo.gl/f1QTmy" target=_blank><img class="media-object" src="images/mask.jpg" alt="C images" style="width : 256px; height: 256px"></a>
								마스크는 챙기셨나요?
								</div>
								<div class="col-sm-3"  style="text-align: center;">
								<a href="https://goo.gl/WUWXmy" target=_blank><img class="media-object" src="images/sun.jpg" alt="C images" style="width : 256px; height: 256px"></a>
								자외선은 피부의 적입니다.
								</div>
								<div class="col-sm-3"  style="text-align: center;">
								<a href="https://goo.gl/DN8UuD" target=_blank><img class="media-object" src="images/shoes.jpg" alt="C images" style="width : 256px; height: 256px"></a>
								불편한 신발은 오히려 건강을 해쳐요
								</div>
								<div class="col-sm-3"  style="text-align: center;">
								<a href="https://goo.gl/ccd2w7" target=_blank><img class="media-object" src="images/air.jpg" alt="C images" style="width : 256px; height: 256px"></a>
								집에서는 신선한 공기를 마시세요
								</div>
							</div>
						</div>
					</div>
					<hr>
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
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>