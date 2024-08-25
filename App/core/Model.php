<?php

class Model extends Database
{
    // protected $table = 'users';

    public function where($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";
        foreach($keys as $key)
        {
            $query .= $key." = :".$key . " && ";
        }
        
        foreach($keys_not as $key)
        {
            $query .= $key." != :".$key . " && ";
        }

        $query = rtrim($query, " && "); 

        // echo $query;
        $data = array_merge($data, $data_not);
        return $this->query($query, $data);
    }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);
        $query = "SELECT * FROM $this->table WHERE ";
        foreach($keys as $key)
        {
            $query .= $key." = :".$key . " && ";
        }
        
        foreach($keys_not as $key)
        {
            $query .= $key." != :".$key . " && ";
        }

        $query = rtrim($query, " && "); 
        $query .= " LIMIT 1";

        // echo $query;
        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        if($result)
            return $result[0];

        return false;
    }
}