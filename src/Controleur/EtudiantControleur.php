<?php

namespace App\Controleur;

use App\Entity\Etudiant;
use App\Entity\Competence;
use App\Repository\EtudiantBDD;
use App\Repository\AttributionBDD;
use App\Repository\ValidationBDD;
use App\Repository\CompetenceBDD;
use App\Repository\MoyenneCompetenceBDD;
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

	public function getAllCompetences() {
		$comp = new CompetenceBDD();
		return $comp->getAllCompetence();
	}

	public function getAllMoyenneCompetence() {
		$comp = new MoyenneCompetenceBDD();
		return $comp->getAllMoyenneCompetence();
	}

	public function getAllMoyenneEtudiant() {
		$comp = new MoyenneEleveBDD();
		return $comp->getAllMoyenneEleve();
	}

	public function getAllAttribution() {
		$comp = new AttributionBDD();
		return $comp->getAllAttribution();
	}

	public function getAttByIDComp($id) {
		$comp = new AttributionBDD();
		return $comp->getAttByIDComp($id);
	}

}
