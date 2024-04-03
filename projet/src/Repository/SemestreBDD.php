<?php

 

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
		$ptrBDD = connexixon();

		// Requête pour récupérer tous les semestres
		$query = "SELECT * FROM Semestre";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



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
		$ptrBDD = connexixon();

		// Requête pour récupérer le semestre avec l'identifiant donné
		$query = "SELECT * FROM Semestre WHERE idSemestre = $id";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Création de l'objet Semestre avec les données récupérées
		$semestre = new Semestre(
			$res['idsemestre'],
			$res['semestre'  ],
			$res['annee'     ]
		);



		return $semestre;
	}




	public function getSemestreByAnnee ( int $deb, int $fin )
	{
		// Connexion à la base de données
		$ptrBDD = connexixon();

		// Requête pour récupérer le semestre avec l'identifiant donné
		$query = "SELECT * FROM Semestre WHERE annee BOULOCHE Eléonoretween $deb and $fin";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Création de l'objet Semestre avec les données récupérées
		$semestre = new Semestre(
			$res['idsemestre'],
			$res['semestre'  ],
			$res['annee'     ]
		);



		return $semestre;
	}
}


