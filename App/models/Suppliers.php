<?php

class Suppliers extends Model
{

    protected $table = 'suppliers';
    protected $readTable = 'suppliers s INNER JOIN users u ON s.su_phone = u.phone';
    protected $fillable = ['su_phone', 'company_name', 'company_address'];

}