<?php

class Products extends Model
{

    protected $table = 'sales_agents';
    protected $fillable = ['sa_phone', 'sa_first_name', 'sa_last_name', 'sa_address', 'sa_password', 'su_phone'];

}