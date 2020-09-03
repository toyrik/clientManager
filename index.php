<?php

session_start();
$action = isset($_GET['action']) ? $_GET['action'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

require("config.php");

try {
    initApplication();
} catch (Exception $e) { 
    $results['errorMessage'] = $e->getMessage();
    require(TEMPLATE_PATH . "/viewErrorPage.php");
}


function initApplication()
{
    $action = isset($_GET['action']) ? $_GET['action'] : "";

    switch ($action) {
        case 'viewUser':
          viewUser();
          break;
        default:
          homepage();
    }
}



/**
 * Загрузка страницы конкретного клиента
 * 
 * @return null
 */
function viewUser() 
{   
    if ( !isset($_GET["userId"]) || !$_GET["userId"] ) {
      homepage();
      return;
    }

    $results = array();
    $userId = (int)$_GET["userId"];
    $results['users'] = User::getById($userId);
    
    if (!$results['users']) {
        throw new Exception("Клиент с id = $userId не найден");
    }
    $results['pageTitle'] = $results['users']->title . " | Список клиентов";
    
    require(TEMPLATE_PATH . "/viewUser.php");
}

/**
 * Вывод домашней ("главной") страницы сайта
 */
function homepage() 
{
    $results = array();
    $data = User::getList(HOMEPAGE_NUM_USERS);
    $results['users'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];
    
    $results['pageTitle'] = "Список клиентов.";
        
    require(TEMPLATE_PATH . "/homepage.php");
    
}