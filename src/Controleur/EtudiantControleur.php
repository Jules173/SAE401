<?php

namespace App\Controleur;

use App\Entity\Etudiant;
use App\Repository\EtudiantBDD;
use App\Repository\AttributionBDD;
use App\Repository\ValidationBDD;
use App\Repository\CompetenceBDD;
use App\Repository\MoyenneEleveBDD;
use App\Repository\BinBDD;

/**
 * Classe controleur de la partie étudiant.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class EtudiantControleur {

	public function getInfosEtudByID($etudiantID) {
		$etudBDD = new EtudiantBDD();
		return $etudBDD->getEtudiantByID($etudiantID);
	}

	public function getInfosEtudByNomPrenom($params) {
		$nom = $params['nom'];
		$prenom = $params['prenom'];
		// var_dump($etudiantNom);
		$etudBDD = new EtudiantBDD();
		return $etudBDD->getEtudiantByNomPrenom($nom, $prenom);
	}

	public function getAllEtudiants() {
		$etudBDD = new EtudiantBDD();
		return $etudBDD->getAllEtudiants();
	}

	public function getMoyByBin($idBin, $idEtu) {
		$moyenne = new MoyenneEleveBDD();
		return $moyenne->getMoyenneByBin($idBin, $idEtu);
	}

	public function getAllCompetence() {
		$comp = new CompetenceBDD();
		return $comp->getAllCompetence();
	}

}
