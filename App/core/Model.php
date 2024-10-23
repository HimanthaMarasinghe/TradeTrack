<?php

class Model extends Database
{

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

        $data = array_merge($data, $data_not);
        $result = $this->query($query, $data);
        if($result)
            return $result[0];

        return false;
    }

    public function readAll()
    {
        $query = "SELECT * FROM $this->table";
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
            $query .= $column." = :condition_$column && ";
            $data["condition_$column"] = $value;
        }
        /*
        The term "condition" is used, so when updating a field that also present in the where condition,
        the data array will not be overwritten.
        */
        $query = rtrim($query, " && ");
        $this->query($query, $data, $con);
        return false;
    }

public function delete($ids)
    {
        $data = [];
        $query = "DELETE FROM $this->table WHERE ";

        foreach($ids as $column => $value)
        {
            $query .= $column." = :".$column." && ";
            $data["$column"] = $value;
        }
        $query = rtrim($query, " && ");

        $this->query($query, $data);

        return false;
    }


    
}


