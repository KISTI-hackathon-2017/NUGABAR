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
					<a class="navbar-brand" href="index2.php"> Find Track System </a>
				</div>
				<div class="collpase navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li class="active"><a href="index2.php"> Introduce <span class="sr-only"></span></a>
						</li>
						<li><a href="fineDustStatus.php">Fine Dust Status</a></li>
						<li><a href="index01.php"> Find Walkway <span class="sr-only"></span></a>
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
							<!--<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Test1 <span class="caret"></span></a>!-->
							<ul class="dropdown-menu">
								<li><a href="#">Test2</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div> 
		</nav>
		<div class ="container">
			<div class="jumbotron">
				<h1 class="text-center"> Introduce Find Trails System </h1>
				<p class="text-center"> This Website Provides Walkway To Avoid Fine Dust. </p>
				<p class="text-center"><a class="btn btn-primary btn-lg" href="index01.php" role="button>">Find walkway<a></p>
			</div>
			<div class="row">
				<div class="col-md-4">
					<h4> Real Time Data </h4>
					<p> We receive data in real time via taxi in Daegu.
						<br>
						So you can get accurate data.
					</p>
					<p><a class="btn btn-defualt" href="fineDustStatus.php">	More Detail </a></p>
				</div>
				<div class="col-md-4">
					<h4> This System's Feature </h4>
					<p> Anyone can use it simply and find a walkway to take a walk while avoiding fine dust.</p>
					<p><a class="btn btn-defualt" href="#">
						More Detail
					</a></p>
				</div>
				<div class="col-md-4">
					<h4> This System's Feature </h4>
					<p> Anyone can use it simply and find a walkway to take a walk while avoiding fine dust.</p>
					<p><a class="btn btn-defualt" href="#">
						More Detail
					</a></p>
				</div>
			</div>
			<hr>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title"><span class="glyphicon glyphicon-gift"></span>
						&nbsp;&nbsp; Walking Supplies</h3>
				</div>
				<div class="panel-body">
					<div class="media">
						<div class="media-left">
						</div>
						<div class="media-body">
							<div class="row">
								<div class="col-sm-12">
								<h4 class="media-heading">This Items Is Related To Walking<a href="#"></a>&nbsp;<span class="badge badge-error">HOT</span></h4>
								</div>
								<div class="col-sm-3"  style="text-align: center;">
								<a href="https://goo.gl/f1QTmy" target=_blank><img class="media-object" src="images/mask.jpg" alt="C images" style="width : 256px; height: 256px"></a>
								Have you got your mask?
								</div>
								<div class="col-sm-3"  style="text-align: center;">
								<a href="https://goo.gl/WUWXmy" target=_blank><img class="media-object" src="images/sun.jpg" alt="C images" style="width : 256px; height: 256px"></a>
								Ultraviolet rays are enemies of skin.
								</div>
								<div class="col-sm-3"  style="text-align: center;">
								<a href="https://goo.gl/DN8UuD" target=_blank><img class="media-object" src="images/shoes.jpg" alt="C images" style="width : 256px; height: 256px"></a>
								Uncomfortable shoes are <br>uncomfortable to walk
								</div>
								<div class="col-sm-3"  style="text-align: center;">
								<a href="https://goo.gl/ccd2w7" target=_blank><img class="media-object" src="images/air.jpg" alt="C images" style="width : 256px; height: 256px"></a>
								If you do not mind going outside,<br> drink fresh air in home.
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
					<div class="col-sm-5" style="text-align: left;"><h5>Introduce Team Member </h5><hr><h5>윤성호(Sungho Yun), 최호주(Hoju Choi), 한해인(Haein Han)</h5></div>
					
					<div class="col-sm-5" style="text-align : left;""><h5>Providing data</h5><hr><p>Kisti(Korea Institute of Science and Technology Information)
						<br> Daegu City</p></div>
					</div>		
				</div>
			</div>
		</footer>
		<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.js"></script>
	</body>
</html>