<?php

class Model extends Database
{

    public function where($data, $data_not = [], $limit = null, $offset = null)
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        if(!isset($this->readTable)){
            $this->readTable = $this->table;
        }

        $query = "SELECT * FROM $this->readTable WHERE ";

        $placeholders = []; // Map original column names to placeholder-friendly keys

        //When using join queries use "table.column" notation. This notation does not support for query parameter placeholders, therefore we remove the "." from the column names in next few lines of code.

        foreach ($keys as $key) {
            $placeholder = str_replace(['.'], '', $key);
            $placeholders[$placeholder] = $data[$key];
            $query .= "$key = :$placeholder && ";
        }

        foreach ($keys_not as $key) {
            $placeholder = str_replace(['.'], '', $key);
            $placeholders[$placeholder] = $data_not[$key];
            $query .= "$key != :$placeholder && ";
        }

        $query = rtrim($query, " && ");

        if($limit)
        {
            $query .= " LIMIT $limit";
        }

        if($offset)
        {
            $query .= " OFFSET $offset";
        }

        return $this->query($query, $placeholders);
    }

    // public function first($data, $data_not = [])
    // {
    //     $keys = array_keys($data);
    //     $keys_not = array_keys($data_not);

    //     if(!isset($this->readTable)){
    //         $this->readTable = $this->table;
    //     }

    //     $query = "SELECT * FROM $this->readTable WHERE ";
    //     foreach($keys as $key)
    //     {
    //         $query .= $key." = :".$key . " && ";
    //     }
        
    //     foreach($keys_not as $key)
    //     {
    //         $query .= $key." != :".$key . " && ";
    //     }

    //     $query = rtrim($query, " && "); 
    //     $query .= " LIMIT 1";

    //     $data = array_merge($data, $data_not);
    //     $result = $this->query($query, $data);
    //     if($result)
    //         return $result[0];

    //     return false;
    // }

    public function first($data, $data_not = [])
    {
        $keys = array_keys($data);
        $keys_not = array_keys($data_not);

        if (!isset($this->readTable)) {
            $this->readTable = $this->table;
        }

        $query = "SELECT * FROM $this->readTable WHERE ";
        $placeholders = []; // Map original column names to placeholder-friendly keys

        //When using join queries use "table column" notation instead of "table.column"

        foreach ($keys as $key) {
            $placeholder = str_replace(['.'], '', $key);
            $placeholders[$placeholder] = $data[$key];
            $query .= "$key = :$placeholder && ";
        }

        foreach ($keys_not as $key) {
            $placeholder = str_replace(['.'], '', $key);
            $placeholders[$placeholder] = $data_not[$key];
            $query .= "$key != :$placeholder && ";
        }

        $query = rtrim($query, " && ");
        $query .= " LIMIT 1";

        $result = $this->query($query, $placeholders);
        if ($result) {
            return $result[0];
        }

        return false;
    }


    public function readAll($limit = null, $offset = null)
    {
        if(!isset($this->readTable)){
            $this->readTable = $this->table;
        }

        $query = "SELECT * FROM $this->readTable";

        if($limit)
        {
            $query .= " LIMIT $limit";
        }

        if($offset)
        {
            $query .= " OFFSET $offset";
        }

        return $this->query($query);
    }

    public function insert($data, $con = null)
    {
        // Only the fields that are mentioned in the fillable array will be inserted.
        if(!empty($this->fillable))
        {
            foreach ($data as $key => $value)
            {
                if(!in_array($key, $this->fillable))
                {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "INSERT INTO $this->table (".implode(",", $keys).") VALUE (:".implode(",:", $keys).")";
        $this->query($query, $data, $con);
        return false;
    }

    public function bulkInsert($data, $keys, $con)
    {
        $query = "INSERT INTO $this->table (".implode(",", $keys).") VALUES ";
        $params = [];
        foreach($data as $row)
        {
            $query .= "(";
            foreach($row as $k => $v)
            {
                $query .= "?,";
                $params[] = $v;
            }
            $query = rtrim($query, ",");
            $query .= "),";
        }
        $query = rtrim($query, ",");
        $this->query($query, $params, $con);
        return false;
    }
  
    public function update($ids, $data, $con = null)
    {
        // Only the fields that are mentioned in the fillable array will be updated.
        if(!empty($this->fillable))
        {
            foreach ($data as $key => $value)
            {
                if(!in_array($key, $this->fillable))
                {
                    unset($data[$key]);
                }
            }
        }
        $keys = array_keys($data);
        $query = "UPDATE $this->table SET ";
        foreach($keys as $key)
        {
            $query .= $key." = :".$key . ", ";
        }
        
        $query = rtrim($query, ", "); 

        $query .= " WHERE ";
        foreach($ids as $column => $value)
        {
            $query .= $column." = :condition_$column AND ";
            $data["condition_$column"] = $value;
        }
        /*
        The term "condition" is used, so when updating a field that also present in the where condition,
        the data array will not be overwritten.
        */
        $query = rtrim($query, " AND ");
        $this->query($query, $data, $con);
        return false;
    }

public function delete($ids, $con = null)
    {
        $data = [];
        $query = "DELETE FROM $this->table WHERE ";

        foreach($ids as $column => $value)
        {
            $query .= $column." = :".$column." && ";
            $data["$column"] = $value;
        }
        $query = rtrim($query, " && ");

        $this->query($query, $data, $con);

        return false;
    }


    
}


