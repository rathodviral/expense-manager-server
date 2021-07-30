<?php
class User
{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "authorization";

    // table columns
    public $id;
    public $username;
    public $password;
    public $detail;
    public $family;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    //create
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET username = :username, password = :password, family = :family, detail = :detail";
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':family', $this->family);
        $stmt->bindParam(':detail', $this->detail);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    //read
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readById()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = " . $this->id;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function authorize()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = '" . $this->username . "' AND password = '" . $this->password . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update()
    {
        // update query
        $query = "UPDATE " . $this->table_name . " SET username = :username, password = :password, family = :family, detail = :detail";

        // prepare query statement
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':family', $this->family);
        $stmt->bindParam(':detail', $this->detail);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = '" . $this->id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
