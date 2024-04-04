<?php

use App\Router\Router;

spl_autoload_register(function ($className) {
	
	$className = str_replace('App\\','',$className);
	$file = '../src/' . str_replace('\\', '/', $className) . '.php';
	
	if (file_exists($file)) {
		require_once $file;
	}
	
	// Convertir le nom de la classe en chemin de fichier en remplaçant les antislashs par des barres obliques
	// $file = '../src/' . str_replace('\\', '/', $class_name) . '.php';
	// var_dump($class_name, $file);
	// Vérifier si le fichier de classe existe
	// if (file_exists($file)) {
		// Inclure le fichier de classe
		// include_once $file;
	// }
});



// Inclure le fichier de définition des routes
$routes = require_once '../src/Router/routes.php';
// $routes = include_once '../src/Router.php';

// Créer une instance du routeur
$router = new Router();

// Ajouter les routes définies dans le fichier routes.php
foreach ($routes as $route => $handlers) {
	foreach ($handlers as $handler) {
		// $handler[0] correspond à la méthode HTTP, $handler[1] correspond au chemin, $handler[2] correspond au contrôleur et à l'action
		$router->addRoute($handler[0], $route . $handler[1], $handler[2][0], $handler[2][1]);
	}
}

// Récupérer la méthode HTTP et le chemin de la requête
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

try {
	// Gérer la requête en utilisant le routeur
	$response = $router->handle($method, $path);
	var_dump($response);
} catch (\Exception $e) {
	// Afficher une erreur 404 en cas de route non trouvée
	header("HTTP/1.0 404 Not Found");
	echo $e->getMessage();
}

?>