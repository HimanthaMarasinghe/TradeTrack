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
    
    public function update($id, $data, $id_column = 'id')
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

        $query .= " WHERE $id_column = :condition_$id_column";
        
        $data["condition_$id_column"] = $id; 
        /*
        The term "condition" is used, so when updating a field that also present in the where condition,
        the data array will not be overwritten.
        */

        // echo $query;
        $this->query($query, $data);
        return false;
    }
}
