<?php

 



/**
 * Classe d'une administration liée à un étudiant.
 * 
 * Cette classe permet de créer des objets représentant des administrations liées à un étudiant.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur une administration X.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */


class Administration
{
	// Propriétés de la classe
	private $idAdmin;
	private $absence;
	private $nombreAbsenceJustifiees;
	private $statut;
	private $annee;
	private $etudiant;



	// Constructeur de la classe
	public function __construct( $idAdmin, $absence, $nombreAbsenceJustifiees, $statut, $annee, $etudiant ) {
		$this->idAdmin                 = $idAdmin;
		$this->absence                 = $absence;
		$this->nombreAbsenceJustifiees = $nombreAbsenceJustifiees;
		$this->statut                  = $statut;
		$this->annee                   = $annee;
		$this->etudiant                = $etudiant;
	}



	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'identifiant de l'administration
	public function getIdAdmin() {
		return $this->idAdmin;
	}
	
	// Méthode pour obtenir le nombre d'absences
	public function getabsence() {
		return $this->absence;
	}

	// Méthode pour obtenir le nombre d'absences justifiées
	public function getNombreAbsenceJustifiees() {
		return $this->nombreAbsenceJustifiees;
	}

	// Méthode pour obtenir le statut de l'administration
	public function getStatut() {
		return $this->statut;
	}

	// Méthode pour obtenir l'année de l'administration
	public function getAnnee() {
		return $this->anneem;
	}
	
	// Méthode pour obtenir l'étudiant lié à l'administration
	public function getEtudiant() {
		return $this->etudiant;
	}
}


