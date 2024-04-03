<?php

 

/**
 * Classe représentant le contrôleur pour la gestion des moyennes des élèves depuis la base de données.
 * 
 * Cette classe permet de récupérer les données sur les moyennes des élèves depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les moyennes des élèves.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */



class MoyenneEleveBDD
{
	private $etudiant;
	private $bin;

	public function __construct()
	{
		$this->etudiant = new EtudiantBDD();
		$this->bin      = new BinBDD();
	}



	// Méthode pour récupérer toutes les moyennes des élèves depuis la base de données
	public function getAllMoyenneEleve()
	{
		// Connexion à la base de données
		$ptrBDD = connexixon();

		// Requête pour récupérer toutes les moyennes des élèves
		$query = "SELECT * FROM MoyenneEleve";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Tableau pour stocker les moyennes des élèves récupérées
		$tabMoyenneEleve = array();

		// Parcours des résultats et création des objets MoyenneEleve
		foreach ($res as $moyEleve) {
			$tabMoyenneEleve[] = new MoyenneEleve(
				$this->etudiant->getEtudiantByID($moyEleve['idetu']),
				$this->bin->getBinByID($moyEleve['idbin']),
				$moyEleve['moyenne'],
				$moyEleve['annee'  ]
			);
		}



		return $tabMoyenneEleve;
	}
}


