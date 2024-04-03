<?php


/**
 * Classe controleur de la partie étudiant.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */



include_once ('..\Repository\EtudiantBDD');


include_once ( '..\Entity\Etudiant'      );



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