<?php

namespace App\Entity;

/**
 * Classe d'un étudiant.
 *
 * Cette classe permet de créer des objets représentant des étudiants.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur un étudiant X.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */

class Etudiant
{
	// Propriétés de la classe
	private $idEtu;
	private $codenip;
	private $civ;
	private $nom;
	private $prenom;
	private $grpTD;
	private $grpTP;
	private $bac;
	private $specialite;



	// Constructeur de la classe
	public function __construct( $idEtu, $codenip, $civ, $nom, $prenom, $grpTD, $grpTP, $bac, $specialite ) {
		$this->idEtu      = $idEtu;
		$this->codenip    = $codenip;
		$this->civ        = $civ;
		$this->nom        = $nom;
		$this->prenom     = $prenom;
		$this->grpTD      = $grpTD;
		$this->grpTP      = $grpTP;
		$this->bac        = $bac;
		$this->specialite = $specialite;
	}



	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'identifiant de l'étudiant
	public function getIdEtu() {
		return $this->idEtu;
	}

	// Méthode pour obtenir le code NIP de l'étudiant
	public function getCodenip() {
		return $this->codenip;
	}

	// Méthode pour obtenir le civ de l'étudiant
	public function getCiv() {
		return $this->civ;
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
	public function getGrpTD() {
		return $this->grpTD;
	}

	// Méthode pour obtenir le groupe TP de l'étudiant
	public function getGrpTP() {
		return $this->grpTP;
	}

	// Méthode pour obtenir le bac de l'étudiant
	public function getBac() {
		return $this->bac;
	}

	// Méthode pour obtenir la spécialité de l'étudiant
	public function getSpecialite() {
		return $this->specialite;
	}
}
