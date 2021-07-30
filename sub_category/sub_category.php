<?php
class SubCategory
{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "sub_category";

    // table columns
    public $id;
    public $is_expense;
    public $is_active;
    public $name;
    public $detail;
    public $category_id;

    public function __construct($connection, $table_name)
    {
        $this->connection = $connection;
        $this->table_name = "sub_category_" . $table_name;
    }

    //C
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET is_expense = :is_expense, name = :name, category_id = :category_id, detail = :detail";
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':is_expense', $this->is_expense);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':detail', $this->detail);
        $stmt->bindParam(':category_id', $this->category_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //R
    public function read()
    {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readData()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE is_active = '1'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $exp = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $p  = array(
                    "id" => $id,
                    "name" => $name,
                    "isExpense" => intval($is_expense) === 1,
                    "detail" => $detail,
                    "categoryId" => $category_id
                );
                array_push($exp, $p);
            }
            return $exp;
        }
        return [];
    }

    //U
    public function update()
    {
        // update query
        $query = "UPDATE " . $this->table_name . " SET id = :id, is_expense = :is_expense, is_active = :is_active, name = :name, category_id = :category_id, detail = :detail WHERE id = :id";

        // prepare query statement
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':is_expense', $this->is_expense);
        $stmt->bindParam(':is_active', $this->is_active);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':detail', $this->detail);
        $stmt->bindParam(':category_id', $this->category_id);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    //D
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
