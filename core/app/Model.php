<?php

namespace App;
use App\Database\Connection;
use PDO;
abstract class Model
{
    public static $table;
    protected static $connection;
    public $id;

    public function __construct($id)
    {
        // $this->connection = $this->initConnection();
        $this->id = $id;
    }

    protected static function initConnection()
    {
        if (self::$connection === null) {
            // Use the Singleton pattern to get the connection instance
            $connection = Connection::getInstance();
            self::$connection = $connection->getConnection();
        }
    }
    public static function create(array $data)
    {
        self::initConnection();
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $query = "INSERT INTO " . static::$table . " ($columns) VALUES ($values)";
        self::$connection->exec($query);
        $lastInsertedId = self::$connection->lastInsertId();
        $newInstance = new static($lastInsertedId);
        foreach ($data as $column => $value) {
            $newInstance->$column = $value;
        }
        return $newInstance;
    }

    public function update(array $data)
    {
        self::initConnection();
        $updates = [];
        $id = $this->id;
        foreach ($data as $key => $value) {
            $updates[] = "$key = '$value'";
        }
        $updates = implode(', ', $updates);
        $query = "UPDATE " . static::$table . " SET $updates WHERE id = $id";
        self::$connection->exec($query);
        return 1;
    }

    public static function get()
    {
        self::initConnection();
        $query = "SELECT * FROM " . static::$table;
        $statement = self::$connection->query($query);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);

        $instances = [];

        foreach ($result as $row) {
            $id = $row['id'];

            $newInstance = new static($id);
            // Skip 'id' in the second foreach loop
            foreach ($row as $key => $value) {
                if ($key !== 'id') {
                    $newInstance->$key = $value;
                }
            }
            $instances[] = $newInstance;
        }
        return $instances;
    }


    public static function find($id)
    {
        self::initConnection();
        $query = "SELECT * FROM " . static::$table . " WHERE id = $id";

        $statement = self::$connection->query($query);
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $id = $result['id'];
        $newInstance = new static($id);
        foreach ($result as $key => $value) {
            // Extract the 'id' from the row
            if ($key !== "id") {
                $newInstance->$key = $value;
            }
        }

        // You may fetch and return the result
        return $newInstance;
    }


    public function delete()
    {
        self::initConnection();
        $id = $this->id;
        $query = "DELETE FROM " . static::$table . " WHERE id = $id";
        self::$connection->exec($query);
        return 1;
    }

    // You can add more methods as needed
}
