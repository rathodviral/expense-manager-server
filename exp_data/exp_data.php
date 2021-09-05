<?php
class ExpenseData
{

    // Connection instance
    private $connection;

    // table name
    private $table_name = "exp_data";

    // table columns
    public $id;
    public $is_expense;
    public $is_paid;
    public $date;
    public $user;
    public $detail;
    public $amount;
    public $note;
    public $category;
    public $start_date = "";
    public $end_date = "";

    public function __construct($connection, $table_name)
    {
        $this->connection = $connection;
        $this->table_name = "exp_data_" . $table_name;
    }

    //C
    public function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET is_expense = :is_expense, is_paid = :is_paid, date = :date, user = :user, detail = :detail, amount = :amount, note = :note, category = :category";
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':is_expense', $this->is_expense);
        $stmt->bindParam(':is_paid', $this->is_paid);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':user', $this->user);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':detail', $this->detail);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':note', $this->note);


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
    //R
    public function readData()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MONTH(date) = MONTH(CURRENT_DATE())
        AND YEAR(date) = YEAR(CURRENT_DATE())";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $exp = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $p  = array(
                    "id" => $id,
                    "user" => $user,
                    "category" => $category,
                    "date" => $date,
                    "isExpense" => intval($is_expense) === 1,
                    "isPaid" => intval($is_paid) === 1,
                    "detail" => $detail,
                    "amount" => intval($amount),
                    "note" => $note,
                );
                array_push($exp, $p);
            }
            return $exp;
        }
        return [];
    }
    public function readByCurrentMonth()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE MONTH(date) = MONTH(CURRENT_DATE())
        AND YEAR(date) = YEAR(CURRENT_DATE())";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readByDate($start_date, $end_date, $is_expense)
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE (date BETWEEN '" . $start_date . "' AND '" . $end_date . "') AND is_expense = '" . $is_expense . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readById()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = '" . $this->id . "'";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    public function readByFilter()
    {
        // $query = "SELECT * FROM " . $this->table_name . " WHERE id = '" . $this->id . "'";
        $query = "SELECT * FROM " . $this->table_name . " WHERE ";
        if ($this->id) {
            $query = $query . "id = '" . $this->id . "'";
        }

        if ($this->is_expense) {
            if ($this->id || $this->is_expense) {
                $query = $query . " AND ";
            }
            $query = $query . "is_expense = '" . $this->is_expense . "'";
        }

        if ($this->user) {
            if ($this->id || $this->is_expense || $this->user) {
                $query = $query . " AND ";
            }
            $query = $query . "user LIKE '%" . $this->user . "%'";
        }

        if ($this->date) {
            if ($this->id || $this->is_expense || $this->user || $this->date) {
                $query = $query . " AND ";
            }
            $query = $query . "date LIKE '%" . $this->date . "%'";
        }

        if ($this->category) {
            if ($this->id || $this->is_expense || $this->user || $this->date || $this->category) {
                $query = $query . " AND ";
            }
            $query = $query . "category LIKE '%" . $this->category . "%'";
        }

        if (!isset($this->id) && !isset($this->is_expense) && !isset($this->user) && !isset($this->date) && !isset($this->category)) {
            $query = "SELECT * FROM " . $this->table_name;
        }
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readLastExpense()
    {
        // $query = "SELECT LAST srno FROM " . $this->table_name;
        $query = "SELECT id FROM " . $this->table_name . " WHERE is_expense = 1 ORDER BY id DESC LIMIT 1";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    //U
    public function update()
    {
        // update query
        $query = "UPDATE " . $this->table_name . " SET id = :id, is_expense = :is_expense, is_paid = :is_paid, date = :date, user = :user, detail = :detail, amount = :amount, note = :note, category = :category WHERE id = :id";

        // prepare query statement
        $stmt = $this->connection->prepare($query);

        // bind new values
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':is_expense', $this->is_expense);
        $stmt->bindParam(':is_paid', $this->is_paid);
        $stmt->bindParam(':date', $this->date);
        $stmt->bindParam(':user', $this->user);
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':detail', $this->detail);
        $stmt->bindParam(':amount', $this->amount);
        $stmt->bindParam(':note', $this->note);

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
