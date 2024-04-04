<?php

session_start();

require_once "./fc.inc.php";

if (!isset($_SESSION['username'])) {
	header("Location: ./login.php");
	exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Commission</title>
		<link rel="stylesheet" href="./style/commission.css" media="all" type="text/css">
		<script src="./script/jquery-3.7.0.min.js"></script>
	</head>
	<body>
		<div id="modal-container">
			<button id="generate-pdf" class="type-2-button">Générer le pdf</button>
		</div>
		<form id="commission-container">
			<header id="commission-header">
				<div id="images-container">
					<div id="left-image-wrapper" class="image-container">
						<div class="remove-image-button" data-id="left-image-path">
							<img src="./images/cross.png" alt="Cross">
						</div>
						<span>Insérer une image</span>
						<img src="" alt="Image 1" onload="$(this).prev().hide(); $(this).show();" onerror="$(this).hide(); $(this).prev().show();">
					</div>
					<input type="file" id="left-image" name="left-image" accept="image/*">
					<input type="hidden" id="left-image-path" name="left-image-path" value>
					<div id="right-image-wrapper" class="image-container">
						<div class="remove-image-button" data-id="right-image-path">
							<img src="./images/cross.png" alt="Cross">
						</div>
						<span>Insérer une image</span>
						<img src="" alt="Image 2" onload="$(this).prev().hide(); $(this).show();" onerror="$(this).hide(); $(this).prev().show();">
					</div>
					<input type="file" id="right-image" name="right-image" accept="image/*">
					<input type="hidden" id="right-image-path" name="right-image-path" value>
				</div>
				<div id="commission-title">
					<h1>Fiche Avis Poursuite d'Études - Promotion <input type="text" id="promotion-year" class="lone-text-input" name="year" placeholder="Année de promotion" maxlength="16"></h1>
					<h1>Département Informatique IUT Le Havre</h1>
				</div>
			</header>
			<section id="student-information">
				<h2>FICHE D'INFORMATION ÉTUDIANT(E)</h2>
				<table id="information-table">
					<tbody>
						<tr>
							<td>NOM — Prénom :</td>
							<td colspan="6">
								<input type="text" id="student-name" name="student-name" maxlength="64">
							</td>
						</tr>
						<tr>
							<td>Apprentissage : (oui/non)</td>
							<td>BUT1</td>
							<td>
								<select id="student-but1" name="student-but1">
									<option value=""></option>
									<option value="true">Oui</option>
									<option value="false">Non</option>
								</select>
							</td>
							<td>BUT2</td>
							<td>
								<select id="student-but2" name="student-but2">
									<option value=""></option>
									<option value="true">Oui</option>
									<option value="false">Non</option>
								</select>
							</td>
							<td>BUT3</td>
							<td>
								<select id="student-but3" name="student-but3">
									<option value=""></option>
									<option value="true">Oui</option>
									<option value="false">Non</option>
								</select>
							</td>
						</tr>
						<tr>
							<td>Parcours d'études :</td>
							<td>n-2</td>
							<td>
								<input type="text" id="student-n-2" name="student-n-2" maxlength="16">
							</td>
							<td>n-1</td>
							<td>
								<input type="text" id="student-n-1" name="student-n-1" maxlength="16">
							</td>
							<td>n</td>
							<td>
								<input type="text" id="student-n" name="student-n" maxlength="16">
							</td>
						</tr>
						<tr>
							<td>Parcours BUT</td>
							<td colspan="6">
								<input type="text" id="student-but-path" name="student-but-path">
							</td>
						</tr>
						<tr>
							<td>Si mobilité à l'étranger (lieu, durée)</td>
							<td colspan="6">
								<input type="text" id="student-foreign-studies" name="student-foreign-studies">
							</td>
						</tr>
					</tbody>
				</table>
			</section>
			<section id="skills-information">
				<h2>RÉSULTATS DES COMPÉTENCES</h2>
				<div id="skills-tables-container">
					<table id="skills-table-1">
						<thead>
							<tr>
								<th></th>
								<th colspan="2">BUT 1</th>
								<th colspan="2">BUT 2</th>
							</tr>
							<tr>
								<th></th>
								<th>Moy.</th>
								<th>Rang</th>
								<th>Moy.</th>
								<th>Rang</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>UE1 — Réaliser des applications</td>
								<td id="but1-ue1-avg"></td>
								<td id="but1-ue1-rank"></td>
								<td id="but2-ue1-avg"></td>
								<td id="but2-ue1-rank"></td>
							</tr>
							<tr>
								<td>UE2 — Optimiser des applications</td>
								<td id="but1-ue2-avg"></td>
								<td id="but1-ue2-rank"></td>
								<td id="but2-ue2-avg"></td>
								<td id="but2-ue2-rank"></td>
							</tr>
							<tr>
								<td>UE3 — Administrer des systèmes</td>
								<td id="but1-ue3-avg"></td>
								<td id="but1-ue3-rank"></td>
								<td id="but2-ue3-avg"></td>
								<td id="but2-ue3-rank"></td>
							</tr>
							<tr>
								<td>UE4 — Gérer des données</td>
								<td id="but1-ue4-avg"></td>
								<td id="but1-ue4-rank"></td>
								<td id="but2-ue4-avg"></td>
								<td id="but2-ue4-rank"></td>
							</tr>
							<tr>
								<td>UE5 — Conduire des projets</td>
								<td id="but1-ue5-avg"></td>
								<td id="but1-ue5-rank"></td>
								<td id="but2-ue5-avg"></td>
								<td id="but2-ue5-rank"></td>
							</tr>
							<tr>
								<td>UE6 — Collaborer</td>
								<td id="but1-ue6-avg"></td>
								<td id="but1-ue6-rank"></td>
								<td id="but2-ue6-avg"></td>
								<td id="but2-ue6-rank"></td>
							</tr>
							<tr>
								<td>Maths</td>
								<td id="but1-maths-avg"></td>
								<td id="but1-maths-rank"></td>
								<td id="but2-maths-avg"></td>
								<td id="but2-maths-rank"></td>
							</tr>
							<tr>
								<td>Anglais</td>
								<td id="but1-english-avg"></td>
								<td id="but1-english-rank"></td>
								<td id="but2-english-avg"></td>
								<td id="but2-english-rank"></td>
							</tr>
							<tr>
								<td>Nombre d'absences injustifiées</td>
								<td id="but1-unjustified-absences" colspan="2"></td>
								<td id="but2-unjustified-absences" colspan="2"></td>
							</tr>
						</tbody>
					</table>
					<table id="skills-table-2">
						<thead>
							<tr>
								<th></th>
								<th colspan="2">BUT 3 — S5</th>
							</tr>
							<tr>
								<th></th>
								<th>Moy.</th>
								<th>Rang</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>UE1 — Réaliser des applications</td>
								<td id="but3-ue1-avg"></td>
								<td id="but3-ue1-rank"></td>
							</tr>
							<tr>
								<td>UE2 — Optimiser des applications</td>
								<td id="but3-ue2-avg"></td>
								<td id="but3-ue2-rank"></td>
							</tr>
							<tr>
								<td><del>UE3 — Administrer des systèmes</del></td>
								<td id="but3-ue3-avg"></td>
								<td id="but3-ue3-rank"></td>
							</tr>
							<tr>
								<td><del>UE4 — Gérer des données</del></td>
								<td id="but3-ue4-avg"></td>
								<td id="but3-ue4-rank"></td>
							</tr>
							<tr>
								<td><del>UE5 — Conduire des projets</del></td>
								<td id="but3-ue5-avg"></td>
								<td id="but3-ue5-rank"></td>
							</tr>
							<tr>
								<td>UE6 — Collaborer</td>
								<td id="but3-ue6-avg"></td>
								<td id="but3-ue6-rank"></td>
							</tr>
							<tr>
								<td>Maths</td>
								<td id="but3-maths-avg"></td>
								<td id="but3-maths-rank"></td>
							</tr>
							<tr>
								<td>Anglais</td>
								<td id="but3-english-avg"></td>
								<td id="but3-english-rank"></td>
							</tr>
							<tr>
								<td>Nombre d'absences injustifiées</td>
								<td id="but3-unjustified-absences" colspan="2"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</section>
			<section id="jury-opinion">
				<h3>Avis de l'équipe pédagogique pour la poursuite d'études après le BUT3</h3>
				<table id="jury-opinion-table">
					<thead>
						<tr>
							<th></th>
							<th></th>
							<th>Très Favorable</th>
							<th>Favorable</th>
							<th>Assez Favorable</th>
							<th>Sans avis</th>
							<th>Réservé</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td rowspan="2">Pour l'étudiant</td>
							<td>En école d'ingénieurs</td>
							<td>
								<input type="radio" id="very-fav-engineer" name="student-engineer-choice" value="Très Favorable">
							</td>
							<td>
								<input type="radio" id="fav-engineer" name="student-engineer-choice" value="Favorable">
							</td>
							<td>
								<input type="radio" id="bit-fav-engineer" name="student-engineer-choice" value="Assez Favorable">
							</td>
							<td>
								<input type="radio" id="no-thought-engineer" name="student-engineer-choice" value="Sans avis">
							</td>
							<td>
								<input type="radio" id="reserved-engineer" name="student-engineer-choice" value="Réservé">
							</td>
						</tr>
						<tr>
							<td>En master</td>
							<td>
								<input type="radio" id="very-fav-master" name="student-master-choice" value="Très Favorable">
							</td>
							<td>
								<input type="radio" id="fav-master" name="student-master-choice" value="Favorable">
							</td>
							<td>
								<input type="radio" id="bit-fav-master" name="student-master-choice" value="Assez Favorable">
							</td>
							<td>
								<input type="radio" id="no-thought-master" name="student-master-choice" value="Sans avis">
							</td>
							<td>
								<input type="radio" id="reserved-master" name="student-master-choice" value="Réservé">
							</td>
						</tr>
						<tr>
							<td rowspan="2">Nombre d'avis pour la promotion (total : 52)</td>
							<td>En école d'ingénieurs</td>
							<td>
								<input type="number" id="very-fav-engineer-count" name="very-fav-engineer-count" min="0" max="3" value>
							</td>
							<td>
								<input type="number" id="fav-engineer-count" name="fav-engineer-count" min="0" max="3" value>
							</td>
							<td>
								<input type="number" id="bit-fav-engineer-count" name="bit-fav-engineer-count" min="0" max="3" value>
							</td>
							<td>
								<input type="number" id="no-thought-engineer-count" name="no-thought-engineer-count" min="0" max="3" value>
							</td>
							<td>
								<input type="number" id="reserved-engineer-count" name="reserved-engineer-count" min="0" max="3" value>
							</td>
						</tr>
						<tr>
							<td>En master</td>
							<td>
								<input type="number" id="very-fav-master-count" name="very-fav-master-count" min="0" max="3" value>
							</td>
							<td>
								<input type="number" id="fav-master-count" name="fav-master-count" min="0" max="3" value>
							</td>
							<td>
								<input type="number" id="bit-fav-master-count" name="bit-fav-master-count" min="0" max="3" value>
							</td>
							<td>
								<input type="number" id="no-thought-master-count" name="no-thought-master-count" min="0" max="3" value>
							</td>
							<td>
								<input type="number" id="reserved-master-count" name="reserved-master-count" min="0" max="3" value>
							</td>
						</tr>
						<tr>
							<td>Commentaire</td>
							<td colspan="6">
								<input type="text" id="comment" name="comment">
							</td>
						</tr>
					</tbody>
				</table>
			</section>
			<section id="signature">
				<span>Signature du Chef du Département</span>
				<input type="text" id="chief-name" class="lone-text-input" name="department-head-name" placeholder="Nom du chef de Dépt." maxlength="64" value>
				<div id="chief-signature-wrapper" class="image-container">
					<div class="remove-image-button" data-id="chief-signature-path">
						<img src="./images/cross.png" alt="Cross">
					</div>
					<span>Signature et cachet du Dept</span>
					<img src="" alt="Image 1" onload="$(this).prev().hide(); $(this).show();" onerror="$(this).hide(); $(this).prev().show();">
				</div>
				<input type="file" id="chief-signature" name="chief-signature" accept="image/*">
				<input type="hidden" id="chief-signature-path" name="chief-signature-path" value>
			</section>
		</form>
		<script src="./script/commission.js"></script>
		<script src="./script/html2pdf.bundle.min.js"></script>
	</body>
</html>