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
		['GET', '/{id}', ['App\Controleur\EtudiantControleur', 'getInfosEtudByID']],
		['GET', '/{nom}/{prenom}', ['App\Controleur\EtudiantControleur', 'getInfosEtudByNomPrenom']],
		['GET', '/moyenne/{idBin}/{idEtu}', ['App\Controleur\EtudiantControleur', 'getMoyByBin']]
	],
	
];

?>