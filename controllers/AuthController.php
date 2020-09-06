<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->setLayout('auth');
        return $this->render('login');
    }
    
    public function register(Request $request)
    {
        $user = new User();
        if ($request->isPost()) {
            $user->loadData($request->getBody());
            if($user->validate() && $user->save()) {
                Application::$app->response->redirect('/');
            }
            return $this->render('register', [
                'model' => $user
            ]);
        }
        
        $this->setLayout('auth');
        return $this->render('register', [
                'model' => $user
            ]);
    }
}
