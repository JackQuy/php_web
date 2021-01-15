<?php 

class Dbh {
    private $servername = "mysql";
    private $username = "root";
    private $password = "123456";
    private $dbname = "my_db";

    function connect() {
        $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->dbname,$this->username, $this->password);
        return $conn;
    }
    function selectAllProduct($conn, $str) {
        $stmt = $conn->prepare("select * from {$str}");
        $stmt->execute();
        $text = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $text;
    }
}

?>