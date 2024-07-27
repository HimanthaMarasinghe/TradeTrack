<?php

class User extends Model
{

    protected $table = 'users';
    protected $fillable = ['name', 'age','date'];

    public function validate($data)
    {
        $this->errors = [];

        if(empty($data['name']))
        {
            $this->errors['name'] = "Name is required.";
        }

        if(empty($this->errors))
            return true;

        return false;
    }
}