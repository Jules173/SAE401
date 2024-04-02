<?php

	require 'vendor/autoload.php'; // Assurez-vous d'avoir inclus l'autoloader de PhpSpreadsheet

	use PhpOffice\PhpSpreadsheet\IOFactory;

	function convertUploadedXLSXtoCSV($inputName, $csvFilePath) {
		var_dump($_FILES);
		if ($_FILES[$inputName]['error'] !== UPLOAD_ERR_OK) {
			die("Erreur lors du téléchargement du fichier.");
		}

		// Vérifier si le fichier est bien un fichier XLSX
		$fileInfo = pathinfo($_FILES[$inputName]['name']);
		if ($fileInfo['extension'] !== 'xlsx') {
			die("Le fichier téléchargé n'est pas un fichier XLSX.");
		}

		// Déplacer le fichier téléchargé vers un emplacement temporaire
		$tempFilePath = $_FILES[$inputName]['tmp_name'];

		// Convertir le fichier XLSX en CSV
		convertXLSXtoCSV($tempFilePath, $csvFilePath);
	}

	function convertXLSXtoCSV($xlsxFilePath, $csvFilePath) {
		// Création d'un objet Spreadsheet
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($xlsxFilePath);
		
		// Sélection de la première feuille de calcul
		$sheet = $spreadsheet->getActiveSheet();
		
		// Ouverture du fichier CSV pour écriture
		$csvFile = fopen($csvFilePath, 'w');
		
		// Parcourir chaque ligne de la feuille de calcul
		foreach ($sheet->getRowIterator() as $row) {
			$rowData = array();
			// Parcourir chaque cellule de la ligne
			foreach ($row->getCellIterator() as $cell) {
				$rowData[] = $cell->getValue(); // Ajouter la valeur de la cellule au tableau des données
			}
			// Écrire la ligne au format CSV avec le séparateur ","
			fputcsv($csvFile, $rowData, ",", '"'); // Utilisation de la tabulation comme délimiteur et encadrement des champs avec des guillemets
		}
		
		// Fermeture du fichier CSV
		fclose($csvFile);
	}

	// Utilisation de la fonction pour convertir le fichier XLSX en CSV après avoir téléchargé le fichier
convertXLSXtoCSV('S1 FI jury.xlsx', 'lefichierdetest.csv');
?>