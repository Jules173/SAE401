<?php

session_start();

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
	header("Location: ./login.php");
	exit();
}

if (isset($_POST['deconnect'])) {
	session_destroy();
	header("Location: ./login.php");
	exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Page d'accueil</title>
		<link rel="stylesheet" href="./style/all.css" media="all" type="text/css">
		<script src="./script/jquery-3.7.0.min.js"></script>
	</head>
	<body>
		<div id="body-container">
			<nav id="index-nav">
				<div id="logo-container">
					<img id="logo" src="./images/ulhn.png">
				</div>
				<div class="white-space"></div>
				<div class="white-space"></div>
				<button class="nav-button">Vue d'ensemble</button>
				<div class="half-white-space"></div>
				<button class="nav-button">Visualisation</button>
				<div class="white-space"></div>
				<button class="nav-button">Importer</button>
				<div class="half-white-space"></div>
				<button class="nav-button">Exporter</button>
				<div class="white-space"></div>
				<form method="POST" class="ghost-element">
					<button class="nav-button" name="deconnect">Déconnection</button>
				</form>
			</nav>
		</div>
		<script src="./script/all.js"></script>
	</body>
</html>

<?php
var_dump($_SESSION);
?>