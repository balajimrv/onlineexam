<?php

class DB_CONNECT {
		
    function __construct() {
        $this->connect();
    }

    function __destruct() {
        $this->close();
    }
    
    function connect() {
		global $con;
        require_once 'db_config.php';
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_DATABASE);
        //$db = mysqli_select_db(DB_DATABASE) or die(mysqli_error()) or die(mysqli_error());
        return $con;
    }

    function close() {
		global $con;
        mysqli_close($con);
    }
}
?>