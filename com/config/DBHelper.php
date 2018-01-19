<?php
require_once 'DBConfig.php';//Database Configuration

class DBHelper {

    function getConnection(){
        //gets connection to the database DB_NAME
        $conn = new mysqli(DB_HOST,DB_USERNAME,DB_PASSWORD,DB_NAME);
        if($conn->connect_errno){
            echo "Failed to connect to MySQL (".$conn->errno.") ".$conn->error;
            exit;
        }
        return $conn;
    }
    function closeConnection($conn){
        //closes database connection
        $conn->close();
    }
    function selectByQuery($conn,$query) {
        //return the result of database query
        $res = $conn->query($query);
        return $res;
    }
    function insert($conn,$table,$column,$columnValues) {
        //inserts into table
        $res=$conn->query("insert into ".$table."(".$column.") values(".$columnValues.")");
        if($res==1)
            return 1;
        else
            return 0;
    }
}
?>