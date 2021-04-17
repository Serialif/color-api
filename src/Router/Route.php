<?php

namespace App\Router;

use App\Controller;

class Route
{

    /**
     * @var callable|string
     */
    private $callable;
    private string $path;
    private array $matches = [];
    private array $params = [];

    public function __construct(string $path, $callable)
    {
        $this->path = trim($path, '/');  // Retire les / en début et fin de chaine
        $this->callable = $callable;
    }

    /**
     * Vérifie si une route correspond à l'Url
     * @param string $url
     * @return bool
     */
    public function match(string $url): bool
    {
        $url = trim($url, '/'); // Retire les / en début et fin de chaine

        // On crée une expression régulière pour récupérer les paramètres
        $path = preg_replace_callback('%:([\w]+)%', [$this, 'paramMatch'], $this->path);
        $regex = "%^$path$%i";

        if (!preg_match($regex, $url, $matches)) {
            return false;
        }

        array_shift($matches); // On récupère uniquement le paramètre
        $this->matches = $matches;  // On sauvegarde les paramètre dans l'instance pour plus tard
        return true;
    }

    /**
     * Renvoie le nom du paramètre
     * @param array $match
     * @return string
     */
    private function paramMatch(array $match): string
    {
        if (isset($this->params[$match[1]])) {
            return '(' . $this->params[$match[1]] . ')';
        }
        return '([^/]+)';
    }

    /**
     * Exécute la fonction anonyme en lui passant les paramètres récupérés lors du preg_match()
     * @return ?bool
     */
    public function call(): ?bool
    {
        if (is_string($this->callable)) {
            $controller = new Controller();
            return call_user_func_array([$controller, $this->callable], $this->matches);
        } else {
            return call_user_func_array($this->callable, $this->matches);
        }
    }

    /**
     * Ajoute des contraintes sur les paramètres
     * @param string $param
     * @param string $regex
     * @return $this
     */
    public function with(string $param, string $regex): Route
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this; // On retourne l'objet pour enchainer les arguments
    }

    /**
     * Renvoi l'Url en ajoutant les paramètres
     * @param array $params
     * @return string
     */
    public function getUrl(array $params): string
    {
        $path = $this->path;
        foreach ($params as $k => $v) {
            $path = str_replace(":$k", $v, $path);
        }
        return $path;
    }
}
