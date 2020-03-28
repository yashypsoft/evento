<?php

namespace Core;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function add($route, $params = [])
    {
        //convert route to reg ex  replace / with \/
        $route = preg_replace('/\//', '\\/', $route);

        //convert variable  ex{controller}
        $route = preg_replace('/\{([a-z0-9]+)\}/', '(?P<\1>[a-z0-9-]+)', $route);

        //convert variable with custom reg ex {id:\d+}
        $route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

        //start and end delimiter and case sensitive flag i
        $route = '/^' . $route . '$/i';

        $this->routes[$route] = $params;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function match($url)
    {
        // foreach ($this->routes as $route => $params) {
        //     if ($url == $route) {
        //         $this->params = $params;
        //         return true;
        //     }
        // }
        // return false;
        // $reg_ex = '/^(?P<controller>[a-z-]+)\/(?P<action>[a-z]+)$/';

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $params[$key] = $match;
                    }
                }
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function dispatch($url)
    {
        $url = $this->removeQueryStringVariable($url);
        if ($this->match($url)) {
            $controller = $this->params['controller'];
            $controller = $this->convertToStudyCaps($controller);
            // $controller = "App\Controllers\\$controller";
            $controller = $this->getNamespace() . $controller;
            if (class_exists($controller)) {
                $controllerObj = new  $controller($this->params);
                $action = $this->params['action'];
                $action = $this->convertToCamelCase($action);
                if (is_callable([$controllerObj, $action])) {
                    $controllerObj->$action();
                } else {
                    // echo "mehod $action not found";
                    throw new \Exception("Method $action  in controller $controller");
                }
            } else {
                // echo "controller $controller not found";
                throw new \Exception("controller class $controller not found");

            }
        } else {
            // echo "No Route Matched";
            throw new \Exception("No Route Matched",404);
        }
    }

    public function convertToStudyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    public function convertToCamelCase($string)
    {
        return lcfirst($this->convertToStudyCaps($string));
    }

    protected function removeQueryStringVariable($url)
    {
        if ($url != '') {
            $parts = explode('&', $url, 2);
            if (strpos($parts[0], '=') === false) {
                $url = $parts[0];
            } else {
                $url = '';
            }
        }
        return $url;
    }

    protected function getNamespace()
    {
        $namespace = "App\Controllers\\";
        if (array_key_exists('namespace', $this->params)) {
            $namespace .= $this->params['namespace'] . '\\';
        }
        return $namespace;
    }
}
