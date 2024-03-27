<?php

session_start();

require_once "./fc.inc.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
	header("Location: ./login.php");
	exit();
}

if (isset($_POST['display'])) {
	//$html = var_dump_ret($_SERVER);
	// class='selected'
	$html = "
	<div id='display-container'>
		<header id='display-header'>
			<button id='promotion-btn'>Promotion<div class='bottom-border stop-animation'></div></button>
			<button id='studient-btn'>Étudiant<div class='bottom-border stop-animation'></div></button>
		</header>
		<section id=''></section>
	</div>";
}

if (isset($_POST['import'])) {
	$html = "
	<div id='import-form-container'>
		<form id='import-form' method='POST'>
			<div id='form-content-wrapper'>
				<div id='grades-import-container'>
					<label for='grade-input-file'>Fichier Excel des moyennes :</label>
					<input type='file' id='grade-input-file' name='grades'>
				</div>
				<div id='jury-import-container'>
					<label for='jury-input-file'>Fichier Excel des jury :</label>
					<input type='file' id='jury-input-file' name='jury'>
				</div>
			</div>
		</form>
	</div>";
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
					<img id="logo" src="./images/ulhn.png" style="display: none">
				</div>
				<form method="POST" class="ghost-element">
					<button class="nav-button <?php echo isset($_POST['display']) ? "selected" : ""; ?>" name="display">Affichage</button>
				</form>
				<?php
				
				if ($_SESSION['isAdmin'] === true) {
					echo '<form method="POST" class="ghost-element ">
							<button class="nav-button ' . (isset($_POST['import']) ? "selected" : "") . '" name="import">Importer</button>
						</form>';
				}
				
				?>
				<form method="POST" class="ghost-element">
					<button class="nav-button" name="disconnect">Déconnexion</button>
				</form>
			</nav>
			<div id="page-content">
			<?php echo $html; ?>
			</div>
		</div>
		<script src="./script/all.js"></script>
	</body>
</html>