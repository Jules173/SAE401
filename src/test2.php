<?php

session_start();

require_once "./fc.inc.php";

if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
	header("Location: ./login.php");
	exit();
}

if (isset($_POST['display'])) {
	$html = "
	<div id='display-container'>
		<header id='display-header'>
			<button id='promotion-btn' class='display-info-button'>Promotion<div class='bottom-border stop-animation'></div></button>
			<button id='student-btn' class='display-info-button'>Étudiant<div class='bottom-border stop-animation'></div></button>
			<button id='commission-btn' class='display-info-button'>Commission<div class='bottom-border stop-animation'></div></button>
		</header>
		<section id='display-data-container'>
			<div id='promotion-table-container'></div>
			<div id='student-table-container'>
				<div id='search-filter-container'>
					<div id='search-bar-wrapper'>
						<input type='search' id='student-search-bar' name='searchbar' placeholder='Rechercher un étudiant...'>
					</div>
					<button id='filter-btn'>
						<img src='./images/settings.svg' width='24' height='40' alt='Filtre'>
					</button>
				</div>
				<div id='student-semesters-selector'>
					<div id='semesters-buttons'>
						<button id='semester1' class='semester-button'>Semestre 1</button>
						<button id='semester2' class='semester-button'>Semestre 2</button>
						<button id='semester3' class='semester-button'>Semestre 3</button>
						<button id='semester4' class='semester-button'>Semestre 4</button>
						<button id='semester5' class='semester-button'>Semestre 5</button>
						<button id='semester6' class='semester-button'>Semestre 6</button>
					</div>
					<div>
				</div>
			</div>
			<div id='commission-table-container'></div>
		</section>
	</div>";
}

if (isset($_POST['import'])) {
	$html = "
	<table>
        <tr>
          <td>
            <div id='import-box'>
              <h2>
                Année du semestre :
                <input type='number' id='int-input' name='year' value='2024' />
              </h2>
              <h3>
			  	Semestre <input type='number' id='int-input'/>
			  </h3>
              <div id='import'>
                <div id='grades-import-container'>
                  <label for='grade-input-file'>
                    Fichier Excel des moyennes : </label
                  ><br />
                  <input type='file' id='grade-input-file' name='grades' />
                </div>
                <div id='jury-import-container'>
                  <label for='jury-input-file'>Fichier Excel des jury :</label
                  ><br />
                  <input type='file' id='jury-input-file' name='jury' />
                </div>
              </div>
            </div>
          </td>
        </tr>
      </table>";
}

if (isset($_POST['disconnect'])) {
	session_destroy();
	header("Location: ./login.php");
	exit();
}

if (isset($_POST['newValue'])) {
	header("Refresh:0");
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
		<script src="./script/test.js"></script>
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

