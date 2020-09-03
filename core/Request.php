<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\core;

/**
 * Description of Request
 *
 * @author toyrik
 */
class Request
{
    public function getPath()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');
        
        if ($position === false){
            return $path;
        }
        return substr($path, 0, $position);
    }
    
    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
}