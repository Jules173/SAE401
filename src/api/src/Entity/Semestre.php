<?php



/**
 * Classe représentant un semestre.
 *
 * Cette classe permet de créer des objets représentant un semestre.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur un semestre X.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */

namespace App\Entity;

// Semestre class
class Semestre
{

	// Propriétés de la classe
	private $idSemestre;
	private $semestre;
	private $annee;



	// Constructeur de la classe
	public function __construct($idSemestre, $semestre, $annee) {
		$this->idSemestre = $idSemestre;
		$this->semestre = $semestre;
		$this->annee = $annee;
	}



	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'identifiant du semestre
	public function getIdSemestre() {
		return $this->idSemestre;
	}

	// Méthode pour obtenir le numéro du semestre
	public function getSemestre() {
		return $this->semestre;
	}

	// Méthode pour obtenir l'année du semestre
	public function getAnnee() {
		return $this->annee;
	}
}
