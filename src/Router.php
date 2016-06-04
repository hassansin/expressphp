<?php
namespace ExpressPHP;

class Router{
    public function __construct(){
        $this->_stack = [];
    }
    
    public function mount($path, self $router){
        if(count($router->_stack)){
            foreach($router->_stack as $route){
                $route->prepend($path);
            }
            $this->_stack += $router->_stack;
        }
    }
    public function __call($name, $arguments)
    {
        $method = strtoupper($name);
        $path = $arguments[0];
        $handle = $arguments[1];
        array_push($this->_stack, new Route($method, $path, $handle));
        return $this;
    }
}