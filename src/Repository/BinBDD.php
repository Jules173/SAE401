<?php

namespace App\Repository;

use App\Entity\Bin;
use App\Repository\DB;

/**
 * Classe représentant le contrôleur pour la gestion des bacs depuis la base de données.
 *
 * Cette classe permet de récupérer les données sur les bacs depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les bacs.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class BinBDD
{
	// Méthode pour récupérer tous les bacs depuis la base de données
	public function getAllBin()
	{
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer tous les bacs
		$query = "SELECT * FROM Bin";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si l'administration n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Tableau pour stocker les bacs récupérés
		$tabBin = array();

		// Parcours des résultats et création des objets Bin
		foreach ($res as $bin) {
			$tabBin[] = new Bin(
				$bin['idbin'  ],
				$bin['nombin' ],
				$bin['codebin']
			);
		}



		return $tabBin;
	}



	// Méthode pour récupérer un bac par son ID depuis la base de données
	public function getBinByID(int $id)
	{
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer le bac par son ID
		$query = "SELECT * FROM Bin WHERE idBin = $id LIMIT 1";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si le bac n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Création de l'objet Bin avec les données récupérées
		$bin = new Bin(
			$res[0]['idbin'  ],
			$res[0]['nombin' ],
			$res[0]['codebin']
		);



		return $bin;
	}

}
