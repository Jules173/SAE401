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



// Inclure le fichier de définition des routes
$routes = include_once '../src/routes.php';
$routes = include_once '../src/Router.php';

// Créer une instance du routeur
$router = new App\Router();

// Ajouter les routes définies dans le fichier routes.php
foreach ($routes as $route => $handlers) {
	foreach ($handlers as $handler) {
		// $handler[0] correspond à la méthode HTTP, $handler[1] correspond au chemin, $handler[2] correspond au contrôleur et à l'action
		$router->addRoute($handler[0], $route . $handler[1], $handler[2][0], $handler[2][1]);
	}
}

// Récupérer la méthode HTTP et le chemin de la requête
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

try {
	// Gérer la requête en utilisant le routeur
	$router->handle($method, $path);
} catch (\Exception $e) {
	// Afficher une erreur 404 en cas de route non trouvée
	header("HTTP/1.0 404 Not Found");
	echo $e->getMessage();
}



