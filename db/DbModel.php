<?php

namespace app\core\db;

use app\core\Application;
use app\core\Model;

abstract class DbModel extends Model
{
    abstract public static function tableName(): string;

    abstract public function attributes(): array;

    abstract public function primaryKey(): string;

    public function save()
    {
        $tableName = static::tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',', $attributes).") 
            VALUES(".implode(',', $params).");
        ");
        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        $statement->execute();
        return true;
    }

    public static function prepare($sql)
    {
        return Application::$app->db->pdo->prepare($sql);
    }

    public static function findOne($where) // ['email' => some@emil.com, 'firstname' = 'eshqobul']
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);
        // SELECT * FROM $tableName WHERE email = :email AND
        $query = implode(' AND ', array_map(fn($attr) => "$attr =:$attr", $attributes));
        $statement = self::prepare("SELECT * FROM $tableName WHERE $query");
        foreach ($where as $key => $value) {
            $statement->bindValue(":$key", $value);
        }
        $statement->execute();
        return $statement->fetchObject(static::class);
    }
}