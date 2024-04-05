<?php

namespace App\Entity;

/**
 * Classe représentant la moyenne d'un étudiant pour une compétence donnée.
 *
 * Cette classe permet de créer des objets représentant la moyenne d'un étudiant pour une compétence donnée.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur la moyenne d'un étudiant X pour une compétence Y.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class MoyenneCompetence {

	// Propriétés de la classe
	public $competence;
	public $etudiant;
	public $bonus;
	public $decision;

	// Constructeur de la classe
	public function __construct($competence, $etudiant, $bonus, $decision) {
		$this->competence = $competence;
		$this->etudiant   = $etudiant;
		$this->bonus      = $bonus;
		$this->decision   = $decision;
	}

	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'objet Competence associé à la moyenne
	public function getCompetence() {
		return $this->competence;
	}

	// Méthode pour obtenir l'objet Etudiant associé à la moyenne
	public function getEtudiant() {
		return $this->etudiant;
	}

	// Méthode pour obtenir le bonus ajouté à la moyenne de la compétence
	public function getBonus() {
		return $this->bonus;
	}

	// Méthode pour obtenir la décision d'admission de la compétence
	public function getDecision() {
		return $this->decision;
	}
}
