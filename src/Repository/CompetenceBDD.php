<?php

namespace App\Repository;

use App\Entity\Competence;
use App\Repository\SemestreBDD;
use App\Repository\DB;

/**
 * Classe représentant le contrôleur pour la gestion des compétences depuis la base de données.
 *
 * Cette classe permet de récupérer les données sur les compétences depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les compétences.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class CompetenceBDD {

	private $semestre;

	public function __construct() {
		$this->semestre = new SemestreBDD();
	}

	// Méthode pour récupérer toutes les compétences depuis la base de données
	public function getAllCompetence() {
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer toutes les compétences
		$query = "SELECT * FROM Competence";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);

		// Si la compétence n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Tableau pour stocker les compétences récupérées
		$tabCompetence = array();

		// Parcours des résultats et création des objets Competence
		foreach ($res as $competence) {
			$tabCompetence[] = new Competence(
				$this->semestre->getSemestreByID($competence['idsemestre']),
				$competence['idcomp'],
				$competence['nom'   ],
				$competence['code'  ]
			);
		}



		return $tabCompetence;
	}


	// Méthode pour récupérer une compétence par son ID depuis la base de données
	public function getCompetenceByID(int $id)
	{
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer la compétence par son ID
		$query = "SELECT * FROM Competence WHERE idComp = $id LIMIT 1";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si la compétence n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Création de l'objet Competence avec les données récupérées
		$competence = new Competence(
			$this->semestre->getSemestreByID($res[0]['idsemestre']),
			$res[0]['idcomp'],
			$res[0]['nom'   ],
			$res[0]['code'  ]
		);

		return $competence;
	}
}
