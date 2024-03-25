<?php

session_start();

require_once "./fc.inc.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
	header("Location: ./login.php");
	exit();
}

if (isset($_POST['full-view'])) {
	$html = "<h1>TEXT</h1>";
}

if (isset($_POST['visualization'])) {
	$html = var_dump_ret($_SESSION);
}

if (isset($_POST['import'])) {
	$html = "
	<div id='import-form-container'>
		<form id='inport-form' method='POST'>
			
		</form>
	</div>";
}

if (isset($_POST['export'])) {
	$html = "";
}

if (isset($_POST['disconnect'])) {
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
				<form method="POST" class="ghost-element">
					<button class="nav-button" name="full-view">Vue d'ensemble</button>
				</form>
				<div class="half-white-space"></div>
				<form method="POST" class="ghost-element">
					<button class="nav-button" name="visualization">Visualisation</button>
				</form>
				<div class="white-space"></div>
				<form method="POST" class="ghost-element">
					<button class="nav-button" name="import">Importer</button>
				</form>
				<div class="half-white-space"></div>
				<form method="POST" class="ghost-element">
					<button class="nav-button" name="export">Exporter</button>
				</form>
				<div class="white-space"></div>
				<form method="POST" class="ghost-element">
					<button class="nav-button" name="disconnect">Déconnection</button>
				</form>
			</nav>
			<div id="page-content">
			<?php echo $html; ?>
			</div>
		</div>
		<script src="./script/all.js"></script>
	</body>
</html>