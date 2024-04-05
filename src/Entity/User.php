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
class User {

	// Propriétés de la classe
	public $idUsr;
	public $nom;
	public $mdp;
	public $admin;

	// Constructeur de la classe
	public function __construct($idUsr, $nom, $mdp, $admin) {
		$this->idUsr  = $idUsr;
		$this->nom    = $nom;
		$this->mdp    = $mdp;
		$this->admin = $admin;
	}

	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'identifiant de l'utilisateur
	public function getIdUsr() {
		return $this->idUsr;
	}

	// Méthode pour obtenir le nom de l'utilisateur
	public function getNom() {
		return $this->nom;
	}

	// Méthode pour obtenir le statut de l'utilisateur
	public function getStatut() {
		return $this->admin;
	}
}
