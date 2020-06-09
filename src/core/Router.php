<?php 

use FastRoute\RouteCollector;
use FastRoute\Dispatcher;

class Router
{
	static function init(){

		$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
			include(APPROOT."/src/config/routes.php");

			if(!empty($routes["GET"])){
				foreach ($routes["GET"] as $route => $handler) {
					$r->addRoute('GET', $route, $handler);
				}
			}
		});

		// Fetch method and URI from somewhere
		$httpMethod = $_SERVER['REQUEST_METHOD'];
		$uri = $_SERVER['REQUEST_URI'];
		// Strip query string (?foo=bar) and decode URI
		if (false !== $pos = strpos($uri, '?')) {
		    $uri = substr($uri, 0, $pos);
		}
		$uri = rawurldecode($uri);

		$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

		switch ($routeInfo[0]) {
		    case Dispatcher::NOT_FOUND:
		        Base::notfound();
		        break;
		    case Dispatcher::METHOD_NOT_ALLOWED:
		        $allowedMethods = $routeInfo[1];
		        // ... 405 Method Not Allowed
		        break;
		    case Dispatcher::FOUND:
		        $handler = $routeInfo[1];
		        $vars = $routeInfo[2];
		        
		        $splitHandler = explode('/', $handler);
		        $class = $splitHandler[0];
		        $method = $splitHandler[1];
		        $controller = new $class;
		        $controller->$method($vars);
		        break;
		}
	}
}
?>