<?php

/**
 * Classe d'un étudiant.
 * 
 * Cette classe permet de créer des objets représentant des étudiants.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur un étudiant X.
 * 
 * @author Eléonore Bouloché
 * @version 1.0
 */



class Etudiant
{
	// Propriétés de la classe
	private $nom;
	private $prenom;
	private $groupeTD;
	private $groupeTP;

	
	// Constructeur de la classe
	public function __construct($nom, $prenom, $groupeTD, $groupeTP) {
		$this->nom      = $nom;
		$this->prenom   = $prenom;
		$this->groupeTD = $groupeTD;
		$this->groupeTP = $groupeTP;
	}
	

	// Méthode pour obtenir le nom de l'étudiant
	public function getNom() {
		return $this->nom;
	}
	
	// Méthode pour obtenir le prénom de l'étudiant
	public function getPrenom() {
		return $this->prenom;
	}

	// Méthode pour obtenir le groupe TD de l'étudiant
	public function groupeTD() {
		return $this->groupeTD;
	}

	// Méthode pour obtenir le groupe TP de l'étudiant
	public function groupeTP() {
		return $this->groupeTP;
	}
}

?>
