<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\core;

use app\core\middlewares\BaseMiddleware;

/**
 * Description of Controller
 *
 * @author toyrik
 * @package app\core
 */
class Controller
{
    public string $layout = 'main';
    public string $action = '';
    
    /**
     *
     * @var BaseMiddleware[]
     */
    protected array $middlewares = [];
    
    public function render($view, $params = [])
    {
        return Application::$app->router->renderVew($view, $params);
    }
    
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
    
    public function registerMiddleware(BaseMiddleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
    
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}
