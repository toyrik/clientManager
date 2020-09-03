<?php

class User
{
    /**
     * @var int ID клиента
     */
    public $id = null;

    /**
     * @var string имя клиента
     */
    public $name = null;

    /**
     * @var int телефон клиента
     */
    public $phone = null;

    /**
     * @var string адрес электронной почты клиента
     */
    public $email = null;

    public function __construct($data = array())
    {

        if (isset($data['id'])) {
            $this->id = (int) $data['id'];
        }

        if (isset($data['name'])) {
            $this->name = (string) $data['name'];
        }

        if (isset($data['phone'])) {
            $this->phone = (int) $data['phone'];
        }

        if (isset($data['email'])) {
            $this->email = (string) $data['email'];
        }
    }

    public function storeFormValues($params)
    {

        // Сохраняем все параметры
        $this->__construct($params);
        
    }
    
    public static function getById($id)
    {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "SELECT * FROM clients WHERE id = :id";
        $st = $conn->prepare($sql);
        $st->bindValue(":id", $id, PDO::PARAM_INT);
        $st->execute();

        $row = $st->fetch();
        
        $conn = null;

        if ($row) {
            return new User($row);
        }
    }

    public static function getList($numRows=1000000, $order="id ASC")
    {
        $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD);

        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM clients
            ORDER BY $order LIMIT :numRows";

        $st = $conn->prepare( $sql );
        $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
        $st->execute();
        $users = array();

        while ( $row = $st->fetch() ) {
            $user = new User( $row );
            $users[] = $user;
        }

        // Получаем общее количество клиентов, которые соответствуют критериям
        $sql = "SELECT FOUND_ROWS() AS totalRows";
        $totalRows = $conn->query( $sql )->fetch();
        $conn = null;
        return ( array ( "results" => $users, "totalRows" => $totalRows[0] ) );
    }

    /**
     * Вставляем текущий объект User в базу данных, устанавливаем его ID.
     */
    public function insert()
    {

        // Есть уже у объекта User ID?
        if (!is_null($this->id))
            trigger_error("User::insert(): Попытка вставить клиента с существующим ID: (to $this->id).", E_USER_ERROR);

        // Вставляем клиента
        try {
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "INSERT INTO clients ( name, phone, email) VALUES ( :name, :phone, :email)";
        $st = $conn->prepare($sql);
        $st->bindValue(":name", $this->name, PDO::PARAM_STR);
        $st->bindValue(":phone", $this->phone, PDO::PARAM_INT);
        $st->bindValue(":email", $this->email, PDO::PARAM_STR);
        $st->execute();
        $this->id = $conn->lastInsertId();
        
        $conn = null;
        }
        catch(PDOException $e) {
            trigger_error('Ошибка добавления записи'. $e->getMesage());
        }
    }

    /**
     * Обновляем текущего клиента в базе данных
     */
    public function update()
    {

        // Есть ли у объекта User ID?
        if (is_null($this->id))
            trigger_error("User::update(): "
                    . "Попытка обновления клиента "
                    . "с неустановленным ID.", E_USER_ERROR);

        // Обновляем клиента
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $sql = "UPDATE clients SET name=:name, phone=:phone, email=:email";

        $st = $conn->prepare($sql);
        $st->bindValue(":name", $this->name, PDO::PARAM_STR);
        $st->bindValue(":phone", $this->phone, PDO::PARAM_INT);
        $st->bindValue(":email", $this->email, PDO::PARAM_STR);
        $st->execute();
        
        $conn = null;
    }

    /**
     * Удаляем текущего клиента из базы данных
     */
    public function delete() {

        // Есть ли у объекта User ID?
        if (is_null($this->id))
            trigger_error("User::delete(): Попытка удаления клиента с отсутствующим ID.", E_USER_ERROR);

        // Удаляем статью
        $conn = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        $st = $conn->prepare("DELETE FROM clients WHERE id = :id LIMIT 1");
        $st->bindValue(":id", $this->id, PDO::PARAM_INT);
        $st->execute();
        $conn = null;
    }
}