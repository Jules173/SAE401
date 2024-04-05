<?php

/**
 * Classe représentant l'attribution d'une compétence à un bin avec un coefficient.
 *
 * Cette classe permet de créer des objets représentant l'attribution d'une compétence à un bin avec un coefficient.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur l'attribution d'une compétence X à un bin Y avec un coefficient Z.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */

namespace App\Entity;

class Attribution
{
	// Propriétés de la classe
	private $competence;
	private $bin;
	private $coeff;



	// Constructeur de la classe
	public function __construct($competence, $bin, $coeff) {
		$this->competence = $competence;
		$this->bin        = $bin;
		$this->coeff      = $coeff;
	}


	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'objet Competence associé à l'attribution
	public function getCompetence() {
		return $this->competence;
	}

	// Méthode pour obtenir l'objet Bin associé à l'attribution
	public function getBin() {
		return $this->bin;
	}

	// Méthode pour obtenir le coefficient de l'attribution
	public function getCoeff() {
		return $this->coeff;
	}
}
