<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
    }
    
    public function register(Request $request)
    {
        if ($request->isPost()) {
            return 'Handle submitted register data';
        }
        
        $this->setLayout('auth');
        return $this->render('register');
    }
}
