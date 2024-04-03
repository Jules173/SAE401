<?php

 

/**
 * Classe représentant le contrôleur pour la gestion des utilisateurs depuis la base de données.
 * 
 * Cette classe permet de récupérer les données sur les utilisateurs depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les utilisateurs.
 * 
 * @author BOULOCHE Eléonore
 * @version 1.0
 */



class UserBDD
{
	// Méthode pour récupérer tous les utilisateurs depuis la base de données
	public function getAllUser()
	{
		// Connexion à la base de données
		$ptrBDD = connexixon();

		// Requête pour récupérer tous les utilisateurs
		$query = "SELECT * FROM User";

		// Exécution de la requête
		$qres = pg_query($ptrBDD, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD);



		// Création de l'objet User avec les données récupérées
		$user = new User(
			$User['idusr' ],
			$User['nom'   ],
			$User['statut']
		);



		return $user;
	}
}


