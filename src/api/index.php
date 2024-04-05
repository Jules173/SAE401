<?php

session_start();

require_once "./fc.inc.php";

if (!isset($_SESSION['username'])) {
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
			<div id='promotion-table-container' data-display='grid'>
				<div id='promotion-list'>
					<div id='promotion-semester-select-wrapper'>
						<select id='promotion-semester-select'>
							<option value='Semestre 1'>Semestre 1</option>
							<option value='Semestre 2'>Semestre 2</option>
							<option value='Semestre 3'>Semestre 3</option>
							<option value='Semestre 4'>Semestre 4</option>
							<option value='Semestre 5'>Semestre 5</option>
							<option value='Semestre 6'>Semestre 6</option>
						</select>
					</div>
					<div id='promotion-table-wrapper'>
						<table id='promotion-table'>
							<thead>
								<tr>
									<th>Étudiant</th>
									<th>C1</th>
									<th>C2</th>
									<th>C3</th>
									<th>C4</th>
									<th>C5</th>
									<th>C6</th>
									<th>Validé</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								";
								
								for ($i = 0; $i < 50; $i++)
									$html .= "
									<tr>
										<td>etud1</td>
										<td>ADM | 12</td>
										<td>ADM | 12</td>
										<td>ADM | 11</td>
										<td>ADM | 12</td>
										<td>ADM | 12</td>
										<td>ADM | 12</td>
										<td>ADM</td>
										<td>
											<img src='./images/draw.svg' alt='pencil' width='24' heigh='24'>
										</td>
									</tr>";
								
								$html .= "
							</tbody>
						</table>
					</div>
				</div>
				<form id='promotion-filter'>
					<span class='default-text'>Affichage</span>
					<div id='display-mode'>
						<div>
							<input type='radio' id='year-display' name='display-mode' value='year' checked>
							<label for='year-display'>Année</label>
						</div>
						<div>
							<input type='radio' id='semester-display' name='display-mode' value='semester'>
							<label for='semester-display'>Semestre</label>
						</div>
					</div>
					<div id='skills-display-container'>
						<span>Compétences :</span>
						<div id='skills-display-wrapper'>
							<div>
								<input type='checkbox' id='c1' name='c1' value='c1' checked>
								<label for='c1'>C1</label>
							</div>
							<div>
								<input type='checkbox' id='c2' name='c2' value='c2' checked>
								<label for='c2'>C2</label>
							</div>
							<div>
								<input type='checkbox' id='c3' name='c3' value='c3' checked>
								<label for='c3'>C3</label>
							</div>
							<div>
								<input type='checkbox' id='c4' name='c4' value='c4' checked>
								<label for='c4'>C4</label>
							</div>
							<div>
								<input type='checkbox' id='c5' name='c5' value='c5' checked>
								<label for='c5'>C5</label>
							</div>
							<div>
								<input type='checkbox' id='c6' name='c6' value='c6' checked>
								<label for='c6'>C6</label>
							</div>
						</div>
					</div>
					<div id='semester-details-container'>
						<input type='checkbox' id='semester-details' name='semester-details'>
						<label for='semester-details'>Affichage des ressources</label>
					</div>
					<div id='semester-validation-container'>
						<input type='checkbox' id='semester-validation' name='semester-validation'>
						<label for='semester-validation'>Semestre validé</label>
					</div>
					<div id='timestamp-container'>
						<span>Années d'études :</span>
						<div id='timestamp-wrapper'>
							<label for='start-date'>De :</label>
							<input type='number' id='start-date' name='start-date' min='1980' max='2400'>
							<label for='end-date'>À :</label>
							<input type='number' id='end-date' name='end-date' min='1980' max='2400'>
						</div>
					</div>
					<button id='export-btn' class='type-2-button uppercase'>Exporter</button>
				</form>
			</div>
			<div id='student-commission-container'>
				<div id='search-filter-container'>
					<div id='search-bar-wrapper'>
						<input type='search' id='student-search-bar' name='searchbar' placeholder='Rechercher un étudiant...'>
					</div>
					<button id='filter-btn'>
						<img src='./images/settings.svg' width='24' height='40' alt='Filtre'>
					</button>
				</div>
				<div id='student-table-container' data-display='flex'>
					<div id='student-semesters-selector'>
						<div id='semesters-buttons'>
							<button id='semester1-btn' class='semester-button'>Semestre 1</button>
							<button id='semester2-btn' class='semester-button'>Semestre 2</button>
							<button id='semester3-btn' class='semester-button'>Semestre 3</button>
							<button id='semester4-btn' class='semester-button'>Semestre 4</button>
							<button id='semester5-btn' class='semester-button'>Semestre 5</button>
							<button id='semester6-btn' class='semester-button'>Semestre 6</button>
						</div>
					</div>
					<div id='student-table-button-container'>
						<div id='student-table-wrapper'>
							<div id='semester1'>
								<div class='collapsible-body'>
									<div class='collapsible-show'>BIN11</div>
									<div class='collapsible-content hidden'>
									test
									</div>
								</div>
							</div>
						</div>
						<div id='student-button-container'>
						</div>
					</div>
				</div>
				<div id='commission-table-container' data-display='grid'>
					<form id='fields-form'>
						<fieldset id='logo-1-set' class='default-fieldset'>
							<label for='logo-1-input' class='default-text'>Logo n°1</label>
							<div class='default-box'>
								<input type='file' id='logo-1-input' class='file-input' data-before='Aucun fichier choisi' name='logo1' accept='image/*'>
							</div>
						</fieldset>
						<fieldset id='logo-2-set' class='default-fieldset'>
							<label for='logo-2-input' class='default-text'>Logo n°2</label>
							<div class='default-box'>
								<input type='file' id='logo-2-input' class='file-input' data-before='Aucun fichier choisi' name='logo2' accept='image/*'>
							</div>
						</fieldset>
						<fieldset id='signature-set' class='default-fieldset'>
							<label for='signature-input' class='default-text'>Signature et cachet</label>
							<div class='default-box'>
								<input type='file' id='signature-input' class='file-input' data-before='Aucun fichier choisi' name='signature' accept='image/*'>
							</div>
						</fieldset>
						<fieldset id='year-set' class='default-fieldset'>
							<label for='year-input' class='default-text'>Année de promotion</label>
							<div class='default-box'>
								<input type='number' id='year-input' name='year'>
							</div>
						</fieldset>
						<fieldset id='department-head-set' class='default-fieldset'>
							<label for='department-head-input' class='default-text'>Nom du chef de Dept.</label>
							<div class='default-box'>
								<input type='text' id='department-head-input' name='department-head'>
							</div>
						</fieldset>
					</form>
					<div id='commission-button-container'>
						<span class='student-name' default-text'></span>
						<div id='commission-button-container-2'>
							<button id='visualize-commission-button' class='type-2-button'>Visualiser</button>
							<button id='confirm-commission-button' class='type-2-button'>Valider</button>
						</div>
					</div>
					<div></div>
				</div>
			</div>
		</section>
	</div>";
}

if (isset($_POST['import'])) {
	$html = "
	<div id='import-wrapper'>
		<div id='import-container'>
			<div class='import-box'>
				<h2>
					Année du semestre :
					<input type='number' class='semester-year' name='year' value='2024'>
				</h2>
				<h3>
					Semestre
					<input type='number' class='semester'>
				</h3>
				<div class='import-files'>
					<div class='grades-import-container'>
						<label for='grade-input-file-1'>Fichier Excel des moyennes :</label>
						<input type='file' id='grade-input-file-1' class='file-input' data-before='Aucun fichier choisi' name='grades' accept='application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.ods'>
					</div>
					<div class='jury-import-container'>
						<label for='jury-input-file-1'>Fichier Excel des jury :</label>
						<input type='file' id='jury-input-file-1' class='file-input' data-before='Aucun fichier choisi' name='jury' accept='application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.ods'>
					</div>
				</div>
			</div>
			<div id='add-semester-button-container'>
				<button id='add-semester-button' class='type-2-button'>Ajouter un semestre</button>
			</div>
		</div>
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