<?php

/**
 * Classe controleur de la partie étudiant.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */

namespace App\Controler;

class ExportControleur {

	public function uploads () {}

	// Vérifie si un fichier a été téléchargé
	// if(isset($_FILES['fichier'])) {
	// 	$fichier = $_FILES['fichier'];

	// 	// Vérifie si aucun fichier n'a été sélectionné
	// 	if ($fichier['error'] == UPLOAD_ERR_NO_FILE) {
	// 		echo "Aucun fichier sélectionné.";
	// 	} else {
	// 		// Emplacement où vous souhaitez enregistrer le fichier téléchargé
	// 		$destination = 'uploads/' . basename($fichier['name']);

	// 		// Déplace le fichier téléchargé vers le dossier d'upload
	// 		if (move_uploaded_file($fichier['tmp_name'], $destination)) {
	// 			echo "Le fichier a été téléchargé avec succès.";
	// 		} else {
	// 			echo "Une erreur s'est produite lors du téléchargement du fichier.";
	// 		}
	// 	}
	// }


}
