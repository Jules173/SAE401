<?php

// use App\Controler\CommissionControleur;
use App\Controler\EtudiantControleur;
// use App\Controler\ExportControleur;
// use App\Controler\ImportControleur;
// use App\Controler\PromotionControleur;

// Code pour définir les routes de l'application
return [

	// Routes pour les étudiants
	'/etudiants' => [
		['GET', '', ['App\Controleur\EtudiantControleur', 'getAllEtudiants']],
		['GET', '/{nom}/{prenom}', ['App\Controleur\EtudiantControleur', 'getInfosEtudByNomPrenom']],
		['GET', '/moyenne', ['App\Controleur\EtudiantControleur', 'getAllMoyenneEtudiant']],
		['GET', '/{id}', ['App\Controleur\EtudiantControleur', 'getInfosEtudByID']],
		['GET', '/moyenne/{idBin}/{idEtu}', ['App\Controleur\EtudiantControleur', 'getMoyByBin']],
		// ['GET', '/moyenne/{idComp}/{idEtu}', ['App\Controleur\EtudiantControleur', 'getMoyByBin']]
	],
	'/competences'=>[
		['GET', '', ['App\Controleur\EtudiantControleur', 'getAllCompetences']],
		['GET', '/moyenne', ['App\Controleur\EtudiantControleur', 'getAllMoyenneCompetence']]
	],
	'/bins'=>[
		['GET', '', ['App\Controleur\PromotionControleur', 'getAllBins']]
	],
	'/attributions'=>[
		['GET', '', ['App\Controleur\EtudiantControleur', 'getAllAttribution']],
		['GET', '/{idComp}', ['App\Controleur\EtudiantControleur', 'getAttByIDComp']]
	],
	'/semestres'=>[
		['GET', '', ['App\Controleur\PromotionControleur', 'getAllSemestres']]
	],
	'/utilisateurs'=>[
		['GET', '/{nom}', ['App\Controleur\PromotionControleur', 'getUserByName']]
	]

];

?>
