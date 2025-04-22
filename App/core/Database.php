<?php

class Database
{
    private function connect()
    {
        $DB_String = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
        $con = new PDO($DB_String, DB_USER, DB_PASS);
        $con->exec("SET time_zone = '+05:30'");
        return $con;
    }

    public function query($query, $data = [], $con=null)
    {
        if($con == null)
            $con = $this->connect();
        
        $stmt = $con->prepare($query);

        $check = $stmt->execute($data);
        if($check)
        {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }
        return false;
    }

    // public function get_row($query, $data = [], $con = null)
    // {
    //     if($con == null)
    //         $con = $this->connect();

    //     $stmt = $con->prepare($query);

    //     $check = $stmt->execute($data);
    //     if($check)
    //     {
    //         $result = $stmt->fetchAll(PDO::FETCH_OBJ);
    //         if(is_array($result) && count($result))
    //         {
    //             return $result[0];
    //         }
    //     }
    //     return false;
    // }

    public function startTransaction(){
        $con = $this->connect();
        $con->beginTransaction();
        return $con;
    }

    public function lastId($con){
        return $con->lastInsertId();
    }

    public function commit($con){
        $con->commit();
    }
}