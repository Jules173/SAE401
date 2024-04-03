<?php

use App\Controleur\CommissionControleur;
use App\Controleur\EtudiantControleur;
use App\Controleur\ExportControleur;
use App\Controleur\ImportControleur;
use App\Controleur\PromotionControleur;

// Code pour définir les routes
return [

	// Routes pour les étudiants
	'/etudiants' => [
		['GET', '', ['App\Controleur\EtudiantControleur', 'getAllEtudiants']],
	],


	'/etudiants/{id}' => [
		['GET', '', ['App\Controleur\EtudiantControleur', 'getEtudiantByID']],
		['GET', '/competences', ['App\Controleur\EtudiantControleur', 'getCompetencesByEtudiantID']],
		['GET', '/competences/{idComp}', ['App\Controleur\EtudiantControleur', 'getCompetenceByEtudiantID']],
		['GET', '/semestres', ['App\Controleur\EtudiantControleur', 'getSemestresByEtudiantID']],
		['GET', '/semestres/{idSem}', ['App\Controleur\EtudiantControleur', 'getSemestreByEtudiantID']],
		['GET', '/semestres/{idSem}/competences', ['App\Controleur\EtudiantControleur', 'getCompetencesByEtudiantIDSemestre']]
	],

];



