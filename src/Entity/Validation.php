<?php

namespace App\Entity;

/**
 * Classe représentant la validation d'un semestre pour un étudiant.
 *
 * Cette classe permet de créer des objets représentant la validation d'un semestre pour un étudiant.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur la validation d'un semestre X pour un étudiant Y.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class Validation {

	// Propriétés de la classe
	public $etudiant;
	public $semestre;
	public $decision;
	public $motif;
	public $typeAdm;
	public $annee;

	// Constructeur de la classe
	public function __construct($etudiant, $semestre, $decision, $motif, $typeAdm, $annee) {
		$this->etudiant = $etudiant;
		$this->semestre = $semestre;
		$this->decision = $decision;
		$this->motif    = $motif;
		$this->typeAdm  = $typeAdm;
		$this->annee    = $annee;
	}

	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'objet Etudiant associé à la validation
	public function getEtudiant() {
		return $this->etudiant;
	}

	// Méthode pour obtenir l'objet Semestre associé à la validation
	public function getSemestre() {
		return $this->semestre;
	}

	// Méthode pour obtenir la décision de la validation
	public function getDecision() {
		return $this->decision;
	}

	// Méthode pour obtenir le motif de la validation
	public function getMotif() {
		return $this->motif;
	}

	// Méthode pour obtenir le type d'admission de la validation
	public function getTypeAdm() {
		return $this->typeAdm;
	}

	// Méthode pour obtenir l'année de la validation
	public function getAnnee() {
		return $this->annee;
	}
}
