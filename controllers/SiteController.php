<?php
namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;
use app\models\Customer;

class SiteController extends Controller
{

    public function home()
    {
        $customer = new Customer();
        
        if(!Application::isGuest()) {
            $params = [
                'name' => Application::$app->user->getDisplayName(),
                ];
        } else {
            $params = [
            'name' => 'guest!',
        ];
        } 
        $params['customers'] = $customer->getList();
        return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
                'model' => $contact
        ]);
    }
}
