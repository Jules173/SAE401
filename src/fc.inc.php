<?php

function getImportPage() {
	return "
	<div id='import-wrapper'>
		<div id='import-modal-container'>
			<button id='submit-import-button' class='type-2-button' disabled>Envoyer</button>
		</div>
		<form id='import-container'>
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
		</form>
	</div>";
}

?>
