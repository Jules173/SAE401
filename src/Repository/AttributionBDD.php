<?php

namespace App\Repository;

use App\Entity\Attribution;
use App\Repository\BinBDD;
use App\Repository\CompetenceBDD;
use App\Repository\DB;

/**
 * Classe représentant le contrôleur pour la gestion des attributions depuis la base de données.
 *
 * Cette classe permet de récupérer les données sur les attributions depuis la base de données.
 * Elle va nous permettre d'obtenir toutes les informations nécessaires sur les attributions.
 *
 * @author BOULOCHE Eléonore
 * @version 1.0
 */
class AttributionBDD {

	private $competence;
	private $bin;

	public function __construct() {
		$this->competence = new CompetenceBDD();
		$this->bin        = new BinBDD();
	}

	// Méthode pour récupérer toutes les attributions depuis la base de données
	public function getAllAttribution() {
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer toutes les attributions
		$query = "SELECT * FROM Attribution";

		// Exécution de la requête
		$qres = pg_query($ptrBDD->conn, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD->conn);

		// Si l'attribution n'existe pas, on retourne NULL
		if ($res == null)
			return null;

		// Parcours des résultats et création des objets Attribution
		foreach ($res as $att) {
			$tabAttribution[] = new Attribution(
				$this->competence->getCompetenceByID($att['idcomp']),
				$this->bin->getBinByID($att['idbin']),
				$att['coeff']
			);
		}

		return $tabAttribution;
	}

	public function getAttByIDComp($idComp) {
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer toutes les attributions
		$query = "SELECT * FROM Attribution WHERE idComp = $idComp LIMIT 1";

		// Exécution de la requête
		$qres = pg_query($ptrBDD->conn, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD->conn);

		// Si l'attribution n'existe pas, on retourne NULL
		if ($res == null)
			return null;

		// Parcours des résultats et création des objets Attribution
		foreach ($res as $att) {
			$tabAttribution[] = new Attribution(
				$this->competence->getCompetenceByID($att[0]['idcomp']),
				$this->bin->getBinByID($att[0]['idbin']),
				$att[0]['coeff']
			);
		}

		return $tabAttribution;
	}

	public function getCoeffByIDComp($idComp) {
		// Connexion à la base de données
		$ptrBDD = DB::getInstance();

		// Requête pour récupérer toutes les attributions
		$query = "SELECT * FROM Attribution WHERE idComp = $idComp LIMIT 1";

		// Exécution de la requête
		$qres = pg_query($ptrBDD->conn, $query);

		// Récupération des résultats
		$res = pg_fetch_all($qres);
		pg_free_result($qres);
		pg_close($ptrBDD->conn);

		// Si l'attribution n'existe pas, on retourne NULL
		if ($res == null)
			return null;

		$attribution = new Attribution(
			$this->competence->getCompetenceByID($res[0]['idcomp']),
			$this->bin->getBinByID($res[0]['idbin']),
			$res[0]['coeff']
		);

		return $attribution->getCoeff();
	}

}
