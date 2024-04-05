<?php

namespace App\Repository;

use App\Entity\Etudiant;
use App\Repository\DB;

/**
 * Classe pour interagir avec la base de données pour la table ETUDIANT.
 *
 * Cette classe permet de récupérer les données sur les étudiants depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur un étudiant X contenu dans la base.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class EtudiantBDD {

	// Méthode pour récupérer tous les étudiants depuis la base de données
	public function getAllEtudiants() {
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer tous les étudiants
		$query = "SELECT * FROM Etudiant";

		// Exécution de la requête
		$qres = pg_query($ptrBDD->conn, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD->conn);

		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == null)
			return null;

		// Parcours des résultats et création des objets Etudiant
		foreach ($res as $etud) {
			$tabEtud[] = new Etudiant($etud['idetu'], $etud['codenip'], $etud['civ'], $etud['nom'], $etud['prenom'],$etud['grptd'], $etud['grptp'], $etud['bac'], $etud['specialite']);
		}

		return $tabEtud;
	}

	// Méthode pour obtenir un étudiant par son ID
	public function getEtudiantByID($id) {
		// Connexion à la base de données
		$id = intval($id['id']);

		$ptrBDD = DB::getInstance();

		// Requête pour récupérer l'étudiant par son ID
		$query = "SELECT * FROM Etudiant WHERE idEtu = $id";

		// Exécution de la requête
		$qres = pg_query($ptrBDD->conn, $query);

		// Récupération du résultat
		$res = pg_fetch_array($qres);
		pg_free_result($qres);
		pg_close($ptrBDD->conn);

		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == null)
			return null;

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

		// var_dump($res);

		return $res;
	}


	// Méthode pour obtenir un étudiant par son nom et prénom
	public function getEtudiantByNomPrenom(string $nom, string $prenom) {
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer l'étudiant par son nom et prénom
		$query = "SELECT * FROM Etudiant WHERE LOWER(nom) LIKE LOWER('%$nom%') OR LOWER(prenom) LIKE LOWER('%$prenom%')";

		// Exécution de la requête
		$qres = pg_query($ptrBDD->conn, $query);

		// Récupération du résultat
		$res = pg_fetch_array($qres);
		pg_free_result($qres);
		pg_close($ptrBDD->conn);

		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == null)
			return null;

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

	public function getAllEtudiantsByFiltres($semestre, $anneeDebut, $anneeFin, $semestreValide) {
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer les étudiants par filtres
		$query = "SELECT * FROM Etudiant WHERE idEtu IN (SELECT idEtu FROM Validation WHERE idSemestre IN (SELECT idSemestre FROM Semestre WHERE semestre = $semestre AND annee >= $anneeDebut AND annee <= $anneeFin AND decision = '$semestreValide'))";

		// Exécution de la requête
		$qres = pg_query($ptrBDD->conn, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD->conn);

		// Si l'étudiant n'existe pas, on retourne NULL
		if ($res == null)
			return null;

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
