<?php

namespace App\Router;


use App\Controller;

class Router
{

    private string $url; // URL sur laquelle on souhaite se rendre
    private array $routes = []; // Liste des routes
    private array $namedRoutes = []; // Liste des routes avec leur nom

    public function __construct($url)
    {
        $this->url = $url;
    }

    /**
     * Ajoute une route en GET
     * @param string $path
     * @param callable|string $callable
     * @param string|null $name
     * @return Route
     */
    public function get(string $path,  $callable, ?string $name = null): Route
    {
        return $this->add($path, $callable, $name, 'GET');
    }

    /**
     * Ajoute une route en POST
     * @param string $path
     * @param callable|string $callable
     * @param string|null $name
     * @return Route
     */
    public function post(string $path,  $callable, ?string $name = null): Route
    {
        return $this->add($path, $callable, $name, 'POST');
    }

    /**
     * Vérifie si une route correspond à l'Url
     * @return mixed
     */
    public function match()
    {
        if (!isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            (new Controller())->error404();
            return null;
        }
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->match($this->url)) {
                return $route->call();
            }
        }
        (new Controller())->error404();
        return null;
    }

    /**
     * Génère une URL à partir du nom de la route
     * @param string $name
     * @param array $params
     * @return mixed
     * @throws RouterException
     */
    public function generate(string $name, array $params = [])
    {
        if (!isset($this->namedRoutes[$name])) {
            throw new RouterException('No route matches this name');
        }
        return $this->namedRoutes[$name]->getUrl($params);
    }

    /**
     * Ajoute une route
     * @param string $path
     * @param callable|string $callable
     * @param string|null $name
     * @param string $method
     * @return Route
     */
    private function add(string $path, $callable, ?string $name, string $method): Route
    {
        $route = new Route($path, $callable);
        $this->routes[$method][] = $route;
        if (is_string($callable) && $name === null) {
            $name = $callable;
        }
        if ($name) {
            $this->namedRoutes[$name] = $route;
        }
        return $route;
    }
}