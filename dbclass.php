<?php
class DBClass
{
    // $conn = mysqli_connect("localhost", "dvnsbfoekuip", "Rvd@9510036418", "anand");
    private $host = "localhost";
    // private $username = "u842361904_viral";
    // private $password = "Rvd@9510036418";
    // private $database = "u842361904_exp_manager";
	
	private $username = "root";
    private $password = "";
    private $database = "exp_manager";

    public $connection;

    // get the database connection
    public function getConnection()
    {

        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
