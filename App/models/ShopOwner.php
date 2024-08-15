<?php

class ShopOwner extends Model
{

    protected $table = 'ShopOwner';
    protected $fillable = ['PhoneNumber', 'ShopName', 'ShopAddress', 'ShopLocation', 'OwnerName', 'Password'];

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