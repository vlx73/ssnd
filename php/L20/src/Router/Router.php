<?php

namespace l20\Router;

use l20\Exceptions\RouteNotFoundException;

class Router
{
    
    /**
     * @var array
     */
    protected array $routes;
    
    /**
     * Register new router
     *
     * @param string $route
     * @param string $requestMethod
     * @param array $action
     * @return $this
     */
    protected function register(string $route, string $requestMethod, array $action): Router
    {
        $this->routes[strtoupper($requestMethod)][$route] = $action;
        return $this;
    }
    
    /**
     * Register new GET route
     *
     * @param string $route
     * @param array $action
     * @return $this
     */
    public function get(string $route, array $action): Router
    {
        return $this->register($route, 'get', $action);
    }
    
    /**
     * @param string $route
     * @param array $action
     * @return $this
     */
    public function post(string $route, array $action): Router
    {
        return $this->register($route, 'post', $action);
    }
    
    /**
     * @param string $route
     * @param array $action
     * @return $this
     */
    public function put(string $route, array $action): Router
    {
        return $this->register($route, 'put', $action);
    }
    
    /**
     * @param string $route
     * @param array $action
     * @return $this
     */
    public function delete(string $route, array $action): Router
    {
        return $this->register($route, 'delete', $action);
    }
    
    /**
     * Resolve and call route
     *
     * @param string $requestMethod
     * @param string $requestUri
     * @return mixed|void
     * @throws RouteNotFoundException
     */
    public function resolve(string $requestMethod, string $requestUri)
    {
        $route = explode('?', $requestUri)[0];
        
        $action = $this->routes[strtoupper($requestMethod)][$route] ?? null;
        
        if (!$action) {
            throw new RouteNotFoundException();
        }
        
        [$class, $method] = $action;
        if (class_exists($class)) {
            $class = new $class;
            
            if (method_exists($class, $method)) {
                return call_user_func([$class, $method], []);
            }
        }
        
        throw new RouteNotFoundException();
    }
}