<?php

namespace App\Controleur;

use App\Entity\Etudiant;
use App\Repository\EtudiantBDD;

/**
 * Classe controleur de la partie étudiant.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class PromotionControleur {

	private $etudiant;

	public function __construct() {
		$this->etudiant = new EtudiantBDD();
	}

	public function getAllEtudiantByFiltres($semestre, $anneeDebut, $anneeFin, $semestreValide) {
		$etudiant = $this->etudiant->getAllEtudiantByFiltres($semestre, $anneeDebut, $anneeFin, $semestreValide);
		return $etudiant;
	}

}
