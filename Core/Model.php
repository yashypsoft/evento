<?php

namespace Core;

use App\Config;
use PDO;


abstract class Model
{
    static function getDB()
    {
        static $conn = null;
        if ($conn === null) {    
            
            // $conn = mysqli_connect(Config::DB_HOST, Config::DB_USER,
            //     Config::DB_PASSWORD , Config::DB_NAME);
            // if ($conn) {
            //     return $conn;
            // } else {
            //     die("connection failed" . mysqli_connect_error());
            // }

            try{
                $conn = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME,
                    Config::DB_USER,Config::DB_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            }
            catch(\PDOException $e){
                echo $e->getMessage();
            }
        }
        return $conn;
    }  


    public function getAll($tableName)
    {
        $conn = self::getDB();
        $query = "select * from $tableName";
        // if ($query_run = mysqli_query($conn, $query)) {
        //     return $query_run;
        // }
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }
    public function getFieldData($tableName,$fieldName,$whereArray =null)
    {
        $conn = self::getDB();
        $where = $this->whereCondotion($whereArray);
        $query = "select $fieldName from $tableName $where";
        // if ($query_run = mysqli_query($conn, $query)) {
        //     return $query_run;
        // }
        $stmt = $conn->query($query);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        return $result;
    }

    function insertData($tableName, $data)
    {
        $conn = self::getDB();

        $valueItemArray = [];
        $ColumnNameArray = [];

        foreach ($data as $key => $value) {
            array_push($ColumnNameArray, $key);
            array_push($valueItemArray, $value);
        }

        $columnString = implode(',', $ColumnNameArray);
        $valueString = implode("','", $valueItemArray);

        $query = "insert into $tableName ($columnString) VALUES ('$valueString')";

        // if ($query_run = mysqli_query($conn, $query)) {
        //     return mysqli_insert_id($conn);
        // }
   
        $stmt = $conn->exec($query);      
        $id = $conn->lastInsertId();
        return $id; 

    }

    function fetchRow($tableName, $whereArray = null)
    {
        $conn = self::getDB();

        $where = $this->whereCondotion($whereArray);

        $query = "SELECT * FROM $tableName $where";

        // $query_run = mysqli_query($conn, $query);
        // $data = mysqli_fetch_assoc($query_run);
        // return $data;

        $stmt = $conn->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC); 
        return $result;
    }

    function whereCondotion($whereArray)
    {

        if ($whereArray != null) {
            $key = array_keys($whereArray);
            $value = array_values($whereArray);

            $where = "WHERE $key[0]= '$value[0]'";
            if (sizeof($whereArray) > 1) {
                for ($cnt = 1; $cnt < sizeof($whereArray); $cnt++) {
                    $where .= "AND $key[$cnt] = '$value[$cnt]'";
                }
            }

            return $where;
        } else {
            $where = "";
        }
    }

    function updateQuery($tableName, $ArrayData, $whereArray = [])
    {
        $conn = self::getDB();

        $where = $this->whereCondotion($whereArray);
        foreach ($ArrayData as $key => $value) {
            $query = "UPDATE $tableName SET $key = '$value' $where";
            // if ($query_run = mysqli_query($conn, $query)) {
            // }
            $stmt = $conn->exec($query);
        }
    }

    function deleteData($tableName, $whereArray = [])
    {
        $conn = self::getDB();

        $where = $this->whereCondotion($whereArray);
        $query = "DELETE FROM $tableName $where";
        // if ($query_run = mysqli_query($conn, $query)) {
        // }
        $stmt = $conn->exec($query);
        return $stmt;
    }

    public function checkData($tableName, $key, $data)
    {

        $conn = self::getDB();

        $query = "SELECT COUNT($key) FROM $tableName WHERE $key ='$data' ";

        $stmt = $conn->query($query);

        $numOfRow = $stmt->fetchColumn();

        if ($numOfRow >= 1) {
            return true;
        } else {
            return false;
        }
    }
}
