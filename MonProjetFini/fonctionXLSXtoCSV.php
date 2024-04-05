<?php

	require 'vendor/autoload.php'; // Assurez-vous d'avoir inclus l'autoloader de PhpSpreadsheet
	
	require 'DB.inc.php';

	use PhpOffice\PhpSpreadsheet\IOFactory;
	use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

	function convertUploadedXLSXtoCSV($inputName, $csvFilePath) {

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
			fputcsv($csvFile, $rowData, ";", '"'); // Utilisation de la tabulation comme délimiteur et encadrement des champs avec des guillemets
		}

		// Fermeture du fichier CSV
		fclose($csvFile);
	}

	function importationBDD($csvFilePath, $anneeDuFichier)
	{
		/*------------------------------*/
		/* ORDRE D'IMPORT DANS LA BDD : */
		/*       FICHIER JURYS          */
		/*       FICHIER COEFFS         */
		/*       FICHIER MOYENNES       */
		/*------------------------------*/

		$DB = DB::getInstance();
		$handle = fopen($csvFilePath, "r");
		if ($handle !== FALSE) {
			while (($line = fgetcsv($handle)) !== FALSE) {
				// Traiter d'abord les fichiers "jury"
				foreach ($_FILES as $key => $file) {
					$filename = $file['name'];
					if (strpos($filename, 'jury') !== false) {
						echo "Traitement des fichiers 'jury': $filename <br>";
						// on récupère les informations en précisant le nom de la colonne pour plus de flexibilité, l'information peut être colonne 50 ou colonne 3, on la trouvera.
						//tableau associatif pour savoir le numéro de la colonne BIN102 par exemple

						$line = explode(";", $line[0]);
						foreach ($line as $index => $cell) {
							$tabInfo[$cell] = $index;
						}

						if($tabInfo['etudid'] == null | $tabInfo['etudid'] == ""){
							break 2;
						}

						//Semestre
						if (strpos($filename, 'S1') !== false) {$semestre = 1;}
						if (strpos($filename, 'S2') !== false) {$semestre = 2;}
						if (strpos($filename, 'S3') !== false) {$semestre = 3;}
						if (strpos($filename, 'S4') !== false) {$semestre = 4;}
						if (strpos($filename, 'S5') !== false) {$semestre = 5;}
						if (strpos($filename, 'S6') !== false) {$semestre = 6;}

						if (!$DB->ifExist( $semestre, 'SEMESTRE', 'idSemestre', 'Semestre')){
							$DB->insertSemestre($semestre, $anneeDuFichier);
						}
						//Competence
						$codeComp =  [$line[$tabInfo['BIN' . $semestre . '1']],
							          $line[$tabInfo['BIN' . $semestre . '2']],
							          $line[$tabInfo['BIN' . $semestre . '3']],
							          $line[$tabInfo['BIN' . $semestre . '4']],
							          $line[$tabInfo['BIN' . $semestre . '5']],
							          $line[$tabInfo['BIN' . $semestre . '6']]];
							
						$idSemestre = $DB->getSemestre($semestre, $anneeDuFichier)[0]['idsemestre'];

						foreach ($codeComp as $competence) {
							if(!$DB->ifExist($competence, 'Competence', 'code', 'Competence')){
								$DB->insertCompetencee($competence, $idSemestre);
							}
						}

						while (($line = fgetcsv($handle, 1000, ";")) !== FALSE) {
							

							//Etudiant
							$etudid = $line[$tabInfo['etudid']];
							$codenip = $line[$tabInfo['code_nip']];
							$civ = $line[$tabInfo['Civ.']];
							$nom = $line[$tabInfo['Nom']];
							$prenom = $line[$tabInfo['Prénom']];
							$TD = $line[$tabInfo['TD']];
							$TP = $line[$tabInfo['TP']];
							$bac = $line[$tabInfo['Bac']];
							$specialite = $line[$tabInfo['Spécialité']];

							//Administration
							$absence = $line[$tabInfo['Abs']];
							$nbAbsJust = $line[$tabInfo['Just.']];
							//$anneeDuFichier;

							//Validation
							$decision = $line[$tabInfo['Année']];
							$motif = $line[$tabInfo['Année'] + 1];
							$typeadm = $line[$tabInfo['"Type Adm."']];

							//Insert
							var_dump((int)$etudid, (int)$codenip, $civ, $nom, $prenom, $TD, $TP, $bac, $specialite);
							if (!$DB->ifExist($etudid, 'Etudiant', 'idEtu', 'Etudiant')) {
								$DB->insertEtudiant((int)$etudid, (int)$codenip, $civ, $nom, $prenom, $TD, $TP, $bac, $specialite);
							}

							if (!$DB->ifExist($etudid, 'Administration', 'idEtu', 'Administration')) {
								$DB->insertAdministration($absence, $nbAbsJust, $anneeDuFichier, $etudid);
							}

							if (!$DB->ifExist($etudid, 'Validation', 'idEtu', 'Validation')) {
								$DB->insertValidation($etudid, $idSemestre, $decision, $motif, $typeadm, $anneeDuFichier);
							}
						}

					}
				}
			}

			// Ensuite, traiter le fichier "coefficients"
			rewind($handle); // Retourner au début du fichier
			while (($line = fgetcsv($handle)) !== FALSE) {
				foreach ($_FILES as $key => $file) {
					$filename = $file['name'];
					if (strpos($filename, 'coefficients') === 0) {
						// Traitement du fichier "coefficients"
						echo "Traitement du fichier 'coefficients': $filename <br>";

						$cptECTS = 0;
						$cptSemestre = 0;
						//On passe les lignes inutiles, on s'arrête à la ligne n-1
						for ($i = 1; $i < 8; $i++) {
							fgetcsv($handle);
						}

						while (!empty($line)) {
							$line = fgetcsv($handle);
							//Si la ligne contient 'Semestre' ou  'ECTS', la ligne actuelle et la prochaine n'ont pas d'importance
							if (strpos($line[0], 'Semestre') !== FALSE) {
								$cptSemestre++;
								$line = fgetcsv($handle);
								$line = fgetcsv($handle);
							}

							while (empty($line)) {
								//Tant qu'une ligne est vide, on la passe (pour passer des BINR aux BINS)
								$line = fgetcsv($handle);
							}

							//si la ligne du fichier est vide et les 2 suivantes on sort de la boucle
							if (empty($line) && empty(fgetcsv($handle)) && empty(fgetcsv($handle))) {
								break;
							}

							$line = explode(";", $line[0]);

							//Bin

							$codeBin = $line[0];
							$nomBin = $line[1];
							$coeffComp1 = $line[3];
							$coeffComp2 = $line[4];
							$coeffComp3 = $line[5];
							$coeffComp4 = $line[6];
							$coeffComp5 = $line[7];
							$coeffComp6 = $line[8];

							if (!$DB->ifExist($codeBin, 'Bin', 'codeBin', 'Bin')) {
								$DB->insertBin($nomBin, $codeBin);
							}


							var_dump($cptSemestre, $anneeDuFichier);
							//Attribution
							$idSemestre = $DB->getSemestre($cptSemestre, $anneeDuFichier)[0]['idsemestre'];
							var_dump($idSemestre);
							$idComp = $DB->getComp($line[2], $DB->getSemestre($cptSemestre, $anneeDuFichier)[0]['idsemestre'])[0]['idcomp'];
							var_dump($idComp);
							$idBin = $DB->getBin($codeBin, $anneeDuFichier)[0]['idbin'];

							var_dump ($idBin);


							if($coeffComp1 != null){
								if (!$DB->ifExistss([$idComp, $idBin], "Attribution", "idComp", "idBin", 'Attribution')) {
									$DB->insertAttribution($idComp, $idBin, $coeffComp1);
								}
							}

							if($coeffComp2 != null){
								if (!$DB->ifExistss([$idComp, $idBin], "Attribution", "idComp", "idBin", 'Attribution')) {
									$DB->insertAttribution($idComp, $idBin, $coeffComp2);
								}
							}
							if($coeffComp3 != null){
								if (!$DB->ifExistss([$idComp, $idBin], "Attribution", "idComp", "idBin", 'Attribution')) {
									$DB->insertAttribution($idComp, $idBin, $coeffComp3);
								}
							}
							if($coeffComp4 != null){
								if (!$DB->ifExistss([$idComp, $idBin], "Attribution", "idComp", "idBin", 'Attribution')) {
									$DB->insertAttribution($idComp, $idBin, $coeffComp4);
								}
							}
							if($coeffComp5 != null){
								if (!$DB->ifExistss([$idComp, $idBin], "Attribution", "idComp", "idBin", 'Attribution')) {
									$DB->insertAttribution($idComp, $idBin, $coeffComp5);
								}
							}
							if($coeffComp6 != null){
								if (!$DB->ifExistss([$idComp, $idBin], "Attribution", "idComp", "idBin", 'Attribution')) {
									$DB->insertAttribution($idComp, $idBin, $coeffComp6);
								}
							}
						}

						break; // Sortir de la boucle après avoir traité le fichier "coefficients"
					}
				}
			}

			// Enfin, traiter les fichiers "moyennes"
			rewind($handle); // Retourner au début du fichier
			while (($line = fgetcsv($handle)) !== FALSE) {
				foreach ($_FILES as $key => $file) {
					$filename = $file['name'];
					if (strpos($filename, 'moyenne') !== false) {
						// Traitement des fichiers "moyennes"
						echo "Traitement des fichiers 'moyennes': $filename <br>";

						//tableau associatif pour savoir le numéro de la colonne BIN102 par exemple
						$line = explode(";", $line[0]);
						foreach ($line as $index => $cell) {
							$tabInfo[$cell] = $index;
						}

						while (($line = fgetcsv($handle)) !== FALSE) {
							//Etudiant
							$etudid = $line[$tabInfo['etudid']];
							$codenip = $line[$tabInfo['code_nip']];
							$civ = $line[$tabInfo['Civ.']];
							$nom = $line[$tabInfo['Nom']];
							$prenom = $line[$tabInfo['Prénom']];
							$TD = $line[$tabInfo['TD']];
							$TP = $line[$tabInfo['TP']];
							$bac = $line[$tabInfo['Bac']];
							$specialite = $line[$tabInfo['Spécialité']];

							//Administration
							$absence = $line[$tabInfo['Abs.']];
							$nbAbsJust = $line[$tabInfo['Just.']];

							//MoyenneEleve
							$cpt1 = 0;
							$bonusBin1 = $line[$tabInfo['BIN.\d+\.1'] +1];
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneCompetence", "idEtu", "idBin", 'MoyenneCompetence')) {
								$DB->insertMoyenneCompetence($idComp, $etudid, $bonusBin1, $idBin);
							}
							for ($cpt2 = $tabInfo['BIN.\d+\.1'] + 2; $cpt2 < $tabInfo['BIN.\d+\.2']; $cpt2++) {
								$tabBin1[$cpt1] = $line[$cpt2];
							}

							$cpt1 = 0;
							$bonusBin2 = $line[$tabInfo['BIN.\d+\.2'] +1];
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneCompetence", "idEtu", "idBin", 'MoyenneCompetence')) {
								$DB->insertMoyenneCompetence($idComp, $etudid, $bonusBin2, $idBin);
							}
							for ($cpt2 = $tabInfo['BIN.\d+\.2'] + 2; $cpt2 < $tabInfo['BIN.\d+\.3']; $cpt2++) {
								$tabBin2[$cpt1] = $line[$cpt2];
							}

							$cpt1 = 0;
							$bonusBin3 = $line[$tabInfo['BIN.\d+\.3'] +1];
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneCompetence", "idEtu", "idBin", 'MoyenneCompetence')) {
								$DB->insertMoyenneCompetence($idComp, $etudid, $bonusBin3, $idBin);
							}
							for ($cpt2 = $tabInfo['BIN.\d+\.3'] + 2; $cpt2 < $tabInfo['BIN.\d+\.4']; $cpt2++) {
								$tabBin3[$cpt1] = $line[$cpt2];
							}

							$cpt1 = 0;
							$bonusBin4 = $line[$tabInfo['BIN.\d+\.4'] +1];
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneCompetence", "idEtu", "idBin", 'MoyenneCompetence')) {
								$DB->insertMoyenneCompetence($idComp, $etudid, $bonusBin4, $idBin);
							}
							for ($cpt2 = $tabInfo['BIN.\d+\.4'] + 2; $cpt2 < $tabInfo['BIN.\d+\.5']; $cpt2++) {
								$tabBin4[$cpt1] = $line[$cpt2];
							}

							$cpt1 = 0;
							$bonusBin5 = $line[$tabInfo['BIN.\d+\.5'] +1];
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneCompetence", "idEtu", "idBin", 'MoyenneCompetence')) {
								$DB->insertMoyenneCompetence($idComp, $etudid, $bonusBin5, $idBin);
							}
							for ($cpt2 = $tabInfo['BIN.\d+\.5'] + 2; $cpt2 < $tabInfo['BIN.\d+\.6']; $cpt2++) {
								$tabBin5[$cpt1] = $line[$cpt2];
							}

							$cpt1 = 0;
							$bonusBin6 = $line[$tabInfo['BIN.\d+\.6'] +1];
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneCompetence", "idEtu", "idBin", 'MoyenneCompetence')) {
								$DB->insertMoyenneCompetence($idComp, $etudid, $bonusBin6, $idBin);
							}
							for ($cpt2 = $tabInfo['BIN.\d+\.6'] + 2; $cpt2 < $tabInfo['Bac']; $cpt2++) {
								$tabBin6[$cpt1] = $line[$cpt2];
							}

							//MoyenneCompetence
							$nomBin = array_keys($tabInfo);

							if (strpos($filename, 'S1') !== false){$semestre = 1;}
							if (strpos($filename, 'S2') !== false){$semestre = 2;}
							if (strpos($filename, 'S3') !== false){$semestre = 3;}
							if (strpos($filename, 'S4') !== false){$semestre = 4;}
							if (strpos($filename, 'S5') !== false){$semestre = 5;}
							if (strpos($filename, 'S6') !== false){$semestre = 6;}

							$tempMoy = 0;
							foreach ($tabBin1 as $moy) {
								if($cpt < $tabInfo['BIN.\d+\.2']){
									break 1;
								}
								$cpt = $tabInfo['BIN.\d+\.1'];
								$temp += ($moy * $DB->getCoeff($DB->getBin($nomBin[ + 2], $anneeDuFichier), $DB->getComp($nomBin[$tabInfo['BIN.\d+\.1']], $DB->getSemestre($semestre, $annee))));
								$cpt++;
							}
							$tempMoy = $temp / 100 + $bonusBin1;
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneEleve", "idEtu", "idBin", 'MoyenneEleve')) {
								$DB->insertMoyenneEleve($etudid, $idBin, $tempMoy, $anneeDuFichier);
							}

							$tempMoy = 0;
							foreach ($tabBin2 as $moy) {
								if($cpt < $tabInfo['BIN.\d+\.3']){
									break 1;
								} 
								$cpt = $tabInfo['BIN.\d+\.2'];
								$temp += ($moy * $DB->getCoeff($DB->getBin($nomBin[ + 2], $anneeDuFichier), $DB->getComp($nomBin[$tabInfo['BIN.\d+\.2']], $DB->getSemestre($semestre, $annee))));
								$cpt++;
							}
							$tempMoy = $temp / 100 + $bonusBin1;
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneEleve", "idEtu", "idBin", 'MoyenneEleve')) {
								$DB->insertMoyenneEleve($etudid, $idBin, $tempMoy, $anneeDuFichier);
							}

							$tempMoy = 0;
							foreach ($tabBin3 as $moy) {
								if($cpt < $tabInfo['BIN.\d+\.4']){
									break 1;
								} 
								$cpt = $tabInfo['BIN.\d+\.3'];
								$temp += ($moy * $DB->getCoeff($DB->getBin($nomBin[ + 2], $anneeDuFichier), $DB->getComp($nomBin[$tabInfo['BIN.\d+\.3']], $DB->getSemestre($semestre, $annee))));
								$cpt++;
							}
							$tempMoy = $temp / 100 + $bonusBin1;
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneEleve", "idEtu", "idBin", 'MoyenneEleve')) {
								$DB->insertMoyenneEleve($etudid, $idBin, $tempMoy, $anneeDuFichier);
							}

							$tempMoy = 0;
							foreach ($tabBin4 as $moy) {
								if($cpt < $tabInfo['BIN.\d+\.5']){
									break 1;
								} 
								$cpt = $tabInfo['BIN.\d+\.4'];
								$temp += ($moy * $DB->getCoeff($DB->getBin($nomBin[ + 2], $anneeDuFichier), $DB->getComp($nomBin[$tabInfo['BIN.\d+\.4']], $DB->getSemestre($semestre, $annee))));
								$cpt++;
							}
							$tempMoy = $temp / 100 + $bonusBin1;
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneEleve", "idEtu", "idBin", 'MoyenneEleve')) {
								$DB->insertMoyenneEleve($etudid, $idBin, $tempMoy, $anneeDuFichier);
							}
							$tempMoy = 0;
							foreach ($tabBin5 as $moy) {
								if($cpt < $tabInfo['BIN.\d+\.6']){
									break 1;
								} 
								$cpt = $tabInfo['BIN.\d+\.5'];
								$temp += ($moy * $DB->getCoeff($DB->getBin($nomBin[ + 2], $anneeDuFichier), $DB->getComp($nomBin[$tabInfo['BIN.\d+\.5']], $DB->getSemestre($semestre, $annee))));
								$cpt++;
							}
							$tempMoy = $temp / 100 + $bonusBin1;
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneEleve", "idEtu", "idBin", 'MoyenneEleve')) {
								$DB->insertMoyenneEleve($etudid, $idBin, $tempMoy, $anneeDuFichier);
							}

							$tempMoy = 0;
							foreach ($tabBin6 as $moy) {
								if($cpt < $tabInfo['Bac']){
									break 1;
								} 
								$cpt = $tabInfo['BIN.\d+\.6'];
								$temp += ($moy *$DB-> getCoeff($DB->getBin($nomBin[ + 2], $anneeDuFichier), $DB->getComp($nomBin[$tabInfo['BIN.\d+\.6']], $DB->getSemestre($semestre, $annee))));
								$cpt++;
							}							
							$tempMoy = $temp / 100 + $bonusBin1;
							if (!$DB->ifExistss([$etudid, $idBin], "MoyenneEleve", "idEtu", "idBin", 'MoyenneEleve')) {
								$DB->insertMoyenneEleve($etudid, $idBin, $tempMoy, $anneeDuFichier);
							}

						}
					}
				}
			}

			fclose($handle); // Fermer le fichier CSV
		}
	}

	/*function generateExcelFromDatabase($semestre, $annee) {
		// Création d'un nouvel objet Spreadsheet
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();

		
	
		// Entêtes des colonnes
		$sheet->setCellValue('A1', 'Rang')
			  ->setCellValue('B1', 'Nom')
			  ->setCellValue('C1', 'Prénom')
			  ->setCellValue('D1', 'Cursus')
			  ->setCellValue('E1', 'Nombre d\'UE validées')
			  ->setCellValue('F1', 'Moyenne générale');

			  
	
		// Récupération des données depuis la base de données
		$db = DB::getInstance();
		$studentsData = $db->getAllStudentsData(); // À adapter en fonction de votre structure de données réelle
		$tabInfo = getCompetencesModulesBySemestre(getSemestre($semestre, $annee));
	
		// Initialisation du compteur de ligne
		$row = 2;
	
		// Parcours des données
		foreach ($studentsData as $student) {
			// Traitement des données selon vos besoins
			// Exemple:
			$sheet->setCellValue('A' . $row, $student['rang'])
				  ->setCellValue('B' . $row, $student['nom'])
				  ->setCellValue('C' . $row, $student['prenom'])
				  ->setCellValue('D' . $row, $student['cursus'])
				  ->setCellValue('E' . $row, $student['ue_validees'])
				  ->setCellValue('F' . $row, $student['moyenne_generale'])
				  ->setCellValue('G' . $row, $student['moyennes_competences_bins']);
	
			$row++;
		}
	
		// Création d'un objet Writer pour Excel
		$writer = new Xlsx($spreadsheet);
	
		// Enregistrement du fichier Excel
		$writer->save('students_data.xlsx');
	}*/

	function valider($annee){
		// Vérifie si un fichier a été téléchargé
		if (isset($_FILES['inputname'])) {
			// Obtenir le nom du fichier téléchargé
			$inputname = $_FILES['inputname']['name'];
			// Chemin du fichier CSV de sortie avec le même nom
			$csvFilePath = pathinfo($inputname, PATHINFO_FILENAME) . '.csv';

			// Emplacement temporaire du fichier téléchargé
			$tmpFilePath = $_FILES['inputname']['tmp_name'];

		}
		//var_dump($_FILES['inputname']);
		convertUploadedXLSXtoCSV('inputname', $csvFilePath);
		echo(json_encode("OK !"));
		//importationBDD($csvFilePath, $annee);
	}

	function ifExist($id, $table, $idColumn, $dbColumn) {
		// Code de vérification dans la base de données
		// Remplacer cette partie par la logique réelle de vérification
		$DB = DB::getInstance();
		// Exemple de requête pour vérifier si une entrée avec l'id spécifié existe dans la table spécifiée
		$result = $DB->checkIfExists($id, $table, $idColumn, $dbColumn);
		return $result !== false; // Modification possible en fonction de la logique réelle
	}
	
	function ifExistss($params, $table, ...$columns) {
		// Code de vérification dans la base de données
		// Remplacer cette partie par la logique réelle de vérification
		$DB = DB::getInstance();
		// Exemple de requête pour vérifier si une entrée avec les paramètres spécifiés existe dans la table spécifiée
		$result = $DB->checkIfExistsWithParams($params, $table, ...$columns);
		return $result !== false; // Modification possible en fonction de la logique réelle
	}
	

	

	// Utilisation de la fonction pour convertir le fichier XLSX en CSV après avoir téléchargé le fichier
	valider(2023);
?>