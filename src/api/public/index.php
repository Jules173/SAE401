<?php


spl_autoload_register(function ($class_name) {

	$class_name = str_replace('App\\','',$class_name);

	// Convertir le nom de la classe en chemin de fichier en remplaçant les antislashs par des barres obliques
	$file = '../src/' . str_replace('\\', '/', $class_name) . '.php';

	// Vérifier si le fichier de classe existe
	if (file_exists($file)) {
		// Inclure le fichier de classe
		include_once $file;
	}
});


