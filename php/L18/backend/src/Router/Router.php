<?php

namespace pwa\Router;

use http\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid;

/**
 *
 */
class Router
{
    /**
     * @var array
     */
    private array $routes = [];
    
    
    /**
     * Configure get method route
     *
     * @param string $path
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function get(string $path, string $controller, string $action): static
    {
        $this->addRoute('GET', $path, $controller, $action);
        return $this;
    }
    
    /**
     * Configure post method route
     *
     * @param string $path
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function post(string $path, string $controller, string $action): static
    {
        $this->addRoute('POST', $path, $controller, $action);
        return $this;
    }
    
    /**
     * Configure put method route
     *
     * @param string $path
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function put(string $path, string $controller, string $action): static
    {
        $this->addRoute('PUT', $path, $controller, $action);
        return $this;
    }
    
    /**
     * Configure patch method route
     *
     * @param string $path
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function patch(string $path, string $controller, string $action): static
    {
        $this->addRoute('PATCH', $path, $controller, $action);
        return $this;
    }
    
    /**
     * Configure delete method route
     *
     * @param string $path
     * @param string $controller
     * @param string $action
     * @return $this
     */
    public function delete(string $path, string $controller, string $action): static
    {
        $this->addRoute('DELETE', $path, $controller, $action);
        return $this;
    }
    
    /**
     * Adds a route with potential dynamic parameters to the configuration
     */
    private function addRoute(string $method, string $path, string $controller, string $action): void
    {
        $method = strtoupper($method);
        [$regex, $parameterNames] = $this->parseRoute($path);
        
        $this->routes[$method][] = [
            'regex'      => $regex,
            'parameters' => $parameterNames,
            'controller' => $controller,
            'action'     => $action,
            'raw_path'   => $path,
        ];
    }
    
    /**
     * Parses a route string and converts dynamic segments to regex.
     *
     * Supported dynamic parameter syntax: {name:int} or {name:uuid}
     *
     * @param string $path The route pattern (e.g. "/users/{id:int}")
     * @return array An array with the regex pattern and list of parameter names.
     */
    private function parseRoute(string $path): array
    {
        $parameterNames = [];
        // Replace dynamic segments with named capture groups.
        $regex = preg_replace_callback('/\{(\w+):(int|uuid)\}/', function ($matches) use (&$parameterNames) {
            $parameterNames[] = $matches[1];
            if ($matches[2] === 'int') {
                return '(?P<' . $matches[1] . '>\d+)';
            } elseif ($matches[2] === 'uuid') {
                return '(?P<' . $matches[1] . '>[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12})';
            }
            throw new InvalidArgumentException('Only int and uuid parameter types are supported.');
        }, $path);
        
        // Ensure the regex matches the entire path.
        $regex = "#^" . $regex . "$#";
        return [$regex, $parameterNames];
    }
    
    /**
     * Dispatches the current request by matching the HTTP method and URL path.
     * If a matching route is found, it instantiates the corresponding controller and
     * calls the specified action, passing any dynamic parameters as arguments.
     */
    public function dispatch(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($requestUri, PHP_URL_PATH) ?: '/';
        
        $method = strtoupper($requestMethod);
        $routes = $this->routes[$method] ?? [];
        
        foreach ($routes as $route) {
            if (preg_match($route['regex'], $path, $matches)) {
                // Extract only the named parameters in the defined order.
                $params = [];
                foreach ($route['parameters'] as $name) {
                    if (isset($matches[$name])) {
                        $params[] = $matches[$name];
                    }
                }
                $controllerName = $route['controller'];
                $actionMethod = $route['action'];
                
                if (!class_exists($controllerName)) {
                    header("HTTP/1.1 500 Internal Server Error");
                    echo "Controller '$controllerName' not found.";
                    return;
                }
                
                $controller = new $controllerName();
                
                if (!method_exists($controller, $actionMethod)) {
                    header("HTTP/1.1 500 Internal Server Error");
                    echo "Action '$actionMethod' not found in controller '$controllerName'.";
                    return;
                }
                
                // Call the controller's action method with the dynamic parameters.
                call_user_func_array([$controller, $actionMethod], $params);
                return;
            }
        }
        
        header("HTTP/1.1 404 Not Found");
        echo "Route not found.";
    }
}
