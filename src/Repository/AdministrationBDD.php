<?php

namespace App\Repository;

use App\Entity\Administration;
use App\Entity\Etudiant;
use App\Repository\EtudiantBDD;
use App\Repository\DB;

/**
 * Classe représentant le contrôleur pour la gestion des administrations depuis la base de données.
 *
 * Cette classe permet de récupérer les données sur les administrations depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les administrations.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class AdministrationBDD
{
	// Propriétés de la classe
	public $etudiant;



	public function __construct()
	{
		$this->etudiant = new EtudiantBDD();
	}



	// Méthode pour récupérer toutes les administrations depuis la base de données
	public function getAllAdministration()
	{
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer toutes les administrations
		$query = "SELECT * FROM Administration";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si l'administration n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Tableau pour stocker les administrations récupérées
		$tabAdministration = array();

		// Parcours des résultats et création des objets Administration
		foreach ($res as $admin) {
			$tabAdministration[] = new Administration(
				$admin['idadmin'                ],
				$admin['absence'                ],
				$admin['nombreabsencejustifiees'],
				$admin['statut'                 ],
				$admin['annee'                  ],
				$this->etudiant->getEtudiantByID($admin['idetu'])
			);
		}



		return $tabAdministration;
	}
}
