<?php

namespace App\Repository;

use App\Entity\User;
use App\Repository\DB;

/**
 * Classe représentant le contrôleur pour la gestion des utilisateurs depuis la base de données.
 *
 * Cette classe permet de récupérer les données sur les utilisateurs depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les utilisateurs.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class UserBDD {
	// Méthode pour récupérer tous les utilisateurs depuis la base de données
	public function getAllUser() {
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer tous les utilisateurs
		$query = "SELECT * FROM Users";

		// Exécution de la requête
		$qres = pg_query($ptrBDD->conn, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD->conn);

		// Si l'utilisateur n'existe pas, on retourne NULL
		if ($res == null)
			return null;

		// Création de l'objet User avec les données récupérées
		foreach ($res as $user) {
			$tabUser[] = new User(
				$user['idusr' ],
				$user['nom'   ],
				null,
				$user['statut']
			);
		}

		return $res;
	}

	public function getUserByName(string $name) {
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer tous les utilisateurs
		$query = "SELECT * FROM Users WHERE nom = '$name'";

		// Exécution de la requête
		$qres = pg_query($ptrBDD->conn, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD->conn);

		// Si l'utilisateur n'existe pas, on retourne NULL
		if ($res == null)
			return null;

		return new User(
			$res[0]['idusr' ],
			$res[0]['nom'   ],
			$res[0]['mdp'],
			$res[0]['admin']
		);;
	}

}
