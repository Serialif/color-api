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
        $this->path = trim($path, '/');  // Remove / at the beginning and end of the string
        $this->callable = $callable;
    }

    /**
     * Checks if a route matches the Url
     * @param string $url
     * @return bool
     */
    public function match(string $url): bool
    {
        $url = trim($url, '/'); // Remove / at the beginning and end of the string

        // Create a regular expression to retrieve the parameters
        $path = preg_replace_callback('%:([\w]+)%', [$this, 'paramMatch'], $this->path);
        $regex = "%^$path$%i";

        if (!preg_match($regex, $url, $matches)) {
            return false;
        }

        array_shift($matches); // Retrieve only the parameter
        $this->matches = $matches;  // Save the settings in the instance for later
        return true;
    }

    /**
     * Returns the name of the parameter
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
     * Execute the anonymous function, passing it the parameters retrieved during preg_match ()
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
     * Add constraints on parameters
     * @param string $param
     * @param string $regex
     * @return $this
     */
    public function with(string $param, string $regex): Route
    {
        $this->params[$param] = str_replace('(', '(?:', $regex);
        return $this; // Return the object to chain the arguments
    }

    /**
     * Return the Url adding the parameters
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
