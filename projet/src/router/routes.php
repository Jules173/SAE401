<?php

require_once('../Controleur/EtudiantControleur.php');




// Code pour définir les routes
return [

	// Routes pour les étudiants
	'/etudiants' => [
		// ['GET', '', ['App\Controleur\EtudiantControleur', 'getAllEtudiants']],
		['GET', '/{id}', ['App\Controleur\EtudiantControleur', 'getInfosEtudByID']],
		['GET', '/{nom}/{prenom}', ['App\Controleur\EtudiantControleur', 'getInfosEtudByNomPrenom']],
		['GET', '/moyenne/{idBin}/{idEtu}', ['App\Controleur\EtudiantControleur', 'getMoyByBin']]
	],

];



