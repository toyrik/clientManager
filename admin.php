<?php

require("config.php");
session_start();
$action = isset($_GET['action']) ? $_GET['action'] : "";
$username = isset($_SESSION['username']) ? $_SESSION['username'] : "";

if ($action != "login" && $action != "logout" && !$username) {
    login();
    exit;
}

switch ($action) {
    case 'login':
        login();
        break;
    case 'logout':
        logout();
        break;
    case 'newUser':
        newUser();
        break;
    case 'editUser':
        editUser();
        break;
    case 'deleteUser':
        deleteUser();
        break;
    default:
        listUsers();
}

/**
 * Авторизация пользователя (админа) -- установка значения в сессию
 */
function login() {

    $results = array();
    $results['pageTitle'] = "Вход в панель управления | Список клиентов";

    if (isset($_POST['login'])) {

        // Пользователь получает форму входа: попытка авторизировать пользователя

        if ($_POST['username'] == ADMIN_USERNAME 
                && $_POST['password'] == ADMIN_PASSWORD) {

          // Вход прошел успешно: создаем сессию и перенаправляем на страницу администратора
          $_SESSION['username'] = ADMIN_USERNAME;
          header( "Location: admin.php");

        } else {

          // Ошибка входа: выводим сообщение об ошибке для пользователя
          $results['errorMessage'] = "Неправильный пароль, попробуйте ещё раз.";
          require( TEMPLATE_PATH . "/admin/loginForm.php" );
        }

    } else {

      // Пользователь еще не получил форму: выводим форму
      require(TEMPLATE_PATH . "/admin/loginForm.php");
    }

}


function logout()
{
    unset( $_SESSION['username'] );
    header( "Location: admin.php" );
}

/**
 * Список клиентов
 */
function listUsers()
{
    $results = [];

    $data = User::getList();
    $results['users'] = $data['results'];
    $results['totalRows'] = $data['totalRows'];

    

    $results['pageTitle'] = "Панель управления | Список клиентов";

    if (isset($_GET['error'])) { // вывод сообщения об ошибке (если есть)
        if ($_GET['error'] == "userNotFound")
            $results['errorMessage'] = "Ошибка: Пользователи не найдены";
    }

    if (isset($_GET['status'])) { // вывод сообщения (если есть)
        if ($_GET['status'] == "changesSaved") {
            $results['statusMessage'] = "Your changes have been saved.";
        }
        if ($_GET['status'] == "userDeleted") {
            $results['statusMessage'] = "Пользователь удалён.";
        }
    }

    require(TEMPLATE_PATH . "/admin/listUsers.php" );
}


function newUser()
{
	  
    $results = array();
    $results['pageTitle'] = "Панель управления | Создание клиента";
    $results['formAction'] = "newUser";

    if ( isset( $_POST['saveChanges'] ) ) {
        // Пользователь получает форму редактирования клиента: сохраняем нового клиента
        $user = new User();
        $user->storeFormValues( $_POST );
        $user->insert();
        header( "Location: admin.php?status=changesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // Пользователь сбросил результаты редактирования: возвращаемся к списку клиентов
        header( "Location: admin.php" );
    } else {

        // Пользователь еще не получил форму редактирования: выводим форму
        $results['user'] = new User;
        require( TEMPLATE_PATH . "/admin/editUser.php" );
    }
}


/**
 * Редактирование клиента
 * 
 * @return null
 */
function editUser()
{
	  
    $results = array();
    $results['pageTitle'] = "Панель управления | Редактирование клиента";
    $results['formAction'] = "editUser";

    if (isset($_POST['saveChanges'])) {

        // Пользователь получил форму редактирования клиента: сохраняем изменения
        if ( !$user = User::getById( (int)$_POST['userId'] ) ) {
            header( "Location: admin.php?error=userNotFound" );
            return;
        }

        $user->storeFormValues( $_POST );
        $user->update();
        header( "Location: admin.php?status=changesSaved" );

    } elseif ( isset( $_POST['cancel'] ) ) {

        // Пользователь отказался от результатов редактирования: возвращаемся к списку клиентов
        header( "Location: admin.php" );
    } else {

        // Пользвоатель еще не получил форму редактирования: выводим форму
        $results['user'] = User::getById((int)$_GET['userId']);
        require(TEMPLATE_PATH . "/admin/editUser.php");
    }

}


function deleteUser()
{

    if ( !$user = User::getById( (int)$_GET['userId'] ) ) {
        header( "Location: admin.php?error=userNotFound" );
        return;
    }

    $user->delete();
    header( "Location: admin.php?status=userDeleted" );
}
        