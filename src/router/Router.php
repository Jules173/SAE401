<?php

namespace App\Router;

class Router {
	protected $routes = [];

	public function addRoute($method, $route, $controller, $action) {
		$this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
	}

	public function handle($method, $path) {

		// var_dump($method, $path);
		// echo "<br>";
		// var_dump($this->routes[$method]);
		// echo "<br>";

		foreach ($this->routes[$method] as $route => $handle) {
			if (preg_match('#^' . $this->patternToRegex($route) . '$#', $path, $matches)) {

				$controllerName  = $handle['controller'];
				$action = $handle['action'];
				$params = array_slice($matches, 1);

				// var_dump($params);

				$controller = new $controllerName();
				return $controller->$action($params);

			}
		}
		// Si aucune correspondance trouvée, affichez une erreur ou redirigez vers une page d'erreur 404
		throw new \Exception("Erreur 404: Page non trouvée");
	}

	private function patternToRegex($pattern) {
		return preg_replace_callback('/{(\w+)}/', function ($matches) {
			return '(?P<' . $matches[1] . '>[^/]+)';
		}, $pattern);
	}
}

?>
