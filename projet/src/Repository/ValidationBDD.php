<?php


require_once("../../.env.php");

require_once ( "../Entity/Validation.php" );

require_once ( "../Repository/EtudiantBDD.php" );
require_once ( "../Repository/SemestreBDD.php" );




/**
 * Classe représentant le contrôleur pour la gestion des validations depuis la base de données.
 * 
 * Cette classe permet de récupérer les données sur les validations depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les validations.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */



class ValidationBDD
{
	// Propriétés de la classe
	public $etudiant;
	public $semestre;

	// Constructeur de la classe
	public function __construct()
	{
		// Initialisation de l'objet EtudiantBDD et de l'objet SemestreBDD
		$this->etudiant = new EtudiantBDD();
		$this->semestre = new SemestreBDD();
	}



	// Méthode pour récupérer toutes les validations depuis la base de données
	public function getAllValidation()
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer toutes les validations
		$query = "SELECT * FROM Validation";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si la validation n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Tableau pour stocker les validations récupérées
		$tabValidation = array();

		// Parcours des résultats et création des objets Validation
		foreach ($res as $valid) {
			$tabValidation[] = new Validation(
				$this->etudiant->getEtudiantByID($valid['idetu']     ),
				$this->semestre->getSemestreByID($valid['idsemestre']),
				$valid['decision'],
				$valid['motif'   ],
				$valid['typeadm' ],
				$valid['annee'   ]
			);
		}



		return $tabValidation;
	}



	public function getDebutAnneeEtudes ($idEtu)
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer toutes les validations
		$query = "SELECT annee FROM Validation WHERE idEtu = $idEtu ORDER BY annee ASC LIMIT 1";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);


		return $res[0]['annee'];
	}



	public function getFinAnneeEtudes ($idEtu)
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer toutes les validations
		$query = "SELECT annee FROM Validation WHERE idEtu = $idEtu ORDER BY annee DESC LIMIT 1";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);


		return $res[0]['annee'];
	}
}



$v = new ValidationBDD ();

print_r($v->getAllValidation());
print_r($v->getFinAnneeEtudes(1));
print_r($v->getDebutAnneeEtudes(1));