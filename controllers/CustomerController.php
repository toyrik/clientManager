<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\Customer;

class CustomerController extends Controller
{
    public function addСustomer(Request $request, Response $response)
    {
        $customer = new Customer;
        if ($request->isPost()) {
            $customer->loadData($request->getBody());
            if ($customer->validate() && $customer->save()) {
                Application::$app->session->setFlash('success', 'Запись успешно добавлена');
                return $response->redirect('/');
            }
        }
        
       return $this->render('add-customer', [
                'model' => $customer
        ]);
    }
    
    public function delete(Request $request, Response $response)
    {
        $customer = new Customer;
        $customer->delete($request->getBody());
        Application::$app->session->setFlash('success', 'Запись удалена');
                return $response->redirect('/');
        
    }
}
