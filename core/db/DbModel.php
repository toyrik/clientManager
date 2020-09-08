<?php
namespace app\core\db;

use app\core\Application;
use app\core\Model;
use PDOStatement;

abstract class DbModel extends Model
{

    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    public function primaryKey(): string
    {
        return 'id';
    }
    
    public function getList($numRows=1000000)
    {
        $tableName = static::tableName();
        $statement = self::prepare("SELECT SQL_CALC_FOUND_ROWS * FROM $tableName LIMIT $numRows");
        
        $statement->execute();
        return $statement->fetchAll(2);
    }

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = $this->prepare("INSERT INTO $tableName (" . implode(",", $attributes) . ") 
                VALUES (" . implode(",", $params) . ")");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        $sql = implode("AND", array_map(fn($attr) => "$attr = :$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $sql");
        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }

    public function prepare($sql): PDOStatement
    {
        return Application::$app->db->pdo->prepare($sql);
    }
}
