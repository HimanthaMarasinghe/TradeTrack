<?php

class Database
{
    private function connect()
    {
        $DB_String = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
        $con = new PDO($DB_String, DB_USER, DB_PASS);
        return $con;
    }

    public function query($query, $data = [])
    {
        $con = $this->connect();
        $stmt = $con->prepare($query);

        $check = $stmt->execute($data);
        if($check)
        {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }
        return false;
    }

    public function get_row($query, $data = [])
    {
        $con = $this->connect();
        $stmt = $con->prepare($query);

        $check = $stmt->execute($data);
        if($check)
        {
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result[0];
            }
        }
        return false;
    }
}