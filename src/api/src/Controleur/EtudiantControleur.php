<?php

namespace App\Controler;

use App\Entity\Etudiant;
use App\Repository\EtudiantBDD;
use App\Repository\AttributionBDD;
use App\Repository\ValidationBDD;
use App\Repository\MoyenneEleveBDD;
use App\Repository\BinBDD;

class EtudiantControleur {

	public function getInfosEtudByID ($etudiantID) {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getEtudiantByID($etudiantID);


		return json_encode($etud);
	}

	public function getAllEtudiants () {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getAllEtudiants();
		return json_encode($etud);
	}

	public function getInfosEtudByNomPrenom ($etudiantNom, $etudiantPrenom) {
		$etudBDD = new EtudiantBDD();
		$etud = $etudBDD->getEtudiantByNomPrenom($etudiantNom, $etudiantPrenom);


		return json_encode($etud);
	}

	public function getMoyByBin ( $idBin, $idEtu ) {
		$moyenne = new MoyenneEleveBDD();
		return $moyenne->getMoyenneByBin($idBin, $idEtu);
	}

}




$e = new EtudiantControleur();
print_r($e->getMoyByBin(1, 1));
