<?php

 


/**
 * Classe d'un bin.
 * 
 * Cette classe permet de créer des objets représentant des bins.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur un bin X.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */



class Etudiant
{
	// Propriétés de la classe
	private $idBin;
	private $nomBin;
	private $codeBin;



	// Constructeur de la classe
	public function __construct( $idBin, $nomBin, $codeBin ) {
		$this->idBin   = $idBin;
		$this->nomBin  = $nomBin;
		$this->codeBin = $codeBin;
	}
	

	// Méthodes pour obtenir les valeurs des propriétés de l'objet

	// Méthode pour obtenir l'identifiant du bin
	public function getIdBin() {
		return $this->idBin;
	}

	// Méthode pour obtenir le nom du bin
	public function getNomBin() {
		return $this->nomBin;
	}

	// Méthode pour obtenir le code du bin
	public function getCodeBin() {
		return $this->codeBin;
	}
}


