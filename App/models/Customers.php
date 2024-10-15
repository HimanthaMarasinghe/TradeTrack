<?php

class Customers extends Model
{

    protected $table = 'customers';
    protected $fillable = ['cus_phone', 'cus_first_name', 'cus_last_name', 'cus_password'];

}