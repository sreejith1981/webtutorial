<?php
class dbConfig
{
    protected $conn;

    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = 'root';
    private $db_name = 'StudentDB';


    function __construct()
    {
        $conn = null;
    }


    function dbConnect()
    {
        $this->conn = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if($this->conn->connect_error)
        {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }


    function executeQuery($strQuery)
    {
        $result = $this->conn->query($strQuery);

        return $result;
    }
}
?>
