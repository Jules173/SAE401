<?php

namespace App\

require_once("../../.env.php");

require_once("../Entity/Semestre.php");



/**
 * Classe représentant le contrôleur pour la gestion des semestres depuis la base de données.
 *
 * Cette classe permet de récupérer les données sur les semestres depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les semestres.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */



class SemestreBDD
{

	// Méthode pour récupérer tous les semestres depuis la base de données
	public function getAllSemestre()
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer tous les étudiants
		$query = "SELECT * FROM Semestre";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Tableau pour stocker les semestres récupérés
		$tabSemestre = array();

		// Parcours des résultats et création des objets Semestre
		foreach ($res as $semestre) {
			$tabSemestre[] = new Semestre(
				$semestre['idsemestre'],
				$semestre['semestre'  ],
				$semestre['annee'     ]
			);
		}

		return $tabSemestre;
	}



	// Méthode pour récupérer un semestre par son identifiant depuis la base de données
	public function getSemestreByID(int $id)
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer le semestre avec l'identifiant donné
		$query = "SELECT * FROM Semestre WHERE idSemestre = $id LIMIT 1";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);


		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Création de l'objet Semestre avec les données récupérées
		$semestre = new Semestre(
			$res[0]["idsemestre"],
			$res[0]["semestre"  ],
			$res[0]["annee"     ]
		);



		return $semestre;
	}




	public function getSemestreByAnnee(int $deb, int $fin) {
		// Connection to the database
		$ptrBDD = connexion();

		// Query to retrieve semesters with the given year range
		$query = "SELECT * FROM Semestre WHERE annee BETWEEN $deb AND $fin";

		// Execution of the query
		$qres = pg_query($ptrBDD, $query);

		// Retrieving results
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);

		// If no semester is found, return NULL
		if ($res == NULL) {
			return NULL;
		}

		$tabSemestre = array();

		// Creation of Semestre objects with the retrieved data
		foreach ($res as $sem) {
			$tabSemestre[] = new Semestre(
				$sem['idsemestre'],
				$sem['semestre'],
				$sem['annee']
			);
		}

		return $tabSemestre;
	}
}
