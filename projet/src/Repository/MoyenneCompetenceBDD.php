<?php



require_once("../../.env.php");

require_once("../Entity/MoyenneCompetence.php");

require_once("EtudiantBDD.php");
require_once("CompetenceBDD.php");


/**
 * Classe représentant le contrôleur pour la gestion des moyennes des compétences depuis la base de données.
 * 
 * Cette classe permet de récupérer les données sur les moyennes des compétences depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les moyennes des compétences.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */



class MoyenneCompetenceBDD
{
	private $etudiant;
	private $competence;

	public function __construct()
	{
		$this->etudiant   = new EtudiantBDD();
		$this->competence = new CompetenceBDD();
	}



	// Méthode pour récupérer toutes les moyennes des compétences depuis la base de données
	public function getAllMoyenneCompetence()
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer toutes les moyennes des compétences
		$query = "SELECT * FROM MoyenneCompetence";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si la moyenne de la compétence n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Tableau pour stocker les moyennes des compétences récupérées
		$tabMoyenneCompetence = array();

		// Parcours des résultats et création des objets MoyenneCompetence
		foreach ($res as $moyCompetence) {
			$tabMoyenneCompetence[] = new Competence(
				$this->competence->getCompetenceByID($moyCompetence['idcomp']),
				$this->etudiant->getEtudiantByID($moyCompetence['idetu']),
				$moyCompetence['bonus'   ],
				$moyCompetence['decision']
			);
		}



		return $tabMoyenneCompetence;
	}
}


$c = new MoyenneCompetenceBDD();
print_r($c->getAllMoyenneCompetence());