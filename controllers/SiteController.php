<?php

namespace app\controllers;

class SiteController
{
    public function home()
    {
        $params = [
            'name' => 'losyash',
        ];
        return \app\core\Application::$app->router->renderVew('home', $params);
    }
    
    public function contact()
    {
        return \app\core\Application::$app->router->renderVew('contact');
    }
    
    public function handleContact()
    {
        return 'Handling submitted data';
    }
}
