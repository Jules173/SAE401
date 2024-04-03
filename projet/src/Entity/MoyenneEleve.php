<?php

 

/**
 * Classe représentant la moyenne d'un étudiant pour un bin donné.
 * 
 * Cette classe permet de créer des objets représentant la moyenne d'un étudiant pour un bin donné.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur la moyenne d'un étudiant X pour un bin Y.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */



class MoyenneEleve
{
	// Propriétés de la classe
	private $etudiant;
	private $bin;
	private $moyenne;
	private $annee;



	// Constructeur de la classe
	public function __construct( $etudiant, $bin, $moyenne, $annee ) {
		$this->etudiant   = $etudiant;
		$this->bin   = $bin;
		$this->moyenne = $moyenne;
		$this->annee   = $annee;
	}
	

	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'étudiant associé à la moyenne
	public function getEtudiant() {
		return $this->etudiant;
	}
	
	// Méthode pour obtenir le bin associé à la moyenne
	public function getBin() {
		return $this->bin;
	}

	// Méthode pour obtenir la moyenne de l'étudiant
	public function getMoyenne() {
		return $this->moyenne;
	}

	// Méthode pour obtenir l'année associée à la moyenne
	public function getAnnee() {
		return $this->annee;
	}

}


