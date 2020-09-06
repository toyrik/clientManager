<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\core;

/**
 * Description of Controller
 *
 * @author toyrik
 * @package app\core
 */
class Controller
{
    public string $layout = 'main';
    
    public function render($view, $params = [])
    {
        return Application::$app->router->renderVew($view, $params);
    }
    
    public function setLayout($layout)
    {
        $this->layout = $layout;
    }
}
