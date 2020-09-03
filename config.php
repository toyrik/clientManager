<?php
try {
    // Включаем полное отображение ошибок
    ini_set("display_errors", true);
    error_reporting(E_ALL);
    
    date_default_timezone_set("Europe/Moscow");  // http://www.php.net/manual/en/timezones.php
    
    // Настройки БД и остальных параметров будем хранить в массиве
    $CmsConfiguration = [
        'DB_DSN' => 'mysql:host=localhost;dbname=;charset=utf8;',
        'DB_USERNAME' => 'root',
        'DB_PASSWORD' => "qwe123",
        'CLASS_PATH' => 'classes',
        'TEMPLATE_PATH' => 'templates',
        'HOMEPAGE_NUM_USERS' => 10,      
        'ADMIN_USERNAME' => 'admin',
        'ADMIN_PASSWORD' => 'admin'
    ]; 
    
    
    include 'config-local.php'; /* подключаем локальный конфигурационный файл
     *  (для конкретной машины/сервера),
     *  в котором мы можем переопределить любые поля конфигурационного массива,
     *  например имя базы данных или пароль */
    
    // после того, как значения конфигурации определены, создаём для них константы
    defineConstants($CmsConfiguration);
    
    // Подключаем Классы моделей (классы, отвечающие за работу с сущностями базы данных)
    require(CLASS_PATH . "/User.php");  

} catch (Exception $ex) {
    echo "При загрузке конфигураций возникла проблема!<br><br>";
    error_log($ex->getMessage());
}

/**
 * Создаст константы, хранящие настройки приложения
 * 
 * @param array $constatsNameAndValues массив, содержащий в качестве ключей имена констант, 
 *  которые нужно объявить, а в качестве значений -- знчения этих констант
 */
function defineConstants($constatsNameAndValues)
{
    // обходим массив и определяем нужные константы
    foreach ($constatsNameAndValues as $constName => $constValue) {
       define($constName, $constValue);
    }
}