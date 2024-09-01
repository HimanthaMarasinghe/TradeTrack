<?php

class Shops extends Model
{

    protected $table = 'shops';
    protected $fillable = ['so_phone', 'shop_name', 'shop_address', 'cash_drawer_balance', 'bank_balance', 'so_first_name', 'so_last_name', 'so_address', 'so_password'];

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