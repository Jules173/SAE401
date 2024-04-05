<?php

namespace App\Controleur;

use App\Entity\Etudiant;
use App\Repository\EtudiantBDD;
use App\Repository\AttributionBDD;
use App\Repository\ValidationBDD;
use App\Repository\MoyenneEleveBDD;
use App\Repository\BinBDD;

/**
 * Classe controleur de la partie étudiant.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class EtudiantControleur
{
	public function getInfosEtudByID ($etudiantID) {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getEtudiantByID($etudiantID);


		return json_encode($etud);
	}


	public function getInfosEtudByNomPrenom ($etudiantNom, $etudiantPrenom) {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getEtudiantByNomPrenom($etudiantNom, $etudiantPrenom);


		return json_encode($etud);
	}

	public function getAllEtudiants() {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getAllEtudiants();
		// foreach($etud as $index=>$etud)
		// 	$etud[$index] = $etud->toJSON();
		return json_encode($etud);
		// return $etud;
	}

	public function getMoyByBin ( $idBin, $idEtu ) {
		$moyenne = new MoyenneEleveBDD();
		return $moyenne->getMoyenneByBin($idBin, $idEtu);
	}

}
