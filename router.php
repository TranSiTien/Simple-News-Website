<?php

class Router
{

    private array $routes = [];

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function direct(string $uri)
    {
        if (array_key_exists($uri, $this->routes)) {

            return $this->routes[$uri];
        } else {
            throw new Exception('No route defined for this URI.');
        }
    }
}
