<?php



require_once("../../.env.php");
require_once("../Entity/Etudiant.php");



/**
 * Classe pour interagir avec la base de données pour la table ETUDIANT.
 * 
 * Cette classe permet de récupérer les données sur les étudiants depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur un étudiant X contenu dans la base.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */



class EtudiantBDD
{
	// Méthode pour récupérer tous les étudiants depuis la base de données
	public function getAllEtudiants()
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer tous les étudiants
		$query = "SELECT * FROM Etudiant";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Tableau pour stocker les étudiants récupérés
		$tabEtud = array();

		// Parcours des résultats et création des objets Etudiant
		foreach ($res as $etud) {
			$tabEtud[] = new Etudiant(
				$etud['idetu'     ],
				$etud['codenip'   ],
				$etud['civ'       ],
				$etud['nom'       ],
				$etud['prenom'    ],
				$etud['grptd'     ],
				$etud['grptp'     ],
				$etud['bac'       ],
				$etud['specialite']
			);
		}



		return $tabEtud;
	}


	// Méthode pour obtenir un étudiant par son ID
	public function getEtudiantByID(int $id)
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer l'étudiant par son ID
		$query = "SELECT * FROM Etudiant WHERE idEtu = $id";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération du résultat
		$res = pg_fetch_array($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);


		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Création de l'objet Etudiant à partir des données récupérées
		$etudiant = new Etudiant(
			$res['idetu'     ],
			$res['codenip'   ],
			$res['civ'       ],
			$res['nom'       ],
			$res['prenom'    ],
			$res['grptd'     ],
			$res['grptp'     ],
			$res['bac'       ],
			$res['specialite']
		);


		return $res;
	}


	// Méthode pour obtenir un étudiant par son nom et prénom
	public function getEtudiantByNomPrenom(string $nom, string $prenom)
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer l'étudiant par son nom et prénom
		$query = "SELECT * FROM Etudiant WHERE nom = '$nom' AND prenom = '$prenom'";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération du résultat
		$res = pg_fetch_array($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Création de l'objet Etudiant à partir des données récupérées
		$etudiant = new Etudiant(
			$res['idetu'     ],
			$res['codenip'   ],
			$res['civ'       ],
			$res['nom'       ],
			$res['prenom'    ],
			$res['grptd'     ],
			$res['grptp'     ],
			$res['bac'       ],
			$res['specialite']
		);

		return $etudiant;
	}



	public function getAllEtudiantsByFiltres ( $semestre, $anneeDebut, $anneeFin, $semestreValide )
	{
		// Connexion à la base de données
		$ptrBDD = connexion();

		// Requête pour récupérer les étudiants par filtres
		$query = "SELECT * FROM Etudiant WHERE idEtu IN (SELECT idEtu FROM Validation WHERE idSemestre IN (SELECT idSemestre FROM Semestre WHERE semestre = $semestre AND annee >= $anneeDebut AND annee <= $anneeFin AND decision = '$semestreValide'))";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == NULL) { return NULL; }



		// Tableau pour stocker les étudiants récupérés
		$tabEtud = array();

		// Parcours des résultats et création des objets Etudiant
		foreach ($res as $etud) {
			$tabEtud[] = new Etudiant(
				$etud['idetu'     ],
				$etud['codenip'   ],
				$etud['civ'       ],
				$etud['nom'       ],
				$etud['prenom'    ],
				$etud['grptd'     ],
				$etud['grptp'     ],
				$etud['bac'       ],
				$etud['specialite']
			);
		}

		return $tabEtud;
	}
}



print_r((new EtudiantBDD())->getAllEtudiants());