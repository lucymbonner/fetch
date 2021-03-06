<?php
session_start();

if (isset($_SESSION['valid'])) {
    if ($_SESSION['valid'] !== true) {
        header("Location: ./index.php");
    }
} else {
    header("Location: ./index.php");
}

require_once "includes/db.php";
require_once "includes/main.php";

$username = select("username", "user", "username", $_SESSION['username']);

$links = getAllFileLinksFor($_SESSION['username']);

$amount_of_links = count($links);

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Fetch | Dashboard</title>
	<meta name="description" content="Find all the dog-friendly locations in your area, and bring your dog with you wherever you go.">
	<link rel="shortcut icon" href="img/favicon.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/mediaqueries.css">
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,700|Karla' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="titleBand"><img class="fetchTitle img-responsive center-block" alt="Responsive image" src="img/fetch_title_narrow.png"></div>
	<nav>
		<!-- hamburger on mobile display -->
		<a id="hamburger_icon" href="#menu">
			<span id="hamburger_top" class="hamburger_bar"></span>
			<span id="hamburger_middle" class="hamburger_bar"></span>
			<span id="hamburger_bottom" class="hamburger_bar"></span>
		</a>
		<div class="navbar">
			<ul class="nav navbar-nav">
				<li id="areaNav"><a href="index.php"><h3>TO HOMEPAGE</h3></a></li>
				<li id="logOutNav"><a href="./logout.php"><h3>LOG OUT</h3></a></li>
				<li id="tennisball"><a href="index.php"><img class="img-responsive center-block" src="img/tennisball.png"></a></li>
				<li id="signUpNav" data-toggle="signUpModal" data-target="#signUpModal"><a><h3>SIGN UP</h3></a></li>
				<li id="typeNav"><a href="index.php#browseType"><h3>BROWSE BY TYPE</h3></a></li>
			</ul>
		</div>
	</nav>
	<section id="dashboard">
		<header>
			<h2>HOME</h2>
		</header>
		<p>Hi, <strong><?php echo $username; ?></strong>. How’s your puppy?</p>
			<?php
			//shows list of all files uploaded as links to show contents in another window
			   for( $index = 0; $index < $amount_of_links; $index++ )
			   		echo "<img class='dashboardImg img-responsive center-block' src='uploads/".$links[$index]."'>";
			      //echo "         <dd><a href=\"uploads/$links[$index]\">$links[$index]</a></dd>\n";
			?>
		<div id="upload">
			<form enctype="multipart/form-data" action="upload.php" method="post">
				<label for="document"><h4>Upload a photo of your dog: </h4></label>
				<p><input class="btn btn-default" type="file" name="document" /></p>
				<button type="submit" class="btn btn-default" value="UPLOAD">UPLOAD</button>
			</form>
    	</div>
	</section>
	<section id="addNew">
		<div class="whiteTransparentWrapper">
		<h2>SUBMIT A NEW</h2><br>
		<h1>DOG – FRIENDLY</h1><br>
		<h2>PLACE IN THE CITY</h2><br>
		<form class="form-inline">
			<div class="form-group">
				<label for="type"><h4>Type: </h4></label>
					<select class="form-control">
						<option><p>Food</p></option>
						<option><p>Bars</p></option>
						<option><p>Parks</p></option>
						<option><p>Coffee</p></option>
						<option><p>Shopping</p></option>
						<option><p>Dog Needs</p></option>
					</select>
			</div>
			<div class="form-group">
				<label for="newPlaceName"><h4>Name of Place: </h4></label>
				<input type="text" class="form-control" id="newPlaceName" placeholder="What is it called?">
			</div>
			<button type="submit" class="btn btn-default">SUBMIT!</button>
		</form>
		</div>
		<footer>
			<div class="leftFoot">
				<h3>ABOUT FETCH</h3><br>
				<h3>CONTACT FETCH</h3><br>
				<h3>CAREERS AT FETCH</h3>
			</div>
			<div class="rightFoot">
				<a href="index.php#browseType"><h3>BROWSE FETCH</h3></a><br>
				<a href="index.php#addNew"><h3>SUBMIT TO FETCH</h3></a><br>
				<h3 class="signUpFoot" data-toggle="signUpModal" data-target="#signUpModal">BECOME A MEMBER OF FETCH</h3>
			</div>
			<div class="middleFoot">
				<h3>TWITTER</h3><br>
				<h3>FACEBOOK</h3><br>
				<h3>INSTAGRAM</h3>
			</div>
		</footer>
	</section>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAtkpcLyTqPcP4K64ykd6Gdq7y2rx1aufo"></script> -->
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/nav.js"></script>
	<script src="js/script.js"></script>
</body>
</html>