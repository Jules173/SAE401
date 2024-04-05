<?php

namespace App\Entity;

/**
 * Classe représentant une compétence.
 *
 * Cette classe permet de créer des objets représentant une compétence.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur une compétence X.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class Competence {

	// Propriétés de la classe
	public $idComp;
	public $nom;
	public $code;
	public $semestre;

	// Constructeur de la classe
	public function __construct($idComp, $nom, $code, $semestre) {
		$this->idComp   = $idComp;
		$this->nom      = $nom;
		$this->code     = $code;
		$this->semestre = $semestre;
	}

	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'identifiant de la compétence
	public function getIdComp() {
		return $this->idComp;
	}

	// Méthode pour obtenir le nom de la compétence
	public function getNom() {
		return $this->nom;
	}

	// Méthode pour obtenir le code de la compétence
	public function getCode() {
		return $this->code;
	}

	// Méthode pour obtenir le semestre de la compétence
	public function getSemestre() {
		return $this->semestre;
	}
}
