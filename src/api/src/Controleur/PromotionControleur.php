<?php


/**
 * Classe controleur de la partie étudiant.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */

namespace App\Controler;

use App\Entity\Etudiant;
use App\Repository\EtudiantBDD;

class PromotionControleur
{


	private $etudiant;

	public function __construct()
	{
		$this->etudiant = new EtudiantBDD();
	}



	public function getAllEtudiantByFiltres ( $semestre, $anneeDebut, $anneeFin, $semestreValide )
	{
		$etudiant = $this->etudiant->getAllEtudiantByFiltres( $semestre, $anneeDebut, $anneeFin, $semestreValide );

		return $etudiant;
	}



}
